<?php
session_start();

// Page Title
$pageTitle = 'Eliminar Citas';

// Includes
include '../modelo/connect.php';
include 'Includes/functions.php';
include 'Includes/header.php';

// Verificar si se envió el formulario de eliminación
if (isset($_POST['delete'])) {
    $appointment_id = $_POST['appointment_id'];

    try {
        // Iniciar una transacción
        $con->beginTransaction();

        // Eliminar los servicios reservados relacionados con la cita
        $stmt = $con->prepare("DELETE FROM services_booked WHERE appointment_id = ?");
        $stmt->execute([$appointment_id]);

        // Ahora eliminar la cita
        $stmt = $con->prepare("DELETE FROM appointments WHERE appointment_id = ?");
        $stmt->execute([$appointment_id]);

        // Confirmar la transacción
        $con->commit();

        echo "<script>alert('Cita eliminada correctamente'); window.location.href='eliminar.php';</script>";
    } catch (PDOException $e) {
        // Revertir cambios si hay un error
        $con->rollBack();
        echo "<script>alert('Error al eliminar la cita: " . $e->getMessage() . "');</script>";
    }
}

// Obtener todas las citas
$stmt = $con->prepare("SELECT appointment_id, start_time, client_id FROM appointments ORDER BY start_time ASC");
$stmt->execute();
$appointments = $stmt->fetchAll();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Eliminar Citas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Hora de inicio</th>
                            <th>ID Cliente</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appointment): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($appointment['start_time']); ?></td>
                                <td><?php echo htmlspecialchars($appointment['client_id']); ?></td>
                                <td>
                                    <form method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta cita?');">
                                        <input type="hidden" name="appointment_id" value="<?php echo $appointment['appointment_id']; ?>">
                                        <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'Includes/footer.php'; ?>
