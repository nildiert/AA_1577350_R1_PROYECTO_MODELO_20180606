<?PHP
session_start();
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
?>
<!DOCTYPE html>
<html>
    <head>

        <title>
            KSQ DIGITAL
        </title>
        <meta charset="utf-8">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="plantillas/ejemplo-master/login.css">
        <script src="plantillas/ejemplo-master/login.js"></script>
        <script type="text/javascript" src="javascript/funciones.js"></script>
        <script type="text/javascript" src="javascript/md5.js"></script>     
    </head>

    <body>





        <!------ Include the above in your HEAD tag ---------->

        <!--
            you can substitue the span of reauth email for a input with the email and
            include the remember me checkbox
        -->
        <div class="container">
            <div class="card card-container">
                <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                <p id="profile-name" class="profile-name-card"></p>
                <form class="form-signin"  method="GET" action="controladores/ControladorPrincipal.php" name="formLogin">
                    <input type="hidden" name="ruta" value="gestionDeAcceso">
                    <input type="hidden" name="contenido" value="controlarLogin">                
                    <span id="reauth-email" class="reauth-email"></span>
                    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Usuario" required autofocus>
                    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
                    <div id="remember" class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me"> Recordar esta contraseña
                        </label>
                    </div>
                    <!--<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Ingresar</button>--> 
                    <input type="button" class="btn btn-lg btn-success btn-block" onclick="validar_logueo()" value="Ingresar">
                    <!--<input type="submit" class="btn btn-lg btn-success btn-block"  value="Ingresar">-->
                
                
                </form><!-- /form -->
                <a href="registro.php" class="forgot-password">
                    Registrese Aquí
                </a>
            </div><!-- /card-container -->
        </div><!-- /container -->
    </body>
</html>