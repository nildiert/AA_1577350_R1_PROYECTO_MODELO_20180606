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

<div class="container ">
    <div class="card p-30">
        <div class="row">
            <!-- /.container-fluid -->
            <div class="col-lg-7">
                <div>
                    <h1 class="page-header">Gestión de Insumos</h1>
                </div>
                <form name="formFiltroInsumos" action="controladores/ControladorPrincipal.php" method="POST">
                    <input type="hidden" class="form-control input-default" name="ruta" value="listarInsumos" />
                    <label for="InsCodigo">CÓDIGO</label>

                    <input type="number" class="form-control input-default" name="InsCodigo" onclick="" value="<?php
                                if (isset($registroAInsertar['InsCodigo'])) {
                                    echo $registroAInsertar['InsCodigo'];
                                }
                                if (isset($_SESSION['InsCodigoF'])) {
                                    echo $_SESSION['InsCodigoF'];
                                }
                                ?>" />

                    <?php
                                if (isset($marcaCampo['InsCodigo'])) {
                                    echo $marcaCampo['InsCodigo'];
                                }
                                ?>

                    <label for="InsNombre">NOMBRE:</label>
                    <input type="text" class="form-control input-default" name="InsNombre" onclick="" value="<?php
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
                    <label for="InsCantActual">CANTIDAD ACTUAL:</label>
                    <input type="text" class="form-control input-default" name="InsCantActual" onclick="" value="<?php
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


                    <label for="InsUnidadMedida">UNIDAD DE MEDIDA:</label>
                    <input type="text" class="form-control input-default" onclick="" name="InsUnidadMedida" value="<?php
                                if (isset($registroAInsertar['InsUnidadMedida'])) {
                                    echo $registroAInsertar['InsUnidadMedida'];
                                }
                                if (isset($_SESSION['InsUnidadMedidaF'])) {
                                    echo $_SESSION['InsUnidadMedidaF'];
                                }
                                ?>" />

                    <?php
                                if (isset($marcaCampo['InsUnidadMedida'])) {
                                    echo $marcaCampo['InsUnidadMedida'];
                                }
                                ?>
                    <label for="InsPrecio">PRECIO:</label>
                    </td>
                    <td>
                        <input class="form-control input-default" type="number" onclick="" name="InsPrecio" value="<?php
                                if (isset($registroAInsertar['InsPrecio'])) {
                                    echo $registroAInsertar['InsPrecio'];
                                }
                                if (isset($_SESSION['InsPrecioF'])) {
                                    echo $_SESSION['InsPrecioF'];
                                }
                                ?>" />
                    </td>
                    <td>
                        <?php
                                if (isset($marcaCampo['InsPrecio'])) {
                                    echo $marcaCampo['InsPrecio'];
                                }
                                ?>
                    </td>
                    </tr>
            </div>
            <div class="col-lg-5 card p-30 " style="display:  flex;justify-content:  center;">
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
                <tr>
                    <td>
                        <input type="submit" value="Filtrar" name="enviar" title="Si es necesario limpie 'Buscar'" class="btn btn-info m-b-10 m-l-5"
                        />
                    </td>
                    <td>
                        <input type="reset" value="limpiar" class="btn btn-info m-b-10 m-l-5" onclick="
                                    javascript:document.formFiltroInsumos.InsCodigo.value = '';
                                    javascript:document.formFiltroInsumos.InsNombre.value = '';
                                    javascript:document.formFiltroInsumos.InsCantActual.value = '';                            
                                    javascript:document.formFiltroInsumos.InsUnidadMedida.value = '';
                                    javascript:document.formFiltroInsumos.InsPrecio.value = '';
                                    javascript:document.formFiltroInsumos.submit();
                                       " />
                    </td>
                    <td></td>
                </tr>
        
                </form>
        
        
        
        
        
                    <!--NUEVO BOTÓN PARA BUSCAR*************************-->
                    <form name="formBuscarInsumos" class="container" action="controladores/ControladorPrincipal.php" method="POST">
                        <div class="row">
                            <input type="hidden" name="ruta" value="listarInsumos" />
                            <input class="form-control input-default col-md-8" type="text" name="buscar" placeholder="Término a Buscar" value="<?php
                        if (isset($_SESSION['buscarF'])) {
                            echo $_SESSION['buscarF'];
                        }
                        ?>">
                            <input type="submit" value="Buscar" class="btn btn-info col-md-4" title="Si es necesario limpie 'Filtrar'">
                        </div>
                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Use this class are <code>input-group-rounded</code> and <code>btn-group-right</code> for input group rounded with search icon.</p>
                                            <div class="input-group input-group-rounded">
                                                <input placeholder="Término a Buscar" name="Search" class="form-control" type="text">
                                                <span class="input-group-btn"><button class="btn btn-primary btn-group-right" type="submit"><i class="ti-search"></i></button></span>
                                            </div>
                                        </div>
                        <input type="button" class="btn btn-info m-b-10 m-l-5" value="Limpiar Búsqueda" onclick="javascript:document.formBuscarInsumos.buscar.value = '';
                                javascript:document.formBuscarInsumos.submit();">
        
                    </form>
        
        
        
        
        
        
                <br>
        
            </div>
        </div>
    </div>

    <div class="card ">
        <span class="izquierdo">
            <!--NUEVO BOTÓN PARA DARLE FUNCIONALIDAD*************************-->

            <input type="button" onclick="javascript:location.href = 'principal.php?contenido=vistas/vistasInsumos/vistaInsertarInsumos.php'"
                class="btn btn-info m-b-10 m-l-5" value="Nuevo Insumos">
            <br>
        </span>

        <br>
        <a name="listaDeInsumos" id="a"></a>
        <br>
        <p>Total de Registros:
            <?php echo $totalRegistros; ?>
        </p>
        <br>
        <table class="table table-hover ">
            <thead>
                <tr>
                    <TH style="width: 100">CODIGO</TH>
                    <TH style="width: 100">NOMBRE</TH>
                    <TH style="width: 100">CANTIDAD ACTUAL</TH>
                    <TH style="width: 100">UNIDAD DE MEDIDA</TH>
                    <TH style="width: 100 ">PRECIO</TH>

                    <TH style="width: 100 position:center" colspan="2"> ACCIONES </TH>
                </tr>
            </thead>
            <?php
            $i = 0;
            foreach ($listaDeInsumos as $key => $value) {
                ?>
            <tr>
                <td style="width: 100">
                    <?php echo $listaDeInsumos[$i]->InsCodigo; ?>
                </td>
                <td style="width: 100">
                    <?php echo strtoupper($listaDeInsumos[$i]->InsNombre); ?>
                </td>
                <td style="width: 100">
                    <?php echo strtoupper($listaDeInsumos[$i]->InsCantActual); ?>
                </td>
                <td style="width: 100">
                    <?php echo strtoupper($listaDeInsumos[$i]->InsUnidadMedida); ?>
                </td>
                <td style="width: 100">
                    <?php echo strtoupper($listaDeInsumos[$i]->InsPrecio); ?>
                </td>

                <td style="width: 100">
                    <a href="controladores/ControladorPrincipal.php?ruta=actualizarInsumos&idAct=<?php echo $listaDeInsumos[$i]->isbn; ?>">Actualizar</a>
                </td>
                <td style="width: 100">
                    <a href="controladores/ControladorPrincipal.php?ruta=eliminarInsumos&idAct=<?php echo $listaDeInsumos[$i]->isbn; ?>">Eliminar</a>
                </td>
                <?php
                    $i++;
                    ?>
                <tr>
                    <?php
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
</div>
</div>