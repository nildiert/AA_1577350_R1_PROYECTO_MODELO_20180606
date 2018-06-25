

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
if (isset($_SESSION['listaDeOrdenProduccion'])) {
    $listaDeOrdenProduccion = $_SESSION['listaDeOrdenProduccion'];
}
if (isset($_SESSION['paginacionVinculos'])) {
    $paginacionVinculos = $_SESSION['paginacionVinculos'];
}
if (isset($_SESSION['totalRegistros'])) {
    $totalRegistros = $_SESSION['totalRegistros'];
}



//http://www.forosdelweb.com/f18/notice-session-had-already-been-started-ignoring-session_start-1021808/
//http://ajpdsoft.com/modules.php?name=News&file=print&sid=486

/* * ********Conservar filtro 'OrdPId' si lo hay************ */
if (isset($_POST['OrdPId']) && !isset($_SESSION['OrdPIdF'])) {
    $_SESSION['OrdPIdF'] = $_POST['OrdPId'];
} else if (isset($_SESSION['OrdPIdF']) && !isset($_POST['OrdPId'])) {
    $_POST['OrdPId'] = $_SESSION['OrdPIdF'];
} // Copie y pegue
/* * ********************************************* */
/* * ********Conservar filtro 'ProNombre' si lo hay************ */
if (isset($_POST['ProNombre']) && !isset($_SESSION['ProNombreF'])) {
    $_SESSION['ProNombreF'] = $_POST['ProNombre'];
} else if (isset($_SESSION['ProNombreF']) && !isset($_POST['ProNombre'])) {
    $_POST['ProNombre'] = $_SESSION['ProNombreF'];
} // Copie y pegue
/* * ********************************************* */
/* * ********Conservar filtro 'OrdPCant' si lo hay************ */
if (isset($_POST['OrdPCant']) && !isset($_SESSION['OrdPCantF'])) {
    $_SESSION['OrdPCantF'] = $_POST['OrdPCant'];
} else if (isset($_SESSION['OrdPCantF']) && !isset($_POST['OrdPCant'])) {
    $_POST['OrdPCant'] = $_SESSION['OrdPCantF'];
} // Copie y pegue
/* * ********************************************* */
/* * ********Conservar filtro 'OrdPAsignada' si lo hay************ */
if (isset($_POST['OrdPAsignada']) && !isset($_SESSION['OrdPAsignadaF'])) {
    $_SESSION['OrdPAsignadaF'] = $_POST['OrdPAsignada'];
} else if (isset($_SESSION['OrdPAsignadaF']) && !isset($_POST['OrdPAsignada'])) {
    $_POST['OrdPAsignada'] = $_SESSION['OrdPAsignadaF'];
} // Copie y pegue
/* * ********************************************* */
/* * ********Conservar filtro 'OrdPFecha' si lo hay************ */
if (isset($_POST['OrdPFecha']) && !isset($_SESSION['OrdPFechaF'])) {
    $_SESSION['OrdPFechaF'] = $_POST['OrdPFecha'];
} else if (isset($_SESSION['OrdPFechaF']) && !isset($_POST['OrdPFecha'])) {
    $_POST['OrdPFecha'] = $_SESSION['OrdPFechaF'];
} // Copie y pegue
/* * ********Conservar filtro 'OrdPObservaciones' si lo hay************ */
if (isset($_POST['OrdPObservaciones']) && !isset($_SESSION['OrdPObservacionesF'])) {
    $_SESSION['OrdPObservacionesF'] = $_POST['OrdPObservaciones'];
} else if (isset($_SESSION['OrdPObservacionesF']) && !isset($_POST['OrdPObservaciones'])) {
    $_POST['OrdPObservaciones'] = $_SESSION['OrdPObservacionesF'];
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
                    <h1 class="page-header">Gestión de Ventas</h1>
                </div>

                <form name="formFiltroOrdenProduccion" action="controladores/ControladorPrincipal.php" method="POST">
                    <input type="hidden" class="form-control input-default" name="ruta" value="listarOrdenProduccion" />
                    <label for="OrdPId"></label>

                    <input type="text" placeholder="Código" class="form-control input-default" name="OrdPId" onclick="" value="<?php
                    if (isset($registroAInsertar['OrdPId'])) {
                        echo $registroAInsertar['OrdPId'];
                    }
                    if (isset($_SESSION['OrdPIdF'])) { //Cambie desde aqui
                        echo $_SESSION['OrdPIdF'];
                    } else if ($_POST['OrdPId']) {echo $_POST['OrdPId'];} 
                    
                    ;//Hasta aqui Luego se va a libros controlador
                                ?>" />

                    <?php
                        
                        if (isset($marcaCampo['OrdPId'])) {
                            echo $marcaCampo['OrdPId'];
                        }
                        ?>

                    <label for="ProNombre"></label>
                    <input type="text" placeholder="Producto" class="form-control input-default" name="ProNombre" onclick="" value="<?php
                        if (isset($registroAInsertar['ProNombre'])) {
                            echo $registroAInsertar['ProNombre'];
                        }
                        if (isset($_SESSION['ProNombreF'])) { //Cambie desde aqui
                            echo $_SESSION['ProNombreF'];
                        } else if ($_POST['ProNombre']) {echo $_POST['ProNombre'];} 
                        ;//Hasta aqui Luego se va a libros controlador
                                ?>" />

                    <?php
                        
                        if (isset($marcaCampo['ProNombre'])) {
                            echo $marcaCampo['ProNombre'];
                        }
                        
                        ?>
                    <label for="OrdPCant"></label>
                    <input type="double" placeholder="Cantidad" class="form-control input-default" name="OrdPCant" onclick="" value="<?php
                          if (isset($registroAInsertar['OrdPCant'])) {
                            echo $registroAInsertar['OrdPCant'];
                        }
                        if (isset($_SESSION['OrdPCantF'])) { //Cambie desde aqui
                            echo $_SESSION['OrdPCantF'];
                        } else if ($_POST['OrdPCant']) {echo $_POST['OrdPCant'];} 
                        ;//Hasta aqui Luego se va a libros controlador
                                ?>" />

                    <?php
                                if (isset($marcaCampo['OrdPCant'])) {
                                    echo $marcaCampo['OrdPCant'];
                                }
                                ?>


                    <label for="OrdPAsignada"></label>
                    <input type="text" placeholder="Asignación" class="form-control input-default" onclick="" name="OrdPAsignada" value="<?php
                        if (isset($registroAInsertar['OrdPAsignada'])) {
                            echo $registroAInsertar['OrdPAsignada'];
                        }
                        if (isset($_SESSION['OrdPAsignadaF'])) { //Cambie desde aqui
                            echo $_SESSION['OrdPAsignadaF'];
                        } else if ($_POST['OrdPAsignada']) {echo $_POST['OrdPAsignada'];} 
                        ;//Hasta aqui Luego se va a libros controlador
                                ?>" />

                    <?php
                                if (isset($marcaCampo['OrdPAsignada'])) {
                                    echo $marcaCampo['OrdPAsignada'];
                                }
                                ?>
                    <label for="OrdPFecha"></label>
                    
                        <input placeholder="Fecha" class="form-control input-default" type="number" onclick="" name="OrdPFecha" value="<?php
                        if (isset($registroAInsertar['OrdPFecha'])) {
                            echo $registroAInsertar['OrdPFecha'];
                        }
                        if (isset($_SESSION['OrdPFechaF'])) { //Cambie desde aqui
                            echo $_SESSION['OrdPFechaF'];
                        } else if ($_POST['OrdPFecha']) {echo $_POST['OrdPFecha'];} 
                        ;//Hasta aqui Luego se va a libros controlador
                                ?>" />
                    
                        <?php
                                if (isset($marcaCampo['OrdPFecha'])) {
                                    echo $marcaCampo['OrdPFecha'];
                                }
                                ?>
                    <label for="OrdPObservaciones"></label>
                    
                        <input placeholder="Observaciones" class="form-control input-default" type="number" onclick="" name="OrdPObservaciones" value="<?php
                        if (isset($registroAInsertar['OrdPObservaciones'])) {
                            echo $registroAInsertar['OrdPObservaciones'];
                        }
                        if (isset($_SESSION['OrdPObservacionesF'])) { //Cambie desde aqui
                            echo $_SESSION['OrdPObservacionesF'];
                        } else if ($_POST['OrdPObservaciones']) {echo $_POST['OrdPObservaciones'];} 
                        ;//Hasta aqui Luego se va a libros controlador
                                ?>" />
                    
                        <?php
                                if (isset($marcaCampo['OrdPObservaciones'])) {
                                    echo $marcaCampo['OrdPObservaciones'];
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
                                    javascript:document.formFiltroOrdenProduccion.OrdPId.value = '';
                                    javascript:document.formFiltroOrdenProduccion.ProNombre.value = '';
                                    javascript:document.formFiltroOrdenProduccion.OrdPCant.value = '';                            
                                    javascript:document.formFiltroOrdenProduccion.OrdPAsignada.value = '';
                                    javascript:document.formFiltroOrdenProduccion.OrdPFecha.value = '';
                                    javascript:document.formFiltroOrdenProduccion.OrdPObservaciones.value = '';
                                    javascript:document.formFiltroOrdenProduccion.submit();
                                       " />
                        </div>
                </div>


        
                </form>
    
</div>
<div class="col-lg-1"></div>
                        <div class="col-lg-5 card p-30 " >
                            <div class="card-title ">
                                <h1>Buscar Venta</h1>
                            </div>

    
                    <!--NUEVO BOTÓN PARA BUSCAR*************************-->
                        <div class="row">
                                 <form name="formBuscarOrdenProduccion" class="container" action="controladores/ControladorPrincipal.php" method="POST">
                        
                                        <input type="hidden" name="ruta" value="listarOrdenProduccion" />
                
                                        <input class="form-control input-default col-md-8" type="text" name="buscar" placeholder="Término a Buscar" value="<?php
                                    if (isset($_SESSION['buscarF'])) {
                                        echo $_SESSION['buscarF'];
                                    }
                                    ?>">
                                    </div>
                <div class="button-list m-t-10">                                    
                        
                                        <input  type="submit" value="Buscar" class="btn btn-info col-md-4 " title="Si es necesario limpie 'Filtrar'">
                        
                        
                                    <input type="button" class="btn btn-info  m-l-5" value="Limpiar Búsqueda" onclick="javascript:document.formBuscarOrdenProduccion.buscar.value = '';
                                    javascript:document.formBuscarOrdenProduccion.submit();">
                        
                </div>
                    </form>
        
        
        
        
        
        
                <br>
        
            </div>
        </div>
    </div>

    <div class="card ">
        <span class="izquierdo">
            <!--NUEVO BOTÓN PARA DARLE FUNCIONALIDAD*************************-->

            <input type="button" onclick="javascript:location.href = 'principal.php?contenido=vistas/vistasOrdenProduccion/vistaInsertarOrdenProduccion.php'"
                class="btn btn-info " value="Nueva Venta">
            <br>
        </span>

        <br>
        <div>
        <a name="listaDeOrdenProduccion" id="a"></a>
        <br>
        <p class="text-secundary">Total de Registros:
            <?php echo $totalRegistros; ?>
        </p>
        
        </div>
        
        <table class="table table-hover table-responsive-sm table-responsive-md table-responsive-lg    table-responsive-xl">
            <thead>
                <tr>
                    <TH style="width: 100">CODIGO</TH>
                    <TH style="width: 100">NOMBRE</TH>
                    <TH style="width: 100">CANTIDAD</TH>
                    <TH style="width: 100">ASIGNADA</TH>
                    <TH style="width: 100 ">FECHA</TH>
                    <TH style="width: 100 ">OBSERVACIONES</TH>

                    <TH style="width: 100 position:center" colspan="2"> ACCIONES </TH>
                </tr>
            </thead>
            <?php
            $i = 0;
            foreach ($listaDeOrdenProduccion as $key => $value) {
                ?>
            <tr>
                <td style="width: 100" class="text-dark">
                    <?php echo $listaDeOrdenProduccion[$i]->OrdPId; ?>
                </td>
                <td style="width: 100" class="text-dark">
                    <?php echo strtoupper($listaDeOrdenProduccion[$i]->ProNombre); ?>
                </td>
                <td style="width: 100" class="text-dark">
                    <?php echo strtoupper($listaDeOrdenProduccion[$i]->OrdPCant); ?>
                </td>
                <td style="width: 100" class="text-dark">
                   <b> <?php echo strtoupper($listaDeOrdenProduccion[$i]->OrdPAsignada); ?></b>
                </td>
                <td style="width: 100" class="text-dark">
                    <?php echo strtoupper($listaDeOrdenProduccion[$i]->OrdPFecha); ?>
                </td>
                <td style="width: 100" class="text-dark">
                    <?php echo strtoupper($listaDeOrdenProduccion[$i]->OrdPObservaciones); ?>
                </td>

                <td style="width: 100" class="text-dark">
                    <a class="btn btn-info btn-rounded m-b-10 m-l-5"  href="controladores/ControladorPrincipal.php?ruta=actualizarOrdenProduccion&idAct=<?php echo $listaDeOrdenProduccion[$i]->OrdPId; ?>">Actualizar</a>
                </td>
                <td style="width: 100" class="text-dark">
                    <a class="btn btn-danger btn-rounded m-b-10 m-l-5" href="controladores/ControladorPrincipal.php?ruta=eliminarOrdenProduccion&idAct=<?php echo $listaDeOrdenProduccion[$i]->OrdPId; ?>">Eliminar</a>
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



