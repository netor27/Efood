<?php

class Pedido {

    public $idPedidoPlatillo;
    public $idPedido;
    public $idPlatillo;
    public $especificaciones;
    public $cantidad;
    
    
    static function printHeader() {
        echo '<tr>';        
        echo '<td>idPedidoPlatillo</td>';
        echo '<td>idPedido</td>';
        echo '<td>idPlatillo</td>';
        echo '<td>especificaciones</td>';
        echo '<td>cantidad</td>';
        echo '</tr>';
    }

    function printUsuario() {
        echo '<tr>';  
        echo '<td>' . $this->idPedidoPlatillo . '</td>';
        echo '<td>' . $this->idPedido . '</td>';
        echo '<td>' . $this->telefono . '</td>';
        echo '<td>' . $this->idPlatillo . '</td>';
        echo '<td>' . $this->especificaciones . '</td>';
        echo '<td>' . $this->cantidad . '</td>';
        echo '</tr>';
    }

}

?>
