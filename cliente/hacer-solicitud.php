<?php session_start();   
    ob_start();
    if(isset($_GET['id'])){
        $producto_solicitado=$_GET["id"];
        $link=mysqli_connect("localhost","root","");
        mysqli_select_db($link,"mercurioDB");
        $link->set_charset("utf8");
        $producto_solicitante=$_REQUEST['producto_cambio'];
        $mensaje= $_REQUEST['mensaje'];
        $fecha=date("Y-m-d");
        mysqli_query($link,"insert into solicitudes(producto_solicitado,producto_solicitante,mensaje,fecha)values($producto_solicitado,$producto_solicitante,'$mensaje','$fecha')");
    }
    header("Location:./body-solicitudes.php");
    ob_end_flush();
?>