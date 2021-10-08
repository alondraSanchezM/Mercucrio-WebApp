<?php session_start();
if (isset($_SESSION['tipoUsuario'])){
    if($_SESSION['tipoUsuario']==1) header("Location:cliente/body-principal.php");
    if($_SESSION['tipoUsuario']==0) header("Location:administrador/body-principal.php");
}
require_once 'head.php';
?>

<body>
    <?php          
    require_once 'header.php';
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
                            echo "<img  style='border-radius: 22px 22px 0 0' src='images/productos/$ima' width='250' height='227'/>";
                            $cat=strtoupper($cat);
                            echo "<br><b><font size= 0.9 rem>$cat</font></b>";
                            echo "<br><font size= 1.4 rem face='Malgun Gothic, Malgun Gothic'>$nom</front>";
                            echo"<br><img src='images/ubicacion.svg'</img> <font size= 1 rem face='Malgun Gothic, Malgun Gothic'>$mun, $est</font><br>";
                            echo "<font size= 1 rem face='Malgun Gothic Semilight, Malgun Gothic Semilight'> Publicado: $fech</font>";
                            echo "</div>";
                        }else{
                            echo"</div>";
                            echo "<div class='d-flex align-items-center justify-content-around ultimos-productos-container-fila'>";
                            echo "<div class='ultimos-productos card-borde'>";
                                echo "<img  style='border-radius: 22px 22px 0 0' src='../images/productos/$ima' width='250' height='227'/>";
                                $cat=strtoupper($cat);
                                echo "<br><b><font size= 0.9 rem>$cat</font></b>";
                                echo "<br><font size= 1.4 rem face='Malgun Gothic, Malgun Gothic'>$nom</front>";
                                echo"<br><img src='../images/ubicacion.svg'</img> <font size= 1 rem face='Malgun Gothic, Malgun Gothic'>$mun, $est</font><br>";
                                echo "<font size= 1 rem face='Malgun Gothic Semilight, Malgun Gothic Semilight'> Publicado: $fech</font>";
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
    require_once 'footerI.php';
    mysqli_free_result($result);
    mysqli_close($link);
?>


</body>

</html>