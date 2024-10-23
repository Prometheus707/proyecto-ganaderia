<?php 
header('Cache-Control: no-cache, must-revalidate'); 
date_default_timezone_set('America/Bogota');
include_once(dirname(__FILE__).'/include/parametros_index.php');
$fecha = date("Y-m-d");
?>
<html lang='es'>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>		
		<title><?php echo $title_PagInicio; ?></title>
		<meta   name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
		<script src='https://code.jquery.com/jquery-3.7.0.js' ></script>
		<link   rel='stylesheet' href='herramientas/dist/css/adminlte.min.css'>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
		<link   rel='stylesheet' href='herramientas/plugins/fontawesome-free/css/all.min.css'>
		<link   rel='stylesheet' href='herramientas/plugins/icheck-bootstrap/icheck-bootstrap.min.css'>
		<link   rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
		<link   rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700' >
		<link 	rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' integrity='sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT' crossorigin='anonymous'>
		<script src='herramientas/js/indexJS-01.js' type='text/javascript' ></script>		
		<!-- <script src='herramientas/js/pruebaGeneral.js' type='text/javascript' ></script>		 -->
		<script type='text/javascript' src='herramientas/lib/alertify.js'></script>
		<link   rel='stylesheet' href='herramientas/alertify.js/alertify.core.css' />
		<link   rel='stylesheet' href='herramientas/alertify.js/alertify.default.css' />
	</head>
	<body class='hold-transition login-page'>
		<div class="container"> 
			<!--  inicio modal registro  -->
			<div class="modal fade" id="popupRegistro">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- cabecera del diálogo -->
						<div class="modal-header">
							<h6 class="modal-title">NUEVO USUARIO</h6>
							<button type="button" class="close" data-dismiss="modal">X</button>
						</div>
						
						<!-- cuerpo del diálogo -->
						<div style="margin-bottom:8px" class="input-group">
							<div class="modal-body">
								<div class="row mt-1">
									<div class="col"> <!-- <h6 class="modal-title">Fecha</h6>-->
										<input type="date" class="form-control" placeholder="fecha hoy" id="fecha" value='<?php echo $fecha; ?>' readonly>
									</div>
								</div>
								<div class="row mt-1">
									<div class="col">
										<input type="text" class="form-control"  placeholder="Identificacion" id="identificacion_registro" title="Identificacion del usuario" onkeypress='return validaNumericos(event)' >
									</div>
								</div>
								<div class="row mt-1">
									<div class="col">
										<input type="text" class="form-control" placeholder="Nombre" id="nombre_registro" name="nombre_registro" title="Nombre del usuario"  >
									</div>
								</div>
								<div class="row mt-1">
									<div class="col">
										<input type="text" class="form-control" placeholder="Apellido" id="apellido_registro" name="apellido_registro" title="Apellido del usuario">
									</div>
								</div>
								<div class="row mt-1">
									<div class="col">
										<input type="number" class="form-control" placeholder="Telefono/Celular" id="telefono_registro" title="Telefono personal del usuario"  onkeypress='return validaNumericos(event)'>
									</div>
								</div>
								<div class="row mt-1">									
									<div class="col">
										<input type="email" class="form-control" placeholder="Correo Electronico" id="correo_registro" name="correo_registro" title="Correo personal del usuario">
									</div>
								</div>												
								<div class='row  mt-1'>
									<div class="col">
										<select class="form-select" id="slctRegionalUsuario" aria-label="Default select example">
							
										</select>
										<input type="text" id="idReginalUsu" hidden>
									</div>
								</div>
								<div class='row  mt-1'>
									<div class="col">
										<select class="form-select" id="slctCentroUsuario" aria-label="Default select example">
							
										</select>
										<input type="text" id="idCentroUsu" hidden>
									</div>
								</div>
								<div class='row  mt-1'>
									<div class="col">
										<select class="form-select" id="areaUsu" aria-label="Default select example">
							
										</select>
										<input type="text" id="idAreaUsu" hidden ">
									</div>
								</div>
								<div class="row mt-1">									
									<div class="col">
										<input type="password" class="form-control" placeholder="Clave" id="clave_registro" name="clave_registro" title="Clave unica creada por el usuario">
									</div>
								</div>
								<div class='row' class="col-sm-10 text-center">
									<div id='divRespuestasRegistoUsu' class="col-sm-12 text-center" class='col-20' ></div>
								</div>
								<br>
							</div>
						</div>
						
						<!-- pie del diálogo -->
						<div class="modal-footer">
							<button type="button" id="btn_Registrar_Usuario" name="btn_Registrar_Usuario" <?php echo $var_class_button_formulario; ?> >Registrar</button>
							<button type="button" <?php echo $var_class_button_popup ;   ?> data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
			<!--  cierra modal registro --> 
			
			
			<!--    INICIO NUEVA CLAVE    -->
			<div class="modal fade" id="popupNuevaClave" >
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<!-- cabecera del diálogo -->
							<div class="modal-header">
								<h5 class="modal-title">Nueva Clave</h5>
								<button type="button" class="close" data-dismiss="modal" >X</button>
							</div>
						</div>
						<!-- cuerpo del diálogo -->
						<div class="modal-body">
							<form id="loginform" class="form-horizontal" role="form" action="recuperar_correo.php" method="POST" autocomplete="off">
								<div style="margin-bottom: 25px" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input id="email_recuperar" type="email" class="form-control" name="email" placeholder="correo" required>                                        
								</div>
							</form>
						</div>
						<!-- pie del diálogo -->
						<div class="modal-footer">
							<button id="btn-login" type="submit"  <?php echo $var_class_button_formulario; ?> >Crear</button>
							<button type="button"  <?php echo $var_class_button_popup ;  ?> data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
			<!--    CIERRE NUEVA CLAVE    -->
			
			<!--    INICIO AL INICIO DE SESION   -->
			<center>
				<div class='login-box' >
					<div class='card' >
						<div class='card-body login-card-body'>
							<div class="container-fluid">
								<header border="1" class="page-header">
									<div class="row" >       
										<div class="col  input-group mb-2">         
											<div class="card-img-top" >
												<img src="imagenes/logoCabeceraSena.png" width='60px' height='60px'>            
											</div>          
										</div>
									</div>
									<div class='input-group mb-3'>
										<div class="card-img-top" >
											<h5>REGISTRO DE UNIDADES PRODUCTIVAS</h5>
										</div>
									</div>
								</header>
							</div>
							<!--  inicio cuerpo del modal  --->
							<div class='row' >
								<div class='input-group mb-3'>
									<input type='number' name='inputUsuario' id='inputUsuario' class='form-control' title='Nombre el Usuario' placeholder='Usuario' onkeypress='return validaNumericos(event)' > 
									<div class='input-group-append'>
										<div class='input-group-text'>
											<i class="fas fa-address-card"></i>
										</div>
									</div>
								</div>
							</div>
							<div class='row' >
								<div class='input-group mb-3'>
									<input name='inputClave' id='inputClave' type='password' class='form-control' title='Clave de Usuario' placeholder='Clave' >
									<div class='input-group-append'>
										<div class='input-group-text'>
											<span class='fas fa-lock'></span>
										</div>
									</div>	
								</div>
							</div>
							<div class='row' class="d-grid gap-2 text-center">
								<div id='divRespuestas' class="col-sm-10 text-center" class='col-10' >
								</div>
							</div>
							<div class='row' >
								<div class="d-grid gap-1 text-center mx-auto">
									<button name='btnEntrar' id='btnEntrar' <?php echo $var_class_button_formulario; ?> data-toggle="modal" title='Entrar al Sistema' data-target="#">
										Ingresar
									</button>
									<button name='btnRegistrar' id='btnRegistrar' <?php echo $var_class_button_formulario; ?> data-toggle="modal" title='Registra nuevo usuario' class="btn btn-success" data-toggle="modal" data-target="#popupRegistro">
										Registrase
									</button>
									<button name='btnNuevaClave' id='btnNuevaClave' <?php echo $var_class_button_formulario; ?> data-toggle="modal" title='Nueva clave' > <!--  data-target="#popupNuevaClave"  --->
										Recuperar
									</button>
								</div>						
							</div>
							<br>
							<header class="page-header">
								<div class="row" >
									<div class="text-center" >
										Sena Centro Agropecuario<br>Regional Cauca Version 0.1
									</div>	
								</div>								
							</header>				
						</div>
					</div>
				</div>
			</center>
		</div>
		<script src='herramientas/plugins/bootstrap/js/bootstrap.bundle.min.js'></script>
		<script src='herramientas/dist/js/adminlte.min.js'></script> 
		<?php
			//https://www.tutorialesprogramacionya.com/bootstrap4ya/detalleconcepto.php?punto=50&codigo=50&inicio=40
			//https://www.tutorialesprogramacionya.com/bootstrap4ya/detalleconcepto.php?punto=51&codigo=51&inicio=40
			//https://www.google.com/search?q=class%3D%22modal+fade%22+ejemplo&lr=lang_es&rlz=1C1ALOY_esCO1027CO1027&hl=es&biw=1366&bih=625&tbs=lr%3Alang_1es&ei=ybnyY4LnH6yCwbkP9IuqKA&ved=0ahUKEwjC74yb56L9AhUsQTABHfSFCgUQ4dUDCA8&uact=5&oq=class%3D%22modal+fade%22+ejemplo&gs_lcp=Cgxnd3Mtd2l6LXNlcnAQAzIFCCEQoAEyBQghEKABOgUIABCABDoGCAAQFhAeOgkIABAWEB4Q8QQ6CAgAEBYQHhAKSgQIQRgAUABY9RFgsxRoAHABeACAAZACiAG8C5IBBTAuOC4xmAEAoAECoAEBwAEB&sclient=gws-wiz-serp
		
			/* ENVIAR CORREO */
			//https://programacion.net/articulo/enviar_un_email_con_adjuntos_utilizando_jquery-_ajax_y_php_sin_refrescar_la_pagina_1597
		?>
	</body>
</html>
