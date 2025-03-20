<?php
include "../modelo/conexion.php";

if (!empty($_POST["ingresar"])) {
    if (empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["usuario"]) || empty($_POST["password"])) {
        echo "<div class='usuInct'>UNO DE LOS CAMPOS ESTÁ VACÍO</div>";
    } else {
        $nombre = trim($_POST["nombre"]);
        $apellido = trim($_POST["apellido"]);
        $usuario = trim($_POST["usuario"]);

        // Generar salt y encriptar contraseña con crypt()
        $salt = '$2y$10$' . substr(md5(uniqid(mt_rand(), true)), 0, 22);
        $password = crypt(trim($_POST["password"]), $salt);

        // Evitar SQL Injection usando prepared statements
        $sql = $conexion->prepare("INSERT INTO losadmin (nombre, apellido, usuario, clave) VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssss", $nombre, $apellido, $usuario, $password);
        $resultado = $sql->execute();

        if ($resultado) {
            echo "<div class='usuReg'>Datos Cargados Correctamente</div>";
        } else {
            echo "<div class='usuInct'>Error Al Registrar</div>";
        }

        $sql->close(); // Cerrar la consulta
    }
}
?>
