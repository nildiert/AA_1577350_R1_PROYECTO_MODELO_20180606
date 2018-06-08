<?php

include_once PATH . 'modelos/ConBdMySql.php';
include_once PATH . 'modelos/UsuarioBD.php';
include_once PATH . 'modelos/modeloUsuario_s/Usuario_sVO.php';
include_once PATH . 'modelos/InterfaceCRUD.php';

class Usuario_sDAO extends ConBdMySql implements InterfaceCRUD {

    private $cantidadTotalRegistros;

    function __construct(UsuarioBd $usuarioBd, $base, $servidor) {
        parent::__construct($usuarioBd, $base, $servidor);
    }

    public function consultaPaginada(Usuario_sVO $consultarUsuario = NULL, $limit = NULL, $pagInicio = NULL) {
        $parametrosPaginacion = $this->solicitudPaginacion();
        $offset = $parametrosPaginacion[0];
        $limit = $parametrosPaginacion[1];
        $condicionBuscar = "";
        $filtros = 0;
//    $_POST['isbn'] = '6553';
//    $_POST['titulo'] = 'FRANCIA';
//    $_POST['autor'] = 'García Ripoll, María José, tr';
//    $_POST['precio'] = '60000';
//    $_POST['buscar'] = 'az';
//    $_POST['buscar'] = trim($_POST['buscar']);
        //    public function consulta(VOLibro $libro,$limit, $offset , $tipoBusqueda=0) {  // con tipo de búsqueda
//    public function consulta(VOLibro $libro,$limit, $offset , $tipoBusqueda=0, $buscarDatoEnCampos) {  // con tipo de búsqueda y dato a buscar en todos los campos
//    public function consulta(VOLibro $libro,$limit, $offset , $tipoBusqueda=0, $buscarDatoEnCampos, $orden="") {  // con tipo de búsqueda y dato a buscar en todos los campos y criterio de orden
        $planConsulta = "select SQL_CALC_FOUND_ROWS * from persona p ";
        $planConsulta.= " left join usuario_s u ";
        $planConsulta.= " on p.usuario_s_usuId=u.usuId  ";

        if (!empty($_POST['perDocumento'])) {
            $planConsulta.=" where perDocumento='" . $_POST['perDocumento'] . "'"; //faltaba agregar comillas sencillas por ser datos tipo string
            $filtros = 0;  // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta        
        } else {
            $where = false; // inicializar $where a falso ( al comenzar la consulta NO HAY condiciones o criterios de búsqueda)
            $filtros = 0;  // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta
            if (!empty($_POST['perNombre'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
//                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . " titulo like '%" . $_POST['titulo'] . "%'";// con tipo de búsqueda aproximada
                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . " perNombre like upper('%" . $_POST['perNombre'] . "%')"; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
//                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . " titulo like '" . $_POST['titulo'] . "'"; // con tipo de búsqueda exacta
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['perApellido'])) {
                $where = true;  // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . " perApellido like upper('%" . $_POST['perApellido'] . "%')"; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
//                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . "autor='" . $_POST['autor'] . "'";// con tipo de búsqueda exacta
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['usuLogin'])) {
                $where = true;  // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . " usuLogin like upper('%" . $_POST['usuLogin'] . "%')";
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (is_numeric($_POST['usuEstado']) && isset($_POST['usuEstado'])) { //En el caso de los campos que utilizan ceros (0)  ó uno (1) utilizar is_numeric()
                $where = true;  // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . " usuEstado = '" . ((int) $_POST['usuEstado']) . "'";
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
        }

        if (!empty($_POST['buscar'])) {
            $where = TRUE;
            $condicionBuscar = (($where && !$filtros == 0) ? " or " : " where ");
            $filtros++;
            $planConsulta.=$condicionBuscar;
            $planConsulta.="( perDocumento like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or perNombre like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or perApellido like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or perEstado like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or usuLogin like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or usuEstado like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" ) ";
        };

        $planConsulta.=" order by p.perApellido ASC ";
        $planConsulta.=" LIMIT " . $limit . " OFFSET " . $offset . " ; ";
//
//    echo "<br>" . $planConsulta . "<br>";
//    exit();

        $listar = $this->conexion->prepare($planConsulta);
        $listar->execute();

        $listadoUsuario_s = array();

        while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
            $listadoUsuario_s[] = $registro;
        }

//    $totalRegistros = totalRegistrosLibros($db); //convertir en atributo al pasarlo a POO (mientras tanto puede ser variable global)
        /*         * ***************************************************************************************** */
        /*         * *PARA CUANDO SON TABLAS RELACIONADAS CON JOIN SE CAMBIA LA ANTERIOR 
         * OPCION DE OBTENER ($totalRegistros) PARA SABER LA CANTIDAD TOTAL DE REGISTROS 
         * SOBRE LA MISMA LISTA Y SE HACE LA CONSULTA  "FOUND_ROWS()" DE LA SIGUIENTE FORMA*** */
        /*         * ******************************************** */
        $listar = $this->conexion->prepare("SELECT FOUND_ROWS() as total;");
        $listar->execute();
        while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
            $totalRegistros = $registro->total;
        }
        $this->cantidadTotalRegistros = $totalRegistros;
        /*         * ***************************************************************************************** */
        return array($totalRegistros, $listadoUsuario_s);
    }

    public function totalRegistros() {
        $sqlTotal = "SELECT FOUND_ROWS() as total";
        $rsTotal = $db->prepare($sqlTotal);
        $rsTotal->execute();
        $rowTotal = $rsTotal->fetch(PDO::FETCH_OBJ);
        $total = $rowTotal->total;
        $this->cantidadTotalRegistros = $total;

        $rsTotal = NULL;
        $rowTotal = NULL;

        return $total;
    }

    public function solicitudPaginacion($limit = 5) {

        if (!isset($_GET['pag']) || $_GET['pag'] < 1) {
            $_GET['pag'] = 1;
        }

        $pag = (int) $_GET['pag'];

        if ($pag < 1) {
            $pag = 1;
        };

        $offset = ($pag - 1) * $limit;

        return array($offset, $limit);
    }

    public function seleccionarId($sId) {//llega como parametro un array con datos a consultar
//
//        $resultadoConsulta = FALSE;
        echo"<pre>";print_r($sId);echo "</pre>";
        
        if (!isset($sId[2])) { //si la consulta no viene con el password (PARA REGISTRARSE)
            $planConsulta = "select * from persona p join usuario_s u on p.perId=u.usuId ";
            $planConsulta .= " where p.perDocumento= ? or u.usuLogin = ? ;";
            $listar = $this->conexion->prepare($planConsulta);
            $listar->execute(array($sId[0], $sId[1]));
        }
        if (isset($sId[2])) {//si la consulta viene con el password (PARA LOGUEARSE)
            $planConsulta = "select * from persona p join usuario_s u on p.perId=u.usuId ";
            $planConsulta .= " where u.usuLogin= ? and u.usuPassword = ? ;";
            $listar = $this->conexion->prepare($planConsulta);
            $listar->execute(array($sId[1], $sId[2]));
        }
        if (!isset($sId[1])&&!isset($sId[2])) {//si la consulta viene con solo el documento (PARA ENCONTRAR PERSONA)
            $planConsulta = "select * from persona p join usuario_s u on p.perId=u.usuId ";
            $planConsulta .= " where p.perDocumento = ? ;";
            $listar = $this->conexion->prepare($planConsulta);
            $listar->execute(array($sId[0]));
        }

        $registroEncontrado = array();
        while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
            $registroEncontrado[] = $registro;
        }

        if (isset($registroEncontrado[0]->usuId) && $registroEncontrado[0]->usuId != FALSE) {
            return ['exitoSeleccionId' => 1, 'registroEncontrado' => $registroEncontrado];
        } else {
            return ['exitoSeleccionId' => 0, 'registroEncontrado' => $registroEncontrado];
        }
    }

    public function buscar($dato1 = NULL, $dato2 = NULL) {
        $dato1;
        $dato2;
    }

    public function insertar($registro) {

        try {

            $inserta = $this->conexion->prepare('INSERT INTO usuario_s (usuLogin, usuPassword) VALUES ( :usuLogin, :usuPassword )');
            $inserta->bindParam(":usuLogin", $registro['email']);
            $inserta->bindParam(":usuPassword", $registro['password']);
            $insercion = $inserta->execute();
            $clavePrimariaConQueInserto = $this->conexion->lastInsertId();

            return ['inserto' => 1, 'resultado' => $clavePrimariaConQueInserto];
        } catch (Exception $exc) {
            return ['inserto' => 0, 'resultado' => $exc->getTraceAsString()];
        }
    }

    public function actualizar($registro) {
        $registro;
    }

    public function eliminar($eId) {
        
    }

    public function enlacesPaginacion($totalRegistros = NULL, $limit = 5, $offset = 0, $totalEnlacesPaginacion = 4) {

        $totalPag = ceil($totalRegistros / $limit);

        $anterior = $_GET['pag'] - $totalEnlacesPaginacion;
        $siguiente = $_GET['pag'] + $limit;

        $dbs = array();
        $conteoEnlaces = 0;
        for ($i = $_GET['pag']; $i < ($_GET['pag'] + $limit) && $i < $totalPag && $conteoEnlaces < $totalEnlacesPaginacion; $i++) {

            $dbs[] = "<a href='controladores/ControladorPrincipal.php?ruta=listarUsuario_s&pag=$i'>$i</a>";
            $conteoEnlaces++;
            $siguiente = $i;
        }

        $mostrar = "<center><a href='controladores/ControladorPrincipal.php?ruta=listarUsuario_s&pag=0'>..::PAGINAS INICIALES::..</a><br>";
        $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarUsuario_s&pag=" . (($anterior)) . "'>..::BLOQUE ANTERIOR::..</a>";

        $mostrar.= implode("-", $dbs);

        if ($_GET['pag'] < $totalPag) {
            $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarUsuario_s&pag=" . ($siguiente + 1) . "'>..::BLOQUE SIGUIENTE::..</a><br>";
            $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarUsuario_s&pag=" . ($totalPag - $totalEnlacesPaginacion) . "'>..::BLOQUE FINAL::..</a><br></center>";
        }


        return $mostrar;
    }

    public function vinculosPaginas($pagInicio, $offset) {

        $total = $this->cantidadTotalRegistros;

        $totalPag = ceil($total / $offset);
        $dbs = array();
        for ($i = $pagInicio; $i < ($pagInicio + $offset) && $i <= $totalPag; $i++) {
            $dbs[] = "<a href='ControladorPrincipal.php?ruta=listarUsuario_s&pag=$i'>$i</a>";
        }

        $anterior = $pagInicio - $offset;
        $siguiente = $pagInicio + $offset;
        $mostrar = "<center><a href='ControladorPrincipal.php?ruta=listarUsuario_s&pag=0'>..::PAGINAS INICIALES::..</a><br>";
        $mostrar.="<a href='ControladorPrincipal.php?ruta=listarUsuario_s&pag=$anterior'>..::BLOQUE ANTERIOR::..</a>";
        $mostrar.= implode("-", $dbs);
        if ($pagInicio < $totalPag) {
            $mostrar.="<a href='ControladorPrincipal.php?ruta=listarUsuario_s&pag=$siguiente'>..::BLOQUE SIGUIENTE::..</a><br/>";
            $mostrar.="<a href='ControladorPrincipal.php?ruta=listarUsuario_s&pag=$totalPag'>..::BLOQUE FINAL::..</a><br/></center>";
        }

        return $mostrar;
    }

    public function seleccionarTodos() {

        $planConsulta = "select * from usuario_s order by usuId DESC;"; //Se prepara la consulta

        $registrosUsuario_s = $this->conexion->prepare($planConsulta); //Se envia la consulta
        $registrosUsuario_s->execute(); //Ejecución de la consulta
        $listadoRegistrosUsuario_s = array();
        @$listadoRegistrosUsuario_s[0]->usuId = "";
        @$listadoRegistrosUsuario_s[0]->usuLogin = "Seleccione";

        while ($registro = $registrosUsuario_s->fetch(PDO::FETCH_OBJ)) {
            $listadoRegistrosUsuario_s[] = $registro;
        }

        $this->cierreBd();

        return $listadoRegistrosUsuario_s;
    }

}


