<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../login.php");
}
//Includes
include '../modelo/connect.php';
include 'Includes/functions.php';
include 'Includes/header.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total de Clientes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= countItems("client_id", "clients") ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bs bs-boy fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total de Servicios
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= countItems("service_id", "services") ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="bs bs-scissors-1 fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Citas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= countItems("appointment_id", "appointments") ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Appointment Tables -->
    <div class="card shadow mb-4">
        <div class="card-header tab" style="padding: 0px !important;background:rgb(234, 180, 213)!important">
            <button class="tablinks">
                Reservas Próximas   
            </button>
        </div>
        <div class="card-body"> 
            <div class="table-responsive">
                <table class="table table-bordered tabcontent" id="Upcoming" style="display:table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Hora de inicio</th>
                            <th>Servicios reservados</th>
                            <th>Hora de finalización prevista</th>
                            <th>Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $con->prepare("SELECT * 
                                                FROM appointments a , clients c
                                                WHERE start_time >= ?
                                                AND a.client_id = c.client_id
                                                AND canceled = 0
                                                ORDER BY start_time;");
                        $stmt->execute(array(date('Y-m-d H:i:s')));
                        $rows = $stmt->fetchAll();
                        $count = $stmt->rowCount();

                        if ($count == 0) {
                            echo "<tr>
                                    <td colspan='4' style='text-align:center;'>
                                        La lista de sus próximas reservas se presentará aquí
                                    </td>
                                  </tr>";
                        } else {
                            foreach ($rows as $row) {
                                echo "<tr>
                                        <td>{$row['start_time']}</td>
                                        <td>";
                                $stmtServices = $con->prepare("SELECT service_name
                                                                FROM services s, services_booked sb
                                                                WHERE s.service_id = sb.service_id
                                                                AND appointment_id = ?");
                                $stmtServices->execute(array($row['appointment_id']));
                                $rowsServices = $stmtServices->fetchAll();
                                $first = true;
                                foreach ($rowsServices as $rowsService) {
                                    if (!$first) {
                                        echo " <br> ";
                                    }
                                    echo "- " . $rowsService['service_name'];
                                    $first = false;
                                }
                                echo "</td>
                                      <td>{$row['end_time_expected']}</td>
                                      <td><a href='#'>{$row['client_id']}</a></td>
                                    </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include 'Includes/footer.php';