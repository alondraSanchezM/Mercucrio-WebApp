<?php session_start();
if (isset($_SESSION['tipoUsuario'])){
    if($_SESSION['tipoUsuario']==1) header("Location:cliente/body-principal.php");
    if($_SESSION['tipoUsuario']==0) header("Location:administrador/body-principal.php");
}
    $subCarp="./";
    require_once 'head.php';
?>


<body>
    <div class="login-form">
        <div class="container ">
            <div class="row justify-content-left align-items-center container-responsive-login-registro">
                <div class="col-4 imagenes-login">
                    <img class="img-logo" src="images/mercurio-logo.svg" alt="Logo de la Página">
                    <img class="img-fondo" src="images/login-imagen.svg" alt="Imagen de fondo">
                </div>
                <div class="col-4 ">
                    <div class="card-borde formulario-login-card">
                        <?php if(isset($_GET['u'])) $u=$_GET['u'];else $u=0;
                            if ($u==1) {
                                echo "<form class='formulario-login row' action='validateUser.php?u=1' method='POST'>";
                            }else{
                                echo "<form class='formulario-login row' action='validateUser.php' method='POST'>";
                            }
                        ?>
                            <label class="nombre-form">Iniciar sesión </label>
                            <label class="label-login">Correo electrónico </label>
                            <input  class="input-login" type="text" name="usu" required>
                            <label class="label-login">Contraseña </label>
                            <input  class="input-login" type="password" name="passwd" required>
                            <input class="boton-login card-borde" type="submit"  name="enviar" value="Iniciar sesión"/>
                            <p class="label-login-registro">¿Aún no te registras?<?php if($u==1) echo "<a href='register.php?u=1'>"; else echo "<a href='register.php'>";?><span class="label-login-registro-span">Crea una cuenta.</span></a></p>
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