<div id="addRaza" class="modal fade" role="dialog"> 
					<div class="modal-dialog modal-dialog-scrollable">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-tittle">Registro Raza</h4>
								<button type="button" id="btnEquis" name="btnEquis" class="close" data-dismiss="modal">X</button>
							</div>
						
							<div class="modal-body">
								<!-- inicio div para guardar  -->
								<div id='listarGuardar' >
									<div class="row mt-20 mb-2">
										<div class="col-lg-20" >
											<input type="text" id="nombreRazaAdd" name="nombreRazaAdd" class="form-control" placeholder="nuevo nombre raza" >
										</div>
									</div>
									<div class="row mt-20">
										<div class="col-lg-20 d-flex justify-content-center mb-2" >	<h4 class="modal-tittle"> </h4>
											<button type="button" id="btnNewRaza" name="btnNewRaza" class="btn btn-primary mr-2" <?php echo $var_class_button_formulario; ?> >Guardar</button>
											<button type="button" id="btnCerrarAddRaza"  name="btnCerrarAddRaza" <?php echo $var_class_button_popup;  ?> data-dismiss="modal" >Cerrar</button> 
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col" >
										<div id="cardRazas">

										</div>
									</div>
								</div> 
								<!-- cierre div para guardar  -->
								<!-- inicio div para actualizar  -->
								<!-- <div id='listarActualizar' >
									<div class="row mt-20">
										<div class="col-lg-20" >
											<input type="hidden" id="idRazaUpdt"  	name="idRazaUpdt" 	class="form-control"  >
											<input type="text"   id="nombreRazUpdt" name="nombreRazUpdt" class="form-control" >
										</div>
									</div>
									<div class="row mt-20">
										<div class="col-lg-20" >
											<button type="button" id="btnUpdtRaza" 	name="btnUpdtRaza" class="btn btn-primary btn-sm" <?//php echo $var_class_button_formulario; ?> >Actualizar</button>
											<button type="button" id="btnUpdtRazaEsc" name="btnUpdtRazaEsc" class="btn btn-danger btn-sm" <?//php echo $var_class_button_formulario; ?> >Cancelar</button>
										</div>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
				<!--INICI ACTUALIAR RAZA-->
				<div class="modal fade" id="listarActualizarCard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar raza</h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<input type="hidden" id="idRazaUpdt"  	name="idRazaUpdt" 	class="form-control"  >
								<input type="text"   id="nombreRazUpdt" name="nombreRazUpdt" class="form-control" placeholder="Nombre raza" >
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal" id="btnCerrar">Cerrar</button>
								<button type="button" class="btn btn-primary" id="btnUpdtRaza">Actualizar</button>
							</div>
						</div>
					</div>
				</div>
				<!--FIN ACTUALIAR RAZA-->