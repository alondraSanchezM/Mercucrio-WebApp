<?php          
require_once '../head.php';
?>


<body>
    <?php session_start();   
    if(!$_SESSION['username'] || $_SESSION['tipoUsuario']!=1) header("Location:../index.php");
    require_once 'header-cliente.php';
    ?>
    <main class="principal">
        <div class="d-flex align-items-center justify-content-around">
            <hr class="linea-izq">
            <p class="titulos-espacios">Últimos productos</p>
            <hr class="linea-der">
        </div>
        <?php
            $link=mysqli_connect("localhost","root","");
            mysqli_select_db($link,"mercurioDB");
            $result=mysqli_query($link,"select * from Productos where status='0'");
            echo "<div class='d-flex  flex-column  align-items-center justify-content-around ultimos-productos-container'>";
                echo "<div class='d-flex align-items-center justify-content-around ultimos-productos-container-fila'>";
                    $num=0;
                    while($row=mysqli_fetch_array($result)){ 
                        $id_p=$row['id_producto'];
                        $id_u=$row['id_user'];
                        $cat=$row['categoria'];
                        $nom=$row['nombre'];
                        $est=$row['estado'];
                        $mun=$row['municipio'];
                        $fech=$row['fecha'];
                        $ima=$id_u.$id_p.'.jpg';
                        if($num<5){
                            echo "<div class='ultimos-productos card-borde'>";
                                echo "<img  style='border-radius: 22px 22px 0 0' src='../images/productos/$ima' width='250' height='227'/>";
                            echo "</div>";
                        }else{
                            echo"</div>";
                            echo "<div class='d-flex align-items-center justify-content-around ultimos-productos-container-fila'>";
                            echo "<div class='ultimos-productos card-borde'>";
                                echo "<img  style='border-radius: 22px 22px 0 0' src='../images/productos/$ima' width='250' height='227'/>";
                             echo "</div>";
                            $num=0;
                        }
                        $num++;
                    }
                echo"</div>";
            echo"</div>";
        ?>

    </main>

<?php          
    require_once '../footer.php';
?>


</body>

</html>