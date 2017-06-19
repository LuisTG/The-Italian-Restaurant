<?php 
require_once("connectivity/connection.php");
require_once 'validations.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = mysqli_real_escape_string($db,$_POST['username']);
    //Valida el campo nombre de usuario
        if(strlen($username) > 15 || !validateNickName($username)){
            $response['status'] = false;
            $response['msg'] = 'El campo Nombres solo acepta caracteres alfabéticos y signos de puntuación sin salto de linea y está limitado a 25 caracteres';
            echo json_encode($response);
            return;
        }
        //Valida el campo contraseña
        if(!(validatePassword($_POST['password']))){
            $response['status'] = false;
            $response['msg'] = 'La contraseña debe tener un mínimo de 8 caracteres y un máximo de 16 caracteres, ademas, debe contar con al menos un número, una letra mayúscula y un caracter especial';
            echo json_encode($response);
            return;
        }
    $password = hash('sha256',$_POST['password'],false);
    $query = "SELECT contrasena, tipo, habilitada from usuarios where nombre_usuario = '$username'";    
    if(($result = $db->query($query)) && $result->num_rows > 0){
        $result = $result->fetch_assoc();
        if($result['habilitada'] == 'alta'){
        	if($result['contrasena'] == $password){
        		session_start();
        		$_SESSION['username'] = $username;
                $_SESSION['tipo'] = $result['tipo'];
        		$response['status'] = true;
        		$response['msg'] = 'OK';
                $db->close();
                echo json_encode($response);
                return;
        	}
        }else{
            $response['status'] = false;
            $response['msg'] = 'Usuario dado de baja';
            $db->close();
            echo json_encode($response);
            return;        
        }
    }
    $response['status'] = false;
    $response['msg'] = 'Usuario o contraseña no válidos';
    $db->close();
    echo json_encode($response);
    return;
}
?>