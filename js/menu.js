var dataJson;
var itemsCarrito=[];
var datosBD=[];
var cont=0;

$( "#tabs" ).tabs();

$('body').on('click', '#tabs img', function() {
    var ind;
    $('#number').val(1);
    var id=$(this).attr("alt");
    for(var i in dataJson){
        if(dataJson[i].id_producto==id){
            ind=i;
        }
    }
    var precio="<div class='input-group' id='precioModal'><span class='input-group-addon'>$</span>"+
    "<input type='text' class='form-control' value='"+dataJson[ind].precio+"' readonly><span class='input-group-addon'>.00</span></div>"
    var s="<img class='imgmodal' alt='"+dataJson[ind].id_producto+"' src='"+dataJson[ind].imagen+"'><div class='caption'><p>"+dataJson[ind].nombre_producto+"</p></div>"+
    "<div id='descripcionModal'><p>Descripción: "+dataJson[ind].descripcion+"</p></div>"+precio+"<div style='clear:both;'></div></div>";

    $("#carritoModal .modal-body").empty();
    $("#carritoModal .modal-body").append(s);
    
});

function agregarCarrito(){
    var id=$("#carritoModal .imgmodal").attr("alt");
    for(var i = 0; i < datosBD.length; i++){
        var test = datosBD[i];
        if(test[0] == id){
            showWarningBox('Alerta', 'Ya has ordenado este producto');
            return;
        }
    }
    var cant=parseInt($("#carritoModal select").val());
    var nombre=$("#carritoModal .caption>p").text();
    var precio=cant*parseFloat($("#carritoModal input").val());
    precio=Math.round(precio * 100) / 100;
    var quitar="<div class='alinearSpan'><span onclick='quitarItem(this)' class='glyphicon glyphicon-remove quitar' id='"+cont+"'></span></div>"
    var item="<tr><td>"+cant+"</td><td>"+nombre+"</td><td>"+precio+"</td><td>"+quitar+"</td></tr>";
    var it=[cont,item,precio];
    itemsCarrito.push(it);
    var ins=[id,cant,precio];
    datosBD.push(ins);
    imprimirTabla();
    cont++;
}

function quitarItem(item){
    var idRemove;
    for(var i in itemsCarrito){
        if(itemsCarrito[i][0]==item.id){
            idRemove=parseInt(i);
            break;
        }
    }
    var auxCarrito,auxCarrito2;
    auxCarrito=itemsCarrito.slice(0,idRemove);
    auxCarrito2=itemsCarrito.slice(idRemove+1,itemsCarrito.length);
    itemsCarrito=auxCarrito.concat(auxCarrito2);
    auxCarrito=datosBD.slice(0,idRemove);
    auxCarrito2=datosBD.slice(idRemove+1,datosBD.length);
    datosBD=auxCarrito.concat(auxCarrito2);
    imprimirTabla();
}

function imprimirTabla(){
    var costoTotal=0;
    $("#carritoTable tbody").empty();
    $("#costoTotal").empty();
    for(var i in itemsCarrito){
        $("#carritoTable tbody").append(itemsCarrito[i][1]);
        costoTotal+=itemsCarrito[i][2];
    }
    $("#costoTotal").append("Total: "+Math.round(costoTotal * 100) / 100);
}


if(typeof(EventSource) !== "undefined") {
    var sourcess = new EventSource("php/menu.php?admin=false");
    sourcess.onmessage = function(event) {
        console.log("entro");
        $("#secPlatillos").empty();
        $("#secBebidas").empty();
        $("#secPostres").empty();
        dataJson = JSON.parse(event.data);
        for(var i in dataJson){
          var s= "<div class='col-lg-4 col-md-6 col-sm-12 col-xs-12'><div class='thumbnail'><a data-toggle='modal' href='#carritoModal'><img class='imgtabs' style='height: 200px;' src='"
          +dataJson[i].imagen+"' alt='"+dataJson[i].id_producto+"'></a><div class='caption'><p>"+dataJson[i].nombre_producto+"</p></div></div></div>";
           switch(dataJson[i].tipo){
            case "platillo":
                $("#secPlatillos").append(s);
            break;
            case "bebida":
                $("#secBebidas").append(s);
            break;
            case "postre":
                $("#secPostres").append(s);
            break;
           }
            
        }
    };
} else {
    cargarMenu();
    $('#lista-producto>h3').append("<a class='btn btn-primary' onclick='cargarMenu()'>Actualizar</a>");  
}

function cargarMenu(){
    $.ajax({
        type: "POST",
        url:"php/menuOldBrowsers.php?admin=false",
        async: true,
        success: function(datos){
            console.log(datos);
            $("#secPlatillos").empty();
            $("#secBebidas").empty();
            $("#secPostres").empty();
            dataJson = JSON.parse(datos);
            for(var i in dataJson){
              var s= "<div class='col-lg-4 col-md-6 col-sm-12 col-xs-12'><div class='thumbnail'><a data-toggle='modal' href='#carritoModal'><img class='imgtabs' style='height: 200px;' src='"
              +dataJson[i].imagen+"' alt='"+dataJson[i].id_producto+"'></a><div class='caption'><p>"+dataJson[i].nombre_producto+"</p></div></div></div>";
               switch(dataJson[i].tipo){
                case "platillo":
                    $("#secPlatillos").append(s);
                break;
                case "bebida":
                    $("#secBebidas").append(s);
                break;
                case "postre":
                    $("#secPostres").append(s);
                break;
               }
                
            }
            $( "#tabs" ).tabs( "option", "heightStyle", "fill" );
        },
        error: function (obj, error, objError){
            //avisar que ocurrió un error
        }
    });
}

$("#pedido-form").submit(function(event){
    event.preventDefault();
    if(datosBD.length>0){
        $.post("php/crearPedido.php", {'datosBD': datosBD}).done(function (data) {
            console.log(data);
            datos = JSON.parse(data);
            itemsCarrito=[];
            datosBD=[];
            imprimirTabla();
            if(datos["status"]==false){
                showDangerBox("Error",datos["msg"]);
            }else{
                showSucessBox("Éxito",datos["msg"]);
            }
        }); 
    }else{
        showWarningBox("Compra","No hay articulos en tu carrito");
    }
});

function mensaje(msg){
    $("#mensajeModal .modal-body").empty();
    $("#mensajeModal .modal-body").append(msg);
    $("#mensajeModal").modal();
}