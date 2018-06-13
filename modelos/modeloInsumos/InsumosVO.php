<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LibroVO
 *
 * @author AdministradorH
 */
class InsumosVO {
    //put your code here
    
    private $InsCodigo;
    private $InsNombre;
    private $InsUnidadMedida;
    private $InsPrecio; 

    function getInsCodigo() {
        return $this->InsCodigo;
    }

    function getInsNombre() {
        return $this->InsNombre;
    }

    function getInsUnidadMedida() {
        return $this->InsUnidadMedida;
    }
    
    function getInsPrecio() {
        return $this->InsPrecio;
    }


    function setInsCodigo($InsCodigo) {
        $this->InsCodigo = $InsCodigo;
    }

    function setInsNombre($InsNombre) {
        $this->InsNombre = $InsNombre;
    }

    function setInsUnidadMedida($InsUnidadMedida) {
        $this->InsUnidadMedida = $InsUnidadMedida;
    }
    
    function setInsPrecio($InsPrecio) {
        $this->InsPrecio = $InsPrecio;
    }    


 

}


