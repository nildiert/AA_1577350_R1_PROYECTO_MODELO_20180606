<?php

include_once './../modelos/ConstantesConexion.php';
require_once PATH . 'modelos/UsuarioBD.php';
require_once PATH . 'modelos/modeloOrdenProduccion/OrdenProduccionDAO.php';
require_once PATH . 'modelos/modeloOrdenProduccion/OrdenProduccionVO.php';


class OrdenProduccionControlador {

    private $datos = array();

    public function __construct($datos) {
        $this->datos = $datos;
    }

    public function OrdenProduccionControlador() {

        switch ($this->datos["ruta"]) {
            case "listarOrdenProduccion":

                if (isset($this->datos['pag']) && (int) $this->datos['pag'] > 0) {
                    $pagInicio = $this->datos['pag'];
                } else {
                    $pagInicio = 0;
                }
                $limit = 5;

                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $consultarOrdenProduccion = new OrdenProduccionVO();

                $gestarOrdenProduccion = new OrdenProduccionDAO($usuarioBd, BASE, SERVIDOR);
                $resultadoConsultaPaginada = $gestarOrdenProduccion->consultaPaginada($consultarOrdenProduccion, $limit, $pagInicio);
                $totalRegistros = $resultadoConsultaPaginada[0];
                $listaDeOrdenProduccion = $resultadoConsultaPaginada[1];
                $paginacionVinculos = $gestarOrdenProduccion->enlacesPaginacion($totalRegistros, $limit, $pagInicio);



                session_start();
                $_SESSION['listaDeOrdenProduccion'] = $listaDeOrdenProduccion;
                $_SESSION['paginacionVinculos'] = $paginacionVinculos;
                $_SESSION['totalRegistros'] = $totalRegistros;

                //se almacenan en sesion las variables del filtro
                $_SESSION['OrdPId'] = (isset($this->$_POST['OrdPId'])) ? $this->$_POST['OrdPId'] : NULL;
                $_SESSION['ProNombre'] = (isset($this->$_POST['ProNombre'])) ? $this->$_POST['ProNombre'] : NULL;
                $_SESSION['OrdPCant'] = (isset($this->$_POST['OrdPCant'])) ? $this->$_POST['OrdPCant'] : NULL;
                $_SESSION['OrdPAsignada'] = (isset($this->$_POST['OrdPAsignada'])) ? $this->$_POST['OrdPAsignada'] : NULL;
                $_SESSION['OrdPFecha'] = (isset($this->$_POST['OrdPFecha'])) ? $this->$_POST['OrdPFecha'] : NULL;
                $_SESSION['OrdPObservaciones'] = (isset($this->$_POST['OrdPObservaciones'])) ? $this->$_POST['OrdPObservaciones'] : NULL;                
                $_SESSION['buscarF'] = (isset($this->$_POST['buscar'])) ? $this->$_POST['buscar'] : NULL;


                $usuarioBd = null;
                $gestarOrdenProduccion = null;
                header("location: ../principal.php?contenido=vistas/vistasOrdenProduccion/listarRegistrosOrdenProduccion.php");
                break;


            case "insertarOrdenProduccion":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarOrdenProduccion = new OrdenProduccionDAO($usuarioBd, BASE, SERVIDOR);
//                $insertarOrdenProduccion = new OrdenProduccionVO();
                $existeOrdenProduccion = $gestarOrdenProduccion->seleccionarId(array($this->datos["OrdPId"])); //Se revisa si existe el OrdenProduccion en la base
                if (empty($existeOrdenProduccion['registroEncontrado'])) {//Si no existe el OrdenProduccion en la base se procede a insertar
                    $insertoOrdenProduccion = $gestarOrdenProduccion->insertar($this->datos); //inserción de los campos en la tabla OrdenProduccion
                    $exitoInsercionOrdenProduccion = $insertoOrdenProduccion['inserto']; //indica si se logró inserción de los campos en la tabla OrdenProduccion
                    $resultadoInsercionOrdenProduccion = $insertoOrdenProduccion['resultado']; //Traer el id con que quedó el usuario de lo contrario la excepción o fallo
//                    if (1 == $exitoInsercionUsuario_s) {//si se logró la inserción de los campos en la tabla usuario_s insertar datos en tabla persona
                    session_start(); //se abre sesión para almacenar en ella el mensaje de inserción
                    $_SESSION['mensaje'] = "Registrado con èxito. Agregado Nuevo OrdenProduccion"; //mensaje de inserción
                    if ($this->datos['ruta'] == 'insertarOrdenProduccion') {//si el formulario de la inserción es el de Agregar OrdenProduccion y fue exitoso se devuelve a listarRegistrosOrdenProduccion.php
//                        header("location:../principal.php?contenido=vistas/vistasOrdenProduccion/listarRegistrosOrdenProduccion.php");
//                        header("refresh:2;url=../principal.php?contenido=vistas/vistasOrdenProduccion/listarRegistrosOrdenProduccion.php");
                        header("location:../principal.php?contenido=vistas/vistasOrdenProduccion/listarRegistrosOrdenProduccion.php");
                    }
                } else {//Si el OrdenProduccion ya existe devolver datos al formulario por medio de la sesión
                    session_start();
                    $_SESSION['OrdPId'] = $this->datos['OrdPId'];
                    $_SESSION['ProNombre'] = $this->datos['ProNombre'];
                    $_SESSION['OrdPCant'] = $this->datos['OrdPCant'];
                    $_SESSION['OrdPAsignada'] = $this->datos['OrdPAsignada'];
                    $_SESSION['OrdPFecha'] = $this->datos['OrdPFecha'];
                    $_SESSION['OrdPObservaciones'] = $this->datos['OrdPObservaciones'];
                    $_SESSON['mensaje'] = "La orden de producción ya existe en el sistema.";
                    if ($this->datos['ruta'] == 'insertarOrdenProduccion') {//si al insertar un usuario en el formulario de Agregar nuevo usuario y éste ya existe a listarRegistrosUsuario_s.php
                        header("location:../principal.php?contenido=vistas/vistasOrdenProduccion/vistaInsertarOrdenProduccion.php");
                    }
                }
                break;
            case "actualizarOrdenProduccion":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarOrdenProduccion = new OrdenProduccionDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaOrdenProduccion = new OrdenProduccionVO();
                $consultaDeOrdenProduccion = $gestarOrdenProduccion->seleccionarId(array($this->datos["idAct"])); //Se consulta el OrdenProduccion para traer los datos.



                session_start();



                $actualizarDatosOrdenProduccion = $consultaDeOrdenProduccion['registroEncontrado'][0];
                session_start();
                $_SESSION['actualizarDatosOrdenProduccion'] = $actualizarDatosOrdenProduccion;
                header("location:../principal.php?contenido=vistas/vistasOrdenProduccion/vistaActualizarOrdenProduccion.php");


                break;
            case "confirmaActualizarOrdenProduccion":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarOrdenProduccion = new OrdenProduccionDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaOrdenProduccion = new OrdenProduccionVO();
                $actualizarOrdenProduccion = $gestarOrdenProduccion->actualizar(array($this->datos)); //Se envía datos del OrdenProduccion para actualizar.

                $actualizarOrdenProduccion = $consultaDeOrdenProduccion['registroEncontrado'][0];
                session_start();
                $_SESSION['mensaje'] = "Actualización realizada.";
                header("location:ControladorPrincipal.php?ruta=listarOrdenProduccion");
                break;
            case "eliminarOrdenProduccion":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarOrdenProduccion = new OrdenProduccionDAO($usuarioBd, BASE, SERVIDOR);
    //                $consultaOrdenProduccion = new OrdenProduccionVO();
                $consultaDeOrdenProduccion = $gestarOrdenProduccion->seleccionarId(array($this->datos["idAct"])); //Se consulta el OrdenProduccion para traer los datos.
    
                
                $eliminarDatosOrdenProduccion = $consultaDeOrdenProduccion['registroEncontrado'][0];
                session_start();
                $_SESSION['eliminarDatosOrdenProduccion'] = $eliminarDatosOrdenProduccion;
                header("location:../principal.php?contenido=vistas/vistasOrdenProduccion/vistaeliminarOrdenProduccion.php");
    
    
    
                session_start();            
                default:
                    break;
            case "confirmaEliminarOrdenProduccion":
                    $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                    $gestarOrdenProduccion = new OrdenProduccionDAO($usuarioBd, BASE, SERVIDOR);
    //                $consultaOrdenProduccion = new OrdenProduccionVO();
                    $eliminarOrdenProduccion = $gestarOrdenProduccion->eliminar(array($this->datos)); //Se envía datos del OrdenProduccion para eliminar.
    
                    $eliminarOrdenProduccion = $consultaDeOrdenProduccion['registroEncontrado'][0];
                    session_start();
                    $_SESSION['mensaje'] = "Se ha eliminado la orden de producción.";
                    header("location:ControladorPrincipal.php?ruta=listarOrdenProduccion");
                    break;                
            }
    }

}
