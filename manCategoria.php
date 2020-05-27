<?php
include 'conexion.php';
include"encabezado.php";

//para ejecutar UPDATE
if(isset($_POST['nombre'])) {
    $id=$_POST['idd'];
    $nom=$_POST['nombre'];
$sql="UPDATE categorias SET descripcion='{$nom}' WHERE idcategorias={$id}";
//    var_dump($sql);
//    exit();
    $categoria = $conexion->prepare($sql);
//    $categoria->bind_param("i", $id);
    $categoria->execute();
    $categoria->close();
//    $conexion->close();
}
//para mostras y modificar
if(isset($_GET['id'])) {
    $id=$_GET['id'];
    $sentencia = $conexion->prepare("SELECT * FROM categorias where idcategorias={$id}");
    $sentencia->execute();

    $resultado = $sentencia->get_result();
    while ($fila = $resultado->fetch_assoc()) {
        $id=$fila['idcategorias'];
        $nombre=$fila['descripcion'];
    }
    $sentencia->close();
//    $conexion->close();
}
//para Eliminar
if(isset($_GET['idx'])) {
    $id=$_GET['idx'];
    $sentencia = $conexion->prepare("DELETE FROM categorias WHERE idcategorias={$id}");
    $sentencia->execute();

    $sentencia->close();

}
?>
    <div class="table-responsive">
        <?php
        if(isset($_GET['id'])){
            ?>
            <form id="form1" name="form1" method="POST" action="manCategoria.php">
            <?php
        }else{
            ?>
            <form id="form1" name="form1" method="POST" action="insertCategoria.php">
        <?php }?>
<!--        <form id="form1" name="form1" method="POST" action="insertCategoria.php">-->
            <div class="card border-primary rounded-0">
                <div class="card-header p-0">
                    <div class="bg-pink text-white text-center py-2">
                        <h3><i class="fa fa-cubes"></i> Crear Categorias</h3>
                    </div>
                </div>
                <div class="card-body p-3">

                    <!--Body-->
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-cubes text-pink"></i></div>
                            </div>
                            <?php
                                if(isset($_GET['id'])){
                                    ?>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Descripcion de categoria" value="<?php echo $nombre;?>" required>
                                    <input type="hidden" id="idd" name="idd" value="<?php echo $id;?>">
                                    <?php
                                }else{
                            ?>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Descripcion de categoria" required>
                            <?php }?>
                        </div>
                    </div>
                    <div class="text-center">
                        <?php
                        if(isset($_GET['id'])){
                            ?>
                            <input type="submit" value="Modificar" class="btn btn-pink btn-block rounded-0 py-2">
<!--                            <button onclick="location.href='manCategoria.php'" class="btn btn-pink btn-block rounded-0 py-2">Modificar</button>-->
                            <?php
                        }else{
                            ?>
                            <input type="submit" value="Enviar" class="btn btn-pink btn-block rounded-0 py-2">
                        <?php }?>
                    </div>
                </div>
            </div>
        </form>

        <table class="table table-condensed table-bordered table-hover">
            <tr>
                <th>#</th>
                <th>Descripci&oacute;n</th>
                <th colspan="3">Acci&oacute;n</th>
            </tr>
            <?php
            $sentencia=$conexion->prepare("SELECT * FROM categorias");
            $sentencia->execute();

            $resultado = $sentencia->get_result();
            $i=0;
            WHILE ($fila = $resultado->fetch_assoc()) {
                $i=$i+1;
                echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>".$fila['descripcion']."</td>";
                    echo "<td><a href='manCategoria.php?id=$fila[idcategorias]'><span class='fa fa-edit'></span></a></td>";
                    echo "<td><a href='manCategoria.php?idx=$fila[idcategorias]'><span class='fa fa-trash-alt'></span></a></td>";
                echo "</tr>";
            }
            $sentencia->close();
//            $conexion->close();
            ?>
        </table>
    </div>

<?php
include("pie.php");
?>