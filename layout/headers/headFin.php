</head>
<body>
    <div id="contenedor">
        <div id="contenido">
            <!-- Contenido header -->
            <div id="contenidoHeader">
                <div id="headerLogo" class="left">
                    <a href="/">
                        <img src="layout/imagenes/Home/Logo_letras_203x99.png" alt="efood">
                    </a>
                </div>
                <div class="centerText left" id="headerTitles">
                    <span id="header_black_title">¡Ordena Comida a</span><br>
                    <span id="header_red_title" >Domicilio Online!</span>
                </div>
                <div class="left">
                    <a href="#">
                        <img alt="registrate, es gratis" src="layout/imagenes/Home/Regístrate_Gratis_111x76.png">
                    </a>
                </div>
                <div id="contenedorLogin" class="right">
                    <?php
                    require 'modulos/principal/vistas/login.php';

                    if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 1) {
                        ?>
                        <br><br>
                        <a href="usuarios.php"> Administración de usuarios</a>
                        <br>
                        <a href="restaurantes.php"> Administración de restaurantes</a>
                        <?php
                    }
                    ?>
                </div>
                <div id="menuHeader">
                    <img src="layout/imagenes/Home/btn_MieFood_76x50.png">
                    <img src="layout/imagenes/Home/btn_TengoHambre_76x50.png">
                    <img src="layout/imagenes/Home/btn_Blog_76x50.png">
                </div>
            </div>
            <?php
            $mensaje = getSessionMessage();
            if (isset($mensaje)) {
                echo $mensaje;
            }
            ?>