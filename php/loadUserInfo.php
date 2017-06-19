<?php
require_once 'connectivity/connection.php';
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	$query = "SELECT nombres, apellidos, fotografia, correo FROM usuarios WHERE nombre_usuario = '$username'";
	if($result = $db->query($query)){
		$data = $result->fetch_assoc();
		$profile = array(
			'profile_photo' => $data['fotografia'],
			'profile_email' => $data['correo'],
			'profile_name' => $data['nombres'] . " " . $data['apellidos']);
		return $profile;
	}else{
		die($db->error);
	}
}
?>