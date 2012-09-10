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
    //No son parte de la bd
    public $nombreColonia;

    static function printRestauranteHeader() {
        echo '<tr>';
        echo '<th>idRestaurante</th>';
        echo '<th>nombre</th>';
        echo '<th>idColonia</th>';
        echo '<th>Logo</th>';
        echo '<th>Colonias de entrega</th>';
        echo '<th>Menú</th>';
        echo '<th>Horario</th>';
        echo '<th>Tipo de comida</th>';
        echo '<th>usuario</th>';
        echo '<th>password</th>';
        echo '<th>descripcion</th>';
        echo '<th>pedidoMinimo</th>';
        echo '<th>tipoGastoEnvio</th>';
        echo '<th>gastoEnvio</th>';
        echo '<th>formaPago</th>';
        echo '<th>rfc</th>';
        echo '<th>razonSocial</th>';
        echo '<th>paginaWeb</th>';
        echo '<th>telefono</th>';
        echo '<th>email</th>';
        echo '<th>metodoEntrega</th>';
        echo '<th>calle</th>';
        echo '<th>numero</th>';
        echo '<th>numeroInt</th>';
        echo '<th>referencia</th>';
        echo '<th>nombreContacto</th>';
        echo '<th>telefonoContacto</th>';
        echo '<th>tipoComision</th>';
        echo '<th>comision</th>';

        echo '<th>habilitado</th>';
        echo '<th>editar</th>';
        echo '<th>borrar</th>';
        echo '</tr>';
    }

    function printRestaurante() {
        echo '<tr>';
        echo '<td>' . $this->idRestaurante . '</td>';
        echo '<td>' . $this->nombre . '</td>';
        echo '<td><a href="colonias.php?i=' . $this->idColonia . '">' . $this->idColonia . '</a></td>';
        echo '<td><a href="restaurantes.php?a=actualizarLogo&i=' . $this->idRestaurante . '">Ver Logo</td>';
        echo '<td><a href="restaurantes.php?a=coloniasEntregaRestaurante&i=' . $this->idRestaurante . '">Colonias de entrega</a></td>';
        echo '<td><a href="restaurantes.php?a=menu&i=' . $this->idRestaurante . '">Ver Menú</a></td>';
        echo '<td><a href="restaurantes.php?a=horario&i=' . $this->idRestaurante . '">Horario</a></td>';
        echo '<td><a href="restaurantes.php?a=tipoComida&i=' . $this->idRestaurante . '">Tipo de Comida</a></td>';
        echo '<td>' . $this->usuario . '</td>';
        echo '<td>' . $this->password . '</td>';
        echo '<td>' . $this->descripcion . '</td>';
        echo '<td>' . $this->pedidoMinimo . '</td>';
        echo '<td>' . getTextoTipoGastoEnvio($this->tipoGastoEnvio) . '</td>';
        echo '<td>' . $this->gastoEnvio . '</td>';
        echo '<td>' . getTextoFormaDePago($this->formaPago) . '</td>';
        echo '<td>' . $this->rfc . '</td>';
        echo '<td>' . $this->razonSocial . '</td>';
        echo '<td>' . $this->paginaWeb . '</td>';
        echo '<td>' . $this->telefono . '</td>';
        echo '<td>' . $this->email . '</td>';
        echo '<td>' . getTextoMetodoEntrega($this->metodoEntrega) . '</td>';
        echo '<td>' . $this->calle . '</td>';
        echo '<td>' . $this->numero . '</td>';
        echo '<td>' . $this->numeroInt . '</td>';
        echo '<td>' . $this->referencia . '</td>';
        echo '<td>' . $this->nombreContacto . '</td>';
        echo '<td>' . $this->telefonoContacto . '</td>';
        echo '<td>' . getTextoTipoComision($this->tipoComision) . '</td>';
        echo '<td>' . $this->comision . '</td>';
        echo '<td>' . getTextoHabilitado($this->habilitado) . '</td>';
        echo '<td><a href="restaurantes.php?a=editar&i=' . $this->idRestaurante . '">Editar</a></td>';

        $restaurante = "'" . $this->nombre . "'";
        $texto = "'Se ha eliminado el restaurante'";
        $locacion = "'restaurantes.php?a=borrar&i='";

        echo '<td><a href="javascript:confirmation(' . $this->idRestaurante . ',' . $restaurante . ',' . $texto . ',' . $locacion . ')">Eliminar</a></td>';


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