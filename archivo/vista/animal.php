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
		<script src="../../herramientas/js/especies.js"  type="text/javascript" ></script>
		<script src="../../herramientas/js/unidadesJS.js"  type="text/javascript" ></script>
		<script src="../../herramientas/js/camareAnimal.js" defer  type="text/javascript"></script>
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<?php include('cabeceraMenu.php');?>
		<main>			
			<div class="container">
				<?php include('modalAnimal.php');?>
				<?php include('especies.php');?>
				<!---ACTUALIZAR ANIMAL---->
				<div class="modal fade" id="updateAnimal">
					<div class="modal-dialog modal-dialog-scrollable">
						<div class="modal-content">
							<!-- cabecera del diálogo -->
							<div class="modal-header">
								<h6 class="modal-title">ACTUALIZAR ANIMAL</h6> 
								<button type="button" id="btnEquisUpdate" name="btnEquisUpdate" class="close" data-dismiss="modal">X</button>
							</div>
							<!-- cuerpo del diálogo -->
							<div class="modal-body">
								<div class="row mt-12">
									<div class="col" >
										<h6 class="modal-title">Fecha Registro</h6>
										<input type="hidden" id="idUsuRegistroUpdate" name="idUsuRegistroUpdate" class="form-control"  value='<?php echo $_SESSION['id_Usu']; ?>' readonly>
										<input type="hidden" id="nombreUsuRegistro" name="nombreUsuRegistro" class="form-control"  value='<?php echo $_SESSION['nombre_Usu']." ".$_SESSION['apellido_Usu']; ?>' readonly>
										<input type="date" id="fechaRegistroUpdate" name="fechaRegistroUpdate" class="form-control" placeholder="dd/mm/yy" value='<?php echo $fecha; ?>' readonly>
									</div>
									<div class="col" >
										<h6 class="modal-title">Fecha Nacimiento</h6>
										<input type="hidden" id="idAnimalUp" name="idAnimalUp" class="form-control" placeholder="Nacimiento" title="Fecha nacimiento" required>
										<input type="text" id="fechaNacimientoRegistroUpdate" name="fechaNacimientoRegistroUpdate" class="form-control" placeholder="Nacimiento" title="Fecha nacimiento" required>
									</div>	
																	
								</div>
								<!-- <div class="row mt-12">
									<div class="col" >
											<h6 class="modal-title">Edad</h6>
											<input type="text" id="edadAnimalUpdate" name="edadAnimalUpdate" class="form-control" placeholder="edad" title="Edad animal" required readonly>
									</div>	
								</div> -->
								<div class="row mt-12">
									<div class="col-sm-6" >
										<h6 class="modal-title">Codigo de sistema</h6>
										<input type="text" id="codAnimalRegistroUpdate" name="codAnimalRegistroUpdate" class="solo-numero form-control" placeholder="Codigo" title="Codigo del Animal" readonly>
									</div>
									<div class="col-sm-6" >
										<h6 class="modal-title">Número de Chapeta</h6>
										<input type="text" id="codigoSenaRegistroUpdate" name="codigoSenaRegistroUpdate" class="form-control" placeholder="Codigo Unico Sena" title="Codigo Unico Sena" required>
									</div>									
								</div>
								<div class="row mt-12">
									<div class="col-sm-12" >
										<h6 class="modal-title">Nombre</h6>
										<input type="text" id="nombreAnimalRegistroUpdate" name="nombreAnimalRegistroUpdate" class="form-control" placeholder="Nombre" title="Nombre" required>
									</div>
								</div>								
								<div class="row mt-12">
									<div class="col-sm-6" >
										<h6 class="modal-title">Color</h6>
										<input type="text" id="colorAnimalRegistroUpdate" name="colorAnimalRegistroUpdate" class="form-control" placeholder="Color" title="Color" required>
									</div>	
									<div class="col-sm-2" >
										<h6 class="modal-title">Peso</h6>
										<input type="text" id="pesoAnimalRegistroUpdate" name="pesoAnimalRegistroUpdate" class="solo-numero form-control" placeholder="Peso" title="Peso" required>
									</div>
									<div class="col-sm-4" >
										<h6 class="modal-title">U/Medida</h6>
										<select id="unidadMedidaRegistroUpdate" name="unidadMedidaRegistroUpdate" class="form-control" placeholder="Unidad de medida" title="Unidad de Medida" required>										
											<option value='0' >Seleccione...</option>
											<option value='1' >gr</option>
											<option value='2' >Kg</option>
										</select>
									</div>
								</div>
								<div class="row mt-12">
									<div class="col-sm-12" >
										<h6 class="modal-title">Observaciones</h6>
										<textarea  id="observacionesRegistroUpdate" name="observacionesRegistroUpdate"  cols='10' rows='1' class="form-control" placeholder="Observaciones" title="Observaciones" required >
										</textarea>
									</div>
								</div>
								<div class="row mt-12">
									<div class="col">
										<h6 class="modal-title">Unidad</h6>
										<select id="idUnidad_FKRegistroUpdate" name="idUnidad_FKRegistroUpdate" class="form-control " title="Seleccione Unidad" required>										
										</select>
									</div>
									<!-- <div class="col">
										 <div id='#' >
											<h6 class="modal-title">&nbsp;&nbsp;</h6>
											<button type="button" id="modalUnidad" name="modalUnidad" <?php echo $var_class_button_formulario; ?> data-toggle="modal" data-target="#NuevoRegistroUnidades">
											<span class="fa fa-plus" aria-hidden='true'></span>
											</button>
										</div>
									</div>	 -->
								</div>								
								<div class="row mt-12">
									<div class="col">
										<h6 class="modal-title">Especie</h6>
										<select id="idEspecie_FKRegistroUpdate" name="idEspecie_FKRegistroUpdate" class="form-control" title="Seleccione Especie" required >										
										</select>
									</div>
									<!-- <div class="col">
										<div id='divModalEspecies' >
											<h6 class="modal-title">&nbsp;&nbsp;</h6>
											<button type="button" id="btnModalEspecie" name="btnModalEspecie" <?php echo $var_class_button_formulario; ?> data-toggle="modal" data-target="#addEspecie">
											<span class="fa fa-plus" aria-hidden='true'></span>
											</button>
										</div>
									</div>	 -->
								</div>
								<div class="row mt-12">
									<div class="col">
										<h6 class="modal-title">Raza</h6>
										<select id="idRaza_FKRegistroUpdate" name="idRaza_FKRegistroUpdate" class="form-control" title="Seleccione Raza" required >										
										</select>
									</div>
									<!-- <div class="col">
										<div id='botonRaza' >
											<h6 class="modal-title">&nbsp;&nbsp;</h6>
											<button type="button" id="btnModalRaza" name="btnModalRaza" <?php echo $var_class_button_formulario; ?> data-toggle="modal" data-target="#addRaza">
											<span class="fa fa-plus" aria-hidden='true'></span>
											</button>
										</div>
									</div>									 -->
								</div>
								<div class="row mt-12">
									<div class="col">
										<h6 class="modal-title">Sexo</h6>
										<select id="idSexoRegistroUpdate" name="idSexoRegistroUpdate" class="form-control" style="width: 220px;" title="Seleccione Sexo" required >										
											<option value='0' >Seleccione...</option>
											<option value='1' >Macho</option>
											<option value='2' >Hembra</option>
										</select>
									</div>
								</div>
								
							</div>
							<!-- pie del diálogo -->
							<div class="modal-footer">
								<button type="button" id="btnUpdateAnimal" name="btnUpdateAnimal" <?php echo $var_class_button_formulario; ?> >Guardar</button>
								<button type="button" id="btnCerrarAnimal"  name="btnCerrarAnimal" <?php echo $var_class_button_popup;  ?> data-dismiss="modal"  >Cerrar</button> 
							</div>
						</div>
					</div>
				</div>
				<!---FIN ACTUALIZAR ANIMAL---->
				<!--INICIO MODAL UNIDADES--->
				<?php include("modalUnidades.php"); ?>
				<!--FIN MODAL UNIDADES--->
				<?php include("cameraAnimal.php"); ?>
				<?php include("modalRaza.php"); ?>
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
					</table>
				</div>
				<!-- cierre tabla --->	
			</div>	
		</main>		
		<?php include('pieMenu.php'); ?>		
	</body>
</html>
<?php  } else { header("Location: ../../index.php");} ?>
