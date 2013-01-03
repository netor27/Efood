<?php

class Usuario {

    public $idUsuario;
    public $email; //Email cumple las funciones de username
    public $password;
    public $telefono;
    public $tipo;
    public $habilitado;

    static function printHeader() {
        echo '<tr>';
        echo '<td>idUsuario</td>';
        echo '<td>email</td>';
        echo '<td>telefono</td>';
        echo '<td>tipo</td>';
        echo '<td>habilitado</td>';
        echo '<td></td>';
        echo '</tr>';
    }

    function printUsuario() {
        echo '<tr>';
        echo '<td>' . $this->idUsuario . '</td>';
        echo '<td>' . $this->email . '</td>';
        echo '<td>' . $this->telefono . '</td>';
        switch ($this->tipo) {
            case 0:
                echo '<td>Usuario</td>';
                break;
            case 1:
                echo '<td>Administrador</td>';
                break;
            default:
                echo '<td>Tipo no reconocido</td>';
                break;
        }
        $habilitado = $this->habilitado != '1' ? 'No' : 'Si';
        echo '<td>' . $habilitado . '</td>';
        echo '<td><a class="btnBorrarUsuario cursorPointer" id="' . $this->idUsuario . '">Eliminar usuario</a></td>';
        
        echo '</tr>';
    }

}

?>