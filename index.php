<?php

require_once 'Animal.php';
require_once 'Granja.php';
require_once 'Cultivo.php';
require_once 'conexion.php';
require_once 'login.php';
require_once 'admin.php';

class Index {

    public function ejecutar() {
    	$consulta = "SELECT * FROM animales";
    	$sentencia = $conexion->prepare($consulta);
    	$sentencia->execute();
    	$animales = $sentencia->fetchAll();

    	foreach ($animales as $fila) {
    		Animal = new Animal($fila["tipo"], $fila["id"]);
    	}
	}
}

$index = new Index();
$index->ejecutar();


?>

<a type="submit" href="../">Atrás</a>