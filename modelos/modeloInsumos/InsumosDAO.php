<?php

//define("","");
include_once '../modelos/ConstantesConexion.php';
include_once PATH . 'modelos/ConBdMySql.php';
include_once PATH . 'modelos/UsuarioBD.php';
include_once PATH . 'modelos/InterfaceCRUD.php';

class InsumosDAO extends ConBdMySql/* implements InterfaceCRUD */
{

    private $cantidadTotalRegistros;

    public function __construct(UsuarioBd $usuarioBd, $base, $servidor)
    {
        parent::__construct($usuarioBd, $base, $servidor);
    }

    public function seleccionarTodos()
    {
        $planConsulta = "SELECT i.InsCodigo,i.InsNombre,i.InsCantActual,i.InsUnidadMedida,i.InsPrecio ";
        $planConsulta .= "FROM insumos i ";
  //      $planConsulta .= "WHERE i.InsEstado=1 ";//

        $registrosInsumos = $this->conexion->prepare($planConsulta); //Se envia la consulta
        $registrosInsumos->execute(); //Ejecución de la consulta
        $listadoRegistrosInsumos = array();

        while ($registro = $registrosInsumos->fetch(PDO::FETCH_OBJ)) {
            $listadoRegistrosInsumos[] = $registro;
        }

        $this->cierreBd();
        return $listadoRegistrosInsumos;
    }

    public function consultaPaginada(InsumosVO $consultarInsumos = null, $limit = null, $pagInicio = null)
    {

        $parametrosPaginacion = $this->solicitudPaginacion();
        $offset = $parametrosPaginacion[0];
        $limit = $parametrosPaginacion[1];

        $condicionBuscar = "";
        $filtros = 0;

        session_start();//Solo se coloca una vez .l.








        if (isset($_SESSION['InsCodigoF']) && !isset($_POST['InsCodigo'])) { //coloque desde aquí
            $_POST['InsCodigo'] = $_SESSION['InsCodigoF'];
        }

        if (isset($_POST['InsCodigo']) && !isset($_SESSION['InsCodigoF'])) {
            $_SESSION['InsCodigoF'] = $_POST['InsCodigo'];
        }//hasta aqui
        if (isset($_SESSION['InsNombreF']) && !isset($_POST['InsNombre'])) { //coloque desde aquí
            $_POST['InsNombre'] = $_SESSION['InsNombreF'];
        }

        if (isset($_POST['InsNombre']) && !isset($_SESSION['InsNombreF'])) {
            $_SESSION['InsNombreF'] = $_POST['InsNombre'];
        }//hasta aqui
        if (isset($_SESSION['InsCantActualF']) && !isset($_POST['InsCantActual'])) { //coloque desde aquí
            $_POST['InsCantActual'] = $_SESSION['InsCantActualF'];
        }

        if (isset($_POST['InsCantActual']) && !isset($_SESSION['InsCantActualF'])) {
            $_SESSION['InsCantActualF'] = $_POST['InsCantActual'];
        }//hasta aqui        
        if (isset($_SESSION['InsUnidadMedidaF']) && !isset($_POST['InsUnidadMedida'])) { //coloque desde aquí
            $_POST['InsUnidadMedida'] = $_SESSION['InsUnidadMedidaF'];
        }

        if (isset($_POST['InsUnidadMedida']) && !isset($_SESSION['InsUnidadMedidaF'])) {
            $_SESSION['InsUnidadMedidaF'] = $_POST['InsUnidadMedida'];
        }//hasta aqui        
        if (isset($_SESSION['InsPrecioF']) && !isset($_POST['InsPrecio'])) { //coloque desde aquí
            $_POST['InsPrecio'] = $_SESSION['InsPrecioF'];
        }

        if (isset($_POST['InsPrecio']) && !isset($_SESSION['InsPrecioF'])) {
            $_SESSION['InsPrecioF'] = $_POST['InsPrecio'];
        }//hasta aqui        

        if (isset($_POST['buscar'])) {
            $_POST['buscar'] = trim($_POST['buscar']);
        }

        $planConsulta = "SELECT i.InsCodigo,i.InsNombre,i.InsCantActual,i.InsUnidadMedida,i.InsPrecio ";
        $planConsulta .= "FROM insumos i ";
        //$planConsulta .= "WHERE i.InsEstado=1 ";


        if (!empty($_POST['InsCodigo'])) {
            $planConsulta .= " where i.InsCodigo='" . $_POST['InsCodigo'] . "'";
            $filtros = 0; // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta
        } else {
            $where = false; // inicializar $where a falso ( al comenzar la consulta NO HAY condiciones o criterios de búsqueda)
            $filtros = 0; // cantidad de filtros/condiciones o criterios de búsqueda al comenzar la consulta
            if (!empty($_POST['InsNombre'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . "i.InsNombre like upper('%" . $_POST['InsNombre'] . "%')"; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['InsCantActual'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . " i.InsCantActual = " . (float)$_POST['InsCantActual']; // con tipo de búsqueda aproximada sin importar mayúsculas ni minúsculas
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['InsUnidadMedida'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . " i.InsUnidadMedida like upper('%" . $_POST['InsUnidadMedida']. "%')";
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
            if (!empty($_POST['InsPrecio'])) {
                $where = true; // inicializar $where a verdadero ( hay condiciones o criterios de búsqueda)
                $planConsulta .= (($where && !$filtros) ? " where " : " and ") . " i.InsPrecio like upper('%" . $_POST['InsPrecio'] . "%')";
                $filtros++; //cantidad de filtros/condiciones o criterios de búsqueda
            }
           
        }
        if (!empty($_POST['buscar'])) {
            $where = true;
            $condicionBuscar = (($where && !$filtros == 0) ? " or " : " where ");
            $filtros++;
            $planConsulta .= $condicionBuscar;
            $planConsulta .= "( InsCodigo like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " or InsNombre like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " or InsCantActual like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " or InsUnidadMedida like '%" . $_POST['buscar'] . "%'";
            $planConsulta .= " ) ";
        };
        $planConsulta .= "  order by i.InsCodigo desc";
        $planConsulta .= " LIMIT " . $limit . " OFFSET " . $offset . " ; ";
//        echo $planConsulta;
//        exit();
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

            $dbs[] = "<a href='controladores/ControladorPrincipal.php?ruta=listarInsumos&pag=$i'>$i</a>";
            $conteoEnlaces++;
            $siguiente = $i;
        }

        $mostrar = "<center><a href='controladores/ControladorPrincipal.php?ruta=listarInsumos&pag=0'>..::PAGINAS INICIALES::..</a><br>";
        $mostrar .= "<a href='controladores/ControladorPrincipal.php?ruta=listarInsumos&pag=" . (($anterior)) . "'>..::BLOQUE ANTERIOR::..</a>";

        $mostrar .= implode("-", $dbs);

        if ($_GET['pag'] < $totalPag) {
            $mostrar .= "<a href='controladores/ControladorPrincipal.php?ruta=listarInsumos&pag=" . ($siguiente + 1) . "'>..::BLOQUE SIGUIENTE::..</a><br>";
            $mostrar .= "<a href='controladores/ControladorPrincipal.php?ruta=listarInsumos&pag=" . ($totalPag - $totalEnlacesPaginacion) . "'>..::BLOQUE FINAL::..</a><br></center>";
        }

        return $mostrar;
    }

    public function seleccionarId($sId)
    {
        //
        //        $resultadoConsulta = FALSE;
        
        $planConsulta = "select * from Insumos i ";
        $planConsulta .= " where i.InsCodigo= ? ;";
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

    public function actualizar($registro)
    {
        try {
            
            $InsCantActual = $registro[0]['InsCantActual'];
            $InsNombre = $registro[0]['InsNombre'];
            $InsUnidadMedida = $registro[0]['InsUnidadMedida'];
            $categoria = $registro[0]['InsPrecio'];
            $InsCodigo = $registro[0]['InsCodigo'];

            if (isset($registro[0]['InsCodigo'])) {
                $actualizar = "UPDATE Insumos SET InsCantActual= ? , InsNombre = ? , InsUnidadMedida = ? , InsPrecio = ? WHERE InsCodigo= ? ;";
                $resultado = $this->conexion->prepare($actualizar);
                $actualizacion = $resultado->execute(array($InsCantActual, $InsNombre, $InsUnidadMedida, $categoria, $InsCodigo));
                return ['actualizacion' => $actualizacion, 'mensaje' => $mensaje];
            }
        } catch (Exception $exc) {
            return ['actualizacion' => $actualizacion, 'mensaje' => $exc->getTraceAsString()];
        }
        var_dump ($actualizacion);
        exit();
    }

    public function eliminar($eId) {
/* 
        try {

    

            $InsCodigo=$eId[0]['InsCodigo'];

            if (isset($eId[0]['InsCodigo'])) {
                $actualizar = "UPDATE libros SET estado = 0 WHERE isbn = '".$isbn."';";
               //  DELETE FROM `libros` WHERE `libros`.`isbn` = '".$isbn."' AND `libros`.`categoriaLibro_catLibId` = '".$categoria."';
                
                $eliminar= "('DELETE FROM insumos WHERE InsCodigo= :InsCodigo')";
                
                $resultado = $this->conexion->prepare($eliminar);
                $eliminacion = $resultado->execute(array($InsCodigo));
                return ['eliminacion' => $eliminacion, 'mensaje' => $mensaje];
     
                
        } catch (Exception $exc) {
            return ['eliminacion' => $eliminacion, 'mensaje' => $exc->getTraceAsString()];
        }*/
    }

}


