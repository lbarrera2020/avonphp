<?php
include 'conexion.php';
include"encabezado.php";

//para ejecutar UPDATE
if(isset($_POST['nombre'])) {
    $id=$_POST['idd'];
    $nom=$_POST['nombre'];
    $costo=$_POST['costo'];
    $stoc=$_POST['stoc'];
    $idcate=$_POST['cate'];
    $estado=$_POST['estado'];

    $final_name='';

//    var_dump($_FILES['fileupload']);
//    exit();
    if(isset($_FILES['fileupload'])) {
        if (isset($_FILES["fileupload"]) && $_FILES['fileupload']['error'] == UPLOAD_ERR_OK) {

            $filename = $_FILES['fileupload']['name'];
            $tamano = $_FILES['fileupload']['size'];
            $extension = end((explode(".", $filename)));
            $valid_extension = array('jpg');
            $target_dir = "img/productos/";

            $final_name =
                trim(str_replace(' ', '', $id)) . '.' . $extension;


            if (!in_array($extension, $valid_extension) || $tamano > 3000000) {

                echo "<div style='background-color:red;color:white;font-weight:bold;text-align:center;'>Error: Ocurrio un problema al intentar subir la imagen !!!!</div>";
            } else {
                if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_dir . $final_name)) {

                    move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_dir . $final_name);
                }
            }

        }
    }

    if(isset($_FILES['fileupload'])) {
        $sql = "UPDATE productos SET
        descripcion='{$nom}',precio={$costo},
        stoc={$stoc},imagen='{$final_name}',categorias={$idcate},
        estado={$estado} WHERE idproductos={$id}";

    }else{
        $sql = "UPDATE productos SET
        descripcion='{$nom}',precio={$costo},
        stoc={$stoc},categorias={$idcate},
        estado={$estado} WHERE idproductos={$id}";

    }

        $categoria = $conexion->prepare($sql);
        $categoria->execute();
        $categoria->close();
    }
//}
//para mostras y modificar
if(isset($_GET['id'])) {
    $id=$_GET['id'];
    $sentencia = $conexion->prepare("SELECT * FROM productos where idproductos={$id}");
    $sentencia->execute();

    $resultado = $sentencia->get_result();
    while ($fila = $resultado->fetch_assoc()) {
        $codigo=$fila['idproductos'];
        $nombre=$fila['descripcion'];
        $costo=$fila['precio'];
        $stoc=$fila['stoc'];
        $fileupload=$fila['imagen'];
        $idcate=$fila['categorias'];
        $estado=$fila['estado'];
    }
    $sentencia->close();
//    $conexion->close();
}
//para Eliminar
if(isset($_GET['idx'])) {
    $id=$_GET['idx'];
    $sentencia = $conexion->prepare("DELETE FROM productos WHERE idproductos={$id}");
    $sentencia->execute();

    $sentencia->close();

}
if(isset($_GET['d'])) {
    echo '<script language="javascript">alert("El codigo de el producto tiene que ser diferente");</script>';
}
?>
    <div class="table-responsive">
        <?php
        if(isset($_GET['id'])){
        ?>
        <form id="form1" name="form1" method="POST" action="manProductos.php" enctype="multipart/form-data">
            <?php
            }else{
            ?>
            <form id="form1" name="form1" method="POST" action="insertProducto.php" enctype="multipart/form-data">
                <?php }?>
                <div class="card border-primary rounded-0">
                    <div class="card-header p-0">
                        <div class="bg-pink text-white text-center py-2">
                            <?php
                            if(isset($_GET['id'])){
                                ?>
                                <h3><i class="fa fa-cubes"></i> Modificar Productos</h3>
                                <?php
                            }else{
                                ?>
                                <h3><i class="fa fa-cubes"></i> Crear Productos</h3>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="card-body p-3">

                        <!--Body-->
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-barcode text-pink"></i></div>
                                </div>
                                <?php
                                if(isset($_GET['id'])){
                                    ?>
                                    <input type="text" readonly class="form-control" id="codigo" name="codigo" placeholder="Ingrese el dodigo de el producto" value="<?php echo $codigo;?>" required>
                                    <input type="hidden" id="idd" name="idd" value="<?php echo $codigo;?>">
                                    <?php
                                }else{
                                    ?>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ingrese el dodigo de el producto" required>
                                <?php }?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-info text-pink"></i></div>
                                </div>
                                <?php
                                if(isset($_GET['id'])){
                                    ?>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese la descripcion del produto" value="<?php echo $nombre;?>" required>
                                    <?php
                                }else{
                                    ?>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese la descripcion del produto" required>
                                <?php }?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-dollar-sign text-pink"></i></div>
                                </div>
                                <?php
                                if(isset($_GET['id'])){
                                    ?>
                                    <input type="text" class="form-control" id="costo" name="costo" placeholder="Ingrese el Costo de el produsto" value="<?php echo $costo;?>" required>

                                    <?php
                                }else{
                                    ?>
                                    <input type="text" class="form-control" id="costo" name="costo" placeholder="Ingrese el Costo de el produsto" required>
                                <?php }?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-boxes text-pink"></i></div>
                                </div>
                                <?php
                                if(isset($_GET['id'])){
                                    ?>
                                    <input type="text" class="form-control" id="stoc" name="stoc" placeholder="Ingrese la existencia de el produto" value="<?php echo $stoc;?>" required>
                                    <?php
                                }else{
                                    ?>
                                    <input type="text" class="form-control" id="stoc" name="stoc" placeholder="Ingrese la existencia de el produto" required>
                                <?php }?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                <?php
                                if(isset($_GET['id'])){
                                ?>
                                    <div class="input-group-text"><img src='img/productos/<?php echo $fileupload;?>' class='rounded-circle'  width='100' height='100'></i></div>
                                    <?php
                                }else{
                                    ?>
                                    <div class="input-group-text"><i class="fa fa-image text-pink"></i></div>
                                <?php }?>
                                </div>
                                <?php
                                if(isset($_GET['id'])){
                                    ?>
                                    <input type="file" class="form-control" id="fileupload" name="fileupload" placeholder="Ingrese la imagen del produto en formato jpg">
                                    <?php
                                }else{
                                    ?>
                                    <input type="file" class="form-control" id="fileupload" name="fileupload" placeholder="Ingrese la imagen del produto en formato jpg" required>
                                <?php }?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-cubes text-pink"></i></div>
                                </div>
                                <?php
                                $sql="SELECT idcategorias, descripcion FROM categorias";
                                $sentencia=$conexion->prepare($sql);
                                $sentencia->execute();

                                $resultado = $sentencia->get_result();
                                //                                    var_dump($idcate);
                                //                                    exit();
                                echo "<select name='cate' id='cate' class='form-control' required>";
                                echo "<option value=''>Seleccione la categoria a la que pertenece...</option>";
                                WHILE ($fila = $resultado->fetch_assoc()) {
                                    if($fila['idcategorias']==$idcate){
                                        echo "<option value='$fila[idcategorias]' selected >$fila[descripcion]</option>";
                                    }else{
                                        echo "<option value='$fila[idcategorias]' >$fila[descripcion]</option>";
                                    }
                                }
                                $sentencia->close();
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-toggle-on text-pink"></i></div>
                                </div>
                                <select class="form-control" name="estado" id="estado" required>
                                    <?php
                                    if ($estado == 1){
                                        ?>
                                        <option value="">Seleccione el estado de el producto...</option>
                                        <option value="1" selected>Activo</option>
                                        <option value="2">Inactivo</option>
                                        <?php
                                    }else if ($estado == 0){
                                        ?>
                                        <option value="" >Seleccione el estado de el producto...</option>
                                        <option value="1">Activo</option>
                                        <option value="2" selected>Inactivo</option>
                                        <?php
                                    }else{
                                        ?>
                                        <option value="" selected>Seleccione el estado de el producto...</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <?php
                            if(isset($_GET['id'])){
                                ?>
                                <input type="submit" value="Modificar" class="btn btn-pink btn-block rounded-0 py-2">
                                <?php
                            }else{
                                ?>
                                <input type="submit" value="Crear Nuevo" class="btn btn-pink btn-block rounded-0 py-2">
                            <?php }?>
                        </div>
                    </div>
                </div>
            </form>

            <table class="table table-condensed table-bordered table-hover">
                <tr>
                    <th>#</th>
                    <th colspan="3">Productos</th>
                    <th colspan="2">Acci&oacute;n</th>
                </tr>
                <?php
                $sql="SELECT a.idproductos as id, a.descripcion as des, a.precio as pre, a.stoc as stoc, a.imagen as img, b.descripcion as cat, if(a.estado=1,'Activo','Inactivo') stado
                FROM productos a
                left join categorias b on a.categorias=b.idcategorias
                where a.imagen is not null and a.imagen!=''";
                $sentencia=$conexion->prepare("$sql");
                $sentencia->execute();

                $resultado = $sentencia->get_result();
                $i=0;
                WHILE ($fila = $resultado->fetch_assoc()) {
                    $i=$i+1;
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td><img src='img/productos/$fila[img]' class='rounded-circle'  width='150' height='150'></td>";
                    echo "<td>
                          Categoria:<br>
                          Codigo:<br>
                          Descripci&oacute;n<br>
                          Precio:<br>
                          Existencia:<br>
                          Estado:<br>
                          </td>";
                    echo "<td>
                          <h5>$fila[cat]</h5>
                          $fila[id]<br>
                          $fila[des]<br>
                          $ $fila[pre]<br>
                          $fila[stoc]<br>
                          $fila[stado]<br>
                          </td>";
                    echo "<td><a href='manProductos.php?id=$fila[id]'><span class='fa fa-edit'></span></a></td>";
                    echo "<td><a href='manProductos.php?idx=$fila[id]'><span class='fa fa-trash-alt'></span></a></td>";
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