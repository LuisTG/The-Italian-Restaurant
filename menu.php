<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Intento1</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" href="css/pedido.css">
	<link href="css/user.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/navigation.css">
</head>
<body>
<?php require_once 'header.php'; ?>
	<!--<img src="img/red.jpg">-->
	<div class="container-fluid" id="menu">
		<div id="tabs">
		  <h3>Platillos</h3>
		  <div>
		    <div class="row" id="secPlatillos">
		    	
		    </div>
		  </div>
		  <h3>Bebidas</h3>
		  <div >
		    <div class="row" id="secBebidas">
		    	
		    </div>
		  </div>
		  <h3>Postres</h3>
		  <div>
			<div class="row" id="secPostres">
		    	
		    </div>
		  </div>
		</div>
		<div class="modal fade" id="carritoModal">
	  <div class="modal-dialog" role="dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Agregar a carrito</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span>Agregar</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	      </div>
	    </div>
	  </div>
	</div>
	</div>
	<script src="js/jquery311.min.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/menu.js"></script>
	<script src="js/bdlogin.js"></script>
</body>
</html>