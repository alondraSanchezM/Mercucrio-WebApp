<?php
    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"mercurioDB");
    $link->set_charset("utf8");
    $result=mysqli_query($link,"select * from Productos where status='0'");
    echo "<div class='grid-productos'>";
        while($row=mysqli_fetch_array($result)){ 
            $id_p=$row['id_producto'];
            $id_u=$row['id_user'];
            $cat=$row['categoria'];
            $nom=$row['nombre'];
            $est=$row['estado'];
            $mun=$row['municipio'];
            $fech=$row['fecha'];
            $ima=$id_u.$id_p.'.jpg';
            echo "<div class='align-items-center justify-content-center ultimos-productos-container-grid'>";
            echo "<div class='ultimos-productos card-borde'>";
            echo "<img  class='card-imagen' src='".$subCarp."images/productos/$ima'>";
            
            echo "<p class='card-categoria'>$cat</p>";
            echo "<p  class='card-titulo'>$nom</p>";
            echo"<div class='d-flex  flex-row'><img class='card-ubicacion' src='".$subCarp."images/ubicacion.svg'> <p  class='card-ubicacion'>$mun, $est</p>";
            echo "<p  class='card-fecha col align-self-end'> Publicado: $fech</p></div>";
            echo "</div>";  
            echo "</div>";
    
        
        }
    echo"</div>";
?>