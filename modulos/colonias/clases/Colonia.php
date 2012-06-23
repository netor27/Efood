<?php
/**
 * Description of Colonia
 *
 * @author neto
 */
class Colonia {
    public $idColonia;
    public $idDelegacion;
    public $nombre;
    public $cp;
    
    static function printColoniaHeader(){
        echo '<tr>';
        echo '<th>Id</th>';
        echo '<th>Nombre</th>';
        echo '<th>CP</th>';
        echo '</tr>';
    }
    
    function printColonia(){
        echo '<tr>';
        echo '<td>'.$this->idColonia.'</td>';
        echo '<td>'.$this->nombre.'</td>';
        echo '<td>'.$this->cp.'</td>';
        echo '</tr>';
    }
}



?>
