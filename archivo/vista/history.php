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
		<script src="../../herramientas/js/servicioPrueba.js" type="text/javascript" ></script>
		<script src="../../herramientas/js/historialJS.js" type="text/javascript" ></script>
		<script src="../../herramientas/js/perdidaJS.js" type="text/javascript" ></script>
		<script src="../../herramientas/js/chqueoJS.js" type="text/javascript" ></script>
		<script src="../../herramientas/js/camaraJS.js" type="text/javascript" ></script>
		<script src="../../herramientas/js/fotosHistory.js" type="text/javascript"></script>
		<script src="../../herramientas/js/documentoAnimal.js" type="text/javascript"></script>
		<script src="../../herramientas/js/visorImagen.js" type="text/javascript"></script>
		<script src="../../herramientas/js/partosJS.js" type="text/javascript"></script>
		<script src="../../herramientas/js/vacunacion.js" type="text/javascript"></script>
		<script src="../../herramientas/js/vacunas.js" type="text/javascript"></script>
		<script src="../../herramientas/js/controlSanitario.js" type="text/javascript"></script>
		<script src="../../herramientas/js/animalJS.js" type="text/javascript" ></script>	
		<script src="../../herramientas/js/unidadesJS.js"  type="text/javascript" ></script>
		<script src="../../herramientas/js/especies.js"  type="text/javascript" ></script>
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
									<option value='0' >Seleccione...</option>
									<option value='1' >Vivo</option>
									<option value='0' >Descarte</option>	
								</select>
							</div>						
							<div class="col-sm-2" >
								<input type='text' name='dato_txt' id='dato_txt' title='Dato a buscar' placeholder='Dato a buscar' class="form-control mb-2 mr-sm-2 mb-sm-0" >
							</div>
							<div class="col-sm-2" >
								<button type="button" name='btn_Buscar_history' id='btn_Buscar_history'  <?php echo $var_class_button_warnigB; ?>  >
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
			<div id='containerCarpetaHistorial' style="display: none;">
				<section class="content">
					<?php include('frmChequeo.php');?>
					<?php include('reproduccionPrueba.php');?>
					<?php include('modalperdida.php');?>
					<?php include('frmPartos.php');    ?>
					<?php include('vacunacion.php');?>
					<?php include('fotosHistory.php'); ?>
					<?php include('modalVacunas.php'); ?>
					<?php include('controlSanitario.php'); ?>
					<?php include('modalAnimal.php'); ?>
					<?php include('modalUnidades.php'); ?>
					<?php include('especies.php');?>
					<?php include("modalRaza.php"); ?>
						<div class="col-md-12">
							<div class="card card-widget widget-user">
								<div class="widget-user-header" style="background-color: #29a900; color:white">
									<h5 class="widget-user-desc" id="nombreAnimal"></h5>
									<h5 class="widget-user-desc" id="nombreUnidad"></h5>
								</div>
								<div class="widget-user-image">
									<input type="text" id="idImgMain" hidden>
									<img
										id="imgAnimalH"
										class="img-circle elevation-2 zoom"
										style="width: 120px; height: 120px; border-radius: 50%;"
										src=""
										alt="User Avatar"
									/>
									<button class='btn bg-warning' id='btnAbrirFotosAnim' data-toggle="modal" data-target="#mdFotosHistory"  style='color: #fff; position:absolute; top: -5px; right: -12px; z-index: 1; border-radius: 50%;'>
									<i class="fa-regular fa-pen-to-square"></i>
                                    </button>
								</div>
								<div class="card-footer" style='height: 550px; overflow-y: auto;'>
									<a href="#" class='btn bg-warning' target="_blank" id='downloadDocumentAnimal' name="downloadDocumentAnimal" style='border-radius: 20%;'>
										<i class="fa-solid fa-file-arrow-down"></i>
                                    </a>
									<form id="pdfForm" action="../controlador/generarPdfDocument.php" method="post" style="display: none;">
										<input type="hidden" name="action" value="generarPdf">
										<input type="hidden" name="idAnimaPdf" id="idAnimaPdf">
									</form>
									<div class="row pt-5">
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
												class="info-box-icon bg-danger elevation-1" data-toggle="modal" data-target="#registroControlS">
												<i class="fa fa-stumbleupon" aria-hidden="true"></i>
												</span>
												<div class="info-box-content">
													<span class="info-box-text">CONTROL SANITARIO</span>
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-6 col-md-3">
											<div class="info-box">
												<span id="divPartos" style="cursor:pointer" class="info-box-icon bg-success elevation-1"  data-toggle="modal" data-target="#mdPartos" >
													<i class="fa fa-plus-square" aria-hidden="true"></i>
												</span>
												<div class="info-box-content">
													<span class="info-box-text">PARTOS</span>
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-6 col-md-3">
											<div class="info-box">
												<span id="divChekeo" data-toggle="modal" data-target="#mdreproduccion" style="cursor:pointer"  class="info-box-icon bg-info elevation-1">
													<i class="fa fa-hand-paper-o" aria-hidden="true"></i>
												</span>
												<div  class="info-box-content">
													<span class="info-box-text">SERVICIOS</span>
													<!-- <p id='totalServicio' name='totalServicio' ></p> -->
												</div>
											</div>
										</div>	
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
							</div>
						</div>
						<!---VISUALIZADOR FOTO DE PERFIL CUANDO DE CLICK SOBRE ELLA-->
						<div id="imageViewer" class="viewer" style="display: none; align-content:center; justify-content:center; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8); justify-content: center; align-items: center; flex-direction: column; z-index: 1000; padding-top:4rem;">
							<span class="close" style="position: absolute; top: 50px; right: 10px; font-size: 60px; color: white; cursor: pointer;">&times;</span>
							<img class="viewer-content" id="viewerImage" style="width: auto; height: 80%; max-width: 90%;">
							<div class="viewer-controls" style="margin-top: 20px; display: flex; gap: 10px;">
								<a id="viewFullImage" href="#" target="_blank" style="background-color: #FFC300; color: black; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;">Ver en otra página</a>
								<a id="downloadImage" href="#" download style="background-color: #FFC300; color: black; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;">Descargar</a>
							</div>
							<!---FIN VISUALISADOR-->
							<div class="row" >
								<div class="col-12 col-sm-6 col-md-3">
									<input type="text" class="form-control"  id="idAnimalBusqueda" name="idAnimalBusqueda"  hidden/>
									<input type="text" class="form-control"  id="codAnimalBuscado"  name="codAnimalBuscado" hidden readonly />
									<input type="text" class="form-control"  id="nomAnimalBuscado"   name="nomAnimalBuscado" hidden readonly />							
									<input type="text" class="form-control"  id="unidadBuscado"      name="unidadBuscado"   hidden readonly />							
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