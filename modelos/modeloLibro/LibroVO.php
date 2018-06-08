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
class LibroVO {
    //put your code here
    
    private $isbn;
    private $titulo;
    private $autor;
    private $precio;
    private $categoriaLibro_catLibId;
 
    function getIsbn() {
        return $this->isbn;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getAutor() {
        return $this->autor;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getCategoriaLibro_catLibId() {
        return $this->categoriaLibro_catLibId;
    }

    function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setCategoriaLibro_catLibId($categoriaLibro_catLibId) {
        $this->categoriaLibro_catLibId = $categoriaLibro_catLibId;
    }




}


