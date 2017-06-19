<?php 
require_once 'connectivity/connection.php';
$id=mysqli_real_escape_string($db,$_POST['id']);
$productname = mysqli_real_escape_string($db,$_POST['productname']);
$descripcion = mysqli_real_escape_string($db,$_POST['descripcion']);
$precio = mysqli_real_escape_string($db,$_POST['precio']);
$tipoProducto = mysqli_real_escape_string($db,$_POST['tipoProducto']);
$habilitada = mysqli_real_escape_string($db,$_POST['habilitada']);
$imgEmpty=basename($_FILES['imgProducto']['name']);
$img = "img/productos/" . basename($_FILES['imgProducto']['name']);
$imgComprobar="../img/productos/" . basename($_FILES['imgProducto']['name']);
$imageFileType = pathinfo($imgComprobar,PATHINFO_EXTENSION);

if(!empty($imgEmpty)){
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES['imgProducto']["tmp_name"]);
	    if(!$check){
	    $response['status'] = false;
		$response['msg'] = 'El archivo no es una imagen';
		echo json_encode($response);
		return;
	    }
	}if($habilitada!='alta' && $habilitada!='baja'){
	    $response['status'] = false;
		$response['msg'] = 'Opción de habilitado incorrecta';
		echo json_encode($response);
		return;
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
	$query = "UPDATE productos SET  nombre_producto='$productname', descripcion='$descripcion',precio='$precio',imagen='$img',tipo='$tipoProducto',habilitada='$habilitada' where id_producto='$id'";
}else{
		$query = "UPDATE productos SET  nombre_producto='$productname', descripcion='$descripcion',precio='$precio',tipo='$tipoProducto',habilitada='$habilitada' where id_producto='$id'";
}

if($result = $db->query($query)){
	$response['status'] = true;
    $response['msg'] = 'Producto actualizado correctamente';
    echo json_encode($response);
	return;
}
	$response['status'] = false;
    $response['msg'] = 'Error al actualizar el producto';
    echo json_encode($response);
	return;

?>