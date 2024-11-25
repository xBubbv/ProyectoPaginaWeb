<?php
    session_start();
    $is_logged_in = isset($_SESSION['username']);
?>

<?php
    // Determinar el mensaje según el parámetro 'status' en la URL
    $message = '';
    if (isset($_GET['status'])) {
        if ($_GET['status'] === 'success') {
            $message = "¡Tu contraseña ha sido actualizada exitosamente!";
        } elseif ($_GET['status'] === 'error') {
            $message = "Hubo un error al actualizar tu contraseña. Inténtalo nuevamente.";
        } elseif ($_GET['status'] === 'error_correo') {
            $message = "Correo no registrado en la base de datos.";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="/css/index.css"> -->
    <link rel="stylesheet" href="main.css">
    <link rel="icon" type="image/svg+xml" href="img/iconos/house-solid.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Inicio</title>
</head>
<body>
    <div class="container-fluid" >
        <div class="row" id="header-row">
            <div class="col">
                <a href="index.php"><img src="img/logo.png" alt="Logo empresa" id="logo"></a>
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
                    <a href="index.php" class="btn btn-primary me-2">Inicio</a>
                    <a href="nosotros.html" class="btn btn-primary">Nosotros</a>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <?php if ($is_logged_in): ?>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                                <li><a class="dropdown-item" href="php/logout.php">Cerrar sesión</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Login
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Login</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="php/login.php" method="POST" class="row g-3 m-3">
                    <div class="row mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" name="user" id="user" class="form-control" placeholder="Ingrese su usuario" required>
                        </div> 
                    </div>
                    <div class="row mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese su contraseña" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <input type="submit" value="Entrar" class="btn btn-primary w-10">
                        </div>
                    </div>
                    <div class="col-12 text-center mt-3">
                        <p>¿Olvidaste tu contraseña?
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#recoverModal">
                                Recuperar
                            </button>
                        </p>
                        <hr>
                        <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="recoverModal" tabindex="-1" aria-labelledby="recoverModalLabel" aria-hidden="true">

        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Recuperar contraseña:</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="php/recovery.php" method="POST" class="row g-3 m-3">
                    <div class="row mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese su email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <input type="submit" value="Enviar" class="btn btn-primary w-10">
                        </div>
                    </div>
                    
                </form>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Recuperación de Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $message; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>


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

    <div class="container buscador-prop">
        <h2 class="text-center mb-4">Busca tu propiedad</h2>
        <form action="#" class="row form-prop">
            <div class="col">
                <label for="sector" class="form-label">Sector</label>
                <input type="text" name="sector" id="sector" class="form-control" placeholder="Ingrese sector">
            </div>
            <div class="col">
                <label for="servicio" class="form-label">Servicio</label>
                <input type="text" name="servicio" id="servicio" class="form-control" placeholder="Ingrese servicio">
            </div>
            <div class="col" id="sbmt">
                <button type="submit" class="btn btn-primary" id="btn-buscar">Buscar</button>
            </div>
        </form>
    </div>

    <div class="container-fluid propiedades">
        <div class="row rec"><h1>Recomendaciones</h1></div>
        <div class="row">
            <div class="col card">
                <img src="img/casa1.jpg" alt="">
                <div class="card-body">
                    <p class="card-text">
                        <h3>Casa Chamonate</h3>
                        <ul>
                            <li>3 habitaciones</li>
                            <li>2 baños</li>
                            <li>2 vehiculos</li>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="col card">
                <img src="img/casa2.jpeg" alt="">
                <div class="card-body">
                    <p class="card-text">
                        <h3>Casa Tierra Viva</h3>
                        <ul class="prop-caract">
                            <li>4 habitaciones</li>
                            <li>3 baños</li>
                            <li>6 vehiculos</li>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="col card">
                <img src="img/casa3.jpg" alt="">
                <div class="card-body">
                    <p class="card-text">
                        <h3>Casa Centro</h3>
                        <ul>
                            <li>6 habitaciones</li>
                            <li>5 baños</li>
                            <li>3 vehiculos</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col card">
                <img src="img/casa4.jpg" alt="">
                <div class="card-body">
                    <p class="card-text">
                        <h3>Casa Copayapu</h3>
                        <ul>
                            <li>3 habitaciones</li>
                            <li>3 baños</li>
                            <li>2 vehiculos</li>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="col card">
                <img src="img/casa5.jpg" alt="">
                <div class="card-body">
                    <p class="card-text">
                        <h3>Casa Los Carrera</h3>
                        <ul class="prop-caract">
                            <li>5 habitaciones</li>
                            <li>3 baños</li>
                            <li>3 vehiculos</li>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="col card">
                <img src="img/casa6.jpg" alt="">
                <div class="card-body">
                    <p class="card-text">
                        <h3>Casa Juan Martinez</h3>
                        <ul>
                            <li>4 habitaciones</li>
                            <li>3 baños</li>
                            <li>6 vehiculos</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
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
    <script>
        const statusMessage = "<?php echo $message; ?>";
        if (statusMessage) {
            const statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
            statusModal.show();

            const modalElement = document.getElementById('statusModal');
            modalElement.addEventListener('hidden.bs.modal', () => {
                // Eliminar el parámetro 'status' de la URL
                const url = new URL(window.location.href);
                url.searchParams.delete('status');
                window.history.replaceState({}, document.title, url);
            });
        }
    </script>
</body>
</html>