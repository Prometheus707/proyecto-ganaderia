	<!-----------------------------------------REGISTRO POSIBLES CELOS------------------------------------------->
	<div class="modal fade" id="mdreproduccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel" data-backdrop="static" data-backdrop="false" data-keyboard="false"aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" >REGISTRO DE SERVICIOS<span id="nombreVacaCelo"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" id="xCelo">X</span>
					</button>
				</div>
				<div class="modal-body">					
					<div class="row" >
						<div class="col-lg-4" >
							<input type="hidden" id="codigoVaca" name="codigoVaca"  class="form-control"    readonly />
							<input type="hidden" id="idVacaForm" name="idVacaForm" class="form-control"    readonly />
						</div>
					</div>				
					<div class="row">
						<div class="col-lg-12">
							<input id="fechaRegistroCeloVaca"  name="fechaCeloVaca" type="hidden" class="form-control"   value='<?php echo $fecha; ?>' readonly />
							<h6 class="modal-title">Fecha de celo</h6>
							<input id="fechaCeloVaca"  name="fechaCeloVaca" type="text" class="form-control"   value='<?php echo $fecha; ?>' readonly />
							<input type="hidden" class="form-control" id="idUsuRegistroCel" name="idUsuRegistroCel" value='<?php echo $_SESSION['id_Usu']; ?>'  title='idUsu' >
							<input type="hidden" class="form-control" id="nombreUsuRegistroCel" name="nombreUsuRegistro" value='<?php echo $_SESSION['usuario_Logeado']; ?>' >
						</div>
					</div>
					<div class="row">
						<div class="col">
							<h6 class="modal-title">Ultima vacunacion</h6>
							<input id="fechaUltimaVacuna"  name="fechaUltimaVacuna" type="text" class="form-control"   value='' readonly />
						</div>
						<div class="col">
							<div id='divModalVisualizarVacunas' >
								<h6 class="modal-title">&nbsp;&nbsp;</h6>
								<button type="button" id="btnVisualizarVacunas" name="btnVisualizarVacunas" <?php echo $var_class_button_formulario; ?> data-toggle="modal" data-target="#mdVisualizarVacunas">
								<i class="fa-solid fa-syringe"></i></button>
							</div>
						</div>	
					</div>
					<div class="row">
						<div class="col-lg-12">
							<h6 class="modal-title">Servido</h6> 
							<select  id="selectServido" name="selectServido" class="form-control">
								<option value="0">Seleccione</option>
								<option value="1" >Si</option>
								<option value="2" >No</option>
							</select>
						</div> 
					</div>
					<div class="row" style="margin-bottom: 1rem;">                
						<div class="col" >
							<div id="DivMetodo"  >
								<h6 class="modal-title">Monta/inseminación</h6> 
								<select id="selectMetodos" name="selectMetodos" class="form-select" >
									<option value="0">Seleccione</option>
									<option value="1" >Monta</option>
									<option value="2" >I.A</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row" id="divTlRep">
				        <div class="col" >
						    <center><h6 id="datosRepTitulo" class="modal-title" ><strong> Datos del reproductor</strong></h6>  </center>							
						</div>
					</div>
					<div class="row">
						<div id="infoToro" style="margin-bottom: 1rem;">
							<div class="col" id="codigoToro">
								<h6 class="modal-title" >Codigo</h6>  
								<select class="form-select" aria-label="Default select example" id="codigoRegistroT" title="Codigo registro toro" style="cursor: pointer;">
								</select>
								<input type="text" class="form-control" id="idToroServ" aria-describedby="emailHelp" name="idAnimal" hidden readonly/>
							</div>
							<div class="col" id="nombreToro">
								<h6 class="modal-title">Nombre</h6>  
								<input type="text" class="form-control" id="nomToro" aria-describedby="emailHelp" readonly>
							</div>
							<div class="col" id="razaToro">
								<h6 class="modal-title">Raza</h6>  
								<input type="text" class="form-control" id="razToro" aria-describedby="emailHelp"  readonly>
								<input type="text" class="form-control" id="idRazaServ" aria-describedby="emailHelp" name="idRazaServ" hidden readonly/>
							</div>
						</div>
					</div>
					<div class="row" id="divBtnPajilla" style="margin-bottom: 2rem;">
					    <div class="d-flex justify-content-center">
							<div class="col-lg-8" >
								<button type="button" name="btnPajila" id="btnPajila" class="btn btn-block btn-warning btn-sm btn-sm; cursor:pointer;" data-toggle="modal" data-target="#addPajilla" >
								<i class="fa fa-registered" aria-hidden="true"></i>Pajilla</button>
							</div>
						</div>
					</div>
					<div class="row" >
						<div class="col-lg-6" id="responsableR" hidden>
							<h6 class="modal-title">Responsable</h6> 
							<input type="text" class="form-control" id="responsableRep" aria-describedby="emailHelp"   readonly>
							<input type="text" class="form-control" id="idresponsableRep" aria-describedby="emailHelp"   readonly>
						</div>
					</div>
					<div class="row" style="margin-bottom: 2rem;">
						<div class="col">
							<div class="form-group"> 
								<h6 class="modal-title" id="observaciones">Observaciones</h6> 
								<textarea class="form-control" rows="5" id="observacionesRep"></textarea>
							</div> 
						</div>
					</div>
					<div class="row" id="listarCeos" style="margin-bottom: 2rem;">
						<center><h5 id="Title_celos">LISTA DE CELOS</h5></center>
						<div class="d-flex justify-content-center flex-wrap">
							<button type="button" name="listarMonta" id="listarMonta" class="btn btn-warning btn-md my-2 mx-2" data-toggle="modal" data-target="">
								Monta
							</button>
							<button type="button" name="listarInseminacion" id="listarInseminacion" class="btn btn-warning btn-md my-2 mx-2" data-toggle="modal" data-target="">
								Inseminacion
							</button>
							<button type="button" name="listarCelosNo" id="listarCelosNo" class="btn btn-warning btn-md my-2 mx-2" data-toggle="modal" data-target="">
								No servido
							</button>
						</div>
					</div>
					<div id="listCel">

					</div>
					
					<div id="msjCel" >

					</div>
					
					<div id="msjbtnListar">

					</div>
					
				</div>
				<div class="modal-footer">
					<div class="modal-footer">
					<button type="button" class="btn btn-primary"  id="btnguardarCelo" >GUARDAR</button>
					<button type="button" class="btn btn-danger"   id="btncerrarReproduccion" data-dismiss="modal">CERRAR</button>
					</div>
				</div>
			</div>                      
		</div>	
	</div>
	<!-----------------------------------------ACTUALIZAR CELOS------------------------------------------->
	<div class="modal fade " id="mdreproduccionUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" >ACTUALIZAR SERVICIOS<span id="nombreVacaCelo"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" id="xCelo">X</span>
					</button>
				</div>
				<div class="modal-body">					
					<div class="row" >
						<div class="col-lg-4" >
							<input type="hidden" id="codigoVacaUpdate" name="codigoVacaUpdate"  class="form-control"    readonly />
							<input type="hidden" id="idVacaFormUpdate" name="idVacaFormUpdate" class="form-control"    readonly />
							<input type="hidden" id="idCeloFormUpdate" name="idCeloFormUpdate" class="form-control"    readonly />
							<input type="hidden" id="idCeloBdUpdate" name="idCeloFormUpdate" class="form-control"    readonly />
						</div>
					</div>				
					<div class="row">
						<div class="col-lg-6">
							<h6 class="modal-title">Fecha de celo</h6>
							<input id="fechaCeloVacaUpdate"  name="fechaCeloVacaUpdate" type="text" class="form-control"   value=''  />
							<input type="hidden" class="form-control" id="idUsuRegistroCelUpdate" name="idUsuRegistroCelUpdate" value='<?php echo $_SESSION['id_Usu']; ?>'  title='idUsu' >
							<input type="hidden" class="form-control" id="nombreUsuRegistroCelUpdate" name="nombreUsuRegistroUpdate" value='<?php echo $_SESSION['usuario_Logeado']; ?>' >
						</div>
						<div class="col-lg-6">
							<h6 class="modal-title">Servido</h6> 
							<select  id="selectServidoUpdate" name="selectServidoUpdate" class="form-control">
								<option value="0">Seleccione</option>
								<option value="1" >Si</option>
								<option value="2" >No</option>
							</select>
						</div> 
					</div>
					<div class="row" style="margin-bottom: 1rem;">                
						<div class="col" >
							<div id="DivMetodoUpdate"  >
								<h6 class="modal-title">Monta/inseminación</h6> 
								<select id="selectMetodosUpdate" name="selectMetodosUpdate" class="form-select" >
									<option value="0">Seleccione</option>
									<option value="1" >Monta</option>
									<option value="2" >I.A</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row" id="divTlRepUpdate">
				        <div class="col" >
						    <center><h6 id="datosRepTituloUpdate" class="modal-title" ><strong>Datos del reproductor</strong></h6>  </center>							
						</div>
					</div>
					<div class="row">
						<div id="infoToroUpdate" style="margin-bottom: 1rem;">
							<div class="col" id="codigoToroUpdate">
								<h6 class="modal-title" >Codigo</h6>  
								<select class="form-select" aria-label="Default select example" id="codigoRegistroTUpdate" title="Codigo registro toro" style="cursor: pointer;">
								</select>
								<input type="text" class="form-control" id="idToroServUpdate" aria-describedby="emailHelp" name="idToroServUpdate" hidden readonly/>
							</div>
							<div class="col" id="nombreToro">
								<h6 class="modal-title">Nombre</h6>  
								<input type="text" class="form-control" id="nomToroUpdate" aria-describedby="emailHelp" readonly>
							</div>
							<div class="col" id="razaToroUpdate">
								<h6 class="modal-title">Raza</h6>  
								<input type="text" class="form-control" id="razToroUpdate" aria-describedby="emailHelp"  readonly>
								<input type="text" class="form-control" id="idRazaServUpdate" aria-describedby="emailHelp" name="idRazaServ" hidden readonly/>
							</div>
						</div>
					</div>
					<div class="row" >
						<div class="col-lg-6" id="responsableRUpdate" hidden>
							<h6 class="modal-title">Responsable</h6> 
							<input type="text" class="form-control" id="responsableRepUpdate" aria-describedby="emailHelp"   readonly>
							<input type="text" class="form-control" id="idresponsableRepUpdate" aria-describedby="emailHelp"   readonly>
						</div>
					</div>
					<div class="row" style="margin-bottom: 2rem;">
						<div class="col">
							<div class="form-group"> 
								<h6 class="modal-title" id="observaciones">Observaciones</h6> 
								<textarea class="form-control" rows="5" id="observacionesRepUpdate"></textarea>
							</div> 
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="modal-footer">
					<button type="button" class="btn btn-primary"  id="btnUpdateCelo" >ACTUALIZAR</button>
					<button type="button" class="btn btn-danger"   id="btnCerrarUpdateCerlo" data-dismiss="modal">CERRAR</button>
					</div>
				</div>
			</div>                      
		</div>	
	</div>
	<!-----------------------------------------REGISTRO PAJILLA------------------------------------------->
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
						<div class="col">
							<h6 class="modal-title">Fecha Registro</h6>
							<input id="fechaRegistroP"  name="fechaRegistroP" type="text" class="form-control"   value='<?php echo $fecha; ?>' readonly />
						</div>
					</div>
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
					<div class="row" style="margin-bottom: 2rem;">
						<div class="col" >
							<h6 class="modal-title" >Raza toro</h6>
							<select class="form-select" aria-label="Default select example" id="razaListaPajilla" name="razaListaPajilla" >
							</select>
							<input  type="hidden" class="form-control" id="idRazaP" name="idRazaP" aria-describedby="emailHelp" >
						</div>
					</div>    
					<div class="row">
						<div class="col" >
							<div id="cardPajillas">

							</div>
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
	<!-----------------------------------------ACTUALIZAR PAJILLA------------------------------------------->
	<div id="actualizarPajilla" class="modal fade" role="dialog" > 
			<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<!-- inicio cabecera del diálogo -->
				<div class="modal-header">
					<h6 class="modal-title">ACTUALIZAR PAJILLA</h6>
					<button type="button" class="close" data-dismiss="modal">X</button>
				</div>
				<!-- el cuerpo del modal -->
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<h6 class="modal-title">Fecha Registro</h6>
							<input id="fechaRegistroPA"  name="fechaRegistroPA" type="text" class="form-control"   value='<?php echo $fecha; ?>'  />
							<input  type="text" class="form-control" id="idPaUpdate" hidden>
						</div>
					</div>
					<div class="row">
						<div class="col" >
							<h6 class="modal-title" >Numero de registro</h6>
							<input  type="text" class="form-control" id="numeroRegistroRA" readonly>
						</div>
					</div>
					<div class="row">
						<div class="col" >
							<h6 class="modal-title" >Nombre toro</h6>
							<input  type="text"  class="form-control" id="nombreToroRA">
						</div>
					</div>
					<div class="row" style="margin-bottom: 2rem;">
						<div class="col" >
							<h6 class="modal-title" >Raza toro</h6>
							<select class="form-select" aria-label="Default select example" id="razaListaPajillaA" name="razaListaPajillaA" >
							</select>
							<input  type="text" class="form-control" id="idRazaPA" name="idRazaPA" aria-describedby="emailHelp" hidden>
						</div>
					</div>    
					<!-- donde se ubican los botones y demas -->
					<div class="modal-footer">
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" id="btnActualizarPajilla" >ACTUALIZAR</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarPajillaActu">CERRAR</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-----------------------------------------VIZUALIZACION VACUNAS------------------------------------------->
	<div id="mdVisualizarVacunas" class="modal fade" role="dialog"> 
			<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<!-- inicio cabecera del diálogo -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">X</button>
				</div>
				<!-- el cuerpo del modal -->
				<div class="modal-body">
					<div class="row">
						<div class="col" >
							<div id="cardVisualizacionVacunas">
								
							</div>
						</div>
					</div> 
				</div>
			</div>
		</div>
	</div>
	
	