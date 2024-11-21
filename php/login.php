<?php
    include("conexion.php");
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = trim($_POST['user']);
        $password = trim($_POST['password']);

        $sql = "SELECT * FROM usuarios WHERE user = '$user'";
        $query = mysqli_query($conexion, $sql);

        if ($query && mysqli_num_rows($query) > 0) {
            $user_data = mysqli_fetch_assoc($query);

            // Verificar contraseña
            if ($password === $user_data['password']) { 
                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['username'] = $user_data['name'];

                header("Location: ../index.php");
                exit();
            } else {
                echo "<script>alert('Contraseña incorrecta'); window.location.href = '../index.php';</script>";
            }
        } else {
            echo "<script>alert('Usuario no encontrado'); window.location.href = '../index.php';</script>";
        }
    }
?>