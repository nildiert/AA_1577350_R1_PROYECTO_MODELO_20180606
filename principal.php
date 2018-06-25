<?php session_start();  ?>
<?php
include_once './controladores/ManejoSesiones/BloqueDeSeguridad.php';
$seguridad = new BloqueDeSeguridad();
$seguridad->seguridad("login.php");

?>
<!DOCTYPE html>
<html lang="en">
 
<head>
<title>KSQ DIGITAL</title>
<div class="container">
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php
                        if (isset($_SESSION['mensaje'])) {
                            $mensaje = $_SESSION['mensaje'];
                        // echo "<script type=\"text/javascript\">alert('" . $mensaje . "')</script>";
                         echo " . $mensaje . ";
                            unset($_SESSION['mensaje']);
                            
                        }
                        ?>   
            </div>                
        </div>         
    </div>
</div>    
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

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
        <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                         <span><img src="" alt="quimicos" class="" style="color: #255E7D" /></span>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <b><img src="" alt="serch" class="dark-logo" style="color: #51C0B0" /></b>
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        
                        <!-- Messages -->
                        
                            <div class="dropdown-menu animated zoomIn">
                            </div>
                        </li>
                        <!-- End Messages -->
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">

                        <!-- Search -->
                        <li hidden class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search here"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li>
                        <!-- Comment -->
                        <li class="nav-item dropdown">
                            
							
							</a>
                            
                        </li>
                        <!-- End Comment -->
                        <!-- Messages -->
                        <li class="nav-item dropdown">
                            
								<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
							</a>
                        </li>
                        <!-- End Messages -->
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <?php
  //                          print_r($_SESSION);
                        ?>
                            <a class="nav-link dropdown-toggle text-muted   " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/users/5.jpg" alt="<?php echo "Bienvenido ".$_SESSION['datosUsuario']->perNombre." ".$_SESSION['datosUsuario']->perApellido; ?>
                                                                 "/></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">                                
                                    <li><a href="controladores/ControladorPrincipal.php?ruta=cerrarSesion"><i class="fa fa-power-off"></i> Cerrar sesión</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                <!--                        <li class="nav-label">PROYECTO BASE </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Gestión de Libros <span ></span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="controladores/ControladorPrincipal.php?ruta=listarLibros">Listado de libros </a></li>
                                <li><a href="controladores/ControladorPrincipal.php?ruta=mostrarInsertarLibros">Agregar Libros</a></li>
                                <li><a href="controladores/ControladorPrincipal.php?ruta=actualizarLibro">Actualizar Libros</a></li>
                                
                            </ul>
                        </li>-->
                        <li class="nav-label">KSQ DIGITAL</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="true"><i class="fa fa-shopping-bag"></i><span class="hide-menu">Ventas</span></a>
                            <ul aria-expanded="true" class="collapse">
                                <li><a href="controladores/ControladorPrincipal.php?ruta=listarOrdProd">Listado de Ventas</a></li>
                                <li><a onclick="javascript:location.href = 'principal.php?contenido=vistas/vistasOrdProd/vistaInsertarOrdProd.php'">Agregar Venta</a></li>
                                

                            </ul>
                        </li>                        
                        <li> <a class="has-arrow  " href="#" aria-expanded="true"><i class="fa fa-archive"></i><span class="hide-menu">Productos</span></a>
                            <ul aria-expanded="true" class="collapse">
                                <li><a href="controladores/ControladorPrincipal.php?ruta=listarProductos">Listado de Productos</a></li>
                                <li><a onclick="javascript:location.href = 'principal.php?contenido=vistas/vistasProductos/vistaInsertarProductos.php'">Agregar Productos</a></li>
                                

                            </ul>
                        </li>                        
                        <li> <a class="has-arrow  " href="#" aria-expanded="true"><i class="fa fa-spinner"></i><span class="hide-menu">Insumos</span></a>
                            <ul aria-expanded="true" class="collapse">
                                <li><a href="controladores/ControladorPrincipal.php?ruta=listarInsumos">Listado de Insumos</a></li>
                                <li><a onclick="javascript:location.href = 'principal.php?contenido=vistas/vistasInsumos/vistaInsertarInsumos.php'">Agregar Insumos</a></li>
                                

                            </ul>
                        </li>
                        
                        
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3> </div>
                
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                
            <main style="">
                <?php
                if (isset($_GET['contenido'])) {
                    include($_GET['contenido']);
                }
                ?>   
            </main>    
                <div class="row">
                    <div class="col-md-3">
                        
                    </div>

                </div>

                <div class="row bg-white m-l-0 m-r-0 box-shadow ">


                </div>
                
                

            


                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class=""></a></footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>


    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="plantillas/ElaAdmin/js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="plantillas/ElaAdmin/js/lib/bootstrap/js/popper.min.js"></script>
    <script src="plantillas/ElaAdmin/js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="plantillas/ElaAdmin/js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="plantillas/ElaAdmin/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="plantillas/ElaAdmin/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->


    <!-- Amchart -->
     <script src="plantillas/ElaAdmin/js/lib/morris-chart/raphael-min.js"></script>
    <script src="plantillas/ElaAdmin/js/lib/morris-chart/morris.js"></script>
    <script src="plantillas/ElaAdmin/js/lib/morris-chart/dashboard1-init.js"></script>


	<script src="plantillas/ElaAdmin/js/lib/calendar-2/moment.latest.min.js"></script>
    <!-- scripit init-->
    <script src="plantillas/ElaAdmin/js/lib/calendar-2/semantic.ui.min.js"></script>
    <!-- scripit init-->
    <script src="plantillas/ElaAdmin/js/lib/calendar-2/prism.min.js"></script>
    <!-- scripit init-->
    <script src="plantillas/ElaAdmin/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <!-- scripit init-->
    <script src="plantillas/ElaAdmin/js/lib/calendar-2/pignose.init.js"></script>

    <script src="plantillas/ElaAdmin/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="plantillas/ElaAdmin/js/lib/owl-carousel/owl.carousel-init.js"></script>

    <!-- scripit init-->

    <script src="plantillas/ElaAdmin/js/scripts.js"></script>

</body>


</html>