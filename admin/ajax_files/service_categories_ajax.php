<?php
session_start();
include("../Includes/functions.php");
include("../../modelo/connect.php");
// Habilitar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Registrar todos los datos recibidos para depuración
file_put_contents('debug_ajax.log', print_r($_POST, true));

if (isset($_POST['do'])) {
    $do = $_POST['do'];

    // Agregar Categoría
    if ($do == "Agregar") {
        $category_name = test_input($_POST['category_name']);

        // Validar que el nombre no esté vacío
        if (empty($category_name)) {
            echo json_encode(["alert" => "Advertencia", "message" => "¡El nombre de la categoría es obligatorio!"]);
            exit();
        }

        // Verificar si el nombre de la categoría ya existe
        $stmt = $con->prepare("SELECT COUNT(*) FROM service_categories WHERE category_name = ?");
        $stmt->execute([$category_name]);
        $exists = $stmt->fetchColumn();

        if ($exists > 0) {
            echo json_encode(["alert" => "Advertencia", "message" => "¡El nombre de la categoría ya existe!"]);
            exit();
        } else {
            // Insertar la nueva categoría
            try {
                $stmt = $con->prepare("INSERT INTO service_categories (category_name) VALUES (?)");
                $stmt->execute([$category_name]);
                echo json_encode(["alert" => "Éxito", "message" => "¡La categoría ha sido agregada exitosamente!"]);
            } catch (Exception $e) {
                echo json_encode(["alert" => "Error", "message" => "Error al agregar la categoría: " . $e->getMessage()]);
            }
        }
    } 

    // Eliminar Categoría
    elseif ($do == "Eliminar") {
        $category_id = $_POST['category_id'];

        try {
            $con->beginTransaction();

            // Verificar si hay servicios asociados a esta categoría
            $stmt_services = $con->prepare("SELECT service_id FROM services WHERE category_id = ?");
            $stmt_services->execute([$category_id]);
            $services = $stmt_services->fetchAll();
            $services_count = $stmt_services->rowCount();

            if ($services_count > 0) {
                // Obtener el ID de la categoría "Uncategorized"
                $stmt_uncategorized = $con->prepare("SELECT category_id FROM service_categories WHERE LOWER(category_name) = ?");
                $stmt_uncategorized->execute(["uncategorized"]);
                $uncategorized_id = $stmt_uncategorized->fetchColumn();

                // Mover los servicios a "Uncategorized"
                foreach ($services as $service) {
                    $stmt_update = $con->prepare("UPDATE services SET category_id = ? WHERE service_id = ?");
                    $stmt_update->execute([$uncategorized_id, $service["service_id"]]);
                }
            }

            // Eliminar la categoría
            $stmt_delete = $con->prepare("DELETE FROM service_categories WHERE category_id = ?");
            $stmt_delete->execute([$category_id]);
            $con->commit();
            echo json_encode(["alert" => "Éxito", "message" => "¡La categoría ha sido eliminada exitosamente!"]);
        } catch (Exception $e) {
            $con->rollBack();
            echo json_encode(["alert" => "Error", "message" => "Error al eliminar la categoría: " . $e->getMessage()]);
        }
    } 
    
    // Editar Categoría
    elseif ($do == "Editar") {
        $category_id = $_POST['category_id'];
        $category_name = test_input($_POST['category_name']);

        // Validar que el nombre no esté vacío
        if (empty($category_name)) {
            echo json_encode(["alert" => "Advertencia", "message" => "¡El nombre de la categoría es obligatorio!"]);
            exit();
        }

        // Verificar si el nombre de la categoría ya existe (excepto para la categoría actual)
        $stmt_check = $con->prepare("SELECT category_id FROM service_categories WHERE category_name = ? AND category_id != ?");
        $stmt_check->execute([$category_name, $category_id]);
        $exists = $stmt_check->rowCount();

        if ($exists > 0) {
            echo json_encode(["alert" => "Advertencia", "message" => "¡El nombre de la categoría ya existe!"]);
            exit();
        } else {
            // Actualizar la categoría
            try {
                $stmt = $con->prepare("UPDATE service_categories SET category_name = ? WHERE category_id = ?");
                $stmt->execute([$category_name, $category_id]);
                echo json_encode(["alert" => "Éxito", "message" => "¡La categoría ha sido actualizada exitosamente!"]);
            } catch (Exception $e) {
                echo json_encode(["alert" => "Error", "message" => "Error al actualizar la categoría: " . $e->getMessage()]);
            }
        }
    } 
    
    // Acción no válida
    else {
        echo json_encode(["alert" => "Error", "message" => "Acción no válida."]);
    }
} else {
    echo json_encode(["alert" => "Error", "message" => "Solicitud no válida."]);
}
?>
