<div class="modal fade" id="ppNuevoRegistro">
					<div class="modal-dialog modal-dialog-scrollable">
						<div class="modal-content">
							<!-- cabecera del diálogo -->
							<div class="modal-header">
								<h6 class="modal-title">REGISTRO DE ANIMAL</h6>
								<button type="button" id="btnEquis" name="btnEquis" class="close" data-dismiss="modal">X</button>
							</div>
							<!-- cuerpo del diálogo -->
							<div class="modal-body">
								<div class="row mt-12">
									<div class="row mt-12">
										<div class="col-sm-9" >
											<h6 class="modal-title">Nombre</h6>
											<input type="text" id="nombreAnimalRegistro" name="nombreAnimalRegistro" class="form-control" placeholder="Nombre" title="Nombre" required>
										</div>
										<div class="col-sm-3" >
											<h6 class="modal-title">Chapeta</h6>
											<input type="text" id="NumchapetaAnimal" name="NumchapetaAnimal" class="form-control"  value='' readonly>
											<input type="text" id="idchapetaAnimal" name="idchapetaAnimal" class="form-control"  value='' hidden>
										</div>
									</div>								
									<div class="col">
										<h6 class="modal-title">Unidad</h6>
										<select id="idUnidad_FKRegistro" name="idUnidad_FKRegistro" class="form-control " title="Seleccione Unidad" required>										
										</select>
									</div>
									<div class="col">
										<div id='#' >
											<h6 class="modal-title">&nbsp;&nbsp;</h6>
											<button type="button" id="modalUnidad" name="modalUnidad" <?php echo $var_class_button_formulario; ?> data-toggle="modal" data-target="#NuevoRegistroUnidades">
											<span class="fa fa-plus" aria-hidden='true'></span>
											</button>
										</div>
									</div>	
								</div>								
								<div class="row mt-12">
									<div class="col">
										<h6 class="modal-title">Especie</h6>
										<select id="idEspecie_FKRegistro" name="idEspecie_FKRegistro" class="form-control" title="Seleccione Especie" required >										
										</select>
									</div>
									<div class="col">
										<div id='divModalEspecies' >
											<h6 class="modal-title">&nbsp;&nbsp;</h6>
											<button type="button" id="btnModalEspecie" name="btnModalEspecie" <?php echo $var_class_button_formulario; ?> data-toggle="modal" data-target="#addEspecie">
											<span class="fa fa-plus" aria-hidden='true'></span>
											</button>
										</div>
									</div>	
								</div>
								<div class="row mt-12">
									<div class="col">
										<h6 class="modal-title">Raza</h6>
										<select id="idRaza_FKRegistro" name="idRaza_FKRegistro" class="form-control" title="Seleccione Raza" required >										
										</select>
									</div>
									<div class="col">
										<div id='botonRaza' >
											<h6 class="modal-title">&nbsp;&nbsp;</h6>
											<button type="button" id="btnModalRaza" name="btnModalRaza" <?php echo $var_class_button_formulario; ?> data-toggle="modal" data-target="#addRaza">
											<span class="fa fa-plus" aria-hidden='true'></span>
											</button>
										</div>
									</div>									
								</div>
								<div class="row mt-12">
									<div class="col" hidden>
										<h6 class="modal-title">Fecha</h6>
										<input type="hidden" id="idUsuRegistro" name="idUsuRegistro" class="form-control"  value='<?php echo $_SESSION['id_Usu']; ?>' readonly>
										<input type="hidden" id="nombreUsuRegistro" name="nombreUsuRegistro" class="form-control"  value='<?php echo $_SESSION['nombre_Usu']." ".$_SESSION['apellido_Usu']; ?>' readonly>
										<input type="date" id="fechaRegistro" name="fechaRegistro" class="form-control" placeholder="dd/mm/yy" value='<?php echo $fecha; ?>' readonly>
									</div>
									<div class="col-6" >
										<h6 class="modal-title">Fecha</h6>
										<input type="text" id="fechaNacimientoRegistro" name="fechaNacimientoRegistro" class="form-control" placeholder="Nacimiento" title="Fecha nacimiento" required>
									</div>	
									<div class="col-6" >
											<h6 class="modal-title">Edad</h6>
											<input type="text" id="edadAnimal" name="edadAnimal" class="form-control" placeholder="edad" title="Edad animal" required readonly>
									</div>								
								</div>
								
								<div class="row mt-3" hidden>
									<div class="col-12 text-center">
										<h6 class="modal-title">Edad</h6>
									</div>
								</div>
								<div class="row mt-2" >
									<div class="col text-center">
										<input type="text" id="mesesAnimal" name="edadAnimal" class="form-control" placeholder="Meses" title="Meses del animal" required readonly>

									</div>
									<div class="col text-center">
										<input type="text" id="diasAnimal" name="edadAnimal" class="form-control" placeholder="Días" title="Días del animal" required readonly>
										
									</div>
								</div>

								<!-- <div class="row mt-12">
									<div class="col-sm-6" >
										<h6 class="modal-title">Codigo de sistema</h6>
										<input type="text" id="codAnimalRegistro" name="codAnimalRegistro" class="solo-numero form-control"  title="Codigo del Animal" readonly>
									</div>
									<div class="col-sm-6" >
										<h6 class="modal-title">Número de Chapeta</h6>
										<input type="text" id="codigoSenaRegistro" name="codigoSenaRegistro" class="form-control" placeholder="Codigo Unico Sena" title="Codigo Unico Sena" required>
									</div>									
								</div> -->
								<div class="row mt-12">
									<div class="col-sm-6" >
										<h6 class="modal-title">Color</h6>
										<input type="text" id="colorAnimalRegistro" name="colorAnimalRegistro" class="form-control" placeholder="Color" title="Color" required>
									</div>	
									<div class="col-sm-2" >
										<h6 class="modal-title">Peso</h6>
										<input type="text" id="pesoAnimalRegistro" name="pesoAnimalRegistro" class="solo-numero form-control" placeholder="Peso" title="Peso" required>
									</div>
									<div class="col-sm-4" >
										<h6 class="modal-title">U/Medida</h6>
										<select id="unidadMedidaRegistro" name="unidadMedidaRegistro" class="form-control" placeholder="Unidad de medida" title="Unidad de Medida" required>										
											<option value='0' >Seleccione...</option>
											<option value='1' >gr</option>
											<option value='2' >Kg</option>
										</select>
									</div>
								</div>
								<div class="row mt-12">
									<div class="col-sm-12" >
										<h6 class="modal-title">Observaciones</h6>
										<textarea  id="observacionesRegistro" name="observacionesRegistro"  cols='10' rows='1' class="form-control" placeholder="Observaciones" title="Observaciones" required >
										</textarea>
									</div>
								</div>
								<div class="row mt-12">
									<div class="col">
										<h6 class="modal-title">Sexo</h6>
										<select id="idSexoRegistro" name="idSexoRegistro" class="form-control" style="width: 220px;" title="Seleccione Sexo" required >										
											<option value='0' >Seleccione...</option>
											<option value='1' >Macho</option>
											<option value='2' >Hembra</option>
										</select>
									</div>
								</div>
								<div class="row mt-12">
									<div class="col">
										<h6 class="modal-title">Metodo</h6>
										<select id="idMetodoRegAnimal" name="idMetodoRegAnimal" class="form-control" style="width: 220px;" title="Seleccione Sexo" required >										
											<option value='0' >Seleccione...</option>
											<option value='1' >Monta</option>
											<option value='2' >I.A</option>
										</select>
									</div>
								</div>
								<div class="row mt-12">
									<div class="col">
										<h6 class="modal-title">Madre</h6>
										<select id="idMadreAnimal" name="idMadreAnimal" class="form-control" style="width: 220px;" title="Seleccione Sexo" required >										
											
										</select>
									</div>
								</div>
								<div class="row mt-12">
									<div class="col">
										<h6 class="modal-title">Padre</h6>
										<select id="idPadreAnimal" name="idPadreAnimal" class="form-control" style="width: 220px;" title="Seleccione Sexo" required >										
											
										</select>
									</div>
								</div>
							</div>
							<!-- pie del diálogo -->
							<div class="modal-footer">
								<button type="button" id="btnGuardar" name="btnGuardar" <?php echo $var_class_button_formulario; ?> >Guardar</button>
								<button type="button" id="btnCerrar"  name="btnCerrar" <?php echo $var_class_button_popup;  ?> data-dismiss="modal"  >Cerrar</button> 
							</div>
						</div>
					</div>
				</div>