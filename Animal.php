<?php 
// Animal.php
class Animal 
{
    public $id;
    public $edad = 'joven';
    public $estado = 'feliz';
    protected $timepocrecimiento;
    protected $timepocomer;
    //mysql?
    //public $fechacomida;
    //public $fechanacimiento;


    public static function crear($tipo, $id, $edad='joven', $estado='feliz')
    {
        switch($tipo) {
            case 'gallina':
                return new Gallina($id);
            case 'cerdo':
                return new Cerdo($id);
            case 'vaca':
                return new Vaca($id);
            default:
                return new Exception("Clase de animal no válido");
        }
    }

    public function getTipo()
    {
        return get_class($this);
    }
}

class Gallina extends Animal 
{
    public function __construct($id){
        $this->id = $id;
        $this->timepocrecimiento = 2min;
        $this->$timepocomer = 1min;
    }
    public function comiendo(){
    	// mysql public $fechacomida;
    }
}
class Cerdo extends Animal 
{
    public function __construct($id){
        $this->id = $id;
        $this->timepocrecimiento = 3min;
        $this->$timepocomer = 2min;
    }
}
class Vaca extends Animal 
{
    public function __construct($id){
        $this->id = $id;
        $this->timepocrecimiento = 5min;
        $this->$timepocomer = 2min;
    }
}
?>