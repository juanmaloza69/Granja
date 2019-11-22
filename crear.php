<?php /*  */
session_start();
include("header.php");
?>
<div class="my-5 col-12 bg-light border border-dark rounded py-1 pt-0">
    <div class="row my-2 ">
        <div class="col-5 ">
            <h1>Insertar animal</h1>
        </div>
    </div>


    <div class="row my-2">
        <div class="col-5">
  <form action="Index.php" method="POST" style="">
  <div class="form-group">
    <select class="form-control" name="tipo">
       <option value="gallina">Gallina</option> 
       <option value="cerdo">Cerdo</option> 
       <option value="vaca">Vaca</option>
    </select>
  </div>
 
 <input class="btn btn-danger px-5 py-3" type="submit" value="insertar">
</form>
         </div>
    </div>
</div>

<a type="submit" class="btn btn-warning btn-block" href="./Index.php">Atrás</a>

<?php include("footer.php");?>