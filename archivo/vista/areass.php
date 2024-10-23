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
		<script src="../../herramientas/js/areas.js" type="text/javascript" ></script>	
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<?php include('cabeceraMenu.php');?>
		<?php include('areas.php');?>
		<main>					
			<div class="card card-success">
				<div class="card-header">
					<h3 class="card-title"><b>FORMULARIO AREAS</b></h3>
				</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2" >
                            <input type='text' name='dato_txt' id='dato_txt_area' title='Dato a buscar' placeholder='Dato a buscar' class="form-control mb-2 mr-sm-2 mb-sm-0" >
                        </div>
                        <div class="col-sm-2" >
                            <button type="button" name='btn_Buscar' id='btn_Buscar_Area'  <?php echo $var_class_button_warnigB; ?>  >
                            <i class="fa fa-search-plus" aria-hidden="true"></i></button>
                        </div>
                        <div class="col-sm-2" >
                            <button type="button" name='btn_Nuevo' id='btn_Nuevo_area'  <?php echo $var_class_button_warnigN; ?> data-toggle="modal" data-target="#addArea"  >
                            <i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>		
                    </div>
                </div>
				<!-- inicio tabla --->
				<div class="table-responsive">
					<table id="areasList"  data-order='[[ 3, "asc" ]]' data-page-length='10'  class="table table-sm table-striped table-hover table-bordered" >
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
