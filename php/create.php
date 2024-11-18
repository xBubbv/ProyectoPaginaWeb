<?php
    include("conexion.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $user = $_POST['user'];
        $password = $_POST['password'];

        #$hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (name, lastname, email, user, password) VALUES ('$name', '$lastname', '$email', '$user', '$password')";

        if (mysqli_query($conexion, $sql)) {
            header("Location: panel-de-control.php?success=Usuario agregado exitosamente!");
            exit();
        } else {
            header("Location: panel-de-control.php?error=Error al agregar usuario");
            exit();
        }
    }
?>
