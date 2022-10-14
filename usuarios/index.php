<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: GET,POST");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	include_once("../conexion/Conexion.php");
	$con=new Conexion();

	if(isset($_GET['insertar'])){
		$datos=json_decode(file_get_contents("php://input"));
		$cedula=$datos->cedula;
		$nombre=$datos->nombre;
		$apellido=$datos->apellido;
		$fecha=$datos->fecha;
		$direccion=$datos->direccion;
		$telefono=$datos->telefono;
		$cod_ciudad=$datos->ciudad;
		$usuario=$datos->usuario;
		$contrasena=$datos->contrasena;
		$datos1=array($nombre,$apellido,$cedula,$direccion,$fecha,$telefono,$cod_ciudad);
		$sql1="INSERT into usuario values(nextval('usuario_id_usuario'::regclass),?,?,?,?,?,?,?);";
		$stament1=$con->getConexion()->prepare($sql1);
		$stament1->execute($datos1);
		$tipo="usuario";
		$sql2="INSERT into users values(?,?,?,?);";
		$datos2=array($cedula,$usuario,$contrasena,$tipo);
		$stament2=$con->getConexion()->prepare($sql2);
		$stament2->execute($datos2);
		echo json_encode(["success"=>1]);
		//insertUsuario($cedula,$usuario,$contrasena);
	}

	if(isset($_GET['ciudad'])){
		$codigo=$_GET['ciudad'];
		$sql="SELECT *from ciudad where nombre='$codigo'";
		//$datos=array($codigo);
		$stament=$con->getConexion()->query($sql);
		//$stament->execute($datos);
		$resultado=$stament->fetch(PDO::FETCH_ASSOC);
		echo $resultado['id_ciudad'];
	}

	if(isset($_GET['consultar'])){
		$sql="SELECT *from usuario join ciudad using(id_ciudad);";
		$stament=$con->getConexion()->query($sql);
		if($stament){
			$resultado=$stament->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode($resultado);
		}else{
			echo json_encode(["success"=>0]);
		}
		
	}


	if(isset($_GET['eliminar'])){
		$id=$_GET['eliminar'];
		$sql="DELETE from usuario where id_usuario=?;";
		$datos=array($id);
		$stament=$con->getConexion()->prepare($sql);
		$stament->execute($datos);
		echo json_encode(['success'=>1]);
	}

	if(isset($_GET['editar'])){
		$datos=json_decode(file_get_contents("php://input"));
		$codigo=$datos->id_usuario;
		$cedula=$datos->cedula;
		$nombre=$datos->nombres;
		$apellido=$datos->apellidos;
		$fecha=$datos->fecha_nacimiento;
		$direccion=$datos->direccion;
		$telefono=$datos->telefono;
		$cod_ciudad=$datos->id_ciudad;

		$datos1=array($nombre,$apellido,$direccion,$fecha,$telefono,$cod_ciudad);
		$sql="UPDATE usuario set nombres=?,apellidos=?,direccion=?,fecha_nacimiento=?,telefono=?,id_ciudad=? where id_usuario='$codigo';";

		$stament=$con->getConexion()->prepare($sql);
		$stament->execute($datos1);
		echo json_encode(['success'=>1]);
	}

	if(isset($_GET['usuario'])){
		$id=$_GET['usuario'];
		$sql="SELECT *from usuario join ciudad using(id_ciudad) where id_usuario=?";
		$datos=array($id);
		$stament=$con->getConexion()->prepare($sql);
		$stament->execute($datos);
		$resultado=$stament->fetch(PDO::FETCH_ASSOC);
		echo json_encode($resultado);
	}
?>