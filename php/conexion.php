<?php
    $server = "localhost";
    $user = "root";
    $pass = "admin1234";
    $bd = "ayv_propiedades";

    $conexion = new mysqli($server, $user, $pass, $bd);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }
?>
