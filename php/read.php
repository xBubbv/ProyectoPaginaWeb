<?php
    include("conexion.php");

    // Obtener el término de búsqueda
    $search = isset($_POST['search']) ? $_POST['search'] : '';

    // Modificar la consulta para incluir la búsqueda por nombre
    if ($search) {
        // Ajusta el campo de búsqueda según lo que tengas en tu base de datos
        $sql = "SELECT * FROM usuarios WHERE name LIKE '%$search%'";  // Asegúrate de que 'name' sea el nombre de la columna en tu base de datos
    } else {
        $sql = "SELECT * FROM usuarios";  // Si no hay búsqueda, mostrar todos los usuarios
    }

    // Ejecutar la consulta
    $query = mysqli_query($conexion, $sql);

    // Verificar si hay resultados
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_array($query)) {
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
    } else {
        echo "<tr><td colspan='7'>No se encontraron resultados</td></tr>";
    }
?>
