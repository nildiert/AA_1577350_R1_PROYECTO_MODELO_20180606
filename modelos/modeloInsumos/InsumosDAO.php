<?php

//define("","");
include_once '../modelos/ConstantesConexion.php';
include_once PATH . 'modelos/ConBdMySql.php';
include_once PATH . 'modelos/UsuarioBD.php';
include_once PATH . 'modelos/InterfaceCRUD.php';

class InsumosDAO extends ConBdMySql /* implements InterfaceCRUD */ {

    private $cantidadTotalRegistros;

    function __construct(UsuarioBd $usuarioBd, $base, $servidor) {
        parent::__construct($usuarioBd, $base, $servidor);
    }

    public function seleccionarTodos() {
        $planConsulta .= "SELECT i.InsCodigo,i.InsNombre,i.InsCantActual,i.InsUnidadMedida,i.InsPrecio ";
        $planConsulta .= "FROM insumos i ";
        $planConsulta .= "WHERE i.InsEstado=1 ";

        $registrosInsumos = $this->conexion->prepare($planConsulta); //Se envia la consulta
        $registrosInsumos->execute(); //Ejecución de la consulta        
        $listadoRegistrosInsumos = array();

        while ($registro = $registrosInsumos->fetch(PDO::FETCH_OBJ)) {
            $listadoRegistrosInsumos[] = $registro;
        }

        $this->cierreBd();
        return $listadoRegistrosInsumos;
    }

    public function consultaPaginada(InsumosVO $consultarInsumos = NULL, $limit = NULL, $pagInicio = NULL) {

        $parametrosPaginacion = $this->solicitudPaginacion();
        $offset = $parametrosPaginacion[0];
        $limit = $parametrosPaginacion[1];

        $condicionBuscar = "";
        $filtros = 0;

        if (isset($_POST['buscar']))
            $_POST['buscar'] = trim($_POST['buscar']);

        $planConsulta .= "SELECT i.InsCodigo,i.InsNombre,i.InsCantActual,i.InsUnidadMedida,i.InsPrecio ";
        $planConsulta .= "FROM insumos i ";
        $planConsulta .= "WHERE i.InsEstado=1 ";

        if (!empty($_POST['InsCodigo'])) {
            $planConsulta.=" where i.InsCodigo='" . $_POST['InsCodigo'] . "'";
            $filtros = 0;  // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta        
        } else {
            $where = false; // inicializar $where a falso ( al comenzar la consulta NO HAY condiciones o criterios de búsqueda)
            $filtros = 0;  // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta
            if (!empty($_POST['InsNombre'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . "i.InsNombre like upper('%" . $_POST['InsNombre'] . "%')"; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }            
            if (!empty($_POST['InsCantActual'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . "i.InsCantActual like upper('%" . $_POST['InsCantActual'] . "%')"; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($datos['InsUnidadMedida'])) {
                $where = true;  // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . " i.InsUnidadMedida like upper('%" . $_POST['InsUnidadMedida'] . "%')"; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['InsPrecio '])) {
                $where = true;  // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . " i.InsPrecio  = " . $_POST['InsPrecio '];
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            
        }
        if (!empty($_POST['buscar'])) {
            $where = TRUE;
            $condicionBuscar = (($where && !$filtros == 0) ? " or " : " where ");
            $filtros++;
            $planConsulta.=$condicionBuscar;
            $planConsulta.="( InsCodigo like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or InsNombre like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or InsCantActual like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or InsUnidadMedida like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or InsPrecio like '%" . $_POST['buscar'] . "%'";
            
            $planConsulta.=" ) ";
        };
        $planConsulta.= "  order by i.InsCodigo desc";
        $planConsulta.=" LIMIT " . $limit . " OFFSET " . $offset . " ; ";

        $listar = $this->conexion->prepare($planConsulta);
        $listar->execute();

        $listadoInsumos = array();

        while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
            $listadoInsumos[] = $registro;
        }

        $listar2 = $this->conexion->prepare("SELECT FOUND_ROWS() as total;");
        $listar2->execute();
        while ($registro = $listar2->fetch(PDO::FETCH_OBJ)) {
            $totalRegistros = $registro->total;
        }
        $this->cantidadTotalRegistros = $totalRegistros;
        
        return array($totalRegistros, $listadoInsumos);
    }

    public function solicitudPaginacion($limit = 10) {

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

    public function enlacesPaginacion($totalRegistros = NULL, $limit = 10, $offset = 0, $totalEnlacesPaginacion = 4) {

        $totalPag = ceil($totalRegistros / $limit);

        $anterior = $_GET['pag'] - $totalEnlacesPaginacion;
        $siguiente = $_GET['pag'] + $limit;

        $dbs = array();
        $conteoEnlaces = 0;
        for ($i = $_GET['pag']; $i < ($_GET['pag'] + $limit) && $i < $totalPag && $conteoEnlaces < $totalEnlacesPaginacion; $i++) {

            $dbs[] = "<a href='controladores/ControladorPrincipal.php?ruta=listarInsumos&pag=$i'>$i</a>";
            $conteoEnlaces++;
            $siguiente = $i;
        }

        $mostrar = "<center><a href='controladores/ControladorPrincipal.php?ruta=listarInsumos&pag=0'>..::PAGINAS INICIALES::..</a><br>";
        $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarInsumos&pag=" . (($anterior)) . "'>..::BLOQUE ANTERIOR::..</a>";

        $mostrar.= implode("-", $dbs);

        if ($_GET['pag'] < $totalPag) {
            $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarInsumos&pag=" . ($siguiente + 1) . "'>..::BLOQUE SIGUIENTE::..</a><br>";
            $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarInsumos&pag=" . ($totalPag - $totalEnlacesPaginacion) . "'>..::BLOQUE FINAL::..</a><br></center>";
        }


        return $mostrar;
    }

    public function seleccionarId($sId) {
//
//        $resultadoConsulta = FALSE;

        $planConsulta = "select * from Insumos i ";
        $planConsulta .= " where i.isbn= ? ;";
        $listar = $this->conexion->prepare($planConsulta);
        $listar->execute(array($sId[0]));

        $registroEncontrado = array();
        while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
            $registroEncontrado[] = $registro;
        }
        if ($registro != FALSE) {
            return ['exitoSeleccionId' => TRUE, 'registroEncontrado' => $registroEncontrado];
        } else {
            return ['exitoSeleccionId' => FALSE, 'registroEncontrado' => $registroEncontrado];
        }        
    }

    public function insertar($registro) {
         try {

            $inserta = $this->conexion->prepare('INSERT INTO Insumos (InsCodigo, InsNombre, InsCantActual, InsUnidadMedida, InsPrecio) VALUES ( :InsCodigo, :InsNombre, :InsCantActual, :InsUnidadMedida, :InsPrecio );');
            $inserta->bindParam(":InsCodigo", $registro['InsCodigo']);
            $inserta->bindParam(":InsNombre", $registro['InsNombre']);
            $inserta->bindParam(":InsCantActual", $registro['InsCantActual']);
            $inserta->bindParam(":InsUnidadMedida", $registro['InsUnidadMedida']);
            $inserta->bindParam(":InsPrecio", $registro['InsPrecio']);
            
            $insercion = $inserta->execute();
            $clavePrimariaConQueInserto = $this->conexion->lastInsertId();

            return ['inserto' => 1, 'resultado' => $clavePrimariaConQueInserto];
        } /* catch (Exception $exc) { 
          return ['inserto' => FALSE, 'resultado' => $exc->getTraceAsString()];
          } */ catch (PDOException $pdoExc) {
            return ['inserto' => 0, 'resultado' => $pdoExc];
        }       
    }

    public function actualizar($registro) {
        $registro;
    }

    public function eliminar($eId) {
        $eId;
    }

}
