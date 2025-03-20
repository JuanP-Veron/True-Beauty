<?php 

session_start();
if (empty($_SESSION["id"])) {
    header("location: ../login.php");
    exit();
}
include "../modelo/conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" type="text/css" href="../assets/styles/registro.css">
   <title>Registro ADMIN</title>
</head>
<body>
   <div class="container">
      <div class="img">
         <img src="../assets/img/registro.svg">
      </div>
      <div class="login-content">
         <form method="post" action="">
            <img src="../assets/img/avatar.png">
            <h2 class="title">REGISTRARSE</h2>

            <div class="input-div">
               <label for="nombre">Nombre</label>
               <input type="text" class="input" name="nombre" id="nombre" required>
            </div>

            <div class="input-div">
               <label for="apellido">Apellido</label>
               <input type="text" class="input" name="apellido" id="apellido" required>
            </div>

            <div class="input-div">
               <label for="usuario">Usuario</label>
               <input type="text" class="input" name="usuario" id="usuario" required>
            </div>

            <div class="input-div pass">
               <label for="password">Contraseña</label>
               <input type="password" id="password" class="input" name="password" required>
               <div class="view">
                  <i class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></i>
               </div>
            </div>

            <div class="text-center">
               <a class="font-italic" href="../login.php">Salir</a>
            </div>

            <input name="ingresar" class="btn" type="submit" value="CONFIRMAR">
         </form>
      </div>
   </div>

   <script src="../assets/js/fontawesome.js"></script>
   <script src="../assets/js/main2.js"></script>
   
</body>
</html>
<?php
include "../controlador/controlador_registro.php"; 
?>