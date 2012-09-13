<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>

<h2>Horario del platillo: "<?php echo $platillo->nombre; ?>"</h2>
<?php
if (isset($error)) {
    echo '<h2 style="color: red">' . $error . '</h2>';
}
?>


<table border="1">
    <?php
    require_once 'modulos/restaurantes/clases/Horario.php';
    Horario::printHorarioHeader();
    $horario->printHorario();
    ?>
</table>
<h2>Copiar Horario de otro platillo</h2>
<form action="platillos.php?a=copiarHorario" method="POST">
    <input type="hidden" name="idPlatillo" value="<?php echo $platillo->idPlatillo; ?>">
    <ul>
        <li>
            <select name="platilloPorCopiar">
                <option value="">Selecciona un platillo...</option>
                <?php
                if (isset($platillos)) {
                    foreach ($platillos as $platillo) {
                        echo '<option value="' . $platillo->idPlatillo . '">' . $platillo->nombre . '</option>';
                    }
                }
                ?>
            </select>
        </li>
        <li>
            <input type="submit" value="Copiar Horario">
        </li>
    </ul>
</form>
<h2>Actualizar Horario</h2>
<form action="platillos.php?a=actualizarHorario" method="POST">
    <input type="hidden" name="idPlatillo" value="<?php echo $platillo->idPlatillo; ?>">
    <ul>
        <li>            
            <input type="checkbox" name="LU">
            <label>Lunes</label><br>
            <input type="checkbox" name="MA">
            <label>Martes</label><br>
            <input type="checkbox" name="MI">
            <label>Miércoles</label><br>
            <input type="checkbox" name="JU">
            <label>Jueves</label><br>
            <input type="checkbox" name="VI">
            <label>Viernes</label><br>
            <input type="checkbox" name="SA">
            <label>Sábado</label><br>
            <input type="checkbox" name="DO">
            <label>Domingo</label><br>

        </li>
        <li>
            <label>
                Seleccionar horario,
            </label>
            desde:
            <select name="iniH">
                <?php
                $i = 0;
                for ($i = 0; $i < 24; $i++) {
                    echo '<option value=' . $i . '>' . getNumber2Digits($i) . '</option>';
                }
                ?>
            </select>:
            <select name="iniM">
                <?php
                $i = 0;
                for ($i = 0; $i < 60; $i+=10) {
                    echo '<option value=' . $i . '>' . getNumber2Digits($i) . '</option>';
                }
                echo '<option value=59>' . getNumber2Digits(59) . '</option>';
                ?>
            </select>
            hasta:
            <select name="finH">
                <?php
                $i = 0;
                for ($i = 0; $i < 24; $i++) {
                    echo '<option value=' . $i . '>' . getNumber2Digits($i) . '</option>';
                }
                ?>
            </select>:
            <select name="finM">
                <?php
                $i = 0;
                for ($i = 0; $i < 60; $i+=10) {
                    echo '<option value=' . $i . '>' . getNumber2Digits($i) . '</option>';
                }
                echo '<option value=59>' . getNumber2Digits(59) . '</option>';
                ?>
            </select><br>

        </li>
        <li>
            <select name="horario">
                <option value="0">Horario establecido arriba</option>
                <option value="1">Abierto todo el día</option>
                <option value="2">Cerrado</option>
            </select>
        </li>
        <li>
            <input type="submit" value="Actualizar">
        </li>
    </ul>
</form>
<br>
<a href="restaurantes.php?a=menu&i=<?php echo $platillo->idRestaurante; ?>">Regresar</a>
<?php
require_once('layout/footer.php');
?>