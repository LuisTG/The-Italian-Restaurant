<?php 
if(session_status() == PHP_SESSION_NONE){
  session_start();
}
?>
<div class="container">
      	<nav class="navbar navbar-inverse navbar-fixed-top">
        	<div class="container-fluid">
          		<div class="navbar-header">
	            	<button type="button" class="navbar-toggle collapsed toggle-button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              			<span class="sr-only">Toggle navigation</span>
              			<span class="icon-bar"></span>
	              		<span class="icon-bar"></span>
    	          		<span class="icon-bar"></span>
        	    	</button>
            		<a class="navbar-brand link-master" href="index.php#home">The Italian Restaurant</a>
          		</div>
		        <div id="navbar" class="navbar-collapse collapse">
            		<ul class="nav navbar-nav">
              			<li><a class="link-master" href="index.php#home">Inicio</a></li>
              			<li><a class="link-master" href="index.php#mision">Sobre</a></li>
              			<li><a class="link-master" href="index.php#contact">Contacto</a></li>
              			<li><a class="link-master" href="ordenar.php">Ordernar</a></li>
            		</ul>
                <!-- Inicia codigo para saber si logeado o no -->                
                <?php
                    if(isset($_SESSION['username'])):
                ?>
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION["username"]?>
                  <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Mi cuenta</a></li>
                      <li><a href="php/logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    </ul>
                  </li>
                </ul>
                <?php else: ?>
            		<ul class="nav navbar-nav navbar-right">
      					   <li><a id="registrar" data-toggle="modal" href="#registroModal"><span class="glyphicon glyphicon-user"></span> Registrarse</a></li>
      					   <li><a id ="insesion" data-toggle="modal" href="#loginModal"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesion</a></li>
    				    </ul>
                <?php
                endif
                ?>
          		</div>
        	</div>    
        </nav>
    	</div>
<?php if(!isset($_SESSION['username'])): ?>
<!--Modal de login-->
    <div class="modal fade" id="loginModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <span class="glyphicon glyphicon-log-in"></span> Iniciar Sesion</h4>
          </div>
          <form method="post" action="php/login.php" id="login-form">
            <div class="modal-body">
                <div class="form-group">
                  <label for="username" class="control-label"><span class="glyphicon glyphicon-user"></span> Nombre de usuario</label>
                  <input type="username" maxlength="15" name="username" data-toggle="tooltip" data-placement="top" title="Ejemplo: Usuario42" class="form-control" required="true" id="username" placeholder="Ingrese su nombre de usuario">
                </div>
                <div class="form-group">
                  <label for="password" class="control-label"> <span class="glyphicon glyphicon-asterisk"></span> Contaseña</label>
                  <input type="password" maxlength="16" name="password" data-toggle="tooltip" data-placement="top" title="Ejemplo: Prueba.25" pattern=".{8,15}" class="form-control" required="true" id="password" placeholder="Ingrese su contraseña (minimo 8 caracteres)">

                </div>
               <!--<div class="form-group">
                  <label for="file" class="control-label">Introduce un archivo</label>
                  <input type="file" name="file" accept=".pdf">
                </div>-->          
            </div>
            <div class="modal-footer">             
              <button type="submit" class="btn btn-primary">Aceptar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>     
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--Fin del Modal login-->
    <!--Modal de Registro -->
    <div class="modal fade activate" id="registroModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <span class="glyphicon glyphicon-log-in"></span> Registro de Usuario</h4>
          </div>
          <form method="post" action="php/registro.php" id="register-form">
            <div class="modal-body">
                <div class="alert alert-danger fade in hidden inline-alert"> Usuario o contraseña no válidos.
                </div>
                <div class="form-group">
                  <label for="username" class="control-label"><span class="glyphicon glyphicon-user"></span> Nombre de usuario: </label>
                  <input type="username" maxlength="15" autocomplete="off" name="username" data-toggle="tooltip" data-placement="top" title="Ejemplo: Usuario42" class="form-control" required="true" id="username" placeholder="Ingrese un usuario">
                </div>
                <div class="form-group">
                  <label for="password" class="control-label"> <span class="glyphicon glyphicon-asterisk"></span> Contaseña: </label>
                  <input type="password" maxlength="16" autocomplete="new-password" name="password" data-toggle="tooltip" data-placement="top" title="Ejemplo: Prueba.25" pattern=".{8,15}" class="form-control" required="true" id="password" placeholder="Ingrese una contraseña (minimo 8 caracteres)">
                </div>
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
            </div>
            <div class="modal-footer">                                    
              <button type="submit" class="btn btn-primary" >Aceptar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>            
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--Fin del Modal Registro-->
  <?php endif ?>