<?php 
if($sessionRequired){
	if(!isset($_SESSION['username'])){
		die('Necesitas iniciar sesion en The Italian Restaurant para ver esta pagina!');
	}
}
if(isset($_SESSION['tipo'])){
	if($_SESSION['tipo'] == 'client'){
		$accountSettings = '/user.php';
	}else{
		$accountSettings = '/admin.php';
	}
}
?>