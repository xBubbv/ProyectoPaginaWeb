<?php
    include("conexion.php");

    if (isset($_POST['id'])) {
        
        $id = $_POST['id'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $user = $_POST['user'];
        $password = $_POST['password'];
        
        $check_email_sql = "SELECT * FROM usuarios WHERE email = '$email' AND id != '$id'";
        $check_email_query = mysqli_query($conexion, $check_email_sql);

        if (mysqli_num_rows($check_email_query) > 0) {
            
            header("Location: panel-de-control.php?error=El correo electrónico ya está registrado");
            exit();
        }

       
        $update_sql = "UPDATE usuarios SET name = '$name', lastname = '$lastname', email = '$email', user = '$user', password = '$password' WHERE id = '$id'";

        if (mysqli_query($conexion, $update_sql)) {
           
            header("Location: panel-de-control.php?success=Usuario actualizado exitosamente");
            exit();
        } else {
            
            header("Location: panel-de-control.php?error=Error al actualizar el usuario");
            exit();
        }
    } else {
       
        header("Location: panel-de-control.php?error=ID de usuario no proporcionado");
        exit();
    }
?>
