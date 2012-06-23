<?php

/**
 * Description of horario
 *
 * @author neto
 * 
 */
class Horario {

    public $luIni;
    public $luFin;
    public $maIni;
    public $maFin;
    public $miIni;
    public $miFin;
    public $juIni;
    public $juFin;
    public $viIni;
    public $viFin;
    public $saIni;
    public $saFin;
    public $doIni;
    public $doFin;

    static function printHorarioHeader() {
        echo '<tr>';
        echo '<th>Día</th>';
        echo '<th>Desde</th>';
        echo '<th>Hasta</th>';
        echo '</tr>';
    }

    function printHorario() {
        echo '<tr>';
        echo '<td>Lunes</td>';
        echo '<td>' . getTimeHHMM($this->luIni) . '</td>';
        echo '<td>' . getTimeHHMM($this->luFin) . '</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Martes</td>';
        echo '<td>' . getTimeHHMM($this->maIni) . '</td>';
        echo '<td>' . getTimeHHMM($this->maFin) . '</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Miércoles</td>';
        echo '<td>' . getTimeHHMM($this->miIni) . '</td>';
        echo '<td>' . getTimeHHMM($this->miFin) . '</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Jueves</td>';
        echo '<td>' . getTimeHHMM($this->juIni) . '</td>';
        echo '<td>' . getTimeHHMM($this->juFin) . '</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Viernes</td>';
        echo '<td>' . getTimeHHMM($this->viIni) . '</td>';
        echo '<td>' . getTimeHHMM($this->viFin) . '</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Sábado</td>';
        echo '<td>' . getTimeHHMM($this->saIni) . '</td>';
        echo '<td>' . getTimeHHMM($this->saFin) . '</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Domingo</td>';
        echo '<td>' . getTimeHHMM($this->doIni) . '</td>';
        echo '<td>' . getTimeHHMM($this->doFin) . '</td>';
        echo '</tr>';
    }

}

?>
