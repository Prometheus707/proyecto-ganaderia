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
    <script src="../../herramientas/js/indexJS-01.js"></script>
    <?php include('head.php');?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <?php include('cabeceraMenu.php');?>
    <center>
		<!---FORMULARIO VERIFICACION--->
        <div class="login-box">
            <div class="card">
                <div class="card-body login-card-body">
                    <div class="container-fluid">
                        <header border="1" class="page-header">
                    </div>
                    <!--  inicio cuerpo del modal  --->
                    <div class="row">
                    	<label>Digite su contraseña.</label>
						<input type="button" id="idUsVerifiUp" value="<?php echo $_SESSION['id_Usu'] ?>" hidden>
                        <div class="input-group mb-3">
                            <input name="inputClaveUpdate" id="inputClaveUpdate" type="password" class="form-control" title="Clave de Usuario" autocomplete="off">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>	
                        </div>
                    </div>
                    <div class="row">
                        <div id="divRespuestas" class="col-sm-10 text-center">
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-grid gap-1 text-center mx-auto">
                            <button name="validUsuUp" id="validUsuUp" class="btn btn-success btn-sm; cursor:pointer;" data-toggle="modal" title="Entrar al Sistema" data-target="#">
                                Validar
                            </button>
                        </div>						
                    </div>
                    <br>			
                </div>
            </div>
        </div>
		<!---FIN FORMULARIO VERIFICACION--->
		<!---MODAL ACTUALIZACION USUARIO--->
        <div class="modal fade" id="updateUser">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- cabecera del diálogo -->
						<div class="modal-header">
							<h6 class="modal-title">ACTUALIZAR USUARIO</h6>
							<button type="button" class="close" data-bs-dismiss="modal">X</button>
						</div>
						<!-- cuerpo del diálogo -->
						<div style="margin-bottom:8px" class="input-group">
							<div class="modal-body">
                                <div class="row mt-1">
									<div class="col">
										<input type="text" class="form-control"  value="" placeholder="Identificacion" id="idUserUpdate" title="Identificacion del usuario" onkeypress='return validaNumericos(event)'  hidden>
									</div>
								</div>									
								<div class="row mt-1">
									<div class="col">
										<h6 class="modal-title"><strong>Numero identificación</strong></h6> 
										<input type="text" class="form-control"  value="" placeholder="Identificacion" id="identificacion_update_user" title="Identificacion del usuario" onkeypress='return validaNumericos(event)' readonly>
									</div>
								</div>
								<div class="row mt-1">
									<div class="col">
										<h6 class="modal-title"><strong>Nombre</strong></h6> 
										<input type="text" class="form-control" value="" placeholder="Nombre" id="nombre_update_user" name="nombre_update_user" title="Nombre del usuario"  >
									</div>
								</div>
								<div class="row mt-1">
									<div class="col">
										<h6 class="modal-title"><strong>Apellido</strong></h6> 
										<input type="text" class="form-control" value="" placeholder="Apellido" id="apellido_update_user" name="apellido_update_user" title="Apellido del usuario">
									</div>
								</div>
								<div class="row mt-1">
									<div class="col">
										<h6 class="modal-title"><strong>Numero celular</strong></h6>
										<input type="number" class="form-control" value="" placeholder="Telefono/Celular" id="telefono_update_user" title="Telefono personal del usuario"  onkeypress='return validaNumericos(event)'>
									</div>
								</div>
								<div class="row mt-1">									
									<div class="col">
										<h6 class="modal-title"><strong>Correo</strong></h6>
										<input type="email" class="form-control"  value="" placeholder="Correo Electronico" id="correo_update_user" name="correo_update_user" title="Correo personal del usuario">
									</div>
								</div>	
								<div class='row  mt-1'>
									<div class="col">
										<h6 class="modal-title"><strong>Regional</strong></h6>
										<select class="form-select" id="slctRegionalUsuarioUptd" aria-label="Default select example">
							
										</select>
										<input type="text" id="idReginalUsuUptd" hidden>
									</div>
								</div>
								<div class='row  mt-1'>
									<div class="col">
										<h6 class="modal-title"><strong>Centro</strong></h6>
										<select class="form-select" id="slctCentroUsuarioUptd" aria-label="Default select example">
							
										</select>
										<input type="text" id="idCentroUsuUptd" hidden>
									</div>
								</div>		
								<div class='row  mt-1'>
									<div class="col">
										<h6 class="modal-title"><strong>Área</strong></h6>
										<select class="form-select" id="slctAreaUsuarioUptd" aria-label="Default select example">
							
										</select>
										<input type="text" id="idAreaUsuUptd" hidden>
									</div>
								</div>
																			
								<!-- <div class="row mt-1">									
									<div class="col">
										<input type="password" class="form-control"  placeholder="Clave" id="clave_update_user" name="clave_update_user" title="Clave unica por el usuario">
									</div>
								</div> -->
								<br>
							</div>
						</div>
						
						<!-- pie del diálogo -->
						<div class="modal-footer">
							<button type="button" id="btn_Actualizar_Usuario" name="btn_Actualizar_Usuario" <?php echo $var_class_button_formulario; ?> >Actualizar</button>
							<button type="button" <?php echo $var_class_button_popup ;   ?> data-bs-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
			<!---FIN MODAL ACTUALIZACION USUARIO--->
    </center>
    <?php include('pieMenu.php'); ?>		
</body>
</html>

<?php  } else { header("Location: ../../index.php");} ?>