<?php
require_once 'connectivity/connection.php';

session_start();
$username = mysqli_real_escape_string($db,$_SESSION['username']);

$query = "SELECT id_pedido, date(fecha) as fecha, usuarios_nombre_usuario, monto, estado FROM pedidos WHERE estado = 'espera' ORDER BY id_pedido DESC";
$resulset = mysqli_query($db,$query);

$arr = array();
while($obj = mysqli_fetch_object($resulset)){
	$arr[] = array('id_pedido' => $obj->id_pedido,
		           'fecha' => $obj->fecha,
		           'usuarios_nombre_usuario' => $obj->usuarios_nombre_usuario,
		           'monto' => $obj->monto,
		           'estado' => $obj->estado,
				  );
}
echo json_encode($arr);
?>