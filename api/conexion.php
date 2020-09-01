<?php @session_start();

    $conexion = new mysqli('localhost','root','','snippets');

    if ($conexion->connect_errno) {
        die("No se pudo establecer conexion");
    }
?>
