<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
require_once("connectivity/connection.php");

if($_GET['admin']=="true"){
	$sql = "SELECT * FROM productos order by habilitada";
}else{
	$sql = "SELECT * FROM productos where  habilitada = 'alta'";
}

$resulset = mysqli_query($db,$sql);
 
$arr = array();
while ($obj = mysqli_fetch_object($resulset)) {
    $arr[] = array('id_producto' => $obj->id_producto,
                   'nombre_producto' => $obj->nombre_producto,
                   'descripcion' => $obj->descripcion,
                   'precio' => $obj->precio,
                   'imagen' => $obj->imagen,
                   'tipo' => $obj->tipo,
                   'habilitada' => $obj->habilitada,
        );
}
echo 'data: ' . json_encode($arr) . "\n\n";
flush();
?>
