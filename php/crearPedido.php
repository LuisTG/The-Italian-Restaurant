<?php 
require_once("connectivity/connection.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	session_start();
    $username=$_SESSION['username'];
    $id=uniqid();
    $fecha=date( "Y-m-d H:i:s" );
    $monto=0;
    foreach ($_POST["datosBD"] as $valor) {
    	$query="Select precio from productos where id_producto='$valor[0]'";
    	$result=$db->query($query);
    	$result = $result->fetch_assoc();
    	$monto+=$valor[1]*$result["precio"];
    }
    $query = "INSERT INTO pedidos (id_pedido,usuarios_nombre_usuario,fecha,monto,estado) VALUES ('$id','$username','$fecha','$monto','espera')";
    if($result = $db->query($query)){
    	foreach ($_POST["datosBD"] as $valor) {
    		$query = "INSERT INTO productos_pedidos (productos_id_producto,pedidos_id_pedido,cantidad) VALUES ('$valor[0]','$id','$valor[1]')";
			if(!$result=$db->query($query)){
				$response["status"]=false;
    			$response["msg"]="Error al registrar los productos";
    			echo json_encode($response);
    			$query="UPDATE pedidos SET estado='cancelado' WHERE id_pedido='$id'";
    			$result = $db->query($query);
                $db->close();
    			return;
			}
		}
    	$response["status"]=true;
    	$response["msg"]="Pedido realizado con éxito";
    	echo json_encode($response);
    	$db->close();
    	return;
    }
    $response["status"]=false;
    $response["msg"]="Error al registrar el pedido";
    $db->close();
    echo json_encode($response);
}
?>