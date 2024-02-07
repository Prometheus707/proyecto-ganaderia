	<div class="modal fade" id="mdreproduccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" >REGISTRO DE SERVICIOS</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">X</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row" >
						<div class="col-lg-4" >
							<h6 class="modal-title">Codigo vaca</h6>  
							<input type="text" class="form-control" id="codigoVaca" aria-describedby="emailHelp"  readonly>
							<input type="text" class="form-control" id="idAnimal" aria-describedby="emailHelp" name="idAnimal" readonly/>
						</div>
						<div class="col-lg-4">
							<h6 class="modal-title">Nombre vaca</h6>  
							<input type="text" class="form-control" id="nombreVacaR" aria-describedby="emailHelp" readonly>
						</div>
						<div class="col-lg-4">
							<h6 class="modal-title">Raza vaca</h6>  
							<input type="text" class="form-control" id="razaVacaR" aria-describedby="emailHelp" readonly>
							<input type="text" class="form-control" id="idRazaV" aria-describedby="emailHelp" name="idAnimal" readonly/>
						</div>
					</div>                                     
					<div class="row">
						<div class="col-lg-6">
							<h6 class="modal-title">Fecha de celo</h6>
							<input type="text" id="fechaCeloVaca" class="form-control"   value='<?php echo $fecha; ?>' readonly/>
						</div>
						<div class="col-lg-6">
							<h6 class="modal-title">Servido</h6> 
							<select class="form-select" aria-label="Default select example" id="servido">
								<option value="0">Seleccione</option>
								<option value="1" id="si">Si</option>
								<option value="2" id="no">No</option>
							</select>
						</div>
					</div>
					<div class="row">                
						<div class="col-lg-12" id="metodo">
							<h6 class="modal-title">Monta/inseminacion</h6> 
							<select class="form-select" aria-label="Default select example" id="metodos" name="metodos">
							<option value="0">Seleccione</option>
							<option value="1" >Monta</option>
							<option value="2" >Inseminacion</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4" id="codigoToro">
							<h6 class="modal-title" >Codigo registro Toro</h6>  
							<select class="form-select" aria-label="Default select example" id="codigoRegistroT"  >
							</select>
							<input type="text" class="form-control" id="idToroServ" aria-describedby="emailHelp" name="idAnimal" readonly/>
						</div>
						<div class="col-lg-4" id="nombreToro">
							<h6 class="modal-title">Nombre toro</h6>  
							<input type="text" class="form-control" id="nomToro" aria-describedby="emailHelp" readonly>
						</div>
						<div class="col-lg-4" id="razaToro">
							<h6 class="modal-title">Raza toro</h6>  
							<input type="text" class="form-control" id="razToro" aria-describedby="emailHelp"  readonly>
							<input type="text" class="form-control" id="idRazaServ" aria-describedby="emailHelp" name="idRazaServ" readonly/>
						</div>
					</div>
					<div class="row" >
						<div class="col-sm-4">
							<button type="button" name="btnPajila" id="btnPajila" class="btn btn-block btn-warning btn-sm btn-sm; cursor:pointer;" data-toggle="modal" data-target="#modalPajilla">
							<i class="fa fa-registered" aria-hidden="true"></i>pajilla</i></button>
						</div>
					</div>
					<div class="row" >
						<div class="col-lg-6" id="responsableR" >
							<h6 class="modal-title">Responsable</h6> 
							<input type="text" class="form-control" id="responsableRep" aria-describedby="emailHelp"   readonly>
							<input type="text" class="form-control" id="idresponsableRep" aria-describedby="emailHelp"   readonly>
						</div>
						<div class="col-lg-6">
							<div class="form-group"> 
								<h6 class="modal-title" id="observaciones">Observaciones</h6> 
								<textarea style="width:95%" class="form-control" rows="5" id="observacionesRep"></textarea>
							</div> 
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnguardarCelo">GUARDAR</button>
					<button type="button" class="btn btn-danger"   id="btncerrarReproduccion" data-dismiss="modal">CERRAR</button>
					</div>
				</div>
			</div>                      
		</div>	
	</div>