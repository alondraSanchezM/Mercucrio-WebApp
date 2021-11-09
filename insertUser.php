<?PHP session_start();
    $nombre=$_REQUEST['nombre'];
    $telefono=$_REQUEST['telefono'];
    $usu=$_REQUEST['usu'];
    $pass=$_REQUEST['passwd'];
    if(isset($_GET['u'])) $u=$_GET['u']; else $u=0;
    
    date_default_timezone_set("America/Mexico_City");
    $fecha = date('Y-m-d');

    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"mercurioDB");
    $result=mysqli_query($link,"select correo, tipo from users where correo='$usu'");
    if($row=mysqli_fetch_array($result)){//Si se encontró el usuario
        if(intval($row["status"])==1)
            header("Location:errorRegistro.php?u=$u&mensaje=USUARIO BLOQUEADO");
        else
            header("Location:errorRegistro.php?u=$u&mensaje=USUARIO YA REGISTRADO");
    }else{
        $result=mysqli_query($link,"insert into Users(tipo,nombre,correo,pass,telefono,fecha_de_registro)
                                    values (1,'$nombre','$usu','$pass','$telefono','$fecha')");

        $result=mysqli_query($link,"select id_user from users where correo='$usu'");
        $row=mysqli_fetch_array($result);
        
        $_SESSION['id']=$row['id_user'];
        $_SESSION['nombre']=$nombre; 
        $_SESSION['username']=$usu; //Variables de sesion
        $_SESSION['tipoUsuario']=1; //Variables de sesion
        if($u==1)
            header("Location:cliente/body-publicar-producto.php");
        else
            header("Location:cliente/body-principal.php");
    }
    mysqli_free_result($result);
    mysqli_close($link);
?>