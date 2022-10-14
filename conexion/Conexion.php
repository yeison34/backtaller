<?php

	class Conexion{
		private $servidor="localhost";
		private $basedatos="taller";
		private $contrasena="3424";
		private $usuario="postgres";
		private $conexion;
		public function __construct(){
			try{
				$this->conexion=new PDO("pgsql:host=".$this->servidor.";dbname=".$this->basedatos.";user=".$this->usuario. ";password=".$this->contrasena);
				//echo "conexion exitosa";
			}catch(Exception $e){
				//echo "no se pudo conectar";
			}
		}

		public function getConexion(){
			return $this->conexion;
		}
	}	
?>
