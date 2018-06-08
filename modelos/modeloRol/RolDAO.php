<?php

include_once PATH . 'modelos/ConBdMySql.php';
include_once PATH . 'modelos/UsuarioBD.php';
include_once PATH . 'modelos/modeloUsuario_s/Usuario_sVO.php';
include_once PATH . 'modelos/InterfaceCRUD.php';

class RolDAO extends ConBdMySql /* implements InterfaceCRUD */ {

    private $cantidadTotalRegistros;

    function __construct(UsuarioBd $usuarioBd, $base, $servidor) {
        parent::__construct($usuarioBd, $base, $servidor);
    }

    public function seleccionarRolPorPersona($sId) {//llega como parametro un array con datos a consultar
        $planConsulta = "select r.rolId,r.rolNombre,r.rolDescripcion  from ((rol r join usuario_s_roles ur on r.rolId=ur.id_rol) ";
        $planConsulta .= " join usuario_s u on u.usuId=ur.id_usuario_s) ";
        $planConsulta .= " right join persona p on p.perId=ur.id_usuario_s ";
        $planConsulta .= " where p.perDocumento = ? ;";
        $listar = $this->conexion->prepare($planConsulta);
        $listar->execute(array($sId[0]));

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

}
