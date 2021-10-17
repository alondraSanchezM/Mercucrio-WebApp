<?php session_start();       
    if(!$_SESSION['username'] || $_SESSION['tipoUsuario']!=1) header("Location:../index.php");
    $subCarp="../";
    require_once '../head.php';
    echo "<body>";
    require_once 'header-cliente.php';
?>
<?php
    if (isset($_GET['delete_id'])) {//Borrar producto
        $delete_id = (int) $_GET['delete_id'];
        echo "AQUI";
        $link=mysqli_connect("localhost","root","");
        mysqli_select_db($link,"mercurioDB");
        $link->set_charset("utf8");

        mysqli_query($link,"delete from solicitudes where producto_solicitado=$delete_id || producto_solicitante=$delete_id");
        mysqli_query($link,"delete from imagenes where id_producto=$delete_id");
        mysqli_query($link,"delete from productos where id_producto=$delete_id");
        header("Location:body-productos.php");
    }elseif(isset($_GET['id'])){
        $id_p=$_GET["id"];
        $link=mysqli_connect("localhost","root","");
        mysqli_select_db($link,"mercurioDB");
        $link->set_charset("utf8");
        //Imagenes
        $result=mysqli_query($link,"select * from imagenes where id_producto=$id_p");
        while ($row=mysqli_fetch_array($result)) {
            $ima=$row['nombre'].'.jpg';
            echo"<img  class='card-mis-productos-imagen' src='../images/productos/$ima'>";
        }
        //Informacion
        $result=mysqli_query($link,"select * from productos where id_producto=$id_p");
        $row=mysqli_fetch_array($result);
        $nom=$row['nombre'];
        $desp=$row['descripcion'];
        $tit_cambio=$row['titulo_cambio'];
        $des_cambio=$row['descripcion_cambio'];
        
        echo "<br><br>$nom <br>";
        echo "$desp <br>";
        echo "<br>A CAMBIO:<br>";
        echo "$tit_cambio <br>";
        echo "$des_cambio <br>";
        
        echo "<button name='button-Elimina' onclick=location.href='?delete_id=$id_p' >Elimina</button>";
        echo "<button name='button-Modifica' onclick=location.href='modifica-producto.php?id=$id_p' >Modifica</button>";
        
    }else{//No se le pasa el id.
        header("Location:body-productos.php");
    }
    
?> 


<?php          
    require_once '../footer.php';
?>

</body>
</html>