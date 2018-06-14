<head>
<link href="../../../plantillas/ElaAdmin/css/style.css" rel="stylesheet">
</head>

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
if (isset($_SESSION['listaDeLibros'])) {
    $listaDeLibros = $_SESSION['listaDeLibros'];
}
if (isset($_SESSION['paginacionVinculos'])) {
    $paginacionVinculos = $_SESSION['paginacionVinculos'];
}
if (isset($_SESSION['totalRegistros'])) {
    $totalRegistros = $_SESSION['totalRegistros'];
}
if (isset($_SESSION['registroCategoriasLibros'])) {   /***************************/
    $registroCategoriasLibros = $_SESSION['registroCategoriasLibros'];
    $cantCategorias=count($registroCategoriasLibros);
}

//http://www.forosdelweb.com/f18/notice-session-had-already-been-started-ignoring-session_start-1021808/
//http://ajpdsoft.com/modules.php?name=News&file=print&sid=486

/* * ********Conservar filtro 'isbn' si lo hay************ */
if (isset($_POST['isbn']) && !isset($_SESSION['isbnF'])) {
    $_SESSION['isbnF'] = $_POST['isbn'];
} else if (isset($_SESSION['isbnF']) && !isset($_POST['isbn'])) {
    $_POST['isbn'] = $_SESSION['isbnF'];
}

/* * ********************************************* */
/* * ********Conservar filtro 'titulo' si lo hay************ */
if (isset($_POST['titulo']) && !isset($_SESSION['tituloF'])) {
    $_SESSION['tituloF'] = $_POST['titulo'];
} else if (isset($_SESSION['tituloF']) && !isset($_POST['titulo'])) {
    $_POST['titulo'] = $_SESSION['tituloF'];
}

/* * ********************************************* */
/* * ********Conservar filtro 'autor' si lo hay************ */
if (isset($_POST['autor']) && !isset($_SESSION['autorF'])) {
    $_SESSION['autorF'] = $_POST['autor'];
} else if (isset($_SESSION['autorF']) && !isset($_POST['autor'])) {
    $_POST['autor'] = $_SESSION['autorF'];
}

/* * ********************************************* */
/* * ********Conservar filtro 'precio' si lo hay************ */
if (isset($_POST['precio']) && !isset($_SESSION['precioF'])) {
    $_SESSION['precioF'] = $_POST['precio'];
} else if (isset($_SESSION['precioF']) && !isset($_POST['precio'])) {
    $_POST['precio'] = $_SESSION['precioF'];
}

/* * ********************************************* */
/* * ********Conservar filtro 'categoriaLibro_catLibId' si lo hay************ */
if (isset($_POST['categoriaLibro_catLibId']))
    $_SESSION['categoriaLibro_catLibIdF'] = $_POST['categoriaLibro_catLibId'];
if (isset($_SESSION['categoriaLibro_catLibIdF']) && !isset($_POST['categoriaLibro_catLibId']))
    $_POST['categoriaLibro_catLibId'] = $_SESSION['categoriaLibro_catLibIdF'];
/* * ********************************************* */
/* * ********Conservar filtro 'buscar' si lo hay************ */
if (isset($_POST['buscar']))
    $_SESSION['buscarF'] = $_POST['buscar'];
if (isset($_SESSION['buscarF']) && !isset($_POST['buscar']))
    $_POST['buscar'] = $_SESSION['buscarF'];
/* * ********************************************* */



?>

<div class="container-fluid">
<div class="card col-lg-4">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gestión de Libros.</h1>
        </div>                        
        <!-- /.col-lg-12 -->    
    </div>
    <!-- /.row -->
    

<!-- /.container-fluid -->
<div>
    

        <form name="formFiltroLibros" action="controladores/ControladorPrincipal.php" method="POST">
            <input type="hidden" name="ruta" value="listarLibros"/>
            <table class="table"> 
                <tr><td>ISBN:</td><td><input class="form-control input-default " type="number" name="isbn" onclick="" value="<?php
                        if (isset($registroAInsertar['isbn'])) {
                            echo $registroAInsertar['isbn'];
                        }
                        if (isset($_SESSION['isbnF'])) {
                            echo $_SESSION['isbnF'];
                        } else if ($_POST['isbn']) {echo $_POST['isbn'];}
;

                        

                        ?>"/></td>
                    <td>
                        <?php
                        if (isset($marcaCampo['isbn'])) {
                            echo $marcaCampo['isbn'];
                        }
                        ?>
                    </td>                        
                </tr> 
                <tr><td>TITULO:</td><td> <input class="form-control input-default " type="text" name="titulo" onclick="" value="<?php
                        if (isset($registroAInsertar['titulo'])) {
                            echo $registroAInsertar['titulo'];
                        }
                        if (isset($_SESSION['tituloF'])) {
                                echo $_SESSION['tituloF'];
                            } else if ($_POST['titulo']) {echo $_POST['titulo'];}
                        ;

                        ?>" /></td>
                    <td>
                        <?php
                        if (isset($marcaCampo['titulo'])) {
                            echo $marcaCampo['titulo'];
                        }
                        ?>
                    </td>                          
                </tr> 
                <tr><td>AUTOR:</td><td> <input class="form-control input-default " type="text" onclick="" name="autor" value="<?php
                        if (isset($registroAInsertar['autor'])) {
                            echo $registroAInsertar['autor'];
                        }
                        if (isset($_SESSION['autorF'])) {
                            echo $_SESSION['autorF'];
                        }
                        ?>"/></td>
                    <td>
                        <?php
                        if (isset($marcaCampo['autor'])) {
                            echo $marcaCampo['autor'];
                        }
                        ?>
                    </td>                          
                </tr> 
                <tr><td>PRECIO: </td><td><input type="number" class="form-control input-default " onclick=""  name="precio" value="<?php
                        if (isset($registroAInsertar['precio'])) {
                            echo $registroAInsertar['precio'];
                        }
                        if (isset($_SESSION['precioF'])) {
                            echo $_SESSION['precioF'];
                        }
                        ?>" /></td>
                    <td>
                        <?php
                        if (isset($marcaCampo['precio'])) {
                            echo $marcaCampo['precio'];
                        }
                        ?>
                    </td>                          
                </tr>                   
                <tr><td>CATEGORIA </td>
                    <td>
                        <select class="form-control input-default " id="categoriaLibro_catLibId" name="categoriaLibro_catLibId">                    
                            <?php
                            for ($j = 0; $j < $cantCategorias; $j++) {
                                ?>
                                <option value = "<?php echo $registroCategoriasLibros[$j]->catLibId; ?>" ><?php echo $registroCategoriasLibros[$j]->catLibId . " - " . $registroCategoriasLibros[$j]->catLibNombre; ?></option>             
                                <?php
                            }
                            ?>
                        </select> 
                    </td>
                    <td></td>                          
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
                <tr><td><input type="submit"  class="btn btn-info" value="Filtrar" name="enviar" title="Si es necesario limpie 'Buscar'"/></td>
                    <td><input type="reset" class="btn btn-info" value="limpiar" onclick="
                            javascript:document.formFiltroLibros.isbn.value = '';
                            javascript:document.formFiltroLibros.titulo.value = '';
                            javascript:document.formFiltroLibros.autor.value = '';
                            javascript:document.formFiltroLibros.precio.value = '';
                            javascript:document.formFiltroLibros.categoriaLibro_catLibId.value = '';
                            javascript:document.formFiltroLibros.submit();
                               "/></td><td></td></tr> 
            </table>
    
        </form>
    
    
</div>


    <div style="width: 800">
        <span class="izquierdo">
            <!--NUEVO BOTÓN PARA BUSCAR*************************-->
            <form name="formBuscarLibros" action="controladores/ControladorPrincipal.php" method="POST">
                <input type="hidden" name="ruta" value="listarLibros"/>
                <input class="form-control input-default" type="text" name="buscar" placeholder="Término a Buscar" value="<?php
                if (isset($_SESSION['buscarF'])) {
                    echo $_SESSION['buscarF'];
                }
                ?>">
                <input type="submit"  value="Buscar" title="Si es necesario limpie 'Filtrar'" class="btn btn-info ">&nbsp;&nbsp;||&nbsp;&nbsp;
                <input type="button" class="btn btn-info" value="Limpiar Búsqueda" onclick="javascript:document.formBuscarLibros.buscar.value = '';
                        javascript:document.formBuscarLibros.submit();">
            </form>
        </span>
    </div>
</div>

<br>
<div class="card">
    <span class="izquierdo">
        <!--NUEVO BOTÓN PARA DARLE FUNCIONALIDAD*************************-->

        <input type="button" class="btn btn-info" onclick="javascript:location.href = 'principal.php?contenido=vistas/vistasLibros/vistaInsertarLibro.php'" value="Nuevo Libro">

    </span>



<br>
<a name="listaDeLibros" id="a"></a>

    <p>Total de Registros: <?php echo $totalRegistros; ?></p>

    <table class="table table-hover">
        <thead>
            <tr>
                <td style="width: 100">ISBN</td>
                <td style="width: 100">TITULO</td>
                <td style="width: 100">AUTOR</td>
                <td style="width: 100">PRECIO</td>
                <td style="width: 100">ID CATEGORIA</td>
                <td style="width: 100">NOMBRE CATEGORIA</td>
                <td style="width: 100"  colspan="2"> ACCIONES </td>
            </tr>
        </thead> 
        <?php
        $i = 0;
        foreach ($listaDeLibros as $key => $value) {
            ?>
            <tr>
                <td style="width: 100"><?php echo $listaDeLibros[$i]->isbn; ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeLibros[$i]->titulo); ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeLibros[$i]->autor); ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeLibros[$i]->precio); ?></td>
                <td style="width: 100"><?php echo $listaDeLibros[$i]->catLibId; ?></td>
                <td style="width: 100"><?php echo $listaDeLibros[$i]->catLibNombre; ?></td>
                <td style="width: 100"><a href="controladores/ControladorPrincipal.php?ruta=actualizarLibro&idAct=<?php echo $listaDeLibros[$i]->isbn; ?>" >Actualizar</a></td>
                <td style="width: 100">  <a href="controladores/ControladorPrincipal.php?ruta=eliminarLibro&idAct=<?php echo $listaDeLibros[$i]->isbn; ?>">Eliminar</a>   </td>
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
</div>
