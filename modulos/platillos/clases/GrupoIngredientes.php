<?php

/**
 * Description of GrupoIngredientes
 *
 * @author neto
 */
class GrupoIngredientes {

    public $idGrupoIngredientes;
    public $idPlatillo;
    public $nombre;
    public $excluyente;
    public $requerido;
    public $idGrupoDepende;
    public $idIngredienteDepende;

    static function printGrupoIngredientesHeader() {
        echo '<tr>';
        echo '<th>Nombre</th>';
        echo '<th>Excluyente</th>';
        echo '<th>Requerido</th>';
        echo '<th>Ver ingredientes</th>';
        echo '<th>Depende de grupo</th>';
        echo '<th>Depende de platillo</th>';

        echo '<th>Editar</th>';
        echo '<th>Borrar</th>';
        echo '</tr>';
    }

    function printGrupoIngredientes() {
        echo '<tr>';
        echo '<td>' . $this->nombre . '</tD>';
        if ($this->excluyente == 1)
            echo '<td>Si</td>';
        else
            echo '<td>No</td>';
        if ($this->requerido == 1)
            echo '<td>Si</td>';
        else
            echo '<td>No</td>';

        echo '<td><a href="ingredientes.php?i=' . $this->idGrupoIngredientes . '">Ver Ingredientes</a></td>';

        if ($this->idGrupoDepende >= 0) {
            echo '<td><a href="grupoIngredientes.php?a=mostrar&i=' . $this->idGrupoDepende . '">Grupo Ingr depende </a></td>';
        } else {
            echo '<td>Ninguno</td>';
        }
        if ($this->idIngredienteDepende >= 0) {
            echo '<td><a href="ingredientes.php?a=mostrar&i=' . $this->idIngredienteDepende . '">Ingrediente depende </a></td>';
        } else {
            echo '<td>Ninguno</td>';
        }
        echo '<td><a href="grupoIngredientes.php?a=modificar&i=' . $this->idGrupoIngredientes . '">Modificar</a></td>';
        $locacion = "'grupoIngredientes.php?a=borrar&i='";
        echo '<td><a class="btnBorrarGrupoIngredientes cursorPointer" id="' . $this->idGrupoIngredientes . '">Eliminar</a></td>';
        echo '</tr>';
    }
}

?>