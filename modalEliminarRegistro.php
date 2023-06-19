<?php
    include 'bd.php';
    $id = $_POST['id'];
    $sql = "SELECT * FROM inventario WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_assoc($resultado);
    $nInven = $row['nInven'];
    $datos = [
        'id' => $id,
        'nInven' => $nInven
    ];
    echo json_encode($datos);
?>