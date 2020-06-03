
<?php
require('conexion.php');
$correo=$_POST['correo'];
if (isset($_POST['generar'])) {
    //Carácteres para la contraseña
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $password = "";
    //Reconstruimos la contraseña segun la longitud que se quiera
    for($i=0;$i<8;$i++) {
       //obtenemos un caracter aleatorio escogido de la cadena de caracteres  for($i=0;$i<$_POST['longitud'];$i++)
       $password .= substr($str,rand(0,62),1);
    }
    //Mostramos la contraseña generada
	echo 'Password generado: '.$password;
	
	
 }
 
 
$sql = "SELECT COUNT(*) as contar FROM usuario WHERE correo='".$correo."';";
$query=mysqli_query($conexion,$sql);
$array = mysqli_fetch_array($query);




if($array['contar']>0){
 $to = $_POST['correo'];
 $subject = "HTML email";
 
 $message ="esta es su clave de acceso <br> </be> <h1>$password</h1>
 <html>
 <head>
 <title>HTML email</title>
 </head>
 <body>
 <p>This email contains HTML Tags!</p>
 <table>
 <tr>
 <th>Firstname</th>
 <th>Lastname</th>
 </tr>
 <tr>
 <td>Gino</td>
 <td>Stefano</td>
 </tr>
 </table>
 </body>
 </html>
 ";
 
 // Always set content-type when sending HTML email
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 
 // More headers
 $headers .= 'From: <webmaster@example.com>' . "\r\n";
 $headers .= 'Cc: myboss@example.com' . "\r\n";
 
 mail($to,$subject,$message,$headers);
}else{
	echo '<script language="javascript">alert("Correo no existe en la base de datos");</script>';

}
if(isset($_POST['correo'])){
	$sql = "UPDATE usuario SET clave='".$password."' WHERE correo='".$correo."';";
$query = mysqli_query($conexion,$sql);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
<!--    <link rel="stylesheet" href="css/personal.css">-->
    <link rel="stylesheet" href="css/menu.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/menu.js"></script>
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>-->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slides.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
<body>
<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Recuperar Password</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>     
					
					<div style="padding-top:30px" class="panel-body" >
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="email" type="email" class="form-control" name="correo" placeholder="correo" required>                                        
							</div>
							
							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success" name="generar">Enviar</a>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12 control">
									
								</div>
							</div>    
						</form>
						
					</div>                     
				</div>  
			</div>
		</div>
</body>
</html>