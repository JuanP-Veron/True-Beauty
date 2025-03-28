<?php 
include("../Includes/functions.php");
include("../../modelo/connect.php");

// Respuesta en formato JSON
header('Content-Type: application/json');

// Validar método de solicitud
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
    exit;
}

// Validar datos recibidos
if (!isset($_POST['do']) || !isset($_POST['service_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    exit;
}

$service_id = intval($_POST['service_id']);
$action = $_POST['do'];

if ($action !== "Delete") {
    echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
    exit;
}

try {
    // Verificar si el servicio existe
    $check = $con->prepare("SELECT service_id FROM services WHERE service_id = ?");
    $check->execute([$service_id]);
    
    if ($check->rowCount() === 0) {
        echo json_encode(['status' => 'error', 'message' => 'El servicio no existe']);
        exit;
    }

    // Eliminar el servicio
    $stmt = $con->prepare("DELETE FROM services WHERE service_id = ?");
    $stmt->execute([$service_id]);

    echo json_encode([
        'status' => 'success', 
        'message' => 'Servicio eliminado correctamente'
    ]);
    
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
}
?>