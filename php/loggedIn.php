<?php
    session_start();
	
	$estado = false;

	if(isset($_SESSION["dev"])) {
		$estado=true;
	}?>