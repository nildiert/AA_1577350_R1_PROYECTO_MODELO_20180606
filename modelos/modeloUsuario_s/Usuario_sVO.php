<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_sVO
 *
 * @author AdministradorH
 */
class Usuario_sVO {
    //put your code here
    
    private $usuId;
    private $usuLogin;
    private $usuPassword;
    private $usuUsuSesion;
    private $usuEstado;
    private $usuRemember_token;
    private $usu_created_at;
    private $usu_updated_at;
 
    public function getUsuId() {
        return $this->usuId;
    }

    public function getUsuLogin() {
        return $this->usuLogin;
    }

    public function getUsuPassword() {
        return $this->usuPassword;
    }

    public function getUsuUsuSesion() {
        return $this->usuUsuSesion;
    }

    public function getUsuEstado() {
        return $this->usuEstado;
    }

    public function getUsuRemember_token() {
        return $this->usuRemember_token;
    }

    public function getUsu_created_at() {
        return $this->usu_created_at;
    }

    public function getUsu_updated_at() {
        return $this->usu_updated_at;
    }

    public function setUsuId($usuId) {
        $this->usuId = $usuId;
    }

    public function setUsuLogin($usuLogin) {
        $this->usuLogin = $usuLogin;
    }

    public function setUsuPassword($usuPassword) {
        $this->usuPassword = $usuPassword;
    }

    public function setUsuUsuSesion($usuUsuSesion) {
        $this->usuUsuSesion = $usuUsuSesion;
    }

    public function setUsuEstado($usuEstado) {
        $this->usuEstado = $usuEstado;
    }

    public function setUsuRemember_token($usuRemember_token) {
        $this->usuRemember_token = $usuRemember_token;
    }

    public function setUsu_created_at($usu_created_at) {
        $this->usu_created_at = $usu_created_at;
    }

    public function setUsu_updated_at($usu_updated_at) {
        $this->usu_updated_at = $usu_updated_at;
    }




}
