<?php

require_once PATH . 'modelos/modeloUsuario_s/Usuario_sDAO.php';
require_once PATH . 'modelos/modeloUsuario_s/Usuario_sVO.php';
require_once PATH . 'modelos/modeloPersona/PersonaVO.php';
require_once PATH . 'modelos/modeloPersona/PersonaDAO.php';
require_once PATH . 'controladores/ManejoSesiones/BloqueDeSeguridad.php';
require_once PATH . 'controladores/ManejoSesiones/ClaseSesion.php';
require_once PATH . 'modelos/modeloRol/RolDAO.php';

class Usuario_sControlador {

    private $datos = array();

    public function __construct($datos) {
        $this->datos = $datos;
    }

    public function usuario_sControlador() {
        switch ($this->datos["ruta"]) {

            case "cerrarSesion":
                $cerrarSesion = new ClaseSesion(); 
                $cerrarSesion->cerrarSesion(); //Se cierra sesión

                break;
            case "gestionDeAcceso":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);

                $gestarUsuario_s = new Usuario_sDAO($usuarioBd, BASE, SERVIDOR);
                $consultarUsuario = new Usuario_sVO();

                $this->datos["password"] = md5($this->datos["password"]); //Encriptamos password para que coincida con la base de datos
                $this->datos["documento"] = ""; //Para logueo crear ésta variable límpia por cuanto se utiliza el mismo método de registrarse a continuación
                $existeUsuario_s = $gestarUsuario_s->seleccionarId(array($this->datos["documento"], $this->datos['email'], $this->datos["password"])); //Se revisa si existe la persona en la base                
                if ((0 != $existeUsuario_s['exitoSeleccionId']) && ($existeUsuario_s['registroEncontrado'][0]->usuLogin == $this->datos['email'])) {
                    session_start(); //se abre sesión para almacenar en ella el mensaje de inserción
                    $_SESSION['mensaje'] = "Bienvenido a nuestra Aplicación."; //mensaje de inserción
                    //Consultamos los roles de la persona logueada
                    $consultaRoles = new RolDAO($usuarioBd, BASE, SERVIDOR);
                    $rolesUsuario = $consultaRoles->seleccionarRolPorPersona(array($existeUsuario_s['registroEncontrado'][0]->perDocumento));
                    //ABRIR SESION ******************************************
                    $sesionPermitida = new ClaseSesion(); //Se abre sesiòn
                    $sesionPermitida->crearSesion(array($existeUsuario_s['registroEncontrado'][0], $rolesUsuario)); //Se envìa a la sesiòn los datos del usuario logeado

                    header("location:../principal.php");
                } else {
                    session_start(); //se abre sesión para almacenar en ella el mensaje de inserción
                    $_SESSION['mensaje'] = "Credenciales de acceso incorrectas"; //mensaje de inserción
                    header("location:../login.php");
                }
                break;
            case "listarUsuario_s":
                if (isset($this->datos['pag']) && (int) $this->datos['pag'] > 0) {
                    $pagInicio = $this->datos['pag'];
                } else {
                    $pagInicio = 0;
                }
                $limit = 5;

                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);

                $gestarUsuario_s = new Usuario_sDAO($usuarioBd, BASE, SERVIDOR);
                $consultarUsuario = new Usuario_sVO();
// Futura implementación asignar valores del $_POST  al VO y pasarlo como parámetro
                $resultadoConsultaPaginada = $gestarUsuario_s->consultaPaginada($consultarUsuario, $limit, $pagInicio);
                $totalRegistros = $resultadoConsultaPaginada[0];
                $listaDeUsuario_s = $resultadoConsultaPaginada[1];

                $paginacionVinculos = $gestarUsuario_s->enlacesPaginacion($totalRegistros, $limit, $pagInicio);
                session_start();
                $_SESSION['listaDeUsuario_s'] = $listaDeUsuario_s;
                $_SESSION['paginacionVinculos'] = $paginacionVinculos;
                $_SESSION['totalRegistros'] = $totalRegistros;
                //se almacenan en sesion las variables del filtro
                $_SESSION['usuIdF'] = (isset($this->datos['usuId'])) ? $this->datos['usuId'] : NULL;
                $_SESSION['perDocumentoF'] = (isset($this->datos['perDocumento'])) ? $this->datos['perDocumento'] : NULL;
                $_SESSION['perApellidoF'] = (isset($this->datos['perApellido'])) ? $this->datos['perApellido'] : NULL;
                $_SESSION['perNombreF'] = (isset($this->datos['perNombre'])) ? $this->datos['perNombre'] : NULL;
                $_SESSION['usuLoginF'] = (isset($this->datos['usuLogin'])) ? $this->datos['usuLogin'] : NULL;
                $_SESSION['usuEstadoF'] = (isset($this->datos['usuEstado'])) ? $this->datos['usuEstado'] : NULL;
                $_SESSION['buscarF'] = (isset($this->datos['buscar'])) ? $this->datos['buscar'] : NULL;
                $usuarioBd = null;
                $gestarUsuario_s = null;
                header("location: ../principal.php?contenido=vistas/vistasUsuario_s/listarRegistrosUsuario_s.php#listaDeUsuario_s");

                break;
            case "actualizarPersona":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $verPersona = new DAOPersona($usuarioBd, BASE, SERVIDOR);
//                $claveUsuario = new VOUsuario();
//                $claveUsuario->setId($this->datos['id']);
                $consultarPersona = new VOPersona();
                $consultarPersona->setCorreo($this->datos['id']); //El campo correo será el "id" identificador a actualizar en este ejercicio.
//        $datosDeLibro = $verLibro->consulta($consultarLibro);
                $datosDePersona = $verPersona->consultaPaginada($consultarPersona, NULL, NULL);
                include_once 'vistas/moduloA/vistasPersona/templateActualizarPersona.php';
                $usuarioBd = null;
                $verPersona = null;
                $claveUsuario = NULL;
                $consultarPersona = null;
                $datos = null;
                $datosDePersona = null;
                break;
            case "confirmaActualizarPersona":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $actualizarPersona = new DAOPersona($usuarioBd, BASE, SERVIDOR);
                $claveUsuario = new VOUsuario();
                $claveUsuario->setId($this->datos["id"]);
                $datosPersona = new VOPersona();
                $datosPersona->setId($claveUsuario);
                $datosPersona->setDocumento($this->datos["documento"]);
                $datosPersona->setCorreo($this->datos["correo"]);
                $datosPersona->setNombre($this->datos["nombre"]);
                $datosPersona->setApellido($this->datos["apellido"]);
                $datosPersona->setProfesion($this->datos["profesion"]);
                $datosPersona->setFoto_ruta($this->datos["foto_ruta"]);
                if (!empty($this->datos["foto_archivo"])) {
                    $datosPersona->setFoto_archivo($this->datos["foto_archivo"]);
                } else {
                    $datosPersona->setFoto_archivo("");
                }
                $datosPersona->setTel_fij($this->datos["tel_fij"]);
                $datosPersona->setTel_cel($this->datos["tel_cel"]);
                $datosPersona->setCiudad($this->datos["ciudad"]);
                $datosPersona->setDireccion($this->datos["direccion"]);
                $datosPersona->setDireccion_1($this->datos["direccion_1"]);
//                $datosPersona->setEstado($this->datos["estado"]);

                $confirmaMensaje = $actualizarPersona->actualizar($datosPersona);
                break;

            case "gestionDeRegistro":
            case "insertarUsuario_s":
                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                $gestarUsuario_s = new Usuario_sDAO($usuarioBd, BASE, SERVIDOR);
//                $insertarUsuario = new Usuario_sVO();
                $existeUsuario_s = $gestarUsuario_s->seleccionarId(array($this->datos["documento"], $this->datos['email'])); //Se revisa si existe la persona en la base
                if (0 == $existeUsuario_s['exitoSeleccionId']) {//Si no existe la persona en la base se procede a insertar
                    $this->datos['password'] = md5($this->datos['password']); //se encripta la contraseña que viene
                    $insertoUsuario_s = $gestarUsuario_s->insertar($this->datos); //inserción de los campos en la tabla usuario_s
                    $exitoInsercionUsuario_s = $insertoUsuario_s['inserto']; //indica si se logró inserción de los campos en la tabla usuario_s
                    $resultadoInsercionUsuario_s = $insertoUsuario_s['resultado']; //Traer el id con que quedó el usuario de lo contrario la excepción o fallo
//                    if (1 == $exitoInsercionUsuario_s) {//si se logró la inserción de los campos en la tabla usuario_s insertar datos en tabla persona
                    $gestarPersona = new PersonaDAO($usuarioBd, BASE, SERVIDOR);
                    $this->datos['perId'] = $resultadoInsercionUsuario_s; //Id 'usuID' con quedó insertado el usuario, con el fin que quede el mismo en la tabla 'persona'
                    $insertoPersona = $gestarPersona->insertar($this->datos); //inserción de los campos en la tabla persona
                    $exitoInsercionPersona = $insertoPersona['inserto']; //indica si se logró inserción de los campos en la tabla persona
                    $resultadoInsercionPersona = $insertoPersona['resultado']; //***Si logró insertar trae el id con que quedó la persona de lo contrario la excepción o fallo
                    //FALTA AQUÍ IMPLEMENTAR LA VALIDACIÓN EN CASO DE NO INSERTAR EN LA TABLA persona
                    session_start(); //se abre sesión para almacenar en ella el mensaje de inserción
                    $_SESSION['mensaje'] = "Registrado con èxito. Puede Ingresar al sistema"; //mensaje de inserción
                    if ($this->datos['ruta'] == 'gestionDeRegistro') {//si el formulario de la inserción es el de registrarse y fue exitoso se devuelve a login.php
                        header("location:../login.php");
                    }
                    if ($this->datos['ruta'] == 'insertarUsuario_s') {//si el formulario de la inserción es el de Agregar Usuarios y fue exitoso se devuelve a listarRegistrosUsuario_s.php
//                        header("location:../principal.php?contenido=vistas/vistasUsuario_s/listarRegistrosUsuario_s.php");
                        header("refresh:2;url=../principal.php?contenido=vistas/vistasUsuario_s/listarRegistrosUsuario_s.php");
                    }
                } else {//Si la persona ya existe se abre sesión para almacenar en ella el mensaje de inserción y devolver datos al formulario por medio de la sesión
                    session_start();
                    $_SESSION['documento'] = $this->datos['documento'];
                    $_SESSION['nombre'] = $this->datos['nombre'];
                    $_SESSION['apellidos'] = $this->datos['apellidos'];
                    $_SESSION['email'] = $this->datos['email'];
                    $_SESSION['mensaje'] = "El usuario ya existe en el sistema.";
                    if ($this->datos['ruta'] == 'gestionDeRegistro') {//si al insertar un usuario en el formulario de registrarse y éste ya existe a registro.php
                        header("location:../registro.php");
                    }
                    if ($this->datos['ruta'] == 'insertarUsuario_s') {//si al insertar un usuario en el formulario de Agregar nuevo usuario y éste ya existe a listarRegistrosUsuario_s.php
                        header("location:../principal.php?contenido=vistas/vistasUsuario_s/vistaInsertarUsuario_s.php");
                    }
                }
                break;
            case "confirmarIngresarPersona":

                $usuarioBd = new UsuarioBd(USUARIO_BD, CONTRASENIA_BD);
                ////Se alista el VOUsuario con 'login' para verificar si ya existe
                $nuevoUsuario = new VOUsuario();
                if (isset($this->datos['login'])) {
                    $nuevoUsuario->setLogin($this->datos['login']);
                }
                ////Se verifica si ya existe el login
                $insertarUsuario = new DAOUsuario($usuarioBd, BASE, SERVIDOR);
                $existeLogin = $insertarUsuario->existenciaUsuario($nuevoUsuario);
                ////Se alista el VOPersona con 'correo' para verificar si ya existe
                $nuevaPersona = new VOPersona();
                $nuevaPersona->setCorreo($this->datos['correo']);
                ////Se verifica si ya existe el correo
                $insertarPersona = new DAOPersona($usuarioBd, BASE, SERVIDOR);
                $existePersona = $insertarPersona->existenciaPersona($nuevaPersona);
                ////Se alista el VOPersona con 'documento' para verificar si ya existe
                $nuevaPersonaDoc = new VOPersona();
                $nuevaPersonaDoc->setCorreo($this->datos['documento']);
                ////Se verifica si ya existe el documento
                $insertarPersonaDoc = new DAOPersona($usuarioBd, BASE, SERVIDOR);
                $existePersonaDoc = $insertarPersona->existenciaPersona($nuevaPersonaDoc);
                ////////////////////////////////////////////////////////////////                
                if (($existeLogin || $existePersona || $existePersonaDoc) && $this->datos['ruta'] == "confirmarIngresarPersona") {
                    echo '<script type="text/javascript">
                        alert("No se logro la insercion. Ya existe el \'login\',\'correo electronico\' o \'documento\' ");
                        /*window.location = "controlador.php?ruta=ingresarPersona"*/
                        </script>';
                    include_once './vistas/moduloA/vistasPersona/templateActualizarPersona.php';
//                    exit();
                }
                if (($existeLogin || $existePersona || $existePersonaDoc) && $this->datos['ruta'] == "ingresarRegistro") {
                    echo '<script type="text/javascript">
                        alert("No se logro la insercion. Ya existe el \'login\',\'correo electronico\' o \'documento\' ");
                        /*window.location = "registro.php"*/
                        </script>';
                    include_once './registro.php';
//                    exit();
                }
                ///Insertamos los datos correspondientes a la tabla 'usuario'/// 
                if (isset($this->datos['password'])) {
                    $nuevoUsuario->setPassword($this->datos['password']);
                }
                $nuevoUsuario->setEstado(1);
                $insertarUsuario->insertarUsuario($nuevoUsuario);
                //Verificamos con que 'id' de usuario quedó la inserción y lo 
                //utilizamos como 'id' en la tabla persona//////////////////////
                $usuarioInsertado = $insertarUsuario->consultaPaginada($nuevoUsuario, NULL, NULL);
                $nuevoUsuario->setId($usuarioInsertado[0]->id);
                ///Insertamos los datos correspondientes a la tabla 'persona'///
                $nuevaPersona->setId($nuevoUsuario);
                $nuevaPersona->setDocumento($this->datos["documento"]);
                $nuevaPersona->setCorreo($this->datos["correo"]);
                $nuevaPersona->setNombre($this->datos["nombre"]);
                $nuevaPersona->setApellido($this->datos["apellido"]);
                $nuevaPersona->setProfesion($this->datos["profesion"]);
                $nuevaPersona->setFoto_ruta($this->datos["foto_ruta"]);
//                $nuevaPersona->setFoto_archivo($this->datos["foto_archivo"]);////Implementaremos el tratamiento de la imagen posteriormente
                $nuevaPersona->setFoto_archivo(""); ////Implementaremos el tratamiento de la imagen posteriormente
                $nuevaPersona->setTel_fij($this->datos["tel_fij"]);
                $nuevaPersona->setTel_cel($this->datos["tel_cel"]);
                $nuevaPersona->setCiudad($this->datos["ciudad"]);
                $nuevaPersona->setDireccion($this->datos["direccion"]);
                $nuevaPersona->setDireccion_1($this->datos["direccion_1"]);
                $nuevaPersona->setEstado(1);
                ////Confirmamos o no la inserción///////////////////////////////
                $confirmaMensaje = $insertarPersona->insertarPersona($nuevaPersona);
                if ($confirmaMensaje && ($this->datos['ruta'] == 'confirmaIngresarPersona')) { //si se logró la inserción comunicamos
                    echo '<script type="text/javascript">
                        alert("Registro Insertado...");
                        window.location = "controlador.php?ruta=listarPersonas"
                        </script>';
                } elseif (($this->datos['ruta'] == 'confirmaIngresarPersona')) {
                    echo '<script type="text/javascript">
                        alert("No se logro la insercion__.");
                        window.location = "controlador.php?ruta=ingresarPersona"
                        </script>';
                }
                if ($confirmaMensaje && ($this->datos['ruta'] == 'ingresarRegistro')) { //si se logró la inserción comunicamos
                    echo '<script type="text/javascript">
                        alert("Registro Insertadooo.");
                        window.location = "index.php"
                        </script>';
                } elseif (($this->datos['ruta'] == 'ingresarRegistro')) {
                    echo '<script type="text/javascript">
                        alert("No se logro la insercionnn.");
                        window.location = "registro.php"
                        </script>';
                }
                break;
        }
    }

}
