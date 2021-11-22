<?php
    if(isset($_SESSION['id'])) $user=$_SESSION['id'];else $user='0';
    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"mercurioDB");
    $link->set_charset("utf8");
    if(isset($_GET['categoria'])){
        $categoria=$_GET['categoria'];
        $result=mysqli_query($link,"select * from Productos where status='0' and categoria='$categoria'");
    }else{
        $result=mysqli_query($link,"select * from Productos where status='0' ORDER BY fecha DESC");
    }
    echo "<div class='grid-productos'>";
        while($row=mysqli_fetch_array($result)){ 
            $id_p=$row['id_producto'];
            $id_u=$row['id_user'];
            $cat=$row['categoria'];
            $nom=$row['nombre'];
            $est=$row['estado'];
            $mun=$row['municipio'];
            $fech=$row['fecha'];
            
            $imagen=mysqli_query($link,"select nombre from imagenes where id_producto=$id_p limit 1");
            $imagen=mysqli_fetch_array($imagen);
            $ima=$imagen['nombre'];
            echo "<div class='align-items-center justify-content-center ultimos-productos-container-grid'>";
                echo "<div class='ultimos-productos card-borde'>";
                    if($user!=0) {
                        echo "<a href='producto-individual.php?id={$row['id_producto']}'>";
                    }else{
                        echo "<a href='login.php?id_p={$row['id_producto']}'>";
                    }
                    echo "<img  class='card-imagen' src='".$subCarp."images/productos/$ima'>";
                    echo "<p class='card-categoria'>$cat</p>";
                    echo "<p  class='card-titulo'>$nom</p>";
                    echo"<div class='d-flex  flex-row'><img class='card-ubicacion' src='".$subCarp."images/ubicacion.svg'> <p  class='card-ubicacion'>$mun, $est</p>";
                        echo "<p  class='card-fecha col align-self-end'> Publicado: $fech</p></div>";
                echo "</a></div>";  
            echo "</div>";
    
        
        }
    echo"</div>";
?>