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
$fecha_Banner = date("Y-m-d"); 
$fechaReg = date("Y-m-d h:m"); 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>RUPS-SERVICIO</title><?php include('head.php');?>
		<!--
		<script src="../../herramientas/js/servicioJS.js" type="text/javascript" ></script>
		-->
		<script src="../../herramientas/js/servicioPrueba.js" type="text/javascript" ></script>
		<script src="../../herramientas/js/historialJS.js" type="text/javascript" ></script>
		<script src="../../herramientas/js/perdidaJS.js" type="text/javascript" ></script>
		<script src="../../herramientas/js/chqueoJS.js" type="text/javascript" ></script>
		<script src="../../herramientas/js/camaraJS.js" type="text/javascript" ></script>
		
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<?php include('cabeceraMenu.php');?>
		<main>
			<div id='containerBqd' class="card card-success" >				
				<div class="card-header">
					<h3 class="card-title"><b>HISTORIAL CLINICO</b></h3>
				</div>
				<!--  INICIO REMPLAZO CONTROL PANEL  --->	
					<div class="card-body">
						<div class="row">
							<div class="col-sm-2" >
								<select  name='selectVM' id='selectVM' title='Estado Vivo/Muerto' class="form-control " >
									<option value='0' >Seleccione:.</option>
									<option value='1' >Vivo</option>
									<option value='0' >Descarte</option>	
								</select>
							</div>						
							<div class="col-sm-2" >
								<input type='text' name='dato_txt' id='dato_txt' title='Dato a buscar' placeholder='Dato a buscar' class="form-control mb-2 mr-sm-2 mb-sm-0" >
							</div>
							<div class="col-sm-2" >
								<button type="button" name='btn_Buscar' id='btn_Buscar'  <?php echo $var_class_button_warnigB; ?>  >
								<i class="fa fa-search-plus" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
				<!--  CIERRE REMPLAZO CONTROL PANEL  --->	
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
					<?php //include('registroPajilla.php');   ?>
					<?php include('frmChequeo.php');?>
					<?php include('reproduccionPrueba.php');?>
					<?php include('listaCelo.php');?>
					<?php include('modalperdida.php');?>
					<?php //include('fallecimientos.php');    ?>
					<?php //include('modalperdida.php');?>
					<?php //include('registroServicio.php');  ?>
					<div class="container-fluid">
						<div class="row mt-3">
							<div class="col-sm-3">
								<div class="card card-widget widget-user">
									<div class="widget-user-header text-white" style="background: url('../../imagenes/animals/001.png') center;">
									</div>
								</div>
								<div class="card card-widget widget-user-2">
									<div class="widget-user-header bg-warning">
										<h6 class="widget-user text-left">
											<p id="nombreAnimal" ></p>
											<p id="nombreUnidad" ></p>
										</h6>
										<button type="button" name='btnNuevaFoto' id='btnNuevaFoto'  <?php echo $var_class_button_warnigB; ?>  >
											+ Nuevo
										</button>
									</div>
								</div>
							</div>
						</div>
						<div class="row" >
							<div class="col-12 col-sm-6 col-md-3">
								<input type="hidden" class="form-control"  id="idAnimalBusqueda" name="idAnimalBusqueda"  />
								<input type="hidden" class="form-control"  id="codAnimalBuscado"  name="codAnimalBuscado" readonly />
								<input type="hidden" class="form-control"  id="nomAnimalBuscado"   name="nomAnimalBuscado" readonly />							
								<input type="hidden" class="form-control"  id="unidadBuscado"      name="unidadBuscado" readonly />							
							</div>
						</div>						
						<div class="row">
							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box">
									<span name="divVacunas" id="divVacunas" style="cursor:pointer" class="info-box-icon bg-info elevation-1" data-toggle="modal" data-target="#registroVacunacion" >
										<i class="fa fa-assistive-listening-systems" aria-hidden="true"></i>
									</span>
									<div class="info-box-content">
										<span class="info-box-text">VACUNACIÓN</span><p id='ttlVacunas' name='ttlVacunas' ></p>
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
									<span id="divPartos" style="cursor:pointer" class="info-box-icon bg-success elevation-1"  data-toggle="modal" data-target="#mdChequeo" >
										<i class="fa fa-plus-square" aria-hidden="true"></i>
									</span>
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
										<span class="info-box-text">Chequeo</span>
										<p id='totalServicio' name='totalServicio' ></p>
									</div>
								</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box">
									<span id="divFallecimientos" data-toggle="modal" data-target="#modalfallecimiento" style="cursor:pointer" class="info-box-icon bg-info elevation-1">
										<i class="fa fa-facebook" aria-hidden="true"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Fallecimientos</span>
									</div>
								</div>
							</div>
							
							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box">
									<span id="divPerdidas" data-toggle="modal" data-target="#modalperdi" style="cursor:pointer" class="info-box-icon bg-info elevation-1">
										<i class="fa fa-hand-paper-o" aria-hidden="true"></i>
									</span>
									<div  class="info-box-content">
										<span class="info-box-text">Novedades</span>
										<p id='ttlPerdidas' name='ttlPerdidas' ></p>
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
<?php  } else {	header("Location: ../../index.php");}  ?>