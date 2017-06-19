var files;
var elem;
var dataJsonPedidos=[];
var vaya;

if(typeof(EventSource) !== "undefined") {
    var sourcess = new EventSource("php/listaTodosPedidos.php");
    sourcess.onmessage = function(event) {
        if(vaya !== event.data){
        vaya = event.data;
        $(".tabla-pedidos").empty();        
        var dataJson = JSON.parse(event.data);
        var content="";
        var tabla = "<thead>\n";
            tabla += "<tr>\n";
            tabla += "<th>ID Pedido</th>\n";
            tabla += "<th>Fecha de compra</th>\n";
            tabla += "<th>Usuario que ordeno</th>\n";
            tabla += "<th>Productos ordenado</th>\n";
            tabla += "<th>Costo</th>\n";
            tabla += "<th>Estado</th>\n";
            tabla += "</tr>\n";
            tabla += "</thead>\n";
        for(var i in dataJson){
            var rowColor;
            switch(dataJson[i].estado){
                case 'entregado':
                rowColor = 'success';
                break;
                case 'espera':
                rowColor = 'warning';
                break;
                case 'cancelado':
                rowColor = 'danger';
                break;
            }            
            content += '<tr class="' + rowColor + '">\n';           
            content += '<th>' + dataJson[i].id_pedido + '</th>\n';
            content += '<th>' + dataJson[i].fecha + '</th>\n';
            content += '<th>' + dataJson[i].usuarios_nombre_usuario + '</th>\n';
            content += '<th>\n<ul>\n';
            var list = dataJson[i].lista_productos.split(',');
            list.forEach(function(item){
                content += '<li>' + item + '</li>\n';
            });
            content += '</ul>\n</th>\n';
            content += '<th>' + dataJson[i].monto + '</th>\n';
            switch(dataJson[i].estado){
                case "espera":
                case "Espera":
                    content += '<th><div class="form-group"><select id="elementSelected" class="form-control" alt='+dataJson[i].id_pedido+'><option selected>'+dataJson[i].estado+'<option>Entregado</option><option>Cancelado</option></select></div></th>\n';
                    break;
                case "entregado":
                case "Entregado":
                    content += '<th><div class="form-group"><select id="elementSelected" class="form-control" alt='+dataJson[i].id_pedido+'><option selected>'+dataJson[i].estado+'<option>Espera</option><option>Cancelado</option></select></div></th>\n';
                    break;
                case "cancelado":
                case "Cancelado":
                    content += '<th><div class="form-group"><select id="elementSelected" class="form-control" alt='+dataJson[i].id_pedido+'><option selected>'+dataJson[i].estado+'<option>Espera</option><option>Entregado</option></select></div></th>\n';
                    break;
            }            
            content += '</tr>\n';
            elem=[dataJson[i].id_pedido,dataJson[i].fecha,dataJson[i].usuarios_nombre_usuario,dataJson[i].lista_productos,dataJson[i].monto,dataJson[i].estado];
            dataJsonPedidos.push(elem);            
        }
        tabla += "<tbdody>\n" + content + "</tbdody>\n";
        $(".tabla-pedidos").empty();
        $(".tabla-pedidos").html(tabla);
    };
}
} else {
    cargarListaPedidos();
    $('#addListHeading>h4').append("<a class='btn btn-primary' onclick='cargarListaPedidos()'>actualizar</a>");  
}

$('body').on('click', '.fila-comentarios', function(event){
    event.preventDefault();
    var id = $(this).find('.id-pedido').attr('id');
    var usuario = $(this).find('.usuario').attr('user');
    if(id != ''){
        var id = 'Sobre el pedido: ' + id;
    }
    $.get('php/emailForm.php?username='+usuario+'&subject='+id).done(function(data){
        $('body > div').last().after(data);
        $('#email-modal').modal('show');
    });
});

$('body').on('hidden.bs.modal', '#email-modal', function() { 
    $('#email-modal').remove();
});

function cargarListaPedidos(){
    $.ajax({
        type: "POST",
        url:"php/listaPedidosOldBrowsers.php",
        async: true,
        success: function(datos){            
            dataJson = JSON.parse(datos);
            var content;
            var tabla = "<thead>\n";
            tabla += "<tr>\n";
            tabla += "<th>ID Pedido</th>\n";
            tabla += "<th>Fecha de compra</th>\n";
            tabla += "<th>Usuario que ordeno</th>\n";
            tabla += "<th>Productos ordenado</th>\n";
            tabla += "<th>Costo</th>\n";
            tabla += "<th>Estado</th>\n";
            tabla += "</tr>\n";
            tabla += "</thead>\n";
            for(var i in dataJson){
                content += '<tr>\n';
                content += '<th>' + dataJson[i].id_pedido + '</th>\n';
                content += '<th>' + dataJson[i].fecha + '</th>\n';
                content += '<th>' + dataJson[i].usuarios_nombre_usuario + '</th>\n';
                content += '<th>' + dataJson[i].lista_productos + '</th>\n';
                content += '<th>' + dataJson[i].monto + '</th>\n';
                switch(dataJson[i].estado){
                    case "espera":
                    case "Espera":
                        content += '<th><div class="form-group"><select id="elementSelected" class="form-control" alt='+dataJson[i].id_pedido+'><option selected>'+dataJson[i].estado+'<option>Entregado</option><option>Cancelado</option></select></div></th>\n';
                        break;
                    case "entregado":
                    case "Entregado":
                        content += '<th><div class="form-group"><select id="elementSelected" class="form-control" alt='+dataJson[i].id_pedido+'><option selected>'+dataJson[i].estado+'<option>Espera</option><option>Cancelado</option></select></div></th>\n';
                        break;
                    case "cancelado":
                    case "Cancelado":
                        content += '<th><div class="form-group"><select id="elementSelected" class="form-control" alt='+dataJson[i].id_pedido+'><option selected>'+dataJson[i].estado+'<option>Espera</option><option>Entregado</option></select></div></th>\n';
                        break;
                }            
                content += '</tr>\n';
                elem=[dataJson[i].id_pedido,dataJson[i].fecha,dataJson[i].usuarios_nombre_usuario,dataJson[i].lista_productos,dataJson[i].monto,dataJson[i].estado];
                dataJsonPedidos.push(elem);            
            }
            tabla += "<tbdody>\n" + content + "</tbdody>\n";
            $(".tabla-pedidos").empty();
            $(".tabla-pedidos").html(tabla);            
        },
        error: function (obj, error, objError){
            //avisar que ocurrió un error
        }
    });
}

function getUserData(){
    $.post('php/userInformation.php').done(function(data){
        var dataJson = JSON.parse(data);
        $('#update-form #nombres').val(dataJson.nombres);
        $('#update-form #apellidos').val(dataJson.apellidos);
        $('#update-form #telefono').val(dataJson.telefono);
        $('#update-form #correo').val(dataJson.correo);
        setFields('#update-form', true);
    });
}

$('.nav-pills li a').on('shown.bs.tab', function(event){
    var currentTab = $(event.target).attr('id');
    switch(currentTab){
        case 'my-list':
        //listaPedidos();
        break;
        case 'user-data':
        resetFields('#update-form');
        getUserData();
        break;
        case 'password-change':
        resetFields('#password-form');
        break;
        case 'add-products':
        resetFields('#addproducto-form');
        case 'user-comments':
        //listaComentarios();
        load_datos();
        break;
    }
});

$("#update-form").submit(function(event){
    event.preventDefault();
    if(isValidated(this)){
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: 'php/updateUserInformation.php',
            type: 'POST',
            data: formData,
            async: true,
            success: function (data) {
                var dataJson = JSON.parse(data);
                if(dataJson.status){
                    showSucessBox('Informacion actualizada correctamente', dataJson.msg);
                    $('body').on('hidden.bs.modal', '#alert-box', function () {
                     $("#profile-info").load(location.href + " #profile-info>*", "");
                    });
                }else{
                    showDangerBox('Error al actualizar su información', dataJson.msg);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }else{
        showWarningBox('Campos Inválidos', 'Uno o mas campos contienen información no valida, revise los datos introducidos y vuelva a intentarlo');
    }
});

$("#password-form").submit(function(event){
    event.preventDefault();
    if(isValidated(this)){
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: 'php/changePassword.php',
            type: 'POST',
            data: formData,
            async: true,
            success: function (data) {
                var dataJson = JSON.parse(data);
                if(dataJson.status){
                    showSucessBox('Contraseña cambiada correctamente', dataJson.msg);
                }else{
                    showDangerBox('Error al cambiar la contraseña', dataJson.msg);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }else{
        showWarningBox('Campos Inválidos', 'Uno o mas campos contienen información no valida, revise los datos introducidos y vuelva a intentarlo');
    }
});

$("#addproducto-form").submit(function(e){
    e.preventDefault();
    if(isValidated(this)){
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: 'php/addNewProduct.php',
            type: 'POST',
            data: formData,
            async: true,
            success: function (data) {
                var dataJson = JSON.parse(data);
                if(dataJson["status"]==false){
                    showDangerBox("Error",dataJson["msg"]);
                }
                else{
                    $('#registroProducto').modal('hide');
                    limpiarFormularioRPM();
                    showSucessBox("Éxito", "El producto fue agregado exitosamente.");
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

$('body').on('submit', '#email-modal-form', function(e){
    e.preventDefault();
    if(isValidated(this)){
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: 'php/mailer.php',
            type: 'POST',
            data: formData,
            async: true,
            success: function (data) {
                var dataJson = JSON.parse(data);
                if(dataJson.status){
                    $('#email-modal').modal('hide');
                    showSucessBox('Correo electronico enviado', dataJson.msg);
                }else{
                    showDangerBox('Error al enviar el correo', dataJson.msg);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });

    }else{
        showWarningBox('Campos Inválidos', 'Uno o mas campos contienen información no valida, revise los datos introducidos y vuelva a intentarlo');
    }
});

$('#addProduct-button').click(function(){
    resetFields('#addproducto-form');
});

function limpiarFormularioRPM(){
    $('#addproducto-form>div>input').val("");
    $('#tipoProducto').val("Platillo");
}
/*
$("#guardar-cambios").click(function(event){    
    if(dataJsonPedidos.length>0){        
        $.post("php/cambiosHistorialPedidos.php", {'dataJsonPedidos': dataJsonPedidos}).done(function (data) {
            console.log(data);
            datos = JSON.parse(data);                        
            if(datos["status"]==false){
                showDangerBox("Error",datos["msg"]);
            }else{
                showSucessBox("Exito",datos["msg"]);
            }
        }); 
    }else{
        showWarningBox("Cambios","No hay pedidos en el historial de pedidos");
    }
});
*/
$('body').on('click', '#elementSelected', function(e){    
    selectedItem=-1;
    var id=$(this).attr("alt");   
    var dataJsonUnPedido; 
    for(var i in dataJsonPedidos){                
        if(dataJsonPedidos[i][0]==id){            
            selectedItem = document.getElementById("elementSelected").value;
            dataJsonPedidos[i][5] = selectedItem;
            dataJsonUnPedido=dataJsonPedidos[i];
        }
    }
    if(selectedItem===-1){
        showDangerBox("Error", "No se encontro el pedido seleccionado.");
    }    
    e.preventDefault();
    if(isValidated(this)){        
        var formData = new FormData($(this)[0]);        
        formData.append("id",dataJsonUnPedido[0]);
        formData.append("fecha",dataJsonUnPedido[1]);
        formData.append("nombre",dataJsonUnPedido[2]);
        formData.append("productos",dataJsonUnPedido[3]);
        formData.append("costo",dataJsonUnPedido[4]);
        formData.append("estado",dataJsonUnPedido[5]);
        $.ajax({
            url: 'php/cambiosHistorialPedidos.php',
            type: 'POST',
            data: formData,
            async: true,            
            success: function (data) {
                var datos=JSON.parse(data);
                if(datos["status"]==false){
                    showDangerBox("Error",datos["msg"]);
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
/*
$('body').on('click', '#historial-pedidos select', function() {
    selectedItem=-1;
    var id=$(this).attr("alt");    
    for(var i in dataJsonPedidos){                
        if(dataJsonPedidos[i][0]==id){            
            selectedItem = document.getElementById("elementSelected").value;
            dataJsonPedidos[i][4] = selectedItem;
            console.log(dataJsonPedidos[i]);            
        }
    }
    if(selectedItem===-1){
        showDangerBox("Error", "No se encontro el pedido seleccionado.");
    }else{
    }
});
*/
function listaComentarios(){                
    $.post('php/listaComentarios.php').done(function(data){
        var dataJson = JSON.parse(data);        
        var content;        
        var tabla = "<thead>\n";
        tabla += "<tr>\n";
        tabla += "<th>ID Comentario</th>\n";
        tabla += "<th>Usuario</th>\n";
        tabla += "<th>Tipo</th>\n";
        tabla += "<th>Contenido</th>\n";
        tabla += "</tr>\n";
        tabla += "</thead>\n";
        for (var i = 0; i < dataJson.length; i++) {
            content += '<tr>\n';
            content += '<th>' + dataJson[i].id_comentario + '</th>\n';
            content += '<th>' + dataJson[i].usuarios_nombre_usuario + '</th>\n';
            content += '<th>' + dataJson[i].tipo + '</th>\n';
            content += '<th>' + dataJson[i].contenido + '</th>\n';            
            content += '</tr>\n';            
        }
        tabla += "<tbody>\n" + content + "</tbody>\n";
        $(".tabla-comentarios").empty();
        $(".tabla-comentarios").html(tabla);        
    });    
}

function load_datos(page){
    $.ajax({
        url:"php/consultarComentarios.php",
        method:"POST",
        data:{page:page},
        success:function(data){
            $('#cuerpoComentarios').html(data);
        }
    });
}

$(document).on('click','.pagination_link', function(){
    var page = $(this).attr("id");
    load_datos(page);
});

function redireccionar(){
    $.post('php/logout.php').done(function(data){
        window.location.href = '../proyecto/index.php';        
    });
} 