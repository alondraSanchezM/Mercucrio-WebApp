<?PHP session_start();
    $nombre=$_REQUEST['nombre'];
    $usu=$_REQUEST['usu'];
    $pass=$_REQUEST['passwd'];

    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"mercurioDB");
    $result=mysqli_query($link,"select correo, tipo from users where correo='$usu'");
    if($row=mysqli_fetch_array($result)){//Si se encontró el usuario
        header("Location:errorRegister.php");
    }else{
        $result=mysqli_query($link,"insert into Users(tipo,nombre,correo,pass) values (1,'$nombre','$usu','$pass')");
        $_SESSION['nombre']=$nombre; 
        $_SESSION['username']=$usu; //Variables de sesion
        $_SESSION['tipoUsuario']=1; //Variables de sesion
        header("Location:cliente/body-principal.php");
    }
    mysqli_free_result($result);
    mysqli_close($link);
?>