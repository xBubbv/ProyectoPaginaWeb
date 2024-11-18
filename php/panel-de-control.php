<?php 
    include("conexion.php");

    $sql="SELECT * FROM usuarios";

    $query=mysqli_query($conexion,$sql);

    #$row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f4a108002a.js" crossorigin="anonymous"></script>
    <title>Panel de control</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <h1>Ingrese datos:</h1>
                <form action="create.php" method="POST">
                    <input type="text" class="form-control mb-3" name="name" placeholder="Nombre">
                    <input type="text" class="form-control mb-3" name="lastname" placeholder="Apellidos">
                    <input type="email" class="form-control mb-3" name="email" placeholder="Email">
                    <input type="text" class="form-control mb-3" name="user" placeholder="Usuario">
                    <input type="password" class="form-control mb-3" name="password" placeholder="Contraseña">

                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </form>
            </div>
            <div class="col-md-8">
                <table class="table">
                    <thead class="table-success table-striped">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row=mysqli_fetch_array($query)){
                        ?>
                            <tr>
                                <th><?php  echo $row['id']?></th>
                                <th><?php  echo $row['name']?></th>
                                <th><?php  echo $row['lastname']?></th>
                                <th><?php  echo $row['email']?></th>
                                <th><?php  echo $row['user']?></th>
                                <th><?php  echo $row['password']?></th>
                                <th><a href="editar.php?id=<?php echo $row['id'] ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a></th>
                                <th><a href="#" class="btn btn-small btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-trash"></i></a></th>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a id="confirmDeleteBtn" class="btn btn-danger" href="#">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
    <script>
        // Obtener el botón de eliminación del modal y los enlaces de eliminar
        var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        var modalDeleteBtns = document.querySelectorAll('a[data-bs-target="#confirmModal"]'); // Seleccionamos todos los enlaces que abren el modal

        // Agregar el evento de clic en cada enlace de eliminar
        modalDeleteBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var userId = this.getAttribute('data-id');  // Obtener el ID del usuario
                confirmDeleteBtn.setAttribute('href', 'delete.php?id=' + userId);  // Actualizar el enlace con el ID correcto
            });
        });
    </script>

</body>
</html>