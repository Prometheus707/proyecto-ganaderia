	<div class="modal fade" id="registroVacunacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<!-- inicio cabecera del formulario  -->
				<div class="modal-header">
					<h5 class="modal-title" >REGISTRO DE VACUNACION</h5>
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
							<select name="SelectNombreVacuna" id="SelectNombreVacuna" class="form-control"></select>
						</div>
						<div class="col">
							<div id='divModalVacunas'>
								<h6 class="modal-title">&nbsp;&nbsp;</h6>
								<button type="button" id="btnModalVacunas" name="btnModalVacunas" <?php echo $var_class_button_formulario; ?> data-toggle="modal" data-target="#registroVacunas">
								<span class="fa fa-plus" aria-hidden='true'></span>
								</button>
							</div>
						</div>	
					</div>					
					<div class="row">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Laboratorio</h6>
							<input type="text" id="laboratorioVacuna" name="laboratorioVacuna" class="form-control"  required >
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Lote #</h6>
							<input type="text" id="numeroLoteVacuna" name="numeroLoteVacuna" class="form-control"  required >
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Registro ica</h6>
							<input type="text" id="registroIcaVacuna" name="registroIcaVacuna" class="form-control"  required >
						</div>
					</div>	
					<div class="row">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Dosificación</h6>
							<input type="text" id="dosificacionVacuna" name="dosificacionVacuna" class="form-control"  required >
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 class="form-label" >Via de administración</h6>
							<select name="viaDeAdminVacuna" id="viaDeAdminVacuna" class="form-control">
								<option value="0" selected>Seleccione...</option>
								<option value="1">IM (Intramuscular)</option>
								<option value="2">SC (Subcutaneo)</option>
								<option value="3">IV (Intravenoso)</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Tiempo de retiro</h6>
							<input type="text" id="idUsuLogueadoFK" name="idUsuLogueadoFK" value='<?php echo $_SESSION['id_Usu']; ?>' hidden>
							<input type="text" id="tiempoDeRetiroVacuna" name="tiempoDeRetiroVacuna" class="form-control"  required >
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 class="form-label" >Veterinario(a)</h6>
							<select name="veterinarioVacunacion" id="veterinarioVacunacion" class="form-control">
							</select>
						</div>
					</div>					
					<div class="row" style="margin-bottom: 2rem;">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Observaciones</h6>
							<textarea rows='1' id="observacionVacuna" name="observacionVacuna" class="form-control" >
							</textarea>
						</div>
					</div>
					<div class="row">
						<div class="col" >
							<div id="cardVacunacion">
								
							</div>
						</div>
					</div>
				</div>
				<!-- pie del formulario  -->
				<div class="modal-footer">
					<div class="modal-footer">
					<button type="button" class="btn btn-primary"  id='btnGuardarVac' name='btnGuardarVac'  >GUARDAR</button>
					<button type="button" class="btn btn-danger"   id='btnCerrarVac' name='btnCerrarVac' data-dismiss="modal">CERRAR</button>
					</div>
				</div>
			</div>                      
		</div>	
	</div>
	<!---------------ACTUALIZAR VACUNACION---------------------------------------->
	<div class="modal fade" id="updateVacunacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<!-- inicio cabecera del formulario  -->
				<div class="modal-header">
					<h5 class="modal-title" >ACTUALIZAR VACUNACION</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">X</span>
					</button>
				</div>
				<!-- inicio cuerpo del formulario  -->
				<div class="modal-body">					
					<div class="row">
						<div class="col">
							<h6 class="modal-title" >Fecha</h6>
							<input type="text" id="fechaVacunaUpdate" name="fechaVacunaUpdate" class="form-control" value='' readonly>
							<input type="text" id="idVacunacionUpdate" name="idVacunacionUpdate" class="form-control" value='' hidden>
						</div>
					</div>
					<div class="row mt-12">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Nombre Vacuna</h6>
							<select name="SelectNombreVacunaUpdate" id="SelectNombreVacunaUpdate" class="form-control"></select>
						</div>
					</div>					
					<div class="row">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Laboratorio</h6>
							<input type="text" id="laboratorioVacunaUpdate" name="laboratorioVacunaUpdate" class="form-control"  required >
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Lote #</h6>
							<input type="text" id="numeroLoteVacunaUpdate" name="numeroLoteVacunaUpdate" class="form-control"  required >
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Registro ica</h6>
							<input type="text" id="registroIcaVacunaUpdate" name="registroIcaVacunaUpdate" class="form-control"  required >
						</div>
					</div>	
					<div class="row">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Dosificación</h6>
							<input type="text" id="dosificacionVacunaUpdate" name="dosificacionVacunaUpdate" class="form-control"  required >
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 class="form-label" >Via de administración</h6>
							<select name="viaDeAdminVacunaUpdate" id="viaDeAdminVacunaUpdate" class="form-control">
								<option value="0" selected>Seleccione...</option>
								<option value="1">IM (Intramuscular)</option>
								<option value="2">SC (Subcutaneo)</option>
								<option value="3">IV (Intravenoso)</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Tiempo de retiro</h6>
							<input type="text" id="idUsuLogueadoFKUpdate" name="idUsuLogueadoFKUpdate" value='<?php echo $_SESSION['id_Usu']; ?>' hidden>
							<input type="text" id="tiempoDeRetiroVacunaUpdate" name="tiempoDeRetiroVacunaUpdate" class="form-control"  required >
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 class="form-label" >Veterinario(a)</h6>
							<select name="veterinarioVacunacionUpdate" id="veterinarioVacunacionUpdate" class="form-control">
							</select>
						</div>
					</div>					
					<div class="row" style="margin-bottom: 2rem;">
						<div class="col">
							<h6 for="ttl3" class="form-label" >Observaciones</h6>
							<textarea rows='1' id="observacionVacunaUpdate" name="observacionVacunaUpdate" class="form-control" >
							</textarea>
						</div>
					</div>
					<div class="row">
						<div class="col" >
							<div id="cardVacunacion">
								
							</div>
						</div>
					</div>
				</div>
				<!-- pie del formulario  -->
				<div class="modal-footer">
					<div class="modal-footer">
					<button type="button" class="btn btn-primary"  id='btnGuardarVacUpdate' name='btnGuardarVacUpdate'  >ACTUALIZAR</button>
					<button type="button" class="btn btn-danger"   id='btnCerrarVacUpdate' name='btnCerrarVacUpdate' data-dismiss="modal">CERRAR</button>
					</div>
				</div>
			</div>                      
		</div>	
	</div>