<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoriaLibroVO
 *
 * @author AdministradorH
 */
class CategoriaLibroVO {

    //put your code here

    private $catLibId;
    private $catLibNombre;
    private $catLibObservacion;
    
    function getCatLibId() {
        return $this->catLibId;
    }

    function getCatLibNombre() {
        return $this->catLibNombre;
    }

    function getCatLibObservacion() {
        return $this->catLibObservacion;
    }

    function setCatLibId($catLibId) {
        $this->catLibId = $catLibId;
    }

    function setCatLibNombre($catLibNombre) {
        $this->catLibNombre = $catLibNombre;
    }

    function setCatLibObservacion($catLibObservacion) {
        $this->catLibObservacion = $catLibObservacion;
    }



}
