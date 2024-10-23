<div class="modal fade" id="registroVacunas" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<!-- inicio cabecera del formulario  -->
				<div class="modal-header">
					<h5 class="modal-title" >REGISTRO DE VACUNAS</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">X</span>
					</button>
				</div>
				<!-- inicio cuerpo del formulario  -->
				<div class="modal-body">					
					<div class="row">
						<div class="col">
							<h6 class="modal-title" >Fecha</h6>
							<input type="text" id="fechaVacuna" name="fechaVacuna" class="form-control" value='<?php echo $fecha; ?>' required >
						</div>
					</div>
					<div class="row mt-12">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Nombre Vacuna</h6>
							<input type="text" id="nombreVacuna" name="nombreVacuna" class="form-control">
						</div>
					</div>					
					<div class="row" style="margin-bottom: 2rem;">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Observaciones</h6>
							<textarea rows='1' id="observacionVacunas" name="observacionVacunas" class="form-control" >
							</textarea>
						</div>
					</div>
					<div class="row">
					<div class="col" >
						<div id="cardVacunas">
							 
						</div>
					</div>
				</div> 
				</div>
				<!-- pie del formulario  -->
				<div class="modal-footer">
					<div class="modal-footer">
					<button type="button" class="btn btn-primary"  id='btnGuardarVacuna' name='btnGuardarVac'  >GUARDAR</button>
					<button type="button" class="btn btn-danger"   id='btnCerrarVacuna' name='btnCerrarVac' data-dismiss="modal">CERRAR</button>
					</div>
				</div>
			</div>                      
		</div>	
	</div>
	<!----------ACTUALIZAR VACUNA-------------->
	<div class="modal fade" id="updateVacunas" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<!-- inicio cabecera del formulario  -->
				<div class="modal-header">
					<h5 class="modal-title" >ACTUALIZAR VACUNAS</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">X</span>
					</button>
				</div>
				<!-- inicio cuerpo del formulario  -->
				<div class="modal-body">					
					<div class="row">
						<div class="col">
							<h6 class="modal-title" >Fecha</h6>
							<input type="text" id="fechaVacunaUpd" name="fechaVacunaUpd" class="form-control" value='' readonly>
							<input type="text" id="idVacunaUpdate" name="idVacunaUpdate" class="form-control" value='' hidden>
						</div>
					</div>
					<div class="row mt-12">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Nombre Vacuna</h6>
							<input type="text" id="nombreVacunaUpdate" name="nombreVacunaUpdate" class="form-control">
						</div>
					</div>					
					<div class="row" style="margin-bottom: 2rem;">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Observaciones</h6>
							<textarea rows='1' id="observacionVacunasUpdate" name="observacionVacunasUpdate" class="form-control" >
							</textarea>
						</div>
					</div>
				</div>
				<!-- pie del formulario  -->
				<div class="modal-footer">
					<div class="modal-footer">
					<button type="button" class="btn btn-primary"  id='btnGuardarVacunaUpdate' name='btnGuardarVacunaUpdate'  >ACTUALIZAR</button>
					<button type="button" class="btn btn-danger"   id='btnCerrarVacunaUpdate' name='btnCerrarVacunaUpdate' data-dismiss="modal">CERRAR</button>
					</div>
				</div>
			</div>                      
		</div>	
	</div>