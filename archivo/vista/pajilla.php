	<!-- Inicio Modal pajilla-->
	<div class="modal fade" id="modalPajilla" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<!-- inicio cabecera del diálogo -->
				<div class="modal-header">
					<h6 class="modal-title">REGISTRO DE PAJILLA</h6>
					<button type="button" class="close" data-dismiss="modal">X</button>
				</div>
				<!-- el cuerpo del modal -->
				<div class="modal-body">
					<div class="row-12">
						<div class="col-sm-12" >
							<h6 class="modal-title" >Numero de registro</h6>
							<input  type="text" class="form-control" id="numeroRegistroR" >
						</div>
					</div>
					<div class="row-12">
						<div class="col-sm-12" >
							<h6 class="modal-title" >Nombre toro</h6>
							<input  type="text"  class="form-control" id="nombreToroR">
						</div>
					</div>
					<div class="row-12">
						<div class="col-sm-12" >
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