<?php
//@session_start();
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
if (isset($_SESSION['registroCategoriasInsumos'])) {   /***************************/
    $registroCategoriasInsumos = $_SESSION['registroCategoriasInsumos'];
    $cantCategorias=count($registroCategoriasInsumos);
}
if (isset($_GET['erroresValidacion'])) {
    $erroresValidacion = json_decode($_GET['erroresValidacion'], true); //true para que convierta un json a "array" y no a objeto
}
?>        

<div class="d-flex justify-content-center  mb-3">
    <div class="card col-lg-3 ">

        <div class="card-title">
            <h3 class="panel-title">Agregar Insumo</h3>
        </div>



<form role="form" method="POST" action="controladores/ControladorPrincipal.php" id="formRegistro">

                    <input class="form-control" placeholder="InsCodigo" name="InsCodigo" type="text"  required="required" autofocus
                           value="<?php if (isset($erroresValidacion['datosViejos']['InsCodigo'])) echo $erroresValidacion['datosViejos']['InsCodigo'];  
                                                if (isset($_SESSION['InsCodigo'])) echo $_SESSION['InsCodigo']; unset($_SESSION['InsCodigo']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['InsCodigo'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['InsCodigo'] . "</font>"; ?>
                           <?php if (isset($erroresValidacion['mensajesError']['InsCodigo'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['InsCodigo'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->
<br>
                    <input class="form-control" placeholder="InsNombre" name="InsNombre" type="text"   required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['InsNombre'])) echo $erroresValidacion['datosViejos']['InsNombre'];  
                                                if (isset($_SESSION['InsNombre'])) echo $_SESSION['InsNombre']; unset($_SESSION['InsNombre']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['InsNombre'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['InsNombre'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['InsNombre'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['InsNombre'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->
                    <br>
                    <input class="form-control" placeholder="InsCantActual" name="InsCantActual" type="text"  required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['InsCantActual'])) echo $erroresValidacion['datosViejos']['InsCantActual']; 
                                                if (isset($_SESSION['InsCantActual'])) echo $_SESSION['InsCantActual']; unset($_SESSION['InsCantActual']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['InsCantActual'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['InsCantActual'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['InsCantActual'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['InsCantActual'] . "</font>"; ?>                                        
                           <br>
                    <input class="form-control" placeholder="InsUnidadMedida" name="InsUnidadMedida" type="text"  required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['InsUnidadMedida'])) echo $erroresValidacion['datosViejos']['InsUnidadMedida']; 
                                                if (isset($_SESSION['InsUnidadMedida'])) echo $_SESSION['InsUnidadMedida']; unset($_SESSION['InsUnidadMedida']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['InsUnidadMedida'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['InsUnidadMedida'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['InsUnidadMedida'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['InsUnidadMedida'] . "</font>"; ?>                                        
                           <br>
            <input  type="hidden" name="ruta" value="insertarInsumos">
            <!--<input type="hidden" name="contenido" value="controlarRegistro">-->

                    <button class="btn btn-info m-b-10 m-l-5 m-30" onclick="valida_registro()">Agregar Insumos</button>

</form>
<?php if (isset($erroresValidacion)) $erroresValidacion = NULL; ?>




</div>
    


    </div>
    
    
        