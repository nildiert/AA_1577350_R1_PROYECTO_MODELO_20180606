<?php
//@session_start();
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
if (isset($_GET['erroresValidacion'])) {
    $erroresValidacion = json_decode($_GET['erroresValidacion'], true); //true para que convierta un json a "array" y no a objeto
}
?>        
<div class="panel-heading">
    <h3 class="panel-title">Inserción de Usuarios.</h3>
</div>
<form role="form" method="POST" action="controladores/ControladorPrincipal.php" id="formRegistro">
    <table>
        <fieldset>
            <tr>
                <td>
                    <input class="form-control" placeholder="Documento" name="documento" type="number" pattern="" required="required" autofocus
                           value="<?php if (isset($erroresValidacion['datosViejos']['documento'])) echo $erroresValidacion['datosViejos']['documento'];  
                                                if (isset($_SESSION['documento'])) echo $_SESSION['documento']; unset($_SESSION['documento']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['documento'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['documento'] . "</font>"; ?>
                           <?php if (isset($erroresValidacion['mensajesError']['documento'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['documento'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->
                </td>
            </tr>
            <tr>
                <td>                
                    <input class="form-control" placeholder="Nombres" name="nombre" type="text"   required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['nombre'])) echo $erroresValidacion['datosViejos']['nombre'];  
                                                if (isset($_SESSION['nombre'])) echo $_SESSION['nombre']; unset($_SESSION['nombre']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['nombre'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['nombre'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['nombre'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['nombre'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->
                </td>
            </tr>
            <tr>
                <td>                  
                    <input class="form-control" placeholder="Apellidos" name="apellidos" type="text"  required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['apellidos'])) echo $erroresValidacion['datosViejos']['apellidos']; 
                                                if (isset($_SESSION['apellidos'])) echo $_SESSION['apellidos']; unset($_SESSION['apellidos']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['apellidos'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['apellidos'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['apellidos'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['apellidos'] . "</font>"; ?>                                        
                </td>
            </tr>                  
            <tr>
                <td>                   
                    <input id="InputCorreo" class="form-control" placeholder="Correo Electrónico" name="email" type="email"  required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['email'])) echo $erroresValidacion['datosViejos']['email'];  
                                                if (isset($_SESSION['email'])) echo $_SESSION['email']; unset($_SESSION['email']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['email'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['email'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['email'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['email'] . "</font>"; ?>                                        
                </td>
            </tr>                 
            <tr>
                <td>                
                    <input id="InputPassword" class="form-control" placeholder="Password" name="password" type="password" value=""  required="required">
                </td>
            </tr>                 
            <tr>
                <td>                 
                    <input id="InputPassword2" class="form-control" placeholder="Confirmar Password" name="password2" type="password" value="">
                </td>
            </tr>                 
            <input type="hidden" name="ruta" value="insertarUsuario_s">
            <!--<input type="hidden" name="contenido" value="controlarRegistro">-->
            <tr>
                <td>            
                    <button  onclick="valida_registro()">Registrar</button>
                </td>
            </tr>             
    </table>
</form>
<?php if (isset($erroresValidacion)) $erroresValidacion = NULL; ?>




























