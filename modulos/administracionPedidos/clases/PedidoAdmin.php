<?php

class PedidoAdmin {

    public $idPedido;
    public $idRestaurante;
    public $idUsuario;
    public $idEstadoPedido;
    public $comentario;
    public $idMetodoEntrega;
    public $idTipoPago;
    public $numReferencia;    
    
    static function printHeader() {
        echo '<tr>';        
        echo '<td>idPedido</td>';
        echo '<td>idRestaurante</td>';
        echo '<td>idUsuario</td>';
        echo '<td>idEstadoPedido</td>';
        echo '<td>comentario</td>';
        echo '<td>idMetodoEntrega</td>';
        echo '<td>idTipoPago</td>';
        echo '<td>numReferencia</td>';
        echo '</tr>';
    }

    function printPedido() {
        echo '<tr>';  
        echo '<td>' . $this->idPedido . '</td>';
        echo '<td>' . $this->idRestaurante . '</td>';
        echo '<td>' . $this->idUsuario . '</td>';
        echo '<td>' . $this->idEstadoPedido . '</td>';
        echo '<td>' . $this->comentario . '</td>';
        echo '<td>' . $this->idMetodoEntrega . '</td>';
        echo '<td>' . $this->idTipoPago . '</td>';
        echo '<td>' . $this->numReferencia . '</td>';
        echo '</tr>';
    }

}
?>
