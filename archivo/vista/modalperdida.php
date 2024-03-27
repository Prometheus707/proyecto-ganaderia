
		<div class="modal fade" id="modalperdi" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- inicio cabecera del diálogo -->
					<div class="modal-header">
						<h4 class="modal-title">REGISTRO NOVEDADES</h4>
						<button type="button" class="close" data-dismiss="modal">X</button>
					</div>

					<div class="modal-body">
					   <div class="row" hidden>
							<div class="col-sm-12" >
							  <h4 class="modal-title">Nombre Animal</h4>  
								<input type="form-control" id='nonbreAp' name='nonbreAp' class="form-control"  readonly >										
							   <!-- <input type="form-control" id='Animals' name='Animals' class="form-control"  placeholder="">
								</input>
								-->
							</div>
						</div>
						<div class="row" hidden>
							<div class="col-sm-12 ">
								<h4 class="modal-title">Codigo Animal</h4>  
								<input class="form-control" id='codigoAnimalperdi' name='codigoAnimalperdi'     >
								</input>
							</div>
						</div>
						<div class="row" hidden>
							<div class="col-sm-12 ">
								<h4 class="modal-title">Unidad</h4>  
								<input class="form-control" id='unidadper' name='unidadper' >
								</input>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<h4 class="modal-title">Fecha Novedades</h4>  
								<input type="hidden" id='idAnimalFK' name='idAnimalFK'  > 
								<input type="text" id='idfotoanimal' name='idfotoanimal'  >
								<input type="text" id='fechaPerd' name='fechaPerd' class="form-control" placeholder="">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12" ><br>
									<h4 class="modal-title">Observaciones</h4>  
								<div class="mb-12"> 
									<form>
										<div class="mb-3"> 
											<textarea class="form-control" rows="4" id="comentariospernamdi" e="comentariospernamdi"></textarea>
										</div> 
									</form>        
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id='btnlistarno' name='btnlistarno' class="btn btn-link" data-toggle="modal" data-target="#VerTodasImagenes" ><i class="fa fa-list" aria-hidden="true"></i></button> 
						<button type="button" id="btncerrarperdida" name="btncerrarperdida" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
						<button type="button" id='btnCamera' name='btnCamera' class="btn btn-link" data-toggle="modal" data-target="#idImagenper" ><i class="fa fa-camera" aria-hidden="true" ></i></button> 
						<button type="button" id='guardaperdi' name='guardaperdi' class="btn btn-primary">GUARDAR</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="idImagenper">
			<div class="modal-dialog">
				<div class="modal-content">						
					<!-- inicio cabecera del diálogo -->
					<div class="modal-header">
						<h6 class="modal-title">Subir Imagen perdida</h6>
						<button type="button" class="close" data-dismiss="modal">X</button>
					</div>	

					<!-- inicio cuerpo del diálogo -->
					  <div class="modal-body">
						<div class="row mt-1">
							<div class="col-12">
								<div >
									<h1>Capturar y Mostrar Foto</h1>
									<video id="video" width="100%" height="100%" autoplay></video>
									<!--<input type="text" id="idAnimalFoto">-->
									<canvas id="canvas" style="display:none;"></canvas>
								</div>
								<button type="button" id='btnApagarCamera' name='btnApagarCamera'  >Apagar</button> 
								<button type="button" id='btnPrenderCamera' name='btnApagarCamera'  >Prender</button> 
							</div>
						</div>						
					</div>							  
					
					<!-- inicio pie del diálogo -->
					<div class="modal-footer">
					<!-- <input type="text" id="idAnimalFoto" name="idAnimalFoto"> -->
					<button class="form-control"id="capturar-btn" name="capturar-btn" ><i class="fa fa-camera" aria-hidden="true"></i></button>
					<!--	<button class="form-control" onclick="mostrarImagenes()">Mostrar Imágenes</button>-->
								
					</div>
					<!-- cierre pie del diálogo -->
				</div>
			</div>
		</div>