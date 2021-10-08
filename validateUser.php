<?PHP session_start();
    $usu=$_REQUEST['usu'];
    $pas=$_REQUEST['passwd'];
    echo "Usuario:  $usu <br>";
    echo "Password: $pas <br>";

    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"mercurioDB");
    $result=mysqli_query($link,"select id_user, correo, nombre, pass,tipo from users where correo='$usu'");
    if($row=mysqli_fetch_array($result)){//Si se encontró el usuario
        if($row["pass"]==$pas){
            //echo "Usuario registrado";
            $ti=$row['tipo'];
            $_SESSION['nombre']=$row['nombre'];
            $_SESSION['username']=$usu; //Variables de sesion
            $_SESSION['tipoUsuario']=$ti; //Variables de sesion
            $_SESSION['id']=$row['id_user'];
            if($ti==1)header("Location:cliente/body-principal.php");
            if($ti==0)header("Location:administrador/body-principal.php");
        }else
            header("Location:errorPassword.php");
    }else
        header("Location:errorLogin.php");
    mysqli_free_result($result);
    mysqli_close($link);
?>