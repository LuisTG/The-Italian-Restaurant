<?php  
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'u231824686_itabd');
   $db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   if($db->connect_error){
   	die('Error en la conexion con la base de datos: ' + $db->connect_errno);
   }
?>