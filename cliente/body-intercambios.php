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
            $counts=0;
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
                        
                        $id_solicitante=$producto_solicitante['id_producto'];
                        echo "<div class='d-flex  flex-row align-self-start'> <img  class='card-intercambios-imagen' src='../images/productos/$ima_solicitado' >";
                        echo "<div class='d-flex  flex-column card-intercambios-texto justify-self-start'> <p class='card-intercambios-titulo'>$nom_solicitado</p>  <p class='card-intercambios-descripcion'>$desp_solicitado</p> </div></div> ";
                        echo "<div class='card-intercambios-espacio d-flex  flex-row align-self-center'> <button type='button'  class='card-intercambios-boton card-borde' data-bs-toggle='modal' data-bs-target='#p$counts$id_solicitante'> Información del intercambio </button>";
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
                        echo "
                        <div class='modal fade' id='p$counts$id_solicitante' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-lg'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                    <h5 class='modal-intercambios-titulo' id='exampleModalLabel'>Información del trueque</h5>
                                    <button type='button' class='btn-close datos-cuenta-info-texto' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                    <div class='row'>
                                        <div class='col-6'>
                                            <p class='modal-intercambios-info-titulo'>Ubicación</p>
                                            <p class='modal-intercambios-info-text'>$calle_y_num </p>
                                            <p class='modal-intercambios-info-text'>$municipio, $estado </p>
                                            <p class='modal-intercambios-info-text'>$referencia </p>
                                        </div>
                                        <div class='col-6'>
                                        <p class='modal-intercambios-info-titulo'>Datos de contacto</p>
                                        <p class='modal-intercambios-info-text'>$nombre </p>
                                        <p class='modal-intercambios-info-text'>$numero </p>
                                        <p class='modal-intercambios-info-text'>$correo </p>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            ";
                    }
                    $counts++;
            }
            echo "</div>";
        ?>

    </main>

<?php          
    require_once '../footer.php';
?>

</body>

</html>