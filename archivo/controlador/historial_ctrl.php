<?php
//http://localhost/AdminLTE/pages/UI/ribbons.html
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
				$jTableResult['codAnimal']="";
				$jTableResult['nombreAnimal']="";
				$jTableResult['idUnidad_FK']="";
				$jTableResult['nombreUnidadPro']="";
				$jTableResult['idAnimal2']="";
				$jTableResult['idAnimalFK']="";
				$jTableResult['ttlVacunas']="";
				$jTableResult['ttlServicio']="";
				$_SESSION['idAnimalCheKeo'] = $_POST['idAnimalBusqueda'];
				$query = "SELECT animales.idAnimal, animales.codAnimal, animales.nombreAnimal, animales.idUnidad_FK,
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
					{
						while($registro = mysqli_fetch_array($resultado))
							{
								$jTableResult['codAnimal']="Cod: ".$registro['codAnimal'];
								$jTableResult['nombreAnimal']="Nombre: ".$registro['nombreAnimal'];
								$jTableResult['idUnidad_FK']=$registro['idUnidad_FK'];
								$jTableResult['nombreUnidadPro']="Unidad: ".$registro['nombreUnidadPro'];	
								$jTableResult['idAnimal2']=$registro['idAnimal'];
								$jTableResult['idAnimalFK']=$registro['idAnimal'];
								$jTableResult['idAnimalCelo_fk']=$registro['idAnimal'];
							}
					}
				$query="SELECT idReproduccion from servicio WHERE codigoVacaRep='".$_POST['idAnimalBusqueda']."';";
				$resultado=mysqli_query($conn, $query);
				$numeroSer=mysqli_num_rows($resultado);
				$jTableResult['ttlServicio']=$numeroSer;
				
			print json_encode($jTableResult);
		break;
		case 'listarAnimales':
			$jTableResult = array();
				$jTableResult['msj']="";
				$jTableResult['result']="";
				$jTableResult['cantidad']="";
				$jTableResult['listaAnimales']="";
				$var_dato = "%".$_POST['dato_txt']."%";
				$varEstadoVM = $_POST['selectVM'];
				$query = "SELECT animales.idAnimal, animales.codAnimal, animales.nombreAnimal, animales.idUnidad_FK,   unidades.nombreUnidadPro 
				FROM  animales INNER JOIN  unidades ON unidades.idUnidadPro = animales.idUnidad_FK  
				WHERE ( animales.codAnimal 	like '".$var_dato."' 
				OR animales.nombreAnimal 	like '".$var_dato."' 
				OR unidades.nombreUnidadPro like '".$var_dato."' )  
				AND animales.estadoVM='".$varEstadoVM."' AND idSexo = 0;";				
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
											title='Ver Historial (".$registro['nombreAnimal'].")'>
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