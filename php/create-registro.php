<?php
    include("conexion.php");

    // Inicialización de variables
    $name = $lastname = $email = $user = $password = "";
    $error_message = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $user = $_POST['user'];
        $password = $_POST['password'];

        $check_email_sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $check_email_query = mysqli_query($conexion, $check_email_sql);
        if (mysqli_num_rows($check_email_query) > 0) {
            header("Location: http://localhost/ProyectoPaginaWeb/php/panel-de-control.php?error=El correo electrónico ya está registrado");
            exit();
        } else {
            $sql = "INSERT INTO usuarios (name, lastname, email, user, password) VALUES ('$name', '$lastname', '$email', '$user', '$password')";

            if (mysqli_query($conexion, $sql)) {
                header("Location: http://localhost/ProyectoPaginaWeb/php/panel-de-control.php?success=Usuario registrado exitosamente!");
                exit();
            } else {
                header("Location: http://localhost/ProyectoPaginaWeb/php/panel-de-control.php?error=Error al registrar el usuario");
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Formulario de Registro</title>
</head>
<body>
<div class="container formu">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_GET['success']; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_GET['error']; ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST" class="d-flex flex-column align-items-center g-3">
            <h1 class="m-3">Ingrese nuevo registro:</h1>
            <div class="col-md-6 mb-3">
                <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" value="<?php echo $name; ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Apellidos" value="<?php echo $lastname; ?>"  required>
            </div>
            <div class="col-md-6 mb-3">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>"  required>
            </div>
            <div class="col-md-6 mb-3">
                <input type="text" id="user" name="user" class="form-control" placeholder="Usuario" value="<?php echo $user; ?>"  required>
            </div>
            <div class="col-md-6 mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" value="<?php echo $password; ?>" required>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
</body>
</html>
