<?PHP
session_start();
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
?>
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
    <div class="container-login100">
            <div class="wrap-login100">        
        <form class="login100-form validate-form " role="form" method="POST" action="controladores/ControladorPrincipal.php" name="formLogin">


<span class="login100-form-title p-b-34">
				Ingreso de usuarios
            </span>
            <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">            
                <input id="InputCorreo" class="input100" placeholder="Correo Electrónico" name="email" type="email" autofocus>
                <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
                <input id="InputPassword" class="input100" placeholder="Password" name="password" type="password" value="">
                <span class="focus-input100"></span>
                <input type="hidden" name="ruta" value="gestionDeAcceso">
                <input type="hidden" name="contenido" value="controlarLogin">
            <!--<p style="color:red;" id="error"></p>-->
            </div>            

            <div class="container-login100-form-btn">
                <!--<input type="button" class="login100-form-btn" onclick="validar_logueo()" value="Ingresar">-->
                <!--<input type="button" class="login100-form-btn" onclick="javascript:document.formLogin.submit();" value="Ingresar">-->
                <input type="submit" class="login100-form-btn" onclick="validar_logueo()" value="Ingresar">
            </div>
            <div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
					
						</span>

						<a href="#" class="txt2">
					
						</a>
                    </div>
                    <div class="w-full text-center">
						<a href="#" class="txt3">
					
						</a>
					</div>                    
    </form>
    <div class="login100-more" style="background-image: url('plantillas/Login_v17/images/bg-01.jpg');"></div>
			</div>
    </div>
</div>
</body>
</html>
