<?php
include 'conexion.php';


//$idcategorias=$_POST['idd'];
$descripcion=$_POST['nombre'];

//calcular el maximo id
$categoria = $conexion->prepare("select max(idcategorias) as idmax from categorias");
$categoria->execute();
$resultado = $categoria->get_result();
while ($fila = $resultado->fetch_assoc()) {
    $idcategorias=$fila['idmax']+1;
}

//$data=array();

$sentencia=$conexion->prepare("insert into categorias
	(idcategorias, descripcion)
	values ('{$idcategorias}', '{$descripcion}')");
$resultado=$sentencia->execute();

echo"<script language='JavaScript'>window.location.href='manCategoria.php'</script>";
//if($resultado){
//    $data['Respuesta']=["OK"];
//}
//else
//{
//    $data ['Respuesta']=["ERROR"];
//}
//echo json_encode($data,JSON_UNESCAPED_UNICODE);

$sentencia->close();
$conexion->close();
?>