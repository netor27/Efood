<?php

class Direccion {

    public $idDireccion;
    public $idUsuario;
    public $idColonia;
    public $calle;
    public $numero;
    public $numeroInt;
    public $referencia;
    
    static function printHeader() {
        echo '<tr>';        
        echo '<td>idDireccion</td>';
        echo '<td>idColonia</td>';
        echo '<td>calle</td>';
        echo '<td>numero</td>';
        echo '<td>numero interior</td>';
        echo '<td>referencia</td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '</tr>';
    }

    function printDireccion() {
        echo '<tr>';  
        echo '<td>' . $this->idDireccion . '</td>';
        echo '<td>' . $this->idColonia . '</td>';
        echo '<td>' . $this->calle . '</td>';
        echo '<td>' . $this->numero . '</td>';
        echo '<td>' . $this->numeroInt . '</td>';
        echo '<td>' . $this->referencia . '</td>';
        echo '<td><a href=usuarios.php?a=modificacionDireccion&i='.$this->idDireccion.'>Editar</a></td>';
        $texto = "'Se ha eliminado la direccion'";
        $locacion = "'usuarios.php?a=bajaDireccion&i='";
        echo '<td><a href="javascript:confirmation('.$this->idDireccion.','.$this->idDireccion.','.$texto.','.$locacion.')">Eliminar</a></td>';
        echo '</tr>';
    }

}
?>