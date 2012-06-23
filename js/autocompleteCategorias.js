$(function() {

    $(function() {
        $( "#categorias" ).autocomplete({
            source: "platillos.php?c=categoria&a=categoriasJSON",
            minLength: 2,
            select: function( event, ui ) {
                var index = ui.item.id;
                $('#idCategoria').val(index);
            }
        });
    });
        
});