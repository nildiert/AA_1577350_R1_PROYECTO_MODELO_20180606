

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
if (isset($_POST['InsCodigo']) && !isset($_SESSION['InsCodigoF'])) {
    $_SESSION['InsCodigoF'] = $_POST['InsCodigo'];
} else if (isset($_SESSION['InsCodigoF']) && !isset($_POST['InsCodigo'])) {
    $_POST['InsCodigo'] = $_SESSION['InsCodigoF'];
} // Copie y pegue
/* * ********************************************* */
/* * ********Conservar filtro 'InsNombre' si lo hay************ */
if (isset($_POST['InsNombre']) && !isset($_SESSION['InsNombreF'])) {
    $_SESSION['InsNombreF'] = $_POST['InsNombre'];
} else if (isset($_SESSION['InsNombreF']) && !isset($_POST['InsNombre'])) {
    $_POST['InsNombre'] = $_SESSION['InsNombreF'];
} // Copie y pegue
/* * ********************************************* */
/* * ********Conservar filtro 'InsCantActual' si lo hay************ */
if (isset($_POST['InsCantActual']) && !isset($_SESSION['InsCantActualF'])) {
    $_SESSION['InsCantActualF'] = $_POST['InsCantActual'];
} else if (isset($_SESSION['InsCantActualF']) && !isset($_POST['InsCantActual'])) {
    $_POST['InsCantActual'] = $_SESSION['InsCantActualF'];
} // Copie y pegue
/* * ********************************************* */
/* * ********Conservar filtro 'InsUnidadMedida' si lo hay************ */
if (isset($_POST['InsUnidadMedida']) && !isset($_SESSION['InsUnidadMedidaF'])) {
    $_SESSION['InsUnidadMedidaF'] = $_POST['InsUnidadMedida'];
} else if (isset($_SESSION['InsUnidadMedidaF']) && !isset($_POST['InsUnidadMedida'])) {
    $_POST['InsUnidadMedida'] = $_SESSION['InsUnidadMedidaF'];
} // Copie y pegue
/* * ********************************************* */
/* * ********Conservar filtro 'InsPrecio' si lo hay************ */
if (isset($_POST['InsPrecio']) && !isset($_SESSION['InsPrecioF'])) {
    $_SESSION['InsPrecioF'] = $_POST['InsPrecio'];
} else if (isset($_SESSION['InsPrecioF']) && !isset($_POST['InsPrecio'])) {
    $_POST['InsPrecio'] = $_SESSION['InsPrecioF'];
} // Copie y pegue
/* * ********************************************* */
/* * ********Conservar filtro 'buscar' si lo hay************ */
if (isset($_POST['buscar']))
    $_SESSION['buscarF'] = $_POST['buscar'];
if (isset($_SESSION['buscarF']) && !isset($_POST['buscar']))
    $_POST['buscar'] = $_SESSION['buscarF'];
/* * ********************************************* */



?>

<div class="container ">
    <div class=" p-30">
        <div class="row">
            <!-- /.container-fluid -->
            <div class="col-lg-6 card p-10">
                <div class="card-title">
                    <h1 class="page-header">Gestión de Insumos</h1>
                </div>

                <form name="formFiltroInsumos" action="controladores/ControladorPrincipal.php" method="POST">
                    <input type="hidden" class="form-control input-default" name="ruta" value="listarInsumos" />
                    <label for="InsCodigo"></label>

                    <input type="text" placeholder="Código" class="form-control input-default" name="InsCodigo" onclick="" value="<?php
                    if (isset($registroAInsertar['InsCodigo'])) {
                        echo $registroAInsertar['InsCodigo'];
                    }
                    if (!isset($_SESSION['InsCodigoF'])) { //Cambie desde aqui
                        echo $_SESSION['InsCodigoF'];
                    } else if ($_POST['InsCodigo']) {echo $_POST['InsCodigo'];} 
                    
                    ;//Hasta aqui Luego se va a libros controlador
                                ?>" />

                    <?php
                        
                        if (isset($marcaCampo['InsCodigo'])) {
                            echo $marcaCampo['InsCodigo'];
                        }
                        ?>

                    <label for="InsNombre"></label>
                    <input type="text" placeholder="Nombre" class="form-control input-default" name="InsNombre" onclick="" value="<?php
                        if (isset($registroAInsertar['InsNombre'])) {
                            echo $registroAInsertar['InsNombre'];
                        }
                        if (isset($_SESSION['InsNombreF'])) { //Cambie desde aqui
                            echo $_SESSION['InsNombreF'];
                        } else if ($_POST['InsNombre']) {echo $_POST['InsNombre'];} 
                        ;//Hasta aqui Luego se va a libros controlador
                                ?>" />

                    <?php
                        
                        if (isset($marcaCampo['InsNombre'])) {
                            echo $marcaCampo['InsNombre'];
                        }
                        
                        ?>
                    <label for="InsCantActual"></label>
                    <input type="double" placeholder="Cantidad actual" class="form-control input-default" name="InsCantActual" onclick="" value="<?php
                          if (isset($registroAInsertar['InsCantActual'])) {
                            echo $registroAInsertar['InsCantActual'];
                        }
                        if (!isset($_SESSION['InsCantActualF'])) { //Cambie desde aqui
                            echo $_SESSION['InsCantActualF'];
                        } else if ($_POST['InsCantActual']) {echo $_POST['InsCantActual'];} 
                        ;//Hasta aqui Luego se va a libros controlador
                                ?>" />

                    <?php
                                if (isset($marcaCampo['InsCantActual'])) {
                                    echo $marcaCampo['InsCantActual'];
                                }
                                ?>


                    <label for="InsUnidadMedida"></label>
                    <input type="text" placeholder="Unidad de medida" class="form-control input-default" onclick="" name="InsUnidadMedida" value="<?php
                        if (isset($registroAInsertar['InsUnidadMedida'])) {
                            echo $registroAInsertar['InsUnidadMedida'];
                        }
                        if (isset($_SESSION['InsUnidadMedidaF'])) { //Cambie desde aqui
                            echo $_SESSION['InsUnidadMedidaF'];
                        } else if ($_POST['InsUnidadMedida']) {echo $_POST['InsUnidadMedida'];} 
                        ;//Hasta aqui Luego se va a libros controlador
                                ?>" />

                    <?php
                                if (isset($marcaCampo['InsUnidadMedida'])) {
                                    echo $marcaCampo['InsUnidadMedida'];
                                }
                                ?>
                    <label for="InsPrecio"></label>
                    
                        <input placeholder="Precio" class="form-control input-default" type="number" onclick="" name="InsPrecio" value="<?php
                        if (isset($registroAInsertar['InsPrecio'])) {
                            echo $registroAInsertar['InsPrecio'];
                        }
                        if (!isset($_SESSION['InsPrecioF'])) { //Cambie desde aqui
                            echo $_SESSION['InsPrecioF'];
                        } else if ($_POST['InsPrecio']) {echo $_POST['InsPrecio'];} 
                        ;//Hasta aqui Luego se va a libros controlador
                                ?>" />
                    
                        <?php
                                if (isset($marcaCampo['InsPrecio'])) {
                                    echo $marcaCampo['InsPrecio'];
                                }
                                ?>

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

                <div class="button-list m-t-15 ">
                        <div class="button-group">
                        <input type="submit" value="Filtrar" name="enviar" title="Si es necesario limpie 'Buscar'" class="btn btn-info m-b-10 m-l-5"
                        style=" ;" />


                        <input type="reset" value="limpiar" class="btn btn-info m-b-10 m-l-5 m-30" onclick="
                                    javascript:document.formFiltroInsumos.InsCodigo.value = '';
                                    javascript:document.formFiltroInsumos.InsNombre.value = '';
                                    javascript:document.formFiltroInsumos.InsCantActual.value = '';                            
                                    javascript:document.formFiltroInsumos.InsUnidadMedida.value = '';
                                    javascript:document.formFiltroInsumos.InsPrecio.value = '';
                                    javascript:document.formFiltroInsumos.submit();
                                       " />
                        </div>
                </div>


        
                </form>
    
</div>
<div class="col-lg-1"></div>
                        <div class="col-lg-5 card p-30 " >
                            <div class="card-title">
                                <h1>Buscar insumos</h1>
                            </div>

    
                    <!--NUEVO BOTÓN PARA BUSCAR*************************-->
                
                    <form name="formBuscarInsumos" class="container" action="controladores/ControladorPrincipal.php" method="POST">
                        
                                        <input type="hidden" name="ruta" value="listarInsumos" />
                
                                        <input class="form-control input-default col-md-8" type="text" name="buscar" placeholder="Término a Buscar" value="<?php
                                    if (isset($_SESSION['buscarF'])) {
                                        echo $_SESSION['buscarF'];
                                    }
                                    ?>">
                <div class="button-list m-t-10">                                    
                        
                                        <input  type="submit" value="Buscar" class="btn btn-info col-md-4 " title="Si es necesario limpie 'Filtrar'">
                        
                        
                                    <input type="button" class="btn btn-info  m-l-5" value="Limpiar Búsqueda" onclick="javascript:document.formBuscarInsumos.buscar.value = '';
                                    javascript:document.formBuscarInsumos.submit();">
                        
                </div>
                    </form>
        
        
        
        
        
        
                <br>
        
            </div>
        </div>
    </div>

    <div class="card ">
        <span class="izquierdo">
            <!--NUEVO BOTÓN PARA DARLE FUNCIONALIDAD*************************-->

            <input type="button" onclick="javascript:location.href = 'principal.php?contenido=vistas/vistasInsumos/vistaInsertarInsumos.php'"
                class="btn btn-info " value="Nuevo Insumo">
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
                    <a class="btn btn-info btn-rounded m-b-10 m-l-5"  href="controladores/ControladorPrincipal.php?ruta=actualizarInsumos&idAct=<?php echo $listaDeInsumos[$i]->InsCodigo; ?>">Actualizar</a>
                </td>
                <td style="width: 100">
                    <a class="btn btn-danger btn-rounded m-b-10 m-l-5" href="controladores/ControladorPrincipal.php?ruta=eliminarInsumos&idAct=<?php echo $listaDeInsumos[$i]->InsCodigo; ?>">Eliminar</a>
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
        
    </div>
</div>
</div>



