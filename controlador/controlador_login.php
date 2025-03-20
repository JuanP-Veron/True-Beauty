<?php
include "modelo/conexion.php";
session_start();

if (!empty($_POST["ingresar"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["password"])) {
        $usuario = trim($_POST["usuario"]);
        $passwordIngresado = trim($_POST["password"]);

        // Buscar usuario en la base de datos
        $sql = $conexion->prepare("SELECT * FROM losadmin WHERE usuario = ?");
        $sql->bind_param("s", $usuario);
        $sql->execute();
        $resultado = $sql->get_result();

        if ($datos = $resultado->fetch_object()) {
            // Verificar la contraseña usando crypt()
            if (crypt($passwordIngresado, $datos->clave) === $datos->clave) {
                $_SESSION["id"] = $datos->id;
                $_SESSION["nombre"] = $datos->nombre;
                $_SESSION["apellido"] = $datos->apellido;
                header("location: admin/index.php");
                exit();
            } else {
                echo "<div class='usuInct'>Contraseña Incorrecta</div>";
            }
        } else {
            echo "<div class='usuInct'>Usuario No Encontrado</div>";
        }

        $sql->close();
    } else {
        echo "<div class='usuInct'>Campos Vacíos</div>";
    }
}
?>
