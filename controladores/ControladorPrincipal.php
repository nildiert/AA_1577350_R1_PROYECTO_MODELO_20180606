<?php

/* * ********************************************** */
/* * ***COMIENZO DE PROGRAMACIÓN EN BACKEND******** */
/* * ********************************************** */
include_once './../modelos/ConstantesConexion.php';
include_once PATH . 'controladores/LibrosControlador.php';
include_once PATH . 'controladores/Validador.php';
/* * ********************************************** */
include_once PATH . 'controladores/Usuario_sControlador.php';
/* * ********************************************** */
/* * ********************************************** */
include_once PATH . 'controladores/CategoriaLibroControlador.php';
include_once PATH . 'modelos/modeloLibro/ValidadorLibros.php';
include_once PATH . 'controladores/InsumosControlador.php';
include_once PATH . 'modelos/modeloInsumos/ValidadorInsumos.php';
include_once PATH . 'controladores/ProductosControlador.php';
include_once PATH . 'modelos/modeloProductos/ValidadorProductos.php';
include_once PATH . 'controladores/OrdenProduccionControlador.php';
include_once PATH . 'modelos/modeloOrdenProduccion/ValidadorOrdenProduccion.php';

/* * ********************************************** */


$datos = array();

if (!empty($_POST) && isset($_POST["ruta"])) {
    $datos = $_POST;
}
if (!empty($_GET) && isset($_GET["ruta"])) {
    $datos = $_GET;
}

//echo "<pre>";
//print_r($datos);
//echo "</pre>";
//exit();

switch ($datos['ruta']) {

    case "mostrarInsertarLibros":
        $categoriaLibrosControlador = new CategoriaLibroControlador($datos);
        $categoriaLibrosControlador->categoriaLibroControlador();
        break;
    case "cerrarSesion":
    case "gestionDeAcceso":
        $usuario_sControlador = new Usuario_sControlador($datos);
        $usuario_sControlador->usuario_sControlador();
        break;
    case "gestionDeRegistro":
    case "insertarUsuario_s":
        if ($datos['ruta'] == "gestionDeRegistro") {

            $validarRegistro = new Validador();
            $erroresValidacion = $validarRegistro->validarFormularioRegistrarse($datos);
        }
        if ($datos['ruta'] == "insertarUsuario_s") {

            $validarRegistro = new ValidadorUsuarios_s();
            $erroresValidacion = $validarRegistro->validarFormularioRegistrarse($datos);
        }

//////////////////////////////////////////////////////////////
        if ($erroresValidacion) {

            $erroresValidacion = json_encode($erroresValidacion);
            if ($datos['ruta'] == "gestionDeRegistro") {
                header("location:../registro.php?erroresValidacion=" . $erroresValidacion);
            }
        }
        $usuario_sControlador = new Usuario_sControlador($datos);
        $usuario_sControlador->usuario_sControlador();
        break;

    case "listarLibros":
        $librosControlador = new LibrosControlador($datos);
        $librosControlador->librosControlador();
        break;
    case "insertarLibro":
        if ($datos['ruta'] == "insertarLibro") {

            $validarRegistro = new ValidadorLibros();
            $erroresValidacion = $validarRegistro->validarFormularioInsertarLibro($datos);
        }
//////////////////////////////////////////////////////////////
        if (isset($erroresValidacion)) {

            $erroresValidacion = json_encode($erroresValidacion);
            if ($datos['ruta'] == "insertarLibro") {
                header("location:../principal.php?contenido=vistas/vistasLibros/vistaInsertarLibro.php&erroresValidacion=" . $erroresValidacion);
            }
        }
        $librosControlador = new LibrosControlador($datos);
        $librosControlador->librosControlador();
        break;

    case "actualizarLibro":
        $librosControlador = new LibrosControlador($datos);
        $librosControlador->librosControlador();
        break;
    case "confirmaActualizarLibro":
        if ($datos['ruta'] == "confirmaActualizarLibro") {

            $validarRegistro = new ValidadorLibros();
            $erroresValidacion = $validarRegistro->validarFormularioInsertarLibro($datos);
        }
////////////////////////////////////////////////////////////////
        if (isset($erroresValidacion) && $erroresValidacion != FALSE) {
            $erroresValidacion = json_encode($erroresValidacion);
            if ($datos['ruta'] == "confirmaActualizarLibro") {
                header("location:../principal.php?contenido=vistas/vistasLibros/vistaActualizarLibro.php&erroresValidacion=" . $erroresValidacion);
            }
        }
        $librosControlador = new LibrosControlador($datos);
        $librosControlador->librosControlador();
        break;
    case "listarInsumos":
        $InsumosControlador = new InsumosControlador($datos);
        $InsumosControlador->InsumosControlador();
        break;
    case "insertarInsumos":
        if ($datos['ruta'] == "insertarInsumos") {

            $validarRegistro = new ValidadorInsumos();
            $erroresValidacion = $validarRegistro->validarFormularioInsertarInsumos($datos);
        }        
    case "actualizarInsumos":
        $InsumosControlador = new InsumosControlador($datos);
        $InsumosControlador->InsumosControlador();
        break;
    case "confirmaActualizarInsumos":
        if ($datos['ruta'] == "confirmaActualizarInsumos") {

            $validarRegistro = new ValidadorInsumos();
            $erroresValidacion = $validarRegistro->validarFormularioInsertarInsumos($datos);
        }
////////////////////////////////////////////////////////////////
        if (isset($erroresValidacion) && $erroresValidacion != FALSE) {
            $erroresValidacion = json_encode($erroresValidacion);
            if ($datos['ruta'] == "confirmaActualizarInsumos") {
                header("location:../principal.php?contenido=vistas/vistasInsumos/vistaActualizarInsumos.php&erroresValidacion=" . $erroresValidacion);
            }
        }
        $InsumosControlador = new InsumosControlador($datos);
        $InsumosControlador->InsumosControlador();
        break;
        case "eliminarInsumos":
        $InsumosControlador = new InsumosControlador($datos);
        $InsumosControlador->InsumosControlador();
        break;        
        case "confirmaEliminarInsumos":
            if ($datos['ruta'] == "confirmaEliminarInsumos") {
    
                $validarRegistro = new ValidadorInsumos();
                $erroresValidacion = $validarRegistro->validarFormularioInsertarInsumos($datos);
            }
    ////////////////////////////////////////////////////////////////
            if (isset($erroresValidacion) && $erroresValidacion != FALSE) {
                $erroresValidacion = json_encode($erroresValidacion);
                if ($datos['ruta'] == "confirmaEliminarInsumos") {
                    header("location:../principal.php?contenido=vistas/vistasInsumos/vistaEliminarInsumos.php&erroresValidacion=" . $erroresValidacion);
                }
            }
            $InsumosControlador = new InsumosControlador($datos);
            $InsumosControlador->InsumosControlador();
            break;
        case "eliminarProductos":
            $ProductosControlador = new ProductosControlador($datos);
            $ProductosControlador->ProductosControlador();
            break;        
        case "confirmaEliminarProductos":
                if ($datos['ruta'] == "confirmaEliminarProductos") {
        
                    $validarRegistro = new ValidadorProductos();
                    $erroresValidacion = $validarRegistro->validarFormularioInsertarProductos($datos);
                }
        ////////////////////////////////////////////////////////////////
                if (isset($erroresValidacion) && $erroresValidacion != FALSE) {
                    $erroresValidacion = json_encode($erroresValidacion);
                    if ($datos['ruta'] == "confirmaEliminarProductos") {
                        header("location:../principal.php?contenido=vistas/vistasProductos/vistaEliminarProductos.php&erroresValidacion=" . $erroresValidacion);
                    }
                }
                $ProductosControlador = new ProductosControlador($datos);
                $ProductosControlador->ProductosControlador();
                break;
    case "listarProductos":
        $ProductosControlador = new ProductosControlador($datos);
        $ProductosControlador->ProductosControlador();
        break;
    case "insertarProductos":
        if ($datos['ruta'] == "insertarProductos") {

            $validarRegistro = new ValidadorProductos();
            $erroresValidacion = $validarRegistro->validarFormularioInsertarProductos($datos);
        }        
    case "actualizarProductos":
        $ProductosControlador = new ProductosControlador($datos);
        $ProductosControlador->ProductosControlador();
        break;
    case "confirmaActualizarProductos":
        if ($datos['ruta'] == "confirmaActualizarProductos") {

            $validarRegistro = new ValidadorProductos();
            $erroresValidacion = $validarRegistro->validarFormularioInsertarProductos($datos);
        }
////////////////////////////////////////////////////////////////
        if (isset($erroresValidacion) && $erroresValidacion != FALSE) {
            $erroresValidacion = json_encode($erroresValidacion);
            if ($datos['ruta'] == "confirmaActualizarProductos") {
                header("location:../principal.php?contenido=vistas/vistasProductos/vistaActualizarProductos.php&erroresValidacion=" . $erroresValidacion);
            }
        }
        $ProductosControlador = new ProductosControlador($datos);
        $ProductosControlador->ProductosControlador();
        break;
        case "eliminarOrdenProduccion":
            $OrdenProduccionControlador = new OrdenProduccionControlador($datos);
            $OrdenProduccionControlador->OrdenProduccionControlador();
            break;        
        case "confirmaEliminarOrdenProduccion":
                if ($datos['ruta'] == "confirmaEliminarOrdenProduccion") {
        
                    $validarRegistro = new ValidadorOrdenProduccion();
                    $erroresValidacion = $validarRegistro->validarFormularioInsertarOrdenProduccion($datos);
                }
        ////////////////////////////////////////////////////////////////
                if (isset($erroresValidacion) && $erroresValidacion != FALSE) {
                    $erroresValidacion = json_encode($erroresValidacion);
                    if ($datos['ruta'] == "confirmaEliminarOrdenProduccion") {
                        header("location:../principal.php?contenido=vistas/vistasOrdenProduccion/vistaEliminarOrdenProduccion.php&erroresValidacion=" . $erroresValidacion);
                    }
                }
                $OrdenProduccionControlador = new OrdenProduccionControlador($datos);
                $OrdenProduccionControlador->OrdenProduccionControlador();
                break;
    case "listarOrdenProduccion":
        $OrdenProduccionControlador = new OrdenProduccionControlador($datos);
        $OrdenProduccionControlador->OrdenProduccionControlador();
        break;
    case "insertarOrdenProduccion":
        if ($datos['ruta'] == "insertarOrdenProduccion") {

            $validarRegistro = new ValidadorOrdenProduccion();
            $erroresValidacion = $validarRegistro->validarFormularioInsertarOrdenProduccion($datos);
        }        
    case "actualizarOrdenProduccion":
        $OrdenProduccionControlador = new OrdenProduccionControlador($datos);
        $OrdenProduccionControlador->OrdenProduccionControlador();
        break;
        case "confirmaActualizarOrdenProduccion":
        if ($datos['ruta'] == "confirmaActualizarOrdenProduccion") {
            
            $validarRegistro = new ValidadorOrdenProduccion();
            $erroresValidacion = $validarRegistro->validarFormularioInsertarOrdenProduccion($datos);
        }
        ////////////////////////////////////////////////////////////////
        if (isset($erroresValidacion) && $erroresValidacion != FALSE) {
            $erroresValidacion = json_encode($erroresValidacion);
            if ($datos['ruta'] == "confirmaActualizarOrdenProduccion") {
                header("location:../principal.php?contenido=vistas/vistasOrdenProduccion/vistaActualizarOrdenProduccion.php&erroresValidacion=" . $erroresValidacion);
            }
        }
        $OrdenProduccionControlador = new OrdenProduccionControlador($datos);
        $OrdenProduccionControlador->OrdenProduccionControlador();
        break;
    case "listarRegistro":
        $RegistroControlador = new RegistroControlador($datos);
        $RegistroControlador->RegistroControlador();
        break;
    case "insertarRegistro":
        if ($datos['ruta'] == "insertarRegistro") {

            $validarRegistro = new ValidadorRegistro();
            $erroresValidacion = $validarRegistro->validarFormularioInsertarRegistro($datos);
        }        
    case "Registro":
    if ($datos['ruta'] == "Registro") {
        header("location:../principal.php?contenido=registro2.php");
        break;
    }
     
  
}
    ?>
