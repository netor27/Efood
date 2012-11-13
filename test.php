<?php

date_default_timezone_set('America/Mexico_City');
echo "La fecha es: " . date("d/m/Y  H:i:s") . "<br />";    

require_once 'funcionesPHP/funcionesGenerales.php';
echo '<br>';
echo getTime24();
?>
