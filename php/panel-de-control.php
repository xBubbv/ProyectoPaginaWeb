<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f4a108002a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Panel de control</title>
    
</head>
<body>
    <a href="insertar-registro.php" class="btn btn-info me-2 m-4">Ingresar registro</a>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 search-container">
                <h1>Buscar por nombre:</h1>
                <form id="searchForm" class="d-flex justify-content-center">
                    <input type="text" id="searchInput" name="search" class="form-control w-50" placeholder="Buscar por nombre">
                    <button type="submit" class="btn btn-primary mt-3 ms-2">Buscar</button>
                    <button type="button" id="refreshBtn" class="btn btn-secondary mt-3 ms-2">Refrescar</button>
                </form>
            </div>
        </div>
        <div class="row table-container">
            <div class="col-md-12">
                <h1>Registros de usuarios:</h1>
                <table class="table table-bordered table-striped">
                    <thead class="table-success">
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
                    <tbody id="resultTable">
                        <?php
                            include("conexion.php");

                            $sql = "SELECT * FROM usuarios";
                            $query = mysqli_query($conexion, $sql);

                            while($row=mysqli_fetch_array($query)){
                                echo "<tr>";
                                echo "<th>" . $row['id'] . "</th>";
                                echo "<th>" . $row['name'] . "</th>";
                                echo "<th>" . $row['lastname'] . "</th>";
                                echo "<th>" . $row['email'] . "</th>";
                                echo "<th>" . $row['user'] . "</th>";
                                echo "<th>" . $row['password'] . "</th>";
                                echo "<th><a href='editar.php?id=" . $row['id'] . "' class='btn btn-small btn-warning'><i class='fa-solid fa-pen-to-square'></i></a></th>";
                                echo "<th><a href='#' class='btn btn-small btn-danger' data-bs-toggle='modal' data-bs-target='#confirmModal' data-id='" . $row['id'] . "'><i class='fa-solid fa-trash'></i></a></th>";
                                echo "</tr>";
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
    $(document).ready(function() {
        $('#searchForm').submit(function(event) {
            event.preventDefault();
            var search = $('#searchInput').val();

            $.ajax({
                url: 'read.php',
                method: 'POST',
                data: { search: search },
                success: function(response) {
                    $('#resultTable').html(response);
                }
            });
        });

        $('#refreshBtn').click(function() {
            location.reload();
        });

        $('a[data-bs-target="#confirmModal"]').on('click', function() {
            var userId = $(this).data('id');
            $('#confirmDeleteBtn').attr('href', 'delete.php?id=' + userId);
        });
    });
</script>

</body>
</html>
