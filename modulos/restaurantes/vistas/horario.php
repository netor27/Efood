<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headHorario.php');
require_once('layout/headers/headFin.php');
?>

<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid">
    <div class="span11 offset1">
        <h2>Horario del restaurante: "<?php echo $restaurante->nombre; ?>"</h2>
    </div>    
</div>
<div class="row-fluid">
    <div class="span11 offset1">
        <?php
        if (isset($error)) {
            echo '<h2 style="color: red">' . $error . '</h2>';
        }
        ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span2 offset1">
        <table border="1">
            <?php
            require_once 'modulos/restaurantes/clases/Horario.php';
            Horario::printHorarioHeader();
            $horario->printHorario();
            ?>
        </table>
    </div>
    <div class="span9">
        <div class="row-fluid">
            <div class="span12">
                <h3>Actualizar Horario</h3>
            </div>
        </div>
        <form action="restaurantes.php?a=actualizarHorario" method="POST">
            <input type="hidden" name="idRestaurante" value="<?php echo $restaurante->idRestaurante; ?>">
            <div class="row-fluid">
                <div class="span3">                    
                    <label class="checkbox"><input class="checkboxHorario" type="checkbox" name="LU">Lunes</label>
                    <label class="checkbox"><input class="checkboxHorario" type="checkbox" name="MA">Martes</label>
                    <label class="checkbox"><input class="checkboxHorario" type="checkbox" name="MI">Miércoles</label>
                    <label class="checkbox"><input class="checkboxHorario" type="checkbox" name="JU">Jueves</label>
                    <label class="checkbox"><input class="checkboxHorario" type="checkbox" name="VI">Viernes</label>                    
                    <label class="checkbox"><input class="checkboxHorario" type="checkbox" name="SA">Sabado</label>
                    <label class="checkbox"><input class="checkboxHorario" type="checkbox" name="DO">Domingo</label>
                    <label class="checkbox"><input class="checkboxHorario" type="checkbox" id="checkAll">Marcar todos</label>
                </div>
                <div class="span9">
                    <div class="row-fluid">Selecciona el horario</div>
                    <div class="row-fluid">
                        <div class="span3">
                            Abierto Desde:
                        </div>
                        <div class="span9">
                            <select name="iniH" class="span3">
                                <?php
                                $i = 0;
                                for ($i = 0; $i < 24; $i++) {
                                    echo '<option value=' . $i . '>' . getNumber2Digits($i) . '</option>';
                                }
                                ?>
                            </select>:
                            <select name="iniM" class="span3">
                                <?php
                                $i = 0;
                                for ($i = 0; $i < 60; $i+=10) {
                                    echo '<option value=' . $i . '>' . getNumber2Digits($i) . '</option>';
                                }
                                echo '<option value=59>' . getNumber2Digits(59) . '</option>';
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span3">
                            Hasta:
                        </div>
                        <div class="span9">

                            <select name="finH" class="span3">
                                <?php
                                $i = 0;
                                for ($i = 0; $i < 24; $i++) {
                                    echo '<option value=' . $i . '>' . getNumber2Digits($i) . '</option>';
                                }
                                ?>
                            </select>:
                            <select name="finM" class="span3">
                                <?php
                                $i = 0;
                                for ($i = 0; $i < 60; $i+=10) {
                                    echo '<option value=' . $i . '>' . getNumber2Digits($i) . '</option>';
                                }
                                echo '<option value=59>' . getNumber2Digits(59) . '</option>';
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <select name="horario">
                            <option value="0">Horario establecido arriba</option>
                            <option value="1">Abierto todo el día</option>
                            <option value="2">Cerrado</option>
                        </select>
                    </div>
                    <div class="row-fluid">
                        <input type="submit" value="Actualizar">
                    </div>                    
                </div>                    
            </div>
        </form>
    </div>
</div>
<a  class="offset1" href="restaurantes.php">Regresar</a>
<?php
require_once('layout/footer.php');
?>