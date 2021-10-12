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
            <p class="titulos-espacios">Mis Intercambios</p>
            <hr class="linea-der">
        </div>

        <?php
            $link=mysqli_connect("localhost","root","");
            mysqli_select_db($link,"mercurioDB");
            $link->set_charset("utf8");
            $id=intval($_SESSION['id']);
            echo "<div class='d-flex  flex-column  align-items-center justify-content-around clientes-registrados-container'>";
            $result=mysqli_query($link,"select id_solicitud from intercambios");
            while($row=mysqli_fetch_array($result)){//Recorre todos los intercambios
                $solicitudes=mysqli_query($link, "select * from solicitudes where id_solicitud=$row[id_solicitud]");//Recupera la solicitud
                $solicitudes=mysqli_fetch_array($solicitudes);
                $solicitado=$solicitudes['producto_solicitado'];//id_producto solicitado
                $solicitante=$solicitudes['producto_solicitante'];//id_producto solicitante
                
                $producto_solicitado=mysqli_query($link, "select * from productos where id_producto=$solicitado");//Producto solicitado
                $producto_solicitado=mysqli_fetch_array($producto_solicitado);
                $us_solicitado=$producto_solicitado['id_user'];

                $producto_solicitante=mysqli_query($link, "select * from productos where id_producto=$solicitante");//Producto solicitante
                $producto_solicitante=mysqli_fetch_array($producto_solicitante);
                $us_solicitante=$producto_solicitante['id_user'];
                
                if($us_solicitado==$id || $us_solicitante==$id){
                        echo "<div class='clientes-registrados card-borde'>";
                        //Datos producto solitado
                        $id_solicitado=$producto_solicitado['id_producto'];
                        $nom_solicitado=$producto_solicitado['nombre'];
                        $ima_solicitado=$us_solicitado.$id_solicitado.'.jpg';
                        $desp_solicitado=$producto_solicitado['descripcion'];
                        echo "<div class='d-flex  flex-row align-self-start'> <img  class='card-intercambios-imagen' src='../images/productos/$ima_solicitado' >";
                        echo "<div class='d-flex  flex-column card-intercambios-texto align-self-start'> <p class='card-intercambios-titulo'>$nom_solicitado</p>  <p class='card-intercambios-descripcion'>$desp_solicitado</p> </div> ";
                        echo "<div class='card-intercambios-espacio'> <button class='card-intercambios-boton card-borde' name='enviar' > Información del intercambio </button>";
                        echo "</div>";
                        //Datos producto solicitante
                        $id_solicitante=$producto_solicitante['id_producto'];
                        $nom_solicitante=$producto_solicitante['nombre'];
                        $ima_solicitante=$us_solicitante.$id_solicitante.'.jpg';
                        $desp_solicitante=$producto_solicitante['descripcion'];
                        echo "<div class='d-flex  flex-row align-self-end'> ";
                        echo "<div class='d-flex  flex-column card-intercambios-texto align-self-start'> <p class='card-intercambios-titulo alineamiento-izq'>$nom_solicitante</p>  <p class='alineamiento-izq card-intercambios-descripcion'>$desp_solicitante</p> </div> ";
                        echo " <img  class='card-intercambios-imagen' src='../images/productos/$ima_solicitante' /> </div> </div>";
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