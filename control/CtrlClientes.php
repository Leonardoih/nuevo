<?php
require_once "conexion/conexion.php";


class CtrlClientes extends Conexion
{

   
    private $strnic_usuario;
    private $strfecha_reg;
    private $strclave;
    private $strestado;
    private $intpersona;
    private $conexion = null;


    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
    }

    public function listaClientes()
    {
        $sql = "SELECT * FROM clientes";
        $ejecutar = $this->conexion->query($sql);
        $respuesta = $ejecutar->fetchall(PDO::FETCH_ASSOC);
        return $respuesta;
    }


    public function insertarCliente(
        
        
        String $nic_usuario,
        String $clave,
        String $persona

       
        
    ) {
        
        $this->strnic_usuario = $nic_usuario;
        $this->strclave = $clave;
        $this->intpersona= $persona;
      
        

        $sql = "INSERT INTO `clientes`(`nick_usuario`, `clave`, `fecha_reg`, `estado`, `persona`)  VALUES  (?,?,now(),1,?)";
        $insertar = $this->conexion->prepare($sql);

        $arreglodatos = array($this->strnic_usuario,
          $this->strclave,  $this->intpersona);

        $respuestainsertar = $insertar->execute($arreglodatos);
        $codigo = $this->conexion->lastInsertId();

        return $codigo;
    }


    public function actualizarCliente(
        int $id,
        String $nic_usuario,
        String $clave,
        String $fecha_resg,
        String $estado,
        String $persona


        
    ) {
        $this->strnic_usuario = $nic_usuario;
        $this->strclave = $clave;
        $this->intpersona= $persona;
        

        $sql = "UPDATE clientes SET nick_usuario=?, clave=?, estado=?, persona=? WHERE id_cliente=$id";
        $actualizar = $this->conexion->prepare($sql);

        $registro = array($this->strnombres, $this->strapellidos, $this->identificacion, $this->strdireccion, $this->celular, $this->strcorreo );
        $ejecutar = $actualizar->execute($registro);
    }

    public function eliminarCliente(String $estado, int $id)
    {
        $sql = "UPDATE clientes SET estado=? WHERE id_cliente=$id";
        $dato = array($id);
        $eliminar = $this->conexion->prepare($sql);
        $borrado  = $eliminar->execute($dato);
        return $borrado;
    }

    public function buscarCliente(String $nick)
    {
        $sql = "SELECT * FROM clientes WHERE nick_usuario=?";
        $dato = array($nick);
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute($dato);
        $respuesta = $consulta->fetch(PDO::FETCH_ASSOC);
        return $respuesta;
    }
}
