<?= $sessionRequired = false; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Ordenar</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link href="https://fonts.googleapis.com/css?family=Baloo|Open+Sans|Pacifico" rel="stylesheet">
	<link href="css/btplantilla.css" rel="stylesheet">
	<link rel="stylesheet" href="css/pedido.css">
	<link rel="stylesheet" type="text/css" href="css/navigation.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
</head>
<body>
	<div id="bannerOrdenar" class="container-fluid">
		<!--Se incluye el menu de navegación-->
		<?php require_once 'header.php'; ?>
		
		<div class="container-fluid container-title2">
  			<h1 class="page-title">The Italian Restaurant</h1>
  		</div>
	</div>

	<div class="container-fluid">
  		<div id="info-orden" class="row">
  			<div id="contenedor" class="col-md-12 col-lg-8 col-sm-12 col-xs-12">
	  			<div id="lista-producto">
	  				<h3>Menú</h3>	
	  				<?php include 'pedido.php'; ?>
	  				<?php include 'carritoModal.php'; ?>
		    	</div>
	    	</div>
			<div id="contenedor" class="col-md-12 col-lg-4 col-sm-12 col-xs-12">
		        <div id="carritoTable" >
		        	<div class="form-group">
			        	<h3>Tu carrito</h3>	        		        	
			        	<table class="table table-striped">		
			        		<thead>
						   		<th>Cantidad</th>
						  		<th>Nombre del producto</th>
						   		<th>Costo</th>
						   		<th>Eliminar</th>
						    </thead>

						    <tbody>
						    </tbody>

						    <tfoot>
						    	<td colspan="4" id="costoTotal">Total: 0.0</td>
						    </tfoot>
				    	</table>  
			    	</div>
			    	 <form method="post" action="" id="pedido-form">
				    	<div class="form-group" id="btnAceptar">	
					    	<button  type="submit" class="btn btn-primary">Ordenar</button>
						</div>
					</form>  
		        </div>
		    </div>
  		</div>
    </div>
    <?php require_once 'footer.php'; ?>
	<script src="js/jquery311.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/validations.js"></script>
	<script src="js/alerts.js" type="text/javascript"></script>
	<script src="js/menu.js"></script>
  	<script src="js/bdlogin.js"></script>
</body>
</html>