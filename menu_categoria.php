<?php
    if(isset($_SESSION['username'])){
        $rut="./body-principal.php";
    }else{
        $rut="index.php";
    }
    
    echo "
        <a href='".$rut."?categoria=Vehículos'>
            <p class='menu-categoria'>Vehículos</p>
        </a>

        <a href='".$rut."?categoria=Tecnología'> 
            <p class='menu-categoria'>Tecnología</p> 
        </a>

        <a href='".$rut."?categoria=Electrodomésticos'> 
            <p class='menu-categoria'>Electrodomésticos</p> 
        </a>

        <a href='".$rut."?categoria=Hogar y muebles'> 
            <p class='menu-categoria'>Hogar y muebles</p> 
        </a>

        <a href='".$rut."?categoria=Moda y complementos'> 
            <p class='menu-categoria'>Moda y complementos</p> 
        </a>

        <a href='".$rut."?categoria=Deportes y Fitness'> 
            <p class='menu-categoria'>Deportes y Fitness</p> 
        </a>

        <a href='".$rut."?categoria=Herramientas y construcción'> 
            <p class='menu-categoria'>Herramientas y construcción</p> 
        </a>

        <a href='".$rut."?categoria=Industria y oficina'> 
            <p class='menu-categoria'>Industria y oficina</p> 
        </a>

        <a href='".$rut."?categoria=Juegos y juguetes'> 
            <p class='menu-categoria'>Juegos y juguetes</p> 
        </a>

        <a href='".$rut."?categoria=Bebés'> 
            <p class='menu-categoria'>Bebés</p> 
        </a>

        <a href='".$rut."?categoria=Salud y Belleza'> 
            <p class='menu-categoria'>Salud y Belleza</p> 
        </a>

        <a href='".$rut."?categoria=Arte y antigüedades'> 
            <p class='menu-categoria'>Arte y antigüedades</p> 
        </a>

        <a href='".$rut."?categoria=Libros y comics'> 
            <p class='menu-categoria'>Libros y comics</p> 
        </a>

        <a href='".$rut."?categoria=Coleccionables'> 
            <p class='menu-categoria'>Coleccionables</p> 
        </a>

        <a href='".$rut."?categoria=Otros'> 
            <p class='menu-categoria'>Otros</p> 
        </a>
    ";
?>