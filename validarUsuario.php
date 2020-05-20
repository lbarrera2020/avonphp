<?php
include 'conexion.php';
$usu_usuario=$_POST['usuario'];
$usu_password=$_POST['clave'];
$json=array();

$sentencia=$conexion->prepare("SELECT * FROM usuario WHERE usuario='{$usu_usuario}' AND clave='{$usu_password}'");
$sentencia->execute();

$resultado = $sentencia->get_result();
if ($fila = $resultado->fetch_assoc()) {
	$json['usuario'][]=$fila;
         echo json_encode($json,JSON_UNESCAPED_UNICODE);     
}
$sentencia->close();
$conexion->close();
?>