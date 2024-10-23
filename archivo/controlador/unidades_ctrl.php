<?php
header('Cache-Control: no-cache, must-revalidate');
include('../../include/parametros_index.php');
date_default_timezone_set('America/Bogota');
include('../../include/conex.php');
session_start();
$conn=Conectarse();
switch ($_REQUEST['action']) 
	{
		case 'guardarEspecie':
			$jTableResult = array();
			$jTableResult['msj']="";
			$jTableResult['restl']="";
			$jTableResult['listaEspecies']="";
				if($_POST['nombreEspecie']=="")
					{
						$jTableResult['msj']= "DEBE INGRESAR UN DATO";
						$jTableResult['restl']= "0";						
					}
				else		
					{
						$query="SELECT  idEspecie FROM especiesmnrs WHERE nombreEspecie ='".$_POST['nombreEspecie']."' AND idUnidad_FK='".$_POST['idUnidadAdmin']."'  ;";
						$result= mysqli_query($conn,$query);
						$numero= mysqli_num_rows($result);
						if($numero==0)
							{
								$query="INSERT INTO especiesmnrs SET nombreEspecie='".$_POST['nombreEspecie']."', idUnidad_FK='".$_POST['idUnidadAdmin']."';";
								if($result= mysqli_query($conn,$query))
									{
										mysqli_commit($conn);
										$jTableResult['msj']= "DATO GUARDADO CORRECTAMENTE.";
										$jTableResult['restl']= "1";
									}
								else
									{
										mysqli_rollback($conn);
										$jTableResult['msj']= "ERROR AL GUARDAR. INTENTE NUEVAMENTE.";				
										$jTableResult['restl']= "0";	
									}	
							}
						else
							{
								$jTableResult['msj']= "NOMBRE YA EXISTE.";
								$jTableResult['restl']= "0";
							}
					}
			print json_encode($jTableResult);
		break;			
		case 'guardarUnidad':
			$jTableResult = array();
			$jTableResult['msj']="";
			$jTableResult['restl']="";
				if($_POST['nombreUnidadPro']=="")
					{
						$jTableResult['msj']= "DEBE INGRESAR UN DATO";
						$jTableResult['restl']= "0";						
					}
				else		
					{
						$query="SELECT  idUnidadPro FROM unidades WHERE nombreUnidadPro ='".$_POST['nombreUnidadPro']."';";
						$result= mysqli_query($conn,$query);
						$numero= mysqli_num_rows($result);
						if($numero==0)
							{
								$query="INSERT INTO unidades SET nombreUnidadPro='".$_POST['nombreUnidadPro']."' , centroUnidad_fk='".$_POST['centroUniPro']."', reginalUnidad_fk='".$_POST['regionalUniPro']."';";
								if($result= mysqli_query($conn,$query))
									{
										mysqli_commit($conn);
										$jTableResult['msj']= "DATO GUARDADO CORRECTAMENTE.";
										$jTableResult['restl']= "1";		
									}
								else
									{
										mysqli_rollback($conn);
										$jTableResult['msj']= "ERROR AL GUARDAR. INTENTE NUEVAMENTE.";				
										$jTableResult['restl']= "0";	
									}	
							}
						else
							{
								$jTableResult['msj']= "NOMBRE YA EXISTE.";
								$jTableResult['restl']= "0";
							}					
					}	
			print json_encode($jTableResult);
		break;
		case 'buscarListaUnidades':
			$jTableResult = array();
			$jTableResult['datosUnidades'] = "";
			$jTableResult['numeroFilas'] = "";
			$query = "SELECT idUnidadPro, nombreUnidadPro FROM unidades ORDER BY idUnidadPro DESC;";
			$resultado = mysqli_query($conn, $query);
			$numero = mysqli_num_rows($resultado);
			$jTableResult['numeroFilas'] = $numero;
			$jTableResult['datosUnidades'] .= "<div class='card'>
								<div class='card-header' style='background-color:$varCabeceraTabla; color: white;'>
									<h5 class='card-title'>LISTA DE UNIDADES</h5>
									<div class='d-flex justify-content-end align-items-center'>   
										<p>total: <strong>$numero</strong></p>
									</div>
								</div>
								<div class='card-body' style='max-height: 400px; overflow-y: auto;'>";
			if($numero > 0) {
				while($registro = mysqli_fetch_array($resultado)) { 
					$jTableResult['datosUnidades'] .= "<div class='card mb-10'>
														<div class='card-body'>
															<div class='row'>
																<div class='col-sm-6'>
																	<h6 class='modal-title'>".$registro['nombreUnidadPro']."</h6>
																</div>
																<div class='col-sm-6 d-flex justify-content-end align-items-center'>
																	<button class='btn' id='btnDellUnidad' data-id_unidad_del='".$registro['idUnidadPro']."' data-tipo='3' style='background-color: red; color: #fff; margin-right: 0.5rem;'><i class='fa-solid fa-trash'></i></button>
																	<button class='btn' id='btnActualizarCardUnidad' data-id='".$registro['idUnidadPro']."' data-tipo-update='3' data-toggle='modal' data-target='#editarUnidadAnim' style='background-color: #FFC300; color: black;'><i class='fa-solid fa-pen-to-square'></i></button>
																</div>                                                    
															</div>                    
														</div>
													</div>";
				}
			} else {
				$jTableResult['datosUnidades'] .= "<div class='card mb-10'>
													<div class='card-body'>
														<center><h6>NO SE ENCONTRARON RESULTADOS</h6></center>                
													</div>
												</div>";
			}
			$jTableResult['datosUnidades'] .= "    </div>
											</div>";
			print json_encode($jTableResult);
		break;
		case 'updUnidad':
			$jTableResult = array();
			$jTableResult['msj']= "";
			$jTableResult['restl']= "";
			if($_POST['nombreUnidadProUpdate']=="")
					{
						$jTableResult['msj']= "DEBE INGRESAR UN NOMBRE.";
						$jTableResult['restl']= "0";						
						$query="SELECT idEspecie, nombreEspecie, unidades.nombreUnidadPro AS unidadEspecie
					  FROM especiesmnrs 
					  INNER JOIN unidades ON unidades.idUnidadPro = especiesmnrs.idUnidad_FK 
					  WHERE idUnidad_FK ='".$var_dato_Unidad."';";
						$result= mysqli_query($conn,$query);
						$numero= mysqli_num_rows($result);
						if($numero==0)
							{
								$query="UPDATE unidades set nombreUnidadPro ='".$_POST['nombreUnidadProUpdate']."' WHERE idUnidadPro = '".$_POST['idUnidadProUpdate']."'; ";
								if($result= mysqli_query($conn,$query))
									{
										mysqli_commit($conn);
										$jTableResult['msj']="REGISTRO ACTUALIZADO CORRECTAMENTE.";
										$jTableResult['restl']="1";
									}
								else
									{
										$jTableResult['msj']="ERROR AL ACTUALIZAR. INTENTE NUEVAMENTE.";
										$jTableResult['restl']="0";					
									}
							}
						else
							{
								$jTableResult['msj']= "NOMBRE YA EXISTE.";
								$jTableResult['restl']= "0";
							}		
					}			
			print json_encode($jTableResult);
		break;	
		case 'updateUnidades':
			$jTableResult = array();
			$jTableResult['msj']= "";
			$jTableResult['resultd']= "";
			$var_dato_Unidad  = $_POST['idUnidadUpdate'];
			if($_POST['nombreUpdateUni']=="")
					{
						$jTableResult['msj']= "DEBE INGRESAR UN NOMBRE.";
						$jTableResult['restl']= "0";						
					
					}else{
						$query="SELECT idUnidadPro FROM unidades WHERE idUnidadPro ='".$var_dato_Unidad."' AND nombreUnidadPro ='".$_POST['nombreUpdateUni']."' ;";
						  $result= mysqli_query($conn,$query);
						  $numero= mysqli_num_rows($result);
						 
						  if($numero==0)
							  {
								$query=$conn->prepare("UPDATE unidades set nombreUnidadPro =? WHERE idUnidadPro = ?");
								$query->bind_param('si', $_POST['nombreUpdateUni'], $_POST['idUnidadUpdate']);
								if($query->execute()){
									mysqli_commit($conn);
									$jTableResult['msj']="REGISTRO ACTUALIZADO CORRECTAMENTE.";
									$jTableResult['resultd']="1";
								}else{
									mysqli_rollback($conn);
									$jTableResult['msj']="ERROR AL ACTUALIZAR. INTENTE NUEVAMENTE.";
									$jTableResult['resultd']="0";
								}
							  }
						  else
							  {
								  $jTableResult['msj']= "NOMBRE YA EXISTE.";
								  $jTableResult['restl']= "0";
							  }		
					}		
			print json_encode($jTableResult);
		break;	
	
		case 'listarEspecies':
			$jTableResult = array();
			$jTableResult['msj']= "";
			$jTableResult['restl']= "";		
			$jTableResult['listaEspecies']= "";		
				$query="SELECT idEspecie, nombreEspecie, idUnidad_FK 
						FROM especiesmnrs WHERE idUnidad_FK = '".$_POST['idUnidadAdmin']."' ORDER BY nombreEspecie; ";		
				$resultado = mysqli_query($conn, $query);
				$cont=1;
					$jTableResult['listaEspecies']="
					<thead>
						<tr>
							<th scope='col'>#</th>
							<th scope='col'>ID</th>
							<th scope='col'>Nombre</th>
							<th scope='col'>Op</th>
						</tr>
					</thead>";
					while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['listaEspecies'].="
						<tr >
							<td width='1%' >".$cont."</td>
							<td width='3%'>".$registro['idEspecie']."</td>
							<td width='50%' >".$registro['nombreEspecie']."</td>
							<td>
								<button  
									type='button'
									id='btnEditarEspecie' 
									name='btnEditarEspecie' 
									class='btn btn-warning btn-sm'
									data-toggle='modal'										
									data-id='".$registro['idEspecie']."'
									title='Administrar ".$registro['nombreEspecie']."'>
									$varIconoEditar Editar 
								</button>
								<!--
									<button  
										type='button'
										id='btnAddRazas' 
										name='btnAddRazas' 
										class='btn btn-success btn-sm'
										data-toggle='modal'										
										data-idespecieadd='".$registro['idEspecie']."'
										title='INGREZAR RAZA A LA ESPECIE ".$registro['nombreEspecie']."'>
										$varIconoRaza Ingreso de Razas 
									</button>
								-->
								<button  
									type='button'
									id='btnDellEspecie' 
									name='btnDellEspecie' 
									class='btn btn-danger btn-sm'
									data-toggle='modal'										
									data-idespeciedell='".$registro['idEspecie']."'
									title='Eliminar ".$registro['nombreEspecie']."'>
									$varIconoBorrar Borrar 
								</button>
							</td>							
						<tr>";
						$cont=$cont+1;
					}
			print json_encode($jTableResult);
		break;		
		case 'buscarUnidad':
			$jTableResult = array();
			$jTableResult['msj']= "";
			$jTableResult['restl']= "";		
			$jTableResult['NombreUnidad']= "";		
				$query="SELECT nombreUnidadPro FROM unidades WHERE idUnidadPro = '".$_POST['idUnidadProUpdate']."'; ";
				$result= mysqli_query($conn,$query);
				while($registro = mysqli_fetch_array($result))
				{	$jTableResult['NombreUnidad']=utf8_decode($registro['nombreUnidadPro']);	 
					$jTableResult['NombreUnidad']=utf8_encode($jTableResult['NombreUnidad']);
					}
			print json_encode($jTableResult);
		break;
		case 'buscarUnidadV':
			$jTableResult = array();	
			$jTableResult['NombreUnidad']= "";	
				$query = $conn->prepare("SELECT nombreUnidadPro FROM unidades WHERE idUnidadPro =?");
				$query->bind_param('i', $_POST['idUnidadRellenar']);
				$query->execute();
				$resultado = $query->get_result();
				//$numero = $query->num_rows();
				if($registro = $resultado->fetch_assoc()){
					$jTableResult['NombreUnidad']=$registro['nombreUnidadPro'];	 
				} 
			print json_encode($jTableResult);
		break;		
		case 'buscarEspecie2':
			$jTableResult = array();
			$jTableResult['msj']= "";
			$jTableResult['restl']= "";		
			$jTableResult['NombreEspecie']= "";
				$query="SELECT nombreEspecie FROM especiesmnrs WHERE idEspecie = '".$_POST['idEspecieUpd']."'; ";
				$result= mysqli_query($conn,$query);
				while($registro = mysqli_fetch_array($result))
				{	$jTableResult['NombreEspecie']=utf8_decode($registro['nombreEspecie']);	
					$jTableResult['NombreEspecie']=utf8_encode($jTableResult['NombreEspecie']);	
					}
			print json_encode($jTableResult);
		break;
		case 'buscarEspecie':
			$jTableResult = array();
			$jTableResult['msj']= "";
			$jTableResult['restl']= "";		
			$jTableResult['NombreEspecie']= "";
				$query="SELECT nombreEspecie FROM especiesmnrs WHERE idEspecie = '".$_POST['idEspecieDell']."'; ";
				$result= mysqli_query($conn,$query);
				while($registro = mysqli_fetch_array($result))
				{	$jTableResult['NombreEspecie']=utf8_decode($registro['nombreEspecie']);	
					$jTableResult['NombreEspecie']=utf8_encode($jTableResult['NombreEspecie']);
				}					
			print json_encode($jTableResult);
		break;	  

		case 'killerEspecie':
			$jTableResult = array();
			$jTableResult['msj']= "";
			$jTableResult['restl']= "";				
				$query="DELETE FROM especiesmnrs WHERE idEspecie = '".$_POST['idEspecieDell']."'; ";
				if($resultado = mysqli_query($conn, $query)){
					$jTableResult['msj']= "ELIMINACION REALIZADA CON EXITO.";  
					$jTableResult['restl']= "1";}
					else{	$jTableResult['msj']= "EXISTEN REGISTROS VINCULADOS AL REGISTROS QUE EVITAN LA ELIMINACION."; $jTableResult['restl']= "0";	}
			print json_encode($jTableResult);
		break;
		case 'killerUnidad':
			$jTableResult = array();
			$jTableResult['msj']= "";
			$jTableResult['restl']= "";				
				$query="DELETE FROM unidades WHERE idUnidadPro = '".$_POST['idUnidadDell']."'; ";
				if($resultado = mysqli_query($conn, $query)){
					$jTableResult['msj']= "ELIMINACION REALIZADA CON EXITO.";  
					$jTableResult['restl']= "1";}
					else{	$jTableResult['msj']= "EXISTEN REGISTROS VINCULADOS AL REGISTROS QUE EVITAN LA ELIMINACION."; $jTableResult['restl']= "0";	}
			print json_encode($jTableResult);
		break;
		
		case 'actualizarEspecie':
			$jTableResult = array();
			$jTableResult['msj']= "";
			$jTableResult['restl']= "";	
			if($_POST['nombreEspecieUpd']=="")
					{
						$jTableResult['msj']= "DEBE INGRESAR UN NOMBRE DE ESPECIE.";
						$jTableResult['restl']= "0";						
					}
				else		
					{
						$query="SELECT nombreEspecie FROM especiesmnrs WHERE nombreEspecie ='".$_POST['nombreEspecieUpd']."';";
						$result= mysqli_query($conn,$query);
						$numero= mysqli_num_rows($result);
						if($numero==0)
							{
								$query="UPDATE especiesmnrs SET 
								nombreEspecie ='".$_POST['nombreEspecieUpd']."' 
								WHERE idEspecie='".$_POST['idEspecieUpd']."';"; 
								if($resultado = mysqli_query($conn, $query)){
								$jTableResult['msj']= "ACTUALIZACION REALIZADA CON EXITO.";  
								$jTableResult['restl']= "1";}
								else{	$jTableResult['msj']= "INTENTA NUEVAMENTE. SE PRESENTO UN PROBLEMA."; $jTableResult['restl']= "0";	}
							}
						else 
							{
								$jTableResult['msj']= "EL NOMBRE YA EXISTE.";
								$jTableResult['restl']= "0";
							}							
					}
			print json_encode($jTableResult);
		break;		
	}		
mysqli_close($conn);
?> 