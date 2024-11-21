<?php
    include("conexion.php");

    
    $search = isset($_POST['search']) ? $_POST['search'] : '';

    
    if ($search) {
        
        $sql = "SELECT * FROM usuarios WHERE name LIKE '%$search%'";  
    } else {
        $sql = "SELECT * FROM usuarios"; 
    }

   
    $query = mysqli_query($conexion, $sql);

   
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
