<?php

include_once '../modelos/modeloInsumos/InsumosDAO.php';
include_once '../modelos/UsuarioBD.php';

$usuarioBd=new UsuarioBD("root", "");

$pruebaInsumos =new InsumosDAO($usuarioBd, BASE, SERVIDOR);

//$listado=$pruebaInsumos->seleccionarTodos();
$listado=$pruebaInsumos->consultaPaginada();



//echo "<pre>";
//print_r($listado);
//echo "</pre>";
        
        
?>

