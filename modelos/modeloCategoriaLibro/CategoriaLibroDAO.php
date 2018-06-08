<?php

include_once PATH . 'modelos/ConBdMySql.php';
include_once PATH . 'modelos/modeloCategoriaLibro/CategoriaLibroVO.php';
include_once PATH . 'modelos/InterfaceCRUD.php';

class CategoriaLibroDAO extends ConBdMySql /* implements InterfaceCRUD */ {

    private $cantidadTotalRegistros;

    function __construct(UsuarioBd $usuarioBd, $base, $servidor) {
        parent::__construct($usuarioBd, $base, $servidor);
    }

    public function seleccionarTodos() {
        $planConsulta = "select cl.catLibId,cl.catLibNombre FROM categorialibro cl order by cl.catLibId ";

        $registrosCategoriaLibro = $this->conexion->prepare($planConsulta); //Se envia la consulta
        $registrosCategoriaLibro->execute(); //Ejecución de la consulta        
        $listadoRegistrosCategoriasLibros = array();

        while ($registro = $registrosCategoriaLibro->fetch(PDO::FETCH_OBJ)) {
            $listadoRegistrosCategoriasLibros[] = $registro;
        }

        $this->cierreBd();
        
   
        return $listadoRegistrosCategoriasLibros;
    }

}
