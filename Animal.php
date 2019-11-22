<?php 
// Animal.php
class Animal 
{
    public $id;
    public $edad;
    public $estado; //CAMBIA CUANDO LE DAS DE COMER (   ejecutando la función: comiendo()  )

    protected $tiempocrecimiento; //CAMBIA SEGÚN EL TIPO DE ANIMAL
    protected $tiempocomer; //CAMBIA SEGÚN EL TIPO DE ANIMAL

    public $fechacomida;    //CUANDO LE TOCA COMER -> CAMBIA CUANDO LE DAS DE COMER (   ejecutando la función: comiendo()  )
    public $fecha_nacimiento;   //CAMBIA SEGÚN EL TIPO DE ANIMAL
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
            $actual = date('Y-m-d H:i:s');
            $fecha = new DateTime($actual);
            $fecha->add(new DateInterval('PT'. $this->tiempocomer .'M'));
            $this->fechacomida = $fecha->format('Y-m-d H:i:s');
        }

        else{
            $fecha = new DateTime($this->fechacomida);
            $fecha->add(new DateInterval('PT'. $this->tiempocomer .'M')); //PT
            $this->fechacomida = $fecha->format('Y-m-d H:i:s');
            
            $fecha = new DateTime($this->fechacomida);
            $now = new DateTime(date('Y-m-d H:i:s'));
            $now->add(new DateInterval('PT'. $this->tiempocomer .'M')); //PT
            
            //calculamos la diferencia en minutos
            $diferencia=$now->diff($fecha);

                $days = $diferencia->format('%a');
                $minutes = 0;
                if($days){
                    $minutes += 24 * 60 * $days;
                }
                $hours = $diferencia->format('%H');
                if($hours){
                    $minutes += 60 * $hours;
                }
                $minutes += $diferencia->format('%i');
                
            //si hace más de 5 minutos que no le damos de comer, solo habrá que darle una vez (para facilitar el juego)
            if( $minutes > 5){
                $fecha = new DateTime(date('Y-m-d H:i:s'));
                $fecha->sub(new DateInterval('PT'. $this->tiempocomer .'M')); //PT
                $this->fechacomida = $now->format('Y-m-d H:i:s');
            }

            if( $now < $fecha){
                $this->estado = 'feliz';
            }
            else{
                $this->estado = 'triste';
            }
        }
    }
    public function mirarEstado(){
        if ($this->fechacomida=='0'){
            $this->fechacomida = date('Y-m-d H:i:s');
            $this->estado = 'triste';
        }
        else{
            $fecha = new DateTime($this->fechacomida);
            $now = new DateTime(date('Y-m-d H:i:s'));
            
            if( $now < $fecha){
                $this->estado = 'feliz';
            }
            else{
                $this->estado = 'triste';
            }
        }   
    }
    public function setEdad(){
        if ($this->fecha_nacimiento=='0'){
            $this->fecha_nacimiento = date('Y-m-d H:i:s');
            $this->edad = 'joven';
        }

        else{

            $fecha = new DateTime($this->fecha_nacimiento);
            $actual = new DateTime(date('Y-m-d H:i:s'));

            //calculamos la diferencia en minutos
            $diferencia=$actual->diff($fecha);

                $days = $diferencia->format('%a');
                $minutes = 0;
                if($days){
                    $minutes += 24 * 60 * $days;
                }
                $hours = $diferencia->format('%H');
                if($hours){
                    $minutes += 60 * $hours;
                }
                $minutes += $diferencia->format('%i');

            if($minutes > $this->tiempocrecimiento){
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
        $this->mirarEstado();
        
        
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
        $this->mirarEstado();
        
    }
}
class Vaca extends Animal 
{
    public function __construct($id,$estado, $fecha_comida, $fecha_nacimiento){
        $this->tiempocrecimiento = 5;
        $this->tiempocomer = 3;

        $this->id = $id;
        $this->estado = $estado;
        $this->fechacomida = $fecha_comida;
        $this->fecha_nacimiento = $fecha_nacimiento;

        $this->setEdad();
        $this->mirarEstado();
    }
}
?>