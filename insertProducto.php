<?php
include 'conexion.php';


$id=$_POST['codigo'];
$nombre=$_POST['nombre'];
$costo=$_POST['costo'];
$stoc=$_POST['stoc'];
$cate=$_POST['cate'];
$fechacreacion=date("Y-m-d");
$estado=1;

$final_name='';

if (isset($_FILES["fileupload"]) && $_FILES['fileupload']['error'] == UPLOAD_ERR_OK) {

    $filename = $_FILES['fileupload']['name'];
    $tamano = $_FILES['fileupload']['size'];
    $extension = end((explode(".", $filename)));
    $valid_extension = array('jpg');
    $target_dir = "img/productos/";

    $final_name =
        trim(str_replace(' ','',$id)).'.'.$extension;


    if (!in_array($extension, $valid_extension) || $tamano > 3000000) {

        echo "<div style='background-color:red;color:white;font-weight:bold;text-align:center;'>Error: Ocurrio un problema al intentar subir la imagen !!!!</div>";
    } else {
        if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_dir . $final_name)) {

            move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_dir . $final_name);
        }
    }

}
$idc='';
$sql="SELECT idproductos FROM productos where idproductos={$id}";
$sentencia=$conexion->prepare($sql);
$sentencia->execute();

$resultado = $sentencia->get_result();
while ($fila = $resultado->fetch_assoc()) {
    $idc=$fila['idproductos'];
}

if($idc==$id){
    echo"<script language='JavaScript'>window.location.href='manProductos.php?d=1'</script>";
}else {


    $sql = "INSERT INTO productos
(idproductos, descripcion, precio, stoc, imagen, categorias, fecha_creacion, estado)
 VALUES ({$id},'{$nombre}',{$costo},{$stoc},'{$final_name}',{$cate},'{$fechacreacion}',{$estado})";

    $sentencia = $conexion->prepare($sql);
    $resultado = $sentencia->execute();

    echo "<script language='JavaScript'>window.location.href='manProductos.php'</script>";

    $sentencia->close();
    $conexion->close();
}
?>