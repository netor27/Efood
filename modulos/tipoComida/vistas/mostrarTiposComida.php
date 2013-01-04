<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<h2>Todos los tipos de comida</h2>
<h4><a href="tiposComida.php?a=alta">Agregar tipo de comida</a></h4>
<div style="width:100%;">
    <table border="1">
        <?php
        require_once 'modulos/tipoComida/clases/tipoComida.php';
        TipoComida::printHeaderTipoComida();
        if (isset($tiposComida)) {
            foreach ($tiposComida as $tipoComida) {
                $tipoComida->printTipoComida();
            }
        }
        ?>
    </table>
</div>
<a href="index.php">Regresar</a>
<?php
require_once('layout/footer.php');
?>