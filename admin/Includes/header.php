<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="True-Beauty Web">

    <!-- TÍTULO DE LA PÁGINA -->
    <title>Panel de Control</title>

    <!-- FUENTE -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- ARCHIVOS CSS -->
    <link href="../assets/styles/sb-admin-2.css" rel="stylesheet">
    <link href="../assets/styles/main.css" rel="stylesheet">

    <!-- ICONOS -->
    <link rel="stylesheet" type="text/css" href="../assets/fonts/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/styles/barber-icons.css">
</head>

<body id="page-top">

    <!-- CONTENEDOR PRINCIPAL -->
    <div id="wrapper">

        <!-- BARRA LATERAL -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- MARCA DE LA BARRA LATERAL -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-10">
                    True-Beauty
                </div>
            </a>

            <!-- SEPARADOR -->
            <hr class="sidebar-divider my-0">

            <!-- ELEMENTO DE NAVEGACIÓN - PANEL DE CONTROL -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Panel de Control</span>
                </a>
            </li>

            <!-- SEPARADOR -->
            <hr class="sidebar-divider">

            <!-- ENCABEZADO - GESTIÓN DE SERVICIOS Y CITAS -->
            <div class="sidebar-heading">
                Gestión de Servicios y Citas
            </div>

            <!-- ELEMENTO DE NAVEGACIÓN - CATEGORÍAS DE SERVICIOS -->
            <li class="nav-item">
                <a class="nav-link" href="service-categories.php">
                    <i class="fas fa-list"></i>
                    <span>Categorías de Servicios</span>
                </a>
            </li>

            <!-- ELEMENTO DE NAVEGACIÓN - SERVICIOS -->
            <li class="nav-item">
                <a class="nav-link" href="services.php">
                    <i class="bs bs-scissors-1"></i>
                    <span>Servicios</span>
                </a>
            </li>

            <!-- ELEMENTO DE NAVEGACIÓN - ELIMINAR CITAS -->
            <li class="nav-item">
                <a class="nav-link" href="eliminar.php">
                    <i class="fas fa-trash-alt"></i>
                    <span>Eliminar Citas</span>
                </a>
            </li>

            <!-- SEPARADOR -->
            <hr class="sidebar-divider">

            <!-- ENCABEZADO - CLIENTES Y STAFF -->
            <div class="sidebar-heading">
                Clientes y Staff
            </div>

            <!-- ELEMENTO DE NAVEGACIÓN - CLIENTES -->
            <li class="nav-item">
                <a class="nav-link" href="clients.php">
                    <i class="far fa-address-card"></i>
                    <span>Clientes</span>
                </a>
            </li>

            <!-- SEPARADOR -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- BOTÓN PARA COLAPSAR LA BARRA LATERAL -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- FIN DE LA BARRA LATERAL -->

        <!-- CONTENEDOR DEL CONTENIDO -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- CONTENIDO PRINCIPAL -->
            <div id="content">

                <!-- BARRA SUPERIOR -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- BOTÓN PARA COLAPSAR LA BARRA LATERAL EN DISPOSITIVOS PEQUEÑOS -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- BARRA DE NAVEGACIÓN SUPERIOR -->
                    <ul class="navbar-nav ml-auto">
                        <!-- ELEMENTO DE NAVEGACIÓN - VISUALIZAR WEB -->
                        <li class="nav-item">
                            <a class="nav-link" href="../" target="_blank">
                                <i class="far fa-eye"></i>
                                <span style="margin-left: 5px;">Web</span>
                            </a>
                        </li>

                        <!-- SEPARADOR -->
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- ELEMENTO DE NAVEGACIÓN - INFORMACIÓN DEL USUARIO -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php
                                    echo $_SESSION["nombre"] . " " . $_SESSION["apellido"];
                                    ?>
                                </span>
                                <i class="fas fa-caret-down"></i>
                            </a>

                            <!-- MENÚ DESPLEGABLE - OPCIONES DEL USUARIO -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="registro.php">
                                    <i class="fas fa-user-plus fa-sm fa-fw mr-2 text-gray-400"></i>Nuevo Admin
                                </a>
                                <a class="dropdown-item" href="../controlador/controlador_cerrar_seccion.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- FIN DE LA BARRA SUPERIOR -->
