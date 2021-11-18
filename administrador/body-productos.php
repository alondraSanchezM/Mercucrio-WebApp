<?php session_start();       
    if(!$_SESSION['username'] || $_SESSION['tipoUsuario']!=0) header("Location:../index.php");
    $subCarp="../";
    require_once '../head.php';
    echo "<body>";
    require_once 'header-administrador.php';
?>

<?php
    //Handle delete
    if (isset($_GET['delete_id'])) {
        $delete_id = (int) $_GET['delete_id'];
    
        $link=mysqli_connect("localhost","root","");
        mysqli_select_db($link,"mercurioDB");
        $link->set_charset("utf8");

        //Eliminar producto
        mysqli_query($link,"DELETE FROM productos WHERE id_producto = '$delete_id' AND status = 0"); 
        //Eliminar solicitud donde el producto eliminado este solicitado
        mysqli_query($link,"DELETE FROM solicitudes WHERE producto_solicitado = '$delete_id' OR producto_solicitante = '$delete_id'"); 
        //Eliminar las imagenes del producto 
        mysqli_query($link,"DELETE FROM imagenes WHERE id_producto = '$delete_id'"); 
    }
?>

<script LANGUAGE="JavaScript">
    function confirmSubmit(){
        var eli=confirm("¿Está seguro de eliminar este producto?");
        if (eli) return true ;
        else return false ;
    }
</script>

    <main class="principal">

        <div class="d-flex align-items-center justify-content-around">
            <hr class="linea-izq">
            <p class="titulos-espacios">Productos</p>
            <hr class="linea-der">

        </div>

        <?php
            $link=mysqli_connect("localhost","root","");
            mysqli_select_db($link,"mercurioDB");
            $link->set_charset("utf8");
            $result=mysqli_query($link,"select * from productos");
            echo "<div class='d-flex  flex-column  align-items-center justify-content-around clientes-registrados-container'>";
                while($row=mysqli_fetch_array($result)){
                    echo "<div class='contenedor-administrador-cl-pr d-flex flex-row' ><div class='card-administrador-cl-pr card-borde'>";
                    $id_p=$row['id_producto'];
                    $id_u=$row['id_user'];
                    $cat=$row['categoria'];
                    $nom=$row['nombre'];
                    $est=$row['estado'];
                    $mun=$row['municipio'];
                    $fecha=$row['fecha'];
                    $desp=$row['descripcion'];
                    $result2=mysqli_query($link,"select * from imagenes where id_producto=$id_p limit 1"); 
                    $row2=mysqli_fetch_array($result2);
                    $ima=$row2['nombre'];
                    echo "<div class='d-flex  flex-row justify-content-between'> <img  class='card-mis-productos-imagen' src='../images/productos/$ima' >";
                    echo "<div class='d-flex  flex-column card-mis-productos-texto align-self-start'> <p class='card-mis-productos-titulo'>$nom</p>  <p class='card-mis-productos-descripcion'>$desp</p> </div> ";
                    echo "<div class='d-flex  flex-column card-mis-productos-datos-finales col ' > <p class='card-mis-productos-categoria'>$cat</p> ";
                    echo "<div  class='d-flex  flex-row align-self-end'><img class='card-mis-productos-ubicacion' src='".$subCarp."images/ubicacion.svg'> <p  class='card-mis-productos-ubicacion'>$mun, $est</p></div> ";                    
                    echo "<p  class='card-mis-productos-fecha col align-self-end'> Publicado: $fecha</p> </div></div></div>";
                    echo "<div class='d-flex  flex-row align-self-start'><a onclick=\"return confirmSubmit()\"href=\"?delete_id={$row['id_producto']}\"><img  class='card-intercambios-imagen' src='../images/trash.svg'></a></div> ";
                    echo "</div>";
                }
            echo "</div>";
        ?>

    </main>
    
<?php          
    require_once '../footer.php';
?>

</body>
</html>