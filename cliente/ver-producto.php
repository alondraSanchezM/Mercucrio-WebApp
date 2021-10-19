<?php session_start();       
    if(!$_SESSION['username'] || $_SESSION['tipoUsuario']!=1) header("Location:../index.php");
    $subCarp="../";
    require_once '../head.php';
    echo "<body>";
    require_once 'header-cliente.php';

    if (isset($_GET['delete_id'])) {//Borrar producto
        $delete_id = (int) $_GET['delete_id'];
        echo "AQUI";
        $link=mysqli_connect("localhost","root","");
        mysqli_select_db($link,"mercurioDB");
        $link->set_charset("utf8");

        mysqli_query($link,"delete from solicitudes where producto_solicitado=$delete_id || producto_solicitante=$delete_id");
        mysqli_query($link,"delete from imagenes where id_producto=$delete_id");
        mysqli_query($link,"delete from productos where id_producto=$delete_id");
        header("Location:body-productos.php");
    }elseif(isset($_GET['id'])){

        $id_p=$_GET["id"];
        $link=mysqli_connect("localhost","root","");
        mysqli_select_db($link,"mercurioDB");
        $link->set_charset("utf8");
        //Informacion
        $result=mysqli_query($link,"select * from productos where id_producto=$id_p");
        $row=mysqli_fetch_array($result);
        $nom=$row['nombre'];
        $desp=$row['descripcion'];
        $tit_cambio=$row['titulo_cambio'];
        $des_cambio=$row['descripcion_cambio'];
        
        $est=$row['estado'];
        $mun=$row['municipio'];
        $fecha=$row['fecha'];
        echo "
        <main class='principal'>
            <div class='d-flex align-items-center justify-content-around'>
            <p class='titulos-espacios'>$nom</p>
                <hr class='linea-ver-productos'>
            </div>
            <div class='d-flex  flex-column  align-items-center justify-content-around clientes-registrados-container'>";

        
        //Imagenes
        echo"<div class='cards-ver-producto-carrusell card-borde  d-flex justify-content-center align-items-center'>";
        echo "  <div id='carouselExampleControls' class='carousel slide' data-bs-ride='carousel'>
                    <div class='carousel-inner'>";
        $resulti=mysqli_query($link,"select * from imagenes where id_producto=$id_p");
        while ($row=mysqli_fetch_array($resulti)) {
            $ima=$row['nombre'].'.jpg';
            echo"   <div class='carousel-item active'>
                        <img src='../images/productos/$ima' class='d-block w-100 cards-ver-producto-carrusell' >
                    </div>";
        }
        echo"   
                        </div>
                        <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleControls' data-bs-slide='prev'>
                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Previous</span>
                        </button>
                        <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleControls' data-bs-slide='next'>
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Next</span>
                        </button>
                    </div>
                </div>";
        echo "<div class=' d-flex  flex-row ver-productos-contenedor-boton justify-content-between '>  <div class='cards-ver-producto card-borde'>
                    <p class='datos-cuenta-info-titulo'> Descripción del producto </p>
                    <p class='card-mis-productos-descripcion'>$desp</p>
                </div> ";
                
        echo "  <div class='cards-ver-producto card-borde'>
                    <p class='datos-cuenta-info-titulo'> A cambio: </p>
                    <p class='card-mis-productos-descripcion'>$tit_cambio </p>
                    <p class='card-mis-productos-descripcion'>$des_cambio </p>
                </div></div> ";
        echo "  <div class='ver-productos-ubicacion-fecha d-flex  flex-row align-self-end' >
                    <div  class='d-flex  flex-row align-self-start '>
                        <img class='card-mis-productos-ubicacion' src='".$subCarp."images/ubicacion.svg'> 
                        <p  class='card-mis-productos-ubicacion'>$mun, $est</p>
                    </div>
                    <p  class='card-mis-productos-fecha col align-self-end'> Publicado: $fecha</p> 
                </div>";

        echo "<div class=' d-flex  flex-row ver-productos-contenedor-boton justify-content-between '>
                    <button class=' card-borde ver-productos-boton' name='button-Modifica' onclick=location.href='modifica-producto.php?id=$id_p' >Modificar producto</button>
                    <button class=' card-borde ver-productos-boton2 ' name='button-Elimina' onclick=location.href='?delete_id=$id_p' >Eliminar producto</button>
                </div>";

        echo"</div></main>";

        
    }else{//No se le pasa el id.
        header("Location:body-productos.php");
    }
             
    require_once '../footer.php';
?>

</body>
</html>