

<?php
//@session_start();
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
if (isset($_SESSION['actualizarDatosInsumos'])) {
    $actualizarDatosInsumos = $_SESSION['actualizarDatosInsumos'];
    unset($_SESSION['actualizarInsumos']);
}
if (isset($_SESSION['registroCategoriasInsumos'])) { /* * ************************ */
    $registroCategoriasInsumos = $_SESSION['registroCategoriasInsumos'];
    $cantCategorias = count($registroCategoriasInsumos);
}
if (isset($_GET['erroresValidacion'])) {
    $erroresValidacion = json_decode($_GET['erroresValidacion'], true); //true para que convierta un json a "array" y no a objeto
}
?>  





<div class="d-flex justify-content-center  mb-3">
    <div class="card col-lg-3 ">

        <div class="card-title">
            <h3 class="panel-title">Actualización de Insumos</h3>
        </div>

    <form role="form" method="POST" action="controladores/ControladorPrincipal.php" id="formRegistro">

            

        


                        <input class="form-control" placeholder="InsCodigo" name="InsCodigo" type="TEXT" pattern="" required="required" autofocus readonly="readonly"
                            value="<?php
                            if (isset($actualizarDatosInsumos->InsCodigo))
                                echo $actualizarDatosInsumos->InsCodigo;
                            if (isset($erroresValidacion['datosViejos']['InsCodigo']))
                                echo $erroresValidacion['datosViejos']['InsCodigo'];
                            if (isset($_SESSION['InsCodigo']))
                                echo $_SESSION['InsCodigo'];
                            unset($_SESSION['InsCodigo']);
                            ?>">
                                <?php if (isset($erroresValidacion['marcaCampo']['InsNombre'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['InsNombre'] . "</font>"; ?>
                                <?php if (isset($erroresValidacion['mensajesError']['InsNombre'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['InsNombre'] . "</font>"; ?>                                        
                        <!--<p class="help-block">Example block-level help text here.</p>-->
                        <br>
                        <input class="form-control" placeholder="InsNombre" name="InsNombre" type="text"   required="required"
                            value="<?php
                            if (isset($actualizarDatosInsumos->InsNombre))
                                echo $actualizarDatosInsumos->InsNombre;                           
                            if (isset($erroresValidacion['datosViejos']['InsNombre']))
                                echo $erroresValidacion['datosViejos']['InsNombre'];
                            if (isset($_SESSION['InsNombre']))
                                echo $_SESSION['InsNombre'];
                            unset($_SESSION['InsNombre']);
                            ?>">
                                <?php if (isset($erroresValidacion['marcaCampo']['InsNombre'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['InsNombre'] . "</font>"; ?>                                        
                                <?php if (isset($erroresValidacion['mensajesError']['InsNombre'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['InsNombre'] . "</font>"; ?>                                        
                        <!--<p class="help-block">Example block-level help text here.</p>-->
                 <br>
                        <input class="form-control" placeholder="InsCantActual" name="InsCantActual" type="text"  required="required"
                            value="<?php
                            if (isset($actualizarDatosInsumos->InsCantActual))
                                echo $actualizarDatosInsumos->InsCantActual;                            
                            if (isset($erroresValidacion['datosViejos']['InsCantActual']))
                                echo $erroresValidacion['datosViejos']['InsCantActual'];
                            if (isset($_SESSION['InsCantActual']))
                                echo $_SESSION['InsCantActual'];
                            unset($_SESSION['InsCantActual']);
                            ?>">
                            <?php if (isset($erroresValidacion['marcaCampo']['InsCantActual'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['InsCantActual'] . "</font>"; ?>                                        
                            <?php if (isset($erroresValidacion['mensajesError']['InsCantActual'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['InsCantActual'] . "</font>"; ?>                                        
                            <br>
                        <input class="form-control" placeholder="InsUnidadMedida" name="InsUnidadMedida" type="text"  required="required"
                            value="<?php
                            if (isset($actualizarDatosInsumos->InsUnidadMedida))
                                echo $actualizarDatosInsumos->InsUnidadMedida;                            
                            if (isset($erroresValidacion['datosViejos']['InsUnidadMedida']))
                                echo $erroresValidacion['datosViejos']['InsUnidadMedida'];
                            if (isset($_SESSION['InsUnidadMedida']))
                                echo $_SESSION['InsUnidadMedida'];
                            unset($_SESSION['InsUnidadMedida']);
                            ?>">
                            <?php if (isset($erroresValidacion['marcaCampo']['InsUnidadMedida'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['InsUnidadMedida'] . "</font>"; ?>                                        
                            <?php if (isset($erroresValidacion['mensajesError']['InsUnidadMedida'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['InsUnidadMedida'] . "</font>"; ?>                                        
                            <br>
                        <input class="form-control" placeholder="InsPrecio" name="InsPrecio" type="number"  required="required"
                            value="<?php
                            if (isset($actualizarDatosInsumos->InsPrecio))
                                echo $actualizarDatosInsumos->InsPrecio;                            
                            if (isset($erroresValidacion['datosViejos']['InsPrecio']))
                                echo $erroresValidacion['datosViejos']['InsPrecio'];
                            if (isset($_SESSION['InsPrecio']))
                                echo $_SESSION['InsPrecio'];
                            unset($_SESSION['InsPrecio']);
                            ?>">
                            <?php if (isset($erroresValidacion['marcaCampo']['InsPrecio'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['InsPrecio'] . "</font>"; ?>                                        
                            <?php if (isset($erroresValidacion['mensajesError']['InsPrecio'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['InsPrecio'] . "</font>"; ?>                                        
          
                            <br>
                <input type="hidden" name="ruta" value="confirmaActualizarInsumos">
                <!--<input type="hidden" name="contenido" value="controlarRegistro">-->
                 
                        <!--<button  onclick="valida_registro()">Actualizar </button>-->
                        <button class="btn btn-info m-b-10 m-l-5 m-30" type="submit" >Actualizar Insumos</button>

    </form>
    <?php if (isset($erroresValidacion)) $erroresValidacion = NULL; ?>
    </div>
    


</div>


    