<?php

class Platillo {

    public $idPlatillo;
    public $idRestaurante;
    public $nombre;
    public $idCategoriaPlatillo;
    public $descripcion;
    public $precioBase;
    public $hint;
    
    //No es parte de la tabla de la bd
    public $nombreCategoria;

    static function printHeader() {
        echo '<tr>';
        echo '<th>Nombre</th>';
        echo '<th>Categoria Platillo</th>';
        echo '<th>Descripcion</th>';
        echo '<th>Precio Base</th>';
        echo '<th>Grupos Ingredientes</th>';
        echo '<th>Horario</th>';
        echo '<th>Modificar</th>';
        echo '<th>Eliminar</th>';
        echo '</tr>';
    }

    function printPlatillo() {
        echo '<tr>';
        echo '<td>' . $this->nombre . '</td>';
        if(isset($this->idCategoriaPlatillo)){
            echo '<td>' . $this->nombreCategoria . '</td>';
        }else{
            echo '<td>No asignado</td>';
        }
        
        echo '<td>' . $this->descripcion . '</td>';
        echo '<td>' . $this->precioBase . '</td>';
        echo '<td><a href="grupoIngredientes.php?i=' . $this->idPlatillo . '">Ver Grupos Ingredientes </a></td>';
        echo '<td><a href="platillos.php?a=horario&i=' . $this->idPlatillo . '">Horario</a></td>';
        echo '<td><a href="platillos.php?a=modificar&i=' . $this->idPlatillo . '">Modificar</a></td>';
        echo '<td><a class="btnBorrarPlatillo cursorPointer" id="' . $this->idPlatillo . '">Eliminar</a></td>';
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
        echo '<div class="platillo ' . $tipoPlatillo . ' ' . $tipoFila . ' span6 popupPlatillo" id="' . $this->idPlatillo . '" nombre="' . $this->nombre . '" precio="' . $this->precioBase . '" texto="' . $this->descripcion . '">';
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
        echo '<div class="platillo ' . $tipoPlatillo . ' ' . $tipoFila . ' span6 popupPlatilloNoDisponible" id="' . $this->idPlatillo . '" nombre="' . $this->nombre . '" precio="' . $this->precioBase . '" texto="' . $this->descripcion . '">';
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