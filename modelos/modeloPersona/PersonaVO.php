<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersonaVO
 *
 * @author AdministradorH
 */
class PersonaVO {
    //put your code here
    
    private $perId;
    private $perDocumento;
    private $perNombre;
    private $perApellido;
    private $perEstado;
    private $perUsuSesion;
    private $per_created_at;
    private $per_updated_at;
    private $usuario_s_usuId;
 
    public function getPerId() {
        return $this->perId;
    }

    public function getPerDocumento() {
        return $this->perDocumento;
    }

    public function getPerNombre() {
        return $this->perNombre;
    }

    public function getPerApellido() {
        return $this->perApellido;
    }

    public function getPerEstado() {
        return $this->perEstado;
    }

    public function getPerUsuSesion() {
        return $this->perUsuSesion;
    }

    public function getPer_created_at() {
        return $this->per_created_at;
    }

    public function getPer_updated_at() {
        return $this->per_updated_at;
    }

    public function getUsuario_s_usuId() {
        return $this->usuario_s_usuId;
    }

    public function setPerId($perId) {
        $this->perId = $perId;
    }

    public function setPerDocumento($perDocumento) {
        $this->perDocumento = $perDocumento;
    }

    public function setPerNombre($perNombre) {
        $this->perNombre = $perNombre;
    }

    public function setPerApellido($perApellido) {
        $this->perApellido = $perApellido;
    }

    public function setPerEstado($perEstado) {
        $this->perEstado = $perEstado;
    }

    public function setPerUsuSesion($perUsuSesion) {
        $this->perUsuSesion = $perUsuSesion;
    }

    public function setPer_created_at($per_created_at) {
        $this->per_created_at = $per_created_at;
    }

    public function setPer_updated_at($per_updated_at) {
        $this->per_updated_at = $per_updated_at;
    }

    public function setUsuario_s_usuId($usuario_s_usuId) {
        $this->usuario_s_usuId = $usuario_s_usuId;
    }


}


