<?php

class Platillo {

    public $idPlatillo;
    public $idRestaurante;
    public $nombre;
    public $categoria;
    public $descripcion;
    public $precioBase;
    public $hint;

    static function printHeader() {
        echo '<tr>';
        echo '<th>idPlatillo</th>';
        echo '<th>idRestaurante</th>';
        echo '<th>nombre</th>';
        echo '<th>categoria</th>';
        echo '<th>descripcion</th>';
        echo '<th>precioBase</th>';
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
        echo '<td>' . $this->categoria . '</td>';
        echo '<td>' . $this->descripcion . '</td>';
        echo '<td>' . $this->precioBase . '</td>';
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
        /* echo '<tr>';
          echo '<th>nombre</th>';
          echo '<th>descripcion</th>';
          echo '<th>precioBase</th>';
          echo '<th>Hint</th>';
          echo '<th></th>';
          echo '</tr>'; */
    }

    function printPlatilloPedido($tipoPlatillo, $tipoFila) {
        echo '<div class="' . $tipoPlatillo . ' ' . $tipoFila . ' span6 popupPlatillo" id="' . $this->idPlatillo . '" nombre="' . $this->nombre . '" precio="' . $this->precioBase . '" texto="' . $this->descripcion . '">';
        echo '  <div class="span8 offset1">';
        if (strlen($this->nombre) < 25)
            echo '      <span class="menuTexto">';
        else
            echo '      <span class="menuTextoChico">';
        echo '          ' . $this->nombre;
        echo '      </span>';
        echo '  </div>';
        echo '  <div class="span3">';
        echo '      <span class="menuTexto">$ ';
        echo '          ' . $this->precioBase;
        echo '      </span>';
        echo '  </div>';
        echo '</div>';
    }

    function printPlatilloPedidoDeshabilitado($tipoPlatillo, $tipoFila) {
        echo '<div class="' . $tipoPlatillo . ' ' . $tipoFila . ' span6 popupPlatilloNoDisponible" id="' . $this->idPlatillo . '" nombre="' . $this->nombre . '" precio="' . $this->precioBase . '" texto="' . $this->descripcion . '">';
        echo '  <div class="span8 offset1">';
        if (strlen($this->nombre) < 25)
            echo '      <span class="menuTexto">';
        else
            echo '      <span class="menuTextoChico">';
        echo '          ' . $this->nombre;
        echo '      </span>';
        echo '  </div>';
        echo '  <div class="span3">';
        echo '      <span class="menuTexto">$ ';
        echo '          ' . $this->precioBase;
        echo '      </span>';
        echo '  </div>';
        echo '</div>';
    }

}

?>