</head>
<body>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=499264860093463";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script type="text/javascript">
        if (window.location.hash == '#_=_')
            window.location = '';
    </script>
    <div id="contenedor">
        <div id="contenido">
            <!-- Contenido header -->
            <div id="contenidoHeader" class="row-fluid">
                <div class="span8">
                    <div id="headerLogo" class="span5">
                        <a href="/">
                            <img class="span10 offset1" src="layout/imagenes/Home/Logo_letras_164x80.png" alt="efood" style="width: 164px;margin-top: 10px;">
                        </a>
                    </div>
                    <div class="span7" id="headerTitles">
                        <div class="header_title centerText span9">
                            <span id="header_black_title">¡Ordena Comida a</span>
                            <span id="header_red_title" >Domicilio Online!</span>
                        </div>
                        <div class="span3">
                            <a class="entrarBtn">
                                <?php
                                if (isset($_SESSION['email'])) {
                                    ?>
                                    <a href="#">
                                        <img class="registrateImg" alt="registrate, es gratis" src="layout/imagenes/Home/btnInvitarAmigo.png">
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <a class="entrarBtn">
                                        <img class="registrateImg" alt="registrate, es gratis" src="layout/imagenes/Home/Registrate_Gratis_111x76.png">
                                    </a>
                                    <?php
                                }
                                ?>

                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div id="contenedorLogin">
                        <div class="row-fluid">
                            <div class="span12 headerLinksContainer">
                                <a class="btnRecomendar">Recomienda un restaurante</a>
                                <a href="#">FAQ</a>
                                <?php
                                if (isset($_SESSION['email'])) {
                                    ?>
                                    <a href='login.php?a=logout'>Cerrar Sesión</a>
                                    <?php
                                } else {
                                    ?>
                                    <a class="entrarBtn">Inicia sesión</a>
                                    <?php
                                }
                                ?>

                            </div>        
                        </div>

                        <?php
                        require 'modulos/principal/vistas/login.php';
                        ?>
                    </div>
                </div>
            </div>
            <div class="span6" id="menuHeader">
                <a href="#"><img src="layout/imagenes/Home/btn_MieFood_76x50.png"></a>
                <a href="#"><img src="layout/imagenes/Home/btn_TengoHambre_76x50.png"></a>
                <a href="http://blog.efood.com.mx/" target="_blank"><img src="layout/imagenes/Home/btn_Blog_76x50.png"></a>
            </div>
            <?php
            $mensaje = getSessionMessage();
            if (isset($mensaje)) {
                ?>
                <div id="modalDialogSessionMessage" style="display:none">
                    <?php echo $mensaje; ?>
                </div>
                <script>
                    $("#modalDialogSessionMessage").dialog({
                        autoOpen: true,
                        height: "auto",
                        width: "auto",
                        modal: true,
                        resizable:false 
                    });
                    $(".ui-widget-overlay").on("click", function(){
                        $("#modalDialogSessionMessage").dialog("close");
                    });
                </script>

                <?php
            }
            ?>
            <!-- Dialogo para recomendar nuevos restaurantes -->
            <div id="modalDialogRecomendarRestaurante" title="Recomendar un restaurante" style="display: none;">
                <div class="row-fluid"><div class="span12"></div></div>
                <div class="row-fluid">
                    <div class="span12">
                        <p>
                            Deja los datos del restaurante que te gustaría ver aquí y lo registramos de volada.
                        </p>
                    </div>
                </div>
                <legend>Datos del restaurante</legend>
                <form action="pedidos.php?a=usuarioSolicitudRestaurante" method="post">
                    <div class="row-fluid">
                        <label class="span4">Nombre:</label>
                        <input class="span8" type="text" name="nombre"> 
                    </div>
                    <div class="row-fluid">
                        <label class="span4">Teléfono: (Opcional)</label>
                        <input class="span8" type="text" name="telefono">
                    </div>
                    <div class="row-fluid">
                        <label class="span4">Dirección:  (Opcional)</label>
                        <input class="span8" type="text" name="direccion">
                    </div>
                    <div class="row-fluid"><div class="span12"></div></div>
                    <div class="row-fluid">
                        <div class="span5 offset4">
                            <input type="image" src="layout/imagenes/btnEnviarDatos.png">
                        </div>
                    </div>
                    <input type="hidden" name="idColonia" value="-1">
                </form>
            </div>
