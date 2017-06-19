<?php 
require_once 'connectivity/connection.php';
session_start();

$username = mysqli_real_escape_string($db,$_SESSION['username']);
$query = "SELECT id_comentario, usuarios_nombre_usuario, tipo, contenido FROM comentarios ORDER BY id_comentario DESC";

if($result = $db->query($query)){
	$array = array();
	for ($i=0; $item = $result->fetch_assoc(); $i++) { 
		$array[$i] = $item;
	}
}else{
	die($db->error);
}
$db->close();
echo json_encode($array);
?>








