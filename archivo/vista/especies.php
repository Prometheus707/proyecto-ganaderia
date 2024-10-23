<!---AGREGAR ESPECIE---->
<div id="addEspecie" class="modal fade" role="dialog"> 
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<!-- inicio cabecera del diálogo -->
			<div class="modal-header">
				<h6 class="modal-title">REGISTRO DE ESPECIES</h6>
				<button type="button" class="close" data-dismiss="modal">X</button>
			</div>
			<!-- el cuerpo del modal -->
			<div class="modal-body">
				<div class="row">
					<div class="col" >
						<h6 class="modal-title" >Nombre especie</h6>
						<input  type="text"  class="form-control" id="nombreEspecie" name="nombreEspecie">
					</div>
				</div>
				<div class="d-flex flex-row justify-content-center mt-2 ">					
					<button type="button" class="btn btn-primary mr-2" id="btnGuardarEspecie" >GUARDAR</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarEspecie">CERRAR</button>
				</div>
				<div class="row" style="margin-bottom: 2rem;">
					<div class="col" >	
						<input  type="text" class="form-control" id="unidadEspecie" name="unidadEspecie" aria-describedby="emailHelp" hidden>
					</div>
				</div>    
				<div class="row">
					<div class="col" >
						<div id="cardEspecie">
							 
						</div>
					</div>
				</div> 
			</div>
		</div>
	</div>
</div>
<!----ACTUALIZAR ESPECIE-->
<div id="updateEspecie" class="modal fade" role="dialog"> 
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<!-- inicio cabecera del diálogo -->
			<div class="modal-header">
				<h6 class="modal-title">ACTUALIZAR ESPECIES</h6>
				<button type="button" class="close" data-dismiss="modal">X</button>
			</div>
			<!-- el cuerpo del modal -->
			<div class="modal-body">
				<div class="row">
					<div class="col">
						<input  type="hidden"  class="form-control" id="idEspecieUpdate" name="idEspecieUpdate">
					</div>
				</div>
				<div class="row">
					<div class="col" >
						<h6 class="modal-title" >Nombre especie</h6>
						<input  type="text"  class="form-control" id="nombreEspecieUpdate" name="nombreEspecieUpdate">
					</div>
				</div>
				<div class="row" style="margin-bottom: 2rem;">
					<div class="col" >
						<h6 class="modal-title" >Unidad</h6>
						<input  type="text"  class="form-control" id="unidadEspecieUpdate" name="unidadEspecieUpdate" readonly >
					</div>
				</div>  
				<!-- donde se ubican los botones y demas -->
				<div class="modal-footer">
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="btnUptdEspecie" >ACTUALIZAR</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrarUptdEspecie">CERRAR</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



