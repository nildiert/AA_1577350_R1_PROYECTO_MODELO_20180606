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
            <h3 class="panel-title">Agregar venta</h3>
 </div>



<form role="form" method="POST" action="controladores/ControladorPrincipal.php" id="formRegistro">

                    <input class="form-control" placeholder="OrdPId" name="OrdPId" type="text"  required="required" autofocus
                           value="<?php if (isset($erroresValidacion['datosViejos']['OrdPId'])) echo $erroresValidacion['datosViejos']['OrdPId'];  
                                                if (isset($_SESSION['OrdPId'])) echo $_SESSION['OrdPId']; unset($_SESSION['OrdPId']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['OrdPId'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['OrdPId'] . "</font>"; ?>
                           <?php if (isset($erroresValidacion['mensajesError']['OrdPId'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['OrdPId'] . "</font>"; ?>                                        
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
                    <input class="form-control" placeholder="OrdPCant" name="OrdPCant" type="text"  required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['OrdPCant'])) echo $erroresValidacion['datosViejos']['OrdPCant']; 
                                                if (isset($_SESSION['OrdPCant'])) echo $_SESSION['OrdPCant']; unset($_SESSION['OrdPCant']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['OrdPCant'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['OrdPCant'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['OrdPCant'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['OrdPCant'] . "</font>"; ?>                                        
                           <br>
                    <input class="form-control" placeholder="OrdPAsignada" name="OrdPAsignada" type="text"  required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['OrdPAsignada'])) echo $erroresValidacion['datosViejos']['OrdPAsignada']; 
                                                if (isset($_SESSION['OrdPAsignada'])) echo $_SESSION['OrdPAsignada']; unset($_SESSION['OrdPAsignada']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['OrdPAsignada'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['OrdPAsignada'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['OrdPAsignada'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['OrdPAsignada'] . "</font>"; ?>                                        
                           <br>
                    <input class="form-control" placeholder="OrdPFecha" name="OrdPFecha" type="text"  required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['OrdPFecha'])) echo $erroresValidacion['datosViejos']['OrdPFecha']; 
                                                if (isset($_SESSION['OrdPFecha'])) echo $_SESSION['OrdPFecha']; unset($_SESSION['OrdPFecha']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['OrdPFecha'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['OrdPFecha'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['OrdPFecha'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['OrdPFecha'] . "</font>"; ?>                                        
                           <br>
                    <input class="form-control" placeholder="OrdPObservaciones" name="OrdPObservaciones" type="text"  required="required"
                           value="<?php if (isset($erroresValidacion['datosViejos']['OrdPObservaciones'])) echo $erroresValidacion['datosViejos']['OrdPObservaciones']; 
                                                if (isset($_SESSION['OrdPObservaciones'])) echo $_SESSION['OrdPObservaciones']; unset($_SESSION['OrdPObservaciones']); ?>"
                           >
                           <?php if (isset($erroresValidacion['marcaCampo']['OrdPObservaciones'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['OrdPObservaciones'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['OrdPObservaciones'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['OrdPObservaciones'] . "</font>"; ?>                                        
                           <br>
            <input  type="hidden" name="ruta" value="insertarOrdenProduccion">
            <!--<input type="hidden" name="contenido" value="controlarRegistro">-->

                    <button class="btn btn-info m-b-10 m-l-5 m-30" onclick="valida_registro()">Agregar venta</button>

</form>
<?php if (isset($erroresValidacion)) $erroresValidacion = NULL; ?>




</div>
    


    </div>
    
    
        