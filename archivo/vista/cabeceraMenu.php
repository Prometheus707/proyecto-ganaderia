<!--  https://fontawesome.com/v4/icons/   -->
<?php 
include('../../include/parametros_index.php'); 
date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d");
//include("../vista/updateUsuario.php");
?>
<div class="wrapper">
	<nav class="main-header navbar navbar-expand navbar-light">
    <div class="container-fluid">
        <ul class="navbar-nav w-100 justify-content-between align-items-center">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fa fa-list" aria-hidden="true"></i>
                </a>
            </li>
			<!-- <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
					<i class="fa-regular fa-user"></i>
				</a>
                <div class="dropdown-menu dropdown-menu-end p-3" style="margin-right: -100px;">
                    <div class="text-center mb-3">
                        <img src="https://definicion.de/wp-content/uploads/2019/07/perfil-de-usuario.png" class="img-thumbnail rounded-circle" style="width: 80px; height: 80px; object-fit: cover;" alt="Foto usuario">
                    </div>
                    <div class="text-center">
                        <p class="mb-1"><?php //echo $_SESSION['nombre_rol'] ?></p>
                        <p class="mb-2"><?php //dsxxecho $_SESSION['usuario_Logeado'] ?></p>
                        <div class="d-flex justify-content-center">
                            <button class='btn btn-warning btn-sm me-2' id='btnActualizarUsuario' data-toggle='modal' data-target='#updateUser' title="Actualizar">
                                <i class='fa-solid fa-pen-to-square'></i>
                            </button>
                            <button class='btn btn-danger btn-sm' title="Salir al inicio">
                                <a href="../../include/ctrlindex.php?action=salir" class="text-white">
                                    <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </li> -->
            <li class="nav-item flex-grow-1 text-start">
                <a class="nav-link active">
                    <h6 class="mb-0">GANADERIA LA PALMA</h6>
                </a>
            </li>
        </ul>
    </div>
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
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="actualizarUsuario.php" id="pagActualizarUsu" class="nav-link ">
									<i class="fa fa-user-circle-o"></i>
									<p>Actualizar usuario</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item has-treeview active">
						<a href="#" class="nav-link bg-warning active"> <!--  GEEEN -->
							<i class="fa fa-user-circle-o" aria-hidden="true"></i>
							<p>&nbsp;&nbsp;&nbsp;Unidades<i class="right fa fa-sort"></i></p>
						</a>
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
								<a href="areass.php" class="nav-link " >
									<i class="fa fa-user-circle-o"></i>
									<p>Area</p>
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
								<a href="tableroAlertasCopy.php" class="nav-link active" style="cursor:pointer;" title='Salir'>
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