<?php session_start();
if (isset($_SESSION['tipoUsuario'])){
    if($_SESSION['tipoUsuario']==1) header("Location:cliente/body-principal.php");
    if($_SESSION['tipoUsuario']==0) header("Location:administrador/body-principal.php");
}

$subCarp="./";
require_once 'head.php';
?>

<body>
    <?php          
        require_once 'header.php';
    ?>
    <main class="principal">
        <div class="d-flex align-items-center justify-content-around">
            <hr class="linea-izq">
            <p class="titulos-espacios">Últimos productos</p>
            <hr class="linea-der">
        </div>
        <?php          
            require_once './ultimos_productos.php';
        ?>
    </main>

<?php          
    require_once 'footer.php';
    mysqli_free_result($result);
    mysqli_close($link);
?>


</body>

</html>