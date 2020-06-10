<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
if(isset($_GET['usuario']) || isset($_GET['correo'])){
    include 'conexion.php';
    include 'generarPass.php';
}

if(isset($_GET['usuario'])){
    $usuario=$_GET['usuario'];
    $sql="SELECT nombre,usuario,clave,correo FROM usuario WHERE usuario='{$usuario}'";
    $sqlUp="UPDATE usuario SET clave='{$password}', fechainicio=NULL WHERE usuario='{$usuario}'";
    $sentenciaUp=$conexion->prepare($sqlUp);
    $sentenciaUp->execute();

}elseif (isset($_GET['correo'])){
    $correo=$_GET['correo'];
    $sql="SELECT nombre,usuario,clave,correo FROM usuario WHERE correo='{$correo}'";
    $sqlUp="UPDATE usuario SET clave='{$password}', fechainicio=NULL WHERE correo='{$correo}'";
    $sentenciaUp=$conexion->prepare($sqlUp);
    $sentenciaUp->execute();
}

//var_dump($sql);
//exit();
$sentencia=$conexion->prepare($sql);
$sentencia->execute();
$resultado = $sentencia->get_result();
WHILE ($fila = $resultado->fetch_assoc()) {
    $nombreC=$fila["nombre"];
    $emailC=$fila["correo"];
    $usuarioC=$fila["usuario"];
    $claveC=$fila["clave"];
}

if(!empty($usuarioC)) {
//var_dump($nombreC);
//exit();
    $mail = new PHPMailer(true);

    try {
        //Configuracion
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'avonpruphp@gmail.com';
        $mail->Password = '4von@4Dm1nphpP4ss';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Datos de envio
        $mail->setFrom('avonpruphp@gmail.com', 'AVON admin');
        $mail->addAddress($emailC, $nombreC);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = 'Bienvenido '.$nombreC;
            $cuerpo = '
             <html>
             <head>
                <title>AVON</title>
             </head>
             <body>
             <h2>AVON le da la Bienvenida</h2>
             <h3>Se le envia el usuario y la clave para ingresar a dicho sistema</h3>
             <h4></h4>
             <h4>Se le recuerad que esta clave es temporal y que al ingresar por</h4>
             <h4>primeravez devera persoanlizar su clave de acceso.</h4>
             <h4>Usuario: '.$usuarioC.'</h4>
             <h4>Clave: '.$claveC. '</h4>
             <h4></h4>
             <h3>Recuerde que la clave es de caracter confidencial y personal</h3>
             <p>

             </b>
             <h4>Atte. admin AVON</h4>
             </p>
             </body>
             </html>
             ';
        $mail->Body = $cuerpo;


        $mail->send();
        if(isset($_GET['usuario']) || isset($_GET['correo'])){
            echo "<script language='JavaScript'>window.location.href='index.php'</script>";
        }
//        echo 'Mensaje enviado corectamente';
    } catch (Exception $e) {
//        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
//    exit();
}
?>