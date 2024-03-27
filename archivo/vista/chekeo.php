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
<html lang="en">
	<head>
		<title>RUPS-ANIMAL</title>
		<!--
		-->
		<meta http-equiv='Cache-Control' content='no-cache, mustrevalidate'>
		<link   href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
		<script src='https://kit.fontawesome.com/459929adcc.js' crossorigin='anonymous'></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
		<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js'></script>
		<link   href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
		<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
		<?php include('head.php');?>
		<script src="../../herramientas/js/animalJS.js" type="text/javascript" ></script>	
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<?php include('cabeceraMenu.php');?>
		<main>			
			<div class="container"> 
									
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
                <!--INICIO FORMULARIO SERVICIOS--->
				<div class="container"> 
					<div class="modal fade" id="mdreproduccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-scrollable">
								<div class="modal-content">
										<div class="modal-header">
										<h5 class="modal-title" >REGISTRO DE SERVICIOS</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">X</span>
											</button>
										</div>
										<div class="modal-body">
												<div class="row">
															<div class="col-lg-4">
															<h6 class="modal-title">Codigo vaca</h6>  
															<input type="text" class="form-control" id="codigoVaca" aria-describedby="emailHelp"  readonly>
															<input type="text" class="form-control" id="idAnimal" aria-describedby="emailHelp" name="idAnimal" readonly/>
															</div>
															<div class="col-lg-4">
															<h6 class="modal-title">Nombre vaca</h6>  
															<input type="text" class="form-control" id="nombreVacaR" aria-describedby="emailHelp" readonly>
															</div>
															<div class="col-lg-4">
															<h6 class="modal-title">Raza vaca</h6>  
															<input type="text" class="form-control" id="razaVacaR" aria-describedby="emailHelp" readonly>
															<input type="text" class="form-control" id="idRazaV" aria-describedby="emailHelp" name="idAnimal" readonly/>
															</div>
													</div><br>
												
													<div class="row">
															<div class="col-lg-6">
															<h6 class="modal-title">Fecha de celo</h6>
															<input type="text" id="fechaCeloVaca" class="form-control" required  >
															</div>
															<div class="col-lg-6">
															<h6 class="modal-title">Servido</h6> 
															<select class="form-select" aria-label="Default select example" id="servido">
																<option value="0">Seleccione</option>
																<option value="1" id="si">Si</option>
																<option value="2" id="no">No</option>
															</select>
															</div>
													</div><br>
													<div class="row">
							
															<div class="col-lg-12" id="metodo">
															<h6 class="modal-title">Monta/inseminacion</h6> 
															<select class="form-select" aria-label="Default select example" id="metodos" name="metodos">
																<option value="0">Seleccione</option>
																<option value="1" >Monta</option>
																<option value="2" >Inseminacion</option>
															</select>
															</div>
													</div><br>
													<div class="row">
														<div class="col-lg-4" id="codigoToro">
														<h6 class="modal-title" >Codigo registro Toro</h6>  
														<select class="form-select" aria-label="Default select example" id="codigoRegistroT"  >
														</select>
														<input type="text" class="form-control" id="idToroServ" aria-describedby="emailHelp" name="idAnimal" readonly/>
														</div>
														<div class="col-lg-4" id="nombreToro">
														<h6 class="modal-title">Nombre toro</h6>  
														<input type="text" class="form-control" id="nomToro" aria-describedby="emailHelp" readonly>
														</div>
														<div class="col-lg-4" id="razaToro">
														<h6 class="modal-title">Raza toro</h6>  
														<input type="text" class="form-control" id="razToro" aria-describedby="emailHelp"  readonly>
														<input type="text" class="form-control" id="idRazaServ" aria-describedby="emailHelp" name="idRazaServ" readonly/>
														</div>
													</div><br>
													<div class="row" >
														<div class="col-sm-4">
															<button type="button" name="btnPajila" id="btnPajila" class="btn btn-block btn-warning btn-sm btn-sm; cursor:pointer;" data-toggle="modal" data-target="#modalPajilla">
															<i class="fa fa-registered" aria-hidden="true"></i>pajilla</i></button>
														</div>
													</div><br>
													<div class="row" >
														<div class="col-lg-6" id="responsableR">
															<h6 class="modal-title">Responsable</h6> 
															<input type="text" class="form-control" id="responsableRep" aria-describedby="emailHelp"  >
															<input type="text" class="form-control" id="idresponsableRep" aria-describedby="emailHelp"  >
														</div>
														<div class="col-lg-6">
																<div class="form-group"> 
																	<h6 class="modal-title" id="observaciones">Observaciones</h6> 
																	<textarea style="width:95%" class="form-control" rows="5" id="observacionesRep"></textarea>
																</div> 
														</div>
													</div>
										</div>
										<div class="modal-footer">
											<div class="modal-footer">
												<button type="button" class="btn btn-primary" id="btnguardarCelo">GUARDAR</button>
												<button type="button" class="btn btn-danger"   id="btncerrarReproduccion" data-dismiss="modal">CERRAR</button>
											</div>
										</div>
								</div>
								
						</div>	
					</div>
				
			</div>	
			<!--FIN FORMULARIO SERVICIOS--->	
				
			<div class="card card-success">
				<div class="card-header">
					<h3 class="card-title"><b>FORMULARIO CHEKEO</b></h3>
				</div>
				<?php include('controlPanel.php');?>
				<!-- inicio tabla --->
				<div class="table-responsive">
					<table id="tbServicio"  data-order='[[ 3, "asc" ]]' data-page-length='10'  class="table table-sm table-striped table-hover table-bordered" >
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
