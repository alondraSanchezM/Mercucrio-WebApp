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
                        echo "<div class=' d-flex   justify-content-evenly align-content-center card-intercambios card-borde'>";
                        //Datos producto solicitado
                        $id_solicitado=$producto_solicitado['id_producto'];
                        $nom_solicitado=$producto_solicitado['nombre'];
                        $imagen=mysqli_query($link,"select nombre from imagenes where id_producto=$id_solicitado limit 1");
                        $imagen=mysqli_fetch_array($imagen);
                        $ima_solicitado=$imagen['nombre'];
                        $desp_solicitado=$producto_solicitado['descripcion'];
                        echo "<div class='d-flex  flex-row align-self-start'> <img  class='card-intercambios-imagen' src='../images/productos/$ima_solicitado' >";
                        echo "<div class='d-flex  flex-column card-intercambios-texto justify-self-start'> <p class='card-intercambios-titulo'>$nom_solicitado</p>  <p class='card-intercambios-descripcion'>$desp_solicitado</p> </div></div> ";
                        echo "<div class='card-intercambios-espacio d-flex  flex-row align-self-center'> <button class='card-intercambios-boton card-borde' name='enviar' > Información del intercambio </button>";
                        echo "</div>";
                        //Datos producto solicitante
                        $id_solicitante=$producto_solicitante['id_producto'];
                        $nom_solicitante=$producto_solicitante['nombre'];
                        $imagen=mysqli_query($link,"select nombre from imagenes where id_producto=$id_solicitante limit 1");
                        $imagen=mysqli_fetch_array($imagen);
                        $ima_solicitante=$imagen['nombre'];
                        $desp_solicitante=$producto_solicitante['descripcion'];
                        echo "<div class='d-flex  flex-row justify-self-end'> ";
                        echo "<div class='d-flex  flex-column card-intercambios-texto justify-self-start'> <p class='card-intercambios-titulo alineamiento-izq'>$nom_solicitante</p>  <p class='alineamiento-izq card-intercambios-descripcion'>$desp_solicitante</p> </div> ";
                        echo " <img  class='card-intercambios-imagen' src='../images/productos/$ima_solicitante' /> </div> </div>";
                        //Datos del intercambio o sea del producto solicitado y por ende el dueño del producto solicitado
                        $calle_y_num=$producto_solicitado['calle_y_numero'];
                        $municipio=$producto_solicitado['municipio'];
                        $estado=$producto_solicitado['estado'];
                        $referencia=$producto_solicitado['referencias'];
                        $user=mysqli_query($link,"select * from users where id_user=$us_solicitado");
                        $user=mysqli_fetch_array($user);
                        $nombre=$user['nombre'];
                        $numero=$user['telefono'];
                        $correo=$user['correo'];
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