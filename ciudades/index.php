<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: GET,POST");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	include_once("../conexion/Conexion.php");
	$con=new Conexion();

	if(isset($_GET['consultar'])){
		$sql="SELECT *from ciudad;";
		$stament=$con->getConexion()->query($sql);
		$resultado=$stament->fetchall(PDO::FETCH_ASSOC);
		echo json_encode($resultado);
	}
?>