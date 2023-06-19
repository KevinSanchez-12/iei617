<?php
    include 'bd.php';
    $nInven = $_POST['nInven'];
    $codigo = $_POST['codigo'];
    $denominacion = $_POST['denominacion'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $tipo = $_POST['tipo'];
    $color = $_POST['color'];
    $serie = $_POST['serie'];
    $estado = $_POST['estado'];
    $fecha = $_POST['fecha'];
    $valor = $_POST['valor'];
    $observacion = $_POST['observacion'];
    $query = "INSERT INTO inventario (nInven, codigo, denominacion, marca, modelo, tipo, color, serie, estado, fecha, valor, observacion) VALUES ('$nInven', '$codigo', '$denominacion', '$marca', '$modelo', '$tipo', '$color', '$serie', '$estado', '$fecha', '$valor', '$observacion')";
    $result = mysqli_query($conexion, $query);
    $datos = [
        'success' => true,
        'message' => 'Registro agregado',
    ];
    echo json_encode($datos);
?>