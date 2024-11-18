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

    if (mysqli_query($conexion, $update_sql)) {
        header("Location: panel-de-control.php?success=Usuario actualizado exitosamente");
        exit();
    } else {
        header("Location: panel-de-control.php?error=Error al actualizar el usuario");
        exit();
    }
    
?>