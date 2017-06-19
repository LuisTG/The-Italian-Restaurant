<?php 
require_once 'connectivity/connection.php';
session_start();
$currentUser = $_SESSION['username'];
$password = hash('sha256',$_POST['password'],false);
$query = "SELECT contrasena from usuarios where nombre_usuario = '$currentUser'";
if($result = $db->query($query)){
    $result = $result->fetch_assoc();
    if($result['contrasena'] == $password){
 		$query="UPDATE usuarios SET habilitada='baja' WHERE nombre_usuario='$currentUser'";
		if($result = $db->query($query)){
			$response['status'] = true;
			$response['msg'] = 'Su cuenta ha sido dada de baja exitosamente';
			unset($_SESSION['username']);
			session_destroy();		
		}else{
			$response['status'] = false;
			$response['msg'] = "Error al dar de baja su cuenta $db->error";
		}
		echo json_encode($response);
    }else{
    	$response['status'] = false;
		$response['msg'] = "Lo sentimos, password incorrecto $db->error";
		echo json_encode($response);
	}
}
?>