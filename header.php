<header class="align-content-start header">
    <div class="d-flex justify-content-between">

        <div class="imagen-footer d-flex align-items-center">
            <div>
                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample">
                    <img class="imagen-menu" src="images/menu.svg" alt="Logo de la Página">
                </a>

                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                    aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="titulo-categorias" id="offcanvasExampleLabel">Categorías</h5>
                        <button type="button" class="btn-close dropdown-item" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <?php          
                            require_once './menu_categoria.php';
                        ?>

                    </div>
                </div>
            </div>
            <div>
                <a href="index.php">
                    <img class="logo-menu" src="images/mercurio-logo.svg" alt="Logo de la Página">
                </a>
            </div>
        </div>

        <div class="boton-central-publicar align-items-center">
            <a class="boton-central-publicar-texto " href="login.php">
                <p>Publicar Productos</p>
            </a>
        </div>
        <div class="  d-flex align-items-center">
            <div class="dropdown">
                <a class="link-menu-usuario" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img class="icon-user" src="images/Icon-user.svg" alt="Icono del usuario">
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-menu-config">
                        <li><a class="dropdown-item" href="login.php">Iniciar sesión</a></li>
                        <li><a class="dropdown-item" href="register.php">Registrarse</a></li>
                    </div>
                </ul>

            </div>
            <div>
                <div class="container-fluid">
                    <button class="navbar-toggler icon-search" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <img  src="images/Icon-search.svg" alt="Busqueda en el sistema">
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <form class="d-flex flex-column">
                            <div class=' col-10 col-sm-5 offset-1 flex-row'>
                                <input id='buscador-head' class="buscador-head me-2" type="text"  onkeyup="autocompletado()" placeholder="Ingresa el nombre del producto" >
                                <hr class='linea-buscador'>
                                <div>
                                        <ul id="resultado-buscador"></ul>
                                </div>
                                <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script >
    <?php
    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"mercurioDB");
    $link->set_charset("utf8");
        
    $result=mysqli_query($link,"select id_producto, nombre from Productos where status='0'");
    while($row=mysqli_fetch_array($result)){ 
        $array['id_producto'][] = $row['id_producto'];
        $array['nombre'][] = $row['nombre'];
    }
    ?>

    let data = <?php echo json_encode($array);?>;
    console.log(data);

    function autocompletado () {
        document.getElementById("resultado-buscador").innerHTML = '';
        
        
        let pal = document.getElementById("buscador-head").value;
        let respuestas='';
        for(let i=0;i< data.nombre.length ; i++){
            let posicion = data.nombre[i].toLowerCase().indexOf(pal.toLowerCase());
            if (posicion !== -1)
                respuestas += "<li class='decoracions-buscador-li'><a class='buscador-head' href='./producto-individual.php?id="+data.id_producto[i]+"'>"+data.nombre[i]+"</a></li>";
        }
        document.getElementById("resultado-buscador").innerHTML = respuestas ;
    }

</script>
</header>