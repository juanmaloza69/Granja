<?php 
// Animal.php
class Animal 
{
    public $id;
    public $edad; // = 'joven';
    public $estado; // = 'feliz';
    protected $tiempocrecimiento;
    protected $tiempocomer;
    //mysql? 
    public $fechacomida;
    protected $fecha_nacimiento;
    public static function crear($tipo, $id, $estado='feliz', $fecha_comida='0', $fecha_nacimiento='0')
    {
        switch($tipo) {
            case 'gallina':
                return new Gallina($id,$estado, $fecha_comida, $fecha_nacimiento);
            case 'cerdo':
                return new Cerdo($id,$estado, $fecha_comida, $fecha_nacimiento);
            case 'vaca':
                return new Vaca($id,$estado, $fecha_comida, $fecha_nacimiento);
            default:
                return new Exception("Clase de animal no válido");
        }
    }

    public function getTipo()
    {
        return get_class($this);
    }
    

    public function comiendo(){


        if ($fechacomida='0'){
            $actual = date('Y-m-d h:i:s');
            $fecha = new DateTime($actual);
            $fecha->add(new DateInterval('PT'. $this->tiempocomer .'M'));
            $this->fechacomida = $fecha->format('Y-m-d h:i:s');
        }

        else{
            $fecha = new DateTime($this->fechacomida);
            $fecha->add(new DateInterval('PT'. $this->tiempocomer .'M')); //PT
            $this->fechacomida = $fecha->format('Y-m-d h:i:s');
        }
    }

    public function setEdad(){
        if ($fecha_nacimiento='0'){
            $this->fecha_nacimiento = date('Y-m-d h:i:s');
            $this->edad = 'joven';
        }

        else{
            $fecha = new DateTime($this->fecha_nacimiento);
            $fecha->add(new DateInterval('PT'. $this->tiempocrecimiento .'M'));
            $actual = date('Y-m-d h:i:s');
            if($actual > $fecha){
                $this->edad = 'adulto';
            }
            else{
                 $this->edad = 'joven';
            }
        }
    }
}

class Gallina extends Animal 
{
    public function __construct($id,$estado, $fecha_comida, $fecha_nacimiento){
        $this->tiempocrecimiento = 2;
        $this->tiempocomer = 1;

        $this->id = $id;
        $this->estado = $estado;
        $this->fechacomida = $fecha_comida;
        $this->fecha_nacimiento = $fecha_nacimiento;

        $this->setEdad();
        $this->comiendo();

        
    }
    
}
class Cerdo extends Animal 
{
    public function __construct($id,$estado, $fecha_comida, $fecha_nacimiento){
        $this->tiempocrecimiento = 3;
        $this->tiempocomer = 2;

        $this->id = $id;
        $this->estado = $estado;
        $this->fechacomida = $fecha_comida;
        $this->fecha_nacimiento = $fecha_nacimiento;

        $this->setEdad();
        $this->comiendo();  
        
    }
}
class Vaca extends Animal 
{
    public function __construct($id,$estado, $fecha_comida, $fecha_nacimiento){
        $this->tiempocrecimiento = 5;
        $this->tiempocomer = 2;

        $this->id = $id;
        $this->estado = $estado;
        $this->fechacomida = $fecha_comida;
        $this->fecha_nacimiento = $fecha_nacimiento;

        $this->setEdad();
        $this->comiendo();
    }
}
?>