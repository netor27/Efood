<html>
    <head>
        <title>Admin Restaurantes</title>
    </head>
    <body>
        <h1>Pagina de inicio de administracion de restaurantes</h1>
        <br>
        <h2><a href="restaurantes.php?a=editar&i=<?php echo $restaurante->idRestaurante; ?>">Datos del restaurante</a></h2>
        <h2><a href="restaurantes.php?a=menu&i=<?php echo $restaurante->idRestaurante; ?>">Menu</a></h2>
        <h2><a href="#">Estado de cuenta</a></h2>
    </body>
</html>