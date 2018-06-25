<?php

//define("","");
include_once '../modelos/ConstantesConexion.php';
include_once PATH . 'modelos/ConBdMySql.php';
include_once PATH . 'modelos/UsuarioBD.php';
include_once PATH . 'modelos/InterfaceCRUD.php';

class OrdenProduccionDAO extends ConBdMySql/* implements InterfaceCRUD */
{

    private $cantidadTotalRegistros;

    public function __construct(UsuarioBd $usuarioBd, $base, $servidor)
    {
        parent::__construct($usuarioBd, $base, $servidor);
    }

    public function seleccionarTodos()
    {

        $planConsulta = " SELECT op.OrdPId , pt.ProNombre , op.OrdPCant , op.OrdPAsignada, op.OrdPFecha, op.OrdPObservaciones ";
        $planConsulta .= " FROM ordenproduccion op ";
        $planConsulta .= " left join productos pt on pt.ProCodigo = op.Productos_ProCodigo ";
        
        
        
        
        //      $planConsulta .= "WHERE i.InsEstado=1 ";//
        
        $registrosOrdenProduccion = $this->conexion->prepare($planConsulta); //Se envia la consulta
        $registrosOrdenProduccion->execute(); //Ejecución de la consulta
        $listadoRegistrosOrdenProduccion = array();
        
        while ($registro = $registrosOrdenProduccion->fetch(PDO::FETCH_OBJ)) {
            $listadoRegistrosOrdenProduccion[] = $registro;
        }
        
        $this->cierreBd();
        return $listadoRegistrosOrdenProduccion;
    }
    
    public function consultaPaginada(OrdenProduccionVO $consultarOrdenProduccion = null, $limit = null, $pagInicio = null)
    {
        
        $parametrosPaginacion = $this->solicitudPaginacion();
        $offset = $parametrosPaginacion[0];
        $limit = $parametrosPaginacion[1];
        
        $condicionBuscar = "";
        $filtros = 0;
        
        session_start();//Solo se coloca una vez .l.
        
        
        
        
        
        
        
        
        if (isset($_SESSION['OrdPIdF']) && !isset($_POST['OrdPId'])) { //coloque desde aquí
            $_POST['OrdPId'] = $_SESSION['OrdPIdF'];
        }
        
        if (isset($_POST['OrdPId']) && !isset($_SESSION['OrdPIdF'])) {
            $_SESSION['OrdPIdF'] = $_POST['OrdPId'];
        }//hasta aqui
        if (isset($_SESSION['ProNombreF']) && !isset($_POST['ProNombre'])) { //coloque desde aquí
            $_POST['ProNombre'] = $_SESSION['ProNombreF'];
        }
        
        if (isset($_POST['ProNombre']) && !isset($_SESSION['ProNombreF'])) {
            $_SESSION['ProNombreF'] = $_POST['ProNombre'];
        }//hasta aqui
        if (isset($_SESSION['OrdPCantF']) && !isset($_POST['OrdPCant'])) { //coloque desde aquí
            $_POST['OrdPCant'] = $_SESSION['OrdPCantF'];
        }
        
        if (isset($_POST['OrdPCant']) && !isset($_SESSION['OrdPCantF'])) {
            $_SESSION['OrdPCantF'] = $_POST['OrdPCant'];
        }//hasta aqui        
        if (isset($_SESSION['OrdPAsignadaF']) && !isset($_POST['OrdPAsignada'])) { //coloque desde aquí
            $_POST['OrdPAsignada'] = $_SESSION['OrdPAsignadaF'];
        }
        
        if (isset($_POST['OrdPAsignada']) && !isset($_SESSION['OrdPAsignadaF'])) {
            $_SESSION['OrdPAsignadaF'] = $_POST['OrdPAsignada'];
        }//hasta aqui        
        if (isset($_SESSION['OrdPFechaF']) && !isset($_POST['OrdPFecha'])) { //coloque desde aquí
            $_POST['OrdPFecha'] = $_SESSION['OrdPFechaF'];
        }
        
        if (isset($_POST['OrdPFecha']) && !isset($_SESSION['OrdPFechaF'])) {
            $_SESSION['OrdPFechaF'] = $_POST['OrdPFecha'];
        }//hasta aqui        
        if (isset($_SESSION['OrdPObservacionesF']) && !isset($_POST['OrdPObservaciones'])) { //coloque desde aquí
            $_POST['OrdPObservaciones'] = $_SESSION['OrdPObservacionesF'];
        }
        
        if (isset($_POST['OrdPObservaciones']) && !isset($_SESSION['OrdPObservacionesF'])) {
            $_SESSION['OrdPObservacionesF'] = $_POST['OrdPObservaciones'];
        }//hasta aqui        
        
        if (isset($_POST['buscar'])) {
            $_POST['buscar'] = trim($_POST['buscar']);
        }
        $planConsulta = " SELECT op.OrdPId , pt.ProNombre , op.OrdPCant , op.OrdPAsignada, op.OrdPFecha, op.OrdPObservaciones ";
        $planConsulta .= " FROM ordenproduccion op ";
        $planConsulta .= " left join productos pt on pt.ProCodigo = op.Productos_ProCodigo ";
        
        
        //$planConsulta .= "WHERE i.InsEstado=1 ";
        
        
        if (!empty($_POST['OrdPId'])) {
            $planConsulta .= " where op.OrdPId='" . $_POST['OrdPId'] . "'";
            $filtros = 0; // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta
        } else {
            $where = false; // inicializar $where a falso ( al comenzar la consulta NO HAY condiciones o criterios de búsqueda)
            $filtros = 0; // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta
            if (!empty($_POST['ProNombre'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . "pt.ProNombre like upper('%" . $_POST['ProNombre'] . "%')"; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['OrdPCant'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . " op.OrdPCant = " . (float)$_POST['OrdPCant']; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['OrdPAsignada'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . " op.OrdPAsignada like upper('%" . $_POST['OrdPAsignada']. "%')";
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['OrdPFecha'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . " op.OrdPFecha like upper('%" . $_POST['OrdPFecha'] . "%')";
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['OrdPObservaciones'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . " op.OrdPObservaciones like upper('%" . $_POST['OrdPObservaciones'] . "%')";
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
           
        }
        if (!empty($_POST['buscar'])) {
            $where = true;
            $condicionBuscar = (($where && !$filtros == 0) ? " or " : " where ");
            $filtros++;
            $planConsulta .= $condicionBuscar;
            $planConsulta .= "( OrdPId like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " or ProNombre like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " or OrdPCant like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " or OrdPAsignada like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " or OrdPFecha like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " or OrdPObservaciones like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " ) ";
        };
        $planConsulta .= "  order by op.OrdPFecha desc";
        $planConsulta .= " LIMIT " . $limit . " OFFSET " . $offset . " ; ";
//        echo $planConsulta;
//        exit();
        $listar = $this->conexion->prepare($planConsulta);
        $listar->execute();

        $listadoOrdenProduccion = array();

        while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
            $listadoOrdenProduccion[] = $registro;
        }

        $listar2 = $this->conexion->prepare("SELECT FOUND_ROWS() as total;");
        $listar2->execute();
        while ($registro = $listar2->fetch(PDO::FETCH_OBJ)) {
            $totalRegistros = $registro->total;
        }
        $this->cantidadTotalRegistros = $totalRegistros;

        return array($totalRegistros, $listadoOrdenProduccion);
    }

    public function solicitudPaginacion($limit = 5)
    {

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

    public function enlacesPaginacion($totalRegistros = null, $limit = 5, $offset = 0, $totalEnlacesPaginacion = 4)
    {

        $totalPag = ceil($totalRegistros / $limit);

        $anterior = $_GET['pag'] - $totalEnlacesPaginacion;
        $siguiente = $_GET['pag'] + $limit;

        $dbs = array();
        $conteoEnlaces = 0;
        for ($i = $_GET['pag']; $i < ($_GET['pag'] + $limit) && $i < $totalPag && $conteoEnlaces < $totalEnlacesPaginacion; $i++) {

            $dbs[] = "<a href='controladores/ControladorPrincipal.php?ruta=listarOrdenProduccion&pag=$i'>$i</a>";
            $conteoEnlaces++;
            $siguiente = $i;
        }

        $mostrar = "<center><a href='controladores/ControladorPrincipal.php?ruta=listarOrdenProduccion&pag=0'>..::PAGINAS INICIALES::..</a><br>";
        $mostrar .= "<a href='controladores/ControladorPrincipal.php?ruta=listarOrdenProduccion&pag=" . (($anterior)) . "'>..::BLOQUE ANTERIOR::..</a>";

        $mostrar .= implode("-", $dbs);

        if ($_GET['pag'] < $totalPag) {
            $mostrar .= "<a href='controladores/ControladorPrincipal.php?ruta=listarOrdenProduccion&pag=" . ($siguiente + 1) . "'>..::BLOQUE SIGUIENTE::..</a><br>";
            $mostrar .= "<a href='controladores/ControladorPrincipal.php?ruta=listarOrdenProduccion&pag=" . ($totalPag - $totalEnlacesPaginacion) . "'>..::BLOQUE FINAL::..</a><br></center>";
        }

        return $mostrar;
    }

    public function seleccionarId($sId)
    {
        //
        //        $resultadoConsulta = FALSE;
        
        $planConsulta = "select * from ordenproduccion op ";
        $planConsulta .= " where op.OrdPId= ? ;";
        $listar = $this->conexion->prepare($planConsulta);
        $listar->execute(array($sId[0]));
        
        $registroEncontrado = array();
        while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
            $registroEncontrado[] = $registro;
        }
        if ($registro != false) {
            return ['exitoSeleccionId' => true, 'registroEncontrado' => $registroEncontrado];
        } else {
            return ['exitoSeleccionId' => false, 'registroEncontrado' => $registroEncontrado];
        }
    }
    
    public function insertar($registro)
    {
        
        try {

            $inserta = $this->conexion->prepare('INSERT INTO ordenproduccion (OrdPId, ProNombre, OrdPCant, OrdPAsignada, OrdPFecha, OrdPObservaciones) VALUES ( :OrdPId, :ProNombre, :OrdPCant, :OrdPAsignada, :OrdPFecha, :OrdPObservaciones );');
            $inserta->bindParam(":OrdPId", $registro['OrdPId']);
            $inserta->bindParam(":ProNombre", $registro['ProNombre']);
            $inserta->bindParam(":OrdPCant", $registro['OrdPCant']);
            $inserta->bindParam(":OrdPAsignada", $registro['OrdPAsignada']);
            $inserta->bindParam(":OrdPFecha", $registro['OrdPFecha']);
            $inserta->bindParam(":OrdPObservaciones", $registro['OrdPObservaciones']);
            $insercion = $inserta->execute();
            $clavePrimariaConQueInserto = $this->conexion->lastInsertId();

            return ['inserto' => 1, 'resultado' => $clavePrimariaConQueInserto];
        } /* catch (Exception $exc) {
        return ['inserto' => FALSE, 'resultado' => $exc->getTraceAsString()];
        } */ catch (PDOException $pdoExc) {
            return ['inserto' => 0, 'resultado' => $pdoExc];
        }
    }

    public function actualizar($registro)
    {
        try {
            
            $OrdPCant = $registro[0]['OrdPCant'];
            $ProNombre = $registro[0]['ProNombre'];
            $OrdPAsignada = $registro[0]['OrdPAsignada'];
            $OrdPFecha = $registro[0]['OrdPFecha'];
            $OrdPId = $registro[0]['OrdPId'];
            $OrdPObservaciones = $registro[0]['OrdPObservaciones'];

            if (isset($registro[0]['OrdPId'])) {
                $actualizar = "UPDATE ordenproduccion SET OrdPCant= '".$OrdPCant."', OrdPAsignada = '".$OrdPAsignada."' , OrdPFecha = '".$OrdPFecha."' , OrdPObservaciones = '".$OrdPObservaciones."' WHERE OrdPId= '".$OrdPId."' ;";
                $resultado = $this->conexion->prepare($actualizar);
                
                
                if($actualizacion = $resultado->execute()){
                //var_dump($resultado);
                //exit();  
                $actualizar = "UPDATE productos SET ProNombre = '".$ProNombre."' WHERE ProCodigo= '" . $OrdPId . "' ;";
                $resultado = $this->conexion->prepare($actualizar);
                $actualizacion = $resultado->execute();

                return ['actualizacion' => $actualizacion, 'mensaje' => $mensaje];
                }
            }
        } catch (Exception $exc) {
            return ['actualizacion' => $actualizacion, 'mensaje' => $exc->getTraceAsString()];
        }
        var_dump ($actualizacion);
        exit();
    }

    public function eliminar($eId) {
        try {
        $OrdPId = $eId[0]['OrdPId'];

        if (isset($eId[0]['OrdPId'])) {
            $eliminar = "DELETE FROM ordenproduccion WHERE OrdPId= ? ;";
            $resultado = $this->conexion->prepare($eliminar);
            $eliminacion = $resultado->execute(array($OrdPId));
            return ['eliminacion' => $eliminacion, 'mensaje' => $mensaje];
        }
    } catch (Exception $exc) {
        return ['eliminacion' => $eliminacion, 'mensaje' => $exc->getTraceAsString()];
    }
//    var_dump ($actualizacion);
    exit();

    }

}


