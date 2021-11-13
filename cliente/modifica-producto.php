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
                <p class="titulos-espacios">Actualiza tu producto</p>
                <hr class="linea-der">
            </div>

        <?php
            if(isset($_GET['id'])){
                $categorias=array("Vehículos","Tecnología","Electrodomésticos",'Hogar y muebles','Moda y complementos' ,"Deportes y Fitness","Herramientas y construcción" ,"Industria y oficina","Juegos y juguetes" ,"Bebés","Salud y Belleza" ,"Arte y antigüedades" ,"Libros y comics","Coleccionables","Otros");
                $id_p=$_GET["id"];
                //echo $id_p;
                $link=mysqli_connect("localhost","root","");
                mysqli_select_db($link,"mercurioDB");
                $link->set_charset("utf8");
                //Informacion
                $result=mysqli_query($link,"select * from productos where id_producto=$id_p");
                $row=mysqli_fetch_array($result);
                $cat=$row['categoria'];
                $tit=$row['nombre'];
                $des=$row['descripcion'];
                $tit_cambio=$row['titulo_cambio'];
                $des_cambio=$row['descripcion_cambio'];
                $est=$row['estado'];
                $mun=$row['municipio'];
                $ca_num=$row['calle_y_numero'];
                $ref=$row['referencias'];

                echo "
                <div class='d-flex  flex-column  align-items-center justify-content-around '>
                    <form enctype='multipart/form-data' action='actualiza.php' class='modificar-productos-contenedor' method='POST'>
                        
                        <div class='cards-modificar-producto-big card-borde d-flex flex-column'>
                            <h3 class='modificar-producto-titulo'>Información general</h3>
                                <label for='select' class='modificar-producto-titulo-label' >Categoría <span>*</span></label> ";
                    echo"<select class='form-select modificar-producto-select modificar-producto-titulo-label' name='categoria' required>";
                    foreach ($categorias as &$valor) {
                        if(strcmp($valor, $cat) == 0){
                            echo "<option  class='modificar-producto-titulo-label' selected value=$cat>$cat</option>"; 
                        }else{
                            echo"<option class='modificar-producto-titulo-label' value=$valor>$valor</option>";
                        }
                    }
                    echo "</select>";
                    echo "   <label class='modificar-producto-titulo-label' >Título (máx 30 carácteres):<span>*</span></label> 
                                <INPUT TYPE='text' NAME='nombre' class='form-control  modificar-producto-select modificar-producto-titulo-label ' value='$tit' > 
                            <label class='modificar-producto-titulo-label' >Descripción del producto:<span>*</span></label> 
                                <TEXTAREA class='modificar-producto-textarea modificar-producto-titulo-label form-control' NAME='descripcion'>$des</TEXTAREA>
                        </div>
                    
                        <div class='cards-modificar-producto-small card-borde d-flex flex-column'>

                            <h3 class='modificar-producto-titulo'>qué te gustaría a cambio?</h3>
                            <label class='modificar-producto-titulo-label' >Título:<span>*</span></label> 
                                <INPUT TYPE='text' NAME='titulo_cambio' value='$tit_cambio'  class='form-control  modificar-producto-select modificar-producto-titulo-label ' required>
                            <label class='modificar-producto-titulo-label' >Descripción:<span>*</span></label> 
                                <TEXTAREA class='modificar-producto-textarea modificar-producto-titulo-label form-control' NAME='descripcion_cambio' required>$des_cambio</TEXTAREA>
                                
                        </div>";
                    
                    echo "              
                            <div class='cards-modificar-producto-big card-borde d-flex flex-column'>
                                <h3 class='modificar-producto-titulo'>Imágenes</h3>
                                <div class='container'>
                                <div class='row' >
                                    <p class='modificar-producto-titulo-label'>Seleccione las imagenes que desea eliminar</p>
                                </div>
                                    <div class='row scrollmenu-img-modificar flex-row'>
                                ";
                            
                                $imagenes=mysqli_query($link,"select * from imagenes where id_producto=$id_p");
                                
                                while ($row=mysqli_fetch_array($imagenes)) {
                                    $ima=$row['nombre'];
                                    echo "
                                    
                                    <div class='form-check '>
                                        <input class='form-check-input' type='checkbox' id='cb$ima' value='$ima'>
                                        <label class='form-check-label' for='cb$ima'>
                                            <img class='card-imagen-modificar' src='../images/productos/$ima'>
                                        </label>
                                    </div>

                                    ";
                                }
                    echo"       
                                    </div>
                                    <script src='https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js'></script>
                                    <div class='row' >
                                        <div class='col-6'>
                                            <label for='cargar-img' class='label-img-producto-individual'>
                                                <lord-icon
                                                    src='https://cdn.lordicon.com/fgkmrslx.json'
                                                    trigger='loop'
                                                    colors='primary:#4a8aa1,secondary:#c60f7b'
                                                    class='label-img-modificar-icon'>
                                                </lord-icon>
                                                <p class='modificar-producto-titulo-label'>Añadir más imagenes</p>
                                            </label>            
                                            <input id='cargar-img' onchange='subirimg()' name='image[]' multiple='' type='file' accept='image/*' required/>
                                        </div>
                                
                                        <div class='col-6 align-self-center' id='img-cargadas'></div>
                                        
                                
                                        </div>
                                        </div>
                                
                                ";
                            echo" </div>
                            <div class='cards-modificar-producto-small card-borde d-flex flex-column'>
                                <h3 class='modificar-producto-titulo'>ubicación del intercambio</h3>
                                <label class='modificar-producto-titulo-label' >Estado:<span>*</span></label> 
                                    <INPUT TYPE='text' NAME='estado' value='$est' class='form-control  modificar-producto-select modificar-producto-titulo-label ' required>
                                <label class='modificar-producto-titulo-label' > Municipio:<span>*</span></label> 
                                    <INPUT TYPE='text' NAME='municipio' value='$mun'  class='form-control  modificar-producto-select modificar-producto-titulo-label ' required>
                                <label class='modificar-producto-titulo-label' >Calle y número:<span>*</span></label> 
                                    <INPUT TYPE='text' NAME='calle' value='$ca_num'  class='form-control  modificar-producto-select modificar-producto-titulo-label ' required>
                                <label class='modificar-producto-titulo-label' >Referencias:<span>*</span></label>  
                                    <TEXTAREA class='modificar-producto-textarea modificar-producto-titulo-label form-control' NAME='referencia'>$ref</TEXTAREA>
                            </div>";
                    echo "<input type='hidden' name='id' value='$id_p'>";
                    echo "<INPUT TYPE='SUBMIT' class='modificar-productos-boton card-borde' value='Actualizar'>";
                echo "</form>";
            }else{//No se le pasa el id.
                header("Location:body-productos.php");
            }
        ?>

    </main>


<?php          
    require_once '../footer.php';
?>


<script>
    
function subirimg(){
    let cargar = ''
    let imNames= document.getElementById('cargar-img').files
    for (const file in imNames) 
        if(imNames[file].name) 
            if(imNames[file].name !='item')
                cargar=cargar+'<p class="card-titulo">'+imNames[file].name+'</p>'
    document.getElementById('img-cargadas').innerHTML = cargar
    console.log(imNames);
}
</script>

</body>
</html>