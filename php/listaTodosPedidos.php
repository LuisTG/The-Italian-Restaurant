<?php 
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
require_once 'connectivity/connection.php';

session_start();
$username = mysqli_real_escape_string($db,$_SESSION['username']);

//$query = "SELECT id_pedido, date(fecha) as fecha, usuarios_nombre_usuario, monto, estado FROM pedidos WHERE estado = 'espera' ORDER BY id_pedido DESC";
$query = "SELECT id_pedido, date(fecha) as fecha, usuarios_nombre_usuario, GROUP_CONCAT(cantidad,\" \",nombre_producto) as lista_productos, monto, estado FROM pedidos, productos, productos_pedidos WHERE estado = 'espera' AND productos_id_producto = id_producto AND pedidos_id_pedido = id_pedido GROUP BY id_pedido ORDER BY id_pedido DESC";
$resulset = mysqli_query($db,$query);

$arr = array();
while($obj = mysqli_fetch_object($resulset)){
	$arr[] = array('id_pedido' => $obj->id_pedido,
		           'fecha' => $obj->fecha,
		           'usuarios_nombre_usuario' => $obj->usuarios_nombre_usuario,
		           'lista_productos' => $obj->lista_productos,
		           'monto' => $obj->monto,
		           'estado' => $obj->estado,
				  );
}
echo 'data: '.json_encode($arr)."\n\n";
flush();
?>