<?= $sessionRequired = false; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>The Italian Restaurant</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Baloo|Open+Sans|Pacifico" rel="stylesheet">
  <link href="css/btplantilla.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/navigation.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
</head>
<body data-offset="200">
 <div id="home" class="container-fluid">
    <?php require_once 'header.php'; ?>
  		<div class="container-fluid container-title">
  			<h1 class="page-title">The Italian Restaurant</h1>
  		</div>
  		<div id="text-carousel" class="carousel slide" data-ride="carousel">
    		<ol class="carousel-indicators">
	    		<li data-target="#text-carousel" data-slide-to="0" class="active"></li>
    			<li data-target="#text-carousel" data-slide-to="1"></li>
    			<li data-target="#text-carousel" data-slide-to="2"></li>
    			<li data-target="#text-carousel" data-slide-to="3"></li>
    		</ol>
    		<div class="carousel-inner inner-text" role="listbox">
	    		<div class="item active">
    				<div class="container container-promo">
      					<h1>Un servicio excelente</h1>
       					<p>"En este lugar encontré el mejor servicio al cliente que un restaurante puede ofrecerte"</p>
    				</div>
    			</div>
    			<div class="item">
	    			<div class="container container-promo">
    	  				<h1>Sin largas esperas</h1>
       					<p>"En este restaurante es tan sencillo ordenar comida que no te enteras de cuando llega!"</p>
    				</div>
    			</div>
    			<div class="item">
    				<div class="container container-promo">
        				<h1>Un sabor sin igual</h1>
        				<p>"No he encontrado un lugar donde la comida sea tan buena, todo parece tan fresco y delicioso"</p>
      				</div>
      			</div>
      			<div class="item">
      				<div class="container container-promo">
        				<h1>El mejor precio</h1>
        				<p>"Aqui pagas lo justo por la comida, ni mas ni menos"</p>
      				</div>
      			</div>
    		</div>
  		</div>
	</div>
  <div id="mision" class="container-fluid">
  	<div class="col-lg-12 col-md-12 col-sm-12" id="mision">
    	<p id="misionP">En este restaurante podras encontrar deliciosos platillos italianos: espaguetis, albondigas, pizzas, hechos por los mejores cocineros que puedes conocer, de igual forma disfruta nuestras bebidas, navega por nuestro sitio y disfruta de los diversos platillos que podemos ofrecerte</p>
  	</div>
    </div>
    <div id="slideshow" class="container-fluid">
  	<div class="carousel-dos">
    	<div id="myCarousel2" class="carousel slide" data-ride="carousel">
      		<ol class="carousel-indicators">
        		<li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
        		<li data-target="#myCarousel2" data-slide-to="1"></li>
            <li data-target="#myCarousel2" data-slide-to="2"></li>
        		<li data-target="#myCarousel2" data-slide-to="3"></li>
            <li data-target="#myCarousel2" data-slide-to="4"></li>
      		</ol>
      		<div class="carousel-inner carousel-img" role="listbox">
        		<div class="item active">
          			<img src="img/ita001.jpg" alt="">
        		</div>
        		<div class="item">
          			<img src="img/ita002.jpg" alt="">
        		</div>            		
        		<div class="item">
          			<img src="img/ita003.jpg" alt="">
        		</div>
            <div class="item">
                <img src="img/ita004.jpg" alt="">
            </div>
            <div class="item">
                <img src="img/ita005.jpg" alt="">
            </div>
	        </div>               
      		<a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
       			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
       			<span class="sr-only">Previous</span>
      		</a>
      		<a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
       			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
       			<span class="sr-only">Next</span>
      		</a>        
    	</div>
  	</div>
    </div>
    <div id="contact" class="container-fluid">
  	<div id="info" class="row">
    	<div id="contacto" class="col-sm-4 info-col">
    	<h3>Contacto</h3>
      <br>
      <p>Telefono: <a href="tel:+15555551212">555-555-1212</a></p>
      <p>Email: <a href="mailto:contacto@adminredes.local">contacto@adminredes.local</a></p>
      <p>Facebook: <a href="https://www.facebook.com" target="_blank">The Italian Restaurant</a></p>
      <p>Twitter: <a href="https://www.twitter.com" target="_blank">The Italian Restaurant</a></p>
    	</div>
    	<div id="horario" class="col-sm-4 info-col">
    	<h3>Horario</h3>
    	<br><p> Barra: Abierta hasta tarde</p>
    	<p>Lunes: 08:00 - 22:30</p>
    	<p>Martes: 08:00 - 22:30</p>
    	<p>Miercoles: 08:00 - 22:30</p>
        <p>Jueves: 08:00 - 22:30</p>
        <p>Viernes: 08:00 - 22:30</p>
        <p>Sabado: 10:00 - 22:30</p>
        <p>Domingo: 10:00 - 16:00</p>
        </div>
        <div id="ubicacion" class="col-sm-4 info-col">
        <h3>Ubicacion</h3>
        <br><p>Direccion: Blvd. Manuel Ávila Camacho 2632</p>
        <div class="container-fluid map-container">
        <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d942.0660389659206!2d-96.13580223704147!3d19.183656602972846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c346b4603c6449%3A0xb6c312a25458e923!2sAlacio+P%C3%A9rez+1434%2C+Salvador+D%C3%ADaz+Mir%C3%B3n%2C+91700+Veracruz%2C+Ver.!5e0!3m2!1ses-419!2smx!4v1488307158253" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        </div>
  	</div>
    </div>
    <?php require_once 'footer.php'; ?>
    <!--La longitud de los campos debe ser igual al tamaño maximo permitido en la base de datos-->
    <!--LOS SCRIPTS PONERLOS AL FINAL PARA QUE LA PAGINA CARGUE MAS RAPIDO-->
  <script src="js/jquery311.min.js"></script>
  <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/validations.js"></script>
  <script src="js/alerts.js"></script>
  <script src="js/bdlogin.js"></script>
</body>
</html>