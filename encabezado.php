<?php
session_start();
if(isset($_SESSION['usuario'])){

}else{
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sistema de Administracion de Catalogos AVON</title>
    <meta charset="utf-8">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
<!--    <link rel="stylesheet" href="css/personal.css">-->
    <link rel="stylesheet" href="css/menu.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/menu.js"></script>
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>-->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slides.js"></script>
    <script language="javascript" src="js/ajax.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script language="JavaScript">
        var clic = 1;
        function divLogin(){
            if(clic==1){
                document.getElementById("caja").hidden=false
                clic = clic + 1;
            } else{
                document.getElementById("caja").hidden=true
                clic = 1;
            }
        }
    </script>
</head>
<body>
<header>
<!--    <div>-->
<!--        <img src="img/banner/banner.jpg" alt="">-->
<!--    </div>-->
    <div class="menu_bar">
<!--        <img src="img/banner/banner.jpg" alt="">-->
        <a href="#" class="bt-menu"><span class="fa fa-bars"></span>Menú</a>
    </div>

    <nav>
<!--        <div style="color:#FFffff;">-->
<!--            <h6>Usuario : --><?php //echo $_SESSION['usuario'] ?><!--</h6>-->
<!--        </div>-->
        <ul>
            <li><a href="menu.php"><span class="fa fa-home"></span>Inicio</a></li>
            <li class="submenu">
                <a href="#"><span class="fa fa-building"></span>Campaña<span class="caret icon-arrow-down6"></span></a>
                <ul class="children">
                    <li><a href="manCategoria.php">Categoria<span class="fa fa-cubes"></span></a></li>
                    <li><a href="manTipoCampania.php">Tipo de Campaña<span class="fa fa-coins"></span></a></li>
                    <li><a href="manCampania.php">Campaña<span class="fa fa-money-bill-alt"></span></a></li>
                </ul>
            </li>
            <li><a href="manProductos.php"><span class="fa fa-qrcode"></span>Productos</a></li>
            <li><a href="manUsuario.php"><span class="fa fa-users"></span>Usuarios</a></li>
<!--            <li><a href="manUsuario.php"><span class=""></span><h5>--><?php //echo $_SESSION['usuario'] ?><!--</h5></a></li>-->
            <li><a href="salir.php"><span class="fas fa-hand-spock"></span>Cerrar sesion</a></li>
            
        </ul>
    </nav>
    <div>
        <h6>Usuario : <?php echo $_SESSION['nombre'] ?></h6>
    </div>
</header>

<br>

<section class="contenido wrapper">