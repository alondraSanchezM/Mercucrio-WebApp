<?php session_start();       
    if(!$_SESSION['username'] || $_SESSION['tipoUsuario']!=1) header("Location:../index.php");
    
    
        $delete_id = (int) $_GET['delete_id'];
        //echo "AQUI";
        $link=mysqli_connect("localhost","root","");
        mysqli_select_db($link,"mercurioDB");
        $link->set_charset("utf8");
        //echo $delete_id;
        mysqli_query($link,"delete from solicitudes where producto_solicitado=$delete_id || producto_solicitante=$delete_id");
        mysqli_query($link,"delete from imagenes where id_producto=$delete_id");
        mysqli_query($link,"delete from productos where id_producto=$delete_id");
        header("Location:body-productos.php");
?>