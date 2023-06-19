<?php
    include 'bd.php';
    $id = $_POST['id'];
    $sql = "UPDATE inventario SET nInven = '$_POST[nInven]', codigo = '$_POST[codigo]', denominacion = '$_POST[denominacion]', marca = '$_POST[marca]', modelo = '$_POST[modelo]', tipo = '$_POST[tipo]', color = '$_POST[color]', serie = '$_POST[serie]', estado = '$_POST[estado]', fecha = '$_POST[fecha]', valor = '$_POST[valor]', observacion = '$_POST[observacion]' WHERE id = '$id'"; 
    $resultado = mysqli_query($conexion, $sql);
    $datos = [
        'success' => true,
        'message' => 'Registro actualizado',
    ];
    echo json_encode($datos);
?>