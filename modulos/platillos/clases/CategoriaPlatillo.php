<?php

class CategoriaPlatillo {

    public $idCategoriaPlatillo;
    public $idRestaurante;
    public $nombre;
    public $descripcion;
    public $orden;

    static function printCategoriaPlatilloHeader() {
        echo '<tr>';

        echo '<th>Nombre</th>';
        echo '<th>Orden</th>';
        echo '<th>Descripción</th>';
        echo '<th>Editar</th>';
        echo '<th>Borrar</th>';
        echo '</tr>';
    }

    function printCategoriaPlatillo($n, $i) {
        echo '<tr>';
        echo '<td>' . $this->nombre . '</td>';
        echo '<td>
            <input type="hidden" name="ids[]" value="' . $i . '">
            <input type="hidden" name="id' . $i . '" value="' . $this->idCategoriaPlatillo . '">
            <select name="orden' . $i . '" style="width:75px">';
        for ($i = 1; $i <= $n; $i++) {
            if ($this->orden == $i)
                echo '<option selected>' . $i . '</option>';
            else
                echo '<option>' . $i . '</option>';
        }
        echo '</select></td>';
        echo '<td>' . $this->descripcion . '</tD>';
        echo '<td><a href="platillos.php?c=categorias&a=modificar&i=' . $this->idCategoriaPlatillo . '&r=' . $this->idRestaurante . '">Modificar</a></td>';

        $categoria = "'" . $this->nombre . "'";
        $texto = "'Se borrará la categoria'";
        $locacion = "'platillos.php?c=categorias&r=" . $this->idRestaurante . "&a=borrar&i='";
        echo '<td><a href="javascript:confirmation(' . $this->idCategoriaPlatillo . ',' . $categoria . ',' . $texto . ',' . $locacion . ')">Eliminar</a></td>';
        echo '</tr>';
    }

}

?>