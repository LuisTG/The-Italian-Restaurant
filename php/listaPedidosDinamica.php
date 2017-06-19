<?php 
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
require_once 'connectivity/connection.php';
session_start();
$username = mysqli_real_escape_string($db,$_SESSION['username']);
$query = "SELECT id_pedido, date(fecha) as fecha, GROUP_CONCAT(cantidad,\" \",nombre_producto) as lista_productos, monto, estado FROM pedidos, productos, productos_pedidos WHERE usuarios_nombre_usuario = '$username' AND productos_id_producto = id_producto AND pedidos_id_pedido = id_pedido GROUP BY id_pedido ORDER BY id_pedido DESC";
if($result = $db->query($query)){
	$array = array();
	for ($i=0; $item = $result->fetch_assoc(); $i++) { 
		$array[$i] = $item;
	}
}else{
	die($db->error);
}
echo 'data: '.json_encode($array)."\n\n";
flush();
sleep(1);
?>