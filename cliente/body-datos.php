<?php          
require_once '../head.php';
?>


<body>
    <?php session_start();       
    if(!$_SESSION['username'] || $_SESSION['tipoUsuario']!=1) header("Location:index.php");  
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
                Bienvenido <?PHP echo $_SESSION['nombre']; ?>
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