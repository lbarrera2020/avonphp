<?php
require('conexion.php');
session_start();
$c=$_POST['c'];
$u=$_POST['u'];
if($c!=''){
    $fe=date("Y-m-d");
    $sqlUp="UPDATE usuario SET clave='{$c}', fechainicio='{$fe}' WHERE usuario='{$u}'";
    $sentenciaUp=$conexion->prepare($sqlUp);
    $sentenciaUp->execute();
    header("location: index.php");
}
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
$sql = "SELECT COUNT(*) as contar, nombre, idtipousuario, fechainicio FROM usuario WHERE idtipousuario=1 and usuario = '$usuario' and clave='$clave'";
//var_dump($sql);
//exit();
$query=mysqli_query($conexion,$sql);
$array = mysqli_fetch_array($query);
//var_dump($array['contar']);
//exit();
if($array['contar']>0){
   $_SESSION['nombre'] = $array['nombre'];
   $_SESSION['usuario'] = $usuario;
   var_dump($array['fechainicio']);
    if(is_null($array['fechainicio'])){

        header("location: inde.php?c=1&u=$usuario");
//        exit("null");
    }else{
    header("location: menu.php");
    $_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (1 * 60) ;
    }
}else{
    header("location: index.php");
    echo '<script language="javascript">alert("El usuario no existe");</script>';
}
    


?>