<?php

/* * ********************************************** */
/* * ***COMIENZO DE PROGRAMACIÓN EN BACKEND******** */
/* * ********************************************** */
include_once './../modelos/ConstantesConexion.php';
include_once PATH . 'controladores/LibrosControlador.php';
<<<<<<< HEAD
=======
include_once PATH . 'controladores/InsumosControlador.php';
>>>>>>> bugs

include_once PATH . 'controladores/Validador.php';
/* * ********************************************** */
include_once PATH . 'controladores/Usuario_sControlador.php';
/* * ********************************************** */
/* * ********************************************** */
include_once PATH . 'controladores/CategoriaLibroControlador.php';
include_once PATH . 'modelos/modeloLibro/ValidadorLibros.php';
/* * ********************************************** */
include_once PATH . 'controladores/InsumosControlador.php';

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
            if ($datos['ruta'] == "insertarUsuario_s") {
                header("location:../principal.php?contenido=vistas/vistasUsuario_s/vistaInsertarUsuario_s.php&erroresValidacion=" . $erroresValidacion);
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
    case "listarInsumos":
        $librosControlador = new LibrosControlador($datos);
        $librosControlador->librosControlador();
        break;    

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
}
?>
