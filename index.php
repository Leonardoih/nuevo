<?php
require_once "conexion/config.php";
require_once "control/CtrlProductos.php";
require_once "carrito.php";

$objp = new CtrlProductos();

?>
<!-- INICIO DOCUMENTO HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" type="image/png" href="imagenes/logo.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sisposw </title>
</head>

<body>

    <?php include "plantilla/cabecera.php"; ?>
    <br>
    <br>

    <!-- Slider Inicio  -->
    <div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="imagenes/slider1.jpg" height="400px" width="1280px" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="imagenes/slider2.jpg" class="d-block w-100" alt="..." height="400px" width="1280px">
                </div>
                <div class="carousel-item">
                    <img src="imagenes/slider3.jpg" class="d-block w-100" alt="..." height="400px" width="1280px">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
        </div>
    </div>
    <!-- Slider fin -->

    <div class="container">
        <br>
        <?php if ($mensaje != "") { ?>
            <!--Mensaje que encontramos en la parte superior-->
            
                <?php echo $mensaje; ?>
            
        <?php } ?>

        <!-- INICIO Area para mostrar los producto -->
        <div class="row">
            <?php
                $listaproductos = $objp->listaProductos();
            ?>

            <?php
            //creamos un ciclo foreach para mostrar la informacion de cada producto
            foreach ($listaproductos as $producto) {
            ?>
                <!-- cantidad de elemtos por fila -->
                <div class="col-3">
                    <div class="card">
                        <!--insertar imagen-->
                        <img title="<?php echo $producto['nombre'] ?>" alt="<?php echo $producto['nombre'] ?>" class="card-img-top" src="<?php echo $producto['imagen'] ?>" height="200px">
                        <!-- cuerpo de la tarjeta  producto -->
                        <div class="card-body">
                            <span><?php echo $producto['nombre'] ?></span>
                            <h5 class="card-title">$<?php echo $producto['precio'] ?></h5>

                            <form action="" method="post">
                                <p class="card-tetx">
                                    <select name="cantidad" id="cantidad">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </p>
                                <?php // encriptar la infromacion de los productos con la funcion openssl_encript se le pasa los datos  a encriptar el medotodo de enciptacion y la llave
                                ?>
                                <input type="hidden" name="id" id="id" value="<?php echo  openssl_encrypt($producto['id_producto'], cod, llave); ?>">
                                <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], cod, llave); ?>">
                                <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], cod, llave); ?>">
                                <button class=" btn btn-primary" type="submit" name="btnAccion" value="Agregar">Agregar al carrito</button>
                            </form>
                        </div>
                    </div>
                    <br>
                </div>
                
                
            <?php } ?>

        </div>

    </div>
    <br>

    <?php include 'plantilla/piepagina.php'; ?>
</body>

</html>