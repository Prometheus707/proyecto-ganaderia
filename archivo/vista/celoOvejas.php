	<div class="modal fade" id="mdCeloOvejas" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" >REGISTRO DE SERVICIOS OVEJAS</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" id="xCelo">X</span>
					</button>
				</div>
				
				<div class="modal-body">					
					<div class="row" >
						<div class="col-lg-4" >
							<input type="hidden" id="codigoOveja" name="codigoOveja"  class="form-control"    readonly />
							<input type="" id="idOvejaForm" name="idOvejaForm" class="form-control"    readonly />
						</div>
					</div>				
					<div class="row">
						<div class="col-lg-6">
							<h6 class="modal-title">Fecha de celo</h6>
							<input id="fechaCeloVaca"  name="fechaCeloOveja" type="text" class="form-control"   value='<?php echo $fecha; ?>' readonly />
						</div>
						<div class="col-lg-6">
							<h6 class="modal-title">Servido</h6> 
							<select  id="selectServidoOveja" name="selectServidoOveja" class="form-control">
								<option value="0">Seleccione</option>
								<option value="1" >Si</option>
								<option value="2" >No</option>
							</select>
						</div>
					</div>
					<div class="row" >                
						<div class="col" >
							<div id="DivMetodoOvejas"  >
								<h6 class="modal-title">Monta/inseminación</h6> 
								<select id="selectMetodosOvejas" name="selectMetodosOvejas" class="form-select" >
									<option value="0">Seleccione</option>
									<option value="1" >Monta</option>
									<option value="2" >Inseminacion</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
				        <div class="col" id="codigoCordero">
						    <center><h6 class="modal-title" >Datos del reproductor</h6>  </center>							
						</div>
					</div>
					<div class="row">
						<div id="infoMachoOvj" style="margin-bottom: 1rem;">
							<div class="col-lg-6" id="codigoCordero">
								<h6 class="modal-title" >Codigo</h6>  
								<select class="form-select" aria-label="Default select example" id="codigoRegistroCordero" title="Codigo registro cordero" style="cursor: pointer;">
								</select>
								<input type="text" class="form-control" id="idCorderoServ" aria-describedby="emailHelp" name="idCorderoServ" hidden readonly/>
							</div>
							<div class="col" id="nombreCordero">
								<h6 class="modal-title">Nombre</h6>  
								<input type="text" class="form-control" id="nomCordero" aria-describedby="emailHelp" readonly>
							</div>
							<div class="col" id="razaCordero">
								<h6 class="modal-title">Raza</h6>  
								<input type="text" class="form-control" id="razCordero" aria-describedby="emailHelp"  readonly>
								<input type="text" class="form-control" id="idRazaServCordero" aria-describedby="emailHelp" name="idRazaServCordero" hidden readonly/>
							</div>
						</div>
					</div>
					<div class="row" id="divBtnPajillaCordero" style="margin-bottom: 2rem;">
						<div class="col-sm-4">
							<button type="button" name="btnPajilaCordero" id="btnPajilaCordero" class="btn btn-block btn-warning btn-sm btn-sm; cursor:pointer;" data-toggle="modal" data-target="#addPajilla" >
							<i class="fa fa-registered" aria-hidden="true"></i>pajilla</i></button>
						</div>
					</div>
					<div class="row" >
						<div class="col-lg-6" id="responsableR" hidden>
							<h6 class="modal-title">Responsable</h6> 
							<input type="text" class="form-control" id="responsableRep" aria-describedby="emailHelp"   readonly>
							<input type="text" class="form-control" id="idresponsableRep" aria-describedby="emailHelp"   readonly>
						</div>
					</div>
					<div class="row" >
						<div class="col">
							<div class="form-group"> 
								<h6 class="modal-title" id="observacionesCeloOvejas">Observaciones</h6> 
								<textarea class="form-control" rows="5" id="observacionesRepOveja"></textarea>
							</div> 
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<div class="modal-footer">
					<button type="button" class="btn btn-primary"  id="btnguardarCeloOveja" >GUARDAR</button>
					<button type="button" class="btn btn-danger"   id="btnCerrarCeloOveja" data-dismiss="modal">CERRAR</button>
					</div>
				</div>
			</div>                      
		</div>	
	</div>
	<div id="addPajilla" class="modal fade" role="dialog"> 
			<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<!-- inicio cabecera del diálogo -->
				<div class="modal-header">
					<h6 class="modal-title">REGISTRO DE PAJILLA</h6>
					<button type="button" class="close" data-dismiss="modal">X</button>
				</div>
				<!-- el cuerpo del modal -->
				<div class="modal-body">
					<div class="row">
						<div class="col" >
							<h6 class="modal-title" >Numero de registro</h6>
							<input  type="text" class="form-control" id="numeroRegistroR" >
						</div>
					</div>
					<div class="row">
						<div class="col" >
							<h6 class="modal-title" >Nombre toro</h6>
							<input  type="text"  class="form-control" id="nombreToroR">
						</div>
					</div>
					<div class="row">
						<div class="col" >
							<h6 class="modal-title" >Raza toro</h6>
						<select class="form-select" aria-label="Default select example" id="razaPajilla" >

						</select>
							<input  type="hidden"  class="form-control" id="idRazaP" aria-describedby="emailHelp" >
						</div>
					</div>    
					<!-- donde se ubican los botones y demas -->
					<div class="modal-footer">
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" id="btnGuardarPajilla" >GUARDAR</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarPajilla">CERRAR</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--
	<div id="addPajilla" class="modal fade" role="dialog"> 
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-tittle">Registro Pajilla</h4>
					<button type="button" id="btnEquis" name="btnEquis" class="close" data-dismiss="modal">X</button>
				</div>
			
				<div class="modal-body"> -->
					<!-- inicio div para guardar  -->
					<!--
					<div id='listarGuardar' >
						<div class="row mt-20">
							<div class="col-lg-20" >
								<input type="text" id="nombreRazaAdd" name="nombreRazaAdd" class="form-control" placeholder="nuevo nombre raza" >
							</div>
						</div>
						<div class="row mt-20">
							<div class="col-lg-20" >	<h4 class="modal-tittle"> </h4>
								<button type="button" id="btnNewRaza" name="btnNewRaza" class="btn btn-primary btn-sm" <?php echo $var_class_button_formulario; ?> >Guardar</button>
							</div>
						</div>
					</div>
					-->
					<!-- cierre div para guardar  	 -->
					<!-- inicio div para actualizar  -->
					<!--
					<div id='listarActualizar' >
						<div class="row mt-20">
							<div class="col-lg-20" >
								<input type="hidden" id="idRazaUpdt"  	name="idRazaUpdt" 	class="form-control"  >
								<input type="text"   id="nombreRazUpdt" name="nombreRazUpdt" class="form-control" >
							</div>
						</div>
						<div class="row mt-20">
							<div class="col-lg-20" >
								<button type="button" id="btnUpdtRaza" 	name="btnUpdtRaza" class="btn btn-primary btn-sm" <?php echo $var_class_button_formulario; ?> >Actualizar</button>
								<button type="button" id="btnUpdtRazaEsc" name="btnUpdtRazaEsc" class="btn btn-danger btn-sm" <?php echo $var_class_button_formulario; ?> >Cancelar</button>
							</div>
						</div>
					</div>
					-->
					<!-- cierre div para actualizar  -->
					<!-- inicio div para eliminar    -->
					<!--
					<div id='listarKiller' >
						<div class="row mt-20">
							<div class="col-lg-20" >
								<input type="hidden" id="idRazaDell" name="idRazaDell" class="form-control" >
								<input type="text" id="nombreRazDell" name="nombreRazDell" class="form-control" readonly />
							</div>
						</div>
						<div class="row mt-20">
							<div class="col-lg-20" >
								<button type="button" id="btnDellRaza" name="btnDellRaza" class="btn btn-primary btn-sm" <?php echo $var_class_button_formulario; ?> >Eliminar</button>
								<button type="button" id="btnDellRazaEsc" name="btnDellRazaEsc" class="btn btn-danger btn-sm" <?php echo $var_class_button_formulario; ?> >Cancelar</button>
							</div>
						</div>
					</div>
					-->
					<!-- cierre div para eliminar  -->							
					
					<!--<div class="row mt-1">
						<div class="table-responsive">
							<table id="listaPajillas" data-order='[[ 3, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" >
								<thead>
									<tr>
										<th scope='col'>ID</th>
										<th scope='col'>Nombre</th>
										<th scope='col'>Op</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>								
				</div>
				<div class="modal-footer">
					<button type="button" id="btnCerrarAddRaza"  name="btnCerrarAddRaza" <?php echo $var_class_button_popup;  ?> data-dismiss="modal" >Cerrar</button> 
				</div>
				
			</div>
		</div>
	</div>
	-->