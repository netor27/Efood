<?php

class TipoComida {

    public $idTipoComida;
    public $nombre;
    public $imagen;

    static function printHeaderTipoComida() {
        echo '<tr>';
        echo '<th>Tipo de comida</th>';
        echo '<th>Imagen</th>';
        echo '<th></th>';
        echo '<th></th>';
        echo '</tr>';
    }

    function printTipoComida(){
        echo '<tr>';
        echo '<td>'. $this->nombre . '</td>';
        echo '<td><img src="'. $this->imagen . '"></td>';
        echo '<td><a href="tiposComida.php?a=modificar&i='. $this->idTipoComida . '">Modificar</a></td>';
        echo "<td><a onclick='return confirm(\"Seguro que deseas borrarlo?\")' href='tiposComida.php?a=borrar&i=". $this->idTipoComida . "'>Eliminar</a></td>";
        echo '</tr>';
    }
}

?>