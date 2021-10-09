<?php session_start();       
    if(!$_SESSION['username'] || $_SESSION['tipoUsuario']!=1) header("Location:../index.php");
    $subCarp="../";
    require_once '../head.php';
    echo "<body>";
    require_once 'header-cliente.php';
?>
    <main class="principal">

        <div class="d-flex align-items-center justify-content-around">
            <hr class="linea-izq">
            <p class="titulos-espacios">Mis Productos</p>
            <hr class="linea-der">

        </div>

        <?php
            $link=mysqli_connect("localhost","root","");
            mysqli_select_db($link,"mercurioDB");
            $id=intval($_SESSION['id']);
            $result=mysqli_query($link,"select * from productos where id_user=$id");
            echo "<div class='d-flex  flex-column  align-items-center justify-content-around clientes-registrados-container'>";
                while($row=mysqli_fetch_array($result)){
                    echo "<div class='clientes-registrados card-borde'>";
                    $id_p=$row['id_producto'];
                    $ima=$id.$id_p.'.jpg';
                    $nom=$row['nombre'];
                    $cat=$row['categoria'];
                    $est=$row['estado'];
                    $mun=$row['municipio'];
                    $fecha=$row['fecha'];
                    $desp=$row['descripcion'];
                    echo "<br><img  src='../images/productos/$ima' width='50' height='57'/>";
                    echo "</div> ";
                }
            echo "</div>";
        ?>

    </main>

<?php          
    require_once '../footer.php';
?>


</body>

</html>