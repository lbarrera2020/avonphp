<?php
include 'conexion.php';
$idbu = $_REQUEST['id'];
$idfil = $_REQUEST['fil'];

    if($idbu=='1'){
        $where="and a.idproductos like '%$idfil%'";
    }elseif ($idbu=='2'){
        $where="and a.descripcion like '%$idfil%'";
    }elseif ($idbu=='3'){
        $where="and a.precio<=$idfil";
    }elseif ($idbu=='4'){
        $where="and a.categorias=$idfil";
    }

    ?>
<div class="card border-primary rounded-0" id="tabla">
<table id="tabla" class="table table-condensed table-bordered table-hover">
    <tr>
        <th>#</th>
        <th colspan="3">Productos</th>
        <th colspan="2">Acci&oacute;n</th>
    </tr>
    <?php
    $sql="SELECT a.idproductos as id, a.descripcion as des, a.precio as pre, a.stoc as stoc, a.imagen as img, b.descripcion as cat, if(a.estado=1,'Activo','Inactivo') stado
                FROM productos a
                left join categorias b on a.categorias=b.idcategorias
                where a.imagen is not null and a.imagen!='' ".$where;
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
    ?>
</table>
</div>