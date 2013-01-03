<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<h2>Categorías del restaurante "<?php echo $restaurante->nombre; ?>"</h2>
<h4>
    <a href="platillos.php?c=categorias&a=alta&r=<?php echo $restaurante->idRestaurante; ?>">
        Agregar categoria
    </a>
</h4>
<form method="post" action="platillos.php?c=categorias&a=actualizarOrden&r=<?php echo $restaurante->idRestaurante;   ?>">
    <input type="hidden" name="r" value="<?php echo $restaurante->idRestaurante; ?>">
    <div class="row-fluid"><div class="span12"></div></div>
    <input style="margin-left: 75px;" type="submit" value="  Actualizar orden de las categorías  "/>
    <div class="row-fluid"><div class="span12"></div></div>
    <table border="1">
        <?php
        require_once 'modulos/platillos/clases/CategoriaPlatillo.php';
        CategoriaPlatillo::printCategoriaPlatilloHeader();
        $i = 0;
        if (isset($categorias)) {
            $n = sizeof($categorias);
            foreach ($categorias as $categoria) {
                $categoria->printCategoriaPlatillo($n, $i);
                $i++;
            }
        }
        ?>
    </table>
</form>
<a href="restaurantes.php?a=menu&i=<?php echo $idRestaurante; ?>">Regresar</a>

<?php
require_once('layout/footer.php');
?>