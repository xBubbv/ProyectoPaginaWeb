<?php
    include("conexion.php");

    $email = $name = "";
    $error_message = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim($_POST['email']);

        $sql = "SELECT name, email FROM usuarios WHERE email = '$email'";
        $query = mysqli_query($conexion, $sql);

        if ($query && mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            $name = $row['name'];

            $token = bin2hex(random_bytes(6));

            $update_token_db = "UPDATE usuarios SET reset_token = '$token' WHERE email = '$email'";
            if (mysqli_query($conexion,$update_token_db)){
                header("Location: recover_password.php?token=$token ");
            } else {
                echo "Error al guardar el token de recuperación.";
            }
        }else {
            header("Location: ../index.php?status=error_correo");
            exit();
        }
            
    }

?>

