<?php

/**
 * Description of Ingrediente
 *
 * @author neto
 */
class Ingrediente {

    public $idIngrediente;
    public $idGrupoIngredientes;
    public $nombre;
    public $precio;
    
    static function printIngredienteHeader() {
        echo '<tr>';
        echo '<th>Nombre</th>';
        echo '<th>Precio</th>';
        echo '<th>Editar</th>';
        echo '<th>Borrar</th>';
        echo '</tr>';
    }

    function printIngrediente() {
        echo '<tr>';
        echo '<td>' . $this->nombre . '</tD>';
        echo '<td>' . $this->precio . '</tD>';
        echo '<td><a href="ingredientes.php?a=modificar&i=' . $this->idIngrediente . '">Modificar</a></td>';
        echo '<td><a class="btnBorrarIngrediente cursorPointer" id="'.$this->idIngrediente.'">Eliminar</a></td>';        
        echo '</tr>';
    }

}

?>