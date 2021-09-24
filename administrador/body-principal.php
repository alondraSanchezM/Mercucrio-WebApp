<?php          
require_once 'head-internauta.php';
?>


<body>
    <?php          
require_once 'header-administrador.php';
?>
    <main class="principal">


    <div class="d-flex justify-content-around">
            <a class="eliminar-text-decoracion" href="body-productos.php">
                <div class="imagen-footer d-flex flex-column align-items-center">
                    <div>
                        <img class="imagen-productos" src="../images/imagen-productos.svg"
                            alt="Imagen de los productos">
                    </div>
                    <p class="texto-imagenes-administrador">Productos</p>
                </div>
            </a>

            <a class="eliminar-text-decoracion" href="body-clientes.php">
                <div class="imagen-footer d-flex flex-column align-items-center">
                    <div>
                        <img class="imagen-clientes" src="../images/imagen-clientes.svg" alt="Imagen de los clientes">
                    </div>
                    <p class="texto-imagenes-administrador">Clientes</p>
                </div>
        </div>
        </a>

    </main>

    <?php          
require_once 'footer.php';
?>


</body>

</html>