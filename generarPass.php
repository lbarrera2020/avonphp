<?php
//Carácteres para la contraseña
$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
$password = "";
//Reconstruimos la contraseña segun la longitud que se quiera
for($i=0;$i<8;$i++) {
    //obtenemos un caracter aleatorio escogido de la cadena de caracteres  for($i=0;$i<$_POST['longitud'];$i++)
    $password .= substr($str,rand(0,62),1);
}
//Mostramos la contraseña generada
//echo 'Password generado: '.$password;
?>