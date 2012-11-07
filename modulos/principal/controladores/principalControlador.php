<?php

function principal() {
    require_once 'modulos/colonias/modelos/ColoniaModelo.php';
    $colonias = getColonias();    
    require_once 'modulos/tipoComida/modelos/tipoComidaModelo.php';
    $tiposComida = getTiposComida();
    
    include('lib/rssFeed/rssFeed.php');
    //blog de test
    $blogEntries = parseRssFeed('http://testefood.blogspot.com/feeds/posts/default?alt=rss');
    //blog bueno
    //$blogEntries = parseRssFeed('http://efood.blogspot.mx/feeds/posts/default?alt=rss');
    
    require_once('modulos/principal/vistas/principal.php');
}

?>