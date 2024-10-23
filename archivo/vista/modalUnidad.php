<div class="modal fade" id="ppNuevoRegistro">
	<div class="modal-dialog modal-lg modal-dialog">
		<div class="modal-content">
			<!-- cabecera del diálogo -->
			<div class="modal-header">
				<h6 class="modal-title">UNIDAD PRODUCTIVA</h6>
				<button type="button" id="btnEquis" name="btnEquis" class="close" data-dismiss="modal">X</button>
			</div>
			
			<!-- cuerpo del diálogo -->
			<div class="modal-body">
				<div class="row mt-1">
					<div class="col-lg-12" >
					<input type="text" class="form-control"  id="unidadXcentro" name="unidadXcentro" value='<?php echo $_SESSION['centroUusario_fk']; ?>'>
						<input type="text" class="form-control"  id="unidadXRegional" name="unidadXRegional" value='<?php echo $_SESSION['regionalUsuario_fk']; ?>'>
						<h6 class="modal-title">Fecha</h6>
						<input type="date" class="form-control" placeholder="fecha hoy" id="fechaRegistro" name="fechaRegistro" value='<?php echo $fecha; ?>' readonly>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-lg-12" >
						<h6 class="modal-title">Nombre</h6>
						<input type="text" class="form-control" placeholder="nombre unidad" id="nombreUnidadPro" name="nombreUnidadPro" title="Nombre de la unidad";>
					</div>
				</div>
				<div class="row mt-1">
					<div class='row' class="col-lg-12 text-center">
						<div id='divRespTUnidad' class="col-lg-12 text-center" class='col-20' ></div>
					</div>										
				</div>
			</div>
			
			<!-- pie del diálogo -->
			<div class="modal-footer">
				<button type="button" id="btnGuardar" name="btnGuardar" <?php echo $var_class_button_formulario; ?> >Guardar</button>
				<button type="button" id="btnCerrarAdd" name="btnCerrarAdd" <?php echo $var_class_button_popup;  ?> data-dismiss="modal"  >Cerrar</button> 
			</div>
		</div>
	</div>
</div>
<!----ACTUALIZAR UNIDAD---->
<div class="modal fade" id="updateEspecie">
					<div class="modal-dialog modal-lg modal-dialog">
						<div class="modal-content">
							<!-- cabecera del diálogo -->
							<div class="modal-header">
								<h6 class="modal-title">ACTUALIZAR UNIDAD</h6>
								<button type="button" id="btnEquis" name="btnEquis" class="close" data-dismiss="modal">X</button>
							</div>
							
							<!-- cuerpo del diálogo -->
							<div class="modal-body">
								<div class="row mt-1" >
									<div class="col-lg-12" >
										<h6 class="modal-title">Nombre</h6>
										<input type="hidden" class="form-control" id="idUnidadProUpdate" name="idUnidadProUpdate" title="Id Unidad";>
										<input type="text" class="form-control" placeholder="nombre unidad" id="nombreUnidadProUpdate" name="nombreUnidadProUpdate" title="Nombre de la unidad";>
									</div>
								</div>
								<div class="row mt-1">
									<div class='row' class="col-lg-12 text-center">
										<div id='divRespTUnidadUpdate' class="col-lg-12 text-center" class='col-20' ></div>
									</div>										
								</div>
								<br>
							</div>
							
							<!-- pie del diálogo -->
							<div class="modal-footer">
								<button type="button" id="btnUpdate" name="btnUpdate" <?php echo $var_class_button_formulario; ?> >Actualizar</button>
								<button type="button" id="btnCerrarUpdate" name="btnCerrarUpdate" <?php echo $var_class_button_popup;  ?> data-dismiss="modal" >Cerrar</button> 
							</div>
						</div>
					</div>
				</div>