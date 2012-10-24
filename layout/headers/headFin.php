</head>
<body>
    <div id="contenedor">
        <div id="contenido">
            <!-- Contenido header -->
            <div id="contenidoHeader" class="row-fluid">
                <div class="span8">
                    <div id="headerLogo" class="left">
                        <a href="/">
                            <img src="layout/imagenes/Home/LogoEfood_205x100.png" alt="efood">
                        </a>
                    </div>
                    <div class="centerText left" id="headerTitles">
                        <span id="header_black_title">¡Ordena Comida a</span><br>
                        <span id="header_red_title" >Domicilio Online!</span>
                    </div>
                    <div class="left">
                        <a >
                            <img alt="registrate, es gratis" src="layout/imagenes/Home/Registrate_Gratis_111x76.png">
                        </a>
                    </div>

                    <div class="span6" id="menuHeader">
                        <img src="layout/imagenes/Home/btn_MieFood_76x50.png">
                        <img src="layout/imagenes/Home/btn_TengoHambre_76x50.png">
                        <img src="layout/imagenes/Home/btn_Blog_76x50.png">
                    </div>

                </div>
                <div class="span4">
                    <div id="contenedorLogin">
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
                </div>
            </div>


            <?php
            $mensaje = getSessionMessage();
            if (isset($mensaje)) {
                ?>
                <div id="modalDialogSessionMessage">
                    <?php echo $mensaje; ?>
                </div>
                <script>
                    $("#modalDialogSessionMessage").dialog({
                        autoOpen: true,
                        height: "auto",
                        width: "auto",
                        modal: true
                    });
                    $(".ui-widget-overlay").on("click", function(){
                        $("#modalDialogSessionMessage").dialog("close");
                    });
                </script>

                <?php
            }
            ?>