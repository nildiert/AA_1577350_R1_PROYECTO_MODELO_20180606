

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
if (isset($_SESSION['listaDeProductos'])) {
    $listaDeProductos = $_SESSION['listaDeProductos'];
}
if (isset($_SESSION['paginacionVinculos'])) {
    $paginacionVinculos = $_SESSION['paginacionVinculos'];
}
if (isset($_SESSION['totalRegistros'])) {
    $totalRegistros = $_SESSION['totalRegistros'];
}



//http://www.forosdelweb.com/f18/notice-session-had-already-been-started-ignoring-session_start-1021808/
//http://ajpdsoft.com/modules.php?name=News&file=print&sid=486

/* * ********Conservar filtro 'ProCodigo' si lo hay************ */
if (isset($_POST['ProCodigo']) && !isset($_SESSION['ProCodigoF'])) {
    $_SESSION['ProCodigoF'] = $_POST['ProCodigo'];
} else if (isset($_SESSION['ProCodigoF']) && !isset($_POST['ProCodigo'])) {
    $_POST['ProCodigo'] = $_SESSION['ProCodigoF'];
} // Copie y pegue
/* * ********************************************* */
/* * ********Conservar filtro 'ProNombre' si lo hay************ */
if (isset($_POST['ProNombre']) && !isset($_SESSION['ProNombreF'])) {
    $_SESSION['ProNombreF'] = $_POST['ProNombre'];
} else if (isset($_SESSION['ProNombreF']) && !isset($_POST['ProNombre'])) {
    $_POST['ProNombre'] = $_SESSION['ProNombreF'];
} // Copie y pegue
/* * ********************************************* */
/* * ********Conservar filtro 'ProPresentacion' si lo hay************ */
if (isset($_POST['ProPresentacion']) && !isset($_SESSION['ProPresentacionF'])) {
    $_SESSION['ProPresentacionF'] = $_POST['ProPresentacion'];
} else if (isset($_SESSION['ProPresentacionF']) && !isset($_POST['ProPresentacion'])) {
    $_POST['ProPresentacion'] = $_SESSION['ProPresentacionF'];
} // Copie y pegue
/* * ********************************************* */
/* * ********Conservar filtro 'ProPrecioBogota' si lo hay************ */
if (isset($_POST['ProPrecioBogota']) && !isset($_SESSION['ProPrecioBogotaF'])) {
    $_SESSION['ProPrecioBogotaF'] = $_POST['ProPrecioBogota'];
} else if (isset($_SESSION['ProPrecioBogotaF']) && !isset($_POST['ProPrecioBogota'])) {
    $_POST['ProPrecioBogota'] = $_SESSION['ProPrecioBogotaF'];
} // Copie y pegue
/* * ********************************************* */
/* * ********Conservar filtro 'ProPrecioNacional' si lo hay************ */
if (isset($_POST['ProPrecioNacional']) && !isset($_SESSION['ProPrecioNacionalF'])) {
    $_SESSION['ProPrecioNacionalF'] = $_POST['ProPrecioNacional'];
} else if (isset($_SESSION['ProPrecioNacionalF']) && !isset($_POST['ProPrecioNacional'])) {
    $_POST['ProPrecioNacional'] = $_SESSION['ProPrecioNacionalF'];
} // Copie y pegue
/* * ********Conservar filtro 'ProMaquila' si lo hay************ */
if (isset($_POST['ProMaquila']) && !isset($_SESSION['ProMaquilaF'])) {
    $_SESSION['ProMaquilaF'] = $_POST['ProMaquila'];
} else if (isset($_SESSION['ProMaquilaF']) && !isset($_POST['ProMaquila'])) {
    $_POST['ProMaquila'] = $_SESSION['ProMaquilaF'];
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
                    <h1 class="page-header">Gestión de Productos</h1>
                </div>

                <form name="formFiltroProductos" action="controladores/ControladorPrincipal.php" method="POST">
                    <input type="hidden" class="form-control input-default" name="ruta" value="listarProductos" />
                    <label for="ProCodigo"></label>

                    <input type="text" placeholder="Código" class="form-control input-default" name="ProCodigo" onclick="" value="<?php
                    if (isset($registroAInsertar['ProCodigo'])) {
                        echo $registroAInsertar['ProCodigo'];
                    }
                    if (isset($_SESSION['ProCodigoF'])) { //Cambie desde aqui
                        echo $_SESSION['ProCodigoF'];
                    } else if ($_POST['ProCodigo']) {echo $_POST['ProCodigo'];} 
                    
                    ;//Hasta aqui Luego se va a libros controlador
                                ?>" />

                    <?php
                        
                        if (isset($marcaCampo['ProCodigo'])) {
                            echo $marcaCampo['ProCodigo'];
                        }
                        ?>

                    <label for="ProNombre"></label>
                    <input type="text" placeholder="Nombre" class="form-control input-default" name="ProNombre" onclick="" value="<?php
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
                    <label for="ProPresentacion"></label>
                    <input type="double" placeholder="Presentación" class="form-control input-default" name="ProPresentacion" onclick="" value="<?php
                          if (isset($registroAInsertar['ProPresentacion'])) {
                            echo $registroAInsertar['ProPresentacion'];
                        }
                        if (isset($_SESSION['ProPresentacionF'])) { //Cambie desde aqui
                            echo $_SESSION['ProPresentacionF'];
                        } else if ($_POST['ProPresentacion']) {echo $_POST['ProPresentacion'];} 
                        ;//Hasta aqui Luego se va a libros controlador
                                ?>" />

                    <?php
                                if (isset($marcaCampo['ProPresentacion'])) {
                                    echo $marcaCampo['ProPresentacion'];
                                }
                                ?>


                    <label for="ProPrecioBogota"></label>
                    <input type="text" placeholder="Precio Bogotá" class="form-control input-default" onclick="" name="ProPrecioBogota" value="<?php
                        if (isset($registroAInsertar['ProPrecioBogota'])) {
                            echo $registroAInsertar['ProPrecioBogota'];
                        }
                        if (isset($_SESSION['ProPrecioBogotaF'])) { //Cambie desde aqui
                            echo $_SESSION['ProPrecioBogotaF'];
                        } else if ($_POST['ProPrecioBogota']) {echo $_POST['ProPrecioBogota'];} 
                        ;//Hasta aqui Luego se va a libros controlador
                                ?>" />

                    <?php
                                if (isset($marcaCampo['ProPrecioBogota'])) {
                                    echo $marcaCampo['ProPrecioBogota'];
                                }
                                ?>
                    <label for="ProPrecioNacional"></label>
                    
                        <input placeholder="Precio Nacional" class="form-control input-default" type="number" onclick="" name="ProPrecioNacional" value="<?php
                        if (isset($registroAInsertar['ProPrecioNacional'])) {
                            echo $registroAInsertar['ProPrecioNacional'];
                        }
                        if (isset($_SESSION['ProPrecioNacionalF'])) { //Cambie desde aqui
                            echo $_SESSION['ProPrecioNacionalF'];
                        } else if ($_POST['ProPrecioNacional']) {echo $_POST['ProPrecioNacional'];} 
                        ;//Hasta aqui Luego se va a libros controlador
                                ?>" />
                    
                        <?php
                                if (isset($marcaCampo['ProPrecioNacional'])) {
                                    echo $marcaCampo['ProPrecioNacional'];
                                }
                                ?>
                    <label for="ProMaquila"></label>
                    
                        <input placeholder="Precio Maquila" class="form-control input-default" type="number" onclick="" name="ProMaquila" value="<?php
                        if (isset($registroAInsertar['ProMaquila'])) {
                            echo $registroAInsertar['ProMaquila'];
                        }
                        if (isset($_SESSION['ProMaquilaF'])) { //Cambie desde aqui
                            echo $_SESSION['ProMaquilaF'];
                        } else if ($_POST['ProMaquila']) {echo $_POST['ProMaquila'];} 
                        ;//Hasta aqui Luego se va a libros controlador
                                ?>" />
                    
                        <?php
                                if (isset($marcaCampo['ProMaquila'])) {
                                    echo $marcaCampo['ProMaquila'];
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
                                    javascript:document.formFiltroProductos.ProCodigo.value = '';
                                    javascript:document.formFiltroProductos.ProNombre.value = '';
                                    javascript:document.formFiltroProductos.ProPresentacion.value = '';                            
                                    javascript:document.formFiltroProductos.ProPrecioBogota.value = '';
                                    javascript:document.formFiltroProductos.ProPrecioNacional.value = '';
                                    javascript:document.formFiltroProductos.ProMaquila.value = '';
                                    javascript:document.formFiltroProductos.submit();
                                       " />
                        </div>
                </div>


        
                </form>
    
</div>
<div class="col-lg-1"></div>
                        <div class="col-lg-5 card p-30 " >
                            <div class="card-title ">
                                <h1>Buscar Productos</h1>
                            </div>

    
                    <!--NUEVO BOTÓN PARA BUSCAR*************************-->
                        <div class="row">
                                 <form name="formBuscarProductos" class="container" action="controladores/ControladorPrincipal.php" method="POST">
                        
                                        <input type="hidden" name="ruta" value="listarProductos" />
                
                                        <input class="form-control input-default col-md-8" type="text" name="buscar" placeholder="Término a Buscar" value="<?php
                                    if (isset($_SESSION['buscarF'])) {
                                        echo $_SESSION['buscarF'];
                                    }
                                    ?>">
                                    </div>
                <div class="button-list m-t-10">                                    
                        
                                        <input  type="submit" value="Buscar" class="btn btn-info col-md-4 " title="Si es necesario limpie 'Filtrar'">
                        
                        
                                    <input type="button" class="btn btn-info  m-l-5" value="Limpiar Búsqueda" onclick="javascript:document.formBuscarProductos.buscar.value = '';
                                    javascript:document.formBuscarProductos.submit();">
                        
                </div>
                    </form>
        
        
        
        
        
        
                <br>
        
            </div>
        </div>
    </div>

    <div class="card ">
        <span class="izquierdo">
            <!--NUEVO BOTÓN PARA DARLE FUNCIONALIDAD*************************-->

            <input type="button" onclick="javascript:location.href = 'principal.php?contenido=vistas/vistasProductos/vistaInsertarProductos.php'"
                class="btn btn-info " value="Nuevo Insumo">
            <br>
        </span>

        <br>
        <div>
        <a name="listaDeProductos" id="a"></a>
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
                    <TH style="width: 100">PRESENTACIÓN</TH>
                    <TH style="width: 100">PRECIO BOGOTÁ</TH>
                    <TH style="width: 100 ">PRECIO NACIONAL</TH>
                    <TH style="width: 100 ">COSTO MAQUILA</TH>

                    <TH style="width: 100 position:center" colspan="2"> ACCIONES </TH>
                </tr>
            </thead>
            <?php
            $i = 0;
            foreach ($listaDeProductos as $key => $value) {
                ?>
            <tr>
                <td style="width: 100" class="text-dark">
                    <?php echo $listaDeProductos[$i]->ProCodigo; ?>
                </td>
                <td style="width: 100" class="text-dark">
                    <?php echo strtoupper($listaDeProductos[$i]->ProNombre); ?>
                </td>
                <td style="width: 100" class="text-dark">
                    <?php echo strtoupper($listaDeProductos[$i]->ProPresentacion); ?>
                </td>
                <td style="width: 100" class="text-dark">
                   <b> <?php echo strtoupper($listaDeProductos[$i]->ProPrecioBogota); ?></b>
                </td>
                <td style="width: 100" class="text-dark">
                    <?php echo strtoupper($listaDeProductos[$i]->ProPrecioNacional); ?>
                </td>
                <td style="width: 100" class="text-dark">
                    <?php echo strtoupper($listaDeProductos[$i]->ProMaquila); ?>
                </td>

                <td style="width: 100" class="text-dark">
                    <a class="btn btn-info btn-rounded m-b-10 m-l-5"  href="controladores/ControladorPrincipal.php?ruta=actualizarProductos&idAct=<?php echo $listaDeProductos[$i]->ProCodigo; ?>">Actualizar</a>
                </td>
                <td style="width: 100" class="text-dark">
                    <a class="btn btn-danger btn-rounded m-b-10 m-l-5" href="controladores/ControladorPrincipal.php?ruta=eliminarProductos&idAct=<?php echo $listaDeProductos[$i]->ProCodigo; ?>">Eliminar</a>
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



