<<<<<<< HEAD
<?php

function parseRssFeed($feed) {
    $rss = simplexml_load_file($feed);
    $entries = array();
    $entry = array();
    foreach ($rss->channel->item as $item) {
        
        $titulo = (string) $item->title; // Title
        $link = (string) $item->link; // Url Link
        $contenido = (string) $item->description; //Contenido
        $fecha = date("j/n/Y",strtotime($item->pubDate));
        $entry = array(
            "titulo" => $titulo,
            "link" => $link,
            "contenido" => $contenido,
            "fecha" => $fecha,
        );
        array_push($entries, $entry);
    }
    return $entries;
}

=======
<?php

function parseRssFeed($feed) {
    
    $rss = simplexml_load_file($feed);
    $entries = array();
    $entry = array();
    foreach ($rss->channel->item as $item) {

        $titulo = (string) $item->title; // Title
        $link = (string) $item->link; // Url Link
        $contenido = (string) $item->description; //Contenido
        $fecha = date("j/n/Y", strtotime($item->pubDate));
        $entry = array(
            "titulo" => $titulo,
            "link" => $link,
            "contenido" => $contenido,
            "fecha" => $fecha,
        );
        array_push($entries, $entry);
    }
    return $entries;
}

>>>>>>> origin/master
?>