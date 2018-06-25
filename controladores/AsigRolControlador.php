<?php
include_once './../modelos/ConstantesConexion.php';
require_once PATH . 'modelos/UsuarioBD.php';
require_once PATH . 'modelos/modeloAsigRol/AsigRolDAO.php';
require_once PATH . 'modelos/modeloAsigRol/AsigRolVO.php';
class AsigRolControlador {
    private $datos = array();
    public function __construct($datos) {
        $this->datos = $datos;
    }
    public function asigRolControlador() {
        switch ($this->datos["ruta"]) {
            case "listarAsigRol":
                
                if (isset($this->datos['pag']) && (int) $this->datos['pag'] > 0) {
                    $pagInicio = $this->datos['pag'];
                } else {
                    $pagInicio = 0;
                }
                $limit = 5;
                
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $consultarAsigRol = new AsigRolVO();
                
                $gestarAsigRol = new AsigRolDAO($usuarioBd, BASE, SERVIDOR);
                $resultadoConsultaPaginada = $gestarAsigRol->consultaPaginada($consultarAsigRol, $limit, $pagInicio);
                $totalRegistros = $resultadoConsultaPaginada[0];
                $listaDeAsigRol = $resultadoConsultaPaginada[1];
                $paginacionVinculos = $gestarAsigRol->enlacesPaginacion($totalRegistros, $limit, $pagInicio);
                
                //se almacenan en sesion las variables del filtro
//                $_SESSION['isbnF'] = (isset($this->datos['isbn'])) ? $this->datos['isbn'] : NULL;
                $_SESSION['id_usuario_sF'] = (isset($_POST['id_usuario_s'])) ? $_POST['id_usuario_s'] : NULL;/********CORRECTO*/
                $_SESSION['id_rolF'] = (isset($this->datos['id_rol'])) ? $this->datos['id_rol'] : NULL;
                $_SESSION['estadoF'] = (isset($this->datos['estado'])) ? $this->datos['estado'] : NULL;
                $_SESSION['buscarF'] = (isset($this->datos['buscar'])) ? $this->datos['buscar'] : NULL;

                
                session_start();
                $_SESSION['listaDeAsigRol'] = $listaDeAsigRol;
                $_SESSION['paginacionVinculos'] = $paginacionVinculos;
                $_SESSION['totalRegistros'] = $totalRegistros;
                
                
                $usuarioBd = null;
                $gestarAsigRol = null;
                header("location: ../principal.php?contenido=vistas/vistasAsigRol/listarRegistrosAsigRol.php");
                break;
                
            case "insertarAsigRol":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarAsigRol = new AsigRolDAO($usuarioBd, BASE, SERVIDOR);
//                $insertarLibro = new LibroVO();
                $existeAsigRol = $gestarAsigRol->seleccionarId(array($this->datos["d_usuario_s"])); //Se revisa si existe el libro en la base
                if (empty($existeAsigRol['registroEncontrado'])) {//Si no existe el libro en la base se procede a insertar
                    $insertoAsigRol = $gestarAsigRol->insertar($this->datos); //inserción de los campos en la tabla libros
                    $exitoInsercionAsigRol = $insertoAsigRol['inserto']; //indica si se logró inserción de los campos en la tabla libros
                    $resultadoInsercionAsigRol = $insertoAsigRol['resultado']; //Traer el id con que quedó el usuario de lo contrario la excepción o fallo
//                    if (1 == $exitoInsercionUsuario_s) {//si se logró la inserción de los campos en la tabla usuario_s insertar datos en tabla persona
                    session_start(); //se abre sesión para almacenar en ella el mensaje de inserción
                    $_SESSION['mensaje'] = "Registrado con èxito. Asignado Nuevo Cargo"; //mensaje de inserción
                    if ($this->datos['ruta'] == 'insertarAsigRol') {//si el formulario de la inserción es el de Agregar Libros y fue exitoso se devuelve a listarRegistrosLibros.php
//                        header("location:../principal.php?contenido=vistas/vistasLibros/listarRegistrosLibros.php");
//                        header("refresh:2;url=../principal.php?contenido=vistas/vistasLibros/listarRegistrosLibros.php");
                        header("location:../principal.php?contenido=vistas/vistasAsigRol/listarRegistrosAsigRol.php");
                    }
                } else {//Si el libro ya existe devolver datos al formulario por medio de la sesión
                    session_start();
                    $_SESSION['id_usuario_s'] = $this->datos['id_usuario_s'];
                    $_SESSION['id_rol'] = $this->datos['id_rol'];
                    $_SESSION['estado'] = $this->datos['estado'];
                    $_SESSION['mensaje'] = "El Empleado ya tiene Cargo.";
                    if ($this->datos['ruta'] == 'insertarAsigRol') {//si al insertar un usuario en el formulario de Agregar nuevo usuario y éste ya existe a listarRegistrosUsuario_s.php
                        header("location:../principal.php?contenido=vistas/vistasAsigRol/vistaInsertarAsigRol.php");
                    }
                }
                break;    
                
            case "actualizarAsigRol":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarAsigRol = new AsigRolDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaAsigRol = new AsigRolVO();
                $consultaDeAsigRol = $gestarAsigRol->seleccionarId(array($this->datos["idAct"])); //Se consulta el libro para traer los datos.

                $actualizarDatosAsigRol = $consultaDeAsigRol['registroEncontrado'][0];
                session_start();
                $_SESSION['actualizarDatosAsigRol'] = $actualizarDatosAsigRol;
                header("location:../principal.php?contenido=vistas/vistasAsigRol/vistaActualizarAsigRol.php");


                break;
            case "confirmaActualizarAsigRol":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarAsigRol = new AsigRolDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaAsigRol = new AsigRolVO();
                $actualizarAsigRol = $gestarAsigRol->actualizar(array($this->datos)); //Se envía datos del libro para actualizar.

                $actualizarAsigRol = $consultaDeAsigRol['registroEncontrado'][0];
                session_start();
                $_SESSION['mensaje'] = "Actualización realizada.";
                header("location:ControladorPrincipal.php?ruta=listarAsigRol");
                break;
            
            case "eliminarAsigRol":
            $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
            $gestarAsigRol = new AsigRolDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaAsigRol = new AsigRolVO();
            $consultaDeAsigRol = $gestarAsigRol->seleccionarId(array($this->datos["idAct"])); //Se consulta el Insumos para traer los datos.

            
            $eliminarDatosAsigRol = $consultaDeAsigRol['registroEncontrado'][0];
            session_start();
            $_SESSION['eliminarDatosAsigRol'] = $eliminarDatosAsigRol;
            header("location:../principal.php?contenido=vistas/vistasAsigRol/vistaEliminarAsigRol.php");

            session_start();            
            break;
            
                case "confirmaEliminarAsigRol":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarAsigRol = new AsigRolDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaAsigRol = new AsigRolVO();
                $eliminarAsigRol = $gestarAsigRol->eliminar(array($this->datos)); //Se envía datos del Insumos para eliminar.

                $eliminarAsigRol = $consultaDeAsigRol['registroEncontrado'][0];
                session_start();
                $_SESSION['mensaje'] = "Se ha eliminado el Cargo.";
                header("location:ControladorPrincipal.php?ruta=listarAsigRol");
                break;
            
            default:
                break;
        }
    }
}