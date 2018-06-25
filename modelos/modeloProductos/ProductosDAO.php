<?php

//define("","");
include_once '../modelos/ConstantesConexion.php';
include_once PATH . 'modelos/ConBdMySql.php';
include_once PATH . 'modelos/UsuarioBD.php';
include_once PATH . 'modelos/InterfaceCRUD.php';

class ProductosDAO extends ConBdMySql/* implements InterfaceCRUD */
{

    private $cantidadTotalRegistros;

    public function __construct(UsuarioBd $usuarioBd, $base, $servidor)
    {
        parent::__construct($usuarioBd, $base, $servidor);
    }

    public function seleccionarTodos()
    {


        $planConsulta = " SELECT pt.ProCodigo, pt.ProNombre, pt.ProPresentacion, pt.ProPrecioBogota, pt.ProPrecioNacional, pt.ProMaquila ";
        $planConsulta .= " FROM productos pt ";
        
        
        //      $planConsulta .= "WHERE i.InsEstado=1 ";//
        
        $registrosProductos = $this->conexion->prepare($planConsulta); //Se envia la consulta
        $registrosProductos->execute(); //Ejecución de la consulta
        $listadoRegistrosProductos = array();
        
        while ($registro = $registrosProductos->fetch(PDO::FETCH_OBJ)) {
            $listadoRegistrosProductos[] = $registro;
        }
        
        $this->cierreBd();
        return $listadoRegistrosProductos;
    }
    
    public function consultaPaginada(ProductosVO $consultarProductos = null, $limit = null, $pagInicio = null)
    {
        
        $parametrosPaginacion = $this->solicitudPaginacion();
        $offset = $parametrosPaginacion[0];
        $limit = $parametrosPaginacion[1];
        
        $condicionBuscar = "";
        $filtros = 0;
        
        session_start();//Solo se coloca una vez .l.
        
        
        
        

        
        
        
        if (isset($_SESSION['ProCodigoF']) && !isset($_POST['ProCodigo'])) { //coloque desde aquí
            $_POST['ProCodigo'] = $_SESSION['ProCodigoF'];
        }
        
        if (isset($_POST['ProCodigo']) && !isset($_SESSION['ProCodigoF'])) {
            $_SESSION['ProCodigoF'] = $_POST['ProCodigo'];
        }//hasta aqui
        if (isset($_SESSION['ProNombreF']) && !isset($_POST['ProNombre'])) { //coloque desde aquí
            $_POST['ProNombre'] = $_SESSION['ProNombreF'];
        }

        if (isset($_POST['ProNombre']) && !isset($_SESSION['ProNombreF'])) {
            $_SESSION['ProNombreF'] = $_POST['ProNombre'];
        }//hasta aqui
        if (isset($_SESSION['ProPresentacionF']) && !isset($_POST['ProPresentacion'])) { //coloque desde aquí
            $_POST['ProPresentacion'] = $_SESSION['ProPresentacionF'];
        }

        if (isset($_POST['ProPresentacion']) && !isset($_SESSION['ProPresentacionF'])) {
            $_SESSION['ProPresentacionF'] = $_POST['ProPresentacion'];
        }//hasta aqui        
        if (isset($_SESSION['ProPrecioBogotaF']) && !isset($_POST['ProPrecioBogota'])) { //coloque desde aquí
            $_POST['ProPrecioBogota'] = $_SESSION['ProPrecioBogotaF'];
        }
        
        if (isset($_POST['ProPrecioBogota']) && !isset($_SESSION['ProPrecioBogotaF'])) {
            $_SESSION['ProPrecioBogotaF'] = $_POST['ProPrecioBogota'];
        }//hasta aqui        
        if (isset($_SESSION['ProPrecioNacionalF']) && !isset($_POST['ProPrecioNacional'])) { //coloque desde aquí
            $_POST['ProPrecioNacional'] = $_SESSION['ProPrecioNacionalF'];
        }
        
        if (isset($_POST['ProPrecioNacional']) && !isset($_SESSION['ProPrecioNacionalF'])) {
            $_SESSION['ProPrecioNacionalF'] = $_POST['ProPrecioNacional'];
        }//hasta aqui        
        if (isset($_SESSION['ProMaquilaF']) && !isset($_POST['ProMaquila'])) { //coloque desde aquí
            $_POST['ProMaquila'] = $_SESSION['ProMaquilaF'];
        }
        
        if (isset($_POST['ProMaquila']) && !isset($_SESSION['ProMaquilaF'])) {
            $_SESSION['ProMaquilaF'] = $_POST['ProMaquila'];
        }//hasta aqui        
        
        if (isset($_POST['buscar'])) {
            $_POST['buscar'] = trim($_POST['buscar']);
        }
        
        $planConsulta = " SELECT pt.ProCodigo, pt.ProNombre, pt.ProPresentacion, pt.ProPrecioBogota, pt.ProPrecioNacional, pt.ProMaquila ";
        $planConsulta .= " FROM productos pt ";

        //$planConsulta .= "WHERE i.InsEstado=1 ";
        
        
        if (!empty($_POST['ProCodigo'])) {
            $planConsulta .= " where pt.ProCodigo='" . $_POST['ProCodigo'] . "'";
            $filtros = 0; // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta
        } else {
            $where = false; // inicializar $where a falso ( al comenzar la consulta NO HAY condiciones o criterios de búsqueda)
            $filtros = 0; // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta
            if (!empty($_POST['ProNombre'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . "pt.ProNombre like upper('%" . $_POST['ProNombre'] . "%')"; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['ProPresentacion'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . " pt.ProPresentacion = " . (float)$_POST['ProPresentacion']; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['ProPrecioBogota'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . " pt.ProPrecioBogota like upper('%" . $_POST['ProPrecioBogota']. "%')";
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['ProPrecioNacional'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . " pt.ProPrecioNacional like upper('%" . $_POST['ProPrecioNacional'] . "%')";
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['ProMaquila'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . " pt.ProMaquila like upper('%" . $_POST['ProMaquila'] . "%')";
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
           
        }
        if (!empty($_POST['buscar'])) {
            $where = true;
            $condicionBuscar = (($where && !$filtros == 0) ? " or " : " where ");
            $filtros++;
            $planConsulta .= $condicionBuscar;
            $planConsulta .= "( ProCodigo like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " or ProNombre like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " or ProPresentacion like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " or ProPrecioBogota like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " or ProPrecioNacional like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " or ProMaquila like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " ) ";
        };
        $planConsulta .= "  order by pt.ProCodigo desc";
        $planConsulta .= " LIMIT " . $limit . " OFFSET " . $offset . " ; ";
//        echo $planConsulta;
//        exit();
        $listar = $this->conexion->prepare($planConsulta);
        $listar->execute();

        $listadoProductos = array();

        while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
            $listadoProductos[] = $registro;
        }

        $listar2 = $this->conexion->prepare("SELECT FOUND_ROWS() as total;");
        $listar2->execute();
        while ($registro = $listar2->fetch(PDO::FETCH_OBJ)) {
            $totalRegistros = $registro->total;
        }
        $this->cantidadTotalRegistros = $totalRegistros;

        return array($totalRegistros, $listadoProductos);
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

            $dbs[] = "<a href='controladores/ControladorPrincipal.php?ruta=listarProductos&pag=$i'>$i</a>";
            $conteoEnlaces++;
            $siguiente = $i;
        }

        $mostrar = "<center><a href='controladores/ControladorPrincipal.php?ruta=listarProductos&pag=0'>..::PAGINAS INICIALES::..</a><br>";
        $mostrar .= "<a href='controladores/ControladorPrincipal.php?ruta=listarProductos&pag=" . (($anterior)) . "'>..::BLOQUE ANTERIOR::..</a>";

        $mostrar .= implode("-", $dbs);

        if ($_GET['pag'] < $totalPag) {
            $mostrar .= "<a href='controladores/ControladorPrincipal.php?ruta=listarProductos&pag=" . ($siguiente + 1) . "'>..::BLOQUE SIGUIENTE::..</a><br>";
            $mostrar .= "<a href='controladores/ControladorPrincipal.php?ruta=listarProductos&pag=" . ($totalPag - $totalEnlacesPaginacion) . "'>..::BLOQUE FINAL::..</a><br></center>";
        }

        return $mostrar;
    }

    public function seleccionarId($sId)
    {
        //
        //        $resultadoConsulta = FALSE;
        
        $planConsulta = "select * from Productos pt ";
        $planConsulta .= " where pt.ProCodigo= ? ;";
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

            $inserta = $this->conexion->prepare('INSERT INTO productos (ProCodigo, ProNombre, ProPresentacion, ProPrecioBogota, ProPrecioNacional, ProMaquila) VALUES ( :ProCodigo, :ProNombre, :ProPresentacion, :ProPrecioBogota, :ProPrecioNacional, :ProMaquila );');
            $inserta->bindParam(":ProCodigo", $registro['ProCodigo']);
            $inserta->bindParam(":ProNombre", $registro['ProNombre']);
            $inserta->bindParam(":ProPresentacion", $registro['ProPresentacion']);
            $inserta->bindParam(":ProPrecioBogota", $registro['ProPrecioBogota']);
            $inserta->bindParam(":ProPrecioNacional", $registro['ProPrecioNacional']);
            $inserta->bindParam(":ProMaquila", $registro['ProMaquila']);
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
            
            $ProPresentacion = $registro[0]['ProPresentacion'];
            $ProNombre = $registro[0]['ProNombre'];
            $ProPrecioBogota = $registro[0]['ProPrecioBogota'];
            $ProPrecioNacional = $registro[0]['ProPrecioNacional'];
            $ProCodigo = $registro[0]['ProCodigo'];
            $ProMaquila = $registro[0]['ProMaquila'];

            if (isset($registro[0]['ProCodigo'])) {
                $actualizar = "UPDATE productos SET ProPresentacion= ? , ProNombre = ? , ProPrecioBogota = ? , ProPrecioNacional = ? , ProMaquila = ? WHERE ProCodigo= ? ;";
                $resultado = $this->conexion->prepare($actualizar);
                
                
                $actualizacion = $resultado->execute(array($ProPresentacion, $ProNombre, $ProPrecioBogota, $ProPrecioNacional, $ProMaquila,$ProCodigo));
                //var_dump($resultado);
                //exit();
                return ['actualizacion' => $actualizacion, 'mensaje' => $mensaje];
            }
        } catch (Exception $exc) {
            return ['actualizacion' => $actualizacion, 'mensaje' => $exc->getTraceAsString()];
        }
        var_dump ($actualizacion);
        exit();
    }

    public function eliminar($eId) {
        try {
        $ProCodigo = $eId[0]['ProCodigo'];

        if (isset($eId[0]['ProCodigo'])) {
            $eliminar = "DELETE FROM productos WHERE ProCodigo= ? ;";
            $resultado = $this->conexion->prepare($eliminar);
            $eliminacion = $resultado->execute(array($ProCodigo));
            return ['eliminacion' => $eliminacion, 'mensaje' => $mensaje];
        }
    } catch (Exception $exc) {
        return ['eliminacion' => $eliminacion, 'mensaje' => $exc->getTraceAsString()];
    }
//    var_dump ($actualizacion);
    exit();

    }

}


