<?php 
if(!$session == 'client'){
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
	<link href="https://fonts.googleapis.com/css?family=Baloo|Open+Sans|Pacifico" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/navigation.css">
  	<link href="css/user.css" type="text/css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="css/footer.css">
</head>
<body>
	<?php require 'header.php'; ?>
	<?php require 'php/loadUserInfo.php'; ?>
	<div class="container-fluid">
		<div class="container-fluid content-body">
		<div class="row">
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
			  <li class="active" id="lista-pedidos"><a data-toggle="pill" href="#pedidos" id="my-list">Mis pedidos</a></li>
			  <li><a data-toggle="pill" href="#datos" id="user-data">Mis datos personales</a></li>
			  <li><a data-toggle="pill" href="#pass" id="password-change">Cambiar contraseña</a></li>
			  <li><a data-toggle="pill" href="#comment" id="user-feedback">Comentarios y sugerencias</a></li>
			  <li><a data-toggle="pill" href="#close" id="close-account">Cerrar cuenta</a></li>
			</ul>
		</div>
		<div class="col-sm-9">
			<div class="tab-content">
				<div id="pedidos" class="tab-pane fade in active">
					<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Historial de pedidos</h4>
					</div>
					<div class="panel-body">
						<div class="alert alert-info alert-dismissable">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong><span class="glyphicon glyphicon-heart"></span> Compártenos tu experiencia!</strong> solo has click en cualquier pedido terminado.
						</div>
						<table class="table table-hover tabla-pedidos">

						</table>
						<div id="loadPedidos" class="col-xs-4 col-xs-offset-4">
							<div class="loader"></div>
						</div>
					</div>
				</div>
				</div>
				<div id="datos" class="tab-pane fade">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Modificar información personal</h4>
						</div>
						<div class="panel-body">
							<form method="post" action="" id="update-form" enctype="multipart/form-data">
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
				                  <input class="file" maxlength="50" autocomplete="off" type="file" name="fotografia" accept=".jpg,.png">
				                </div>
				            </div>
				            <div class="modal-footer">                                    
				              <button type="submit" class="btn btn-primary" >Actualizar</button>          
				            </div>
				          </form>
						</div>
					</div>
				</div>
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
				</div>
				<div id="comment" class="tab-pane fade">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Enviar comentarios o sugerencias</h4>
						</div>
						<div class="panel-body">
						<p>Si tiene algún comentario o sugerencia acerca de como poder ofrecerle un mejor servicio, favor de utilizar el siguiente formulario:</p>
							<form method="post" action="" id="comment-form">
								<div class="form-group">
									<label for="comment-type" class="control-label">Tipo de comentario: </label>
									<select class="form-control" name="selected" required="true">
										<option value="" selected disabled>Seleccione una opcion</option>
										<option value="comentario">Comentario</option>
										<option value="queja">Queja</option>
										<option value="sugerencia">Sugerencia</option>
									</select>
								</div>
								<div class="form-group">
									<label for="comment" class="control-label">Comentario: </label>
									<textarea type="textarea" autocomplete="off" maxlength="140" required="true" data-toggle="tooltip" data-placement="top" title="Ejemplo: Excelente servicio!" class="form-control" rows="5" id="comment-box" name="comment"></textarea>
								</div>
								<div class="modal-footer">                                    
					              <button type="submit" class="btn btn-primary">Enviar</button>          
					            </div>
							</form>
						</div>
					</div>
				</div>
				<div id="close" class="tab-pane fade">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Eliminar la cuenta actual</h4>
						</div>
						<div class="panel-body">
							<div class="alert alert-danger">
							  <strong>Alerta!</strong> Una vez confirmada la eliminación de su cuenta procederemos a eliminar cualquier dato relacionado con la misma por lo cual usted no podrá volver a acceder a la información dentro de ella.
							</div>
							<form method="post" action="" id="delete-form">
								<div class="form-group">
									<label for="password" class="control-label">Contraseña actual</label>
									<input type="password" maxlength="16" autocomplete="off" name="password" data-toggle="tooltip" data-placement="top" title="Ejemplo: Prueba.25" class="form-control" required="true" placeholder="Ingrese su contraseña actual">
								</div>
								<div class="modal-footer">                                    
					              <button type="submit" class="btn btn-primary">Confirmar eliminación</button>          
					            </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		</div>
		</div>
		<!--Espacio reservado para el modal de alerta-->
		</div>
		<?php require_once 'footer.php'; ?>
	<script src="js/jquery311.min.js"></script>
  <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/validations.js"></script>
	<script src="js/bdlogin.js"></script>
	<script src="js/user-tab.js"></script>
	<script src="js/alerts.js"></script>
</body>
</html>