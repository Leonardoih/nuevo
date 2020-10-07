<?php
require_once "conexion/config.php";
// require_once "modelo/Productos.php";
require_once "control/CtrlProductos.php";
$ctrlprod = new CtrlProductos();

session_start();

$mensaje = "";
$prod = new Producto();

// añadir productos al carrito
if (isset($_POST['btnAccion'])) {

    switch ($_POST['btnAccion']) {
        case 'Agregar':
            $prod->id = openssl_decrypt($_POST['id'], cod, llave);
            $prod->nombre = openssl_decrypt($_POST['nombre'], cod, llave);
            $prod->precio = openssl_decrypt($_POST['precio'], cod, llave);
            $prod->cantidad = $_POST['cantidad'];
            $prod->subtotal = $prod->precio * $prod->cantidad;

            //$mensaje .= "id ok: " . $prod->id . "nombre ok: " . $prod->nombre . "precio: " . $prod->precio . "cantidad: " . $prod->cantidad . "subtotal: " . $prod->subtotal;

            $sumastock = 0;
            // añadir producto al carrito
            if (isset($_SESSION['carrito'])) {
                $carrito = $_SESSION['carrito'];
                // realizamos una sumatoria de la cantidad de productos 
            } else {
                $carrito = array();
            }

            foreach ($carrito as $p) {
                if ($prod->id == $p->id) {
                    $sumastock += $p->cantidad;
                }
            }

            $sumastock += $prod->cantidad;

            // lo validamos con el stock que tenemos en la base de datos
            // si tiene lo agregamos al carrito en caso contrario mandamos un mensaje de error
            if ($ctrlprod->stock($prod->id, $sumastock)) {
                array_push($carrito,$prod);
                $_SESSION['carrito'] =  $carrito;
                $mensaje = '
                        <div class="alert alert-success">
                             Producto agregado al carrito
                         </div>';
            } else {
                $mensaje = '
                        <div class="alert alert-danger">
                             El producto no tiene stock
                         </div>';
            }


            break;
        case "Eliminar":
            //eliminar producto del carrito
            $indice = $_POST['indice'];

            if (isset($_SESSION['carrito'])) {
                $carrito = $_SESSION['carrito'];

                unset($carrito[$indice]);
                
                $carrito = array_values($carrito);

                $_SESSION['carrito'] = $carrito;

                echo "<script>alert('Producto eliminado')</script>";

                if (count($carrito) == 0) {
                    session_unset($carrito);
                }
            }

            break;
        default:
            # code...
            break;
    }
}
