<?php 
require_once 'connectivity/connection.php';
require_once 'validations.php';
session_start();
$username = $_SESSION['username'];
$nombres = mysqli_real_escape_string($db,$_POST['nombres']);
$apellidos = mysqli_real_escape_string($db,$_POST['apellidos']);
$telefono = mysqli_real_escape_string($db,$_POST['telefono']);
$correo = mysqli_real_escape_string($db,$_POST['correo']);
//$foto = mysqli_real_escape_string($db,$_FILES['fotografia']['name']);
$fotoID = uniqid();
$imageFileType = pathinfo($_FILES['fotografia']['name'],PATHINFO_EXTENSION);
$fotografia = "../img/profile_picture/" . $fotoID . "." . $imageFileType;
//Valida el campo nombres
if(strlen($nombres) > 25 || !validateTextField($nombres)){
	$response['status'] = false;
	$response['msg'] = 'El campo Nombres solo acepta caracteres alfabéticos y signos de puntuación sin salto de linea y está limitado a 25 caracteres';
	echo json_encode($response);
	return;
}
//Valida el campo apellidos
if(strlen($apellidos) > 25 || !validateTextField($apellidos)){
	$response['status'] = false;
	$response['msg'] = 'El campo Apellidos solo acepta caracteres alfabéticos y signos de puntuación sin salto de linea y está limitado a 25 caracteres';
	echo json_encode($response);
	return;
	}
//Valida el campo telefono
if(strlen($telefono) > 10 || !(validateTelephone($telefono))){
	$response['status'] = false;
	$response['msg'] = 'Introduce un número de télefono de 10 dígitos válido';
	echo json_encode($response);
	return;
}
//Valida el correo
if(strlen($correo) > 25 || !(validateEmail($correo))){
	$response['status'] = false;
	$response['msg'] = 'Introduce un correo válido de máximo 25 caracteres';
	echo json_encode($response);
	return;
}
if(!$_FILES['fotografia']['name'] == ''){
	if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES['fotografia']["tmp_name"]);
    if(!$check){
    $response['status'] = false;
	$response['msg'] = 'El archivo no es una imagen';
	echo json_encode($response);
	return;
    }
	}
	if(file_exists($fotografia)){
		$response['status'] = false;
		$response['msg'] = "El archivo ya existe: $fotografia";
		echo json_encode($response);
		return;
	}
	if ($_FILES["fotografia"]["size"] > 1240000) {
	    $response['status'] = false;
		$response['msg'] = 'El tamaño del archivo debe ser menor a 1.2MB';
		echo json_encode($response);
		return;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$response['status'] = false;
	    $response['msg'] = 'Solo puedes subir archivos jpg, jpeg, png y gif';
	    echo json_encode($response);
		return;
	}
	if(!move_uploaded_file($_FILES["fotografia"]["tmp_name"], $fotografia)){
		$response['status'] = false;
	    $response['msg'] = 'Ocurrió un error inesperado en el servidor, inténtalo mas tarde';
	    echo json_encode($response);
		return;
	}
	$query = "UPDATE usuarios SET nombres = '$nombres', apellidos = '$apellidos', telefono = '$telefono', correo = '$correo', fotografia = 'img/profile_picture/$fotoID.$imageFileType' WHERE nombre_usuario = '$username'";
}else{
	$query = "UPDATE usuarios SET nombres = '$nombres', apellidos = '$apellidos', telefono = '$telefono', correo = '$correo' WHERE nombre_usuario = '$username'";
}

$queryEmail = "SELECT correo as 'existe' FROM usuarios WHERE correo = '$correo' AND nombre_usuario != '$username' LIMIT 1";

$result = $db->query($queryEmail);

if($result->num_rows > 0){
	$response['status'] = false;
    $response['msg'] = 'Este correo ya se encuentra asociado a otra cuenta';
    echo json_encode($response);
    return;
}

if($result = $db->query($query)){
	$response['status'] = true;
    $response['msg'] = 'Su informacion personal ha sido actualizada correctamente';
    echo json_encode($response);
	return;
}
?>