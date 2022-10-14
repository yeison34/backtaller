<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: GET,POST");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	include_once("../conexion/Conexion.php");
	$con=new Conexion();

	if(isset($_GET['consultar'])){
		$sql="SELECT *from cliente join ciudad using(id_ciudad);";
		$stament=$con->getConexion()->query($sql);
		$resultado=$stament->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($resultado);
	}

	if(isset($_GET['insertar'])){
		$datos=json_decode(file_get_contents("php://input"));
		$cedula=$datos->cedula;
		$nombre=$datos->nombre;
		$apellido=$datos->apellido;
		$fecha=$datos->fecha;
		$direccion=$datos->direccion;
		$telefono=$datos->telefono;
		$cod_ciudad=$datos->id_ciudad;
		$email=$datos->email;
		
		$datos1=array($cedula,$nombre,$apellido,$telefono,$email,$direccion,$cod_ciudad,$fecha);
		$sql="INSERT into cliente values(?,?,?,?,?,?,?,?);";
		$stament=$con->getConexion()->prepare($sql);
		$stament->execute($datos1);
		echo json_encode(["success"=>1]);
	}

	if(isset($_GET['vehiculo'])){
		$datos=json_decode(file_get_contents("php://input"));
		$codigo=$datos->id;
		$placa=$datos->placa;
		$marca=$datos->marca;
		$modelo=$datos->modelo;
		$color=$datos->color;
		$cod_ciudad=$datos->id_ciudad;
		$tipo=$datos->id_tipo;
		
		$datos1=array($placa,$modelo,$marca,$color,$codigo,$cod_ciudad,$tipo);
		$sql="INSERT into vehiculo values(?,?,?,?,?,?,?);";
		$stament=$con->getConexion()->prepare($sql);
		$stament->execute($datos1);
		echo json_encode(["success"=>1]);
	}
	
?>