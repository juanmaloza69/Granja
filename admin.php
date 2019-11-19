<?php //quesito
session_start();
include("header.php");
?>

<div class="mt-2 mb-2 center-block">
<a href="login.php" class="btn btn-warning btn-block">
    <i class="fa fa-close"></i> Cerrar Sesión
</a>
</div>
<?php



if(!isset($_SESSION['usuario'])){
    header("location: login.php");
 }
?>

<?php
    require_once("conexion.php");
    $consulta = "SELECT * FROM animales where id_trabajador = (select id from trabajadores where nombre='".$_SESSION['usuario']."');";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute();
    $resultados = $sentencia->fetchAll();
    

	$consulta1 = "SELECT * FROM cultivos where id_trabajador = (select id from cultivos where nombre='".$_SESSION['usuario']."');";

	$sentencia1 = $conexion->prepare($consulta1);
	$sentencia1->execute();
	$resultadoscultivos = $sentencia1->fetchAll();


                    
?>
<!-- Page Features -->
    <div class="row text-center">
    

<?php
foreach ($resultados as $fila) {
?>
<!------------------>

      <div class="col-lg-3 col-md-3 mb-4">
        <div class="card h-100">
        	<div class="h-70">
          <?php
          echo "<img style='height: 350px; width:200px;' class='card-img-top m-auto d-block' src='./img/". $fila["tipo"] . $fila["estado"] . ".png' alt=''>";
          ?> 
          	</div >
          <div class="card-body">
            <h4 class="card-title"><?php echo $fila["tipo"] . " " . $fila["id"];?></h4>
            <p class="card-text">Estado: <?php echo $fila["estado"];?></p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Dar de comer</a>
          </div>
        </div>
      </div>
<!------------------>

  <?php              }
 foreach ($resultadoscultivos as $fila) {
 ?>



      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="http://placehold.it/500x325" alt="">
          <div class="card-body">
            <h4 class="card-title"><?php echo $fila["type"] . " " . $fila["id"]?></h4>
            <p class="card-text"><?php echo $fila["estado"]?></p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Dar de comer</a>
          </div>
        </div>
      </div>


<?php 

}

?>


<?php 

include("footer.php");

?>
