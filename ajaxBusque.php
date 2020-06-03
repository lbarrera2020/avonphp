<?php
include 'conexion.php';
$idbu = $_REQUEST['id'];
//var_dump($idbu);
$url="'ajaxBusque.php?id='+this.value";
?>
<div class="card border-primary rounded-0" id="busque">
    <div class="card-header p-0">
        <div class="card-header p-0">
            <div class="bg-pink text-white text-center py-2">
                <h3><i class="fa fa-binoculars"></i> Area de filtros para busqueda</h3>
            </div>
        </div>
    </div>
    <div class="input-group mb-2">
    <div class="input-group-prepend">
    <select name="buscar" id="buscar" onchange="cargarDiv('#busque',<?php echo $url;?>);">
        <option value="">Seleccione...</option>
        <option value="1" <?php if($idbu=='1'){echo 'selected="selected"';}?>>Codigo</option>
        <option value="2" <?php if($idbu=='2'){echo 'selected="selected"';}?>>Detalle</option>
        <option value="3" <?php if($idbu=='3'){echo 'selected="selected"';}?>>Precio</option>
        <option value="4" <?php if($idbu=='4'){echo 'selected="selected"';}?>>Categoria</option>
    </select>
    </div>
    <div class="input-group-prepend">
    <?php
    if($idbu=='1'){
        $url="'ajaxProducto.php?id=$idbu&fil='+this.value";
    ?>
        <input type="text" name="buscod" style="width:300px;height:25px" placeholder="Ingrese El codigo que desea buscar" onkeyup="cargarDiv('#tabla',<?Php echo $url;?>)" >
    <?php
    }elseif ($idbu=='2'){
        $url="'ajaxProducto.php?id=$idbu&fil='+this.value";
    ?>
        <input type="text" name="busdeta" style="width:400px;height:25px" placeholder="Ingrese El Nombre de el producto que desea buscar" onkeyup="cargarDiv('#tabla',<?Php echo $url;?>)" >
    <?php
    }elseif ($idbu=='3'){
        $url="'ajaxProducto.php?id=$idbu&fil='+this.value";
        ?>
        <input type="text" name="busprea" style="width:300px;height:25px" placeholder="Ingrese El precio maximo de que desea buscar" onkeyup="cargarDiv('#tabla',<?Php echo $url;?>)">
        <?php
    }elseif ($idbu=='4'){
        $sql="SELECT idcategorias, descripcion FROM categorias";
        $sentencia=$conexion->prepare($sql);
        $sentencia->execute();

        $resultado = $sentencia->get_result();
        $url="'ajaxProducto.php?id=$idbu&fil='+this.value";
        ?>
        <select name='cate' id='cate' onchange="cargarDiv('#tabla',<?Php echo $url;?>)">
        <?php
        echo "<option value=''>Seleccione la categoria a Buscar...</option>";
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
        <?php
    }
    ?>
    </div>
</div>