<?php

class Granjero {
    private $nombre;
    private $fechaingreso;
    private $misanimales = array();

    public function __construct($nombre, $fechaingreso){
        $this->fechaingreso = $fechaingreso;
        $this->nombre = $nombre;

        require("conexion.php");
        if(!isset($_SESSION['usuario'])){
            header("location: login.php");
        }

        $consulta = "SELECT * FROM animales where id_trabajador = (select id from trabajadores where nombre='".$nombre."');";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $animales = $sentencia->fetchAll();

        foreach ($animales as $fila) {
            $animal = Animal::crear($fila['tipo'],$fila['id'],$fila['estado'],$fila['fecha_comida'],$fila['fecha_nacimiento']);
            $this->misanimales[] = $animal;
        }
    }
    public function __toString() {
        return (string) $this->nombre;
    }
     public function getNombre() {
        return (string) $this->nombre;
    }
    public function añadirMiAnimal(Animal $animal){
    	if (!in_array($animal, $this->misanimales)){
         $this->misanimales[] = $animal;
    	}
    }


    public function eliminarMiAnimal(Animal $animal){
        if (in_array($animal, $this->misanimales)) {
            unset($this->misanimales[$animal]);
        }
 	}

    public function getMisAnimales(){
        return $this->misanimales;
    }

    public function darDeComer($animal){
        if (in_array($animal, $this->misanimales)) {
            $animal->comiendo();
        }
    }
}

?>