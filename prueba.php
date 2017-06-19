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

<h1>Getting server updates</h1>
<?php
    include "pedido.php";
    include "actualizarProductoModal.php"
?>
    <script src="js/jquery311.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/menu3.js"></script>
    <script src="js/bdlogin.js"></script>
<script>
if(typeof(EventSource) !== "undefined") {
	console.log("entra");
    var sourcess = new EventSource("php/menu.php");
    sourcess.onmessage = function(event) {
        console.log("actualizo");
                $("#secPlatillos").empty();
        $("#secBebidas").empty();
        $("#secPostres").empty();
        dataJson = JSON.parse(event.data);
        for(var i in dataJson){
          var s= "<div class='col-lg-4 col-md-6 col-sm-12 col-xs-12'><div class='thumbnail'><a data-toggle='modal' href='#carritoModal'><img class='imgtabs' style='height: 200px;' src='"
          +dataJson[i].imagen+"' alt='"+dataJson[i].id_producto+"'></a><div class='caption'><p>"+dataJson[i].nombre_producto+"</p></div></div></div>";
           switch(dataJson[i].tipo){
            case "platillo":
                $("#secPlatillos").append(s);
            break;
            case "bebida":
                $("#secBebidas").append(s);
            break;
            case "postre":
                $("#secPostres").append(s);
            break;
           }
            
        }
    };
} else {
    document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
}
</script>

</body>
</html>
