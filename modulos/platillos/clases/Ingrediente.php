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
        echo '<th>idIngrediente</th>';
        echo '<th>idGrupoIngredientes</th>';
        echo '<th>Nombre</th>';
        echo '<th>Precio</th>';
        echo '<th>Editar</th>';
        echo '<th>Borrar</th>';
        echo '</tr>';
    }

    function printIngrediente() {
        echo '<tr>';
        echo '<td>' . $this->idIngrediente . '</td>';
        echo '<td>' . $this->idGrupoIngredientes . '</td>';
        echo '<td>' . $this->nombre . '</tD>';
        echo '<td>' . $this->precio . '</tD>';
        echo '<td><a href="ingredientes.php?a=modificar&i=' . $this->idIngrediente . '">Modificar</a></td>';
        
        $ingrediente = "'".$this->nombre."'";
        $texto = "'Se ha eliminado el ingrediente'";
        $locacion = "'ingredientes.php?a=borrar&i='";
        echo '<td><a href="javascript:confirmation('.$this->idIngrediente.','.$ingrediente.','.$texto.','.$locacion.')">Eliminar</a></td>';
        
        echo '</tr>';
    }

}

?>
