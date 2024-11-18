<?php 
    include("conexion.php");

    $id = $_GET['id'];

    $sql = "SELECT * FROM usuarios WHERE id='$id'";
    $query = mysqli_query($conexion,$sql);

    $row = mysqli_fetch_array($query);
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
        <h1>Actualizar datos:</h1>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <input type="text" class="form-control mb-3" name="name" placeholder="Nombre" value="<?php echo $row['name'] ?>">
            <input type="text" class="form-control mb-3" name="lastname" placeholder="Apellidos" value="<?php echo $row['lastname'] ?>">
            <input type="email" class="form-control mb-3" name="email" placeholder="Email" value="<?php echo $row['email'] ?>">
            <input type="text" class="form-control mb-3" name="user" placeholder="Usuario" value="<?php echo $row['user'] ?>">
            <input type="password" class="form-control mb-3" name="password" placeholder="Contraseña" value="<?php echo $row['password'] ?>">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>