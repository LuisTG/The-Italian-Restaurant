<?php
require_once 'connectivity/connection.php';
require_once 'validations.php';
session_start();
$oldPassword = mysqli_real_escape_string($db,$_POST['oldPassword']);
$newPassword = mysqli_real_escape_string($db,$_POST['newPassword']);
$confirmPassword = mysqli_real_escape_string($db,$_POST['confirmPassword']);
$currentUser = $_SESSION['username'];
//Validar contraseña actual
if(!(validatePassword($oldPassword))){
	$response['status'] = false;
	$response['msg'] = 'La contraseña debe tener un mínimo de 8 caracteres y un máximo de 16 caracteres, ademas, debe contar con al menos un número, una letra mayúscula y un caracter especial';
	echo json_encode($response);
	return;
}
//Validar contraseña nueva
if(!(validatePassword($newPassword))){
	$response['status'] = false;
	$response['msg'] = 'La nueva contraseña debe tener un mínimo de 8 caracteres y un máximo de 16 caracteres, ademas, debe contar con al menos un número, una letra mayúscula y un caracter especial';
	echo json_encode($response);
	return;
}
//Validar contraseña de confirmacion
if(!(validatePassword($confirmPassword))){
	$response['status'] = false;
	$response['msg'] = 'La contraseña de confirmación debe tener un mínimo de 8 caracteres y un máximo de 16 caracteres, ademas, debe contar con al menos un número, una letra mayúscula y un caracter especial';
	echo json_encode($response);
	return;
}
$query = "SELECT contrasena FROM usuarios WHERE nombre_usuario = '$currentUser'";
$storedPassword;
if($result = $db->query($query)){
	$result = $result->fetch_assoc();
	$storedPassword = $result['contrasena'];
}else{
	$response['status'] = false;
	$response['msg'] = "No se recibió una respuesta de parte del servidor: $db->error";
	echo json_encode($response);
	return;
}
$oldPassword = hash('sha256',$oldPassword,false);
if($storedPassword === $oldPassword){
	if($newPassword === $confirmPassword){
		$newPassword = hash('sha256',$newPassword,false);
		$query = "UPDATE usuarios SET contrasena = '$newPassword' WHERE nombre_usuario = '$currentUser'";
		if($result = $db->query($query)){
			$response['status'] = true;
			$response['msg'] = 'Su contraseña ha sido actualizada correctamente';
		}
	}else{
		$response['status'] = false;
		$response['msg'] = 'La contraseña de confirmación no coincide con la nueva contraseña';
	}
}else{
	$response['status'] = false;
	$response['msg'] = 'La contraseña actual no es correcta';
}
echo json_encode($response);
?>