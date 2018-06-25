
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Su Proyecto</title>
        <script type="text/javascript" src="javascript/funciones.js"></script>
        <script type="text/javascript" src="javascript/md5.js"></script>      
        
        <link rel="icon" type="image/png" href="plantillas/Login_v17/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plantillas/Login_v17/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plantillas/Login_v17/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plantillas/Login_v17/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plantillas/Login_v17/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="plantillas/Login_v17/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plantillas/Login_v17/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plantillas/Login_v17/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="plantillas/Login_v17/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="plantillas/Login_v17/css/util.css">
	<link rel="stylesheet" type="text/css" href="plantillas/Login_v17/css/main.css">

    </head>
    <body>
<div class="row d-flex justify-content-center">
        <form class="card " role="form" method="GET" action="controladores/ControladorPrincipal.php" name="formLogin">
            
            <span class="login100-form-title p-b-34">
                Registro de usuarios
                
                
            </span>
            <div class="validate-input m-b-20" data-validate="Type user name">            
            <input class="wrap-input100 input100" placeholder="Documento" name="documento" type="number" pattern="" required="required" autofocus
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
                               <span class="focus-input100"></span>                                   
            
            </div>
            <div class="wrap-input100  validate-input m-b-20" data-validate="Type user name">            
                             <input class="input100" placeholder="Nombres" name="nombre" type="text"   required="required"
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
                               <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100  validate-input m-b-20" data-validate="Type user name">            
                        <input class="input100" placeholder="Apellidos" name="apellidos" type="text"  required="required" 
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
                               <span class="focus-input100"></span>
            </div>                               
            <div class="wrap-input100  validate-input m-b-20" data-validate="Type user name">            
                        <input class="input100" id="InputCorreo" placeholder="Correo Electrónico" name="email" type="email"  required="required"
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
                               <span class="focus-input100"></span>
            </div>                               
                               

                
            
            <div class="wrap-input100  validate-input m-b-20" data-validate="Type password">
            <input class="input100" id="InputPassword" placeholder="Password" name="password" type="password" value=""  required="required">
            <span class="focus-input100"></span>
            </div>            
            <div class="wrap-input100 validate-input m-b-20" data-validate="Type password">
            <input class="input100" id="InputPassword2" class="form-control" placeholder="Confirmar Password" name="password2" type="password" value="">            

                <span class="focus-input100"></span>
                <input type="hidden" name="ruta" value="gestionDeRegistro">
                    <input type="hidden" name="contenido" value="controlarRegistro">

            <!--<p style="color:red;" id="error"></p>-->
            </div>            

            <div class="container-login100-form-btn">
                <!--<input type="button" class="login100-form-btn" onclick="validar_logueo()" value="Ingresar">-->
                <!--<input type="button" class="login100-form-btn" onclick="javascript:document.formLogin.submit();" value="Ingresar">-->
                <button class="login100-form-btn" onclick="valida_registro()">Registrar</button>
            </div>
            <div class="w-full text-center p-t-27 p-b-10">
						<span class="txt1">
					
						</span>

						<a href="#" class="txt2">
					
						</a>
                    </div>
                    <div class="w-full text-center">
						<a href="#" class="txt3">
					
						</a>
					</div>                    
			</div>
    </form>
    
    </div>

</body>
</html>
