<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: GET,POST");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	include_once("../conexion/Conexion.php");
	$con=new Conexion();

	if(isset($_GET['especialidad'])){
		$sql="SELECT *from especialidad;";
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
		$fecha_ingreso=$datos->fecha_ingreso;
		$direccion=$datos->direccion;
		$telefono=$datos->telefono;
		$cod_ciudad=$datos->ciudad;
		$email=$datos->email;
		$especialidad=$datos->especialidad;
		
		$datos1=array($nombre,$apellido,$direccion,$telefono,$email,$fecha,$especialidad,$cod_ciudad,$cedula,$fecha_ingreso);
		$sql="INSERT into empleado values(nextval('empleado_id_empleado'::regclass),?,?,?,?,?,?,?,?,?,?);";
		
		$stament=$con->getConexion()->prepare($sql);
		$stament->execute($datos1);
		echo json_encode(["success"=>1]);
	}

	if(isset($_GET['consultar'])){
		$sql="SELECT id_empleado, nombres, apellidos,direccion, cedula, telefono, fecha_nacimiento , email, empleado.id_ciudad,ciudad.nombre, fecha_ingreso,sueldo,id_especialidad,especialidad.nombre as especialidad from empleado join ciudad using(id_ciudad) join especialidad using(id_especialidad);";
		$stament=$con->getConexion()->query($sql);
		$resultado=$stament->fetchall(PDO::FETCH_ASSOC);
		echo json_encode($resultado);
	}

	if(isset($_GET['eliminar'])){
		$codigo=$_GET['eliminar'];
		$sql="DELETE from empleado where id_empleado=?;";
		$datos=array($codigo);
		$stament=$con->getConexion()->prepare($sql);
		$stament->execute($datos);
		echo json_encode(['success'=>1]);
	}

	if(isset($_GET['actualizar'])){
		$datos=json_decode(file_get_contents("php://input"));
		$codigo=$datos->id_empleado;
		$cedula=$datos->cedula;
		$nombre=$datos->nombres;
		$apellido=$datos->apellidos;
		$fecha=$datos->fecha_nacimiento;
		$fecha_ingreso=$datos->fecha_ingreso;
		$direccion=$datos->direccion;
		$telefono=$datos->telefono;
		$cod_ciudad=$datos->id_ciudad;
		$email=$datos->email;
		$especialidad=$datos->id_especialidad;
		
		$datos1=array($nombre,$apellido,$direccion,$telefono,$email,$fecha,$especialidad,$cod_ciudad,$cedula,$fecha_ingreso);
		$sql="UPDATE empleado set nombres=?,apellidos=?,direccion=?,telefono=?,email=?,fecha_nacimiento=?,id_especialidad=?,id_ciudad=?,cedula=?,fecha_ingreso=? where id_empleado='$codigo';";
		
		$stament=$con->getConexion()->prepare($sql);
		$stament->execute($datos1);
		echo json_encode(["success"=>1]);
	}

	if(isset($_GET['empleado'])){
		$codigo=$_GET['empleado'];
		$sql="SELECT id_empleado,nombres, apellidos,direccion, cedula, telefono, fecha_nacimiento , email, empleado.id_ciudad,ciudad.nombre, fecha_ingreso,sueldo,id_especialidad,especialidad.nombre as especialidad from empleado join ciudad using(id_ciudad) join especialidad using(id_especialidad) where id_empleado='$codigo';";
		$stament=$con->getConexion()->query($sql);
		$resultado=$stament->fetch(PDO::FETCH_ASSOC);
		echo json_encode($resultado);
	}
	
?>