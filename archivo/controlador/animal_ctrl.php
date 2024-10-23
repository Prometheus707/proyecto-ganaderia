<?php
header('Cache-Control: no-cache, must-revalidate');
include('../../include/parametros_index.php');
date_default_timezone_set('America/Bogota');
include('../../include/conex.php');
session_start();
$conn=Conectarse();
$horaTime = date('H:i:s');
$estadoAnimal = 1;
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
		case 'listarAnimalHmebra':
			$jTableResult = array();
				$jTableResult['listaAnimalHembra']="";
				$jTableResult['listaAnimalHembra']="<option value='0' selected >seleccione:.</option>";
				$query = "SELECT idAnimal, nombreAnimal FROM animales WHERE ttlPartosAnimal > 0";	
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['listaAnimalHembra'].="<option value='".$registro['idAnimal']."' >".$registro['nombreAnimal']."</option>";
					}	
			print json_encode($jTableResult);
		break;
		case 'selectPadreRegAnimal':
			$jTableResult = array();
			$jTableResult['listaAnimalMacho']="";
			if($_POST['metodoReg']==1){//SI ES MONTA
				$jTableResult['listaAnimalMacho']="<option value='0' selected >seleccione:.</option>";
				$query = "SELECT idAnimal, nombreAnimal FROM animales WHERE idSexo = 1 AND DesarrolloAnimal_FK=9";	
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['listaAnimalMacho'].="<option value='".$registro['idAnimal']."' >".$registro['nombreAnimal']."</option>";
					}	
			}else{//SI ES INSEMINACION
				$jTableResult['listaAnimalMacho']="<option value='0' selected >seleccione:.</option>";
				$query = "SELECT idPajilla, nombrePajilla FROM pajilla";	
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['listaAnimalMacho'].="<option value='".$registro['idPajilla']."' >".$registro['nombrePajilla']."</option>";
					}	
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
		case 'selectPredecirChapeta':
			$jTableResult['codigoChapetaCreadoSistema']="";
			$jTableResult['idChapetaAnim']="";
			$jTableResult['boolSelectUnidad']="";
			///////SI AHY CAMBIOS SE TIENE QUE ELIMINAR ANIMAL Y CHAPETA////
			if($_POST['id_unidad_predecir_chapeta']==0){
				$query = $conn->prepare("DELETE FROM chapetasanimales WHERE idChapetaAnimal=?");
				$query ->bind_param("i", $_POST['idchapetaAnimal']);
				if($query->execute()){
					$jTableResult['msjChapetaVacia']="SE ELIMINO LA CHAPETA VACIA.";
					$jTableResult['resultd']="0";
					//ELIMINAR ACAMPO DE ANIMAL VACIO
					$query = $conn->prepare("DELETE FROM animales WHERE chapetaAnim=?");
					$query->bind_param('s', $_POST['NumchapetaAnimal']);
					if($query->execute()){
						$jTableResult['msjChapetaVacia']="SE ELIMINO ANIMAL VACIO.";
						$jTableResult['resultd']="0";
						$jTableResult['boolSelectUnidad']=true;
					}
				}
			}else{
				$query = $conn->prepare("DELETE FROM chapetasanimales WHERE idChapetaAnimal=?");
				$query ->bind_param("i", $_POST['idchapetaAnimal']);
				if($query->execute()){
					$jTableResult['msjChapetaVacia']="SE ELIMINO LA CHAPETA VACIA.";
					$jTableResult['resultd']="0";
					//ELIMINAR ACAMPO DE ANIMAL VACIO
					$query = $conn->prepare("DELETE FROM animales WHERE chapetaAnim=?");
					$query->bind_param('s', $_POST['NumchapetaAnimal']);
					if($query->execute()){
						$jTableResult['msjChapetaVacia']="SE ELIMINO ANIMAL VACIO.";
						$jTableResult['resultd']="0";
						$query = $conn -> prepare("SELECT abreviaturaUnidad FROM unidades WHERE idUnidadPro=?");//buscar abreviatura unidad
						$query -> bind_param('i', $_POST['id_unidad_predecir_chapeta']);
						if($query -> execute()){
							$resultado = $query -> get_result();
							$abreviaturaUNidad = $resultado->fetch_assoc();
							$query = $conn -> prepare("SELECT COUNT(idChapetaAnimal) AS total FROM chapetasanimales WHERE idUnidadChapeta=?");//buscar el numero de veces que la unidad este
							$query -> bind_param('i', $_POST['id_unidad_predecir_chapeta']);	
							if($query->execute()){
								$resultado = $query->get_result();
								$numero = $resultado->fetch_assoc();
								$createCodigoChapeta = $abreviaturaUNidad['abreviaturaUnidad']."-".$numero['total']+1;
								////////CREAR REGISTRO VACIO DE CHAPETA///////
								$query = $conn -> prepare("INSERT INTO chapetasanimales (valorChapeta, idUnidadChapeta, fechaRegistroChapeta) VALUES(?, ?, CURDATE())");
								$query -> bind_param('si', $createCodigoChapeta, $_POST['id_unidad_predecir_chapeta']);
								if($query->execute()){
									$jTableResult['msjChapetaVacia']="CHAPETA VACIA CREADA";
									/////////////////CREAR ANIMAL VACIO CON NUMERO DE CHAPETA///////////////
									$token = bin2hex(random_bytes(16));//GENERA UN TOKEN ALEATORIO
									$query = $conn->prepare("INSERT INTO animales (fechaRegistro, token_animal, chapetaAnim, nombreAnimal) VALUES (CURDATE(), ?, ?, ?)");
									$query->bind_param('sss', $token, $createCodigoChapeta, $_POST['nombreAnimalRegVacio']);
									if($query->execute()){
										$jTableResult['msjAnimalVacio']="SE CREO ANIMAL VACIA.";
										$jTableResult['resultd']="1";
										//OBTENER EL ID DE LA CHAPETA 
										$jTableResult['codigoChapetaCreadoSistema']=$createCodigoChapeta;
										$query = $conn -> prepare("SELECT idChapetaAnimal FROM chapetasanimales WHERE valorChapeta=?");
										$query -> bind_param('s', $createCodigoChapeta);
										if($query->execute()){
											$resultados = $query->get_result();
											$registro = $resultados->fetch_assoc();
											$jTableResult['idChapetaAnim']=$registro['idChapetaAnimal'];
											$jTableResult['boolSelectUnidad']=false;
										}
									}else{
										$jTableResult['msjAnimalVacio']="NO SE CREO ANIMAL VACIA.";
										$jTableResult['resultd']="0";
									}
								}else{
									$jTableResult['msjChapetaVacia']="NO SE CREO LA CHAPETA VACIA.";
									$jTableResult['resultd']="0";
								}
							}
						}
					}
				}
			}
			///////FIN, SI AHY CAMBIOS SE TIENE QUE ELIMINAR ANIMAL Y CHAPETA////
			print json_encode($jTableResult);
		break;	
		
		

		// case 'guardarRegistro':
		// 	$jTableResult['restl']="";
		// 	$jTableResult['msj']="";
		// 	$jTableResult['restlCodigoAuto']="";
		// 	$jTableResult['msjCodigoAuto']="";
		// 	if(($_POST['fechaNacimientoRegistro']=="") 
		// 		OR ($_POST['nombreAnimalRegistro']=="") OR ($_POST['colorAnimalRegistro']=="") 
		// 		OR ($_POST['pesoAnimalRegistro']=="") OR ($_POST['observacionesRegistro']=="") 
		// 		OR ($_POST['unidadMedidaRegistro']=="0") OR ($_POST['idUnidad_FKRegistro']=="0") 
		// 		OR ($_POST['idEspecie_FKRegistro']=="0") OR ($_POST['idRaza_FKRegistro']=="0") 
		// 		OR ($_POST['idSexoRegistroAnimalfk']=="0") 
		// 	)
		// 	{ 
		// 		$jTableResult['msj']="EXISTEN DATOS POR INGRESAR";
		// 		$jTableResult['restl']="0";
		// 	}else{
		// 		$query = $conn->prepare("UPDATE animales SET fechaNacimiento=?, nombreAnimal=?, colorAnimal=?, pesoAnimal=?, observaciones=?, 
		// 				unidadMedida=?, idUnidad_FK=?, idEspecie_FK=?, idRaza_FK=?, idSexo=?, horaRegistroAnimal=?, estadoVM=?, idUsuRegistro=? WHERE chapetaAnim=?");
		// 		$query->bind_param('sssssiiiiisiss', 
		// 		$_POST['fechaNacimientoRegistro'],
		// 		$_POST['nombreAnimalRegistro'],
		// 		$_POST['colorAnimalRegistro'],
		// 		$_POST['pesoAnimalRegistro'],
		// 		$_POST['observacionesRegistro'],
		// 		$_POST['unidadMedidaRegistro'],
		// 		$_POST['idUnidad_FKRegistro'],
		// 		$_POST['idEspecie_FKRegistro'],
		// 		$_POST['idRaza_FKRegistro'],
		// 		$_POST['idSexoRegistroAnimalfk'],
		// 		$horaTime,
		// 		$estadoAnimal,
		// 		$_POST['idUsuRegistro'],
		// 		$_POST['NumchapetaAnimal'] 
		// 		);
		// 		if($query->execute()){
		// 			$jTableResult['msj']="REGISTRO GUARDADO CON EXITO.";
		// 			$jTableResult['restl']="1";
		// 			/////////CREAR CODIRGO DEL SISTEMA////
		// 			$query = $conn->prepare("SELECT idAnimal FROM animales WHERE chapetaAnim =?");
		// 			$query -> bind_param('s', $_POST['NumchapetaAnimal'] );
		// 			if($query->execute()){
		// 				$resultado = $query -> get_result();
		// 				$numero = $resultado -> num_rows;
		// 				$DatosUpdateCodigoAnimal = $resultado -> fetch_assoc();
		// 				$idAnimSis=$DatosUpdateCodigoAnimal['idAnimal'];
		// 				if($numero > 0){
		// 					/////////SECCION PARA CREAR CODIGO AUTOMATICO DEL SISTEMA////////////
		// 					$fechaRegistroConcat = date('YmdHis');
		// 					$codigoSistemaAnimal ="SENA_AGRO-".$fechaRegistroConcat."-".$idAnimSis;//SE GENERA EL CODIGO AUTOMATICO
		// 					//ACTUALIZACION DEL CAMPO DEL CODIGO AUTOMATICO
		// 					$query = $conn -> prepare("UPDATE animales SET codAnimal=? WHERE idAnimal =?;");
		// 					$query -> bind_param('si', $codigoSistemaAnimal, $idAnimSis);
		// 					if($query->execute()){
		// 						mysqli_commit($conn);
		// 						$jTableResult['msjCodigoAuto']="SE CREO EL CODIGO AUTOMATICO";
		// 						$jTableResult['restlCodigoAuto']="1";
		// 					}else{
		// 						$jTableResult['msj']="ERROR AL EJECUTAR ACTUALIZAR CODIGO AUTOMATICO DEL SISTEMA.";
		// 						$jTableResult['restl']="0";
		// 					}
		// 				}
		// 			}
		// 		}else{
		// 			mysqli_rollback($conn);
		// 			$jTableResult['msj']="ERROR AL EJECUTAR AL GUARDAR ANIMAL.";
		// 			$jTableResult['restl']="0";
		// 		}
		// 	}
		// 	print json_encode($jTableResult);
		// break;





		// case 'guardarRegistro':
		// 	$jTableResult['restl']="";
		// 	$jTableResult['msj']="";
		// 	$jTableResult['restlCodigoAuto']="";
		// 	$jTableResult['msjCodigoAuto']="";
		// 	if(($_POST['fechaNacimientoRegistro']=="") 
		// 		OR ($_POST['nombreAnimalRegistro']=="") OR ($_POST['colorAnimalRegistro']=="") 
		// 		OR ($_POST['pesoAnimalRegistro']=="") OR ($_POST['observacionesRegistro']=="") 
		// 		OR ($_POST['unidadMedidaRegistro']=="0") OR ($_POST['idUnidad_FKRegistro']=="0") 
		// 		OR ($_POST['idEspecie_FKRegistro']=="0") OR ($_POST['idRaza_FKRegistro']=="0") 
		// 		OR ($_POST['idSexoRegistroAnimalfk']=="0") 
		// 	)
		// 	{ 
		// 		$jTableResult['msj']="EXISTEN DATOS POR INGRESAR";
		// 		$jTableResult['restl']="0";
		// 	}else{
		// 		//DESIGNAR EL ESTADO DE CRECIMIENTO DEL ANIMAL
		// 		if($_POST['idSexoRegistroAnimalfk']==1){
		// 			if($_POST['mesesAnimal']>24){
		// 				$registroCrecimientoAnimal= 9;
		// 				$nombreCrecimeinto= "toro reproductor";
		// 			}else{
		// 				$query = $conn->prepare("SELECT idCrecimiento, nombreCrecimiento
		// 				FROM desarrollo_crecimiento
		// 				WHERE 
		// 					sexoAnimCrecimiento = 1 AND         -- Filtramos para machos
		// 					etapaInicio <= ? AND                -- Comparamos que la edad del animal esté en el rango mínimo
		// 					(etapaFin >= ? OR etapaFin IS NULL) -- Comparamos que no exceda el rango máximo o sea indefinido
		// 				LIMIT 1");
		// 				$query->bind_param('ii', $_POST['mesesAnimal'], $_POST['mesesAnimal']);
		// 				if($query->execute()){
		// 					$resultado = $query->get_result();
		// 					$registroCrecimiento = $resultado->fetch_assoc();
		// 					$jTableResult['nombreCrecimeinto']=$registroCrecimiento['nombreCrecimiento'];
		// 					$registroCrecimientoAnimal = $registroCrecimiento['idCrecimiento'];
		// 				}
		// 			}
		// 			///////GUARDAR ANIMAL//////
		// 			$query = $conn->prepare("UPDATE animales SET fechaNacimiento=?, nombreAnimal=?, colorAnimal=?, pesoAnimal=?, observaciones=?, 
		// 					unidadMedida=?, idUnidad_FK=?, idEspecie_FK=?, idRaza_FK=?, idSexo=?, horaRegistroAnimal=?, estadoVM=?, idUsuRegistro=?, DesarrolloAnimal_FK=? WHERE chapetaAnim=?");
		// 			$query->bind_param('sssssiiiiisiiis', 
		// 			$_POST['fechaNacimientoRegistro'],
		// 			$_POST['nombreAnimalRegistro'],
		// 			$_POST['colorAnimalRegistro'],
		// 			$_POST['pesoAnimalRegistro'],
		// 			$_POST['observacionesRegistro'],
		// 			$_POST['unidadMedidaRegistro'],
		// 			$_POST['idUnidad_FKRegistro'],
		// 			$_POST['idEspecie_FKRegistro'],
		// 			$_POST['idRaza_FKRegistro'],
		// 			$_POST['idSexoRegistroAnimalfk'],
		// 			$horaTime,
		// 			$estadoAnimal,
		// 			$_POST['idUsuRegistro'],
		// 			$registroCrecimientoAnimal,
		// 			$_POST['NumchapetaAnimal']
		// 			);
		// 			if($query->execute()){
		// 				$jTableResult['msj']="REGISTRO GUARDADO CON EXITO.";
		// 				$jTableResult['restl']="1";
		// 				/////////CREAR CODIRGO DEL SISTEMA////
		// 				$query = $conn->prepare("SELECT idAnimal FROM animales WHERE chapetaAnim =?");
		// 				$query -> bind_param('s', $_POST['NumchapetaAnimal'] );
		// 				if($query->execute()){
		// 					$resultado = $query -> get_result();
		// 					$numero = $resultado -> num_rows;
		// 					$DatosUpdateCodigoAnimal = $resultado -> fetch_assoc();
		// 					$idAnimSis=$DatosUpdateCodigoAnimal['idAnimal'];
		// 					if($numero > 0){
		// 						/////////SECCION PARA CREAR CODIGO AUTOMATICO DEL SISTEMA////////////
		// 						$fechaRegistroConcat = date('YmdHis');
		// 						$codigoSistemaAnimal ="SENA_AGRO-".$fechaRegistroConcat."-".$idAnimSis;//SE GENERA EL CODIGO AUTOMATICO
		// 						//ACTUALIZACION DEL CAMPO DEL CODIGO AUTOMATICO
		// 						$query = $conn -> prepare("UPDATE animales SET codAnimal=? WHERE idAnimal =?;");
		// 						$query -> bind_param('si', $codigoSistemaAnimal, $idAnimSis);
		// 						if($query->execute()){
		// 							mysqli_commit($conn);
		// 							$jTableResult['msjCodigoAuto']="SE CREO EL CODIGO AUTOMATICO";
		// 							$jTableResult['restlCodigoAuto']="1";
		// 						}else{
		// 							$jTableResult['msj']="ERROR AL EJECUTAR ACTUALIZAR CODIGO AUTOMATICO DEL SISTEMA.";
		// 							$jTableResult['restl']="0";
		// 						}
		// 					}
		// 				}
		// 			}else{
		// 				mysqli_rollback($conn);
		// 				$jTableResult['msj']="ERROR AL EJECUTAR AL GUARDAR ANIMAL.";
		// 				$jTableResult['restl']="0";
		// 			}
		// 		}elseif($_POST['idSexoRegistroAnimalfk']==2){
		// 				$query = $conn->prepare("UPDATE animales SET fechaNacimiento=?, nombreAnimal=?, colorAnimal=?, pesoAnimal=?, observaciones=?, 
		// 						unidadMedida=?, idUnidad_FK=?, idEspecie_FK=?, idRaza_FK=?, idSexo=?, horaRegistroAnimal=?, estadoVM=?, idUsuRegistro=? WHERE chapetaAnim=?");
		// 				$query->bind_param('sssssiiiiisiis', 
		// 				$_POST['fechaNacimientoRegistro'],
		// 				$_POST['nombreAnimalRegistro'],
		// 				$_POST['colorAnimalRegistro'],
		// 				$_POST['pesoAnimalRegistro'],
		// 				$_POST['observacionesRegistro'],
		// 				$_POST['unidadMedidaRegistro'],
		// 				$_POST['idUnidad_FKRegistro'],
		// 				$_POST['idEspecie_FKRegistro'],
		// 				$_POST['idRaza_FKRegistro'],
		// 				$_POST['idSexoRegistroAnimalfk'],
		// 				$horaTime,
		// 				$estadoAnimal,
		// 				$_POST['idUsuRegistro'],
		// 				$_POST['NumchapetaAnimal'] 
		// 				);
		// 				if($query->execute()){
		// 					$jTableResult['msj']="REGISTRO GUARDADO CON EXITO.";
		// 					$jTableResult['restl']="1";
		// 					/////////CREAR CODIRGO DEL SISTEMA////
		// 					$query = $conn->prepare("SELECT idAnimal FROM animales WHERE chapetaAnim =?");
		// 					$query -> bind_param('s', $_POST['NumchapetaAnimal'] );
		// 					if($query->execute()){
		// 						$resultado = $query -> get_result();
		// 						$numero = $resultado -> num_rows;
		// 						$DatosUpdateCodigoAnimal = $resultado -> fetch_assoc();
		// 						$idAnimSis=$DatosUpdateCodigoAnimal['idAnimal'];
		// 						if($numero > 0){
		// 							/////////SECCION PARA CREAR CODIGO AUTOMATICO DEL SISTEMA////////////
		// 							$fechaRegistroConcat = date('YmdHis');
		// 							$codigoSistemaAnimal ="SENA_AGRO-".$fechaRegistroConcat."-".$idAnimSis;//SE GENERA EL CODIGO AUTOMATICO
		// 							//ACTUALIZACION DEL CAMPO DEL CODIGO AUTOMATICO
		// 							$query = $conn -> prepare("UPDATE animales SET codAnimal=? WHERE idAnimal =?;");
		// 							$query -> bind_param('si', $codigoSistemaAnimal, $idAnimSis);
		// 							if($query->execute()){
		// 								mysqli_commit($conn);
		// 								$jTableResult['msjCodigoAuto']="SE CREO EL CODIGO AUTOMATICO";
		// 								$jTableResult['restlCodigoAuto']="1";
		// 							}else{
		// 								$jTableResult['msj']="ERROR AL EJECUTAR ACTUALIZAR CODIGO AUTOMATICO DEL SISTEMA.";
		// 								$jTableResult['restl']="0";
		// 							}
		// 						}
		// 					}
		// 				}else{
		// 					mysqli_rollback($conn);
		// 					$jTableResult['msj']="ERROR AL EJECUTAR AL GUARDAR ANIMAL.";
		// 					$jTableResult['restl']="0";
		// 				}
		// 		}
		// 	}
		// 	print json_encode($jTableResult);
		// break;



		case 'guardarRegistro':
			$jTableResult['restl']="";
			$jTableResult['msj']="";
			$jTableResult['restlCodigoAuto']="";
			$jTableResult['msjCodigoAuto']="";
			if(($_POST['fechaNacimientoRegistro']=="") 
				OR ($_POST['nombreAnimalRegistro']=="") OR ($_POST['colorAnimalRegistro']=="") 
				OR ($_POST['pesoAnimalRegistro']=="") OR ($_POST['observacionesRegistro']=="") 
				OR ($_POST['unidadMedidaRegistro']=="0") OR ($_POST['idUnidad_FKRegistro']=="0") 
				OR ($_POST['idEspecie_FKRegistro']=="0") OR ($_POST['idRaza_FKRegistro']=="0") 
				OR ($_POST['idSexoRegistroAnimalfk']=="0") 
			)
			{ 
				$jTableResult['msj']="EXISTEN DATOS POR INGRESAR";
				$jTableResult['restl']="0";
			}else{
				//DESIGNAR EL ESTADO DE CRECIMIENTO DEL ANIMAL
				if($_POST['idSexoRegistroAnimalfk']==1){
					if($_POST['mesesAnimal']>24){
						$registroCrecimientoAnimal= 9;
						$nombreCrecimeinto= "toro reproductor";
					}else{
						$query = $conn->prepare("SELECT idCrecimiento, nombreCrecimiento
						FROM desarrollo_crecimiento
						WHERE 
							sexoAnimCrecimiento = 1 AND         -- Filtramos para machos
							etapaInicio <= ? AND                -- Comparamos que la edad del animal esté en el rango mínimo
							(etapaFin >= ? OR etapaFin IS NULL) -- Comparamos que no exceda el rango máximo o sea indefinido
						LIMIT 1");
						$query->bind_param('ii', $_POST['mesesAnimal'], $_POST['mesesAnimal']);
						if($query->execute()){
							$resultado = $query->get_result();
							$registroCrecimiento = $resultado->fetch_assoc();
							$jTableResult['nombreCrecimeinto']=$registroCrecimiento['nombreCrecimiento'];
							$registroCrecimientoAnimal = $registroCrecimiento['idCrecimiento'];
						}
					}
					///////GUARDAR ANIMAL//////
					$query = $conn->prepare("UPDATE animales SET fechaNacimiento=?, nombreAnimal=?, colorAnimal=?, pesoAnimal=?, observaciones=?, 
							unidadMedida=?, idUnidad_FK=?, idEspecie_FK=?, idRaza_FK=?, idSexo=?, horaRegistroAnimal=?, estadoVM=?, idUsuRegistro=?, DesarrolloAnimal_FK=?, metodoSer=?, madreAnimal=?, padreAnimal=? WHERE chapetaAnim=?");
					$query->bind_param('sssssiiiiisiiiiiis', 
					$_POST['fechaNacimientoRegistro'],
					$_POST['nombreAnimalRegistro'],
					$_POST['colorAnimalRegistro'],
					$_POST['pesoAnimalRegistro'],
					$_POST['observacionesRegistro'],
					$_POST['unidadMedidaRegistro'],
					$_POST['idUnidad_FKRegistro'],
					$_POST['idEspecie_FKRegistro'],
					$_POST['idRaza_FKRegistro'],
					$_POST['idSexoRegistroAnimalfk'],
					$horaTime,
					$estadoAnimal,
					$_POST['idUsuRegistro'],
					$registroCrecimientoAnimal,
					$_POST['idMetodoRegAnimal'],
					$_POST['idMadreAnimal'],
					$_POST['idPadreAnimal'],
					$_POST['NumchapetaAnimal'],
					);
					if($query->execute()){
						$jTableResult['msj']="REGISTRO GUARDADO CON EXITO.";
						$jTableResult['restl']="1";
						/////////CREAR CODIRGO DEL SISTEMA////
						$query = $conn->prepare("SELECT idAnimal FROM animales WHERE chapetaAnim =?");
						$query -> bind_param('s', $_POST['NumchapetaAnimal'] );
						if($query->execute()){
							$resultado = $query -> get_result();
							$numero = $resultado -> num_rows;
							$DatosUpdateCodigoAnimal = $resultado -> fetch_assoc();
							$idAnimSis=$DatosUpdateCodigoAnimal['idAnimal'];
							if($numero > 0){
								/////////SECCION PARA CREAR CODIGO AUTOMATICO DEL SISTEMA////////////
								$fechaRegistroConcat = date('YmdHis');
								$codigoSistemaAnimal ="SENA_AGRO-".$fechaRegistroConcat."-".$idAnimSis;//SE GENERA EL CODIGO AUTOMATICO
								//ACTUALIZACION DEL CAMPO DEL CODIGO AUTOMATICO
								$query = $conn -> prepare("UPDATE animales SET codAnimal=? WHERE idAnimal =?;");
								$query -> bind_param('si', $codigoSistemaAnimal, $idAnimSis);
								if($query->execute()){
									mysqli_commit($conn);
									$jTableResult['msjCodigoAuto']="SE CREO EL CODIGO AUTOMATICO";
									$jTableResult['restlCodigoAuto']="1";
								}else{
									$jTableResult['msj']="ERROR AL EJECUTAR ACTUALIZAR CODIGO AUTOMATICO DEL SISTEMA.";
									$jTableResult['restl']="0";
								}
							}
						}
					}else{
						mysqli_rollback($conn);
						$jTableResult['msj']="ERROR AL EJECUTAR AL GUARDAR ANIMAL.";
						$jTableResult['restl']="0";
					}
				}elseif($_POST['idSexoRegistroAnimalfk']==2){
					$query = $conn->prepare("SELECT idCrecimiento, nombreCrecimiento
					FROM desarrollo_crecimiento
					WHERE 
						sexoAnimCrecimiento = 2 AND         -- Filtramos para hembra
						etapaInicio <= ? AND                -- Comparamos que la edad del animal esté en el rango mínimo
						(etapaFin >= ? OR etapaFin IS NULL) -- Comparamos que no exceda el rango máximo o sea indefinido
					LIMIT 1");
					$query->bind_param('ii', $_POST['mesesAnimal'], $_POST['mesesAnimal']);
					if($query->execute()){
						$resultado = $query->get_result();
						$registroCrecimiento = $resultado->fetch_assoc();
						$jTableResult['nombreCrecimeinto']=$registroCrecimiento['nombreCrecimiento'];
						$registroCrecimientoAnimal = $registroCrecimiento['idCrecimiento'];
					}
							///////GUARDAR ANIMAL//////
							$query = $conn->prepare("UPDATE animales SET fechaNacimiento=?, nombreAnimal=?, colorAnimal=?, pesoAnimal=?, observaciones=?, 
							unidadMedida=?, idUnidad_FK=?, idEspecie_FK=?, idRaza_FK=?, idSexo=?, horaRegistroAnimal=?, estadoVM=?, idUsuRegistro=?, DesarrolloAnimal_FK=?, metodoSer=?, madreAnimal=?, padreAnimal=? WHERE chapetaAnim=?");
					$query->bind_param('sssssiiiiisiiiiiis', 
					$_POST['fechaNacimientoRegistro'],
					$_POST['nombreAnimalRegistro'],
					$_POST['colorAnimalRegistro'],
					$_POST['pesoAnimalRegistro'],
					$_POST['observacionesRegistro'],
					$_POST['unidadMedidaRegistro'],
					$_POST['idUnidad_FKRegistro'],
					$_POST['idEspecie_FKRegistro'],
					$_POST['idRaza_FKRegistro'],
					$_POST['idSexoRegistroAnimalfk'],
					$horaTime,
					$estadoAnimal,
					$_POST['idUsuRegistro'],
					$registroCrecimientoAnimal,
					$_POST['idMetodoRegAnimal'],
					$_POST['idMadreAnimal'],
					$_POST['idPadreAnimal'],
					$_POST['NumchapetaAnimal'],
					);
					if($query->execute()){
						$jTableResult['msj']="REGISTRO GUARDADO CON EXITO.";
						$jTableResult['restl']="1";
						/////////CREAR CODIRGO DEL SISTEMA////
						$query = $conn->prepare("SELECT idAnimal FROM animales WHERE chapetaAnim =?");
						$query -> bind_param('s', $_POST['NumchapetaAnimal'] );
						if($query->execute()){
							$resultado = $query -> get_result();
							$numero = $resultado -> num_rows;
							$DatosUpdateCodigoAnimal = $resultado -> fetch_assoc();
							$idAnimSis=$DatosUpdateCodigoAnimal['idAnimal'];
							if($numero > 0){
								/////////SECCION PARA CREAR CODIGO AUTOMATICO DEL SISTEMA////////////
								$fechaRegistroConcat = date('YmdHis');
								$codigoSistemaAnimal ="SENA_AGRO-".$fechaRegistroConcat."-".$idAnimSis;//SE GENERA EL CODIGO AUTOMATICO
								//ACTUALIZACION DEL CAMPO DEL CODIGO AUTOMATICO
								$query = $conn -> prepare("UPDATE animales SET codAnimal=? WHERE idAnimal =?;");
								$query -> bind_param('si', $codigoSistemaAnimal, $idAnimSis);
								if($query->execute()){
									mysqli_commit($conn);
									$jTableResult['msjCodigoAuto']="SE CREO EL CODIGO AUTOMATICO";
									$jTableResult['restlCodigoAuto']="1";
								}else{
									$jTableResult['msj']="ERROR AL EJECUTAR ACTUALIZAR CODIGO AUTOMATICO DEL SISTEMA.";
									$jTableResult['restl']="0";
								}
							}
						}
					}else{
						mysqli_rollback($conn);
						$jTableResult['msj']="ERROR AL EJECUTAR AL GUARDAR ANIMAL.";
						$jTableResult['restl']="0";
					}
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
						if($_POST['tamanoPantalla']==0){
							$jTableResult['listaAnimales'].="<thead><tr>z<th scope='col'>Nombre</th><th scope='col'>Op</th></tr></thead>";
							while($registro = mysqli_fetch_array($resultado))
								{
									$jTableResult['listaAnimales'].="
									<tr >
				
										<td width='20%'>".utf8_decode($registro['nombreAnimal'])."</td>
										<td>
											<button 
												id='btnEdiarAnimal'
												class='btn btn-success btn-sm'											
												class='btn btn-success'
												data-toggle='modal'
												data-target='#updateAnimal' 
												data-idAnimal='".$registro['idAnimal']."' 
												style='margin-right:1rem;'>
												$varIconoEditar
											</button>
										</td>
									</tr>";
									$jTableResult['result']="1";
								}						
						}
						else{
							$jTableResult['listaAnimales'].="<thead><tr>z<th scope='col'>Nombre</th><th scope='col'>Op</th></tr></thead>";
						while($registro = mysqli_fetch_array($resultado))
							{
								$jTableResult['listaAnimales'].="
								<tr >
			
									<td width='20%'>".utf8_decode($registro['nombreAnimal'])."</td>
									<td>
										<button 
											id='btnEdiarAnimal'
											class='btn btn-success btn-sm'											
											class='btn btn-success'
											data-toggle='modal' 
											data-target='#updateAnimal' 
											data-idAnimal='".$registro['idAnimal']."' 
											style='margin-right:1rem;'>
											$varIconoEditar
										</button>
										<button class='btn' id='btnCamaraAnimal' 
											name='btnCamaraAnimal'  data-toggle='modal' 
											data-idAnimalFoto='".$registro['idAnimal']."' 
											data-target='#modalCameraAnimal' style='background-color: #FFC300; color: black;'><i class='fa-solid fa-camera'></i>
										</button>
									</td>
								</tr>";
								$jTableResult['result']="1";
							}						
						}
								
					}	
			print json_encode($jTableResult);
		break;

		case 'listaRazas':
			$jTableResult = array();
			$jTableResult['listaRazas']= "";
			$query = "SELECT idRaza, nombreRaza FROM raza WHERE idEspecieFK= '".$_POST['idEspecie_FKRegistro']."';";
			$resultado = mysqli_query($conn, $query);
			$numero = mysqli_num_rows($resultado);
			$jTableResult['numeroFilas'] = $numero;
			$jTableResult['listaRazas'] .= "<div class='card'>
								<div class='card-header' style='background-color:$varCabeceraTabla; color: white;'>
									<h5 class='card-title'>LISTA DE RAZAS</h5>
									<div class='d-flex justify-content-end align-items-center'>   
										<p>total: <strong>$numero</strong></p>
									</div>
								</div>
								<div class='card-body' style='max-height: 400px; overflow-y: auto;'>";
			if($numero > 0) {
				while($registro = mysqli_fetch_array($resultado)) { 
					$jTableResult['listaRazas'] .= "<div class='card mb-10'>
														<div class='card-body'>
															<div class='row'>
																<div class='col-sm-6'>
																	<h6 class='modal-title'>".$registro['nombreRaza']."</h6>
																</div>
																<div class='col-sm-6 d-flex justify-content-end align-items-center'>
																	<button class='btn' id='btnDellRaza' data-idRaza='".$registro['idRaza']."' data-nombreraza='".$registro['nombreRaza']."' data-tipo='3' style='background-color: red; color: #fff; margin-right: 0.5rem;'><i class='fa-solid fa-trash'></i></button>
																	<button class='btn' id='openModalRazaUpdate' data-idRazaUpdate='".$registro['idRaza']."' data-nombrerazaUpdate='".$registro['nombreRaza']."' data-tipo-update='3' data-toggle='modal' data-target='#listarActualizarCard' style='background-color: #FFC300; color: black;'><i class='fa-solid fa-pen-to-square'></i></button>
																</div>                                                    
															</div>                    
														</div>
													</div>";
				}
			} else {
				$jTableResult['listaRazas'] .= "<div class='card mb-10'>
													<div class='card-body'>
														<center><h6>NO SE ENCONTRARON RESULTADOS</h6></center>                
													</div>
												</div>";
			}
			$jTableResult['listaRazas'] .= "    </div>
											</div>";
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
		case 'llenarDatosFromAnimal':
			$jTableResult = array();
				$jTableResult['msj']= "";
				$jTableResult['restl']= "";				
				$jTableResult['fechaRegistro']= "";				
				$jTableResult['fechaNacimiento']= "";				
				$jTableResult['codAnimal']= "";				
				$jTableResult['codigoSena']= "";				
				$jTableResult['nombreAnimal']= "";				
				$jTableResult['colorAnimal']= "";				
				$jTableResult['pesoAnimal']= "";				
				$jTableResult['unidadMedida']= "";				
				$jTableResult['observaciones']= "";				
				$jTableResult['idUnidad_FK']= "";				
				$jTableResult['idEspecie_FK']= "";				
				$jTableResult['idRaza_FK']= "";				
				$jTableResult['idSexo']= "";				
				$query = $conn -> prepare("SELECT fechaRegistro, fechaNacimiento, codAnimal, codigoSena, nombreAnimal, colorAnimal, pesoAnimal, unidadMedida, observaciones, idUnidad_FK, idEspecie_FK, idRaza_FK, idSexo FROM animales WHERE idAnimal =?");
				$query -> bind_param('i', $_POST['idAnimalLLenarFrom']);
				if($query -> execute()){
					$resultado = $query -> get_result();
					while($registro = $resultado -> fetch_assoc()){
						$jTableResult['fechaRegistro']= $registro['fechaRegistro'];				
						$jTableResult['fechaNacimiento']= $registro['fechaNacimiento'];				
						$jTableResult['codAnimal']= $registro['codAnimal'];				
						$jTableResult['codigoSena']= $registro['codigoSena'];				
						$jTableResult['nombreAnimal']= $registro['nombreAnimal'];				
						$jTableResult['colorAnimal']= $registro['colorAnimal'];				
						$jTableResult['pesoAnimal']= $registro['pesoAnimal'];				
						$jTableResult['unidadMedida']= $registro['unidadMedida'];				
						$jTableResult['observaciones']= $registro['observaciones'];				
						$jTableResult['idUnidad_FK']= $registro['idUnidad_FK'];				
						$jTableResult['idEspecie_FK']= $registro['idEspecie_FK'];				
						$jTableResult['idRaza_FK']= $registro['idRaza_FK'];				
						$jTableResult['idSexo']= $registro['idSexo'];	
					}
				}else{
					$jTableResult['msj']= "NO SE PUEDO EJECUTAR LA CONSULTA";
					$jTableResult['restl']= "0";		
				}
			print json_encode($jTableResult);
		break;
		case 'updateAnimal':
			$jTableResult['restl']="";
			$jTableResult['msj']="";
			if(($_POST['fechaNacimientoRegistroUpdate']=="") 
				OR ($_POST['nombreAnimalRegistroUpdate']=="") OR ($_POST['colorAnimalRegistroUpdate']=="") 
				OR ($_POST['pesoAnimalRegistroUpdate']=="")
				OR ($_POST['unidadMedidaRegistroUpdate']=="0") OR ($_POST['idUnidad_FKRegistroUpdate']=="0") 
				OR ($_POST['idEspecie_FKRegistroUpdate']=="0") OR ($_POST['idRaza_FKRegistroUpdate']=="0") 
				OR ($_POST['idSexoRegistroAnimalfkUpdate']=="0") OR ($_POST['codigoSenaRegistroUpdate']==""))
			{
				$jTableResult['msj']="EXISTEN DATOS POR INGRESAR";
				$jTableResult['restl']="0";
			}else{
				$query = $conn -> prepare("UPDATE animales SET codigoSena=?, fechaNacimiento=?, nombreAnimal=?, colorAnimal=?, pesoAnimal=?, unidadMedida=?, observaciones=?, idUnidad_FK=?, idEspecie_FK=?, idRaza_FK=?, idSexo=?, idUsuRegistro=?	WHERE idAnimal=?");
				$query -> bind_param('ssssiisiiiiii',
					$_POST['codigoSenaRegistroUpdate'],
					$_POST['fechaNacimientoRegistroUpdate'],
					$_POST['nombreAnimalRegistroUpdate'],
					$_POST['colorAnimalRegistroUpdate'],
					$_POST['pesoAnimalRegistroUpdate'],
					$_POST['unidadMedidaRegistroUpdate'],
					$_POST['observacionesRegistroUpdate'],
					$_POST['idUnidad_FKRegistroUpdate'],
					$_POST['idEspecie_FKRegistroUpdate'],
					$_POST['idRaza_FKRegistroUpdate'],
					$_POST['idSexoRegistroAnimalfkUpdate'],
					$_POST['idUsuRegistroUpdate'],
					$_POST['idAnimalUp'],
				);
				if($query -> execute()){
					$jTableResult['msj']="REGISTRO ACTUALIZADO EXITOSAMENTE";
					$jTableResult['restl']="1";
				}else{
					$jTableResult['msj']= "NO SE PUEDO EJECUTAR LA CONSULTA";
					$jTableResult['restl']="0";
				}
			}
			print json_encode($jTableResult);
		break;
	}		
mysqli_close($conn);
?> 