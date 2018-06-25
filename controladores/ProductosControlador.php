<?php

include_once './../modelos/ConstantesConexion.php';
require_once PATH . 'modelos/UsuarioBD.php';
require_once PATH . 'modelos/modeloProductos/ProductosDAO.php';
require_once PATH . 'modelos/modeloProductos/ProductosVO.php';


class ProductosControlador {

    private $datos = array();

    public function __construct($datos) {
        $this->datos = $datos;
    }

    public function ProductosControlador() {

        switch ($this->datos["ruta"]) {
            case "listarProductos":

                if (isset($this->datos['pag']) && (int) $this->datos['pag'] > 0) {
                    $pagInicio = $this->datos['pag'];
                } else {
                    $pagInicio = 0;
                }
                $limit = 5;

                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $consultarProductos = new ProductosVO();

                $gestarProductos = new ProductosDAO($usuarioBd, BASE, SERVIDOR);
                $resultadoConsultaPaginada = $gestarProductos->consultaPaginada($consultarProductos, $limit, $pagInicio);
                $totalRegistros = $resultadoConsultaPaginada[0];
                $listaDeProductos = $resultadoConsultaPaginada[1];
                $paginacionVinculos = $gestarProductos->enlacesPaginacion($totalRegistros, $limit, $pagInicio);



                session_start();
                $_SESSION['listaDeProductos'] = $listaDeProductos;
                $_SESSION['paginacionVinculos'] = $paginacionVinculos;
                $_SESSION['totalRegistros'] = $totalRegistros;

                //se almacenan en sesion las variables del filtro
                $_SESSION['ProCodigo'] = (isset($this->$_POST['ProCodigo'])) ? $this->$_POST['ProCodigo'] : NULL;
                $_SESSION['ProNombre'] = (isset($this->$_POST['ProNombre'])) ? $this->$_POST['ProNombre'] : NULL;
                $_SESSION['ProPresentacion'] = (isset($this->$_POST['ProPresentacion'])) ? $this->$_POST['ProPresentacion'] : NULL;
                $_SESSION['ProPrecioBogota'] = (isset($this->$_POST['ProPrecioBogota'])) ? $this->$_POST['ProPrecioBogota'] : NULL;
                $_SESSION['ProPrecioNacional'] = (isset($this->$_POST['ProPrecioNacional'])) ? $this->$_POST['ProPrecioNacional'] : NULL;
                $_SESSION['ProMaquila'] = (isset($this->$_POST['ProMaquila'])) ? $this->$_POST['ProMaquila'] : NULL;                
                $_SESSION['buscarF'] = (isset($this->$_POST['buscar'])) ? $this->$_POST['buscar'] : NULL;


                $usuarioBd = null;
                $gestarProductos = null;
                header("location: ../principal.php?contenido=vistas/vistasProductos/listarRegistrosProductos.php");
                break;


            case "insertarProductos":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarProductos = new ProductosDAO($usuarioBd, BASE, SERVIDOR);
//                $insertarProductos = new ProductosVO();
                $existeProductos = $gestarProductos->seleccionarId(array($this->datos["ProCodigo"])); //Se revisa si existe el Productos en la base
                if (empty($existeProductos['registroEncontrado'])) {//Si no existe el Productos en la base se procede a insertar
                    $insertoProductos = $gestarProductos->insertar($this->datos); //inserción de los campos en la tabla Productos
                    $exitoInsercionProductos = $insertoProductos['inserto']; //indica si se logró inserción de los campos en la tabla Productos
                    $resultadoInsercionProductos = $insertoProductos['resultado']; //Traer el id con que quedó el usuario de lo contrario la excepción o fallo
//                    if (1 == $exitoInsercionUsuario_s) {//si se logró la inserción de los campos en la tabla usuario_s insertar datos en tabla persona
                    session_start(); //se abre sesión para almacenar en ella el mensaje de inserción
                    $_SESSION['mensaje'] = "Registrado con èxito. Agregado Nuevo Productos"; //mensaje de inserción
                    if ($this->datos['ruta'] == 'insertarProductos') {//si el formulario de la inserción es el de Agregar Productos y fue exitoso se devuelve a listarRegistrosProductos.php
//                        header("location:../principal.php?contenido=vistas/vistasProductos/listarRegistrosProductos.php");
//                        header("refresh:2;url=../principal.php?contenido=vistas/vistasProductos/listarRegistrosProductos.php");
                        header("location:../principal.php?contenido=vistas/vistasProductos/listarRegistrosProductos.php");
                    }
                } else {//Si el Productos ya existe devolver datos al formulario por medio de la sesión
                    session_start();
                    $_SESSION['ProCodigo'] = $this->datos['ProCodigo'];
                    $_SESSION['ProNombre'] = $this->datos['ProNombre'];
                    $_SESSION['ProPresentacion'] = $this->datos['ProPresentacion'];
                    $_SESSION['ProPrecioBogota'] = $this->datos['ProPrecioBogota'];
                    $_SESSION['ProPrecioNacional'] = $this->datos['ProPrecioNacional'];
                    $_SESSION['ProMaquila'] = $this->datos['ProMaquila'];
                    $_SESSON['mensaje'] = "El Producto ya existe en el sistema.";
                    if ($this->datos['ruta'] == 'insertarProductos') {//si al insertar un usuario en el formulario de Agregar nuevo usuario y éste ya existe a listarRegistrosUsuario_s.php
                        header("location:../principal.php?contenido=vistas/vistasProductos/vistaInsertarProductos.php");
                    }
                }
                break;
            case "actualizarProductos":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarProductos = new ProductosDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaProductos = new ProductosVO();
                $consultaDeProductos = $gestarProductos->seleccionarId(array($this->datos["idAct"])); //Se consulta el Productos para traer los datos.



                session_start();



                $actualizarDatosProductos = $consultaDeProductos['registroEncontrado'][0];
                session_start();
                $_SESSION['actualizarDatosProductos'] = $actualizarDatosProductos;
                header("location:../principal.php?contenido=vistas/vistasProductos/vistaActualizarProductos.php");


                break;
            case "confirmaActualizarProductos":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarProductos = new ProductosDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaProductos = new ProductosVO();
                $actualizarProductos = $gestarProductos->actualizar(array($this->datos)); //Se envía datos del Productos para actualizar.

                $actualizarProductos = $consultaDeProductos['registroEncontrado'][0];
                session_start();
                $_SESSION['mensaje'] = "Actualización realizada.";
                header("location:ControladorPrincipal.php?ruta=listarProductos");
                break;
            case "eliminarProductos":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarProductos = new ProductosDAO($usuarioBd, BASE, SERVIDOR);
    //                $consultaProductos = new ProductosVO();
                $consultaDeProductos = $gestarProductos->seleccionarId(array($this->datos["idAct"])); //Se consulta el Productos para traer los datos.
    
                
                $eliminarDatosProductos = $consultaDeProductos['registroEncontrado'][0];
                session_start();
                $_SESSION['eliminarDatosProductos'] = $eliminarDatosProductos;
                header("location:../principal.php?contenido=vistas/vistasProductos/vistaeliminarProductos.php");
    
    
    
                session_start();            
                default:
                    break;
            case "confirmaEliminarProductos":
                    $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                    $gestarProductos = new ProductosDAO($usuarioBd, BASE, SERVIDOR);
    //                $consultaProductos = new ProductosVO();
                    $eliminarProductos = $gestarProductos->eliminar(array($this->datos)); //Se envía datos del Productos para eliminar.
    
                    $eliminarProductos = $consultaDeProductos['registroEncontrado'][0];
                    session_start();
                    $_SESSION['mensaje'] = "Se ha eliminado el Producto.";
                    header("location:ControladorPrincipal.php?ruta=listarProductos");
                    break;                
            }
    }

}
