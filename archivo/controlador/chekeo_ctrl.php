<?php
header('Cache-Control: no-cache, must-revalidate');
include('../../include/parametros_index.php');
date_default_timezone_set('America/Bogota');
include('../../include/conex.php');
session_start();
$conn=Conectarse();
$horaTime = date("H:i:s");;
switch ($_REQUEST['action']) 
	{


		/*case 'listarServicioR':
			$jTableResult = array();
				$jTableResult['msj']="";
				$jTableResult['result']="";
				$jTableResult['']="";
				$jTableResult['listaAnimales']="";
				$var_dato = "%".$_POST['dato_txt']."%";
				echo $query = "SELECT codigoVacaRep, nombreVacaRep, razaVacaRep FROM servicio 
				WHERE codigoVacaRep like '".$var_dato."' 
				OR nombreVacaRep like '".$var_dato."' 
				OR razaVacaRep like '".$var_dato."';"; 
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
									<td width='3%' >".$registro['codigoVacaRep']."</td>
									<td width='20%'>".$registro['nombreVacaRep']."</td>
									<td>
										<button 
											id='btnEdiarAnimal'
											class='btn btn-success btn-sm'											
											class='btn btn-success'
											data-toggle='modal' 
											data-idAnimal='".$registro['idAnimal']."' >
											$varIconoEditar Editar
										</button>
									</td>
								</tr>";
								$jTableResult['result']="1";
							}								
					}	
			print json_encode($jTableResult);
		break;		*/
	}		
mysqli_close($conn);
?> 