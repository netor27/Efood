$(function() {

    $(function() {
        $( "#restaurantes" ).autocomplete({
            source: "restaurantes.php?a=restaurantesJSON",
            minLength: 1,
            select: function( event, ui ) {
                var index = ui.item.id;
                $('#idRestaurante').val(index);
            }
        });
    });
        
});