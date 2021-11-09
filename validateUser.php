<?PHP session_start();
    $usu=$_REQUEST['usu'];
    $pas=$_REQUEST['passwd'];
    echo "Usuario:  $usu <br>";
    echo "Password: $pas <br>";
    if(isset($_GET['u'])) $u=$_GET['u']; else $u=0;
    if(isset($_GET['id_p'])) $id_p=$_GET['id_p'];else $id_p=0;
    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"mercurioDB");
    $result=mysqli_query($link,"select * from users where correo='$usu'");
    if($row=mysqli_fetch_array($result)){
        if(intval($row["status"])==0){
            if($row["pass"]==$pas){
                $ti=$row['tipo'];
                $_SESSION['nombre']=$row['nombre'];
                $_SESSION['username']=$usu; //Variables de sesion
                $_SESSION['tipoUsuario']=$ti; //Variables de sesion
                $_SESSION['id']=$row['id_user'];
                if($u==1){
                    header("Location:cliente/body-publicar-producto.php");
                }else if(isset($_GET['id_p'])){
                    isset($_GET['id_p']);
                    $product=mysqli_query($link,"select * from productos where id_producto=$id_p");
                    $row_prod=mysqli_fetch_array($product);
                    if ($_SESSION['id']==$row_prod['id_user']) {
                        header("Location:cliente/ver-producto.php?id=$id_p");
                    }else
                        header("Location:cliente/producto-individual.php?id=$id_p");
                }else{
                    if($ti==1)header("Location:cliente/body-principal.php");
                    if($ti==0)header("Location:administrador/body-principal.php");
                }
            }else{
                if($id_p==0)
                    header("Location:errorIngreso.php?u=$u&mensaje=CONTRASEÑA INCORRECTA");
                else
                    header("Location:errorIngreso.php?id_p=$id_p&mensaje=CONTRASEÑA INCORRECTA");
            }
        }else {
            if($id_p==0)
                header("Location:errorIngreso.php?u=$u&mensaje=USUARIO BLOQUEADO");
            else
                header("Location:errorIngreso.php?id_p=$id_p&mensaje=CONTRASEÑA INCORRECTA");
        }
    }else{
        if($id_p==0)
            header("Location:errorIngreso.php?u=$u&mensaje=USUARIO NO EXISTE");
        else
            header("Location:errorIngreso.php?id_p=$id_p&mensaje=CONTRASEÑA INCORRECTA");
    }
    mysqli_free_result($result);
    mysqli_close($link);
?>