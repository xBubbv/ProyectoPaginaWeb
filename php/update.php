<?php

    include("conexion.php");

    $id = $_POST['id'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $user = $_POST['user'];
    $password = $_POST['password'];

    $sql="UPDATE usuarios SET  id='$id', name='$name', lastname='$lastname', email='$email', user='$user', password='$password' WHERE id='$id'";
    $query=mysqli_query($conexion,$sql);

    if($query){
        header("Location: panel-de-control.php");
    }
?>