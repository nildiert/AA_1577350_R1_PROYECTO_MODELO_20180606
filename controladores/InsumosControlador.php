<?php

include_once './../modelos/ConstantesConexion.php';
require_once PATH . 'modelos/UsuarioBD.php';
require_once PATH . 'modelos/modeloInsumos/InsumosDAO.php';
require_once PATH . 'modelos/modeloInsumos/InsumosVO.php';


class InsumosControlador {

    private $datos = array();

    public function __construct($datos) {
        $this->datos = $datos;
    }

    public function InsumosControlador() {

        switch ($this->datos["ruta"]) {
            case "listarInsumos":

                if (isset($this->datos['pag']) && (int) $this->datos['pag'] > 0) {
                    $pagInicio = $this->datos['pag'];
                } else {
                    $pagInicio = 0;
                }
                $limit = 5;

                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $consultarInsumos = new InsumosVO();

                $gestarInsumos = new InsumosDAO($usuarioBd, BASE, SERVIDOR);
                $resultadoConsultaPaginada = $gestarInsumos->consultaPaginada($consultarInsumos, $limit, $pagInicio);
                $totalRegistros = $resultadoConsultaPaginada[0];
                $listaDeInsumos = $resultadoConsultaPaginada[1];
                $paginacionVinculos = $gestarInsumos->enlacesPaginacion($totalRegistros, $limit, $pagInicio);



                session_start();
                $_SESSION['listaDeInsumos'] = $listaDeInsumos;
                $_SESSION['paginacionVinculos'] = $paginacionVinculos;
                $_SESSION['totalRegistros'] = $totalRegistros;
                $_SESSION['registroCategoriasInsumos'] = $registroCategoriasInsumos; /*                 * *********** */
                //se almacenan en sesion las variables del filtro
                $_SESSION['InsCodigo'] = (isset($this->datos['InsCodigo'])) ? $this->datos['InsCodigo'] : NULL;
                $_SESSION['InsNombre'] = (isset($this->datos['InsNombre'])) ? $this->datos['InsNombre'] : NULL;
                $_SESSION['InsCantActual'] = (isset($this->datos['InsCantActual'])) ? $this->datos['InsCantActual'] : NULL;
                $_SESSION['InsUnidadMedida'] = (isset($this->datos['InsUnidadMedida'])) ? $this->datos['InsUnidadMedida'] : NULL;
                $_SESSION['InsPrecio'] = (isset($this->datos['InsPrecio'])) ? $this->datos['InsPrecio'] : NULL;
                $_SESSION['buscarF'] = (isset($this->datos['buscar'])) ? $this->datos['buscar'] : NULL;


                $usuarioBd = null;
                $gestarInsumos = null;
                header("location: ../principal.php?contenido=vistas/vistasInsumos/listarRegistrosInsumos.php");
                break;


            case "insertarInsumos":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarInsumos = new InsumosDAO($usuarioBd, BASE, SERVIDOR);
//                $insertarInsumos = new InsumosVO();
                $existeInsumos = $gestarInsumos->seleccionarId(array($this->datos["InsCodigo"])); //Se revisa si existe el Insumos en la base
                if (empty($existeInsumos['registroEncontrado'])) {//Si no existe el Insumos en la base se procede a insertar
                    $insertoInsumos = $gestarInsumos->insertar($this->datos); //inserción de los campos en la tabla Insumos
                    $exitoInsercionInsumos = $insertoInsumos['inserto']; //indica si se logró inserción de los campos en la tabla Insumos
                    $resultadoInsercionInsumos = $insertoInsumos['resultado']; //Traer el id con que quedó el usuario de lo contrario la excepción o fallo
//                    if (1 == $exitoInsercionUsuario_s) {//si se logró la inserción de los campos en la tabla usuario_s insertar datos en tabla persona
                    session_start(); //se abre sesión para almacenar en ella el mensaje de inserción
                    $_SESSION['mensaje'] = "Registrado con èxito. Agregado Nuevo Insumos"; //mensaje de inserción
                    if ($this->datos['ruta'] == 'insertarInsumos') {//si el formulario de la inserción es el de Agregar Insumos y fue exitoso se devuelve a listarRegistrosInsumos.php
//                        header("location:../principal.php?contenido=vistas/vistasInsumos/listarRegistrosInsumos.php");
//                        header("refresh:2;url=../principal.php?contenido=vistas/vistasInsumos/listarRegistrosInsumos.php");
                        header("location:../principal.php?contenido=vistas/vistasInsumos/listarRegistrosInsumos.php");
                    }
                } else {//Si el Insumos ya existe devolver datos al formulario por medio de la sesión
                    session_start();
                    $_SESSION['InsCodigo'] = $this->datos['InsCodigo'];
                    $_SESSION['InsNombre'] = $this->datos['InsNombre'];
                    $_SESSION['InsCantActual'] = $this->datos['InsCantActual'];
                    $_SESSION['InsUnidadMedida'] = $this->datos['InsUnidadMedida'];
                    $_SESSION['InsPrecio'] = $this->datos['InsPrecio'];
                    $_SESSION['mensaje'] = "El Insumos ya existe en el sistema.";
                    if ($this->datos['ruta'] == 'insertarInsumos') {//si al insertar un usuario en el formulario de Agregar nuevo usuario y éste ya existe a listarRegistrosUsuario_s.php
                        header("location:../principal.php?contenido=vistas/vistasInsumos/vistaInsertarInsumos.php");
                    }
                }
                break;
            case "actualizarInsumos":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarInsumos = new InsumosDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaInsumos = new InsumosVO();
                $consultaDeInsumos = $gestarInsumos->seleccionarId(array($this->datos["idAct"])); //Se consulta el Insumos para traer los datos.


                $consultarCategoriasInsumos = new CategoriaInsumosDAO($usuarioBd, BASE, SERVIDOR);
                $registroCategoriasInsumos = $consultarCategoriasInsumos->seleccionarTodos();
                session_start();
                $_SESSION['registroCategoriasInsumos'] = $registroCategoriasInsumos;


                $actualizarDatosInsumos = $consultaDeInsumos['registroEncontrado'][0];
                session_start();
                $_SESSION['actualizarDatosInsumos'] = $actualizarDatosInsumos;
                header("location:../principal.php?contenido=vistas/vistasInsumos/vistaActualizarInsumos.php");


                break;
            case "confirmaActualizarInsumos":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarInsumos = new InsumosDAO($usuarioBd, BASE, SERVIDOR);
//                $consultaInsumos = new InsumosVO();
                $actualizarInsumos = $gestarInsumos->actualizar(array($this->datos)); //Se envía datos del Insumos para actualizar.

                $actualizarInsumos = $consultaDeInsumos['registroEncontrado'][0];
                session_start();
                $_SESSION['mensaje'] = "Actualización realizada.";
                header("location:ControladorPrincipal.php?ruta=listarInsumos");
                break;
            default:
                break;
        }
    }

}
