<?php

include_once './../modelos/ConstantesConexion.php';
require_once PATH . 'modelos/UsuarioBD.php';
require_once PATH . 'modelos/modeloLibro/LibroDAO.php';
require_once PATH . 'modelos/modeloLibro/LibroVO.php';
require_once PATH . 'modelos/modeloCategoriaLibro/CategoriaLibroDAO.php';
require_once PATH . 'modelos/modeloCategoriaLibro/CategoriaLibroVO.php';

class CategoriaLibroControlador {

    private $datos = array();

    public function __construct($datos) {
        $this->datos = $datos;
    }

    public function categoriaLibroControlador() {

        switch ($this->datos["ruta"]) {
            case "mostrarInsertarLibros":

                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $consultarCategoriaLibro = new CategoriaLibroVO();

                $gestarCategoriasLibros = new CategoriaLibroDAO($usuarioBd, BASE, SERVIDOR);
                $registroCategoriasLibros = $gestarCategoriasLibros->seleccionarTodos(); /*                 * *********** */

                session_start();
                $_SESSION['registroCategoriasLibros'] = $registroCategoriasLibros;

                $usuarioBd = null;
                $gestarCategoriasLibros = null;

                header("location: ../principal.php?contenido=vistas/vistasLibros/vistaInsertarLibro.php");
                break;

            default:
                break;
        }
    }

}
