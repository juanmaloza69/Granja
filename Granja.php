<?php

class Granja {

    private $nombre;
    private $granjeros = array();
    private $animales = array();
    private $cultivos = array();

    public function __construct($nombre) {
        $this->_nombre = $nombre;
    }

    public function __toString() {
        return $this->nombre;
    }

    public function addGranjero(Granjero $granjero) {
        $this->granjeros[] = $granjero;
    }

    public function añadirAnimal(Animal $animal, Granjero $granjero){
        if (in_array($animal, $this->animales) && in_array($granjero, $this->granjeros)) {
            $this->animales[] = $animal;
            $granjero->añadirMiAnimal($animal);
        }
    }

    public function eliminarAnimal(Animal $animal, Granjero $granjero){
        if (in_array($animal, $this->animales) && in_array($granjero, $this->granjeros)) {
            unset($this->animales[$animal]);
            $granjero->eliminarMiAnimal($animal);
        }
    }

    public static function NumeroAnimales() {
        return count($animales);
    }

    public static function NumeroGranjeros() {
        return count($granjeros);
    }

    public static function NumeroCultivos() {
        return count($cultivos);
    }

    public function getGranjeros(){
        return $this->granjeros;
    }

    public function getAnimales(){
        return $this->animales;
    }

    public function getAnimales(){
        return $this->cultivos;
    }

    public function getAnimalesGranjero(Granjero $granjero){
        return $granjero->getMisAnimales();
    }

    public function getCultivosGranjero(Granjero $granjero){
        return $granjero->getMisCultivos();
    }


}

?>