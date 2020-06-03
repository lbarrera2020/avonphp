<?php
include 'conexion.php';

session_start();
if(isset($_GET['cerrar_sesion'])){
    session_unset();

    session_destroy();
}
if(isset($_POST['nombre'] && isset($_POST['clave'])))
$nombrer= $_POST['nombre'];
$clave= $_POST['clave'];


?>