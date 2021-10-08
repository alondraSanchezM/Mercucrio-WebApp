<?php          
require_once '../head.php';
?>


<body>
    <?php  session_start();           
    if(!$_SESSION['username'] || $_SESSION['tipoUsuario']!=1) header("Location:index.php");
    require_once 'header-cliente.php';
    ?>
    <main class="principal">

        <div class="d-flex align-items-center justify-content-around">
            <hr class="linea-izq">
            <p class="titulos-espacios">Mis Intercambios</p>
            <hr class="linea-der">

        </div>

        <?php
            $link=mysqli_connect("localhost","root","");
            mysqli_select_db($link,"mercurioDB");
            $id=intval($_SESSION['id']);
            $result=mysqli_query($link,"select * from productos where id_user=$id and status!=2");//Productos del usuario
            echo "<div class='d-flex  flex-column  align-items-center justify-content-around clientes-registrados-container'>";
                while($row=mysqli_fetch_array($result)){
                    $id_pr=$row['id_producto'];
                    $nom_pr=$row['nombre'];
                    $ima_pr=$id.$id_pr.'.jpg';
                    $desp_pr=$row['descripcion'];
                    $result2=mysqli_query($link,"select * from solicitudes where producto_solicitante=$id_pr and status=1");
                    while($row2=mysqli_fetch_array($result2)){
                        echo "<div class='clientes-registrados card-borde'>";
                            $id_A=$row2['producto_solicitado'];
                            $prod_solicitado=mysqli_query($link,"select * from productos where id_producto=$id_A");
                            $rowA=mysqli_fetch_array($prod_solicitado);
                            $nom_A=$rowA['nombre'];
                            $id_u_A=$rowA['id_user'];
                            $imA=$id_u_A.$id_A.'.jpg';
                            $desp_A=$rowA['descripcion'];
                        echo "</div>";
                    }
                    $result2=mysqli_query($link,"select * from solicitudes where producto_solicitado=$id_pr and status=1");
                    while($row2=mysqli_fetch_array($result2)){
                        echo "<div class='clientes-registrados card-borde'>";
                            $id_B=$row2['producto_solicitante'];
                            $prod_solicitante=mysqli_query($link,"select * from productos where id_producto=$id_B");
                            $rowB=mysqli_fetch_array($prod_solicitante);
                            $nom_B=$rowB['nombre'];
                            $id_u_B=$rowB['id_user'];
                            $imB=$id_u_B.$id_B.'.jpg';
                            $desp_B=$rowB['descripcion'];
                        echo "</div>";
                    }
                }
            echo "</div>";
        ?>

    </main>

<?php          
    require_once '../footer.php';
?>


</body>

</html>