<?php

class Granjero {
    private $nombre;
    private $misanimales = array();

    public function __construct($nombre) {
        $this->nombre = $nombre;
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

}

?>