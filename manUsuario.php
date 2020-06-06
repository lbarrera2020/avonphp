<?php
include 'conexion.php';
include 'encabezado.php';

//para ejecutar UPDATE
if(isset($_POST['nombre'])) {
    $id=$_POST['idd'];
    $nom=$_POST['nombre'];
    //verifica si hay una categoria con el mismo nombre
    $categoria = $conexion->prepare("select descripcion from categorias where descripcion='{$descripcion}'");
    $categoria->execute();
    $resultado = $categoria->get_result();
    while ($fila = $resultado->fetch_assoc()) {
        $nomigual=$fila['descripcion'];
    }
    if($nomigual==$descripcion){
        echo"<script language='JavaScript'>window.location.href='manCategoria.php?d=1'</script>";
    }else {

        $sql="UPDATE categorias SET descripcion='{$nom}' WHERE idcategorias={$id}";

        $categoria = $conexion->prepare($sql);
        $categoria->execute();
        $categoria->close();
    }
}
//para mostras y modificar
if(isset($_GET['id'])) {
    $hidden = 'hidden';
    $id=$_GET['id'];
    $sentencia = $conexion->prepare("SELECT * FROM usuario where idusuario={$id}");
    $sentencia->execute();

    $resultado = $sentencia->get_result();
    while ($fila = $resultado->fetch_assoc()) {
        $idusuario = $fila['idusuario'];
        $nombre = $fila['nombre'];
        $usuario = $fila['usuario'];
        $clave = $fila['clave'];
        $correo = $fila['correo'];
        $telcel = $fila['telcel'];
        $telfijo = $fila['telfijo'];
        $idtipousuario = $fila['idtipousuario'];
        $estado = $fila['estado'];
        $direccion1 = $fila['direccion1'];
        $direccion2 = $fila['direccion2'];
    }
    $sentencia->close();
}else {
    $hidden = 'text';
    $idusuario =0;
    $nombre = '';
    $usuario = '';
    $clave = '';
    $correo = '';
    $telcel = '';
    $telfijo = '';
    $idtipousuario = '';
    $estado = '';
    $direccion1 = '';
    $direccion2 = '';
}
//para Eliminar
if(isset($_GET['idx'])) {
    $id=$_GET['idx'];
    $sentencia = $conexion->prepare("DELETE FROM usuario WHERE idusuario={$id}");
    $sentencia->execute();
    $sentencia->close();

}
?>
    <div class="table-responsive">
        <form id="form1" name="form1" method="POST" action="insertUsuario.php">
            <div class="card border-primary rounded-0">
                <div class="card-header p-0">
                    <div class="bg-pink text-white text-center py-2">
                        <?php
                        if(isset($_GET['id'])){
                            ?>
                            <h3><a href="#" onclick="divLogin()"><i class="fa fa-cubes"></i></a> Modificar Uusario</h3>
                            <?php
                        }else{
                            ?>
                            <h3><a href="#" onclick="divLogin()"><i class="fa fa-cubes"></i></a> Crear Usuario</h3>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="card-body p-3" id="caja" hidden>                    <!--Body-->
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-signature text-pink"></i></div>
                            </div>
                            <?php
                            if(isset($_GET['id'])){
                                ?>
                                <input type="text" class="form-control" id="nombre" name="nombre" pattern="[A-Za-z ]{1,100}" title="solo se permiten caracteres de la A-Za-z" placeholder="Ingrece el nombre del usuario" value="<?php echo $nombre;?>" required>
                                <input type="hidden" name="idusuario" id="idusuario" value="<?=$idusuario?>">
                                <?php
                            }else{
                                ?>
                                <input type="text" class="form-control" id="nombre" name="nombre" pattern="[A-Za-z ]{1,100}" title="solo se permiten caracteres de la A-Za-z" placeholder="Ingrece el nombre del usuario" required>
                            <?php }?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user text-pink"></i></div>
                            </div>
                            <?php
                            if(isset($_GET['id'])){
                                ?>
                                <input type="text" class="form-control" id="usuario" name="usuario" pattern="[A-Za-z ]{1,100}" title="solo se permiten caracteres de la A-Za-z" placeholder="Ingrece el usuario" value="<?php echo $usuario;?>" required>
                                <?php
                            }else{
                                ?>
                                <input type="text" class="form-control" id="usuario" name="usuario" pattern="[A-Za-z ]{1,100}" title="solo se permiten caracteres de la A-Za-z" placeholder="Ingrece el usuario" required>
                            <?php }?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-at text-pink"></i></div>
                            </div>
                            <?php
                            if(isset($_GET['id'])){
                                ?>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingrece el correo del usuario" value="<?php echo $correo;?>" required>
                                <?php
                            }else{
                                ?>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingrece el correo del usuario" required>
                            <?php }?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-mobile-alt text-pink"></i></div>
                            </div>
                            <?php
                            if(isset($_GET['id'])){
                                ?>
                                <input type="tel" class="form-control" id="telcel" name="telcel" placeholder="Ingrece el numero de telefono movil del usuario" value="<?php echo $telcel;?>" required>
                                <?php
                            }else{
                                ?>
                                <input type="tel" class="form-control" id="telcel" name="telcel" placeholder="Ingrece el numero de telefono movil del usuario" required>
                            <?php }?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-phone text-pink"></i></div>
                            </div>
                            <?php
                            if(isset($_GET['id'])){
                                ?>
                                <input type="tel" class="form-control" id="telfijo" name="telfijo" placeholder="Ingrece el numero de telefono fijo del usuario" value="<?php echo $telfijo;?>">
                                <?php
                            }else{
                                ?>
                                <input type="tel" class="form-control" id="telfijo" name="telfijo" placeholder="Ingrece el numero de telefono fijo del usuario">
                            <?php }?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user-cog text-pink"></i></div>
                            </div>
                            <select class="form-control" name="idtipousuario" id="idtipousuario" required>
                                <option value="">Seleccione</option>
                                <?php
                                $sentencia=$conexion->prepare("SELECT * FROM tipousuario WHERE idtipousuario IN (1,2)");
                                $sentencia->execute();
                                $resultado = $sentencia->get_result();
                                $i=0;
                                WHILE ($fila = $resultado->fetch_assoc()) {
                                    if($idtipousuario == $fila['idtipousuario']){
                                        echo " <option value='".$fila['idtipousuario']."' selected>".$fila['tipo_usuario']."</option>";
                                    }else{
                                        echo " <option value='".$fila['idtipousuario']."'>".$fila['tipo_usuario']."</option>";
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
                                <div class="input-group-text"><i class="fa fa-user-lock text-pink"></i></div>
                            </div>
                            <select class="form-control" name="estado" id="estado" required>
                                <?php
                                if ($estado == 1){
                                    ?>
                                    <option value="">Seleccione</option>
                                    <option value="1" selected>Activo</option>
                                    <option value="2">Inactivo</option>
                                    <?php
                                }elseif($estado == 2){
                                    ?>
                                    <option value="">Seleccione</option>
                                    <option value="1">Activo</option>
                                    <option value="2" selected>Inactivo</option>
                                    <?php
                                }else{
                                    ?>
                                    <option value="" selected>Seleccione</option>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-map-marker-alt text-pink"></i></div>
                            </div>
                            <?php
                            if(isset($_GET['id'])){
                                ?>
                                <input type="text" class="form-control" id="direccion1" name="direccion1" pattern="[A-Za-z0-9- #]{1,100}" title="solo se permiten caracteres de la A-Za-z" placeholder="Ingrece la direccion del usuario" value="<?php echo $direccion1;?>" required>
                                <?php
                            }else{
                                ?>
                                <input type="text" class="form-control" id="direccion1" name="direccion1" pattern="[A-Za-z0-9- #]{1,100}" title="solo se permiten caracteres de la A-Za-z" placeholder="Ingrece la direccion del usuario" required>
                            <?php }?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-map-marker-alt text-pink"></i></div>
                            </div>
                            <?php
                            if(isset($_GET['id'])){
                                ?>
                                <input type="text" class="form-control" id="direccion2" name="direccion2" pattern="[A-Za-z0-9- #]{1,100}" title="solo se permiten caracteres de la A-Za-z" placeholder="Ingrece la direccion 2 del usuario" value="<?php echo $direccion2;?>">
                                <?php
                            }else{
                                ?>
                                <input type="text" class="form-control" id="direccion2" name="direccion2" pattern="[A-Za-z0-9- #]{1,100}" title="solo se permiten caracteres de la A-Za-z" placeholder="Ingrece la direccion 2 del usuario">
                            <?php }?>
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
                <th>Nombre/Usuario</th>
                <th>Contactos</th>
                <th>Tipo/Fecha/Estado</th>
                <th>Direeciones</th>
                <th colspan="2">Acci&oacute;n</th>
            </tr>
            <?php
            $sentencia=$conexion->prepare("SELECT * FROM usuario INNER JOIN tipousuario ON tipousuario.idtipousuario = usuario.idtipousuario WHERE usuario.idtipousuario IN (1,2) and estado = 1 ORDER BY idusuario ASC");
            $sentencia->execute();

            $resultado = $sentencia->get_result();
            $i=0;
            WHILE ($fila = $resultado->fetch_assoc()) {
                $i=$i+1;
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>Nombre :".$fila['nombre']."<br>Usuario : ".$fila['usuario']."</td>";
                echo "<td>Movil : ".$fila['telcel']."<br>Casa : ".$fila['telfijo']."<br>Correo : ".$fila['correo']."</td>";
                $estado = 'Inactivo';
                if ($fila['estado'] == 1){
                    $estado = 'Activo';
                }
                echo "<td>Tipo : ".$fila['tipo_usuario']."<br>Fecha : ".$fila['fechacreacion']."<br>Estado : ".$estado."</td>";
                echo "<td>Direc 1:".$fila['direccion1']."<br> Direc 2:".$fila['direccion2']."</td>";

                echo "<td><a id='modi' href='manUsuario.php?id=$fila[idusuario]'><span class='fa fa-edit'></span></a></td>";
                echo "<td><a href='manUsuario.php?idx=$fila[idusuario]'><span class='fa fa-trash-alt'></span></a></td>";
                echo "</tr>";
            }
            $sentencia->close();
            ?>
        </table>
    </div>
<?php
include("pie.php");
?>