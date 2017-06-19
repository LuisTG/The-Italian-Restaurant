<?php 
require_once("connectivity/connection.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){    
	session_start();
    /*
    foreach($_POST["dataJsonPedidos"] as $valor){        
        $query="UPDATE pedidos SET id_pedido='$valor[0]', usuarios_nombre_usuario='$valor[2]', fecha='$valor[1]', monto='$valor[3]', estado='$valor[4]' WHERE id_pedido='$valor[0]'";
        $result=$db->query($query);
        if(!$result=$db->query($query)){
            $response["status"]=false;
            $response["msg"]="Error al realizar cambios en historial de pedidos";
            echo json_encode($response);
            $db->close();
            return;
        }
    }
    */
    $valor[0] = $_POST["id"];
    $valor[1] = $_POST["fecha"];
    $valor[2] = $_POST["nombre"];
    $valor[3] = $_POST["productos"];
    $valor[4] = $_POST["costo"];
    $valor[5] = $_POST["estado"]; 
    $query="UPDATE pedidos SET id_pedido='$valor[0]', usuarios_nombre_usuario='$valor[2]', fecha='$valor[1]', monto='$valor[4]', estado='$valor[5]' WHERE id_pedido='$valor[0]'";
        $result=$db->query($query);
        if(!$result=$db->query($query)){
            $response['status']=false;
            $response['msg']='Error al realizar cambios en historial de pedidos';
            echo json_encode($response);            
            $db->close();
            return;
        }        
    $response['status']=true;
    $response['msg']='Cambios en el historial de pedidos realizados con exito';
    echo json_encode($response);
    $db->close();
    return;    
}
?>