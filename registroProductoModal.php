	<div class="modal fade" id="registroProducto">
  		<div class="modal-dialog" role="dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
          			<h4 class="modal-title">
          				<span class="glyphicon glyphicon-log-in"></span>
          				Registro de Producto
          			</h4>
      			</div>
      			<div class="modal-body">
      				<form method="post" action="" id="addproducto-form" enctype="multipart/form-data">	      					
              			<div class="form-group">
                				<label for="productname" class="control-label"><span class="glyphicon glyphicon-cutlery"></span> Nombre de producto: </label>
                				<input type="textfield" maxlength="25" name="productname" data-toggle="tooltip" data-placement="top" title="Ejemplo: Spaghetti alla carbonara" class="form-control" required="true" id="productname" placeholder="Ingrese el nombre del producto">
              			</div>
              			<div class="form-group">
                				<label for="descripcion" class="control-label"> <span class="glyphicon glyphicon-tag"></span> Descripcion del producto: </label>
                				<input type="textfield" maxlength="100" name="descripcion" data-toggle="tooltip" data-placement="top" title="Ejemplo: Spaguetti cubierto con especias" class="form-control" required="true" id="descripcion" placeholder="Ingrese una descripcion del producto">
              			</div>
              			<div class="form-group">
                				<label for="precio" class="control-label"> <span class="glyphicon glyphicon-usd"></span> Precio del producto: </label>
                				<input type="price" maxlength="7" name="precio" data-toggle="tooltip" data-placement="top" title="Ejemplo: 99.90" class="form-control" required="true" id="nombres" placeholder="Ingrese el precio del producto">
              			</div>
              			<div class="form-group">
                				<label for="tipoProducto" class="control-label"> <span class="glyphicon glyphicon-list"></span> Tipo de producto: </label>
                				<select id="tipoProducto" type="tipoProducto" name="tipoProducto" class="form-control" required="true" id="tipoProducto">
                          <option value="" selected disabled>Seleccione una opcion</option>
                					<option>Platillo</option>
                					<option>Bebida</option>
                					<option>Postre</option>
                				</select>
              			</div>
                    <div class="form-group">
                        <label for="file" class="control-label">Imagen prodcuto:</label>
                        <input class="file form-control" maxlength="100" type="file" name="imgProducto" accept=".jpg,.png" required="true">
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