<?php

class Platillo {

    public $idPlatillo;
    public $idRestaurante;
    public $nombre;
    public $idCategoria;
    public $descripcion;
    public $precioBase;
    public $hint;

    static function printHeader() {
        echo '<tr>';
        echo '<th>idPlatillo</th>';
        echo '<th>idRestaurante</th>';
        echo '<th>nombre</th>';
        echo '<th>idCategoria</th>';
        echo '<th>descripcion</th>';
        echo '<th>precioBase</th>';
        echo '<th>Hint</th>';
        echo '<th>Grupos Ingredientes</th>';
        echo '<th>Horario</th>';
        echo '<th>Modificar</th>';
        echo '<th>Eliminar</th>';
        echo '</tr>';
    }

    function printPlatillo() {
        echo '<tr>';
        echo '<td>' . $this->idPlatillo . '</td>';
        echo '<td>' . $this->idRestaurante . '</td>';
        echo '<td>' . $this->nombre . '</td>';
        echo '<td>' . $this->idCategoria . '</td>';
        echo '<td>' . $this->descripcion . '</td>';
        echo '<td>' . $this->precioBase . '</td>';
        echo '<td>' . $this->hint . '</td>';
        echo '<td><a href="grupoIngredientes.php?i=' . $this->idPlatillo . '">Ver Grupos Ingredientes </a></td>';
        echo '<td><a href="platillos.php?a=horario&i=' . $this->idPlatillo . '">Horario</a></td>';
        echo '<td><a href="platillos.php?a=modificar&i=' . $this->idPlatillo . '">Modificar</a></td>';

        $platillo = "'" . $this->nombre . "'";
        $texto = "'Se ha eliminado el platillo'";
        $locacion = "'platillos.php?a=borrar&i='";
        echo '<td><a href="javascript:confirmation(' . $this->idPlatillo . ',' . $platillo . ',' . $texto . ',' . $locacion . ')">Eliminar</a></td>';

        echo '</tr>';
    }
    
     static function printPlatilloPedidoHeader() {
        echo '<tr>';
        echo '<th>nombre</th>';
        echo '<th>descripcion</th>';
        echo '<th>precioBase</th>';
        echo '<th>Hint</th>';
        echo '<th></th>';
        echo '</tr>';
    }

    function printPlatilloPedido() {
        echo '<tr>';
        echo '<td>' . $this->nombre . '</td>';
        echo '<td>' . $this->descripcion . '</td>';
        echo '<td>' . $this->precioBase . '</td>';
        echo '<td>' . $this->hint . '</td>';
        echo '<td><div class="popup" id="'.$this->idPlatillo.'"><a  rel="superbox[content]">Agregar</a></div></td>';
       //echo '<td><div class="popup" id="'.$this->idPlatillo.'">Agregar</div></td>';
       // echo "<td><form method='POST' action='pedidos.php?a=obtenIngredientes'><input type='hidden' value=".$this->idPlatillo." name='platillo'/><input type='submit' value='enviar'/></form></td>";
        echo '</tr>';
    }
    
    function printPlatilloPedidoDeshabilitado() {
        echo '<tr>';
        echo '<td>' . $this->nombre . '</td>';
        echo '<td>' . $this->descripcion . '</td>';
        echo '<td>' . $this->precioBase . '</td>';
        echo '<td>' . $this->hint . '</td>';
        echo '<td></td>';
       // echo "<td><form method='POST' action='pedidos.php?a=obtenIngredientes'><input type='hidden' value=".$this->idPlatillo." name='platillo'/><input type='submit' value='enviar'/></form></td>";
        echo '</tr>';
    }

}

?>