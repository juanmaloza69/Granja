<?php
session_start();
include("header.php");

//ACTUALIZAMOS CADA CIERTOS SEGUNDOS PARA VER CUANDO CAMBIA EL ESTADO DE LOS ANIMALES:
$self = $_SERVER['PHP_SELF'];
header("refresh:3; url=$self");
?>

<!-- CERRAR SESION: -->
<div class="mt-2 mb-2 center-block">
	<a href="login.php" class="btn btn-warning btn-block">
		<i class="fa fa-close"></i> Cerrar Sesión
	</a>
</div>

<!-- AÑADIR NUEVO ANIMAL: -->
<div class="mt-2 mb-2 center-block">
	<a href="crear.php" class="btn btn-success btn-block">
		<i class="fa fa-close"></i> Añadir Animal (+)
	</a>
</div>


<?php
//CREAMOS LA VARIABLE GLOBAL
$granjero;

require_once 'Animal.php';
require_once 'Granjero.php';

class Index {
//CÓDIGO QUE SE EJECUTARÁ:
    public function ejecutar() {
    	//INICIAMOS LA CONEXIÓN CON LA BASE DE DATOS Y OBTENEMOS LOS DATOS DEL TRABAJADOR LIGADO AL USUARIO QUE INICIA SESIÓN:
    	require_once("conexion.php");
    	if(!isset($_SESSION['usuario'])){
    		header("location: login.php");
 		}

    	$consulta = "SELECT * FROM trabajadores where nombre='" . $_SESSION['usuario'] . "';";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $trabajadores = $sentencia->fetchAll();
        //CREAMOS EL OBJETO GRANJERO, EL CUAL TENDRÁ LOS DATOS Y ANIMALES DEL USUARIO GUARDADOS EN LA BD.
        $granjero = new Granjero($trabajadores[0]['nombre'],$trabajadores[0]['fecha_ingreso']);
        
        //CUANDO CREAMOS UN NUEVO ANIMAL EN LA PÁGINA:
        if(isset($_POST['tipo'])){
 			$granjero->añadirAnimal($_POST['tipo']);
 			header("location:Index.php");
 		}

 		else{
 			//CUANDO PINCHAMOS EN EL BOTON DE ELIMINAR (EN UNA CARTA DE LA PÁGINA).
 			if(isset($_POST['eliminar'])){
 			$granjero->eliminarAnimal($_POST['eliminar']);
 			header("location:Index.php");
 			}

 			else{
 				//CUANDO PINCHAMOS EN EL BOTON "DAR DE COMER" (EN UNA CARTA DE LA PÁGINA).
 				if(isset($_POST['dardecomer'])){
		 			$animales=$granjero->getMisAnimales();
		 			$animales[$_POST["dardecomer"]]->comiendo();
		 			$granjero->save();
		 			header("location:Index.php");

		 		}

		 		else{

?>
		  
					<!-- Page Features -->
					<div class="row text-center">
					    
<?php 				foreach ($granjero->getMisAnimales() as $key => $value) { ?>
					<!----- IMPRIMIMOS CADA CARTA / ANIMAL------------->

					    <div class="col-lg-3 col-md-3 mb-4">
					        <div class="card h-100">

					        	<div class="h-70">
					          	<?php
					          	echo "<img style='height: 350px; width:200px;' class='card-img-top m-auto d-block' src='./img/". $value->getTipo(). $value->estado . ".png' alt=''>";
					          	?> 
					          	</div >

					          	<div class="card-body">
					            	<h4 class="card-title"><?php echo $value->getTipo() . " " . $value->id;?></h4>

					            	<p class="card-text"> <b>Estado:</b> <?php echo $value->estado;?></p>

					            	<?php
					          		if ($value->estado == 'feliz') $color = 'success';
					          		else $color = 'danger';
					          		?>

					            	<p class="card-text"> <b>SIGUIENTE COMIDA</b> <button type="button" class="btn btn-outline-<?php echo $color; ?>"><?php echo $value->fechacomida; ?></button> </p>

					            	<p class="card-text"> EDAD: <b><?php echo $value->edad;?></b></p>
					          	</div>

					          	<div class="card-footer btn-<?php echo $color; ?>">
						          	<form action="Index.php" method="post" class="py-1">
										 <input type="hidden" name="dardecomer" value="<?php echo $key;?>"/>
										 <input class="btn btn-primary" value="Dar de comer" type="submit" />
									</form>
									<form action="Index.php" method="post">
										 <input type="hidden" name="eliminar" value="<?php echo $value->id; ?>"/>
										 <input class="btn btn-danger" value="Eliminar" type="submit" />
									</form>
					            </div>

					        </div>
					    </div>
					<!------------------>

<?php 				}	?>
					</div> <!---- CERRAMOS EL FOREACH--->
<?php
			    }
 			}

 			
 		}
        
	}
}
//EJECUCIÓN DEL PROGRAMA:
$index = new Index();
$index->ejecutar();

?>