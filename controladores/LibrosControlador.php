<?php

include_once './../modelos/ConstantesConexion.php';
require_once PATH . 'modelos/UsuarioBD.php';
require_once PATH . 'modelos/modeloLibro/LibroDAO.php';
require_once PATH . 'modelos/modeloLibro/LibroVO.php';
require_once PATH . 'modelos/modeloCategoriaLibro/CategoriaLibroDAO.php';
require_once PATH . 'modelos/modeloCategoriaLibro/CategoriaLibroVO.php';

class LibrosControlador {

    private $datos = array();

    public function __construct($datos) {
        $this->datos = $datos;
    }

    public function librosControlador() {

        switch ($this->datos["ruta"]) {
            case "listarLibros":

                if (isset($this->datos['pag']) && (int) $this->datos['pag'] > 0) {
                    $pagInicio = $this->datos['pag'];
                } else {
                    $pagInicio = 0;
                }
                $limit = 5;

                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $consultarLibro = new LibroVO();

                $gestarLibros = new LibroDAO($usuarioBd, BASE, SERVIDOR);
                $resultadoConsultaPaginada = $gestarLibros->consultaPaginada($consultarLibro, $limit, $pagInicio);
                $totalRegistros = $resultadoConsultaPaginada[0];
                $listaDeLibros = $resultadoConsultaPaginada[1];
                $paginacionVinculos = $gestarLibros->enlacesPaginacion($totalRegistros, $limit, $pagInicio);

                $gestarCategoriasLibros = new CategoriaLibroDAO($usuarioBd, BASE, SERVIDOR);
                $registroCategoriasLibros = $gestarCategoriasLibros->seleccionarTodos(); /*                 * *********** */

                session_start();
                $_SESSION['listaDeLibros'] = $listaDeLibros;
                $_SESSION['paginacionVinculos'] = $paginacionVinculos;
                $_SESSION['totalRegistros'] = $totalRegistros;
                $_SESSION['registroCategoriasLibros'] = $registroCategoriasLibros; /*                 * *********** */
                //se almacenan en sesion las variables del filtro
                $_SESSION['isbnF'] = (isset($_POST['isbn'])) ? $_POST['isbn'] : null; /********CORRECTO  CAMBIE TODA ESTA MRDA QUEHAY DE AQUI PARA ABAJO .L. ()POST ME VOY A LIBRO DAO/*/

                $_SESSION['tituloF'] = (isset($this->datos['titulo'])) ? $this->datos['titulo'] : NULL;
                $_SESSION['autorF'] = (isset($this->datos['autor'])) ? $this->datos['autor'] : NULL;
                $_SESSION['precioF'] = (isset($this->datos['precio'])) ? $this->datos['precio'] : NULL;
                $_SESSION['catLibIdF'] = (isset($this->datos['catLibId'])) ? $this->datos['catLibId'] : NULL;
                $_SESSION['catLibNombreF'] = (isset($this->datos['catLibNombre'])) ? $this->datos['catLibNombre'] : NULL;
                $_SESSION['buscarF'] = (isset($this->datos['buscar'])) ? $this->datos['buscar'] : NULL;



                $usuarioBd = null;
                $gestarLibros = null;
                header("location: ../principal.php?contenido=vistas/vistasLibros/listarRegistrosLibros.php");
                break;

            case "insertarLibro":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarLibros = new LibroDAO($usuarioBd, BASE, SERVIDOR);
//                $insertarLibro = new LibroVO();
                $existeLibro = $gestarLibros->seleccionarId(array($this->datos["isbn"])); //Se revisa si existe el libro en la base
                if (empty($existeLibro['registroEncontrado'])) {//Si no existe el libro en la base se procede a insertar
                    $insertoLibro = $gestarLibros->insertar($this->datos); //inserción de los campos en la tabla libros
                    $exitoInsercionLibro = $insertoLibro['inserto']; //indica si se logró inserción de los campos en la tabla libros
                    $resultadoInsercionLibro = $insertoLibro['resultado']; //Traer el id con que quedó el usuario de lo contrario la excepción o fallo
//                    if (1 == $exitoInsercionUsuario_s) {//si se logró la inserción de los campos en la tabla usuario_s insertar datos en tabla persona
                    session_start(); //se abre sesión para almacenar en ella el mensaje de inserción
                    $_SESSION['mensaje'] = "Registrado con èxito. Agregado Nuevo Libro"; //mensaje de inserción
                    if ($this->datos['ruta'] == 'insertarLibro') {//si el formulario de la inserción es el de Agregar Libros y fue exitoso se devuelve a listarRegistrosLibros.php
//                        header("location:../principal.php?contenido=vistas/vistasLibros/listarRegistrosLibros.php");
//                        header("refresh:2;url=../principal.php?contenido=vistas/vistasLibros/listarRegistrosLibros.php");
                        header("location:../principal.php?contenido=vistas/vistasLibros/listarRegistrosLibros.php");
                    }
                } else {//Si el libro ya existe devolver datos al formulario por medio de la sesión
                    session_start();
                    $_SESSION['isbn'] = $this->datos['isbn'];
                    $_SESSION['titulo'] = $this->datos['titulo'];
                    $_SESSION['autor'] = $this->datos['autor'];
                    $_SESSION['precio'] = $this->datos['precio'];
                    $_SESSION['categoriaLibro_catLibId'] = $this->datos['categoriaLibro_catLibId'];
                    $_SESSION['mensaje'] = "El Libro ya existe en el sistema.";
                    if ($this->datos['ruta'] == 'insertarLibro') {//si al insertar un usuario en el formulario de Agregar nuevo usuario y éste ya existe a listarRegistrosUsuario_s.php
                        header("location:../principal.php?contenido=vistas/vistasLibros/vistaInsertarLibro.php");
                    }
                }
                break;
            case "actualizarLibro":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarLibros = new LibroDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaLibro = new LibroVO();
                $consultaDeLibro = $gestarLibros->seleccionarId(array($this->datos["idAct"])); //Se consulta el libro para traer los datos.


                $consultarCategoriasLibros = new CategoriaLibroDAO($usuarioBd, BASE, SERVIDOR);
                $registroCategoriasLibros = $consultarCategoriasLibros->seleccionarTodos();
                session_start();
                $_SESSION['registroCategoriasLibros'] = $registroCategoriasLibros;


                $actualizarDatosLibro = $consultaDeLibro['registroEncontrado'][0];
                session_start();
                $_SESSION['actualizarDatosLibro'] = $actualizarDatosLibro;
                header("location:../principal.php?contenido=vistas/vistasLibros/vistaActualizarLibro.php");


                break;
            case "confirmaActualizarLibro":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarLibros = new LibroDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaLibro = new LibroVO();
                $actualizarLibro = $gestarLibros->actualizar(array($this->datos)); //Se envía datos del libro para actualizar.

                $actualizarLibro = $consultaDeLibro['registroEncontrado'][0];
                session_start();
                $_SESSION['mensaje'] = "Actualización realizada.";
                header("location:ControladorPrincipal.php?ruta=listarLibros");
                break;
            default:
                break;
        }
    }

}
