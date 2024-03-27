 <?php  
 /* 	opciones con modal 		https://getbootstrap.esdocu.com/docs/5.1/components/modal/    */
include_once('../../include/config.php');
date_default_timezone_set('America/Bogota');
include_once('../../include/parametros_index.php');
header('Cache-Control: no-cache, must-revalidate');
header('Content-Type: text/html; charset='.$charset);
session_name($session_name);
session_start();
if (isset($_SESSION['id_Usu'])){	
$fecha = date("Y-m-d"); 
$fecha_Banner = date("Y-m-d"); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>RUPS-ANIMAL</title>
		<meta charset='utf-8'>
		<meta http-equiv='Cache-Control' content='no-cache, mustrevalidate'>
		<script src='https://kit.fontawesome.com/459929adcc.js' crossorigin='anonymous'></script>
		<link   href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js'></script>
		<link   href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
		<?php include('head.php');?>
		<script src="../../herramientas/js/animalJS.js" type="text/javascript" ></script>	
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<?php include('cabeceraMenu.php');?>
		<main>			
			<div class="container">
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
									<div class="col" >
										<h6 class="modal-title">Fecha</h6>
										<input type="hidden" id="idUsuRegistro" name="fechaRegistro" class="form-control"  value='<?php echo $_SESSION['id_Usu']; ?>' readonly>
										<input type="hidden" id="nombreUsuRegistro" name="fechaRegistro" class="form-control"  value='<?php echo $_SESSION['nombre_Usu']." ".$_SESSION['apellido_Usu']; ?>' readonly>
										<input type="date" id="fechaRegistro" name="fechaRegistro" class="form-control" placeholder="dd/mm/yy" value='<?php echo $fecha; ?>' readonly>
									</div>
									<div class="col" >
										<h6 class="modal-title">Fecha Nacimiento</h6>
										<input type="text" id="fechaNacimientoRegistro" name="fechaNacimientoRegistro" class="form-control" placeholder="Fecha nacimiento" title="Fecha nacimiento" required>
									</div>	
									<div class="col" >
										<h6 class="modal-title">Edad</h6>
										<input type="text" id="edadAnimal" name="edadAnimal" class="form-control" placeholder="edad animal" title="Edad animal" required readonly>
									</div>									
								</div>
								<div class="row mt-12">
									<div class="col-sm-6" >
										<h6 class="modal-title">Codigo de sistema</h6>
										<input type="text" id="codAnimalRegistro" name="codAnimalRegistro" class="solo-numero form-control" placeholder="Codigo" title="Codigo del Animal" required >
									</div>
									<div class="col-sm-6" >
										<h6 class="modal-title">Número de Chapeta</h6>
										<input type="text" id="codigoSenaRegistro" name="codigoSenaRegistro" class="form-control" placeholder="Codigo Unico Sena" title="Codigo Unico Sena" required>
									</div>									
								</div>
								<div class="row mt-12">
									<div class="col-sm-12" >
										<h6 class="modal-title">Nombre</h6>
										<input type="text" id="nombreAnimalRegistro" name="nombreAnimalRegistro" class="form-control" placeholder="Nombre" title="Nombre" required>
									</div>
								</div>								
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
									<div class="col-sm-12">
										<h6 class="modal-title">Unidad</h6>
										<select id="idUnidad_FKRegistro" name="idUnidad_FKRegistro" class="form-control" title="Seleccione Unidad" required>										
										</select>
									</div>
								</div>								
								<div class="row mt-12">
									<div class="col-sm-12">
										<h6 class="modal-title">Especie</h6>
										<select id="idEspecie_FKRegistro" name="idEspecie_FKRegistro" class="form-control" title="Seleccione Especie" required >										
										</select>
									</div>
								</div>
								<div class="row mt-12">
									<div class="col-sm-9">
										<h6 class="modal-title">Raza</h6>
										<select id="idRaza_FKRegistro" name="idRaza_FKRegistro" class="form-control" title="Seleccione Raza" required >										
										</select>
									</div>
									<div class="col-sm-3">
										<div id='botonRaza' >
											<h6 class="modal-title">&nbsp;&nbsp;</h6>
											<button type="button" id="btnModalRaza" name="btnModalRaza" <?php echo $var_class_button_formulario; ?> data-toggle="modal" data-target="#addRaza">
											<span class="fa fa-plus" aria-hidden='true'></span>
											</button>
										</div>
									</div>									
								</div>
								<div class="row mt-12">
									<div class="col-sm-12">
										<h6 class="modal-title">Sexo</h6>
										<select id="idSexoRegistro" name="idSexoRegistro" class="form-control" title="Seleccione Sexo" required >										
											<option value='0' >Seleccione...</option>
											<option value='1' >Macho</option>
											<option value='2' >Hembra</option>
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
				<div id="addRaza" class="modal fade" role="dialog"> 
					<div class="modal-dialog modal-dialog-scrollable">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-tittle">Registro Raza</h4>
								<button type="button" id="btnEquis" name="btnEquis" class="close" data-dismiss="modal">X</button>
							</div>
						
							<div class="modal-body">
								<!-- inicio div para guardar  -->
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
								<!-- cierre div para guardar  	 -->
								<!-- inicio div para actualizar  -->
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
								<!-- cierre div para actualizar  -->
								<!-- inicio div para eliminar    -->
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
								<!-- cierre div para eliminar  -->							
								<div class="row mt-1">
									<div class="table-responsive">
										<table id="lista" data-order='[[ 3, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" >
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
				
			</div>			
			<div class="card card-success">
				<div class="card-header">
					<h3 class="card-title"><b>FORMULARIO ANIMAL</b></h3>
				</div>
				<?php include('controlPanel.php');?>
				<!-- inicio tabla --->
				<div class="table-responsive">
					<table id="example"  data-order='[[ 3, "asc" ]]' data-page-length='10'  class="table table-sm table-striped table-hover table-bordered" >
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
				<!-- cierre tabla --->	
			</div>	
		</main>		
		<?php include('pieMenu.php'); ?>		
	</body>
</html>
<?php  } else { header("Location: ../../index.php");} ?>
