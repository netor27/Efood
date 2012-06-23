function obtenerIngredientes(id){
    //Va a obtener la información en ajax para no tener que refrescar la página
    //El id del platillo lo obtenemos con el atributo de cada "liga"
    $.ajax({
        type: "POST",
        url: "pedidos.php?a=obtenIngredientes",
        data: ({
            "platillo" : id 
        }),
        dataType: "json",
        success: function(json) {
            var txt="";
            //txt=txt + json[x].idPlatillo;
            //txt=txt + json[x].idRestaurante;
            //txt=txt + json[x].idCategoria;
            txt=txt + "<h3>"+json[0].nombrePlatillo+"</h3>";
            txt=txt + json[0].descripcion+"<br>";
            txt=txt + json[0].precioBase+"<br>";
            var grupo = "";
            txt = txt + grupo;
            for (x in json){
                //txt=txt + json[x].hint;
                //txt=txt + json[x].idGrupoIngredientes;
                if(grupo!=json[x].nombreGrupo){
                    txt = txt + "<br><br>"+json[x].nombreGrupo+"<br>";
                    grupo = json[x].nombreGrupo;
                }
                
                
                if(json[x].requerido==1){
                    txt=txt+"*";
                }
                
                    
                if(json[x].excluyente==1){
                    txt=txt+"<input type=\"radio\" value=\""+json[x].idIngrediente+"\" name=\""+grupo+"\" />";
                }else{
                    txt=txt+"<input type=\"checkbox\" value=\""+json[x].idIngrediente+"\" name=\""+json[x].idIngrediente+"\"/>";
                }
                txt=txt + json[x].nombreIngrediente;
                //txt=txt + json[x].idGrupoDepende+"<br>";
                //txt=txt + json[x].idIngredienteDepende+"<br>";
                //txt=txt + json[x].idIngrediente;
                
                txt=txt + "&nbsp;$"+json[x].precio;
            }
            txt=txt+"<br><br>Especificaciones:<textarea rows=3 columns=20 name=\"especificaciones\"></textarea><br>";
            txt=txt+"<br><br>Cantidad:<input type='text' id='cantidad' name='cantidad'/><br>";
            txt=txt+"<input type='button' value='Agregar' id=\"agregarpedido\"/>"; 
            $("#superbox-innerbox").html(txt);
                
            //habilito el click al botón que acabo de crear "agregarpedido"
            $("#agregarpedido").bind("click", function(event) {
                agregarPedido();
            });
        },
        error: function (XMLHttpRequest, textStatus, errThrown) {
            alert(textStatus); 
        }
    });
}

function agregarPedido(){
    //Va a guardar en la sesión algunos valores que corresponden a la forma de pedido
    //Va a insertar en la tabla de pedidoplatillo
    var cantidad = $("#cantidad").val();
    if(cantidad!="" && cantidad!=null){
        $.ajax({
            type: "POST",
            url: "pedidos.php?a=agregaAlPedido",
            data: ({
                "cantidad" : cantidad
            }),
            dataType: "json",
            success: function(json) {                 
                $.growlUI('', 'Agregado');
                $("P.close A").click();      
            },
            error: function (XMLHttpRequest, textStatus, errThrown) {
                alert(textStatus); 
            }
        });
    }else{
        alert("favor de llenar los campos correctamente");
    }
}

$(document).ready(function(){
    $(".popup").click(function(){
        obtenerIngredientes(this.id);
        var cantidad="";
        cantidad=cantidad+"<br><br>Especificaciones:<textarea rows=5 columns=20 name=\"especificaciones\"></textarea><br>";
        cantidad=cantidad+"<br><br>Cantidad:<input type='text' id='cantidad' name='cantidad'/><br>";
        cantidad=cantidad+"<input type='submit' value='Agregar' id=\"agregarpedido\"/>";    
        $("#superbox-innerbox").append(cantidad);
        //habilito el click al botón que acabo de crear "agregarpedido"
        $("#agregarpedido").bind("click", function(event) {
            agregarPedido();
        });
    });
    
});