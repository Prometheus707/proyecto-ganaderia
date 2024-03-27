<!--  https://fontawesome.com/v4/icons/   -->
<?php 
include('../../include/parametros_index.php'); 
date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d");
?>
<div class="wrapper">
	<nav class="main-header navbar navbar-expand navbar-light">
		<ul class="navbar-nav">
			<li class="nav-item d-none d-sm-inline-block ">
				<li class="nav-item active">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button">
						<i class="fa fa-list" aria-hidden="true"></i>
					</a>
				</li>
				<a class="nav-link active"><h6>RESGITRO DE UNIDADES PRODUCTIVAS - <?php echo utf8_decode($_SESSION['usuario_Logeado'])." - ".utf8_decode($_SESSION['nombre_rol']); ?></h6></a>
			</li>
		</ul>
	</nav>	
	<aside class="main-sidebar sidebar-light-primary elevation-4">
		<!-- Brand Logo -->
		<a class="brand-link">
			<center>
				<img src="../../imagenes/logoGeernSena.png" width="60px" height="60px" ><br>
			</center>
		</a>
		<div class="sidebar">
			<br>
			<!--  <a class="brand-link"><center><h5>SIA</h5></center></a>  -->
			<nav class="mt-0">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item ">
						<a href="inicio.php" class="nav-link bg-warning active"> <!--  GREEN -->
							<i class="fa fa-refresh" aria-hidden="true"></i>
							<p>&nbsp;&nbsp;&nbsp;Inicio</p>
						</a>
					</li>
					<li class="nav-item has-treeview active">
						<a href="#" class="nav-link bg-warning active"> <!--  GEEEN -->
							<i class="fa fa-key" aria-hidden="true"></i>
							<p>&nbsp;&nbsp;&nbsp;Permisos<i class="right fa fa-sort"></i></p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="encargados.php" class="nav-link ">
									<i class="fa fa-key"></i>
									<p>permisos</p>
								</a>
							</li>
						</ul>
					</li>					
					<li class="nav-item has-treeview active">
						<a href="#" class="nav-link bg-warning active"> <!--  GEEEN -->
							<i class="fa fa-user-circle-o" aria-hidden="true"></i>
							<p>&nbsp;&nbsp;&nbsp;Usuarios<i class="right fa fa-sort"></i></p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="usuarios.php" class="nav-link ">
									<i class="fa fa-user-circle-o"></i>
									<p>Usuarios</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item has-treeview active">
						<a href="#" class="nav-link bg-warning active"> <!--  GEEEN -->
							<i class="fa fa-user-circle-o" aria-hidden="true"></i>
							<p>&nbsp;&nbsp;&nbsp;Unidades<i class="right fa fa-sort"></i></p>
						</a>
						<!--
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="dieta|.php" class="nav-link ">
									<i class="fa fa-check-square-o" aria-hidden="true"></i>
									<p>Dieta</p>
								</a>
							</li>
						</ul>						
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="raza.php" class="nav-link ">
									<i class="fa fa-check-square-o" aria-hidden="true"></i>
									<p>Raza</p>
								</a>
							</li>
						</ul>
						-->
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="unidades.php" class="nav-link ">
									<i class="fa fa-user-circle-o"></i>
									<p>Unidad</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="animal.php" class="nav-link ">
									<i class="fa fa-user-circle-o"></i>
									<p>Animal</p>
								</a>
							</li>
						</ul>						
					</li>
					<li class="nav-item has-treeview active">
						<a href="#" class="nav-link bg-warning  active"> <!--  azul -->
							<i class="fa fa fa-sign-out" aria-hidden="true"></i>
							<p>&nbsp;&nbsp;&nbsp;Historial<i class="right fa fa-sort"></i></p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="history.php" class="nav-link active" style="cursor:pointer;" title='Salir'>
									<i class="fa fa-window-close"></i>
									<p>&nbsp;&nbsp;history</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="tableroVista.php" class="nav-link active" style="cursor:pointer;" title='Salir'>
									<i class="fa fa-window-close"></i>
									<p>&nbsp;&nbsp;Tablero</p>
								</a>
							</li>
						</ul>
					</li>										
					<li class="nav-item has-treeview active">
						<a href="#" class="nav-link bg-warning  active"> <!--  azul -->
							<i class="fa fa fa-sign-out" aria-hidden="true"></i>
							<p>&nbsp;&nbsp;&nbsp;Salir<i class="right fa fa-sort"></i></p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="../../include/ctrlindex.php?action=salir" class="nav-link active" style="cursor:pointer;" title='Salir'>
									<i class="fa fa-window-close"></i>
									<p>&nbsp;&nbsp;Salir</p>
								</a>
							</li>
						</ul>
					</li>													
				</ul>
			</nav>
		</div>
	</aside>   <!--  https://fontawesome.com/v4/icons/  -->
	<div class="content-wrapper">
		<div class="content-header">		