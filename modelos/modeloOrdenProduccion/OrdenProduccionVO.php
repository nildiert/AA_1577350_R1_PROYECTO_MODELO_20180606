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
class ordenproduccionVO {
    //put your code here
    
    private $InsCodigo;
    private $InsNombre;
    private $InsCantActual;
    private $InsUnidadMedida;
    private $InsPrecio; 

    function getInsCodigo() {
        return $this->InsCodigo;
    }

    function getInsNombre() {
        return $this->InsNombre;
    }
    function getInsCantActual() {
        return $this->InsCantActual;
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

    function setInsCantActual($InsCantActual) {
        $this->InsCantActual = $InsCantActual;
    }

    function setInsUnidadMedida($InsUnidadMedida) {
        $this->InsUnidadMedida = $InsUnidadMedida;
    }
    
    function setInsPrecio($InsPrecio) {
        $this->InsPrecio = $InsPrecio;
    }    


 

}


