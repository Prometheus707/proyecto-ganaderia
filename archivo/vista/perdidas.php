<!--inicio modal usuario-->
<div class="modal fade" id="perdidasM" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">REGISTRO PÉRDIDA</h4>
				<button type="button" class="close" data-dismiss="modal">X</button>
			</div>
			<div class="modal-body">
				<div class="row mt-12">
					<div class="row">
						<div class="col-sm-12">
							<h4 class="modal-title">Fecha</h4>  
							<input type="text" id='idAnimalFKPerdidas' name='idAnimalFKPerdidas'  > 
							<input type="text" id='fechaPerd' name='fechaPerd' class="form-control" placeholder="">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12" ><br>
							<h4 class="modal-title">Observaciones</h4>  
							<div class="mb-12"> 
								<div class="mb-3"> 
									<textarea class="form-control" rows="4" id="comentariospernamdi" e="comentariospernamdi"></textarea>
								</div>        
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="btncerrarperdida" name="btncerrarperdida" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
					<button type="button" id='btnCamera' name='btnCamera' class="btn btn-link" data-toggle="modal" data-target="#mdlCamera" ><i class="fa fa-camera" aria-hidden="true" ></i></button>
					<button type="button" id='guardaperdi' name='guardaperdi' class="btn btn-primary">GUARDAR</button>
				</div>
			</div>
		</div>
		
	</div>
</div>
<div class="modal fade" id="mdlCamera" >
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">REGISTRO TOMAR FOTO</h4>
				<button type="button" id='btnClose' name='btnClose' class="close" data-dismiss="modal">X</button>
			</div>
			<div class="modal-body">
				<div class="row mt-12">
					<div class="row">
						<div class="col-sm-12">
							<!--<button id="open-cam">Abrir Cámara</button>-->
							<center>
								<span class="border border-warning">
									<video id="video" width="320" height="240"></video>
								</span>
							</center>
							<center><br>
								<button id="snap" class="btn btn-danger" ><i class="fa fa-camera" aria-hidden="true" ></i></button>
							</center>
							<center>
								<span class="border border-warning">							
									<canvas id="canvas" width="320" height="240"></canvas>
								</span>	
							</center>
							<input type="hidden" id="imageInput" name="imageInput">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="btncerrarperdida" name="btncerrarperdida" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
					<button type="button" id='btnCamera' name='btnCamera' class="btn btn-link"  ><i class="fa fa-camera" aria-hidden="true" ></i></button>
					<button type="button" id='GuardarFoto' name='GuardarFoto' class="btn btn-primary">GUARDAR</button>
				</div>
			</div>
		</div>
		
	</div>
</div>