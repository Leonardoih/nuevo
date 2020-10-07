<?php

include "carrito.php";

?>

<!-- INICIO DOCUMENTO HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
</head>

<body>
    <?php include "plantilla/cabecera.php"; ?>

    <div class="container">
        <br>
        <br>
        <div class="row  justify-content-center align-items-center minh-100">
            <div class="col-md-12 text-center">
                <h1>Iniciar sesion</h1>
            </div>
        </div>

        <form method="POST">

            <div class="row  justify-content-center align-items-center">
                <div class="form-group col-md-6 ">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" name="usuario" col-md-offset-5 placeholder="Ingrese su Usuario o Correo">
                </div>
            </div>
            <div class="row  justify-content-center align-items-center">
                <div class="form-group col-md-6">
                    <label for="clave">Contraseña</label>
                    <input type="password" class="form-control" name="clave" placeholder="ingrese su contraseña">
                </div>
            </div>
            <div class="row  justify-content-center align-items-center">
                <div class="form-group text-center col-md-6">
                    <a href="Registro.php">Registrarse</a>
                </div>
            </div>
            <div class="row  justify-content-center align-items-center">
                <div class="col-md-6">
                    <input type="submit" class="form-control btn btn-primary btn-lg btn-block" value="Ingresar">
                </div>
            </div>
    </div>
    </form>



    <?php include 'plantilla/piepagina.php'; ?>
</body>

</html>