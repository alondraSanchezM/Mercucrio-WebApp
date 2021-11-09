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
            <p class="titulos-espacios">Mis Solicitudes</p>
            <hr class="linea-der">

        </div>
        <?php
            $link=mysqli_connect("localhost","root","");
            mysqli_select_db($link,"mercurioDB");
            $link->set_charset("utf8");
            $id=intval($_SESSION['id']);
            $result=mysqli_query($link,"select * from productos where id_user=$id and status!=2");//Productos no eliminados del usuario
            echo "<div class='d-flex  flex-column  align-items-center justify-content-around clientes-registrados-container'>";
            echo "<div class='container-solicitudes'> <div class='d-flex  flex-column align-content-between'>";
            echo "<h2 class='container-solicitudes-titulo'> Enviadas</h2>";

            while($row=mysqli_fetch_array($result)){
                //Solicitante B         Solicitado A
                $id_pr=$row['id_producto'];
                $nom_pr=$row['nombre'];
                //Enviadas 
                $result2=mysqli_query($link,"select * from solicitudes where producto_solicitante=$id_pr and status=0");//Solicitudes hechas
                while($row2=mysqli_fetch_array($result2)){
                    $id_sol=$row2['id_solicitud'];
                    echo "<div class='card-solicitudes d-flex flex-column justify-content-between card-borde'>";
                        //Solicitante
                        //$imB=$id.$id_pr.'.jpg';
                        $imagen=mysqli_query($link,"select nombre from imagenes where id_producto=$id_pr limit 1");
                        $imagen=mysqli_fetch_array($imagen);
                        $imB=$imagen['nombre'];
                        $men=$row2['mensaje'];
                        //Solicitado
                        $id_A=$row2['producto_solicitado'];
                        $prod_solicitado=mysqli_query($link,"select * from productos where id_producto=$id_A");
                        $rowA=mysqli_fetch_array($prod_solicitado);
                        $nom_A=$rowA['nombre'];
                        $id_u_A=$rowA['id_user'];
                        
                        $imagen=mysqli_query($link,"select nombre from imagenes where id_producto=$id_A limit 1");
                        $imagen=mysqli_fetch_array($imagen);
                        $imA=$imagen['nombre'];
                        //$imA=$id_u_A.$id_A.'.jpg';
                        $estA=$rowA['estado'];
                        $munA=$rowA['municipio'];

                    echo "<div class='d-flex  flex-row justify-content-between'>";

                    echo " <img  class='card-intercambios-imagen' src='../images/productos/$imB' >";
                    echo "<div class='d-flex  flex-column align-content-between justify-content-evenly'>";
                    echo "<p class='card-solicitudes-nombre'> $nom_pr </p>";
                    echo "<p class='card-solicitudes-nombre'> <-----------> </p>";
                    echo "<p class='card-solicitudes-nombre'> $nom_A </p>";
                    echo "</div>";
                    
                    echo " <img  class='card-intercambios-imagen' src='../images/productos/$imA' >";
                    echo "</div>";

                    echo " <div class='card-solicitudes-body '><div class='d-flex  flex-row justify-content-between '>";
                    echo " <p class='card-solicitudes-titulo'> Mensaje </p>";
                    echo "<div  class='d-flex  flex-row align-self-center '><img class='card-mis-productos-ubicacion' src='".$subCarp."images/ubicacion.svg'> <p  class='card-mis-productos-ubicacion'>$munA, $estA</p></div> ";    
                    echo "</div>";

                    echo "<p  class='card-solicitudes-mensaje'> $men </p>";
                    
                    echo "</div> <div class='card-solicitudes-body'>";  
                    echo "<div class=' d-flex  flex-row align-self-end justify-content-end'> <a class='card-solicitudes-boton card-borde' name='enviar' href='manejo-solicitud.php?cancela=$id_sol'> Cancelar </a> </div>";
                        
                    echo "</div></div>";



                }
            }
            echo "</div > <div class='d-flex  flex-column align-content-between justify-content-around '>";
            echo "<h2 class='container-solicitudes-titulo'> Recibidas</h2>";
            
            $result=mysqli_query($link,"select * from productos where id_user=$id and status!=2");//Productos no eliminados del usuario
            while($row=mysqli_fetch_array($result)){
                //Solicitante B         Solicitado A
                $id_pr=$row['id_producto'];
                $nom_pr=$row['nombre'];
                
                //Recibidas 
                $result2=mysqli_query($link,"select * from solicitudes where producto_solicitado=$id_pr and status=0");//Solicitudes recibidas
                while($row2=mysqli_fetch_array($result2)){
                    $id_sol=$row2['id_solicitud'];
                    echo "<div class='card-solicitudes d-flex flex-column justify-content-between card-borde'>";
                        //Solicitado
                        $imagen=mysqli_query($link,"select nombre from imagenes where id_producto=$id_pr limit 1");
                        $imagen=mysqli_fetch_array($imagen);
                        $imA=$imagen['nombre'];
                        //$imA=$id.$id_pr.'.jpg';
                        $estA=$row['estado'];
                        $munA=$row['municipio'];
                        //Solicitante
                        $id_B=$row2['producto_solicitante'];
                        $prod_solicitante=mysqli_query($link,"select * from productos where id_producto=$id_B");
                        $rowB=mysqli_fetch_array($prod_solicitante);
                        $nom_B=$rowB['nombre'];
                        $id_u_B=$rowB['id_user'];
                        $imagen=mysqli_query($link,"select nombre from imagenes where id_producto=$id_B limit 1");
                        $imagen=mysqli_fetch_array($imagen);
                        $imB=$imagen['nombre'];
                        //$imB=$id_u_B.$id_B.'.jpg';
                        $men=$row2['mensaje'];
                        
                    echo "<div class='d-flex  flex-row justify-content-between'>";
                    
                    echo " <img  class='card-intercambios-imagen' src='../images/productos/$imA' >";
                    echo "<div class='d-flex  flex-column align-content-between justify-content-evenly'>";
                    echo "<p class='card-solicitudes-nombre'> $nom_pr </p>";
                    echo "<p class='card-solicitudes-nombre'> <-----------> </p>";
                    echo "<p class='card-solicitudes-nombre'> $nom_B </p>";
                    echo "</div>";
                    
                    echo " <img  class='card-intercambios-imagen' src='../images/productos/$imB' >";
                    echo "</div>";

                    echo " <div class='card-solicitudes-body '><div class='d-flex  flex-row justify-content-between '>";
                    echo " <p class='card-solicitudes-titulo'> Mensaje </p>";
                    echo "<div  class='d-flex  flex-row align-self-center '><img class='card-mis-productos-ubicacion' src='".$subCarp."images/ubicacion.svg'> <p  class='card-mis-productos-ubicacion'>$munA, $estA</p></div> ";    
                    echo "</div>";

                    echo "<p  class='card-solicitudes-mensaje'> $men </p>";
                    
                    echo "</div> <div class='card-solicitudes-body'>";
                    echo "<div class=' d-flex  flex-row justify-content-between'> <a class='card-solicitudes-boton2 card-borde' name='enviar' href='manejo-solicitud.php?acepta=$id_sol'> Aceptar </a> ";
                    echo "<a class='card-solicitudes-boton card-borde' name='enviar' href='manejo-solicitud.php?declina=$id_sol'> Declinar </a> </div>";
                    echo "</div></div>";

                }
            }
            echo "</div></div></div>";
            
        ?>
    </main>

<?php          
    require_once '../footer.php';
?>


</body>

</html>