
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Agregar Usuario</title>
</head>
<body>
    
    <div class="container mt-5">
        <h1>Agregar un nuevo usuario</h1>
        <form action="create.php" method="POST">
            <input type="text" class="form-control mb-3" name="name" placeholder="Nombre">
            <input type="text" class="form-control mb-3" name="lastname" placeholder="Apellidos">
            <input type="email" class="form-control mb-3" name="email" placeholder="Email">
            <input type="text" class="form-control mb-3" name="user" placeholder="Usuario">
            <input type="password" class="form-control mb-3" name="password" placeholder="Contraseña">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>
</html>
