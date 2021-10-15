<?php session_start();       
    if(!$_SESSION['username'] || $_SESSION['tipoUsuario']!=0) header("Location:../index.php");
    $subCarp="../";
    require_once '../head.php';
    echo "<body>";
    require_once 'header-administrador.php';
?>
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
                    echo "<div class='clientes-registrados card-borde'>";
                    $id_p=$row['id_producto'];
                    $id_u=$row['id_user'];
                    $cat=$row['categoria'];
                    $nom=$row['nombre'];
                    $est=$row['estado'];
                    $mun=$row['municipio'];
                    $fecha=$row['fecha'];
                    $ima=$id_u.$id_p.'.jpg';
                    $desp=$row['descripcion'];

                    echo "<div class='d-flex  flex-row align-self-start'> <img  class='card-mis-productos-imagen' src='../images/productos/$ima' >";
                    echo "<div class='d-flex  flex-column card-mis-productos-texto align-self-start'> <p class='card-mis-productos-titulo'>$nom</p>  <p class='card-mis-productos-descripcion'>$desp</p> </div> ";
                    echo "<div class='d-flex  flex-column card-mis-productos-datos-finales col align-self-end' > <p class='card-mis-productos-categoria'>$cat</p> ";
                    echo "<div  class='d-flex  flex-row align-self-end'><img class='card-mis-productos-ubicacion' src='".$subCarp."images/ubicacion.svg'> <p  class='card-mis-productos-ubicacion'>$mun, $est</p></div> ";                    
                    echo "<p  class='card-mis-productos-fecha col align-self-end'> Publicado: $fecha</p> </div></div></div> ";
                    //echo "<div class='d-flex  flex-row align-self-start'> <img  class='card-intercambios-imagen' src='../images/trash.svg'>";
                }
            echo "</div>";
        ?>

    </main>
<?php          
    require_once '../footer.php';
?>

</body>
</html>