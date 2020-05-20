<?php
include 'conexion.php';

	$nombre=$_POST['nombre'];
	$usuario=$_POST['usuario'];
	$clave=null;
	$correo=$_POST['correo'];
	$telcel=$_POST['telcel'];
	$telfijo=$_POST['telfijo'];
	$direccion1=$_POST['direccion1'];
	$direccion2=$_POST['direccion2'];
	$idtipousuario=3;
	$fechacreacion =date("Y-m-d"); 
	$fechainicio =null; 
	$estado='1'; 
		

	$json=array();

	$sentencia=$conexion->prepare("INSERT INTO usuario(nombre,usuario,clave,correo,telcel,telfijo,idtipousuario,fechacreacion,
	fechainicio,estado,direccion1,direccion2) VALUES ('{$nombre}','{$usuario}','{$clave}','{$correo}','{$telcel}','{$telfijo}','{$idtipousuario}','{$fechacreacion}','{$fechainicio}','{$estado}','{$direccion1}','{$direccion2}')");
	$resultado=$sentencia->execute();

	if($resultado){
	$sentencia=$conexion->prepare("SELECT * FROM usuario WHERE usuario='{$usuario}'");
	$sentencia->execute();

	$resultado = $sentencia->get_result();
	if ($fila = $resultado->fetch_assoc()) {
	$json['usuario'][]=$fila;
         echo json_encode($json,JSON_UNESCAPED_UNICODE);     
	}

	}
	else{
			
	}

$sentencia->close();
$conexion->close();
?>