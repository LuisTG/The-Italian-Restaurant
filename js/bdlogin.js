/*function sendForm (form){
	var action = $(form).attr("action");
	var formData = {};
	$(form).find("input[name]").each(function (index, node) {
        formData[node.name] = node.value;
    });
    $.post(action, formData).done(function (data) {
    	dataJson = JSON.parse(data);
    	if(dataJson.status){
    	$("#loginModal").modal("hide");
    	location.reload();
    	}else{
    		$('.login-alert').removeClass('hidden');
    	}
    });
}*/

/*$("#insesion").on('click', function(){
	resetFields('#login-form');
});*/

$("#registrar").on('click', function(){
    resetFields('#register-form');
});

$("#insesion").on('click', function(){
    resetFields('#login-form');
});

$("#login-form").submit(function(event){
    event.preventDefault();
    if(isValidated(this)){
        var action = $(this).attr("action");
        var formData = {};
        $(this).find("input[name]").each(function (index, node) {
            formData[node.name] = node.value;
        });
        $.post(action, formData).done(function (data) {
            console.log(data);
            dataJson = JSON.parse(data);
            if(dataJson.status){
            $("#loginModal").modal("hide");
            location.reload();
            $(this).submit();
            }else{
                showDangerBox('Error al iniciar sesion', dataJson.msg);
            }
        });
    }else{
        showWarningBox('Campos Inválidos', 'Uno o mas campos contienen información no valida, revise los datos introducidos y vuelva a intentarlo');
    }
    
});

$("#register-form").submit(function(event){
    event.preventDefault();
    if(isValidated(this)){
        var action = $(this).attr("action");
        var formData = {};
        $(this).find("input[name]").each(function (index, node) {
            formData[node.name] = node.value;
        });
        $.post(action, formData).done(function (data) {
            console.log(data);
            dataJson = JSON.parse(data);
            if(dataJson.status){
            $("#registroModal").modal("hide");
            location.reload();
            $(this).submit();
            }else{
                showDangerBox('Error al iniciar sesion', dataJson.msg);
            }
        });
    }else{
        showWarningBox('Campos Inválidos', 'Uno o mas campos contienen información no valida, revise los datos introducidos y vuelva a intentarlo');
    }
});

$("#navbar ul li .link-master").click('on',function(e) {
    $('body').animate({
        scrollTop: $(e.target.hash).offset().top
    }, 1000);
    return false;
  });