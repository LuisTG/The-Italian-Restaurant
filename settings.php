<?php
if(session_status() == PHP_SESSION_NONE){
  session_start();
}
if(!isset($_SESSION['username'])){
	header('Location: index.php');
}
if($_SESSION['tipo'] == 'admin'){
	$session = 'admin';
	require_once 'php/admin.php';
}else{
	$session = 'client';
	require_once 'php/user.php';
}
?>