<?php
	
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: GET,POST");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	include_once("../conexion/Conexion.php");
	$con=new Conexion();
	
	if(isset($_GET["verificar"])){
		$datos=json_decode(file_get_contents("php://input"));
		$usuario=$datos->usuario;
		$contrasena=$datos->contrasena;
		$arrayDatos=array($usuario,$contrasena);
		$sql="SELECT *from users where usuario=? and contrasena=?;";
		$stament=$con->getConexion()->prepare($sql);
		$stament->execute($arrayDatos);
		$resultado=$stament->fetch(PDO::FETCH_ASSOC);
		//if(count($resultado)>0){
			echo json_encode($resultado);
		//}else{
			//echo json_encode(["success"=>0]);
		//}
		
		
	}

	/*$sql="SELECT *from users";
	$stament=$con->getConexion()->query($sql);
	$resultado=$stament->fetchall(PDO::FETCH_ASSOC);
	if(count($resultado)>0){
		echo json_encode($resultado);
	}else{
		echo json_encode(["success"=>0]);
	}
	*/
?>