<?php
$user = "root";
$pass = "";
$host = "localhost";
$db = "farm";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=Utf8",$user,$pass);

}
catch(PDOException $e){
    echo "Ocurrió el siguiente error: ".$e->getMessage();

}

    try{
        $dbh = new PDO($user, $pass);
    }catch(PDOException $e){
        $e->getMessage();
    }
?>