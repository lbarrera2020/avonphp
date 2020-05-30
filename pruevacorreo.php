<?php
$para      = '2537362011@mail.utec.edu.sv';
$titulo    = 'El título';
$mensaje   = 'Hola';
$cabeceras = 'From: webmaster@example.com';
    

mail($para, $titulo, $mensaje, $cabeceras);
?>