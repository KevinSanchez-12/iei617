<?php
    include 'bd.php';
    $administrador = 'SELECT * FROM administrador';
    $resultado = mysqli_query($conexion, $administrador);
    while ($row = mysqli_fetch_assoc($resultado)) {
        $correo = $row['correo'];
        $password = $row['password'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'components/head.php';?>
<body>
<section class="login">
        <img class="fondo" src="assets/img/fondoLogin.png">
        <div class="form">
            <div class="content">
                <h1>Iniciar Sesión</h1>
                <div class="input-group mb-3">
                    <span class="input-group-text">Correo</span>
                    <input onkeyup="return validarCamposParaLogueo()" id="correo" name="correo" type="text" class="form-control" placeholder="Escriba aquí">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Contraseña</span>
                    <input onkeyup="return validarCamposParaLogueo()" id="password" name="password" type="password" class="form-control" placeholder="Escriba aquí">
                    <i id="eye" style="cursor:pointer; margin:auto; padding:10px" onclick="verContrasena()" class='input-group-text fa fa-eye'></i>
                </div>
                <button id="boton" disabled onclick="login('<?php echo $correo; ?>','<?php echo $password; ?>')" type="button" class="btn btn-success">Ingresar</button>
            </div>
        </div>
    </section>
    <script src="assets/js/login.js?1.4"></script>
</body>
</html>