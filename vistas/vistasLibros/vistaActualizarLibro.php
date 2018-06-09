<?php
//@session_start();
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
if (isset($_SESSION['actualizarDatosLibro'])) {
    $actualizarDatosLibro = $_SESSION['actualizarDatosLibro'];
    unset($_SESSION['actualizarLibro']);
}
if (isset($_SESSION['registroCategoriasLibros'])) { /* * ************************ */
    $registroCategoriasLibros = $_SESSION['registroCategoriasLibros'];
    $cantCategorias = count($registroCategoriasLibros);
}
if (isset($_GET['erroresValidacion'])) {
    $erroresValidacion = json_decode($_GET['erroresValidacion'], true); //true para que convierta un json a "array" y no a objeto
}
?>        
<div class="panel-heading">
    <h3 class="panel-title">Actualización de Libro.</h3>
</div>
<form role="form" method="POST" action="controladores/ControladorPrincipal.php" id="formRegistro">
    <table>
        <fieldset>
            <tr>
                <td>
                    <input class="form-control" placeholder="ISBN" name="isbn" type="number" pattern="" required="required" autofocus readonly="readonly"
                           value="<?php
                           if (isset($actualizarDatosLibro->isbn))
                               echo $actualizarDatosLibro->isbn;
                           if (isset($erroresValidacion['datosViejos']['isbn']))
                               echo $erroresValidacion['datosViejos']['isbn'];
                           if (isset($_SESSION['isbn']))
                               echo $_SESSION['isbn'];
                           unset($_SESSION['isbn']);
                           ?>">
                            <?php if (isset($erroresValidacion['marcaCampo']['isnb'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['isnb'] . "</font>"; ?>
                            <?php if (isset($erroresValidacion['mensajesError']['isnb'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['isnb'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->
                </td>
            </tr>
            <tr>
                <td>                
                    <input class="form-control" placeholder="TITULO" name="titulo" type="text"   required="required"
                           value="<?php
                           if (isset($actualizarDatosLibro->titulo))
                               echo $actualizarDatosLibro->titulo;                           
                           if (isset($erroresValidacion['datosViejos']['titulo']))
                               echo $erroresValidacion['datosViejos']['titulo'];
                           if (isset($_SESSION['titulo']))
                               echo $_SESSION['titulo'];
                           unset($_SESSION['titulo']);
                           ?>">
                            <?php if (isset($erroresValidacion['marcaCampo']['titulo'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['titulo'] . "</font>"; ?>                                        
                            <?php if (isset($erroresValidacion['mensajesError']['titulo'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['titulo'] . "</font>"; ?>                                        
                    <!--<p class="help-block">Example block-level help text here.</p>-->
                </td>
            </tr>
            <tr>
                <td>                  
                    <input class="form-control" placeholder="AUTOR" name="autor" type="text"  required="required"
                           value="<?php
                           if (isset($actualizarDatosLibro->autor))
                               echo $actualizarDatosLibro->autor;                            
                           if (isset($erroresValidacion['datosViejos']['autor']))
                               echo $erroresValidacion['datosViejos']['autor'];
                           if (isset($_SESSION['autor']))
                               echo $_SESSION['autor'];
                           unset($_SESSION['autor']);
                           ?>">
                           <?php if (isset($erroresValidacion['marcaCampo']['autor'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['autor'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['autor'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['autor'] . "</font>"; ?>                                        
                </td>
            </tr>                  
            <tr>
                <td>                  
                    <input class="form-control" placeholder="PRECIO" name="precio" type="number"  required="required"
                           value="<?php
                           if (isset($actualizarDatosLibro->precio))
                               echo $actualizarDatosLibro->precio;                            
                           if (isset($erroresValidacion['datosViejos']['precio']))
                               echo $erroresValidacion['datosViejos']['precio'];
                           if (isset($_SESSION['precio']))
                               echo $_SESSION['precio'];
                           unset($_SESSION['precio']);
                           ?>">
                           <?php if (isset($erroresValidacion['marcaCampo']['precio'])) echo "<font color='red'>" . $erroresValidacion['marcaCampo']['precio'] . "</font>"; ?>                                        
                           <?php if (isset($erroresValidacion['mensajesError']['precio'])) echo "<font color='red'>" . $erroresValidacion['mensajesError']['precio'] . "</font>"; ?>                                        
                </td>
            </tr>  
            <tr>
                <td>
                    <select id="categoriaLibro_catLibId" name="categoriaLibro_catLibId">                    
                        <?php
                        for ($j = 0; $j < $cantCategorias; $j++) {
                            ?>
                            <option value = "<?php echo $registroCategoriasLibros[$j]->catLibId; ?>" 
                            <?php
                            if (isset($registroCategoriasLibros[$j]->catLibId) && isset($actualizarDatosLibro->categoriaLibro_catLibId) && ($registroCategoriasLibros[$j]->catLibId == $actualizarDatosLibro->categoriaLibro_catLibId)) {
                                echo "selected";
                            }
                            ?>
                                    ><?php echo $registroCategoriasLibros[$j]->catLibId . " - " . $registroCategoriasLibros[$j]->catLibNombre; ?></option>             
                            <?php
                        }
                        ?>
                    </select> 
                </td>                       
            </tr>       
            <input type="hidden" name="ruta" value="confirmaActualizarLibro">
            <!--<input type="hidden" name="contenido" value="controlarRegistro">-->
            <tr>
                <td>            
                    <!--<button  onclick="valida_registro()">Actualizar </button>-->
                    <button type="submit" >Actualizar Libro</button>
                </td>
            </tr>             
    </table>
</form>
<?php if (isset($erroresValidacion)) $erroresValidacion = NULL; ?>




