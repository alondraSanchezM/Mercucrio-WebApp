<?php session_start();
    if (isset($_SESSION['tipoUsuario'])){
        if($_SESSION['tipoUsuario']==1) header("Location:cliente/body-principal.php");
        if($_SESSION['tipoUsuario']==0) header("Location:administrador/body-principal.php");
    }

    $subCarp="./";
    require_once 'head.php';
    echo "<body>";       
    require_once 'header.php';
?>
    <main class="principal">
        <div class="d-flex align-items-center justify-content-around">
            <hr class="linea-izq">
            <p class="titulos-espacios">Sobre nosotros</p>
            <hr class="linea-der">
        </div>
        <?php          
            require_once './sobre_nosotros_info.php';
        ?>
    </main>

<?php          
    require_once 'footer.php';
?>


</body>

</html>