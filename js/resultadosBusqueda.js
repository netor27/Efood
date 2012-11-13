var filtroTipoComida = -1;
var filtroTipoEntrega = -1;
var filtroHorario = -1;

$(document).ready(function(){	
    
    $("#modalDialogNoHayRestaurantes").dialog({
        autoOpen: true,
        height: "auto",
        width: 500,
        modal: true,
        resizable:false 
    });
    //evento para cerrar el dialogo
    $(".ui-widget-overlay").on("click", function(){
        $("#modalDialogNoHayRestaurantes").dialog("close");
    });
    
    $('select.selectAmarillo').each(function(){
        var title = $(this).attr('title');
        if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
        $(this)
        .css({
            'z-index':10,
            'opacity':0,
            '-khtml-appearance':'none'
        })
        .after('<span class="selectAmarillo">' + title + '</span>')
        .change(function(){                        
            val = $('option:selected',this).text();
            if(val != ''){
                $(this).next().text(val);
            }else{
                var title= $(this).attr('title');
                $(this).next().text(title);
            }
        })
    });
    
    $("#selectTipoComida").change(function() {
        //filtrar por el tipo de comida
        var id = $(this).val();
        if(id == -1 || id == ""){
            filtroTipoComida = -1;
        }else{
            filtroTipoComida = id;
        }
        filtrarRestaurantes();
    });
    $("#selectMetodoEntrega").change(function() {
        //filtrar por el tipo de entrega
        var id = $(this).val();
        if(id == -1 || id == ""){
            filtroTipoEntrega = -1;
        }else{
            filtroTipoEntrega = id;
        }
        filtrarRestaurantes();
    });
    $("#selectHorario").change(function() {
        //filtrar por el tipo de entrega
        var id = $(this).val();
        if(id == -1 || id == ""){
            filtroHorario = -1;
        }else{
            filtroHorario = id;
        }
        filtrarRestaurantes();
    });
    
    $("#colonias").click(function(){
        $(this).val("");
    });
    
    $(".restaurante").hover(function(){
        if($(this).hasClass("restauranteAbierto")){
            $(this).addClass("restauranteAbiertoHover");
        }else{
            $(this).addClass("restauranteCerradoHover");
        }       
    },function(){
        if($(this).hasClass("restauranteAbierto")){
            $(this).removeClass("restauranteAbiertoHover");
        }else{
            $(this).removeClass("restauranteCerradoHover");
        }
    });
});

function filtrarRestaurantes(){
    console.log("tComida = "+filtroTipoComida+" tEntrega = " +filtroTipoEntrega+" tHorario = " + filtroHorario);
    $(".restaurante").hide();
    var auxHasClass = "";
    if(filtroTipoComida != -1)
        auxHasClass = auxHasClass + ".tipoComida"+filtroTipoComida;
    if(filtroTipoEntrega != -1)
        auxHasClass = auxHasClass + ".tipoEntrega"+filtroTipoEntrega;
    if(filtroHorario != -1)
        auxHasClass = auxHasClass + ".restauranteAbierto";
    console.log("auxHasClass = " + auxHasClass);
    if(auxHasClass == ""){
        //no hay ningún filtro, mostrar todos
        $(".restaurante").show();
    }else{    
        $(".restaurante").each(function(){
            if($(this).is(auxHasClass)){
                console.log("mostrar");
                $(this).show();
            }else{
                console.log("NO mostrar");
            }
        });
    }
}