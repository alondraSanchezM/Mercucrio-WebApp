<?php          
require_once 'head-internauta.php';
?>

<body>
    <div class="login-form">
        <div class="container">
            <div class="row justify-content-left align-items-center">
                <div class="col-4 imagenes-login">
                    <img class="img-logo" src="../images/mercurio-logo.svg" alt="Logo de la Página">
                    <img class="img-fondo" src="../images/login-imagen.svg" alt="Imagen de fondo">
                </div>
                <div class="col-4 ">
                    <div class="card-borde formulario-login-card">
                        <form class="formulario-login row">
                            <label class="nombre-form">Iniciar sesión </label>
                            <label class="label-login">Correo electrónico </label>
                            <input  class="input-login" type="text">
                            <label class="label-login">Contraseña </label>
                            <input  class="input-login" type="password">
                            <a class="boton-login card-borde" href="body-principal.php">Iniciar sesión</a>
                            <p class="label-login-registro">¿Aún no te registras? <a href="body-registro.php"><span class="label-login-registro-span">Crea una cuenta.</span></a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
</body>

</html>