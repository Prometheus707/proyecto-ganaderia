<?php  /* 	opciones con modal 		https://getbootstrap.esdocu.com/docs/5.1/components/modal/    */
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
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>RUPS-UNIDADES</title>
		<!--<script src='https://code.jquery.com/jquery-3.6.0.js'></script>-->
		<script src='https://kit.fontawesome.com/459929adcc.js' crossorigin='anonymous'></script>
		<link   href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js'></script>
		<link   href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
		<?php include('head.php'); ?>
		<script src="../../herramientas/js/unidadesJS.js" type="text/javascript" ></script>	
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<?php include('cabeceraMenu.php');?>
		<main>			
			<div class="container">
				<?php //include("modalUnidad.php"); ?>
				<div class="modal fade" id="ppNuevoRegistro">
					<div class="modal-dialog modal-lg modal-dialog">
						<div class="modal-content">
							<!-- cabecera del diálogo -->
							<div class="modal-header">
								<h6 class="modal-title">UNIDAD PRODUCTIVA</h6>
								<button type="button" id="btnEquis" name="btnEquis" class="close" data-dismiss="modal">X</button>
							</div>
							
							<!-- cuerpo del diálogo -->
							<div class="modal-body">
								<div class="row mt-1">
									<div class="col-lg-12" >
										<input type="text" class="form-control"  id="unidadXcentro" name="unidadXcentro" value='<?php echo $_SESSION['centroUusario_fk']; ?>' hidden>
										<input type="text" class="form-control"  id="unidadXRegional" name="unidadXRegional" value='<?php echo $_SESSION['regionalUsuario_fk']; ?>' hidden>
										<h6 class="modal-title">Fecha</h6>
										<input type="date" class="form-control" placeholder="fecha hoy" id="fechaRegistro" name="fechaRegistro" value='<?php echo $fecha; ?>' readonly>
									</div>
								</div>
								<div class="row mt-1">
									<div class="col-lg-12" >
										<h6 class="modal-title">Nombre</h6>
										<input type="text" class="form-control" placeholder="nombre unidad" id="nombreUnidadPro" name="nombreUnidadPro" title="Nombre de la unidad">
									</div>
								</div>
								<div class="row mt-1">
									<div class='row' class="col-lg-12 text-center">
										<div id='divRespTUnidad' class="col-lg-12 text-center" class='col-20' ></div>
									</div>										
								</div>
								
							</div>
							
							<!-- pie del diálogo -->
							<div class="modal-footer">
								<button type="button" id="btnGuardarUnidad" name="btnGuardarUnidad" <?php echo $var_class_button_formulario; ?> >Guardar</button>
								<button type="button" id="btnCerrarAdd" name="btnCerrarAdd" <?php echo $var_class_button_popup;  ?> data-dismiss="modal"  >Cerrar</button> 
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="editarUnidad">
					<div class="modal-dialog modal-lg modal-dialog">
						<div class="modal-content">
							<!-- cabecera del diálogo -->
							<div class="modal-header">
								<h6 class="modal-title">ACTUALIZAR UNIDAD</h6>
								<button type="button" id="btnEquis" name="btnEquis" class="close" data-dismiss="modal">X</button>
							</div>
							
							<!-- cuerpo del diálogo -->
							<div class="modal-body">
								<div class="row mt-1" >
									<div class="col-lg-12" >
										<h6 class="modal-title">Nombre</h6>
										<input type="hidden" class="form-control" id="idUnidadProUpdate" name="idUnidadProUpdate" title="Id Unidad";>
										<input type="text" class="form-control" placeholder="nombre unidad" id="nombreUnidadProUpdate" name="nombreUnidadProUpdate" title="Nombre de la unidad";>
									</div>
								</div>
								<div class="row mt-1">
									<div class='row' class="col-lg-12 text-center">
										<div id='divRespTUnidadUpdate' class="col-lg-12 text-center" class='col-20' ></div>
									</div>										
								</div>
								<br>
							</div>
							
							<!-- pie del diálogo -->
							<div class="modal-footer">
								<button type="button" id="btnUpdate" name="btnUpdate" <?php echo $var_class_button_formulario; ?> >Actualizar</button>
								<button type="button" id="btnCerrarUpdate" name="btnCerrarUpdate" <?php echo $var_class_button_popup;  ?> data-dismiss="modal" >Cerrar</button> 
							</div>
						</div>
					</div>
				</div>
				
				<div class="modal fade" id="adminstracion">
					<!--<div class="modal-dialog modal-lg modal-dialog">-->
					<div class="modal-dialog modal-lg modal-dialog-scrollable">
						<div class="modal-content">
							
							<!-- cabecera del diálogo -->
							<div class="modal-header">
								<h6 class="modal-title">ETAPA PRODUCTIVA</h6>
								<button type="button" id="btnEquis" name="btnEquis" class="close" data-dismiss="modal">X</button>
							</div>
							
							<!-- cuerpo del diálogo -->
							<div class="modal-body">
								<div class="row mt-1">
									<div class="col-lg-12" >
										<h6 class="modal-title">Nombre de la unidad</h6>
										<input type="hidden" class="form-control" id="idUnidadAdmin" name="idUnidadAdmin" title="Id Unidad";>
										<input type="text" class="form-control" id="nombreUnidadAdmin" name="nombreUnidadAdmin" title="Nombre de la unidad ADMIN" readonly>
									</div>
								</div>	<br>							
								<!-- inicio div para guardar  -->
								<div id='listarGuardar' >
									<div class="row mt-1">
										<div class="col-lg-18" >
											<h6 class="modal-title">Nombre de la Especie a Adicionar</h6>
										</div>
									</div>
									<div class="row mt-1">
										<div class="col-lg-8" >
											<input type="text" class="form-control" id="nombreEspecie" name="nombreEspecie" placeholder="nombre especie a guardar" title="Nombre de la especie a Guardar";>
										</div>
										<div class="col-lg-1" >
											<button type="button" id="btnAdd" name="btnAdd" class="btn btn-primary btn-sm" <?php echo $var_class_button_formulario; ?> >Guardar</button>
										</div>
										<br>
									</div>
								</div>
								<!-- cierre div para guardar  -->
								
								<!-- inicio div para actualizar  -->
								<div id='listarActualizar' >
									<div class="row mt-1">
										<div class="col-lg-18" >
											<h6 class="modal-title">Nombre de la Especie a Actualizar</h6>
										</div>
									</div>
									<div class="row mt-1">
										<div class="col-lg-6" >
											<input type="hidden" class="form-control" id="idEspecieUpd" name="idEspecieUpd" placeholder="nombre especie actualizar" title="Nombre de la especie actualizar";>
											<input type="text" class="form-control" id="nombreEspecieUpd" name="nombreEspecieUpd" placeholder="nombre especie actualizar" title="Nombre de la especie actualizar";>
										</div>
										<div class="col-lg-3" >
											<button type="button" id="btnUpd" name="btnUpd" class="btn btn-primary btn-sm" <?php echo $var_class_button_formulario; ?> >Actualizar</button>
											<button type="button" id="btnCancelar" name="btnCancelar" class="btn btn-warning btn-sm" <?php echo $var_class_button_formulario; ?> >Cancelar</button>
										</div>
										<br>
									</div>
								</div>
								<!-- cierre div para actualizar  -->

								<!-- inicio div para eliminar  -->
								<div id='listarKiller' >
									<div class="row mt-1">
										<div class="col-lg-18" >
											<h6 class="modal-title">Nombre de la Especie a Eliminar</h6>
										</div>
									</div>
									<div class="row mt-1">
										<div class="col-lg-6" >
											<input type="hidden" class="form-control" id="idEspecieDell" name="idEspecieDell" placeholder="nombre especie actualizar" title="Nombre de la especie actualizar";>
											<input type="text" class="form-control" id="nombreEspecieDell" name="nombreEspecieDell" placeholder="nombre especie actualizar" title="Nombre de la especie actualizar" readonly />
										</div>
										<div class="col-lg-3" >
											<button type="button" id="btnDell" name="btnDell" class="btn btn-danger btn-sm" <?php echo $var_class_button_formulario; ?> >Eliminar	</button>
											<button type="button" id="btnCancelarDell" name="btnCancelarDell" class="btn btn-success btn-sm" <?php echo $var_class_button_formulario; ?> >Cancelar</button>
										</div>
										<br>
									</div>
								</div>
								<!-- cierre div para eliminar  -->								
								
								<br>
								<div class="row mt-1">
									<div class="col-lg-12" >
										<h6 class="modal-title">LISTA ENCONTRADA</h6>
									</div>
								</div>
								<div class="table-responsive">
									<table id="lista" data-order='[[ 4, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover table-bordered" >
										<thead>
											<tr>
												<th scope='col'>#</th>
												<th scope='col'>ID</th>
												<th scope='col'>Nombre</th>
												<th scope='col'>Op</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class='row' class="col-lg-12 text-center">
									<div id='divRespAdministrar' class="col-lg-12 text-center" class='col-20' ></div>
								</div>
							</div>
							
							<!-- pie del diálogo -->
							<div class="modal-footer">
								<!--
								<button type="button" id="btnUpdate" name="btnUpdate" <?php echo $var_class_button_formulario; ?> >Actualizar</button>
								-->
								<button type="button" id="btnCerrarUpdate" name="btnCerrarUpdate" <?php echo $var_class_button_popup;  ?> data-dismiss="modal" >Cerrar</button> 
							</div>
						</div>
					</div>
				</div>				
			</div>
			<div class="card card-success">
				<div class="card-header">
					<h3 class="card-title"><b>FORMULARIO UNIDADES</b></h3>
				</div>
				<?php include('controlPanel.php'); ?>
				<!-- inicio tabla --->
				<div class="table-responsive">
					<table id="example"  data-order='[[ 4, "asc" ]]' data-page-length='10'  class="table table-sm table-striped table-hover table-bordered" >
						<thead>
							<tr>
								<th scope='col'>#</th>
								<th scope='col'>ID</th>
								<th scope='col'>Nombre</th>
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
 <?php  } else { header("Location: ../../index.php"); }  ?>
