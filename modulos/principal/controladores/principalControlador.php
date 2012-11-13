<?php

function principal() {
    require_once 'modulos/colonias/modelos/ColoniaModelo.php';
    $colonias = getColonias();    
    require_once 'modulos/tipoComida/modelos/tipoComidaModelo.php';
    $tiposComida = getTiposComida();
    
    include('lib/rssFeed/rssFeed.php');
    $blogEntries = parseRssFeed('http://blog.efood.com.mx/feeds/posts/default?alt=rss');    
    require_once('modulos/principal/vistas/principal.php');
}

?>