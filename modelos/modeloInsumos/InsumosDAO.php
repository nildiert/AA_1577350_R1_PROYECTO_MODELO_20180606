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
        $planConsulta .= "SELECT i.InsCodigo,i.InsNombre,i.InsUnidadMedida,i.InsPrecio ";
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

            $planConsulta .= "SELECT i.InsCodigo,i.InsNombre,i.InsUnidadMedida,i.InsPrecio ";
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
            $planConsulta.="( isbn like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or titulo like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or autor like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or precio like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or catLibId like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" or catLibNombre like '%" . $_POST['buscar'] . "%'";
            $planConsulta.=" ) ";
        };
        $planConsulta.= "  order by l.isbn desc";
        $planConsulta.=" LIMIT " . $limit . " OFFSET " . $offset . " ; ";

        $listar = $this->conexion->prepare($planConsulta);
        $listar->execute();

        $listadoInsumoss = array();

        while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
            $listadoInsumoss[] = $registro;
        }

        $listar2 = $this->conexion->prepare("SELECT FOUND_ROWS() as total;");
        $listar2->execute();
        while ($registro = $listar2->fetch(PDO::FETCH_OBJ)) {
            $totalRegistros = $registro->total;
        }
        $this->cantidadTotalRegistros = $totalRegistros;
        
        return array($totalRegistros, $listadoInsumoss);
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

    public function enlacesPaginacion($totalRegistros = NULL, $limit = 5, $offset = 0, $totalEnlacesPaginacion = 4) {

        $totalPag = ceil($totalRegistros / $limit);

        $anterior = $_GET['pag'] - $totalEnlacesPaginacion;
        $siguiente = $_GET['pag'] + $limit;

        $dbs = array();
        $conteoEnlaces = 0;
        for ($i = $_GET['pag']; $i < ($_GET['pag'] + $limit) && $i < $totalPag && $conteoEnlaces < $totalEnlacesPaginacion; $i++) {

            $dbs[] = "<a href='controladores/ControladorPrincipal.php?ruta=listarInsumoss&pag=$i'>$i</a>";
            $conteoEnlaces++;
            $siguiente = $i;
        }

        $mostrar = "<center><a href='controladores/ControladorPrincipal.php?ruta=listarInsumoss&pag=0'>..::PAGINAS INICIALES::..</a><br>";
        $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarInsumoss&pag=" . (($anterior)) . "'>..::BLOQUE ANTERIOR::..</a>";

        $mostrar.= implode("-", $dbs);

        if ($_GET['pag'] < $totalPag) {
            $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarInsumoss&pag=" . ($siguiente + 1) . "'>..::BLOQUE SIGUIENTE::..</a><br>";
            $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarInsumoss&pag=" . ($totalPag - $totalEnlacesPaginacion) . "'>..::BLOQUE FINAL::..</a><br></center>";
        }


        return $mostrar;
    }

    public function seleccionarId($sId) {
//
//        $resultadoConsulta = FALSE;

        $planConsulta = "select * from Insumoss l ";
        $planConsulta .= " where l.isbn= ? ;";
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

            $inserta = $this->conexion->prepare('INSERT INTO Insumoss (isbn, titulo, autor, precio, categoriaInsumos_catLibId) VALUES ( :isbn, :titulo, :autor, :precio, :categoriaInsumos_catLibId );');
            $inserta->bindParam(":isbn", $registro['isbn']);
            $inserta->bindParam(":titulo", $registro['titulo']);
            $inserta->bindParam(":autor", $registro['autor']);
            $inserta->bindParam(":precio", $registro['precio']);
            $inserta->bindParam(":categoriaInsumos_catLibId", $registro['categoriaInsumos_catLibId']);
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
