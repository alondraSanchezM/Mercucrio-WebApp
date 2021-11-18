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
                $link->set_charset("utf8");
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
                    
                    echo "<button type='button'  class=' card-borde ver-productos-boton'  data-bs-toggle='modal' data-bs-target='#modal-editar-perfil'>Modificar información</button>";
                    
                    echo "
                    <div class='modal fade' id='modal-editar-perfil' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-lg'>
                            <div class='modal-content'>
                            
                                <div class='modal-header'>
                                <h5 class='modal-datos-cliente-titulo' id='exampleModalLabel'>Edita tus datos</h5>
                                <button type='button' class='btn-close modal-datos-cliente-titulo' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'><form action='actualiza' method='POST'> 
                                    <div class='row'>
                                        <div class='col-6'>
                                            <p class='modal-datos-cliente-info-titulo'>datos de cuenta</p>
                                            <p class='modal-datos-cliente-info-text'> Correo electrónico </p>
                                            <input class='modal-datos-cliente-info-input me-2' type='email'  value='$correo' name='correo' required>
                                            <hr class='linea-modal-mis-datos'>
                                            <p class='modal-datos-cliente-info-text'> Contraseña </p>
                                            <input class='modal-datos-cliente-info-input me-2' type='password'  minlength='7' value=''  name='pass' required>
                                            <hr class='linea-modal-mis-datos'>
                                        </div>
                                        <div class='col-6'>
                                            <p class='modal-datos-cliente-info-titulo'>Datos personales</p>
                                            <p class='modal-datos-cliente-info-text'> Nombre </p>
                                            <input class='modal-datos-cliente-info-input me-2' type='text' minlength='3' value='$nombre'  name='nombre' required>
                                            <hr class='linea-modal-mis-datos'>
                                            <p class='modal-datos-cliente-info-text'> Teléfono </p>
                                            <input class='modal-datos-cliente-info-input me-2' type='text'  minlength='10' maxlength='10' value='$tel' name='telefono' onkeypress='return numeros(event)' required>
                                            <hr class='linea-modal-mis-datos'>
                                        </div>
                                    </div>
                                    <div class='row justify-content-center'>
                                        <input type='hidden' name='id_u' value='$id'>
                                        <INPUT TYPE='SUBMIT' class='card-borde mis-datos-guardar-boton' value='Guardar cambios'>
                                    </div>
                                </form></div>
                            </div>
                            </div>
                        </div>
                        ";
                }
            ?>
        </div>
    </main>

<?php          
require_once '../footer.php';
?>
<script>
    function numeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 0123456789";
    especiales = [8,37,39,46];
 
    tecla_especial = false
    for(var i in especiales){
 if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}
</script>

</body>

</html>