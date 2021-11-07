<script LANGUAGE="JavaScript">
    function confirmSubmit(){
        var eli=confirm("¿Está seguro de eliminar este producto?");
        if (eli) return true ; 
        else return false ;
    }
</script>
<?php 
    $subCarp="./";
    require_once './head.php';
    echo "<body>";
    require_once 'header.php';

    if(isset($_GET['delete_id'])){//eliminar el producto
        $delete_id = (int) $_GET['delete_id'];
        $link=mysqli_connect("localhost","root","");
        mysqli_select_db($link,"mercurioDB");
        $link->set_charset("utf8");
        mysqli_query($link,"delete from solicitudes where producto_solicitado=$delete_id || producto_solicitante=$delete_id");
        mysqli_query($link,"delete from imagenes where id_producto=$delete_id");
        mysqli_query($link,"delete from productos where id_producto=$delete_id");
        header("Location:body-productos.php");
    }else if(isset($_GET['id'])){
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
            <div class='d-flex  flex-column  align-items-center justify-content-around clientes-registrados-container'>
            <div class='productos-individual-contenedor'>";

        //Imagenes
        echo"<div class='cards-modificar-producto-big card-borde  d-flex justify-content-center align-items-center'> ";
        echo "  <div id='carouselExampleControls' class='carousel slide ver-productos-contenedor-carousel' data-bs-ride='carousel'>
                    <div class='carousel-inner ver-productos-contenedor-carousel'>";
        $resulti=mysqli_query($link,"select * from imagenes where id_producto=$id_p");
        $countCarousel=0;
        while ($row=mysqli_fetch_array($resulti)) {
            $ima=$row['nombre'];
            if($countCarousel==0){
                echo"   <div class='carousel-item active '>
                                <img class='ver-productos-img-carousel' src='./images/productos/$ima' >
                        </div>";   
                $countCarousel=1;
            }
            else{
                echo"   <div class='carousel-item '>
                        <img src='./images/productos/$ima' class='ver-productos-img-carousel' >
                    </div>";
            }
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
        echo "
                <div class='cards-productos-individual-small-grid d-flex flex-column justify-content-center align-items-center'>
                    <div class=' cards-modificar-producto-small card-borde d-flex flex-column'>
                        <h3 class='modificar-producto-titulo'>Realiza tu intercambio</h3>
                        <label class='modificar-producto-titulo-label' >Producto a intercambiar <span>*</span></label> 
                            <INPUT TYPE='text' NAME='titulo_cambio' value='$tit_cambio'  class='form-control  modificar-producto-select modificar-producto-titulo-label ' required>
                        <label class='modificar-producto-titulo-label' >Descripción:<span>*</span></label> 
                            <TEXTAREA class='modificar-producto-textarea modificar-producto-titulo-label form-control' NAME='descripcion_cambio' required>$des_cambio</TEXTAREA>
                    </div>
                        <label class='modificar-producto-titulo-label align-self-end me-5' > <span>*</span>  Campos requeridos   </label> 
                        <button class=' card-borde productos-individual-boton' name='button-Modifica' onclick=location.href='modifica-producto.php?id=$id_p' >Solicitar intercambio</button>
                </div> ";
                
        echo "  

                <div class='cards-productos-individual-big card-borde'>
                    <p class='datos-cuenta-info-titulo'> Descripción del producto </p>
                    <p class='card-mis-productos-descripcion'>$desp</p>
                </div>
                    <div class='cards-productos-individual-big card-borde'>
                        <p class='datos-cuenta-info-titulo'> A cambio: </p>
                        <p class='card-mis-productos-descripcion'>$tit_cambio </p>
                        <p class='card-mis-productos-descripcion'>$des_cambio </p>
                        
                    </div>
                    <div class='cards-productos-individual-small-ubi-fecha '>
                        <div class='d-flex  flex-row align-self-end' >
                            <div  class='d-flex  flex-row align-self-start '>
                                <img class='card-mis-productos-ubicacion' src='".$subCarp."images/ubicacion.svg'> 
                                <p  class='card-mis-productos-ubicacion'>$mun, $est</p>
                            </div>
                            <p  class='card-mis-productos-fecha col align-self-end'> Publicado: $fecha</p> 
                        </div>
                    </div> </div> ";

        echo"</div></main>";    
    }
    require_once './footer.php';
    ob_end_flush();
?>