<?php

include_once './../modelos/ConstantesConexion.php';
require_once PATH . 'modelos/UsuarioBD.php';
require_once PATH . 'modelos/modeloRegistro/RegistroDAO.php';
require_once PATH . 'modelos/modeloRegistro/RegistroVO.php';


class RegistroControlador {

    private $datos = array();

    public function __construct($datos) {
        $this->datos = $datos;
    }

    public function RegistroControlador() {

        switch ($this->datos["ruta"]) {
            case "listarRegistro":

                if (isset($this->datos['pag']) && (int) $this->datos['pag'] > 0) {
                    $pagInicio = $this->datos['pag'];
                } else {
                    $pagInicio = 0;
                }
                $limit = 5;
 
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $consultarRegistro = new RegistroVO();

                $gestarRegistro = new RegistroDAO($usuarioBd, BASE, SERVIDOR);
                $resultadoConsultaPaginada = $gestarRegistro->consultaPaginada($consultarRegistro, $limit, $pagInicio);
                $totalRegistros = $resultadoConsultaPaginada[0];
                $listaDeRegistro = $resultadoConsultaPaginada[1];
                $paginacionVinculos = $gestarRegistro->enlacesPaginacion($totalRegistros, $limit, $pagInicio);

                $gestarCategoriasRegistro = new CategoriaRegistroDAO($usuarioBd, BASE, SERVIDOR);
                $registroCategoriasRegistro = $gestarCategoriasRegistro->seleccionarTodos(); /*                 * *********** */

                session_start();
                $_SESSION['listaDeRegistro'] = $listaDeRegistro;
                $_SESSION['paginacionVinculos'] = $paginacionVinculos;
                $_SESSION['totalRegistros'] = $totalRegistros;
                $_SESSION['registroCategoriasRegistro'] = $registroCategoriasRegistro; /*                 * *********** */
                //se almacenan en sesion las variables del filtro
                $_SESSION['isbnF'] = (isset($_POST['isbn'])) ? $_POST['isbn'] : null; /********CORRECTO  CAMBIE TODA ESTA MRDA QUEHAY DE AQUI PARA ABAJO .L. ()POST ME VOY A Registro DAO/*/

                $_SESSION['tituloF'] = (isset($this->$_POST['titulo'])) ? $this->$_POST['titulo'] : NULL;
                $_SESSION['autorF'] = (isset($this->$_POST['autor'])) ? $this->$_POST['autor'] : NULL;
                $_SESSION['precioF'] = (isset($this->$_POST['precio'])) ? $this->$_POST['precio'] : NULL;
                $_SESSION['catLibIdF'] = (isset($this->$_POST['catLibId'])) ? $this->$_POST['catLibId'] : NULL;
                $_SESSION['catLibNombreF'] = (isset($this->$_POST['catLibNombre'])) ? $this->$_POST['catLibNombre'] : NULL;
                $_SESSION['buscarF'] = (isset($this->$_POST['buscar'])) ? $this->$_POST['buscar'] : NULL;



                $usuarioBd = null;
                $gestarRegistro = null;
                header("location: ../principal.php?contenido=vistas/vistasRegistro/listarRegistrosRegistro.php");
                break;

            case "insertarRegistro":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarRegistro = new RegistroDAO($usuarioBd, BASE, SERVIDOR);
//                $insertarRegistro = new RegistroVO();
                $existeRegistro = $gestarRegistro->seleccionarId(array($this->datos["isbn"])); //Se revisa si existe el Registro en la base
                if (empty($existeRegistro['registroEncontrado'])) {//Si no existe el Registro en la base se procede a insertar
                    $insertoRegistro = $gestarRegistro->insertar($this->datos); //inserción de los campos en la tabla Registro
                    $exitoInsercionRegistro = $insertoRegistro['inserto']; //indica si se logró inserción de los campos en la tabla Registro
                    $resultadoInsercionRegistro = $insertoRegistro['resultado']; //Traer el id con que quedó el usuario de lo contrario la excepción o fallo
//                    if (1 == $exitoInsercionUsuario_s) {//si se logró la inserción de los campos en la tabla usuario_s insertar datos en tabla persona
                    session_start(); //se abre sesión para almacenar en ella el mensaje de inserción
                    $_SESSION['mensaje'] = "Registrado con èxito. Agregado Nuevo Registro"; //mensaje de inserción
                    if ($this->datos['ruta'] == 'insertarRegistro') {//si el formulario de la inserción es el de Agregar Registro y fue exitoso se devuelve a listarRegistrosRegistro.php
//                        header("location:../principal.php?contenido=vistas/vistasRegistro/listarRegistrosRegistro.php");
//                        header("refresh:2;url=../principal.php?contenido=vistas/vistasRegistro/listarRegistrosRegistro.php");
                        header("location:../principal.php?contenido=vistas/vistasRegistro/listarRegistrosRegistro.php");
                    }
                } else {//Si el Registro ya existe devolver datos al formulario por medio de la sesión
                    session_start();
                    $_SESSION['isbn'] = $this->datos['isbn'];
                    $_SESSION['titulo'] = $this->datos['titulo'];
                    $_SESSION['autor'] = $this->datos['autor'];
                    $_SESSION['precio'] = $this->datos['precio'];
                    $_SESSION['categoriaRegistro_catLibId'] = $this->datos['categoriaRegistro_catLibId'];
                    $_SESSION['mensaje'] = "El Registro ya existe en el sistema.";
                    if ($this->datos['ruta'] == 'insertarRegistro') {//si al insertar un usuario en el formulario de Agregar nuevo usuario y éste ya existe a listarRegistrosUsuario_s.php
                        header("location:../principal.php?contenido=vistas/vistasRegistro/vistaInsertarRegistro.php");
                    }
                }
                break;
            case "actualizarRegistro":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarRegistro = new RegistroDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaRegistro = new RegistroVO();
                $consultaDeRegistro = $gestarRegistro->seleccionarId(array($this->datos["idAct"])); //Se consulta el Registro para traer los datos.


                $consultarCategoriasRegistro = new CategoriaRegistroDAO($usuarioBd, BASE, SERVIDOR);
                $registroCategoriasRegistro = $consultarCategoriasRegistro->seleccionarTodos();
                session_start();
                $_SESSION['registroCategoriasRegistro'] = $registroCategoriasRegistro;


                $actualizarDatosRegistro = $consultaDeRegistro['registroEncontrado'][0];
                session_start();
                $_SESSION['actualizarDatosRegistro'] = $actualizarDatosRegistro;
                header("location:../principal.php?contenido=vistas/vistasRegistro/vistaActualizarRegistro.php");


                break;
            case "confirmaActualizarRegistro":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarRegistro = new RegistroDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaRegistro = new RegistroVO();
                $actualizarRegistro = $gestarRegistro->actualizar(array($this->datos)); //Se envía datos del Registro para actualizar.

                $actualizarRegistro = $consultaDeRegistro['registroEncontrado'][0];
                session_start();
                $_SESSION['mensaje'] = "Actualización realizada.";
                header("location:ControladorPrincipal.php?ruta=listarRegistro");
                break;
            default:
                break;
        }
    }

}
