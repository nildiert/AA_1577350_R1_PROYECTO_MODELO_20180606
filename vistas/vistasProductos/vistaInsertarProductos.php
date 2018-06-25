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

<div class="d-flex justify-content-center  mb-3">
    <div class="card col-lg-3 ">

        <div class="card-title">
            <h3 class="panel-title">Agregar Producto</h3>
        </div>



<form role="form" method="POST" action="controladores/ControladorPrincipal.php" id="formRegistro">

                    <input class="form-control" placeholder="ProCodigo" name="ProCodigo" type="text"  required="required" autofocus
                           value="<?php if (isset($erroresValidacion['datosViejos']['ProCodigo'])) echo $erroresValidacion['datosViejos']['ProCodigo'];  
                                                if (isset($_SESSION['ProCodigo'])) echo $_SESSION['ProCodigo']; unset($_SESSION['ProCodigo']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['ProCodigo'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['ProCodigo'] . "</font>"; ?>
                           <?php if (isset($erroresValidacion['mensajesError']['ProCodigo'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['ProCodigo'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->
<br>
                    <input class="form-control" placeholder="ProNombre" name="ProNombre" type="text"   required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['ProNombre'])) echo $erroresValidacion['datosViejos']['ProNombre'];  
                                                if (isset($_SESSION['ProNombre'])) echo $_SESSION['ProNombre']; unset($_SESSION['ProNombre']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['ProNombre'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['ProNombre'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['ProNombre'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['ProNombre'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->
                    <br>
                    <input class="form-control" placeholder="ProPresentacion" name="ProPresentacion" type="text"  required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['ProPresentacion'])) echo $erroresValidacion['datosViejos']['ProPresentacion']; 
                                                if (isset($_SESSION['ProPresentacion'])) echo $_SESSION['ProPresentacion']; unset($_SESSION['ProPresentacion']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['ProPresentacion'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['ProPresentacion'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['ProPresentacion'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['ProPresentacion'] . "</font>"; ?>                                        
                           <br>
                    <input class="form-control" placeholder="ProPrecioBogota" name="ProPrecioBogota" type="text"  required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['ProPrecioBogota'])) echo $erroresValidacion['datosViejos']['ProPrecioBogota']; 
                                                if (isset($_SESSION['ProPrecioBogota'])) echo $_SESSION['ProPrecioBogota']; unset($_SESSION['ProPrecioBogota']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['ProPrecioBogota'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['ProPrecioBogota'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['ProPrecioBogota'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['ProPrecioBogota'] . "</font>"; ?>                                        
                           <br>
                    <input class="form-control" placeholder="ProPrecioNacional" name="ProPrecioNacional" type="text"  required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['ProPrecioNacional'])) echo $erroresValidacion['datosViejos']['ProPrecioNacional']; 
                                                if (isset($_SESSION['ProPrecioNacional'])) echo $_SESSION['ProPrecioNacional']; unset($_SESSION['ProPrecioNacional']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['ProPrecioNacional'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['ProPrecioNacional'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['ProPrecioNacional'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['ProPrecioNacional'] . "</font>"; ?>                                        
                           <br>
                    <input class="form-control" placeholder="ProMaquila" name="ProMaquila" type="text"  required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['ProMaquila'])) echo $erroresValidacion['datosViejos']['ProMaquila']; 
                                                if (isset($_SESSION['ProMaquila'])) echo $_SESSION['ProMaquila']; unset($_SESSION['ProMaquila']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['ProMaquila'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['ProMaquila'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['ProMaquila'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['ProMaquila'] . "</font>"; ?>                                        
                           <br>
            <input  type="hidden" name="ruta" value="insertarProductos">
            <!--<input type="hidden" name="contenido" value="controlarRegistro">-->

                    <button class="btn btn-info m-b-10 m-l-5 m-30" onclick="valida_registro()">Agregar Producto</button>

</form>
<?php if (isset($erroresValidacion)) $erroresValidacion = NULL; ?>




</div>
    


    </div>
    
    
        