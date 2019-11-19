<?php 
// Cultivo.php
class Cultivo 
{
    public $nombre;
    public $control = 'creciendo'; //creciendo //lista
    public $estado = 'sano'; //seco
    //mysql?
    //public $fechacomida;
    //public $fechanacimiento;

    public static function crear($tipo, $id) //nombre: nombre de la parcela
    {
        switch($tipo) {
            case 'lechuga':
                return new Lechuga($id);
            case 'tomate':
                return new Tomate($id);
            case 'calabaza':
                return new Calabaza($id);
            default:
                return new Exception("Clase de cultivo no válido");
        }
    }

    public function getTipo()
    {
        return get_class($this);
    }
}

class Lechuga extends Cultivo 
{
    public function __construct($id){
        $this->id = $id;
    }
    public function regado(){
    	// mysql public $fechacomida;
    }
}
class Tomate extends Cultivo 
{
    public function __construct($id){
        $this->id = $id;
    }
}
class Calabaza extends Cultivo 
{
    public function __construct($id){
        $this->id = $id;
    }
}
?>