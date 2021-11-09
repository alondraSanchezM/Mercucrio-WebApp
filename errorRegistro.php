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
        <div class="container">
            <div class="row justify-content-left align-items-center">
                <div class="col-4 imagenes-login">
                    <img class="img-logo" src="images/mercurio-logo.svg" alt="Logo de la Página">
                    <img class="img-fondo" src="images/login-imagen.svg" alt="Imagen de fondo">
                </div>
                <div class="col-4 ">
                    <div class="card-borde formulario-login-card">
                    <?php if(isset($_GET['u'])) $u=$_GET['u']; else $u=0; 
                            if ($u==1) {
                                echo "<form class='formulario-login row' action='insertUser.php?u=1' method='POST'>";
                            }else if(isset($_GET['id_p'])) {
                                echo "<form class='formulario-login row' action='insertUser.php?id_p=$_GET[id_p]' method='POST'>";
                            }else{
                                echo "<form class='formulario-login row' action='insertUser.php' method='POST'>";
                            }
                        ?> 
                            <label class="nombre-form">Regístrate</label>
                            <div class="row">
                                <div class="col login-registro-nt">
                                    <label class="label-login-nt">Nombre </label>
                                    <input  class="input-login-nt" type="text" name="nombre" required>
                                </div>
                                <div class="col login-registro-nt">
                                    <label class="label-login-nt">Telefono </label>
                                    <input  class="input-login-nt" type="tel" name="telefono" required>
                                </div>
                            </div>
                            <label class="label-login">Correo electrónico </label>
                            <input  class="input-login" type="text" name="usu" required>
                            <label class="label-login">Contraseña </label>
                            <input  class="input-login" type="password" name="passwd" required>
                            <input class="boton-login card-borde" type="submit"  name="enviar" value="Crear cuenta"/>
                            <?php 
                                if(isset($_GET['mensaje'])) {
                                    $mensaje = $_GET['mensaje'];
                                    echo "<p class='label-login-registro error'>¡ERROR! $mensaje</p>";
                                }
                            ?>
                            <p class="label-login-registro">¿Ya estas registrado? <?php if($u==1) echo "<a href='login.php?u=1'>";else if(isset($_GET['id_p'])) echo "<a href='login.php?id_p=$_GET[id_p]'>"; else echo "<a href='login.php'>";?><span class="label-login-registro-span">Inicia sesión.</span></a></p>
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