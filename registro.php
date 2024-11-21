<?php
    include("php/conexion.php");
    
    $name = $lastname = $email = $user = $password = "";
    $error_message = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $user = $_POST['user'];
        $password = $_POST['password'];

        #$hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $check_email_sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $check_email_query = mysqli_query($conexion, $check_email_sql);

        if (mysqli_num_rows($check_email_query) > 0){
            header("Location: http://localhost/ProyectoPaginaWeb/registro.php?error=El correo electrónico ya está registrado");
            exit();
        }

        $sql = "INSERT INTO usuarios (name, lastname, email, user, password) VALUES ('$name', '$lastname', '$email', '$user', '$password')";

        if (mysqli_query($conexion, $sql)){
            header("Location: registro.php?success=Usuario agregado exitosamente!");
            exit();
        } else {
            header("Location: registro.php?error=Error al agregar usuario");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Registro</title>
</head>
<body>
    <div class="container-fluid" >
        <div class="row" id="header-row">
            <div class="col">
                <a href="http://localhost/ProyectoPaginaWeb/index.php"><img src="img/logo.png" alt="Logo empresa" id="logo"></a>
            </div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col">
                <p>Contáctanos! <br> +56911223344 | +56955667788</p>
            </div>
        </div>
    </div>
    
    <nav class="navbar sticky-top">
        <div class="container-fluid">
            <div class="row w-100 justify-content-between align-items-center">
                <div class="col-md-6 d-flex justify-content-start">
                    <a href="http://localhost/ProyectoPaginaWeb/index.php" class="btn btn-primary me-2">Inicio</a>
                    <a href="nosotros.html" class="btn btn-primary">Nosotros</a>
                </div>
            </div>
        </div>
    </nav>
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/carousel1.jpg" class="d-block w-100" alt="Imagen 1">
          </div>
          <div class="carousel-item">
            <img src="img/carousel2.jpg" class="d-block w-100" alt="Imagen 2">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

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
        <div class="row titulo">
            <h1>Registro</h1>
        </div>
        <form action="" method="POST" class="d-flex flex-column align-items-center g-3">
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
    

    <footer class="container-fluid cf">
        <div class="row">
            <div class="col">
                <h1>Contacto</h1>
                <p>alvarezyvaraspropiedades@gmail.com</p>
                <p>+56 9 11223344</p>
            </div>
            <div class="col">
                <h1>Servicios</h1>
                <p><a href="#" >Confienos su propiedad</a></p>
                <p><a href="#" >Servicios adicionales</a></p>
                <p><a href="#" >Trabaje con nosotros</a></p>
            </div>
            <div class="col">
                <h1>Propiedades</h1>
                <p><a href="#" >Casas</a></p>
                <p><a href="#" >Departamentos</a></p>
                <p><a href="#" >Terrenos</a></p>
            </div>
            <div class="col">
                <p><a href="https://web.whatsapp.com/"><img src="./img/ico-whatsapp.png" alt="Whatsapp"></a></p>
                <p><a href="https://www.facebook.com/"><img src="./img/ico-facebook.png" alt="Facebook"></a></p>
                <p><a href="https://www.instagram.com/accounts/login/"><img src="./img/ico-instagram.png" alt="Instagram"></a></p>
            </div>
        </div>
    </footer>

    <div class="container-fluid marca">
        <p >&copy; 2024 Diego Vargas</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <div id="message-container"></div>

    <script>
        // Función para obtener los parámetros de la URL
        function getUrlParameter(name) {
            var url = new URL(window.location.href);
            var paramValue = url.searchParams.get(name);
            return paramValue;
        }

        // Mostrar el mensaje de éxito o error si existe en la URL
        var successMessage = getUrlParameter('success');
        var errorMessage = getUrlParameter('error');

        if (successMessage) {
            document.getElementById('message-container').innerHTML = '<div style="color: green;">' + successMessage + '</div>';
        } else if (errorMessage) {
            document.getElementById('message-container').innerHTML = '<div style="color: red;">' + errorMessage + '</div>';
        }
    </script>
</body>
</html>