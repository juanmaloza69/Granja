<?php /*  */
session_start();
include("header.php");

?>

<div class="mt-2 mb-2 center-block">
<a href="login.php" class="btn btn-warning btn-block">
    <i class="fa fa-close"></i> Cerrar Sesión
</a>
</div>

<?php

$granjero;

require_once 'Animal.php';
require_once 'Granja.php';
require_once 'Cultivo.php';
require_once 'Granjero.php';

//require_once 'login.php';
//require_once 'admin.php';

class Index {

    public function ejecutar() {

    	require_once("conexion.php");
    	if(!isset($_SESSION['usuario'])){
    		header("location: login.php");
 		}
 		/*
    	$consulta = "SELECT * FROM trabajadores where nombre='" . $_SESSION['usuario'] . "';";
    	$sentencia = $conexion->prepare($consulta);
    	$sentencia->execute();
    	$trabajadores = $sentencia->fetchAll();
    	echo $trabajadores[0]['nombre_granja'];

    	$granja = new Granja($trabajadores[0]['nombre_granja']);*/

    	$consulta = "SELECT * FROM trabajadores where nombre='" . $_SESSION['usuario'] . "';";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $trabajadores = $sentencia->fetchAll();
        //print_r( $trabajadores);
        $granjero = new Granjero($trabajadores[0]['nombre'],$trabajadores[0]['fecha_ingreso']);
        
    	?>




    	

		    	<!-- Page Features -->
		<div class="row text-center">
		    

		<?php
		foreach ($granjero->getMisAnimales() as $key => $value) {
		?>
		<!------------------>

		      <div class="col-lg-3 col-md-3 mb-4">
		        <div class="card h-100">
		        	<div class="h-70">
		          <?php
		          echo "<img style='height: 350px; width:200px;' class='card-img-top m-auto d-block' src='./img/". $value->getTipo(). $value->estado . ".png' alt=''>";
		          ?> 
		          	</div >
		          <div class="card-body">
		            <h4 class="card-title"><?php echo $value->getTipo() . " " . $value->id;?></h4>
		            <p class="card-text">Estado: <?php echo $value->estado;?> , FechaComida: <?php echo $value->fechacomida; $value->comiendo();?></p> 

		          </div>
		          <div class="card-footer">
		            <a href="#" class="btn btn-primary" onClick ="darComer($value);" >Dar de comer</a>
		          </div>
		        </div>
		      </div>
		<!------------------>

		  <?php              
		}
		

		?>
    	<?php
    	print_r($granjero->getMisAnimales());
    	
	}
}

$index = new Index();
$index->ejecutar();


?>
<script>
function darComer($animal){
			$GLOBALS["granjero"]->darDeComer($animal);
			print $animal;
			header("location:Index.php");
			//RECARGAR PAGINA
		}
</script>

<a type="submit" href="../">Atrás</a>