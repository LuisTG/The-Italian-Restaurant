<?php if(($_SERVER["REQUEST_METHOD"] == 'GET') && isset($_GET['id'])): ?>
<div class="modal fade" id="comment-modal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <span class="glyphicon glyphicon-envelope"></span> Enviar comentario</h4>
          </div>
          <div class="modal-body">
            <form method="post" action="" id="comment-modal-form">
                <div class="form-group">
                  <label for="comment-id" class="control-label"><span class="glyphicon glyphicon-tag"></span> ID del pedido: </label>
                  <input type="text" maxlength="13" name="id_pedido" class="form-control" required="true" id="comment-id" placeholder="Ingrese el ID del comentario" value="<?= $_GET['id'] ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="comment-type" class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Tipo de comentario: </label>
                  <select class="form-control" name="selected" required="true">
                    <option value="" selected disabled>Seleccione una opcion</option>
                    <option value="comentario">Comentario</option>
                    <option value="queja">Queja</option>
                    <option value="sugerencia">Sugerencia</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="comment" class="control-label"><span class="glyphicon glyphicon-pencil"></span> Comentario: </label>
                  <textarea type="textarea" autocomplete="off" data-toggle="tooltip" data-placement="top" title="Ejemplo: Excelente servicio!" maxlength="140" required="true" class="form-control" rows="5" id="comment-box" name="comment"></textarea>
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