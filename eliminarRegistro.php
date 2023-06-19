<?php
    include 'bd.php';
    $id = $_POST['id'];
    $sql = "DELETE FROM inventario WHERE id = '$id'";
    $resultado = mysqli_query($conexion, $sql);
    $datos = [
        'message' => 'Registro eliminado'
    ];
    echo json_encode($datos);
?>