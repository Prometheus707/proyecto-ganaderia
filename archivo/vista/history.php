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
		<title>RUPS-USUARIOS</title>
		<script src='https://kit.fontawesome.com/459929adcc.js' crossorigin='anonymous'></script>
		<link   href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js'></script>
		<link   href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
		<script src='https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js'></script>
		<?php include('head.php');?>
		<script src="../../herramientas/js/historialJS.js" type="text/javascript" ></script>
		<script src="../../herramientas/js/servicio.js" type="text/javascript" ></script>
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<?php include('cabeceraMenu.php');?>
		<main>
			<div id='containerBqd' class="card card-success" >				
				<div class="card-header">
					<h3 class="card-title"><b>HISTORIAL CLINICO</b></h3>
				</div>
				<?php include('controlPanel.php'); ?>	
				<!-- inicio tabla --->
				<div class="table-responsive" class="table table-head-fixed text-nowrap">                
					<table id="example" data-order='[[ 3, "asc" ]]' data-page-length='10' class="table table-sm table-striped table-hover" >
						<thead>
							<tr>
								<th scope='col'>Código</th>
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
			<div id='containerCarpetaHistorial' class="card card-success" >
				<section class="content">
					<?php include('reproduccion.php'); ?>
					<?php include('pajilla.php'); ?>
					<div class="container-fluid">
						<div class="row" >
							<div class="col-12 col-sm-6 col-md-3"> &nbsp </div>
						</div>
						<div class="row" >
							<div class="col-12 col-sm-6 col-md-3">
								<input type="hidden" class="form-control"  id="idAnimalBusqueda" name="idAnimalBusqueda"  />
							</div>
						</div>
						<div class="row" >
							<div class="col-12 col-sm-6 col-md-3">
								<input type="text" class="form-control"  id="codAnimalBuscado"  name="codAnimalBuscado" readonly />
							</div>
						</div>
						<div class="row" >
							<div class="col-12 col-sm-6 col-md-3">
								<input type="text" class="form-control"   id="nomAnimalBuscado"   name="nomAnimalBuscado" readonly />							
							</div>
						</div>
						<div class="row" >
							<div class="col-12 col-sm-6 col-md-3">
								<input type="text" class="form-control"   id="unidadBuscado"      name="unidadBuscado" readonly />							
							</div>
						</div>
						<div class="row" >
							<div class="col-12 col-sm-6 col-md-3">
								<input type="text" class="form-control"   id="idrazaAnimalBuscado"      name="unidadBuscado" readonly />							
							</div>
						</div>
						<div class="row" >
							<div class="col-12 col-sm-6 col-md-3">
								<input type="text" class="form-control"   id="razaAnimalBuscado"      name="unidadBuscado" readonly />							
							</div>
						</div>
						<!--
						<div class="row" >
							<div class="col-12 col-sm-6 col-md-3">							
								<input type="text" class="form-control"   id="idUnidadBuscado"    name="idUnidadBuscado" readonly />
							</div>
						</div>
						-->
						<div class="row">
							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box">
									<span id="divVacunas" style="cursor:pointer" class="info-box-icon bg-info elevation-1">
										<i class="fa fa-assistive-listening-systems" aria-hidden="true"></i>
									</span>
									<div class="info-box-content">
										<span class="info-box-text">VACUNACIÓN</span>
										<button type="button" href="ubicacion.php" class="info-box-text" 	data-toggle="modal" data-target="#myModal">Launch modal</button>
									</div>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box">
									<span id="divDesparacitar" style="cursor:pointer" 
									class="info-box-icon bg-danger elevation-1">
									<i class="fa fa-stumbleupon" aria-hidden="true"></i>
									</span>
									<div class="info-box-content">
										<span class="info-box-text">DESPARACITACIÓN</span>
									</div>
								</div>
							</div>					
						</div>
						<div class="row">
							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box">
									<span id="divPartos" style="cursor:pointer" class="info-box-icon bg-success elevation-1">
										<i class="fa fa-plus-square" aria-hidden="true"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">PARTOS</span>
									</div>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box">
									<span id="divChekeo" data-toggle="modal" data-target="#mdreproduccion" style="cursor:pointer" class="info-box-icon bg-info elevation-1">
									<i class="fa fa-hand-paper-o" aria-hidden="true"></i>
									</span>
									<div  class="info-box-content">
										<span class="info-box-text">Chekeo</span>
									</div>
								</div>
							</div>							
						</div>			
					</div>
				</section>			
			</div>
		</main>		
		<?php include('pieMenu.php'); ?>	
	</body>
</html>
<!--
https://www.silocreativo.com/crea-ventanas-modales-de-forma-sencilla-con-el-elemento-html/
	<button onclick="window.modal1.showModal();">Abrir ventana modal</button>

	<dialog id="modal1">
	   <h2>Este es el título de mi ventana modal</h2>
	   <p>Este es un texto de ejemplo dentro de una ventana modal</p>
	   <button onclick="window.modal1.close();">Cerrar</button>
	</dialog>


Estilo de modal
-->
<?php  } else {	header("Location: ../../index.php");}  ?>