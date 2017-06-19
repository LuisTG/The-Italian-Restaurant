<?php
		require_once('connectivity/connection.php');
		require_once 'validations.php';
		if($_SERVER["REQUEST_METHOD"] == "POST"){		
		$usuario = mysqli_real_escape_string($db,$_POST["username"]);
		$nombres = mysqli_real_escape_string($db,$_POST["nombres"]);
		$apellidos = mysqli_real_escape_string($db,$_POST["apellidos"]);
		$telefono = mysqli_real_escape_string($db,$_POST["telefono"]);
		$email = mysqli_real_escape_string($db,$_POST["correo"]);
		$tipoUsuario = 'client';
		$foto = 'img/default/profile.png';
		$password = mysqli_real_escape_string($db,$_POST["password"]);
		//Valida el campo nombre de usuario
		if(strlen($usuario) > 15 || !validateNickName($usuario)){
			$response['status'] = false;
			$response['msg'] = 'El campo Nombres solo acepta caracteres alfabéticos y signos de puntuación sin salto de linea y está limitado a 25 caracteres';
			echo json_encode($response);
			return;
		}
		//Valida el campo contraseña
		if(!(validatePassword($password))){
			$response['status'] = false;
			$response['msg'] = 'La contraseña debe tener un mínimo de 8 caracteres y un máximo de 16 caracteres, ademas, debe contar con al menos un número, una letra mayúscula y un caracter especial';
			echo json_encode($response);
			return;
		}
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
		if(strlen($email) > 25 || !(validateEmail($email))){
			$response['status'] = false;
			$response['msg'] = 'Introduce un correo válido de máximo 25 caracteres';
			echo json_encode($response);
			return;
		}
		$queryEmail = "SELECT correo as 'existe' FROM usuarios WHERE correo = '$email' AND nombre_usuario != '$usuario' LIMIT 1";

		$result = $db->query($queryEmail);

		if($result->num_rows > 0){
			$response['status'] = false;
		    $response['msg'] = 'Este correo ya se encuentra asociado a otra cuenta';
		    $db->close();
		    echo json_encode($response);
		    return;
		}

		$consulta = "SELECT nombre_usuario FROM usuarios WHERE nombre_usuario ='$usuario'";
		
		$res = $db->query($consulta);
		
		if($res->num_rows > 0) {
			$response['status'] = False;
			$response['msg'] = 'El usuario ya existe';
			$db->close();
			echo json_encode($response);
			return;
			}
		else {
			$contrasena = hash('sha256',$password,false);
			$consulta = "INSERT INTO usuarios values ('$usuario','$contrasena','$nombres','$apellidos','$telefono','$email','$tipoUsuario', '$foto', 'alta')";
			$resultado = $db->query($consulta);
			if($resultado){
				$response['status'] = True;
				session_start();
				$_SESSION["username"] = $usuario;
				$_SESSION['tipo'] = $tipoUsuario;
				$db->close();
				echo json_encode($response);
			} else {
			$response['status'] = False;
			$response['msg'] = 'Error interno al registrar el usuario, intentelo mas tarde';
			$db->close();
			echo json_encode($response);
			return;
			}
		}
	}
?>
