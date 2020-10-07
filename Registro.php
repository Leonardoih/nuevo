<?php
include "conexion/config.php";
include "carrito.php";
include "plantilla/cabecera.php";
require_once "control/CtrlClientes.php";
require_once "control/Ctrlpersonas.php";

$mensaje = "";

if (
    !empty($_POST['nombres'])
    || !empty($_POST['apellidos'])
    || !empty($_POST['num_doc'])
    || !empty($_POST['correo'])
    || !empty($_POST['telefono'])
    || !empty($_POST['usuario'])
    || !empty($_POST['clave'])
    || !empty($_POST['direccion'])
) {
    $CtrlPersona = new CtrlPersonas();
    $CtrlCliente = new CtrlClientes();

    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $num_doc = $_POST['num_doc'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    // validamos si la persona se encuentra registrada y el cliente no
    $persona = $CtrlPersona->buscarPersona($num_doc, $correo);
    $cliente = $CtrlCliente->buscarCliente($usuario);

    if ($persona) {
        //echo "existe persona <br><br><br>";
        $id_persona = $persona['id_persona'];
        //despues que encontramos la persona validar que no se encuentre registrado
        // el mismo nick de usuario
        if ($cliente) {
            $mensaje = '<div class="alert alert-danger alert-dismissible fade show">
                     <button class="close" type="button" data-dismiss="alert">&times;</button>
                       El nombre de usuario no se encuentra disponible
             </div>';
        } else {
            if ($CtrlCliente->insertarCliente($usuario, $clave, $id_persona)) {
                $mensaje = '<div class="alert alert-success alert-dismissible fade show">
                            <button class="close" type="button" data-dismiss="alert">&times;</button>
                             Registro Exitoso
                        </div>';
            }
        }
    } else 
        if ($cliente) {
        $mensaje = '<div class="alert alert-danger alert-dismissible fade show">
                     <button class="close" type="button" data-dismiss="alert">&times;</button>
                        El Usuario O Identificacion ya se encuentran registrados
                    </div>';
    } else {

        if ($id_persona = $CtrlPersona->insertarPersonas($nombres, $apellidos, $num_doc, $direccion, $celular, $correo)) {
            //echo "persona registrada";
            if ($CtrlCliente->insertarCliente($usuario, $clave, $id_persona)) {
                $mensaje = '<div class="alert alert-success alert-dismissible fade show">
                                <button class="close" type="button" data-dismiss="alert">&times;</button>
                                    Registro Exitoso
                            </div>';
            }
        }
    }
}
?>
<!-- INICIO DOCUMENTO HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registro </title>
</head>

<div class="container">


    <br>
    <form method="post">

        <h2 class="display-4">Registrarse</h2>
        <hr>

        <?php echo $mensaje; ?>

        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label for="nombres">Nombres*</label>
                    <input class="form-control" type="text" name="nombres" id="nombres" required>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input class="form-control" type="text" name="apellidos" id="apellidos">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label for="num_doc">Nro. Documento</label>
                    <input class="form-control" type="text" name="num_doc" id="num_doc" required>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label for="correo">Correo*</label>
                    <input class="form-control" type="email" name="correo" id="correo" required placeholder="tucorreo@jemplo.com">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input class="form-control" type="text" name="celular" id="celular">
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input class="form-control" type="text" name="direccion" id="direccion">
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input class="form-control" type="text" name="usuario" id="usuario">
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label for="clave">Clave*</label>
                    <input class="form-control" type="password" name="clave" id="clave">
                </div>
            </div>

        </div>
        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Registrar">

</div>
</div>
</form>


<?php include 'plantilla/piepagina.php'; ?>