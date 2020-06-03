<?php
require('conexion.php');
session_start();
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
$sql = "SELECT COUNT(*) as contar FROM usuario WHERE usuario = '".$usuario."' and clave='".$clave."';";
$query=mysqli_query($conexion,$sql);
$array = mysqli_fetch_array($query);

if($array['contar']>0){
   $_SESSION['usuario'] = $usuario;
    header("location: menu.php");
    $_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (1 * 60) ;
}else{
    header("location: index.php");
    echo '<script language="javascript">alert("El usuario no existe");</script>';
}
    


?>