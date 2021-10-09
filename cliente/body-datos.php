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
            <p class="titulos-espacios">Mis Datos</p>
            <hr class="linea-der">

        </div>

        <div class="d-flex  flex-column  align-items-center justify-content-around clientes-registrados-container">

            <div class="clientes-registrados card-borde">
                <?php
                    $id=intval($_SESSION['id']);
                    $link=mysqli_connect("localhost","root","");
                    mysqli_select_db($link,"mercurioDB");
                    $result=mysqli_query($link,"select * from Users where id_user=$id");
                    while($row=mysqli_fetch_array($result)){
                        $correo=$row['correo'];
                        $pass=$row['pass'];
                        $nombre=$row['nombre'];
                        $tel=$row['telefono'];
                        echo $id;
                    }
                ?>
            </div>

            <div class="mis-datos-area-doble card-borde">
            </div>

        </div>

    </main>

<?php          
require_once '../footer.php';
?>


</body>

</html>