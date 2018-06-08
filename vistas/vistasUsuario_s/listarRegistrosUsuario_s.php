<?php
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";exit();

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    echo "<script languaje='javascript'>alert('$mensaje')</script>";
    unset($_SESSION['mensaje']);
}
if (isset($_SESSION['listaDeUsuario_s'])) {
    $listaDeUsuario_s = $_SESSION['listaDeUsuario_s'];
}
if (isset($_SESSION['paginacionVinculos'])) {
    $paginacionVinculos = $_SESSION['paginacionVinculos'];
}
if (isset($_SESSION['totalRegistros'])) {
    $totalRegistros = $_SESSION['totalRegistros'];
}

//http://www.forosdelweb.com/f18/notice-session-had-already-been-started-ignoring-session_start-1021808/
//http://ajpdsoft.com/modules.php?name=News&file=print&sid=486

/* * ********Conservar filtro 'titulo' si lo hay************ */
if (isset($_POST['usuId']))
    $_SESSION['usuIdF'] = $_POST['usuId'];
if (isset($_SESSION['usuIdF']) && !isset($_POST['usuId']))
    $_POST['usuId'] = $_SESSION['usuIdF'];
/* * ********************************************* */
/* * ********Conservar filtro 'titulo' si lo hay************ */
if (isset($_POST['perDocumento']))
    $_SESSION['perDocumentoF'] = $_POST['perDocumento'];
if (isset($_SESSION['perDocumentoF']) && !isset($_POST['perDocumento']))
    $_POST['perDocumento'] = $_SESSION['perDocumentoF'];
/* * ********************************************* */
/* * ********Conservar filtro 'autor' si lo hay************ */
if (isset($_POST['perApellido']))
    $_SESSION['perApellidoF'] = $_POST['perApellido'];
if (isset($_SESSION['perApellidoF']) && !isset($_POST['perApellido']))
    $_POST['perApellido'] = $_SESSION['perApellidoF'];
/* * ********************************************* */
/* * ********Conservar filtro 'precio' si lo hay************ */
if (isset($_POST['perNombre']))
    $_SESSION['perNombreF'] = $_POST['perNombre'];
if (isset($_SESSION['perNombreF']) && !isset($_POST['perNombre']))
    $_POST['perNombre'] = $_SESSION['perNombreF'];
/* * ********************************************* */
/* * ********Conservar filtro 'precio' si lo hay************ */
if (isset($_POST['usuLogin']))
    $_SESSION['usuLoginF'] = $_POST['usuLogin'];
if (isset($_SESSION['perApellidoF']) && !isset($_POST['usuLogin']))
    $_POST['usuLogin'] = $_SESSION['perApellidoF'];
/* * ********************************************* */
/* * ********Conservar filtro 'precio' si lo hay************ */
if (isset($_POST['usuEstado']))
    $_SESSION['usuEstadoF'] = $_POST['usuEstado'];
if (isset($_SESSION['usuEstadoF']) && !isset($_POST['usuEstado']))
    $_POST['usuEstado'] = $_SESSION['usuEstadoF'];
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
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gestión de Usuarios.</h1>
        </div>                        
        <!-- /.col-lg-12 -->    
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<div>
    <!--<form name="formFiltroLibro" action="principal.php?contenido=Vistas/VistasLibros/listarLibros.php" method="POST">-->
    <fieldset class="scheduler-border"><legend class="scheduler-border">FILTRO</legend>

        <form name="formFiltroUsuario_s" action="controladores/ControladorPrincipal.php" method="POST">
            <input type="hidden" name="ruta" value="listarUsuario_s"/>
            <table> 
                <tr><td>ID:</td><td><input type="number" name="usuId" onclick="" value="<?php
if (isset($registroAInsertar['usuId'])) {
    echo $registroAInsertar['usuId'];
}
if (isset($_SESSION['usuIdF'])) {
    echo $_SESSION['usuIdF'];
}
?>"/></td>
                    <td><?php
                        if (isset($marcaCampo['usuId'])) {
                            echo $marcaCampo['usuId'];
                        }
?></td>                        
                </tr> 
                <tr><td>DOCUMENTO:</td><td> <input type="number" name="perDocumento" onclick="" value="<?php
                        if (isset($registroAInsertar['perDocumento'])) {
                            echo $registroAInsertar['perDocumento'];
                        }
                        if (isset($_SESSION['perDocumentoF'])) {
                            echo $_SESSION['perDocumentoF'];
                        }
?>" /></td>
                    <td><?php
                        if (isset($marcaCampo['perDocumento'])) {
                            echo $marcaCampo['perDocumento'];
                        }
?></td>                          
                </tr> 
                <tr><td>APELLIDO:</td><td> <input type="text" onclick="" name="perApellido" value="<?php
                        if (isset($registroAInsertar['perApellido'])) {
                            echo $registroAInsertar['perApellido'];
                        }
                        if (isset($_SESSION['perApellidoF'])) {
                            echo $_SESSION['perApellidoF'];
                        }
?>" /></td>
                    <td><?php
                        if (isset($marcaCampo['perApellido'])) {
                            echo $marcaCampo['perApellido'];
                        }
?></td>                          
                </tr> 
                <tr><td>NOMBRE </td><td><input type="text" onclick=""  name="perNombre" value="<?php
                        if (isset($registroAInsertar['perNombre'])) {
                            echo $registroAInsertar['perNombre'];
                        }
                        if (isset($_SESSION['perNombreF'])) {
                            echo $_SESSION['perNombreF'];
                        }
?>" /></td>
                    <td><?php
                        if (isset($marcaCampo['perNombre'])) {
                            echo $marcaCampo['perNombre'];
                        }
?></td>                          
                </tr>
                <tr><td>LOGIN/CORREO: </td><td><input type="text" onclick=""  name="usuLogin" value="<?php
                        if (isset($registroAInsertar['usuLogin'])) {
                            echo $registroAInsertar['usuLogin'];
                        }
                        if (isset($_SESSION['usuLoginF'])) {
                            echo $_SESSION['usuLoginF'];
                        }
?>" /></td>
                    <td><?php
                        if (isset($marcaCampo['usuLogin'])) {
                            echo $marcaCampo['usuLogin'];
                        }
?></td>                          
                </tr>            
                <tr><td>ESTADO: </td>
                    <td>
                        <select type="number" id="usuEstado" name="usuEstado">   
                            <option value =<?php
                        if ((isset($registroAInsertar['usuEstado']) && $registroAInsertar['usuEstado'] == '1') || (isset($_SESSION['usuEstadoF']) && $_SESSION['usuEstadoF'] == '1')) {
                            echo "1 selected";
                        } else
                            echo '1';
?> >1</option>             
                            <option value =<?php
                            if ((isset($registroAInsertar['usuEstado']) && $registroAInsertar['usuEstado'] == '0') || (isset($_SESSION['usuEstadoF']) && $_SESSION['usuEstadoF'] == '0')) {
                                echo "0 selected";
                            } else
                                echo '0';
?> >0</option>             
                        </select> 
                    </td>
                    <td></td>                          
                </tr>            
    <!--            <tr><td>CATEGORIA </td>
                    <td>
                        <select id="categoriaLibro_catLibId" name="categoriaLibro_catLibId">                    
                <?php
//                        for ($j = 0; $j < $cantCategorias; $j++) {
                ?>
                                <option value = "<?php // echo $registroCategoriasLibros[$j]->catLibId;         ?>" ><?php // echo $registroCategoriasLibros[$j]->catLibId . " - " . $registroCategoriasLibros[$j]->catLibNombre;         ?></option>             
                <?php
//                        }
                ?>
                        </select> 
                    </td>
                    <td></td>                          
                </tr>            -->
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
                            javascript:document.formFiltroUsuario_s.usuId.value = '';
                            javascript:document.formFiltroUsuario_s.perDocumento.value = '';
                            javascript:document.formFiltroUsuario_s.perApellido.value = '';
                            javascript:document.formFiltroUsuario_s.perNombre.value = '';
                            javascript:document.formFiltroUsuario_s.usuLogin.value = '';
                            javascript:document.formFiltroUsuario_s.submit();
                               "/></td><td></td></tr> 
            </table>
        </form>
    </fieldset>
</div>

<fieldset class="scheduler-border"><legend class="scheduler-border">BUSCAR</legend>

    <div style="width: 800">
        <span class="izquierdo">
            <!--NUEVO BOTÓN PARA BUSCAR*************************-->
            <form name="formBuscarUsuario_s" action="controladores/ControladorPrincipal.php" method="POST">
                <input type="hidden" name="ruta" value="listarUsuario_s"/>
                <input type="text" name="buscar" placeholder="Término a Buscar" value="<?php
                if (isset($_SESSION['buscarF'])) {
                    echo $_SESSION['buscarF'];
                }
                ?>">
                <input type="submit"  value="Buscar" title="Si es necesario limpie 'Filtrar'">&nbsp;&nbsp;||&nbsp;&nbsp;
                <input type="button"  value="Limpiar Búsqueda" onclick="javascript:document.formBuscarformBuscarUsuario_s.buscar.value = '';
                        javascript:document.formBuscarformBuscarUsuario_s.submit();">
            </form>
        </span>
    </div>        
</fieldset>
<br>
<div style="width: 800">
    <span class="izquierdo">
        <!--NUEVO BOTÓN PARA DARLE FUNCIONALIDAD*************************-->

        <input type="button" onclick="javascript:location.href = 'principal.php?contenido=vistas/vistasUsuario_s/vistaInsertarUsuario_s.php'" value="Nuevo Usuario">

    </span>
</div>
<br>
<a name="listaDeUsuario_s" id="a"></a>
<div style="width: 800">
    <p>Total de Registros: <?php echo $totalRegistros; ?></p>
    <table border=1>
        <thead>
            <tr>
                <td style="width: 100">ID USUARIO</td>
                <td style="width: 100">DOCUMENTO</td>
                <td style="width: 100">APELLIDO</td>
                <td style="width: 100">NOMBRE</td>
                <td style="width: 100">LOGIN/CORREO</td>
                <td style="width: 100">ESTADO</td>
                <td style="width: 100"  colspan="2"> ACCIONES </td>
            </tr>
        </thead> 
        <?php
        $i = 0;
        foreach ($listaDeUsuario_s as $key => $value) {
            ?>
            <tr>
                <td style="width: 100"><?php echo $listaDeUsuario_s[$i]->usuId; ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeUsuario_s[$i]->perDocumento); ?></td>
                <td style="width: 100"><?php echo strtoupper($listaDeUsuario_s[$i]->perApellido); ?></td>;
                <td style="width: 100"><?php echo strtoupper($listaDeUsuario_s[$i]->perNombre); ?></td>
                <td style="width: 100"><?php echo $listaDeUsuario_s[$i]->usuLogin; ?></td>;
                <td style="width: 100"><?php echo $listaDeUsuario_s[$i]->usuEstado; ?></td>;
                <td style="width: 100"><a href="controladores/ControladorPrincipal.php?ruta=actualizarUsuario_s&idAct=<?php echo $listaDeUsuario_s[$i]->usuario_s_usuId; ?>" >Actualizar</a></td>
                <td style="width: 100">  <a href="controladores/ControladorPrincipal.php?ruta=eliminarUsuario_s&idAct=<?php echo $listaDeUsuario_s[$i]->usuario_s_usuId; ?>">Eliminar</a>   </td>
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
