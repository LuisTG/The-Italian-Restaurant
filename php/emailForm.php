<?php 
session_start();
require_once 'connectivity/connection.php';
$username = $_GET['username'];
$query = "SELECT correo, GROUP_CONCAT(nombres,\" \",apellidos) as nombre FROM usuarios WHERE nombre_usuario = '$username' LIMIT 1";
$email = '';
$nombre = '';
if(($result = $db->query($query)) && $result->num_rows > 0){
  $result = $result->fetch_assoc();
  $email = $result['correo'];
  $nombre = $result['nombre'];
}else{
  echo $query;
  return;
}
?>
<?php if(($_SERVER["REQUEST_METHOD"] == 'GET')): ?>
<div class="modal fade" id="email-modal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <span class="glyphicon glyphicon-envelope"></span> Enviar correo electrónico</h4>
          </div>
          <div class="modal-body">
            <form method="post" action="" id="email-modal-form">
                <div class="form-group">
                  <label for="comment-id" class="control-label"><span class="glyphicon glyphicon-user"></span> Para: </label>
                  <input type="text" maxlength="13" name="email_to" class="form-control" required="true" id="email-to" placeholder="Ingrese el asunto del mensaje" value="<?= $email ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="comment-id" class="control-label"><span class="glyphicon glyphicon-flag"></span> Asunto: </label>
                  <input type="text" maxlength="13" name="email_subject" class="form-control" required="true" id="email-subject" placeholder="Ingrese el asunto del mensaje" value="<?= $_GET['subject'] ?>">
                </div>
                <div class="form-group">
                  <label for="comment" class="control-label"><span class="glyphicon glyphicon-pencil"></span> Mensaje: </label>
                  <textarea type="textarea" autocomplete="off" data-toggle="tooltip" data-placement="top" title="Ejemplo: Muchas gracias por tu comentario!" maxlength="140" required="true" class="form-control" rows="5" id="email-body" name="email_body"></textarea>
                </div>
                <div class="modal-footer">                                    
                        <button type="submit" class="btn btn-primary">Enviar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>           
                </div>
              </form>
          </div>
        </div>
      </div>
</div>
<?php endif ?>