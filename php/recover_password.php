<?php
    include("conexion.php");

    if (!isset($_GET['token'])) {
        echo "Token no proporcionado.";
        exit();
    }

    $token = $_GET['token'];

    $sql = "SELECT email FROM usuarios WHERE reset_token = '$token'";
    $query = mysqli_query($conexion, $sql);

    if ($query && mysqli_num_rows($query) > 0) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $new_password = trim($_POST['new_password']);

            $row = mysqli_fetch_assoc($query);
            $email = $row['email'];

            $update_password_sql = "UPDATE usuarios SET password = '$new_password', reset_token = NULL WHERE email = '$email'";
            if (mysqli_query($conexion, $update_password_sql)) {
                header("Location: ../index.php?status=success");
                exit();

            } else {
                header("Location: ../index.php?status=error");
                exit();
            }
        }
    } else {
        echo "El token no es válido.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Actualizar datos</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Actualizar contraseña:</h1>
        <form method="POST">
            <label for="new_password">Nueva Contraseña:</label>
            <input type="password" name="new_password" id="new_password" required>
            <button type="submit">Cambiar Contraseña</button>
        </form>
    </div>
</body>
</html>
