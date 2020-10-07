<?php
require_once "conexion/conexion.php";
require_once "modelo/Productos.php";

class CtrlProductos extends Conexion
{
    private $conexion;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
    }

    public function listaProductos()
    {
        $sql = "SELECT * FROM productos";
        $ejecutar = $this->conexion->query($sql);
        $respuesta = $ejecutar->fetchall(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    public function insertarProducto(String $nombre, float $precio, int $categoria, String $imagen, 
    String $marca, int $stock ,int $existencia)
    {
        $producto = new Producto();

        $producto->nombre = $nombre;
        $producto->precio = $precio;
        $producto->categoria = $categoria;
        $producto->imagen = $imagen;
        $producto->marca = $marca;
        $producto->stock = $stock;
        $producto->existencia = $existencia;

        $sql = "INSERT INTO productos(nombre,precio,categoria,imagen,marca,stock,existencia)
         VALUES (?,?,?,?,?,?,?)";
        $insertar = $this->conexion->prepare($sql);

        $arreglodatos = array(
            $producto->nombre, $producto->precio, $producto->categoria, $producto->imagen,
            $producto->marca, $producto->stock , $producto->existencia
        );

        $respuestainsertar = $insertar->execute($arreglodatos);
        $codigo = $this->conexion->lastInsertId();

        return $codigo;
    }

    public function actualizarProducto(
        int $id,
        String $nombre,
        float $precio,
        int $categoria,
        String $imagen,
        String $marca,
        int $stock,
        int $existencia
    ) {
        $producto = new Producto();

        $producto->id = $id;
        $producto->nombre = $nombre;
        $producto->precio = $precio;
        $producto->categoria = $categoria;
        $producto->imagen = $imagen;
        $producto->marca = $marca;
        $producto->stock = $stock;
        $producto->existencia = $existencia;

        $sql = "UPDATE productos SET nombre=?,precio=?,categoria=?,imagen=?,marca=?,stock=?, existencia=? WHERE id_producto=$id";
        $actualizar = $this->conexion->prepare($sql);

        $registro = array(
            $producto->nombre, $producto->precio, $producto->categoria, $producto->imagen,
            $producto->marca, $producto->stock , $producto->existencia
        );
        $ejecutar = $actualizar->execute($registro);
    }

    public function eliminarProducto(int $id)
    {
        $sql = "DELETE FROM productos WHERE id_producto=?";
        $dato = array($id);
        $eliminar = $this->conexion->prepare($sql);
        $borrado  = $eliminar->execute($dato);
        return $borrado;
    }

    public function buscarProducto(int $id)
    {
        $sql = "SELECT * FROM productos WHERE id_producto=?";
        $dato = array($id);
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute($dato);
        $respuesta = $consulta->fetch(PDO::FETCH_ASSOC);
        return $respuesta;
    }

    public function existecia(int $id, int $existencia)
    {
        $sql = "SELECT existencia FROM productos WHERE id_producto=?";

        $dato = array($id);

        $consulta = $this->conexion->prepare($sql);

        $consulta->execute($dato);

        $resp = $consulta->fetch(PDO::FETCH_ASSOC);
        
        $exitencia=0;

        if($resp){
            $existenciaActual=$resp['existencia']; 
        }
        

        // echo "stock1: ".$cantidad;
        // echo "<br> stock actual:";
        // print_r($stockactual);

        if($existenciaActual>=$existencia){
            return true;
        }else{
            return false;
            //echo "no tiene stock ";
        }
        
    }
    public function alertaInvetario(){
        $sql = "SELECT id_producto, nombre, existencia FROM productos WHERE existencia <= stock" ;
        $inventario = array();
        $alerta = $this->conexion->prepare($sql);
        $alerta->execute($inventario);
        $agotados = $alerta->fetchall(PDO::FETCH_ASSOC);
        return $agotados;


            
    }

    

}

// $obj = new CtrlProductos();
// $obj->stock(2,5);
