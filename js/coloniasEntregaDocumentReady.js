$(function(){
    
    $( "#colonias" ).autocomplete({
        source: "colonias.php?a=coloniasJSON",
        minLength: 2,
        select: function( event, ui ) {
            var idColonia = ui.item.id;
            var nombreColonia = ui.item.label;
            var idRestaurante = $("#idRestaurante").val();
            var url = 'restaurantes.php?a=agregarColoniaEntrega&col='+idColonia+'&res='+idRestaurante;
            $.ajax({
                type: 'get',
                url: url, // <- replace this with your url here            
            
                success: function(data) {
                    $("#colonias").val("");
                    var str = data.toString();
                
                    if(str.indexOf("ok") != -1){                    
                        var colonias = $("#coloniasContainer");
                        var coloniaDiv = '<div class="coloniaEntregaContainer" style="width: 100%; overflow: hidden;">'+
                        '<div class="ui-state-highlight" style="float: left; width: 395px; ">'+
                        '' + nombreColonia +
                        '<div style="float: right;" class="borrarColoniaEntrega">' +
                        '<a id="link'+idColonia+'"class="deleteColoniaEntrega" colonia="'+idColonia+'" restaurante="'+idRestaurante+'" >Borrar</a></div></div></div>';
                        colonias.append(coloniaDiv);
                        $('#link'+idColonia).click(clickEvent);
                    }               
                }
            });                
        }
    });
    

    $('.deleteColoniaEntrega').click(clickEvent);
});

function clickEvent(){
    if(confirm('¿Seguro que deseas quitar la relación de entrega con esta colonia?')){
        var parent = $(this).closest('.coloniaEntregaContainer');
        var url = 'restaurantes.php?a=eliminarColoniaEntrega&col=' + $(this).attr('colonia') + "&res=" + $(this).attr('restaurante');
        $(this).hide().delay(2500).fadeIn();
        $.ajax({
            type: 'get',
            url: url, // <- replace this with your url here            
            
            success: function(data) {
                var str = data.toString();
                
                if(str.indexOf("ok") != -1){                    
                    parent.fadeOut(300,function() {
                        parent.remove();
                    });
                }else{                     
                //parent.append("<div class='temaContainerMessage'>"+data+"</div>");                                        
                //parent.children(".temaContainerMessage").delay(3000).fadeOut(300, function(){
                //$(this).remove();
                //});    
                }                
            }
        });        
    }
}