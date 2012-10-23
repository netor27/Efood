$(document).ready(function(){
    $("#pedirp").click(function(){
        var tipoEnvio = $("input[name='envio']:checked").val();
        var i = getUrlVars()["i"];
        var ic = getUrlVars()["ic"];
        window.location.href = "pedidos.php?p="+tipoEnvio+"&a=pedir&i="+i+"&ic="+ic;
    });    
    $("#modalDialogIngredientes").dialog({
        autoOpen: false,
        height: 600,
        width: 320,
        modal: true
    });
    $(".popupPlatillo").click(function(){
        obtenerIngredientes(this.id);
    });
    $(".popuppedir").click(function(){
        pedir(this.id);
    });
    $('#btnMostrarMenu').click(function(){
        $('#menuContenido').show();
        $('#opinionesContenido').hide();
        $('#informacionContenido').hide();
    });
    $('#btnMostrarOpiniones').click(function(){
        $('#opinionesContenido').show();
        $('#menuContenido').hide();
        $('#informacionContenido').hide();
    });
    $('#btnMostrarInformacion').click(function(){
        $('#informacionContenido').show();
        $('#opinionesContenido').hide();
        $('#menuContenido').hide();
    });
    
    $( ".popupPlatillo" ).tooltip({
        items: ".popupPlatillo",
        tooltipClass: "tooltipClass",
        content: function(){
            var element = $( this );
            var titulo = "<span class='tooltipNombre'>"+ element.attr( "nombre" ) + " <span class='tooltipPrecio'>$" + element.attr( "precio" ) + "</span>";
            var texto = element.attr("texto");
            var dom;
            dom = '<div class="tooltipHeader">'+titulo+'</div>';
            dom += '<div class="tooltipText">'+texto+'</div>';
            return dom;            
        }, 
        position:{ 
            my: "left bottom-10",
            at: "center top",
            collision: "none none"
        },
        show: "fade"
    });
});
function obtenerIngredientes(id){
    //Va a obtener la informaciÃ³n en ajax para no tener que refrescar la pÃ¡gina
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
            //txt = txt + "<div class='row-fluid'></div>";
            txt = txt + "<form id=\"pedido\" name=\"pedido\">"; 
            txt = txt + "<div class='row-fluid'><div class='detallesNombre'>"+json[0].nombrePlatillo+"</div></div>";            
            txt = txt + "<div class='row-fluid'><div class='detallesPrecio'>$ "+json[0].precioBase+".00</div></div>";
            if(json[0].descripcion!="" || json[0].descripcion!=null || json[0].descripcion!="null")
                txt = txt + "<div class='row-fluid'><div class='detallesDescripcion'>" + json[0].descripcion+"</div></div>";
            
            var grupo = json[0].nombreGrupo;
            var checked = true;
            var idIngredienteClick = new Array();
            var k=0;
            
            if(grupo!=null){
                txt = txt + "<div class='grupoContainer'>";
                //txt = txt + "<div class='row-fluid'><div class='span12'></div></div>";//para dejar una linea en blanco
                txt = txt + "<div class='row-fluid'><div class='detallesGrupo'>"+grupo+"</div></div>";                
            }
            txt = txt + "<div class='ui-corner-all detallesCadroAmarillo row-fluid'>";
            var contador = 0;
            for (x in json){
                if(json[x].nombreGrupo != null){
                    //txt=txt + json[x].hint;
                    //txt=txt + json[x].idGrupoIngredientes;
                    if(json[x].nombreIngrediente!=null){
                        if(grupo!=json[x].nombreGrupo){
                            if(contador % 2 == 1)
                                txt = txt + "</div>";//cerramos la fila
                            txt = txt + "</div></div>"; //cerramos el cuadro amarillo                            
                            txt = txt + "<div class='grupoContainer'>";
                            //txt = txt + "<div class='row-fluid'><div class='span12'></div></div>";//para dejar una linea en blanco
                            txt = txt + "<div class='row-fluid'><div class='detallesGrupo'>"+json[x].nombreGrupo+"</div></div>";//ponemos el nombre del grupo
                            txt = txt + "<div class='ui-corner-all detallesCadroAmarillo row-fluid'>";//abrimos el siguiente cuadro amarillo
                            grupo = json[x].nombreGrupo;
                            checked = true;
                            contador = 0;
                        }
                        //ASTERISCO DE DATO REQUERIDO
                        /*if(json[x].requerido==1){
                            txt=txt+"*";
                        }*/    
                        var idDepende;
                        if(json[x].idIngredienteDepende==-1){
                            //idDepende = json[x].idIngrediente;
                            idDepende = -1;
                        }else{
                            idDepende = json[x].idIngredienteDepende;
                        }
                        if(contador % 2 == 0){
                            //es el del lado izquierdo, empezamos una fila
                            txt = txt + "<div class='row-fluid'>";
                        }
                        txt = txt + "<div class='span6 ingrediente'>";
                        
                        if(json[x].excluyente==1){
                            if(checked && json[x].idIngredienteDepende==-1){                                
                                txt=txt+"<input type=\"radio\" value=\""+json[x].idIngrediente+"\" name=\""+quitaAcentos(grupo)+"\" id=\""+idDepende+"\" checked=\"checked\" class=\"hab\" />";
                                checked = false;
                                idIngredienteClick[k] = "<input type=\"radio\" value=\""+json[x].idIngrediente+"\" name=\""+quitaAcentos(grupo)+"\" id=\""+idDepende+"\" checked=\"checked\" class=\"hab\" />";
                                k++;
                            }
                            else if(checked && json[x].idIngredienteDepende!=-1){
                                txt=txt+"<input type=\"radio\" value=\""+json[x].idIngrediente+"\" name=\""+quitaAcentos(grupo)+"\" id=\""+idDepende+"\" checked=\"checked\" class=\"d"+idDepende+"\" />";
                                checked = false;
                            }else if(json[x].idIngredienteDepende==-1){
                                txt=txt+"<input type=\"radio\" value=\""+json[x].idIngrediente+"\" name=\""+quitaAcentos(grupo)+"\" id=\""+idDepende+"\" class=\"hab\" />";
                            }
                            else{
                                txt=txt+"<input type=\"radio\" value=\""+json[x].idIngrediente+"\" name=\""+quitaAcentos(grupo)+"\" id=\""+idDepende+"\" class=\"d"+idDepende+"\" />";
                            }
                        }else{
                            if(checked && json[x].idIngredienteDepende==-1){
                                txt=txt+"<input type=\"checkbox\" value=\""+json[x].idIngrediente+"\" name=\""+quitaAcentos(grupo)+"\" id=\""+idDepende+"\" checked=\"checked\" class=\"hab\" />";
                                checked = false;
                            }else if(checked && json[x].idIngredienteDepende!=-1){
                                txt=txt+"<input type=\"checkbox\" value=\""+json[x].idIngrediente+"\" name=\""+quitaAcentos(grupo)+"\" id=\""+idDepende+"\" checked=\"checked\" class=\"d"+idDepende+"\" />";
                                checked = false;
                            }else if(json[x].idIngredienteDepende==-1){
                                txt=txt+"<input type=\"checkbox\" value=\""+json[x].idIngrediente+"\" name=\""+quitaAcentos(grupo)+"\" id=\""+idDepende+"\" class=\"hab\" />";
                                
                            }
                            else{
                                txt=txt+"<input type=\"checkbox\" value=\""+json[x].idIngrediente+"\" name=\""+quitaAcentos(grupo)+"\" id=\""+idDepende+"\" class=\"d"+idDepende+"\" />";
                            }
                        //txt=txt+"<input type=\"checkbox\" value=\""+json[x].idIngrediente+"\" name=\""+json[x].idIngrediente+"\" id=\""+idDepende+"\" class=\"hab\"/>";
                        }
                        txt = txt + "<span class='ingredienteNombre'>" +  json[x].nombreIngrediente + "</span>";
                        //txt=txt + json[x].idGrupoDepende+"<br>";
                        //txt=txt + json[x].idIngredienteDepende+"<br>";
                        //txt=txt + json[x].idIngrediente;
                        if(json[x].precio!=0){
                            txt=txt + "&nbsp;(+"+json[x].precio+".00)";
                        }
                        if(contador % 2 != 0){
                            //es el del lado derecho, cerramos la fila
                            txt = txt + "</div>";
                        }
                        txt = txt + "</div>";
                    }
                }
                contador++;
            }
            if(contador % 2 == 1)
                txt = txt + "</div>";
            txt = txt + "</div></div>";//cerramos el ultimo cuadro amarillo
            //txt = txt + "<div class='row-fluid'><div class='span12'></div></div>";//para dejar una linea en blanco
            txt = txt + "<div class='row-fluid especificaciones'>Especificaciones:</div>";
            txt = txt + "<div class='row-fluid especificacionesTexto'><textarea class='span10 offset1' rows='2' name=\"especificaciones\" id=\"especificaciones\"></textarea></div>";   
            txt = txt + "<div class='row-fluid'>";
            txt = txt + "   <div class='span5 cantidad'><span>Cantidad:</span><input class='span3' type='text' id='cantidad' name='cantidad' value='1'/></div>";
            txt = txt + "   <div class='span5 '><input type='image' id=\"agregarpedido\" src='layout/imagenes/Menu/btnAnadirPedido.png'></div>";
            txt = txt + "</div>";            
            txt = txt + "</form>";
            txt = txt + "</div>";
                        
            $("#modalDialogIngredientes").html(txt);
            $("#modalDialogIngredientes").dialog({
                autoOpen: true,
                height: "auto",
                width: 320,
                modal: true,
                resizable: false
            });
            //habilito el click al boton que acabo de crear "agregarpedido"
            $("#agregarpedido").bind("click", function(event) {
                agregarPedido();
            });
            
            $(".hab").bind("click", function(event) {
                eventos(this);                
            });
            
            for(y in idIngredienteClick){
                eventos(idIngredienteClick[y]);
            }
        },
        error: function (XMLHttpRequest, textStatus, errThrown) {
            alert(textStatus); 
        }
    });
}

var pedido=true;
var cuenta=0;
function agregarPedido(){
    //Va a guardar en la sesion algunos valores que corresponden a la forma de pedido
    //Va a insertar en la tabla de pedidoplatillo
    var cantidad = $("#cantidad").val();
    var especificaciones = $("#especificaciones").val();
    var vals = $('#pedido :radio').serialize();
    if($('#pedido :checkbox').length>0){
        vals += "&";
        vals += $('#pedido :checkbox').serialize();
    }
    if(cantidad!="" && cantidad!=null){
        $.ajax({
            type: "POST",
            url: "pedidos.php?a=agregaAlPedido",
            data: ({
                "cantidad" : cantidad,
                "especificaciones" : especificaciones,
                "valores" : utf8replace(vals)
            }),
            dataType: "json",
            success: function(json) {    
                var ic = getUrlVars()["ic"];
                //$("#agregados").append(json[1]+" ");
                //$("#agregados").append(json[0]+" ");
                //$("#agregados").append(json[3]);
                //$("#agregados").append(' <a href="pedidos.php?a=eliminarDelPedido&ir='+json[4]+'&pc='+cuenta+'&ic='+ic+'">Eliminar</a><br>');
                //cuenta++;
                //var total = parseInt($("#totalc").html());
                //$("#totalc").html(total+json[3]);
                //$("#botonpedir").html("<br><a href='pedidos.php?p=0&a=pedir&i="+json[4]+"'>Pedir</a></div>");                
                window.location = "pedidos.php?a=menu&i="+json[4]+"&ic="+ic;
            },
            error: function (XMLHttpRequest, textStatus, errThrown) {
                alert(textStatus); 
            }
        });
    }else{
        alert("favor de llenar los campos correctamente");
    }
}

//function pedir(id){
//    var txt = "<form id='pedidometodos' method='get' action='pedidos.php?a=pedir&i="+id+"'>";
//    //var txt="";
//    txt += "<br><br>Tipo de Pago ";
//    txt += "<br><input type='radio' name='p' value='0'/>Efectivo ";
//    txt += "<br><input type='radio' name='p' value='1'/>Paypal ";
//    txt += "<br><input type='hidden' name='a' value='pedir'/>";
//    txt += "<br><input type='hidden' name='i' value='"+id+"'/>";
//    //txt += "<br><br><a href='pedidos.php?a=pedir&i="+id+"&e="+$("input:radio:checked").val()+"&p="+$("input[name='pago']:checked").val()+"'>Enviar</a></div>";
//    txt += "<br><br><input type='submit' value='Enviar' />";
//    txt += "</form>";
//    $("#superbox-innerbox").html(txt);
//}

function quitaAcentos(cadena){
    return output = cadena.replace(/Ã¡|Ã©|Ã­|Ã³|Ãº|Ã±|Ã¤|Ã«|Ã¯|Ã¶|Ã¼/ig,function (str,offset,s) {
        var str = str=="Ã¡"?"a":str=="Ã©"?"e":str=="Ã­"?"i":str=="Ã³"?"o":str=="Ãº"?"u":str=="Ã±"?"n":str;
        str = str=="Ã"?"A":str=="Ã‰"?"E":str=="Ã"?"I":str=="Ã“"?"O":str=="Ãš"?"U":str=="Ã‘"?"N":str;
        str = str=="Ã"?"A":str=="Ã‰"?"E":str=="Ã"?"I":str=="Ã“"?"O":str=="Ãš"?"U":str=="Ã‘"?"N":str;
        str = str=="Ã¤"?"a":str=="Ã«"?"e":str=="Ã¯"?"i":str=="Ã¶"?"o":str=="Ã¼"?"u":str;
        str = str=="Ã„"?"A":str=="Ã‹"?"E":str=="Ã"?"I":str=="Ã–"?"O":str=="Ãœ"?"U":str;
        return (str);
    });
}

function eventos(e){
    $("input:radio").attr('disabled',true);
    $("input:checkbox").attr('disabled',true);
    $(".hab").removeAttr('disabled');
    $(".d"+$(e).attr('value')).removeAttr('disabled');
    
    $(".grupoContainer").hide();
    //$("input:radio").hide();
    //$("input:checkbox").hide();
    $(".hab").parents(".grupoContainer").show();
    $(".d"+$(e).attr('value')).parents(".grupoContainer").show();
}

function utf8replace(cadena){
    cadena=cadena.replace('&#193;','A');
    cadena=cadena.replace('&#201;','E');
    cadena=cadena.replace('&#205;','I');
    cadena=cadena.replace('&#211;','O');
    cadena=cadena.replace('&#218;','U');
    cadena=cadena.replace('&#209;','N');
    cadena=cadena.replace('Ä','A');
    cadena=cadena.replace('Ë','E');
    cadena=cadena.replace('Ï','I');
    cadena=cadena.replace('Ö','O');
    cadena=cadena.replace('Ü','U');	
    cadena=cadena.replace('&#225;','a');
    cadena=cadena.replace('&#233;','e');
    cadena=cadena.replace('&#237;','i');
    cadena=cadena.replace('&#243;','o');
    cadena=cadena.replace('&#250;','u');
    cadena=cadena.replace('&#241;','n');
    cadena=cadena.replace('ä','a');
    cadena=cadena.replace('ë','e');
    cadena=cadena.replace('ï','i');
    cadena=cadena.replace('ö','o');
    cadena=cadena.replace('ü','u');	
    cadena=cadena.replace('%3A','');	
    return cadena;
}

function tildes_unicode(str){
    str = str.replace('á','\u00e1');
    str = str.replace('é','\u00e9');
    str = str.replace('í','\u00ed');
    str = str.replace('ó','\u00f3');
    str = str.replace('ú','\u00fa');

    str = str.replace('Á','\u00c1');
    str = str.replace('É','\u00c9');
    str = str.replace('Í','\u00cd');
    str = str.replace('Ó','\u00d3');
    str = str.replace('Ú','\u00da');

    str = str.replace('ñ','\u00f1');
    str = str.replace('Ñ','\u00d1');
    return str;
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
