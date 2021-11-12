<?php
    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"mercurioDB");
    $link->set_charset("utf8");
    if(isset($_GET['cancela'])){
        echo "Solicitud cancelada <br>";
        echo $_GET['cancela'];
        $id_sol=$_GET['cancela'];
        mysqli_query($link,"delete from solicitudes where id_solicitud=$id_sol");
        header("Location:body-solicitudes.php");
    }else if(isset($_GET['acepta'])){
        echo "Solicitud aceptada<br>";
        $id_sol=$_GET['acepta'];
        $result=mysqli_query($link,"select * from solicitudes where id_solicitud=$id_sol");
        $row=mysqli_fetch_array($result);
        $producto_solicitado=$row['producto_solicitado'];
        $producto_solicitante=$row['producto_solicitante'];
        //producto solicitado
        $solicitado=mysqli_query($link,"select id_user from productos where id_producto=$producto_solicitado");
        $row=mysqli_fetch_array($solicitado);
        $id_solicitado=$row['id_user'];
        //producto solicitante
        $solicitante=mysqli_query($link,"select id_user from productos where id_producto=$producto_solicitante");
        $row2=mysqli_fetch_array($solicitante);
        $id_solicitante=$row2['id_user'];
        $fecha=date("Y-m-d");
        mysqli_query($link,"CALL aceptarIntercambio($producto_solicitante,$producto_solicitado,$id_sol,$id_solicitado,$id_solicitante,'$fecha')"); 

        header("Location:body-intercambios.php");
    }else if(isset($_GET['declina'])){
        echo "Solicitud declinada<br>";
        $id_sol=$_GET['declina'];
        mysqli_query($link,"update solicitudes set status=2 where id_solicitud=$id_sol");
        header("Location:body-solicitudes.php");
    }else{
        echo "Entra a la página";
    }
?>