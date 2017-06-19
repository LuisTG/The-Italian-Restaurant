<?php
require_once("connectivity/connection.php");

$id= $_POST["id"];

$query = "SELECT * FROM productos where id_producto='$id'";
 
$arr = array();
if($result = $db->query($query)){
	while ($obj = mysqli_fetch_object($result)) {
	    $arr[] = array('id_producto' => $obj->id_producto,
	                   'nombre_producto' => $obj->nombre_producto,
	                   'descripcion' => $obj->descripcion,
	                   'precio' => $obj->precio,
	                   'imagen' => $obj->imagen,
	                   'tipo' => $obj->tipo,
	                   'habilitada'=>$obj->habilitada,
	        );
	}
}
echo json_encode($arr);