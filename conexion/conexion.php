<?php 
	
	class Conexion {
		
		private $servidor = 'localhost';
		private $usuario = 'root';
		private $clave = '';
		private $base_datos = 'indesing_sisposw_v3';
		private $conectar;


		public function __construct() {
			$cadenaconexion = "mysql:hos=".$this->servidor.";dbname=".$this->base_datos.";charset=utf8";

			try {

			$this->conectar = new PDO($cadenaconexion,$this->usuario,$this->clave);

			$this->conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				//  echo "<script>alert('Conexion Exitosa')</script>";
				
			} catch (PDOException $error) {
				
				// echo "<script>alert('Error de conexion')</script>".$error->getMessage();
				
			}

		} 

		public function conectar(){
			return $this->conectar;
		} 

	}

	// $cone = new Conexion();
?>