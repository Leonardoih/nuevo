<?php
require_once "../conexion/conexion.php";
require_once "../modelo/Productos.php";


class CtrlVentas extends Conexion
{
    private $conexion;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
    }

    public function crearVenta($productos, $total)
    {
        //crear venta
        $sql = "INSERT INTO ventas(cliente,fecha_venta,total)
                VALUES (1,now(),$total)";

        $insertar = $this->conexion->prepare($sql);

        $respuestainsertar = $insertar->execute();

        //obtner la ultima venta (id_venta)
        $idUltimaVenta =$this->conexion->lastInsertId();
        
        //realizar los insert en el detalle
        foreach($productos as $p){

            $sql = "INSERT INTO det_ventas(venta,producto,cantidad,subtotal)
             VALUES (?,?,?,?)";
            $insertar = $this->conexion->prepare($sql);

            $arreglodatos = array($idUltimaVenta,$p->id, $p->cantidad,$p->subtotal);
            $respuestainsertar = $insertar->execute($arreglodatos);

            $this->actualizarStock($p->id,$p->cantidad);
           
        }


    }

    public function actualizarStock($id,$stockdesc){

        $sql = "SELECT stock FROM productos WHERE id_producto=?";
        
        $dato = array($id);

        $consulta = $this->conexion->prepare($sql);

        $consulta->execute($dato);

        $resp = $consulta->fetch(PDO::FETCH_ASSOC);
        
        $stockactual=0;

        if($resp){
            $stockactual=$resp['stock']; 
        }

        $stockactual -=$stockdesc;

        $sql = "UPDATE productos SET stock=? WHERE id_producto=?";
        $dato = array($stockactual,$id);

        $actualizar = $this->conexion->prepare($sql);

        echo $respuestaactualizar= $actualizar->execute($dato);

    }
}
$CtrlVenta = new CtrlVentas();

session_start();
$carrito = $_SESSION['carrito'];
$total = $_SESSION['total'];

echo $total;

$CtrlVenta->crearVenta($carrito,$total);

echo "OK venta";
//remover carrito de compra
session_destroy();
//remover total


header("location:../index.php");
