<?php
    include 'bd.php';
    $id = $_POST['id'];
    $sql = "SELECT * FROM inventario WHERE id = '$id'";
    $resultado = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_assoc($resultado);
    $id = $row['id'];
    $nInven = $row['nInven'];
    $codigo = $row['codigo'];
    $denominacion = $row['denominacion'];
    $marca = $row['marca'];
    $modelo = $row['modelo'];
    $tipo = $row['tipo'];
    $color = $row['color'];
    $serie = $row['serie'];
    $estado = $row['estado'];
    $fecha = $row['fecha'];
    $valor = $row['valor'];
    $observacion = $row['observacion'];
    $datos = [
        'id' => $id,
        'nInven' => $nInven,
        'codigo' => $codigo,
        'denominacion' => $denominacion,
        'marca' => $marca,
        'modelo' => $modelo,
        'tipo' => $tipo,
        'color' => $color,
        'serie' => $serie,
        'estado' => $estado,
        'fecha' => $fecha,
        'valor' => $valor,
        'observacion' => $observacion
    ];
    echo json_encode($datos);
?>