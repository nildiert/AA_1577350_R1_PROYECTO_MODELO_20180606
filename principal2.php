<?php session_start();  ?>
<?php
//plantilla
//include_once './controladores/ManejoSesiones/BloqueDeSeguridad.php';
//$seguridad = new BloqueDeSeguridad();
//$seguridad->seguridad("login.php");
?>
 
<!DOCTYPE html>
<html>
    <head>
    <title>KSQ DIGITAL</title>
        <?php
        if (isset($_SESSION['mensaje'])) {
            $mensaje = $_SESSION['mensaje'];
            echo "<script type=\"text/javascript\">alert('" . $mensaje . "')</script>";
            unset($_SESSION['mensaje']);
        }
        ?>        
           <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <!--<link rel="icon" type="plantillas/ElaAdmin/image/png" sizes="16x16" href="plantillas/ElaAdmin/images/favicon.png">-->
    
    <!-- Bootstrap Core CSS -->
    <link href="plantillas/ElaAdmin/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->

    <link href="plantillas/ElaAdmin/css/lib/calendar2/semantic.ui.min.css" rel="stylesheet">
    <link href="plantillas/ElaAdmin/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="plantillas/ElaAdmin/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="plantillas/ElaAdmin/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="plantillas/ElaAdmin/css/helper.css" rel="stylesheet">
    <link href="plantillas/ElaAdmin/css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
    <body fix-header fix-sidebar >
            <!-- Preloader - style you can find in spinners.css -->
            <!--<div class="preloader">
                <svg class="circular" viewBox="25 25 50 50">
			        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
            </div>-->
        <div id="main-wrapper">

            <div class="header">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                    <span><img src="" alt="quimicos" class="" style="color: #255E7D" /></span>
                    <b><img src="" alt="serch" class="dark-logo" style="color: #51C0B0" /></b>
                    </a>
                </div>      
            <div class="navbar-collapse">     
                <ul class="navbar-nav mr-auto mt-md-0">         
                    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <div class="dropdown-menu animated zoomIn">
                                        <ul class="mega-dropdown-menu row">
                                            <li class="col-lg-3  m-b-30">
                                            </li>
                                        </ul>
                        </div>
                    </li>
                </ul>
            </div>
            
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/users/5.jpg" alt="Usuario" class="profile-pic" /></a>
                    <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                        <ul class="dropdown-user">                                
                            <li><a href="controladores/ControladorPrincipal.php?ruta=cerrarSesion"><i class="fa fa-power-off"></i> Cerrar sesión</a></li>
                        </ul>
                    </div>
                </li>
            </ul>


                




            <header>
                <div id="menu1">
                    <ul id="lista">
                        <li><a href="index.html" >HOME</a></li>
                        <li><?php echo "Bienvenido ".$_SESSION['datosUsuario']->perNombre." ".$_SESSION['datosUsuario']->perApellido."   "; ?></li>
                        <li><a <a href="controladores/ControladorPrincipal.php?ruta=cerrarSesion">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </header>
            <aside id="left">
                <img src="imagenes/logo.png">
                <a href="principal.php">Tablero de Funciones</a>
                <!-- start nav -->
                <nav id="menu">
                    <!-- start menu -->
                    <ul>
                        <li><a href="#">Gestión de TablaX1</a></li>
                        <li><a href="#">Gestión de Libros</a>
                            <ul>
                                <li><a href="controladores/ControladorPrincipal.php?ruta=listarLibros">Listado de Libros</a></li>
                                <?php if (isset($_SESSION['rolesEnSesion']) && in_array(1, $_SESSION['rolesEnSesion'])){?>
                                <li><a href="controladores/ControladorPrincipal.php?ruta=mostrarInsertarLibros">Agregar Libros</a></li>
                                <?php } ?>                                
                            </ul>
                        </li>
                        <li><a href="#">Gestión de Insumos</a>
                            <ul>
                                <li><a href="controladores/ControladorPrincipal.php?ruta=listarInsumos">Listado de Insumos</a></li>
                                <li><a href="principal.php?contenido=vistas/vistasInsumos/vistaInsertarInsumos.php">Agregar Insumos</a></li>
                            </ul>
                        <li><a href="#">Gestión de TablaX3</a></li>
                        <li><a href="#">Gestión de TablaX4</a></li>
                        <li><a href="#">Gestión de TablaX5</a></li>
                    </ul>
                    <!-- end menu -->
                </nav>
                <!-- end nav -->                
            </aside>
            <main style="background-color: #dadada;">
                <?php
                /*echo "<pre>";
                print_r($_SESSION);
                echo "</pre>";*/
                if (isset($_GET['contenido'])) {
                    include($_GET['contenido']);
                }
                ?>   
            </main>
<!--            <footer>Ficha 1577350 R1</footer>-->

        </div>
    </body>
</html>

