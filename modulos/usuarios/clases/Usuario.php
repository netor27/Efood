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
        $habilitado = $this->habilitado!='1' ? 'No' : 'Si';
        echo '<tr>';  
        echo '<td>' . $this->idUsuario . '</td>';
        echo '<td>' . $this->email . '</td>';
        echo '<td>' . $this->telefono . '</td>';
        echo '<td>' . $this->tipo . '</td>';
        echo '<td>' . $habilitado . '</td>';
        $usuario = "'".$this->email."'";
        $texto = "'Se ha eliminado el usuario'";
        $locacion = "'usuarios.php?a=baja&i='";
        echo '<td><a href="javascript:confirmation('.$this->idUsuario.','.$usuario.','.$texto.','.$locacion.')">Eliminar</a></td>';
        echo '</tr>';
    }

}

?>