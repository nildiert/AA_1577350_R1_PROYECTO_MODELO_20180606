<?php
session_start();
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
if (isset($_GET['erroresValidacion'])) {
    $erroresValidacion = json_decode($_GET['erroresValidacion'], true); //true para que convierta un json a "array" y no a objeto
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
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

        <title>Ksq Digital</title>
        <!-- Funciones JavaScript propias del sistema -->
        <script type="text/javascript" src="javascript/funciones.js"></script>
        <!-- Funciones JavaScript propias del sistema -->
        <script type="text/javascript" src="javascript/md5.js"></script>    
    </head>
    <body>
        <div class="card">
        <div class="card">
            <h3 class="panel-title">Datos básicos de Registro</h3>
        </div>
        <div class="container">
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <form method="POST" action="controladores/ControladorPrincipal.php" id="formRegistro">
                <fieldset>
                    <div>
                        <input placeholder="Documento" name="documento" type="number" pattern="" required="required" autofocus
                               value="<?php
                               if (isset($erroresValidacion['datosViejos']['documento']))
                                   echo $erroresValidacion['datosViejos']['documento'];
                               if (isset($_SESSION['documento']))
                                   echo $_SESSION['documento'];
                               unset($_SESSION['documento']);
                               ?>"
                               >
                               <?php
                               if (isset($erroresValidacion['marcaCampo']['documento']))
                                   echo "<font color='red'>" . $erroresValidacion['marcaCampo']['documento'] . "</font>";
                               ?>
                               <?php
                               if (isset($erroresValidacion['mensajesError']['documento']))
                                   echo "<font color='red'>" . $erroresValidacion['mensajesError']['documento'] . "</font>";
                               ?>                                        
                    </div>
                    <div>
                        <input placeholder="Nombres" name="nombre" type="text"   required="required"
                               value="<?php
                               if (isset($erroresValidacion['datosViejos']['nombre']))
                                   echo $erroresValidacion['datosViejos']['nombre'];
                               if (isset($_SESSION['nombre']))
                                   echo $_SESSION['nombre'];
                               unset($_SESSION['nombre']);
                               ?>"
                               >
                               <?php
                               if (isset($erroresValidacion['marcaCampo']['nombre']))
                                   echo "<font color='red'>" . $erroresValidacion['marcaCampo']['nombre'] . "</font>";
                               ?>                                        
                               <?php
                               if (isset($erroresValidacion['mensajesError']['nombre']))
                                   echo "<font color='red'>" . $erroresValidacion['mensajesError']['nombre'] . "</font>";
                               ?>
                    </div>
                    <div>
                        <input placeholder="Apellidos" name="apellidos" type="text"  required="required" 
                               value="<?php
                               if (isset($erroresValidacion['datosViejos']['apellidos']))
                                   echo $erroresValidacion['datosViejos']['apellidos'];
                               if (isset($_SESSION['apellidos']))
                                   echo $_SESSION['apellidos'];
                               unset($_SESSION['apellidos']);
                               ?>"
                               >
                               <?php
                               if (isset($erroresValidacion['marcaCampo']['apellidos']))
                                   echo "<font color='red'>" . $erroresValidacion['marcaCampo']['apellidos'] . "</font>";
                               ?>
                               <?php
                               if (isset($erroresValidacion['mensajesError']['apellidos']))
                                   echo "<font color='red'>" . $erroresValidacion['mensajesError']['apellidos'] . "</font>";
                               ?>
                    </div>
                    <div>
                        <input id="InputCorreo" placeholder="Correo Electrónico" name="email" type="email"  required="required"
                               value="<?php
                               if (isset($erroresValidacion['datosViejos']['email']))
                                   echo $erroresValidacion['datosViejos']['email'];
                               if (isset($_SESSION['email']))
                                   echo $_SESSION['email'];
                               unset($_SESSION['email']);
                               ?>"
                               >
                               <?php
                               if (isset($erroresValidacion['marcaCampo']['email']))
                                   echo "<font color='red'>" . $erroresValidacion['marcaCampo']['email'] . "</font>";
                               ?>
                               <?php
                               if (isset($erroresValidacion['mensajesError']['email']))
                                   echo "<font color='red'>" . $erroresValidacion['mensajesError']['email'] . "</font>";
                               ?>
                    </div>
                    <div>
                        <input id="InputPassword" placeholder="Password" name="password" type="password" value=""  required="required">
                    </div>
                    <div>
                        <input id="InputPassword2" class="form-control" placeholder="Confirmar Password" name="password2" type="password" value="">
                    </div>
                    <input type="hidden" name="ruta" value="gestionDeRegistro">
                    <input type="hidden" name="contenido" value="controlarRegistro">
                    <button onclick="valida_registro()">Registrar</button>
                </fieldset>
                <div>
                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                        Ya está registrado? 
                        <a href="login.php">
                            Ingrese Aquí
                        </a>
                    </div>
                </div>
            </form>
            <?php
            if (isset($erroresValidacion))
                $erroresValidacion = NULL;
            ?>
        </div>
        </div>
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
    </div>
    </body>
</html>
