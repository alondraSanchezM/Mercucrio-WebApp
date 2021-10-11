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

                    echo "<div class='clientes-registrados card-borde'>";
                    echo "<p class='datos-cuenta-info-titulo'> datos cuentas </p>";
                    echo "<div class='row datos-cuenta-info'>"; 
                    echo "<div class='col'>"; 
                    echo "<p class='datos-cuenta-info-label '> Correo electrónico </p>";
                    echo "<p class='datos-cuenta-info-label'> Contraseña </p>";
                    echo "</div> <div class='col'>";                     
                    echo "<p class='datos-cuenta-info-texto'> $correo </p>";
                    echo "<p type'password' class='datos-cuenta-info-texto'> ************ </p>";
                    echo "</div></div></div>";

                    

                    echo "<div class='clientes-registrados card-borde'>";
                    echo "<p class='datos-cuenta-info-titulo'> datos personales </p>";
                    echo "<div class='row datos-cuenta-info'>"; 
                    echo "<div class='col'>"; 
                    echo "<p class='datos-cuenta-info-label '> Nombre </p>";
                    echo "<p class='datos-cuenta-info-label'> Teléfono </p>";
                    echo "</div> <div class='col'>";                     
                    echo "<p class='datos-cuenta-info-texto'> $nombre </p>";
                    echo "<p type'password' class='datos-cuenta-info-texto'> $tel </p>";
                    echo "</div></div></div>";
                    
                }
            ?>
        </div>

    </main>

<?php          
require_once '../footer.php';
?>


</body>

</html>