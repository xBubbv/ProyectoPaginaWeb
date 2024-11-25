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
    <!-- <link rel="stylesheet" href="/css/nosotros.css"> -->
    <link rel="stylesheet" href="main.css">
    <link rel="icon" type="image/svg+xml" href="img/iconos/users-solid.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Nosotros</title>
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
                    <a href="index.php" class="btn btn-primary me-2">Inicio</a>
                    <a href="nosotros.php" class="btn btn-primary">Nosotros</a>
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

    <div class="container-fluid nos py-5">
        <h1 class="text-center py-5">¿Quiénes somos?</h1>
        <div class="row mb-4">
            <div class="col-12 text-center">
                <img src="img/equipo.webp" alt="Equipo">
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card nos-card h-100 shadow-sm text-center">
                    <div class="card-body text-center">
                        <h3 class="card-title">Misión</h3>
                        <p class="descripcion">Nuestra misión es ofrecer un servicio de corretaje inmobiliario confiable y personalizado que facilite a nuestros clientes la compra, venta o arriendo de propiedades de forma segura y eficiente. Nos enfocamos en acompañar a cada cliente en cada etapa del proceso, escuchando sus necesidades y brindando asesoría experta para garantizar que alcancen sus objetivos con confianza y tranquilidad. Priorizamos la excelencia, la transparencia y el compromiso, construyendo relaciones sólidas y de largo plazo con nuestros clientes.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card nos-card h-100 shadow-sm text-center">
                    <div class="card-body text-center">
                        <h3 class="card-title">Visión</h3>
                        <p class="descripcion">Aspiramos a ser reconocidos como un referente en el mercado inmobiliario, destacándonos por nuestro enfoque centrado en el cliente y por una innovación constante en la industria del corretaje de propiedades. Nos esforzamos por ofrecer soluciones inmobiliarias que superen las expectativas de nuestros clientes, contribuyendo al desarrollo de un mercado inmobiliario más accesible, seguro y profesional. Buscamos no solo ser una empresa de corretaje, sino un aliado estratégico para quienes desean realizar una inversión inmobiliaria.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card nos-card h-100 shadow-sm text-center">
                    <div class="card-body text-center">
                        <h3 class="card-title">Valores</h3>
                        <p class="descripcion">Nuestros valores fundamentales son la transparencia, el profesionalismo, la innovación, la empatía y el compromiso con la comunidad. Creemos firmemente en la importancia de la honestidad y la claridad en cada operación, asegurándonos de que nuestros clientes estén informados y seguros en cada paso del proceso. Nos dedicamos a ofrecer un servicio de alta calidad a través de agentes capacitados y comprometidos, priorizando siempre las necesidades de nuestros clientes. Nos mantenemos en la vanguardia tecnológica, optimizando nuestros procesos para mejorar la experiencia del cliente. Además, buscamos entender y responder a los deseos y expectativas de quienes confían en nosotros, creando relaciones de confianza a largo plazo. Finalmente, nos comprometemos con el bienestar de las comunidades en las que operamos, promoviendo un desarrollo inmobiliario responsable y sostenible.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid nos py-5">
        <h1 class="text-center p-3">Nuestras oficinas</h1>
        <div class="d-flex justify-content-center">
            <div class="d-flex flex-wrap justify-content-center">
                <div class="col-md-4 m-3 d-flex align-items-stretch">
                    <div class="card text-center">
                        <img src="img/portal.jpg" alt="La Chimba" class="img-fluid p-3" style="height: 250px; object-fit: cover;">
                        <h3 class="text-center p-3">Sucursal La Chimba</h3>
                        <p class="text-center">Av. Cancha Rayada 419 Oficina 302 Copiapó - Atacama</p>
                    </div>
                </div>
                <div class="col-md-4 m-3 d-flex align-items-stretch">
                    <div class="card text-center">
                        <img src="img/mall.jpg" alt="Mall" class="img-fluid p-3" style="height: 250px; object-fit: cover;">
                        <h3 class="text-center p-3">Sucursal Mall Plaza Real</h3>
                        <p class="text-center">Colipi 484 Oficina 212 Copiapó - Atacama</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid nos py-5">
        <h2 class="text-center mb-4">¿Tienes alguna duda? ¡Contáctanos!</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nombre">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Teléfono">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="4" placeholder="Mensaje"></textarea>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-20 align">Enviar</button>
                    </div>
                </form>
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