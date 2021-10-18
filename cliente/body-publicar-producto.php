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
            <p class="titulos-espacios">Ingresa tu producto</p>
            <hr class="linea-der">
        </div>

        <?php          
            require_once '../ultimos_productos.php';
        ?>

    </main>

<?php          
    require_once '../footer.php';
?>


</body>

</html>