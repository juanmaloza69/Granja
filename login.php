<?php include("header.php")?>



<div class="container my-5 col-10 bg-light border border-dark rounded py-1 pt-0">
    <div class="row my-2 ">
        <div class="col-5 ">
            <h1>Iniciar sesión</h1>
        </div>
    </div>
   

    <div class="row my-2">
        <div class="col-5">
            
            <form action="#" method="post">

                <input type="text" class="form-control mb-4 p-4" name="usuario" placeholder="Usuario" required>
                
                <input type="password" class="form-control mb-4 p-4" name="contraseña" placeholder="Contraseña" required>

                <input class="btn btn-danger px-5 py-3" type="submit" value="Entrar" name="envio">
            </form>

<?php

    
        if(isset($_POST["envio"])){
            if(empty($_POST["usuario"]) || empty($_POST["contraseña"])){
                echo "<p>No se pueden dejar campos vacíos.</p>";
            }
            else{
                require_once("conexion.php");
                $consulta = "SELECT * FROM usuarios where nombre='" . $_POST['usuario'] . "' and contraseña = '". $_POST['contraseña'] ."';";
                $sentencia = $conexion->prepare($consulta);
                $sentencia->execute();
                $resultados = $sentencia->fetchAll();
                if(empty($resultados)){
                    echo "<p>Datos incorrectos.</p>";
                }
                else{
                    print_r($resultados);
                    session_start();
                    $_SESSION["usuario"] = $_POST["usuario"];
                    echo "<p>Inicio de sesión correcto.</p>";
                    header("location:Index.php");
                }
            }
        }
    ?>


        </div>
    </div>
</div>