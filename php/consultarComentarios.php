<?php 
	require_once 'connectivity/connection.php';
	$record_per_page=10;
	$page='';
	$output='';
	if(isset($_POST["page"])){
		$page=$_POST["page"];
	}else{
		$page=1;
	}
	$start_from=($page-1)*$record_per_page;
	$query = "SELECT usuarios_nombre_usuario, contenido, tipo, id_pedido FROM comentarios ORDER BY id_comentario DESC LIMIT $start_from,$record_per_page";	
	$result = mysqli_query($db, $query);	
	$output .= "
				<table class='table table-hover'>
			    <thead>
        		<tr>                
		        <th>Usuario</th>		        
		        <th>Contenido</th>
		        <th>Tipo</th>
		        <th>Pedido</th>
		        </tr>
		        </thead>
		        <tbody>
				";
	while($fila = mysqli_fetch_array($result)){
		$rowColor = 'default';
	            switch($fila['tipo']){
	                case 'comentario':
	                $rowColor = 'success';
	                break;
	                case 'sugerencia':
	                $rowColor = 'warning';
	                break;
	                case 'queja':
	                $rowColor = 'danger';
	                break;
	            }

		$output .= "					       
        			<tr class=\" $rowColor fila-comentarios\">            		
            		<td class=\"usuario\" user=\"". $fila["usuarios_nombre_usuario"] ."\">".$fila["usuarios_nombre_usuario"]."</td>            		
            		<td>".$fila["contenido"]."</td>
            		<td>".$fila["tipo"]."</td>
            		<td class=\"id-pedido\" id=\"". $fila["id_pedido"] ."\">".$fila["id_pedido"]."</td>
            		</tr>        
        			";
	}
	$output .= "
				</tbody>
        		</table>
				";
	$page_query = "SELECT * FROM comentarios ORDER BY id_comentario DESC";
	$page_result = mysqli_query($db,$page_query);
	$total_records = mysqli_num_rows($page_result);
	$total_pages = ceil($total_records/$record_per_page);
	for($i=1; $i<=$total_pages;$i++){
		$output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";
	}
	echo $output;
?>



















