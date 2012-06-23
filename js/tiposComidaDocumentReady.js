$(function() {
    $( "#tipoComida" ).autocomplete({
        source: "tiposComida.php?a=tiposComidaJSON",
        minLength: 2,
        select: function( event, ui ) {
            var idTipoComida = ui.item.id;
            var nombre = ui.item.label;
            var idRestaurante = $("#idRestaurante").val();
            var url = 'restaurantes.php?a=agregarTipoComida&tipo='+idTipoComida+'&res='+idRestaurante;
            $.ajax({
                type: 'get',
                url: url, // <- replace this with your url here            
            
                success: function(data) {
                    $("#tipoComida").val("");
                    var str = data.toString();
                
                    if(str.indexOf("ok") != -1){                    
                        var tiposComida = $("#tiposComidaContainer");
                        var tipoDiv = '<div class="tipoComidaContainer" style="width: 100%; overflow: hidden;">'+
                        '<div class="ui-state-highlight" style="float: left; width: 395px; ">'+
                        '' + nombre +
                        '<div style="float: right;" class="borrarTipoComida">' +
                        '<a id="link'+idTipoComida+'" class="deleteTipoComida" tipoComida="'+idTipoComida+'" restaurante="'+idRestaurante+'" >Borrar</a></div></div></div>';
                         
                        tiposComida.append(tipoDiv);
                        $('#link'+idTipoComida).click(clickEvent);
                    }               
                }
            });                
        }
    });
    $('.deleteTipoComida').click(clickEvent);
});

function clickEvent(){
    if(confirm('¿Seguro que deseas quitar el tipo de comida?')){
            var parent = $(this).closest('.tipoComidaContainer');
            var url = 'restaurantes.php?a=eliminarTipoComida&tipo=' + $(this).attr('tipoComida') + "&res=" + $(this).attr('restaurante');
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