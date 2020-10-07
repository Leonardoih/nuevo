<?php
include "conexion/config.php";
include "carrito.php";
?>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Lista Carrito </title>
</head>

<body>
    <?php include "plantilla/cabecera.php"; ?>
    <br>
    <br>
    <div class="container">

        <h3>Lista Carrito</h3>
        <?php if (!empty($_SESSION['carrito'])) {
            $carrito = $_SESSION['carrito'];
        ?>
            <table class="table table-light table-bordered">
                <tbody>
                    <tr>
                        <th width="40%">Nombre</th>
                        <th width="15%" class="text-center">Cantidad</th>
                        <th width="20%" class="text-center">Precio Unitario</th>
                        <th width="20%" class="text-center">SubTotal</th>
                        <th width="5%">Accion</th>
                    </tr>
                    <?php $total = 0;
                    $i = 0;
                    foreach ($carrito as $producto) { ?>
                        <tr>
                            <td width="40%"><?php echo $producto->nombre ?></td>
                            <td width="15%" class="text-center"><?php echo $producto->cantidad ?></td>
                            <td width="20%" class="text-center"><?php echo $producto->precio ?></td>
                            <td width="20%" class="text-center"><?php echo  number_format($producto->subtotal, 2); ?></td>
                            <td width="5%">
                                <form action="" method="POST">
                                    <input type="hidden" name="indice" value="<?php echo $i ?>">
                                    <button class=" btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
                                    <!-- <a class="btn btn-danger" name="btnAccion" value="Eliminar" href="carrito.php?in=<?php// echo $i ?>">Eliminar</a> -->
                                </form>
                            </td>
                        </tr>
                    <?php
                        $total += $producto->subtotal;
                        $i++;
                    } ?>
                    <tr>
                        <td colspan="3" align="right">
                            <h3>Total</h3>
                        </td>
                        <td align="center">
                            <h3>
                                $<?php echo number_format($total, 2);
                                    $_SESSION['total'] = $total;
                                ?>
                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" align="center">
                            <form action="control/CtrlVentas.php" method="POST">
                                <div class="row  justify-content-center align-items-center">
                                    <div class="col-md-12">
                                        <input type="submit" class="form-control btn btn-primary btn-lg btn-block" value="Procesar Pago">
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-success">
                No hay productos en el carrito
            </div>
        <?php }
        include 'plantilla/piepagina.php'; ?>
    </div>
</body>

</html>