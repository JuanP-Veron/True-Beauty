<?php
include "../modelo/connect.php"; // Conexión a la base de datos

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function validate_phone($phone) {
    return preg_match("/^\d{10}$/", $phone); // Teléfono con 10 dígitos
}

function validate_name($name) {
    return preg_match("/^[a-zA-Z\s]+$/", $name); // Nombre solo con letras y espacios
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_book_appointment_form'])) {
    // Datos del cliente
    $client_first_name = test_input($_POST['client_first_name']);
    $client_last_name = test_input($_POST['client_last_name']);
    $client_phone_number = test_input($_POST['client_phone_number']);
    $client_email = test_input($_POST['client_email']);

    // Validaciones
    if (!validate_name($client_first_name) || !validate_name($client_last_name)) {
        echo "<script>alert('Nombre y apellido solo pueden contener letras y espacios.');</script>";
        exit;
    }

    if (!validate_phone($client_phone_number)) {
        echo "<script>alert('El número de teléfono debe tener 10 dígitos.');</script>";
        exit;
    }

    if (!isset($_POST['selected_services']) || empty($_POST['selected_services'])) {
        echo "<script>alert('Por favor, selecciona al menos un servicio.');</script>";
        exit;
    }

    $selected_services = array_filter($_POST['selected_services'], function($value) {
        return !empty($value);
    });

    if (empty($selected_services)) {
        echo "<script>alert('Por favor, selecciona al menos un servicio válido.');</script>";
        exit;
    }

    if (!isset($_POST['desired_date_time'])) {
        echo "<script>alert('Por favor, selecciona una fecha y hora.');</script>";
        exit;
    }

    $desired_date_time = str_replace('T', ' ', $_POST['desired_date_time']);
    $selected_date_time = explode(' ', $desired_date_time);

    if (count($selected_date_time) < 2) {
        echo "<script>alert('Formato de fecha y hora inválido.');</script>";
        exit;
    }

    $date_selected = $selected_date_time[0];
    $start_time = $date_selected . " " . $selected_date_time[1];

    // Calcular la duración total de los servicios seleccionados
    $total_duration = 0;
    foreach ($selected_services as $service_id) {
        $stmt = $con->prepare("SELECT service_duration FROM services WHERE service_id = ?");
        $stmt->execute([$service_id]);
        $service = $stmt->fetch();
        if ($service) {
            $total_duration += (int)$service['service_duration'];
        } else {
            echo "<script>alert('El servicio con ID $service_id no existe.');</script>";
            exit;
        }
    }

    $start_time_obj = new DateTime($start_time);
    $end_time_expected = $start_time_obj->modify("+$total_duration minutes")->format('Y-m-d H:i:s');

    $con->beginTransaction();

    try {
        // Verificar si el cliente ya existe
        $stmtCheckClient = $con->prepare("SELECT * FROM clients WHERE client_email = ?");
        $stmtCheckClient->execute([$client_email]);
        $client_result = $stmtCheckClient->fetch();

        if ($client_result) {
            $client_id = $client_result["client_id"];
        } else {
            $stmtClient = $con->prepare("INSERT INTO clients(first_name, last_name, phone_number, client_email) VALUES(?, ?, ?, ?)");
            $stmtClient->execute([$client_first_name, $client_last_name, $client_phone_number, $client_email]);
            $client_id = $con->lastInsertId();
        }

        // Insertar la cita
        $stmtAppointment = $con->prepare("INSERT INTO appointments(date_created, client_id, start_time, end_time_expected, canceled, cancellation_reason) VALUES(?, ?, ?, ?, ?, ?)");
        $stmtAppointment->execute([
            date("Y-m-d H:i:s"), 
            $client_id, 
            $start_time, 
            $end_time_expected, 
            0, 
            null
        ]);

        $appointment_id = $con->lastInsertId();

        foreach ($selected_services as $service_id) {
            $stmtServiceBooked = $con->prepare("INSERT INTO services_booked(appointment_id, service_id) VALUES(?, ?)");
            $stmtServiceBooked->execute([$appointment_id, $service_id]);
        }

        $con->commit();
        echo "<script>alert('¡Cita creada con éxito!'); window.location.href = 'appointment.php';</script>";
        exit;
    } catch (Exception $e) {
        $con->rollBack();
        echo "<script>alert('Ocurrió un error al procesar la solicitud.');</script>";
    }
}
?>


<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>True-Beauty</title>
    <link rel="icon" href="img/logoo.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/styles/appointment.css">
</head>
<body>
    <!-- BOOKING APPOINTMENT SECTION -->
    <section class="book_section">
        <div class="containerr">
            <div class="book_content">
                <h2>Reserva tu Cita</h2>
                <p>Selecciona los servicios que deseas y completa tus datos para reservar.</p>
            </div>
            <form method="post" id="appointment_form" action="appointment.php">
                <!-- SELECT SERVICE -->
                <div class="select_services_div" id="services_tab">
                <div class="items_tab">
                    <?php
                    $stmt = $con->prepare("SELECT * FROM services");
                    $stmt->execute();
                    $rows = $stmt->fetchAll();

                    foreach ($rows as $row) {
                        echo "<div class='itemListElement'>";
                        echo "<div class='item_details'>";
                        echo "<div>" . $row['service_name'] . "</div>";
                        echo "<div class='item_select_part'>";
                        echo "<span class='service_duration_field'>" . $row['service_duration'] . " min</span>";
                        echo "<div class='service_price_field'><span style='font-weight: bold;'>" . $row['service_price'] . "$</span></div>";

                        // Botón de selección
                        echo "<button type='button' class='select_item_bttn service_button' data-service-id='" . $row['service_id'] . "'>Fijar</button>";

                        // Input oculto para mantener los valores seleccionados
                        echo "<input type='hidden' name='selected_services[]' value='' id='service_" . $row['service_id'] . "'>";
                    
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>

                </div>

                <!-- SELECT DATE AND TIME -->
                <div class="select_date_time_div" id="calendar_tab">
                    <div class="text_header">
                        <span>2. Elección de fecha y hora:</span>
                    </div>
                    <div>
                        <input type="datetime-local" name="desired_date_time" id="desired_date_time" class="form-control" required>
                        <span class="invalid-feedback">Este campo es requerido</span>
                    </div>
                </div>

                <!-- CLIENT DETAILS -->
                <div class="client_details_div" id="client_tab">
                    <div class="text_header">
                        <span>3. Tu información de Cliente:</span>
                    </div>
                    <div>
                        <div class="form-group">
                            <input type="text" name="client_first_name" id="client_first_name" class="form-control" placeholder="Nombre" required>
                            <input type="text" name="client_last_name" id="client_last_name" class="form-control" placeholder="Apellido" required>
                            <input type="email" name="client_email" id="client_email" class="form-control" placeholder="Correo" required>
                            <input type="text" name="client_phone_number" id="client_phone_number" class="form-control" placeholder="Teléfono Móvil" required>
                        </div>
                    </div>
                </div>

                <!-- SUBMIT BUTTON -->
                <div style="overflow:auto;padding: 30px 0px;">
                <div style="float: left;">
        <a href="../index.php" class="default_btn" style="background-color: #ccc; padding: 10px 20px; border-radius: 5px; text-decoration: none; color: black;">
            Volver
        </a>
    </div>
                    <div style="float:right;">
                        <input type="hidden" name="submit_book_appointment_form">
                        <button type="submit" class="default_btn">Reservar</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script src="../assets/js/appointment.js"></script>
</body>
</html>