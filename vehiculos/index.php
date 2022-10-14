<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: GET,POST");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	include_once("../conexion/Conexion.php");
	$con=new Conexion();

	if(isset($_GET['consultar'])){
		$sql="SELECT *from tipo_vehiculo";
		$stament=$con->getConexion()->query($sql);
		$resultado=$stament->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($resultado);
	}

	if(isset($_GET['vehiculos'])){
		$codigo=$_GET['vehiculos'];
		$sql="SELECT *from tipo_vehiculo join vehiculo using(id_tipo) where cedula='$codigo'";
		$stament=$con->getConexion()->query($sql);
		$resultado=$stament->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($resultado);
	}

?>