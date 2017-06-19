<?php 
require_once 'connectivity/connection.php';
require_once 'validations.php';
session_start();
$currentUser = $_SESSION['username'];
$type = $_POST['selected'];
$comment = mysqli_real_escape_string($db,$_POST['comment']);
if(strlen($comment) > 140 || !(validateTextArea($comment))){
	$response['status'] = false;
	$response['msg'] = 'El campo solo acepta caracteres alfabéticos y signos de puntuación y está limimitado a 140 caracteres';
	$db->close();
	echo json_encode($response);
	return;
}
$query = "INSERT INTO comentarios (usuarios_nombre_usuario, contenido, tipo) VALUES ('$currentUser', '$comment', '$type')";
if(isset($_POST['id_pedido'])){
	$pedido = $_POST['id_pedido'];
	$testQuery = "SELECT EXISTS (SELECT id_pedido FROM pedidos WHERE id_pedido = '$pedido' LIMIT 1) as existe";
	if(($testResult = $db->query($testQuery)->fetch_assoc()) && $testResult['existe']) {
		$query = "INSERT INTO comentarios (usuarios_nombre_usuario, id_pedido, contenido, tipo) VALUES ('$currentUser', '$pedido', '$comment', '$type')";
	}else{
		$response['status'] = false;
		$response['msg'] = 'El ID del pedido no existe';
		$db->close();
		echo json_encode($response);
		return;
	}
}
if($result = $db->query($query)){
	$response['status'] = true;
	$response['msg'] = 'Su comentario ha sido enviado con éxito, su opinion nos ayuda a ofrecerle un mejor servicio.';
}else{
	$response['status'] = false;
	$response['msg'] = "Error al registrar el comentario en la base de datos: $db->error";
}
$db->close();
echo json_encode($response);
?>