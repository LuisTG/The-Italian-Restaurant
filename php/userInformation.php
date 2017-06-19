<?php
require_once 'connectivity/connection.php';
session_start();
$username = mysqli_real_escape_string($db,$_SESSION['username']);
$query = "SELECT nombres, apellidos, telefono, correo FROM usuarios WHERE nombre_usuario = '$username'";
if($result = $db->query($query)){
	$data = $result->fetch_assoc();
	echo json_encode($data);
}else{
	die($db->error);
}
?>