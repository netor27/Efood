$(document).ready(function(){
    $.superbox.settings = {
        overlayOpacity: .5,
	boxWidth: "600", 
	boxHeight: "400",
        closeTxt: "Cerrar",
        loadTxt: "Cargando...",
        nextTxt: "Siguiente",
        prevTxt: "Anterior"
    };
    $.superbox();
});