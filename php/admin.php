<?php 
if(!$session == 'admin'){
	header('Location: ../settings.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>The Italian Restaurant</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link href="https://fonts.googleapis.com/css?family=Baloo|Open+Sans|Pacifico" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/navigation.css">
  	<link href="css/admin.css" type="text/css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="css/pedido.css">
  	<link rel="stylesheet" type="text/css" href="css/footer.css">
</head>
<body>
	<?php 
		require 'header.php';
		require_once 'php/loadUserInfo.php';
	?>
	<div class="container-fluid">
		<div class="container-fluid content-body">
			<div class="row">
				<!-- Parte izquierda (Barra de menu, Datos cuenta...) -->
				<div class="col-sm-3 sidebar">
					<ul class="nav nav-pills nav-stacked menu-bar">
						<li id="profile-info">
				  			<div class="media">
					  			<div class="media-left media-middle">
					    			<img src=<?= "\"". $profile['profile_photo'] . "\"" ?> class="media-object" style="width:60px">
					  			</div>
					  			<div class="media-body">
					    			<h4 class="media-heading"><?= $profile['profile_name'] ?></h4>
					    			<p><?= $profile['profile_email'] ?></p>
					  			</div>
							</div>
			  			</li>
			  			<li class="active"><a data-toggle="pill" href="#pedidos" id="my-list">Lista de pedidos</a></li>
			  			<li><a data-toggle="pill" href="#datos" id="user-data">Mis datos personales</a></li>
			  			<li><a data-toggle="pill" href="#pass" id="password-change">Cambiar contraseña</a></li>
			  			<li><a data-toggle="pill" href="#addProduct" id="add-products">Agregar productos</a></li>
			  			<li><a data-toggle="pill" href="#viewComments" id="user-comments">Ver comentarios</a></li>
					</ul>
				</div>
				<!-- Termina parte izquierda -->
				<!-- Empieza Parte derecha (Informacion de cada menu...) -->
				<div class="col-sm-9">
					<div class="tab-content">
						<!-- Panel de Historial de pedidos -->
						<div id="pedidos" class="tab-pane fade in active">							
							<div class="panel panel-default">
								<div class="panel-heading" id="addListHeading">
									<h4>Historial de pedidos</h4>
								</div>
								<div class="panel-body">
									<table id="historial-pedidos" class="table table-hover tabla-pedidos">

									</table>
								</div>
								<div class="modal-footer">                                    
							     	<!-- <button type="submit" class="btn btn-primary" id="guardar-cambios">Guardar Cambios</button> -->
							    </div>
							</div>							
						</div> <!-- Termina panel de hostorial de pedidos -->
						<!-- Panel de Datos Personales -->
						<div id="datos" class="tab-pane fade">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4>Modificar información personal</h4>
								</div>
								<div class="panel-body">
									<form method="post" action="" id="update-form">
						            <div class="modal-body">
						                <div class="form-group">
						                  <label for="nombres" class="control-label"> <span class="glyphicon glyphicon-user"></span> Nombres: </label>
						                  <input type="textfield" maxlength="25" autocomplete="off" name="nombres" data-toggle="tooltip" data-placement="top" title="Ejemplo: Juan Carlos" class="form-control" required="true" id="nombres" placeholder="Ingrese uno o mas nombres">
						                </div>
						                <div class="form-group">
						                  <label for="apellidos" class="control-label"> <span class="glyphicon glyphicon-user"></span> Apellidos: </label>
						                  <input type="textfield" maxlength="25" autocomplete="off" name="apellidos" data-toggle="tooltip" data-placement="top" title="Ejemplo: Perez Castro" class="form-control" required="true" id="apellidos" placeholder="Ingrese uno o mas apellidos">
						                </div>
						                <div class="form-group">
						                  <label for="telefono" class="control-label"> <span class="glyphicon glyphicon-earphone"></span> Telefono: </label>
						                  <input type="tel" maxlength="10" autocomplete="off" name="telefono" data-toggle="tooltip" data-placement="top" title="Ejemplo: 2299447766" class="form-control" pattern="[0-9]{10}" required="true" id="telefono" placeholder="Ingrese su telefono (10 dígitos)">
						                </div>
						                <div class="form-group">
						                  <label for="correo" class="control-label"> <span class="glyphicon glyphicon-envelope"></span> Correo: </label>
						                  <input type="email" maxlength="25" autocomplete="off" name="correo" data-toggle="tooltip" data-placement="top" title="Ejemplo: ejemplo@mail.com" class="form-control" required="true" id="correo" placeholder="Ingrese su correo">
						                </div>
						                <div class="form-group">
				                  			<label for="file" class="control-label">Fotografia:</label>
				                  			<input class="file" type="file" name="fotografia" accept=".jpg">
				                		</div>
						            </div>
						            <div class="modal-footer">                                    
						              <button type="submit" class="btn btn-primary">Actualizar</button>          
						            </div>
						          </form>
								</div>
							</div>
						</div> <!-- termina panel de Datos Personales -->
						<!-- Panel de Actualización de contraseña -->
						<div id="pass" class="tab-pane fade">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4>Actualizar contraseña</h4>
								</div>
								<div class="panel-body">
									<form method="post" action="" id="password-form">
										<div class="form-group">
											<label for="password" class="control-label">Contraseña actual: </label>
											<input type="password" maxlength="16" autocomplete="off" name="oldPassword" data-toggle="tooltip" data-placement="top" title="Ejemplo: Prueba.25" class="form-control" required="true" placeholder="Ingrese su contraseña actual">
										</div>
										<div class="form-group">
											<label for="newPassword" class="control-label">Nueva contraseña: </label>
											<input type="password" maxlength="16" autocomplete="off" name="newPassword" data-toggle="tooltip" data-placement="top" title="Ejemplo: Nueva.42" class="form-control" required="true" placeholder="Ingrese su nueva contraseña">
										</div>
										<div class="form-group">
											<label for="confirmPassword" class="control-label">Confirmar contraseña: </label>
											<input type="password" maxlength="16" autocomplete="off" name="confirmPassword" data-toggle="tooltip" data-placement="top" title="Ejemplo: Nueva.42" class="form-control" required="true" placeholder="Vuelva a escribir su nueva contraseña">
										</div>
										<div class="modal-footer">                                    
							              <button type="submit" class="btn btn-primary" >Actualizar</button>          
							            </div>
									</form>
								</div>
							</div>
						</div> <!-- Termina panel de actualización de contraseña -->
						<!-- Panel de Agregar Producto -->
						<div id="addProduct" class="tab-pane fade">
							<div class="panel panel-default">
								<div class="panel-heading" id="addProductHeading">
									<h4>Añadir producto nuevo <a data-toggle='modal' id="addProduct-button" href='#registroProducto'><span class="glyphicon glyphicon-plus"></span></a></h4>
								</div>
								<div class="panel-body">	
									<div id="contenedor">						
										<?php
											require_once 'pedido.php';
										?>
									</div>
								</div>
							</div>
						</div> <!-- Termina panel de agregar producto-->

						<!-- Panel de vista de comentarios -->
						<div id="viewComments" class="tab-pane fade">							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4>Lista de Comentarios</h4>
								</div>
								<div class="panel-body" id="cuerpoComentarios">
									
									<!--
									<table id="lista-comentarios" class="table table-hover tabla-comentario">

									</table>
									-->
								</div>
								<div class="modal-footer comentarios-footer">                                    
							     	<!-- <button type="submit" class="btn btn-primary" id="guardar-cambios">Guardar Cambios</button> -->
							    </div>
							</div>							
						</div> <!-- Termina panel de vista de comentarios -->
					</div>
				</div>
		</div>
		</div>
		</div>

		<?php 
		require_once 'footer.php'; 
		require_once 'registroProductoModal.php';
		require_once 'actualizarProductoModal.php';
		?>
	<script src="js/jquery311.min.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/validations.js"></script>	
	<script src="js/alerts.js"></script>
	<script src="js/menu3.js"></script>
	<script src="js/bdlogin.js"></script>
	<script src="js/admin-tab.js"></script>
</body>
</html>