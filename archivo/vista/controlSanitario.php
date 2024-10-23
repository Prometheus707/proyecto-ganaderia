<div class="modal fade" id="registroControlS" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<!-- inicio cabecera del formulario  -->
				<div class="modal-header">
					<h5 class="modal-title" >CONTROL SANITARIO</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">X</span>
					</button>
				</div>
				<!-- inicio cuerpo del formulario  -->
				<div class="modal-body">					
					<div class="row">
						<div class="col">
							<h6 class="modal-title" >Fecha</h6>
							<input type="text" id="fechaControlS" name="fechaControlS" class="form-control" value='<?php echo $fecha; ?>' required >
						</div>
					</div>
					<div class="row mt-12">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Evento sanitario</h6>
							<input type="text" id="eventoSanitario" name="eventoSanitario" class="form-control">
						</div>
					</div>					
					<div class="row mt-12">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Producto utilizado</h6>
							<input type="text" id="productoUtilizado" name="productoUtilizado" class="form-control">
						</div>
					</div>					
					<div class="row">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Dosis</h6>
							<input type="text" id="dosisSanitario" name="dosisSanitario" class="form-control"  required >
						</div>
					</div>
					<div class="row" style="margin-bottom: 2rem;">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Observaciones</h6>
							<textarea rows='1' id="observacionSanitario" name="observacionSanitario" class="form-control" >
							</textarea>
						</div>
					</div>
					<div id="cardControlSanitario">

					</div>
				</div>
				<!-- pie del formulario  -->
				<div class="modal-footer">
					<div class="modal-footer">
					<button type="button" class="btn btn-primary"  id='btnGuardarControlSanitario' name='btnGuardarControlSanitario'  >GUARDAR</button>
					<button type="button" class="btn btn-danger"   id='btnCerrarControlSanitario' name='btnCerrarControlSanitario' data-dismiss="modal">CERRAR</button>
					</div>
				</div>
			</div>                      
		</div>	
	</div>
	<!---------------CONTROL SANITARIO------------------------------>
	<div class="modal fade" id="registroControlS" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<!-- inicio cabecera del formulario  -->
				<div class="modal-header">
					<h5 class="modal-title" >ACTUALIZAR CONTROL SANITARIO</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">X</span>
					</button>
				</div>
				<!-- inicio cuerpo del formulario  -->
				<div class="modal-body">					
					<div class="row">
						<div class="col">
							<h6 class="modal-title" >Fecha</h6>
							<input type="text" id="fechaControlSUpdate" name="fechaControlSUpdate" class="form-control" value='<?php echo $fecha; ?>' required >
						</div>
					</div>
					<div class="row mt-12">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Evento sanitario</h6>
							<input type="text" id="eventoSanitarioUpdate" name="eventoSanitarioUpdate" class="form-control">
						</div>
					</div>					
					<div class="row mt-12">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Producto utilizado</h6>
							<input type="text" id="productoUtilizadoUpdate" name="productoUtilizadoUpdate" class="form-control">
						</div>
					</div>					
					<div class="row">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Dosis</h6>
							<input type="text" id="dosisSanitarioUpdate" name="dosisSanitarioUpdate" class="form-control"  required >
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Observaciones</h6>
							<textarea rows='1' id="observacionSanitarioUpdate" name="observacionSanitarioUpdate" class="form-control" >
							</textarea>
						</div>
					</div>
				</div>
				<!-- pie del formulario  -->
				<div class="modal-footer">
					<div class="modal-footer">
					<button type="button" class="btn btn-primary"  id='btnUpdateControlSanitario' name='btnUpdateControlSanitario'  >GUARDAR</button>
					<button type="button" class="btn btn-danger"   id='btnCerrarControlSanitarioUpdate' name='btnCerrarControlSanitarioUpdate' data-dismiss="modal">CERRAR</button>
					</div>
				</div>
			</div>                      
		</div>	
	</div>