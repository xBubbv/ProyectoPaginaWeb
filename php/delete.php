<?php
    include("conexion.php");

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];

        $sql = "DELETE FROM usuarios WHERE id = '$userId'";

        if (mysqli_query($conexion, $sql)) {
            header("Location: panel-de-control.php?success=Usuario eliminado correctamente");
            exit();
        } else {
            header("Location: panel-de-control.php?error=Error al eliminar el usuario");
            exit();
        }
    } else {
        header("Location: panel-de-control.php?error=ID de usuario no proporcionado");
        exit();
    }
?>
