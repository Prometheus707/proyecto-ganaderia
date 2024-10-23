<div id="addArea" class="modal fade" role="dialog"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- inicio cabecera del diálogo -->
			<div class="modal-header">
				<h6 class="modal-title">REGISTRO DE AREAS</h6>
				<button type="button" class="close" data-dismiss="modal">X</button>
			</div>
			<!-- el cuerpo del modal -->
			<div class="modal-body">
				<div class="row">
					<div class="col">
						<h6 class="modal-title" >Nombre area</h6>
                        <input type="text" class="form-control"  id="areaXcentro" name="areaXcentro" value='<?php echo $_SESSION['centroUusario_fk']; ?>' hidden>

						<input  type="text"  class="form-control" id="nombreArea" name="nombreArea">
					</div>
				</div>
				<div class="d-flex flex-row justify-content-center mt-2 mb-2">					
					<button type="button" class="btn btn-primary mr-2" id="btnGuardarArea" >GUARDAR</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarArea">CERRAR</button>
				</div>
				<div class="row">
					<div class="col" >
						<div id="cardArea">
							 
						</div>
					</div>
				</div> 
			</div>
		</div>
	</div>
</div>
<!---ACTUALIZAR AREAS----->
<div id="updateArea" class="modal fade" role="dialog"> 
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- inicio cabecera del diálogo -->
			<div class="modal-header">
				<h6 class="modal-title">ACTUALIZAR AREAS</h6>
				<button type="button" class="close" data-dismiss="modal">X</button>
			</div>
			<!-- el cuerpo del modal -->
			<div class="modal-body">
				<div class="row">
					<div class="col">
						<h6 class="modal-title" >Nombre area</h6>
                        <input type="text" class="form-control"  id="idAreaUp" name="idAreaUp" hidden>
						<input  type="text"  class="form-control" id="nombreAreaUpdate" name="nombreAreaUpdate">
					</div>
				</div>
				<div class="d-flex flex-row justify-content-center mt-2 mb-2">					
					<button type="button" class="btn btn-primary mr-2" id="btnUpdateArea" >ACTUALIZAR</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarAreaUpdate">CERRAR</button>
				</div>
			</div>
		</div>
	</div>
</div>