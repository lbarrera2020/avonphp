<!DOCTYPE html>
<html lang="en">
<head>
    <title>Menú desplegable y colapsable</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="#"><img src="https://picsum.photos/60/30"
                                          alt="Página de inicio"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Campaña<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Campaña</a></li>
                    <li><a href="#">Categoria</a></li>
                    <li><a href="#">Tipo de Campaña</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Productos<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Productos</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuarios<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="tablaUsuarios.php">Usuarios</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<br>

<div class="container">
    <h3>Aquí va el contenido</h3>
    <p>En esta zona va el contenido de tu pagina</p>
</div>

</body>
</html>