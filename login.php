<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" type="text/css" href="assets/styles/login.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

   <title>Inicio de sesión</title>
</head>

<body>
   <div class="container">
      <div class="img">
         <img src="assets/img/admin.svg">
      </div>
      <div class="login-content">
         <form method="post" action="">
            <img src="assets/img/avatar.png">
            <h2 class="title">BIENVENIDO</h2>
            <?php
               include "modelo/conexion.php";   
               include "controlador/controlador_login.php";
            ?>
            <div class="input-div one">
               <div class="div">
                  <label>Usuario</label>
                  <input id="usuario" type="text" class="input" name="usuario">
               </div>
            </div>
            <div class="input-div pass">
               <label for="password">Contraseña</label>
               <input type="password" id="password" class="input" name="password">
               <div class="view">
                  <i class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></i>
               </div>
            </div>

            <div class="text-center">
               <a class="font-italic isai5" href="index.php">Volver</a>
            </div>
            <input name="ingresar" class="btn" type="submit" value="INICIAR SESION">
         </form>
      </div>
   </div>
   <script src="assets/js/fontawesome.js"></script>
   <script src="assets/js/main2.js"></script>
</body>

</html>