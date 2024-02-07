<?php
header('Cache-Control: no-cache, must-revalidate');
include('../../include/parametros_index.php');
date_default_timezone_set('America/Bogota');
include('../../include/conex.php');
session_start();
$conn=Conectarse();
$horaTime = date("H:i:s");
switch ($_REQUEST['action']) 
	{
		case 'buscarID':
			$jTableResult = array();
			    $jTableResult['idAnimalHistorial']="";
				$jTableResult['codAnimal']="";
				$jTableResult['nombreAnimal']="";
				$jTableResult['idUnidad_FK']="";
				$jTableResult['nombreUnidadPro']="";	
				$jTableResult['idnombreRazaHistorial']="";
				$jTableResult['nombreRazaHistorial']="";
				$query = "SELECT animales.idAnimal, animales.idRaza_FK, animales.codAnimal, animales.nombreAnimal, animales.idUnidad_FK,
				unidades.nombreUnidadPro 
				FROM  animales INNER JOIN  unidades ON unidades.idUnidadPro = animales.idUnidad_FK  
				WHERE animales.idAnimal='".$_POST['idAnimalBusqueda']."'; ";
				$resultado = mysqli_query($conn, $query);
				$numero = mysqli_num_rows($resultado);
				if($numero==0){
						$jTableResult['listaAnimales']="<thead><tr><th scope='col'>&nbsp;&nbsp&nbsp;&nbsp;NO EXISTEN COINCIDIENCIAS</th></tr></thead>";
						$jTableResult['msj']= "NO SE ENCONTRARON COINCIDENCIAS.";
						$jTableResult['result']= "0";						
					}
				else
					{//
						while($registro = mysqli_fetch_array($resultado))
							{
								
								$jTableResult['codAnimal']=$registro['codAnimal'];
								$jTableResult['idAnimalHistorial']=$registro['idAnimal'];
								$jTableResult['nombreAnimal']=$registro['nombreAnimal'];
								$jTableResult['idUnidad_FK']=$registro['idUnidad_FK'];
								$jTableResult['nombreUnidadPro']=$registro['nombreUnidadPro'];	
								$jTableResult['idnombreRazaHistorial']=$registro['idRaza_FK'];	
							}
					}
				
				//BUSCAR LA RAZA
				$query=" SELECT nombreRaza from raza where idRaza='".$jTableResult['idnombreRazaHistorial']."';"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['nombreRazaHistorial']=$registro['nombreRaza']; //cambiar datos por los de la tabla
					}		
			print json_encode($jTableResult);
		break;
		case 'listarAnimales':
			$jTableResult = array();
				$jTableResult['msj']="";
				$jTableResult['result']="";
				$jTableResult['cantidad']="";
				$jTableResult['listaAnimales']="";
				$var_dato = "%".$_POST['dato_txt']."%";
				$query = "SELECT animales.idAnimal, animales.codAnimal, animales.nombreAnimal, animales.idUnidad_FK,   unidades.nombreUnidadPro 
				FROM  animales INNER JOIN  unidades ON unidades.idUnidadPro = animales.idUnidad_FK  
				WHERE animales.codAnimal 	like '".$var_dato."' 
				OR animales.nombreAnimal 	like '".$var_dato."' 
				OR unidades.nombreUnidadPro like '".$var_dato."';";
				$resultado = mysqli_query($conn, $query);
				$numero = mysqli_num_rows($resultado);
				if($numero==0){
						$jTableResult['listaAnimales']="<thead><tr><th scope='col'>&nbsp;&nbsp&nbsp;&nbsp;NO EXISTEN COINCIDIENCIAS</th></tr></thead>";
						$jTableResult['msj']= "NO SE ENCONTRARON COINCIDENCIAS.";
						$jTableResult['result']= "0";						
					}
				else
					{
						$jTableResult['listaAnimales'].="<thead><tr><th scope='col'>Codigo</th><th scope='col'>Nombre</th><th scope='col'>Op</th></tr></thead>";
						while($registro = mysqli_fetch_array($resultado))
							{
								$jTableResult['listaAnimales'].="
								<tr >
									<td width='3%' >".$registro['codAnimal']."</td>
									<td width='20%'>".utf8_decode($registro['nombreAnimal'])."</td>
									<td>
										<button 
											id='btnVerHC'
											class='btn btn-success btn-sm'											
											class='btn btn-success'
											data-toggle='modal' 
											data-idanimal='".$registro['idAnimal']."' 
											title='Ver Historial ( ".$registro['nombreAnimal']." )'>
											<i class='fa fa-folder-o' aria-hidden='true'></i> Historial
										</button>
									</td>
								</tr>";
								$jTableResult['result']="1";
							}								
					}	
			print json_encode($jTableResult);
		break;
	}		
mysqli_close($conn);
?> 