<?php

//define("","");
include_once '../modelos/ConstantesConexion.php';
include_once PATH . 'modelos/ConBdMySql.php';
include_once PATH . 'modelos/UsuarioBD.php';
include_once PATH . 'modelos/InterfaceCRUD.php';

class LibroDAO extends ConBdMySql /* implements InterfaceCRUD */ {

    private $cantidadTotalRegistros;

    function __construct(UsuarioBd $usuarioBd, $base, $servidor) {
        parent::__construct($usuarioBd, $base, $servidor);
    }

    public function seleccionarTodos() {
        $planConsulta = "select SQL_CALC_FOUND_ROWS l.isbn,l.titulo,l.autor,l.precio,cl.catLibId,cl.catLibNombre from libros l ";
        $planConsulta.= " join categorialibro cl ";
        $planConsulta.= " ON  l.categoriaLibro_catLibId=cl.catLibId ";
        $planConsulta.= "  order by l.isbn ASC;";

        $registrosLibro = $this->conexion->prepare($planConsulta); //Se envia la consulta
        $registrosLibro->execute(); //Ejecución de la consulta        
        $listadoRegistrosLibro = array();

        while ($registro = $registrosLibro->fetch(PDO::FETCH_OBJ)) {
            $listadoRegistrosLibro[] = $registro;
        }

        $this->cierreBd();
        return $listadoRegistrosLibro;
    }

    public function consultaPaginada(LibroVO $consultarLibro = NULL, $limit = NULL, $pagInicio = NULL) {

        $parametrosPaginacion = $this->solicitudPaginacion();
        $offset = $parametrosPaginacion[0];
        $limit = $parametrosPaginacion[1];

        $condicionBuscar = "";
        $filtros = 0;

        session_start();

        if (isset($_SESSION['isbnF']) && !isset($_POST['isbn']))
            $_POST['isbn'] = $_SESSION['isbnF'];
        if (isset($_POST['isbn']) && !isset($_SESSION['isbnF']))
            $_SESSION['isbnF'] = $_POST['isbn'];







        if (isset($_POST['buscar']))
            $_POST['buscar'] = trim($_POST['buscar']);

        $planConsulta = "select SQL_CALC_FOUND_ROWS l.isbn,l.titulo,l.autor,l.precio,cl.catLibId,cl.catLibNombre from libros l ";
        $planConsulta.= " join categorialibro cl ";
        $planConsulta.= " ON  l.categoriaLibro_catLibId=cl.catLibId ";

        if (!empty($_POST['isbn'])) {
            $planConsulta.=" where l.isbn='" . $_POST['isbn'] . "'";
            $filtros = 0;  // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta        
        } else {
            $where = false; // inicializar $where a falso ( al comenzar la consulta NO HAY condiciones o criterios de búsqueda)
            $filtros = 0;  // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta
            if (!empty($_POST['titulo'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . "l.titulo like upper('%" . $_POST['titulo'] . "%')"; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($datos['autor'])) {
                $where = true;  // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . " l.autor like upper('%" . $_POST['autor'] . "%')"; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['precio'])) {
                $where = true;  // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . " l.precio = " . $_POST['precio'];
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['categoriaLibro_catLibId'])) {
                $where = true;  // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . " l.categoriaLibro_catLibId like upper('%" . $_POST['categoriaLibro_catLibId'] . "%')";
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['catLibNombre'])) {
                $where = true;  // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta.=(($where && !$filtros) ? " where " : " and ") . " cl.catLibNombre like upper('%" . $_POST['catLibNombre'] . "%')";
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

        $listadoLibros = array();

        while ($registro = $listar->fetch(PDO::FETCH_OBJ)) {
            $listadoLibros[] = $registro;
        }

        $listar2 = $this->conexion->prepare("SELECT FOUND_ROWS() as total;");
        $listar2->execute();
        while ($registro = $listar2->fetch(PDO::FETCH_OBJ)) {
            $totalRegistros = $registro->total;
        }
        $this->cantidadTotalRegistros = $totalRegistros;
        
        return array($totalRegistros, $listadoLibros);
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

            $dbs[] = "<a href='controladores/ControladorPrincipal.php?ruta=listarLibros&pag=$i'>$i</a>";
            $conteoEnlaces++;
            $siguiente = $i;
        }

        $mostrar = "<center><a href='controladores/ControladorPrincipal.php?ruta=listarLibros&pag=0'>..::PAGINAS INICIALES::..</a><br>";
        $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarLibros&pag=" . (($anterior)) . "'>..::BLOQUE ANTERIOR::..</a>";

        $mostrar.= implode("-", $dbs);

        if ($_GET['pag'] < $totalPag) {
            $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarLibros&pag=" . ($siguiente + 1) . "'>..::BLOQUE SIGUIENTE::..</a><br>";
            $mostrar.="<a href='controladores/ControladorPrincipal.php?ruta=listarLibros&pag=" . ($totalPag - $totalEnlacesPaginacion) . "'>..::BLOQUE FINAL::..</a><br></center>";
        }


        return $mostrar;
    }

    public function seleccionarId($sId) {
//
//        $resultadoConsulta = FALSE;

        $planConsulta = "select * from libros l ";
        $planConsulta .= " where l.isbn= ? ;";
        $listar = $this->conexion->prepare($planCons&laquota);
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

            $inserta = $this->conexion->prepare('INSERT INTO libros (isbn, titulo, autor, precio, categoriaLibro_catLibId) VALUES ( :isbn, :titulo, :autor, :precio, :categoriaLibro_catLibId );');
            $inserta->bindParam(":isbn", $registro['isbn']);
            $inserta->bindParam(":titulo", $registro['titulo']);
            $inserta->bindParam(":autor", $registro['autor']);
            $inserta->bindParam(":precio", $registro['precio']);
            $inserta->bindParam(":categoriaLibro_catLibId", $registro['categoriaLibro_catLibId']);
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
        try {

            $autor=$registro[0]['autor'];
            $titulo=$registro[0]['titulo'];
            $precio=$registro[0]['precio'];
            $categoria=$registro[0]['categoriaLibro_catLibId'];
            $isbn=$registro[0]['isbn'];

            if (isset($registro[0]['isbn'])) {
                $actualizar = "UPDATE libros SET autor= ? , titulo = ? , precio = ? , categoriaLibro_catLibId = ? WHERE isbn= ? ;";
                $resultado = $this->conexion->prepare($actualizar);
                $actualizacion = $resultado->execute(array($autor, $titulo, $precio, $categoria, $isbn));
                return ['actualizacion' => $actualizacion, 'mensaje' => $mensaje];
            }
        } catch (Exception $exc) {
            return ['actualizacion' => $actualizacion, 'mensaje' => $exc->getTraceAsString()];
        }
    }

    public function eliminar($eId) {
        $eId;
    }

}
