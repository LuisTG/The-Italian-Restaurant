var lastSendData;
var sourceEventState = false;

if(typeof(EventSource) !== 'undefined'){
	sourceEventState = true;
	var sourcess = new EventSource("php/listaPedidosDinamica.php");
	sourcess.onmessage = function(event){
		if(lastSendData !== event.data){
			lastSendData = event.data;
			var dataJson = JSON.parse(event.data);
			var content;
			var old;
			var list;
			var tabla = "<thead>\n<tr>\n<th>ID Pedido</th>\n<th>Fecha de compra</th>\n<th>Producto ordenado</th>\n<th>Costo</th>\n<th>Estado</th>\n</tr>\n</thead>\n";
			for (var i = 0; i < dataJson.length; i++) {
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
				content += '<tr class="' + rowColor + ' fila-pedidos">\n';
				content += '<th class="id-pedido" id="' + dataJson[i].id_pedido + '">' + dataJson[i].id_pedido + '</th>\n';
				content += '<th>' + dataJson[i].fecha + '</th>\n';
	            content += '<th>\n<ul>\n';
	            var list = dataJson[i].lista_productos.split(',');
	            list.forEach(function(item){
	                content += '<li>' + item + '</li>\n';
	            });
	            content += '</ul>\n</th>\n';
				content += '<th>' + dataJson[i].monto + '</th>\n';
				content += '<th class="estado" estado="' + dataJson[i].estado + '">' + dataJson[i].estado + '</th>\n';
				content += '</tr>\n';
			}
			tabla += "<tbdody>\n" + content + "</tbdody>\n";
			$('#loadPedidos').remove();
			$(".tabla-pedidos").empty();
			$(".tabla-pedidos").html(tabla);
		}
	}
}else{
	$(document).ready(listaPedidos());
}

$('body').on('beforeunload', function(){
	return "Do you really want to close?";
	sourcess.close();
});

function listaPedidos(){
	$.post('php/listaPedidos.php').done(function(data){
		var dataJson = JSON.parse(data);
		var content;
		var old;
		var list;
		var tabla = "<thead>\n<tr>\n<th>ID Pedido</th>\n<th>Fecha de compra</th>\n<th>Producto ordenado</th>\n<th>Costo</th>\n<th>Estado</th>\n</tr>\n</thead>\n";
		for (var i = 0; i < dataJson.length; i++) {
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
			content += '<tr class="' + rowColor + ' fila-pedidos">\n';
            content += '<th class="id-pedido" id="' + dataJson[i].id_pedido + '">' + dataJson[i].id_pedido + '</th>\n';
            content += '<th>' + dataJson[i].fecha + '</th>\n';
            content += '<th>\n<ul>\n';
            var list = dataJson[i].lista_productos.split(',');
            list.forEach(function(item){
                content += '<li>' + item + '</li>\n';
            });
            content += '</ul>\n</th>\n';
            content += '<th>' + dataJson[i].monto + '</th>\n';
            content += '<th class="estado" estado="' + dataJson[i].estado + '">' + dataJson[i].estado + '</th>\n';
            content += '</tr>\n';
		}
		tabla += "<tbdody>\n" + content + "</tbdody>\n";
		$(".tabla-pedidos").empty();
		$(".tabla-pedidos").html(tabla);
	});
}

$('body').on('click', '.fila-pedidos',function(event){
    event.preventDefault();
    var id = $(this).find('.id-pedido').attr('id');
    var estado = $(this).find('.estado').attr('estado');
    if(estado == 'espera'){
        showWarningBox('Pedido pendiente', 'Por favor espera a que el pedido sea entregado o cancelado para enviar un comentario.');
        return;
    }
    $.get('php/commentForm.php?id='+id).done(function(data){
        $('body > div').last().after(data);
        $('#comment-modal').modal('show');
        $('body').on('hidden.bs.modal', '#comment-modal', function() { 
              $('#comment-modal').remove();
        });
    });
});

$('body').on('submit', '#comment-modal-form', function(event){
    event.preventDefault();
    if(isValidated(this)){
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: 'php/sendComments.php',
            type: 'POST',
            data: formData,
            async: true,
            success: function (data) {
                var dataJson = JSON.parse(data);
                if(dataJson.status){
                    $('#comment-modal').modal('hide');
                    showSucessBox('Comentario enviado correctamente', dataJson.msg);
                }else{
                    showDangerBox('Error al enviar el comentario', dataJson.msg);
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
        if(!sourceEventState){
        	listaPedidos();
        }
        break;
        case 'user-data':
        resetFields('#update-form');
        getUserData();
        break;
        case 'password-change':
        resetFields('#password-form');
        break;
        case 'user-feedback':
        resetFields('#comment-form');
        break;
        case 'close-account':
        resetFields('#delete-form');
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

$("#comment-form").submit(function(event){
    event.preventDefault();
    if(isValidated(this)){
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: 'php/sendComments.php',
        type: 'POST',
        data: formData,
        async: true,
        success: function (data) {
            var dataJson = JSON.parse(data);
            if(dataJson.status){
                showSucessBox('Comentario enviado correctamente', dataJson.msg);
                resetFields("#comment-form");

            }else{
                showDangerBox('Error al procesar su comentario', dataJson.msg);
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

$('#addProduct-button').click(function(){
    resetFields('#addproducto-form');
});

function limpiarFormularioRPM(){
    $('#addproducto-form>div>input').val("");
    $('#tipoProducto').val("Platillo");
}

$("#delete-form").submit(function(event){
    event.preventDefault();
    if(isValidated(this)){
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: 'php/closeAccount.php',
        type: 'POST',
        data: formData,
        async: true,
        success: function (data) {
            var dataJson = JSON.parse(data);
            if(dataJson.status){
                showSucessBox('Exito', dataJson.msg);
                $('body').on('hidden.bs.modal', '#alert-box', function () {
                     $(location).attr('href', 'index.php');
                    });                                            
            }else{
                showDangerBox('Error', dataJson.msg);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
    }else{
        showWarningBox('Lo sentimos', 'Se presentaron problemas al realizar su peticion, intente nuevamente');
    }
});