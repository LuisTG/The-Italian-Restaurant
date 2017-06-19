//var dataJson;
var selectedItem;
var dataMenu;

$( "#tabs" ).tabs();

$('body').on('click', '#tabs img', function() {
    selectedItem=-1;
    var id=$(this).attr("alt");
    for(var i in dataJson){
        if(dataJson[i].id_producto==id){
            selectedItem=dataJson[i].id_producto;
        }
    }
    if(selectedItem===-1){
        showWarningBox("Error", "No se encontro el articulo seleccionado.");
    }else{
        obtenerDatos(selectedItem);
        setFields('#updateProducto-form', true);
    } 
    $('#actualizarProducto').modal('show');   
});

function obtenerDatos(id_producto){
    $.post("php/getProduct.php", {'id': id_producto}).done(function (data) {
        datos = JSON.parse(data);
        $('#updateProducto-form').find("input[name]").each(function (index, node) {
            
            switch(node.name){
                case "descripcion":
                    $("#updateProducto-form input[name='descripcion']").val(datos[0].descripcion);
                break;
                case "precio":
                    $("#updateProducto-form input[name='precio']").val(datos[0].precio);
                break;
                case "productname":
                    $("#updateProducto-form input[name='productname']").val(datos[0].nombre_producto);
                break;
            }
        });
        $("#updateProducto-form select[name=tipoProducto]").val(datos[0].tipo);
        $("#updateProducto-form select[name=habilitada]").val(datos[0].habilitada);
    }); 
}

if(typeof(EventSource) !== "undefined") {
    var sourcess = new EventSource("php/menu.php?admin=true");
    sourcess.onmessage = function(event) {
        if(dataMenu !== event.data){
            dataMenu = event.data;
            $("#secPlatillos").empty();
            $("#secBebidas").empty();
            $("#secPostres").empty();
            var formato;
            dataJson = JSON.parse(event.data);
            for(var i in dataJson){
                if(dataJson[i].habilitada=='alta'){
                     formato="class='alta'";     
                }else{
                     formato="class='baja'";
                }
                    var s= "<div class='col-lg-4 col-md-6 col-sm-12 col-xs-12' style='min-height: 320px;'><div class='thumbnail' style='min-height: auto; max-height: 300px; width: auto;'><a data-toggle='modal' href='#carritoModal'><img class='imgtabs img-responsive' style='min-height: 220px; max-height: 220px;' src='"
                  +dataJson[i].imagen+"' alt='"+dataJson[i].id_producto+"'></a><div class='caption'><p "+formato+" style='font-size: auto;'>"+dataJson[i].nombre_producto+"</p></div></div></div>";
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
        }
    };
} else {
    cargarMenu();
    $('#addProductHeading>h4').append("<a class='btn btn-primary' onclick='cargarMenu()'>actualizar</a>");  
}

function cargarMenu(){
    $.ajax({
        type: "POST",
        url:"php/menuOldBrowsers.php?admin=true",
        async: true,
        success: function(datos){
            $("#secPlatillos").empty();
            $("#secBebidas").empty();
            $("#secPostres").empty();
            dataJson = JSON.parse(datos);
            var formato;
            for(var i in dataJson){
                if(dataJson[i].habilitada=='alta'){
                     formato="class='alta'";     
                }else{
                     formato="class='baja'";
                }
              var s= "<div class='col-lg-4 col-md-6 col-sm-12 col-xs-12'><div class='thumbnail'><a data-toggle='modal' href='#carritoModal'><img class='imgtabs' style='height: 200px;' src='"
                    +dataJson[i].imagen+"' alt='"+dataJson[i].id_producto+"'></a><div class='caption'><p "+formato+" >"+dataJson[i].nombre_producto+"</p></div></div></div>";
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
            //$( "#tabs" ).tabs( "heightStyle", "fill" );
        },
        error: function (obj, error, objError){
            //avisar que ocurrió un error
        }
    });
}

$("#updateProducto-form").submit(function(e){
    e.preventDefault();
    if(isValidated(this)){
        var formData = new FormData($(this)[0]);
        formData.append("id",selectedItem);
        $.ajax({
            url: 'php/updateProductInformation.php',
            type: 'POST',
            data: formData,
            async: true,
            success: function (data) {
                var datos=JSON.parse(data);
                if(datos["status"]==false){
                    showDangerBox("Error",datos["msg"]);
                }else{
                    $("#actualizarProducto").modal("hide");
                    showSucessBox("Exito",datos["msg"]);
                }

            },
            cache: false,
            contentType: false,
            processData: false,

        });
    }else{
        showWarningBox('Campos Inválidos', 'Uno o mas campos contienen información no valida, revise los datos introducidos y vuelva a intentarlo');
    }
});