$("body").on('blur', '.form-control', function(event){
	event.preventDefault();
	validateField(this);
	$(this).tooltip('destroy');
});



function validateEmail(content){
	var emailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return emailPattern.test(content);
}

function validateTelephone(content){
	var telPattern = /^[0-9]{10}$/;
	return telPattern.test(content);
}

function validateNickName(content){
	var nicknamePattern = /^[a-zA-Z0-9_.-]{1,15}$/;
	return nicknamePattern.test(content);
}

function validateSimpleText(content){
	var simpletextPattern = /^[a-zA-Záéíóú]{1,15}$/;
	return simpletextPattern.test(content);
}

function validateTextField(content){
	var usernamePattern = /^[a-zA-ZA-zÀ-úA-zÀ-ÿ?¿! ¡.,;:]{1,}$/;
	return usernamePattern.test(content);
}

function validateTextArea(content){
	var textPattern = /^[a-zA-ZA-zÀ-úA-zÀ-ÿ0-9?¿! ¡.,;:\n]{1,}$/;
	return textPattern.test(content);
}

function validatePassword(content){
	var passwordPattern = /^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,16}$/;
	return passwordPattern.test(content);
}

function validatePrice(content){
	var pricePattern = /^([0-9]{0,4})?(.([0-9]{1,2}))?$/;
	return pricePattern.test(content);
}

$("body").on('focus', '.form-control', function(event){
	event.preventDefault();
	clearAlerts(this);
	$(this).tooltip('show');
});

function validateField(formControl){
	var esRequerido = $(formControl).attr('required');
	var valor = $(formControl).val();
	var validated = true;
	if(esRequerido && (valor == '' || valor == null)){
		$(formControl).parent().addClass('has-error has-feedback');
		$(formControl).after('<p class="field-helper" style="color: red;">El campo es requerido</p>');
		validated = false;
	}else{
		var tipo = $(formControl).attr('type');
		switch(tipo){
			case "email":
			if(!validateEmail(valor)){
			$(formControl).parent().addClass('has-error has-feedback');
			$(formControl).after('<p class="field-helper" style="color: red;">Introduce un correo electrónico válido</p>');
			validated = false;
			}
			break;
			case "tel":
			if(!validateTelephone(valor)){
			$(formControl).parent().addClass('has-error has-feedback');
			$(formControl).after('<p class="field-helper" style="color: red;">Introduce un teléfono de 10 dígitos válido</p>');
			validated = false;
			}
			break;
			case "username":
			if(!validateNickName(valor)){
			$(formControl).parent().addClass('has-error has-feedback');
			$(formControl).after('<p class="field-helper" style="color: red;">Introduce un nombre de usuario válido sin espacios o acentos</p>');
			validated = false;
			}
			break;
			break;
			case "textarea":
			if(!validateTextArea(valor)){
			$(formControl).parent().addClass('has-error has-feedback');
			$(formControl).after('<p class="field-helper" style="color: red;">El campo solo acepta caracteres alfabéticos y signos de puntuación</p>');
			validated = false;
			}
			break;
			case "simpletext":
			if(!validateSimpleText(valor)){
			$(formControl).parent().addClass('has-error has-feedback');
			$(formControl).after('<p class="field-helper" style="color: red;">El campo solo acepta caracteres alfabéticos.</p>');
			validated = false;
			}
			case 'name':
			if(!validateTextField(valor)){
			$(formControl).parent().addClass('has-error has-feedback');
			$(formControl).after('<p class="field-helper" style="color: red;">El campo solo acepta caracteres alfabéticos y signos de puntuación sin salto de linea.</p>');
			validated = false;
			}
			break;
			case "textfield":
			if(!validateTextField(valor)){
			$(formControl).parent().addClass('has-error has-feedback');
			$(formControl).after('<p class="field-helper" style="color: red;">El campo solo acepta caracteres alfabéticos y signos de puntuación sin salto de linea.</p>');
			validated = false;
			}
			break;
			case 'price':
			console.log('Hace');
			if(!validatePrice(valor)){
			$(formControl).parent().addClass('has-error has-feedback');
			$(formControl).after('<p class="field-helper" style="color: red;">Introduzca un precio con el formato 9999.99</p>');
			validated = false;
			}
			break;
			case "password":
			if(!validatePassword(valor)){
			$(formControl).parent().addClass('has-error has-feedback');
			$(formControl).after('<p class="field-helper" style="color: red;">La contraseña debe tener un mínimo de 8 caracteres y un máximo de 16 caracteres, ademas, debe contar con al menos un número, una letra mayúscula y un caracter especial</p>');
			validated = false;
			}
			break;
		}
	}
	if(validated){
		if(!$(formControl).attr('validated')){
			$(formControl).attr('validated', 'true');
		}
	}else{
		if($(formControl).attr('validated')){
			$(formControl).removeAttr('validated');
		}
	}
}

function isValidField(formControl){
	return $(formControl).attr('validated') == 'true';
}

function isValidated(form){
	var status = true;
	$(form).find('.form-control').each(function(index, el) {
		if(!isValidField(el)){
			clearAlerts(el);
			validateField(el);
			status = status && isValidField(el);
		}
	});
	return status;
}

function setFields(form, status){
	$(form).find('.form-control').each(function(index, el){
		if(status){
			$(el).attr('validated', 'true');
		}else{
			$(el).removeAttr('validated');
		}
	});
}

function clearAlerts(formControl){
	$(formControl).parent().removeClass('has-error');
	$(formControl).next('.field-helper').remove();
}

function resetFields(form){
	$(form).trigger("reset");
	$(form).find('.form-control').each(function(index, el){
		$(el).removeAttr('validated');
		clearAlerts(el);
	});
}

