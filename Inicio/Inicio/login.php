<?php
require_once("conexion.php");
        if(isset($_POST["envio"])){
            if(empty($_POST["usuario"]) || empty($_POST["contraseña"])){
                echo "<p>No se pueden dejar campos vacíos.</p>";
            }
            else{
                session_start();
                $_SESSION["usuario"] = $_POST["usuario"];
                echo "<p>Inicio de sesión correcto.</p>";
                header("location:usuario.php");
            }
        }
    ?>
<?php include("header.php")?>
<div class="container my-5">
    <div class="row my-5">
        <div class="offset-4 col-4">
            <h1>Iniciar sesión</h1>
        </div>
    </div>


    <div class="row">
        <div class="offset-4 col-4">
        </div>
    </div>

    

    <div class="row my-5">
        <div class="offset-4 col-4">
            
            <form action="#" method="post">

                <input type="text" class="form-control mb-4 p-4" name="usuario" placeholder="Usuario" required>
                
                <input type="password" class="form-control mb-4 p-4" name="contraseña" placeholder="Contraseña" required>

                <input class="class="btn btn-primary btn-lg" type="submit" value="Entrar" name="envio">
            </form>

        </div>
    </div>
</div>
