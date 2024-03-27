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
		case 'cargarUnidad':
			$jTableResult = array();
				$jTableResult['listaUnidad']="";
				$jTableResult['listaUnidad']="<option value='0' selected >seleccione:.</option>";
				$query = "SELECT idUnidadPro, nombreUnidadPro FROM unidades";	
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['listaUnidad'].="<option value='".$registro['idUnidadPro']."' >".$registro['nombreUnidadPro']."</option>";
					}	
			print json_encode($jTableResult);
		break;		
		case 'cargarEspecie':
			$jTableResult = array();
			$jTableResult['listaEspecies']="<option value='0' selected >Seleccione:.</option>";
				$query = "SELECT idEspecie, nombreEspecie, idUnidad_FK 
				FROM especiesmnrs WHERE idUnidad_FK ='".$_POST['idUnidad_FKRegistro']."';"; 	
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['listaEspecies'].="<option value='".$registro['idEspecie']."' >".$registro['nombreEspecie']."</option>";
					}	
			print json_encode($jTableResult);
		break;		
		case 'selectRazas':
			$jTableResult = array();
				$jTableResult['listaRazas']="";
				$jTableResult['listaRazas']="<option value='0' selected >seleccione:.</option>";
				$query = "SELECT idRaza, nombreRaza, idEspecieFK 
				FROM raza WHERE idEspecieFK = '".$_POST['idEspecie_FKRegistro']."';";	
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['listaRazas'].="<option value='".$registro['idRaza']."' >".$registro['nombreRaza']."</option>";
					} 				
			print json_encode($jTableResult);
		break;		
		case 'guardarRegistro':
			$jTableResult = array();
				$jTableResult['restl']="";
				$jTableResult['msj']="";
				$jTableResult['codAnimalRegistro']="0";
				$jTableResult['fechaNacimientoRegistro']="0";
				$jTableResult['nombreAnimalRegistro']="0";
				$jTableResult['diasLactanciaAnimalRegistro']="0";
				$jTableResult['colorAnimalRegistro']="0";
				$jTableResult['pesoAnimalRegistro']="0";
				$jTableResult['observacionesRegistro']="0";
				$jTableResult['unidadMedidaRegistro']="0";
				$jTableResult['idUnidad_FKRegistro']="0";
				$jTableResult['idEspecie_FKRegistro']="0";
				$jTableResult['idRaza_FKRegistro']="0";
				$jTableResult['idSexoRegistro']="0";
				if(($_POST['codAnimalRegistro']=="0") OR ($_POST['fechaNacimientoRegistro']=="") OR ($_POST['nombreAnimalRegistro']=="") OR ($_POST['colorAnimalRegistro']=="") OR ($_POST['pesoAnimalRegistro']=="") OR ($_POST['observacionesRegistro']=="") OR ($_POST['unidadMedidaRegistro']=="0") OR ($_POST['idUnidad_FKRegistro']=="0") OR ($_POST['idEspecie_FKRegistro']=="0") OR ($_POST['idRaza_FKRegistro']=="0") OR ($_POST['idSexoRegistro']="0"))
					{
						if(($_POST['codAnimalRegistro'])=="") { $jTableResult['codAnimalRegistro']="1"; } 
						if(($_POST['fechaNacimientoRegistro'])=="") { $jTableResult['fechaNacimientoRegistro']="1"; } 
						if(($_POST['nombreAnimalRegistro'])=="") { $jTableResult['nombreAnimalRegistro']="1"; } 
						if(($_POST['diasLactanciaAnimalRegistro'])=="") { $jTableResult['diasLactanciaAnimalRegistro']="1"; } 
						if(($_POST['colorAnimalRegistro'])=="") { $jTableResult['colorAnimalRegistro']="1"; } 
						if(($_POST['pesoAnimalRegistro'])=="") { $jTableResult['pesoAnimalRegistro']="1"; } 
						if(($_POST['observacionesRegistro'])=="") { $jTableResult['observacionesRegistro']="1"; } 
						if(($_POST['unidadMedidaRegistro'])=="0") { $jTableResult['unidadMedidaRegistro']="1"; } 
						if(($_POST['idUnidad_FKRegistro'])=="0") { $jTableResult['idUnidad_FKRegistro']="1"; } 
						if(($_POST['idEspecie_FKRegistro'])=="0") { $jTableResult['idEspecie_FKRegistro']="1"; } 
						if(($_POST['idRaza_FKRegistro'])=="0") { $jTableResult['idRaza_FKRegistro']="1"; } 
						if(($_POST['idSexoRegistro'])=="0") { $jTableResult['idSexoRegistro']="1"; } 
						$jTableResult['msj']="EXISTEN DATOS POR INGRESAR";
						$jTableResult['restl']="0";
					}
				else
					{
						$query="SELECT codAnimal FROM animales WHERE codAnimal ='".$_POST['codAnimalRegistro']."';";
						$result= mysqli_query($conn,$query);
						$numero= mysqli_num_rows($result);
						if($numero==0)
							{
								$query="SELECT nombreAnimal FROM animales WHERE nombreAnimal ='".$_POST['nombreAnimalRegistro']."';";
								$result= mysqli_query($conn,$query);
								$numero= mysqli_num_rows($result);
								if($numero==0)
									{  
										$query="INSERT INTO animales SET 
										fechaRegistro='".$_POST['fechaRegistro']."',
										horaRegistroAnimal='".$horaTime ."',
										codAnimal='".$_POST['codAnimalRegistro']."',
										nombreAnimal='".$_POST['nombreAnimalRegistro']."',
										fechaNacimiento='".$_POST['fechaNacimientoRegistro']."',
										colorAnimal='".$_POST['colorAnimalRegistro']."',
										pesoAnimal='".$_POST['pesoAnimalRegistro']."',
										unidadMedida='".$_POST['unidadMedidaRegistro']."',
										observaciones='".$_POST['observacionesRegistro']."',
										idUnidad_FK='".$_POST['idUnidad_FKRegistro']."',
										idEspecie_FK='".$_POST['idEspecie_FKRegistro']."',
										idRaza_FK='".$_POST['idRaza_FKRegistro']."',
										idSexo='".$_POST['idSexoRegistro']."',
										idUsuRegistro='".$_POST['idSexoRegistro']."',
										nombreUsuRegistro='".$_POST['nombreUsuRegistro']."';";
										// exit();
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
										$jTableResult['msj']="EL NOMBRE DEL ANIMAL DIGITADO YA EXISTE";
										$jTableResult['restl']="0";
									}	
							}
						else 
							{
								$jTableResult['msj']="EL CODIGO DEL ANIMAL DIGITADO YA EXISTE";
								$jTableResult['restl']="0";
							}		
					}
			print json_encode($jTableResult);
		break;	
		case 'listarAnimales':
			$jTableResult = array();
				$jTableResult['msj']="";
				$jTableResult['result']="";
				$jTableResult['cantidad']="";
				$jTableResult['listaAnimales']="";
				$var_dato = "%".utf8_encode($_POST['dato_txt'])."%";
				$query = "SELECT animales.idAnimal, animales.codAnimal, animales.nombreAnimal, animales.idUnidad_FK,   unidades.nombreUnidadPro 
				FROM   animales 
				INNER JOIN  unidades  ON  unidades.idUnidadPro  =  animales.idUnidad_FK  
				WHERE animales.codAnimal like '".$var_dato."' 
				OR animales.nombreAnimal like '".$var_dato."' 
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
		break;
		case 'listaRazas':
			$jTableResult = array();
				$jTableResult['msj']= "";
				$jTableResult['restl']= "";		
				$jTableResult['listaRazas']= "";
					$query="SELECT idRaza, nombreRaza FROM raza WHERE idEspecieFK= '".$_POST['idEspecie_FKRegistro']."'; "; 		
					$resultado = mysqli_query($conn, $query);
					$jTableResult['listaRazas']="
						<thead>
							<tr>
								<th scope='col' >ID</th>
								<th scope='col' >Nombre</th>
								<th scope='col' >Op</th>
							</tr>
						</thead>";
						while($registro = mysqli_fetch_array($resultado))
						{
							$jTableResult['listaRazas'].="
							<tr >
								<td width='3%'>".$registro['idRaza']."</td>
								<td width='50%' >".$registro['nombreRaza']."</td>
								<td>
									<button  
										type='button'
										id='btnEditarRaza' 
										name='btnEditarRaza' 
										class='btn btn-warning btn-sm'
										data-toggle='modal'										
										data-idraza='".$registro['idRaza']."'
										data-nombreraza='".$registro['nombreRaza']."'
										title='Editar ".$registro['nombreRaza']."'>
										$varIconoEditar Editar 
									</button>
									<button  
										type='button'
										id='btnKillerRaza' 
										name='btnKillerRaza' 
										class='btn btn-danger btn-sm'
										data-toggle='modal'										
										data-idrazadell='".$registro['idRaza']."'
										data-nomrazadell='".$registro['nombreRaza']."'
										title='Eliminar ".$registro['nombreRaza']."'>
										$varIconoBorrar Borrar 
									</button>
								</td>							
							<tr>";
						}
			print json_encode($jTableResult);
		break;
		case 'guardarRaza':
			$jTableResult = array();
			$jTableResult['msj']="";
			$jTableResult['restl']="";
			// $_POST['idEspecie_FKRegistro']; exit();
				if($_POST['nombreRazaAdd']=="")
					{
						$jTableResult['msj']= "DEBE INGRESAR UN DATO";
						$jTableResult['restl']= "0";						
					}
				else		
					{
						$query="SELECT  idRaza FROM raza WHERE nombreRaza ='".$_POST['nombreRazaAdd']."' 
								AND idEspecieFK='".$_POST['idEspecie_FKRegistro']."'  ;";
						$result= mysqli_query($conn,$query);
						$numero= mysqli_num_rows($result);
						if($numero==0)
							{
								$query="INSERT INTO raza SET nombreRaza='".$_POST['nombreRazaAdd']."', idEspecieFK='".$_POST['idEspecie_FKRegistro']."';";
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
		case 'updRaza':
			$jTableResult = array();
			$jTableResult['msj']= "";
			$jTableResult['restl']= "";
			if($_POST['nombreRazUpdt']=="")
					{
						$jTableResult['msj']= "DEBE INGRESAR UN NOMBRE.";
						$jTableResult['restl']= "0";						
					}
				else		
					{
						$query="SELECT nombreRaza FROM raza WHERE nombreRaza ='".$_POST['nombreRazUpdt']."' AND idEspecieFK='".$_POST['idEspecie_FKRegistro']."';";
						$result= mysqli_query($conn,$query);
						$numero= mysqli_num_rows($result);
						if($numero==0)
							{
								$query="UPDATE raza SET nombreRaza ='".$_POST['nombreRazUpdt']."' WHERE idRaza = '".$_POST['idRazaUpdt']."'; ";
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
		case 'killerRaza':
			$jTableResult = array();
				$jTableResult['msj']= "";
				$jTableResult['restl']= "";				
				$query="DELETE FROM raza WHERE idRaza = '".$_POST['idRazaDell']."'; ";
				if($resultado = mysqli_query($conn, $query)){
					$jTableResult['msj']= "ELIMINACION REALIZADA CON EXITO.";  
					$jTableResult['restl']= "1";}
				else{	$jTableResult['msj']= "EXISTEN REGISTROS VINCULADOS. QUE EVITAN LA ELIMINACION."; $jTableResult['restl']= "0";	}
			print json_encode($jTableResult);
		break;
	}		
mysqli_close($conn);
?> 