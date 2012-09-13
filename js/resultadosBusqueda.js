$(document).ready(function(){	
    $('select.selectBlanco').each(function(){
        var title = $(this).attr('title');
        if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
        $(this)
        .css({
            'z-index':10,
            'opacity':0,
            '-khtml-appearance':'none'
        })
        .after('<span class="selectBlanco">' + title + '</span>')
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
            $(".restaurante").show();
        }else{
            $(".restaurante").hide();
            $(".tipoComida"+id).show();
        }
    });
    $("#selectMetodoEntrega").change(function() {
        //filtrar por el tipo de entrega
        var id = $(this).val();
        if(id == -1){
            $(".restaurante").show();
        }else{
            $(".restaurante").hide();
            $(".tipoEntrega"+id).show();
        }
    });
});