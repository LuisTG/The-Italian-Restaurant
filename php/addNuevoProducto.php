<?php 
require_once 'connectivity/connection.php';
$productname = mysqli_real_escape_string($db,$_POST['productname']);
$descripcion = mysqli_real_escape_string($db,$_POST['descripcion']);
$precio = mysqli_real_escape_string($db,$_POST['precio']);
$tipoProducto = mysqli_real_escape_string($db,$_POST['tipoProducto']);
$img = "img/productos/" . basename($_FILES['imgProducto']['name']);
$imgComprobar="../img/productos/" . basename($_FILES['imgProducto']['name']);
$imageFileType = pathinfo($imgComprobar,PATHINFO_EXTENSION);
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES['imgProducto']["tmp_name"]);
    if(!$check){
    $response['status'] = false;
	$response['msg'] = 'El archivo no es una imagen';
	echo json_encode($response);
	return;
    }
}
if(file_exists($imgComprobar)){
	$response['status'] = false;
	$response['msg'] = 'El archivo ya existe';
	echo json_encode($response);
	return;
}
if ($_FILES["imgProducto"]["size"] > 1240000) {
    $response['status'] = false;
	$response['msg'] = 'El tamaño del archivo debe ser menor a 1.2MB';
	echo json_encode($response);
	return;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
	$response['status'] = false;
    $response['msg'] = 'Solo puedes subir archivos jpg, jpeg, png y gif';
    echo json_encode($response);
	return;
}
if(!move_uploaded_file($_FILES["imgProducto"]["tmp_name"], $imgComprobar)){
	$response['status'] = false;
    $response['msg'] = 'Ocurrió un error inesperado en el servidor, inténtalo mas tarde';
    echo json_encode($response);
	return;
}
$query = "INSERT INTO productos (nombre_producto, descripcion,precio,imagen,tipo) VALUES ('$productname','$descripcion','$precio','$img','$tipoProducto')";
/*
INSERT INTO `productos`(`id_producto`, `nombre_producto`, `descripcion`, `precio`, `imagen`, `tipo`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])
*/
if($result = $db->query($query)){
	$response['status'] = true;
    $response['msg'] = 'Producto agregado correctamente';
    echo json_encode($response);
	return;
}
$response['status'] = false;
    $response['msg'] = 'Error al guardar el producto';
    echo json_encode($response);
	return;

?>