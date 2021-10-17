<?php session_start();       
    if(!$_SESSION['username'] || $_SESSION['tipoUsuario']!=1) header("Location:../index.php");
    $subCarp="../";
    require_once '../head.php';
    echo "<body>";
    require_once 'header-cliente.php';
?>
<?php
    $id=$_REQUEST['id'];
    $cat=$_REQUEST['categoria'];
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
    mysqli_query($link,"Update productos set categoria='$cat',nombre='$tit',descripcion='$des',titulo_cambio='$tit_cam',descripcion_cambio='$des_cambio',estado='$est',municipio='$mun',calle_y_numero='$ca_num',referencias='$ref' where id_producto=$id");
    header("Location:body-productos.php");
?>
<?php          
    require_once '../footer.php';
?>

</body>
</html>