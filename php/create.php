<?php

include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $user = $_POST['user'];
    $password = $_POST['password'];
    #$password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (name, lastname, email, user, password) VALUES ('$name', '$lastname', '$email', '$user', '$password')";

    if ($conexion->query($sql) === TRUE){
        header("Location: panel-de-control.php");
        exit;
    } else{ echo "Error al registrar: " . $conexion->error;}
}


?>