<?php
    $categorias=array("Vehículos","Tecnología","Electrodomésticos",'Hogar y muebles','Moda y complementos' ,"Deportes y Fitness","Herramientas y construcción" ,"Industria y oficina","Juegos y juguetes" ,"Bebés","Salud y Belleza" ,"Arte y antigüedades" ,"Libros y comics","Coleccionables","Otros");
    $id=$_REQUEST['id'];
    $cat=$_REQUEST['categoria'];
    foreach ($categorias as &$valor) {
        if(strpos($valor,$cat)!== false){
            $cate=$valor; 
        }
    }
    $tit=$_REQUEST['nombre'];
    $des=$_REQUEST['descripcion'];
    $tit_cam=$_REQUEST['titulo_cambio'];
    $des_cambio=$_REQUEST['descripcion_cambio'];
    $est=$_REQUEST['estado'];
    $mun=$_REQUEST['municipio'];
    $ca_num=$_REQUEST['calle'];
    $ref=$_REQUEST['referencia'];
    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"mercurioDB");
    $link->set_charset("utf8");
    mysqli_query($link,"Update productos set categoria='$cate',nombre='$tit',descripcion='$des',titulo_cambio='$tit_cam',descripcion_cambio='$des_cambio',estado='$est',municipio='$mun',calle_y_numero='$ca_num',referencias='$ref' where id_producto=$id");
    header("Location:body-productos.php");
?>
</body>
</html>