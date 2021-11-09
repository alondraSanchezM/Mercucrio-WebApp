<?php

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"mercurioDB");
$link->set_charset("utf8");

if(isset($_REQUEST['id_u'])){
    $id_u=$_REQUEST['id_u'];
    $correo=$_REQUEST['correo'];
    $pass=$_REQUEST['pass'];
    $nombre=$_REQUEST['nombre'];
    $telefono=$_REQUEST['telefono'];

    echo "<br>$correo";
    echo "<br>$pass";
    echo "<br>$nombre";
    echo "<br>$telefono";
    //ACTUALIZAR VARIABLES DE SESION
    mysqli_query($link,"update users set nombre='$nombre',correo='$correo',pass='$pass',telefono='$telefono' where id_user=$id_u");
        /*$_SESSION['id']=$row['id_user'];//En teoria no cambia
        $_SESSION['nombre']=$nombre; 
        $_SESSION['username']=$usu; //Variables de sesion
        $_SESSION['tipoUsuario']=1; //En teoria no cambia*/
        header("Location:body-datos.php");
}else{
    $categorias=array("Vehículos","Tecnología","Electrodomésticos",'Hogar y muebles','Moda y complementos' ,"Deportes y Fitness","Herramientas y construcción" ,"Industria y oficina","Juegos y juguetes" ,"Bebés","Salud y Belleza" ,"Arte y antigüedades" ,"Libros y comics","Coleccionables","Otros");
    $cat=$_REQUEST['categoria'];
    foreach ($categorias as &$valor) {
        if(strpos($valor,$cat)!== false){
            $cate=$valor; 
        }
    }
    $tit=$_REQUEST['nombre'];
    $des=$_REQUEST['descripcion'];
    $tit_cam=$_REQUEST['titulo_cambio'];
    $des_cam=$_REQUEST['descripcion_cambio'];
    $est=$_REQUEST['estado'];
    $mun=$_REQUEST['municipio'];
    $ca_num=$_REQUEST['calle'];
    $ref=$_REQUEST['referencia'];
    if(isset($_REQUEST['id'])){//modifica producto
        $id_p=$_REQUEST['id'];
        mysqli_query($link,"Update productos set categoria='$cate',nombre='$tit',descripcion='$des',titulo_cambio='$tit_cam',descripcion_cambio='$des_cam',estado='$est',municipio='$mun',calle_y_numero='$ca_num',referencias='$ref' where id_producto=$id_p");
        //imagen
        $result=mysqli_query($link,"select id_user from productos where id_producto=$id_p");
        $row=mysqli_fetch_array($result);
        $id_user=$row['id_user'];
        $result=mysqli_query($link,"select count(*) total from imagenes where id_producto=$id_p");
        $row=mysqli_fetch_assoc($result);
        $num_img=$row['total']+1;
        $imgExt = strtolower(pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));
        $imgNombre=$id_user.$id_p.$num_img.'.'.$imgExt;
        $fichero_subido = '../images/productos/'. basename($imgNombre);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $fichero_subido)) {
            echo "Se subio";
            mysqli_query($link,"insert into Imagenes(id_producto,id_user,nombre)values($id_p,$id_user,'$imgNombre')");
        }
        mysqli_free_result($result);
    }else if(isset($_REQUEST['id_user'])){//agregar producto
        $id_user=$_REQUEST['id_user'];
        $fecha=date("Y-m-d");
        mysqli_query($link,"insert into productos(id_user,categoria,nombre,descripcion,titulo_cambio,descripcion_cambio,estado,municipio,calle_y_numero,referencias,fecha) values($id_user,'$cate','$tit','$des','$tit_cam','$des_cam','$est','$mun','$ca_num','$ref','$fecha')");
        //imagenes
        $result=mysqli_query($link,"select * from productos order by id_producto desc limit 1");
        $row=mysqli_fetch_array($result);
        $id_p=intval($row['id_producto']);//id_producto
        $cantidad=count($_FILES['image']['tmp_name']);
        for ($i=0; $i <$cantidad; $i++) { 
            $result=mysqli_query($link,"select count(*) total from imagenes where id_producto=$id_p");
            $row=mysqli_fetch_assoc($result);
            $num_img=$row['total']+1;
            $imgExt = strtolower(pathinfo($_FILES['image']['name'][$i],PATHINFO_EXTENSION));
            $imgNombre=$id_user.$id_p.$num_img.'.'.$imgExt;
            $fichero_subido = '../images/productos/'. basename($imgNombre);
            if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $fichero_subido)) {
                mysqli_query($link,"insert into Imagenes(id_producto,id_user,nombre)values($id_p,$id_user,'$imgNombre')");
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
    if(isset($_GET['u'])){
        $id_p= $_GET['id_p'];
        header("Location:producto-individual.php?id=$id_p");
    }else
        header("Location:body-productos.php");
}
?>
</body>
</html>