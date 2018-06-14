<?php
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";exit();
//session_start();
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
if (isset($_SESSION['listaDeInsumos'])) {
    $listaDeInsumos = $_SESSION['listaDeInsumos'];
}
if (isset($_SESSION['paginacionVinculos'])) {
    $paginacionVinculos = $_SESSION['paginacionVinculos'];
}
if (isset($_SESSION['totalRegistros'])) {
    $totalRegistros = $_SESSION['totalRegistros'];
}
if (isset($_SESSION['registroCategoriasInsumos'])) {   /***************************/
    $registroCategoriasInsumos = $_SESSION['registroCategoriasInsumos'];
    $cantCategorias=count($registroCategoriasInsumos);
}

//http://www.forosdelweb.com/f18/notice-session-had-already-been-started-ignoring-session_start-1021808/
//http://ajpdsoft.com/modules.php?name=News&file=print&sid=486

/* * ********Conservar filtro 'InsCodigo' si lo hay************ */
if (isset($_POST['InsCodigo']))
    $_SESSION['InsCodigoF'] = $_POST['InsCodigo'];
if (isset($_SESSION['InsCodigoF']) && !isset($_POST['InsCodigo']))
    $_POST['InsCodigo'] = $_SESSION['InsCodigoF'];
/* * ********************************************* */
/* * ********Conservar filtro 'InsNombre' si lo hay************ */
if (isset($_POST['InsNombre']))
    $_SESSION['InsNombreF'] = $_POST['InsNombre'];
if (isset($_SESSION['InsNombreF']) && !isset($_POST['InsNombre']))
    $_POST['InsNombre'] = $_SESSION['InsNombreF'];
/* * ********************************************* */
/* * ********Conservar filtro 'InsCantActual' si lo hay************ */
if (isset($_POST['InsCantActual']))
    $_SESSION['InsCantActualF'] = $_POST['InsCantActual'];
if (isset($_SESSION['InsCantActualF']) && !isset($_POST['InsCantActual']))
    $_POST['InsCantActual'] = $_SESSION['InsCantActualF'];
/* * ********************************************* */
/* * ********Conservar filtro 'InsUnidadMedida' si lo hay************ */
if (isset($_POST['InsUnidadMedida']))
    $_SESSION['InsUnidadMedidaF'] = $_POST['InsUnidadMedida'];
if (isset($_SESSION['InsUnidadMedidaF']) && !isset($_POST['InsUnidadMedida']))
    $_POST['InsUnidadMedida'] = $_SESSION['InsUnidadMedidaF'];
/* * ********************************************* */
/* * ********Conservar filtro 'InsPrecio ' si lo hay************ */
if (isset($_POST['InsPrecio ']))
    $_SESSION['InsPrecio F'] = $_POST['InsPrecio '];
if (isset($_SESSION['InsPrecio F']) && !isset($_POST['InsPrecio ']))
    $_POST['InsPrecio '] = $_SESSION['InsPrecio F'];
/* * ********************************************* */

/* * ********Conservar filtro 'buscar' si lo hay************ */
if (isset($_POST['buscar']))
    $_SESSION['buscarF'] = $_POST['buscar'];
if (isset($_SESSION['buscarF']) && !isset($_POST['buscar']))
    $_POST['buscar'] = $_SESSION['buscarF'];
/* * ********************************************* */



?>
<style type="text/css">
    .derecha   { float: right; }
    .izquierda { float: left;  }
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;

    }  
    table th {
        text-align: center;
    }
    table tr {
        text-align: center;
    }
    thead th{
        color: #79008E;
        font-weight: normal;
    }
</style>
<div class="container-fluid">
<div class="col-md-5">
<div class="card p-30" >
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gestión de Insumos.</h1>
        </div>                        
        <!-- /.col-lg-12 -->    
    </div>
    <!-- /.row -->

<!-- /.container-fluid -->



        <form name="formFiltroInsumos" action="controladores/ControladorPrincipal.php" method="POST">
            <input type="hidden" name="ruta" value="listarInsumos"/>
            <label for="InsCodigo">InsCodigo</label>
            
            <input type="number" name="InsCodigo" onclick="" value="<?php
                        if (isset($registroAInsertar['InsCodigo'])) {
                            echo $registroAInsertar['InsCodigo'];
                        }
                        if (isset($_SESSION['InsCodigoF'])) {
                            echo $_SESSION['InsCodigoF'];
                        }
                        ?>"/>
                    
                        <?php
                        if (isset($marcaCampo['InsCodigo'])) {
                            echo $marcaCampo['InsCodigo'];
                        }
                        ?>
                    
                <label for="InsNombre">InsNombre:</label>
                <input type="text" name="InsNombre" onclick="" value="<?php
                        if (isset($registroAInsertar['InsNombre'])) {
                            echo $registroAInsertar['InsNombre'];
                        }
                        if (isset($_SESSION['InsNombreF'])) {
                            echo $_SESSION['InsNombreF'];
                        }
                        ?>" />
                    
                        <?php
                        if (isset($marcaCampo['InsNombre'])) {
                            echo $marcaCampo['InsNombre'];
                        }
                        ?>
                <label for="InsCantActual">InsCantActual:</label>
                <input type="text" name="InsCantActual" onclick="" value="<?php
                        if (isset($registroAInsertar['InsCantActual'])) {
                            echo $registroAInsertar['InsCantActual'];
                        }
                        if (isset($_SESSION['InsCantActualF'])) {
                            echo $_SESSION['InsCantActualF'];
                        }
                        ?>" />
                    
                        <?php
                        if (isset($marcaCampo['InsCantActual'])) {
                            echo $marcaCampo['InsCantActual'];
                        }
                        ?>


                <label for="InsUnidadMedida">InsUnidadMedida:</label>
                 <input type="text" onclick="" name="InsUnidadMedida" value="<?php
                        if (isset($registroAInsertar['InsUnidadMedida'])) {
                            echo $registroAInsertar['InsUnidadMedida'];
                        }
                        if (isset($_SESSION['InsUnidadMedidaF'])) {
                            echo $_SESSION['InsUnidadMedidaF'];
                        }
                        ?>"/>
                    
                        <?php
                        if (isset($marcaCampo['InsUnidadMedida'])) {
                            echo $marcaCampo['InsUnidadMedida'];
                        }
                        ?>
                <label for="InsPrecio">InsPrecio:</label>
                 </td><td><input type="number" onclick=""  name="InsPrecio" value="<?php
                        if (isset($registroAInsertar['InsPrecio'])) {
                            echo $registroAInsertar['InsPrecio'];
                        }
                        if (isset($_SESSION['InsPrecioF'])) {
                            echo $_SESSION['InsPrecioF'];
                        }
                        ?>" /></td>
                    <td>
                        <?php
                        if (isset($marcaCampo['InsPrecio'])) {
                            echo $marcaCampo['InsPrecio'];
                        }
                        ?>
                    </td>                          
                </tr>                   
                
                <?php
                if (isset($mensajesError)) {

                    echo "<tr>\n"; //fila para imprimir errores si los hay
                    echo "<td colspan=3>\n";
                    foreach ($mensajesError as $value) {
                        echo $value;
                    }
                    echo "</td>\n";
                    echo "</tr>\n";
                }
                ?>                    
                <tr><td><input type="submit" value="Filtrar" name="enviar" title="Si es necesario limpie 'Buscar'"/></td>
                    <td><input type="reset" value="limpiar" onclick="
                            javascript:document.formFiltroInsumos.InsCodigo.value = '';
                            javascript:document.formFiltroInsumos.InsNombre.value = '';
                            javascript:document.formFiltroInsumos.InsCantActual.value = '';                            
                            javascript:document.formFiltroInsumos.InsUnidadMedida.value = '';
                            javascript:document.formFiltroInsumos.InsPrecio.value = '';
                            javascript:document.formFiltroInsumos.submit();
                               "/></td><td></td></tr> 
            </table>
        </form>




    <div style="width: 800">
        <span class="izquierdo">
            <!--NUEVO BOTÓN PARA BUSCAR*************************-->
            <form name="formBuscarInsumos" action="controladores/ControladorPrincipal.php" method="POST">
                <input type="hidden" name="ruta" value="listarInsumos"/>
                <input type="text" name="buscar" placeholder="Término a Buscar" value="<?php
                if (isset($_SESSION['buscarF'])) {
                    echo $_SESSION['buscarF'];
                }
                ?>">
                <input type="submit"  value="Buscar" title="Si es necesario limpie 'Filtrar'">&nbsp;&nbsp;||&nbsp;&nbsp;
                <input type="button"  value="Limpiar Búsqueda" onclick="javascript:document.formBuscarInsumos.buscar.value = '';
                        javascript:document.formBuscarInsumos.submit();">
                        
            </form>
        </span>
        </div>
    </div>        

    </div>    
    </div>
</div>
<br>
<div style="width: 800">
    <span class="izquierdo">
        <!--NUEVO BOTÓN PARA DARLE FUNCIONALIDAD*************************-->

        <input type="button" onclick="javascript:location.href = 'principal.php?contenido=vistas/vistasInsumos/vistaInsertarInsumos.php'" value="Nuevo Insumos">

    </span>
</div>
<br>
<a name="listaDeInsumos" id="a"></a>
<div style="width: 800">
    <p>Total de Registros: <?php echo $totalRegistros; ?></p>
    <table border=1>
        <thead>
            <tr>
                <td style="width: 100">InsCodigo</td>
                <td style="width: 100">InsNombre</td>
                <td style="width: 100">InsCantActual</td>
                <td style="width: 100">InsUnidadMedida</td>
                <td style="width: 100">InsPrecio</td>
                
                <td style="width: 100"  colspan="2"> ACCIONES </td>
            </tr>
        </thead> 
        <?php
        $i = 0;
        foreach ($listaDeInsumos as $key => $value) {
            ?>
            <tr>
                <td style="width: 100"><?php echo $listaDeInsumos[$i]->InsCodigo; ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeInsumos[$i]->InsNombre); ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeInsumos[$i]->InsCantActual); ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeInsumos[$i]->InsUnidadMedida); ?></td>;
                <td style="width: 100"><?php echo strtoupper($listaDeInsumos[$i]->InsPrecio); ?></td>
                
                <td style="width: 100"><a href="controladores/ControladorPrincipal.php?ruta=actualizarInsumos&idAct=<?php echo $listaDeInsumos[$i]->isbn; ?>" >Actualizar</a></td>
                <td style="width: 100">  <a href="controladores/ControladorPrincipal.php?ruta=eliminarInsumos&idAct=<?php echo $listaDeInsumos[$i]->isbn; ?>">Eliminar</a>   </td>
                <?php
                $i++;
                ?><tr><?php
                }
                ?>
        <tfoot> 
            <tr>
                <td colspan="8">
                    <?php
                    echo $paginacionVinculos;
                    ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
