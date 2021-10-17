<?php session_start();       
    if(!$_SESSION['username'] || $_SESSION['tipoUsuario']!=1) header("Location:../index.php");
    $subCarp="../";
    require_once '../head.php';
    echo "<body>";
    require_once 'header-cliente.php';
?>

    <?php
        if(isset($_GET['id'])){
            $categorias=array("Vehículos","Tecnología","Electrodomésticos","Hogar y muebles","Moda y complementos" ,"Deportes y fitness","Herramientas y construcción" ,"Industria y oficina","Juegos y juguetes" ,"Bebés","Salud y belleza" ,"Arte y antigüedades" ,"Libros y comics","Coleccionables","Otros");
            $id_p=$_GET["id"];
            //echo $id_p;
            $link=mysqli_connect("localhost","root","");
            mysqli_select_db($link,"mercurioDB");
            $link->set_charset("utf8");
            //Informacion
            $result=mysqli_query($link,"select * from productos where id_producto=$id_p");
            $row=mysqli_fetch_array($result);
            $cat=$row['categoria'];
            $tit=$row['nombre'];
            $des=$row['descripcion'];
            $tit_cambio=$row['titulo_cambio'];
            $des_cambio=$row['descripcion_cambio'];
            $est=$row['estado'];
            $mun=$row['municipio'];
            $ca_num=$row['calle_y_numero'];
            $ref=$row['referencias'];
            echo "<form action='actualiza.php' method='POST'>";
                
            echo "<h3>INFORMACIÓN GENERAL</h3>";
                echo "<label for='select'>Categoría</label><br>";
                echo"<select name='categoria' required>";
                foreach ($categorias as &$valor) {
                    if(strcmp($valor, $cat) == 0){
                        echo "<option selected value=$cat>$cat</option>"; 
                    }else{
                        echo"<option value=$valor>$valor</option>";
                    }
                }
                echo "</select>";
                echo "<br>Título (máx 30 carácteres):<br> <INPUT TYPE='text' NAME='nombre' value='$tit' SIZE='25'><br>";
                echo "<br>Descripción del producto:<br> <TEXTAREA COLS='50' ROWS='7' NAME='descripcion'>$des</TEXTAREA><br>";
                
                echo "<h3>¿QUÉ TE GUSTARÍA A CAMBIO?</h3>";
                echo "<br>Título:<br> <INPUT TYPE='text' NAME='titulo_cambio' value='$tit_cambio' SIZE='25' required><br>";
                echo "<br>Descripción:<br> <TEXTAREA COLS='50' ROWS='4' NAME='descripcion_cambio' required>$des_cambio</TEXTAREA><br>";
                
                echo "<h3>UBICACIÓN DEL INTERCAMBIO</h3>";
                echo "<br>Estado:<br> <INPUT TYPE='text' NAME='estado' value='$est' SIZE='25' required><br>";
                echo "<br>Municipio:<br> <INPUT TYPE='text' NAME='municipio' value='$mun' SIZE='25' required><br>";
                echo "<br>Calle y número:<br> <INPUT TYPE='text' NAME='calle' value='$ca_num' SIZE='25' required><br>";
                echo "<br>Referencias:<br> <TEXTAREA COLS='50' ROWS='4' NAME='referencia'>$ref</TEXTAREA><br>";
                echo "<input type='hidden' name='id' value='$id_p'>";
                echo "<INPUT TYPE='SUBMIT' value='Actualizar'>";
            echo "</form>";
            //Imagenes
            /*$result=mysqli_query($link,"select * from imagenes where id_producto=$id_p");
            echo "<h3>IMÁGENES</h3>";
            while ($row=mysqli_fetch_array($result)) {
                $ima=$row['nombre'].'.jpg';
                echo"<img  class='card-mis-productos-imagen' src='../images/productos/$ima'>";
            }*/
        }else{//No se le pasa el id.
            header("Location:body-productos.php");
        }
    ?>


<?php          
    require_once '../footer.php';
?>

</body>
</html>