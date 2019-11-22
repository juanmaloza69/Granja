<?php
// Granjero.php
class Granjero {
    private $nombre;
    private $fechaingreso;
    private $misanimales = array();
    public $id_trabajador;
    public function __construct($nombre, $fechaingreso){
        $this->fechaingreso = $fechaingreso;
        $this->nombre = $nombre;

        //conexión a la base de datos para obtener los animales)
        require("conexion.php");
        if(!isset($_SESSION['usuario'])){
            header("location: login.php");
        }
        $consulta = "SELECT id from trabajadores where nombre='".$nombre."';";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $id = $sentencia->fetchAll();
        $this->id_trabajador=$id[0]['id'];




        $consulta = "SELECT * FROM animales where id_trabajador = '".$this->id_trabajador."';";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $animales = $sentencia->fetchAll();

        //guardamos los datos de los animales en el array "misanimales":
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

    //PARA AÑADIR UN NUEVO ANIMAL (DESDE EL FORMULARIO):
    public function añadirAnimal($tipo){
    	
        require("conexion.php");
        if(!isset($_SESSION['usuario'])){
            header("location: login.php");
        }

        $animal = Animal::crear($tipo,$this->ultimoid+1);
        $this->misanimales[] = $animal;

        $consulta = "INSERT INTO animales (tipo, estado, fecha_comida, fecha_nacimiento, id_trabajador) VALUES ( '" . $tipo . "', '" . $animal->estado . "', '" . $animal->fechacomida . "', '" . $animal->fecha_nacimiento . "', '" . $this->id_trabajador . "');";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $animal = $sentencia->fetchAll();

    }

    //PARA BORRAR UN ANIMAL DE LA BASE DE DATOS:
    public function eliminarAnimal($id){

        require("conexion.php");
        if(!isset($_SESSION['usuario'])){
            header("location: login.php");
        }

        $consulta = "DELETE FROM animales WHERE (id = '". $id ."');";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $animal = $sentencia->fetchAll();
    }

     //DEVUELVE UN ARRAY CON LOS ANIMALES DEL USUARIO:
    public function getMisAnimales(){
        return $this->misanimales;
    }

    public function darDeComer($animal){
        if (in_array($animal, $this->misanimales)) {
            $animal->comiendo();
        }
    }

    public function save(){
        require("conexion.php");
        if(!isset($_SESSION['usuario'])){
            header("location: login.php");
        }
        foreach ($this->misanimales as $key => $value) {

        $consulta = "UPDATE animales set estado = '" . $value->estado . "', fecha_comida = '". $value->fechacomida ."', fecha_nacimiento = '". $value->fecha_nacimiento."' WHERE (id = '".$value->id."');";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $animales = $sentencia->fetchAll();

        }
        
    }
}

?>