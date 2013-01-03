<?php

/**
 * Description of Restaurante
 *
 * @author neto
 */
class Restaurante {

    public $idRestaurante;
    public $usuario;
    public $password;
    public $nombre;
    public $idColonia;
    public $descripcion;
    public $logo;
    public $pedidoMinimo;
    public $gastoEnvio;
    public $formaPago;
    public $rfc;
    public $razonSocial;
    public $paginaWeb;
    public $telefono;
    public $email;
    public $metodoEntrega;
    public $calle;
    public $numero;
    public $numeroInt;
    public $referencia;
    public $nombreContacto;
    public $telefonoContacto;
    public $tipoComision;
    public $comision;
    public $tipoGastoEnvio;
    public $habilitado;
    public $informacion;
    //No son parte de la bd
    public $nombreColonia;
    public $horario;
    public $tiposComida;
    public $delegacion;

    static function printRestauranteHeader() {
        echo '<tr>';
        echo '<th>Logo</th>';
        echo '<th>Nombre</th>';
        echo '<th>Cambiar logo</th>';
        echo '<th>Colonias de entrega</th>';
        echo '<th>Menú</th>';
        echo '<th>Horario</th>';
        echo '<th>Tipo de comida</th>';
        echo '<th>habilitado</th>';
        echo '<th>editar</th>';
        echo '<th>borrar</th>';
        echo '</tr>';
    }

    function printRestaurante() {
        echo '<tr>';
        echo '<td><img class="img-rounded" style="width:100px;" src="' . $this->logo . '" /></td>';
        echo '<td>' . $this->nombre . '</td>';
        echo '<td><a href="restaurantes.php?a=actualizarLogo&i=' . $this->idRestaurante . '">Ver Logo</td>';
        echo '<td><a href="restaurantes.php?a=coloniasEntregaRestaurante&i=' . $this->idRestaurante . '">Colonias de entrega</a></td>';
        echo '<td><a href="restaurantes.php?a=menu&i=' . $this->idRestaurante . '">Ver Menú</a></td>';
        echo '<td><a href="restaurantes.php?a=horario&i=' . $this->idRestaurante . '">Horario</a></td>';
        echo '<td><a href="restaurantes.php?a=tipoComida&i=' . $this->idRestaurante . '">Tipo de Comida</a></td>';
        echo '<td>' . getTextoHabilitado($this->habilitado) . '</td>';
        echo '<td><a href="restaurantes.php?a=editar&i=' . $this->idRestaurante . '">Editar</a></td>';
        $restaurante = "'" . $this->nombre . "'";
        $texto = "'Se ha eliminado el restaurante'";
        $locacion = "'restaurantes.php?a=borrar&i='";
        echo '<td><a class="btnBorrarRestaurante cursorPointer" id="' . $this->idRestaurante . '">Eliminar</a></td>';
        echo '</tr>';
    }

    static function printRestaurantePedidoHeader() {
        echo '<tr>';
        echo '<th>Logo</th>';
        echo '<th>nombre</th>';
        echo '<th>Menú</th>';
        echo '<th>Horario</th>';
        echo '<th>Tipo de comida</th>';
        echo '<th>descripcion</th>';
        echo '<th>pedidoMinimo</th>';
        echo '<th>gastoEnvio</th>';
        echo '<th>formaPago</th>';
        echo '<th>paginaWeb</th>';
        echo '<th>telefono</th>';
        echo '<th>email</th>';
        echo '<th>metodoEntrega</th>';
        echo '</tr>';
    }

    function printRestaurantePedido() {
        echo '<tr>';
        echo '<td><img src="' . $this->logo . '" alt="logo" width="150" height="100"></td>';
        echo '<td>' . $this->nombre . '</td>';
        echo '<td><a href="pedidos.php?a=menu&i=' . $this->idRestaurante . '">Ver Menú</a></td>';
        echo '<td><a href="restaurantes.php?a=horario&i=' . $this->idRestaurante . '">Horario</a></td>';
        echo '<td><a href="restaurantes.php?a=tipoComida&i=' . $this->idRestaurante . '">Tipo de Comida</a></td>';
        echo '<td>' . $this->descripcion . '</td>';
        echo '<td>' . $this->pedidoMinimo . '</td>';
        echo '<td>' . $this->gastoEnvio . '</td>';
        echo '<td>' . getTextoFormaDePago($this->formaPago) . '</td>';
        echo '<td>' . $this->paginaWeb . '</td>';
        echo '<td>' . $this->telefono . '</td>';
        echo '<td>' . $this->email . '</td>';
        echo '<td>' . getTextoMetodoEntrega($this->metodoEntrega) . '</td>';
        echo '</tr>';
    }

}

?>