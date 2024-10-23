<?php
	include("../../include/conex.php");
	include("../../include/parametros_index.php");
	$conn=Conectarse();
	switch ($_REQUEST['action']) 
	{
		/////////PARTOS LAURA/////////////////////////
		case 'listarCardParto':
			$jTableResult = array();
			$jTableResult['tabsParto'] = "";
			$jTableResult['numeroFilas'] = "";
			$var_dato_parto = $_POST['idAnimalParto'];
			$query = "SELECT idPartos, idAnimalParto_FK, fechaParto, pesoNacidoParto, sexoCria, unidadPeso, observacionesParto FROM partos WHERE idAnimalParto_FK ='".$var_dato_parto."';";
			$resultado = mysqli_query($conn, $query);
			$numero = mysqli_num_rows($resultado);
			$jTableResult['numeroFilas'] = $numero;
			$jTableResult['tabsParto'] .= "<div class='card'>
								<div class='card-header' style='background-color:$varCabeceraTabla; color: white;'>
									<h5 class='card-title'>LISTA DE PARTOS</h5>
									<div class='d-flex justify-content-end align-items-center'>   
										<p >total: <strong>$numero</strong></p>
										<input id='ttlPartosAnimal' value='".$numero."'>
									</div>
								</div>
								<div class='card-body' style='max-height: 400px; overflow-y: auto;'>";
			if($numero > 0) {
				while($registro = mysqli_fetch_array($resultado)) { 
					$jTableResult['tabsParto'] .= "<div class='card mb-10'>
														<div class='card-body'>
															<div class='row'>
																<div class='row' >
																	<div class='col-sm-3' >
																		<h6 class='modal-title'><strong>Fecha: </strong></h6>
																	</div>												
																	<div class='col-sm-4' >
																		<h6 class='modal-title'>".$registro['fechaParto']."</h6>
																	</div>
																	<div class='col-sm-5 d-flex justify-content-end align-items-center'>
																		<button type='button' id='deleteParto' data-idPartoDelete ='".$registro['idPartos']."' class='btn' style='background-color: red; color: #fff; margin-right: 0.5rem;'><i class='fa-solid fa-trash'></i></button>
																		<button type='button' id='updateParto' data-idPartoUpdate ='".$registro['idPartos']."' data-toggle='modal'
																		data-target='#mdPartosUpdate' class='btn' style='background-color: #ffc300;'><i class='fa-solid fa-pen-to-square'></i></button>
																	</div>								
																</div>         
																<div class='row' >
																	<div class='col-sm-3' >
																		<h6 class='modal-title'><strong>sexo: </strong></h6>
																	</div>												
																	<div class='col-sm-4' >
																		<h6 class='modal-title'>".(($registro['sexoCria'])=='1' ? 'Macho' : 'Hembra')."</h6>
																	</div>							
																</div>                                                 
																<div class='row' >
																	<div class='col-sm-5' >
																		<h6 class='modal-title'><strong>observaciones: </strong></h6>
																	</div>												
																	<div class='col-sm-4' >
																		<h6 class='modal-title'>".$registro['observacionesParto']."</h6>
																	</div>							
																</div>                                                 
															</div>                    
														</div>
													</div>";
				}
			} else {
				$jTableResult['tabsParto'] .= "<div class='card mb-10'>
													<div class='card-body'>
														<center><h6>NO SE ENCONTRARON RESULTADOS</h6></center>                
													</div>
												</div>";
			}
			$jTableResult['tabsParto'] .= "    </div>
											</div>";
			print json_encode($jTableResult);
		break;
		case 'GuardarParto': // codigoVacaCase este nombre es asignado por uno, no viene de ningun lado
			$jTableResult = array();
			$jTableResult['msj']=""; 
			$jTableResult['resultd']="";
			if($_POST['estadCriaP']==1){//ESTADO VIVA
				if(($_POST['fechPart']=="") OR ($_POST['sexCriaP']==0) 
					OR ($_POST['pesoNaceCria']=="") OR ($_POST['UnidPeso']==0)){
					$jTableResult['msj']="CAMPOS OBLIGATORIOS";
					$jTableResult['resultd']="0";
				}else{
					$query = $conn -> prepare("INSERT INTO partos 
					(idAnimalParto_FK, 
					fechaParto, 
					pesoNacidoParto, 
					sexoCria, 
					unidadPeso, 
					responsable, 
					observacionesParto,
					tokenAleatorioParto) 
					VALUES(?, ?, ?, ?, ?, ?, ?, ?)");	
					$query -> bind_param('isiiiiss', 
					$_POST['codiVacaPart'], 
					$_POST['fechPart'], $_POST['pesoNaceCria'], 
					$_POST['sexCriaP'], $_POST['UnidPeso'], 
					$_POST['idRespPartCria'], 
					$_POST['ObsevacionParto'], 
					$_POST['tokenFormPartosVivo']);
					if($query->execute()){
						mysqli_commit($conn);
						$jTableResult['msj']="DATO GUARDADO CORRECTAMENTE";
						$jTableResult['resultd']="1";
					}else{
						mysqli_rollback($conn);
						$jTableResult['msj']="NO SE EJECUTO LA CONSULTA";
						$jTableResult['resultd']="0";
					}
				}
			}elseif($_POST['estadCriaP']==2){//CRIA MUERTA
				if(
					($_POST['fechPerdidaC']=="") OR ($_POST['pesoNaceCriaP']="") OR 
					($_POST['sexCriaPerd']==0) OR ($_POST['UnidPesoP']==0) OR
					($_POST['estadCriaP']==0)){
					$jTableResult['msj']="CAMPOS OBLIGATORIOS";
					$jTableResult['resultd']="0";
				}else{
					$query = $conn -> prepare("INSERT INTO perdida_cria (fechaPerdidaCria, 
					idAnimalPerdidaCria, 
					pesoPerdidaCria, 
					sexoPerdidaCria, 
					UnidadPesoPerdidaCria, 
					responsablePerdidaCria, 
					observacionesPerdidaCria, 
					estadoCriaPerdida) VALUES(?, ?, ?, ?, ?, ? ,?, ?)");	
					$query -> bind_param('siiiiisi', 
					$_POST['fechPerdidaC'], 
					$_POST['codiVacaPartP'], 
					$_POST['pesoNaceCriaP'], 
					$_POST['sexCriaPerd'], 
					$_POST['UnidPesoP'], 
					$_POST['idRespPartCriaP'], 
					$_POST['ObsevacionPartoP'], 
					$_POST['estadCriaP']);
					if($query->execute()){
						mysqli_commit($conn);
						$jTableResult['msj']="DATO GUARDADO CORRECTAMENTE. MUERTE DE LA CRIA";
						$jTableResult['resultd']="1";
					}else{
						mysqli_rollback($conn);
						$jTableResult['msj']="NO SE EJECUTO LA CONSULTA";
						$jTableResult['resultd']="0";
					}
				}
			}elseif(($_POST['estadCriaP']==3) OR ($_POST['estadCriaP']==4)){//ABORTO O PERDIDA HEMRBIONARIA
				if(($_POST['fechPerdidaC']=="") OR
				($_POST['estadCriaP']==0)){
					$jTableResult['msj']="CAMPOS OBLIGATORIOS";
					$jTableResult['resultd']="0";
				}else{
					$query = $conn -> prepare("INSERT INTO perdida_cria (fechaPerdidaCria, 
					idAnimalPerdidaCria, 
					responsablePerdidaCria, 
					observacionesPerdidaCria, 
					estadoCriaPerdida) VALUES(?, ?, ?, ?, ?)");	
					$query -> bind_param('siisi', 
					$_POST['fechPerdidaC'], 
					$_POST['codiVacaPartP'], 
					$_POST['idRespPartCriaP'], 
					$_POST['ObsevacionPartoP'], 
					$_POST['estadCriaP']);
					if($query->execute()){
						mysqli_commit($conn);
						$jTableResult['msj']="DATO GUARDADO CORRECTAMENTE. MUERTE DE LA CRIA";
						$jTableResult['resultd']="1";
					}else{
						mysqli_rollback($conn);
						$jTableResult['msj']="NO SE EJECUTO LA CONSULTA";
						$jTableResult['resultd']="0";
					}
				}
			}
			print json_encode($jTableResult);
		break;
		case 'deleteCardParto':
			$jTableResult = array();
			$jTableResult['msj']=""; 
			$jTableResult['resultd']="";
			$query = $conn -> prepare("DELETE FROM partos WHERE idPartos=?");
			$query -> bind_param('i', $_POST['idPartoDeleteAnimal']);
			if($query -> execute()){
				mysqli_commit($conn);
				$jTableResult['msj']="DATO ELIMINADO CORRECTAMENTE.";
				$jTableResult['resultd']="1";
			}else{
				mysqli_rollback($conn);
				$jTableResult['msj']="NO SE EJECUTO LA CONSULTA";
				$jTableResult['resultd']="0";
			}
			print json_encode($jTableResult);
		break;
		case 'llenarFormActuParto':
			$jTableResult = array();
			$jTableResult['idPartos']="";
			$jTableResult['idAnimalParto_FK']="";
			$jTableResult['fechaParto']="";
			$jTableResult['pesoNacidoParto']="";
			$jTableResult['sexoCria']="";
			$jTableResult['unidadPeso']="";
			$jTableResult['observacionesParto']="";
			$query = $conn -> prepare("SELECT idPartos, idAnimalParto_FK, fechaParto, pesoNacidoParto, sexoCria, unidadPeso, observacionesParto FROM partos WHERE idPartos =?;");
			$query -> bind_param('i', $_POST['idCardParto']);
			if($query -> execute()){
				$resultado = $query -> get_result();
				while($registro = $resultado -> fetch_assoc()){
					$jTableResult['idPartos']= $registro['idPartos'];
					$jTableResult['idAnimalParto_FK']= $registro['idAnimalParto_FK'];
					$jTableResult['fechaParto']= $registro['fechaParto'];
					$jTableResult['pesoNacidoParto']= $registro['pesoNacidoParto'];
					$jTableResult['sexoCria']= $registro['sexoCria'];
					$jTableResult['unidadPeso']= $registro['unidadPeso'];
					$jTableResult['observacionesParto']= $registro['observacionesParto'];
				}
			}else{
				$jTableResult['msj']="NO SE EJECUTO LA CONSULTA";
				$jTableResult['resultd']="0";
			}
			print json_encode($jTableResult);
		break;
		case 'updateParto':
			$jTableResult = array();
			$jTableResult['msj']=""; 
			$jTableResult['resultd']="";
			if(($_POST['fechPartUp']=="") OR ($_POST['sexCriaUp']==0) OR ($_POST['pesoNaceCriaUp']=="") OR ($_POST['UnidPesoUp']==0)){
				$jTableResult['msj']="CAMPOS OBLIGATORIOS";
                $jTableResult['resultd']="0";
			}else{
				$query = $conn -> prepare("UPDATE partos SET fechaParto=?, pesoNacidoParto=?, sexoCria=?, unidadPeso=?, responsable=?, observacionesParto=? WHERE idPartos=?");
				$query -> bind_param('siiiisi', $_POST['fechPartUp'], $_POST['pesoNaceCriaUp'], $_POST['sexCriaUp'], $_POST['UnidPesoUp'], $_POST['idRespPartCriaUp'], $_POST['ObsevacionPartoUp'], $_POST['codiPart']);
				if ($query->execute()){
					mysqli_commit($conn);
					$jTableResult['msj']="DATO ACTUALIZADO CORRECTAMENTE";
					$jTableResult['resultd']="1";
				} else {
					mysqli_rollback($conn);
					$jTableResult['msj']="ERROR AL ACTUALIZAR. INTENTE NUEVAMENTE.";
					$jTableResult['resultd']="0";
				}
			}
			print json_encode($jTableResult);
		break;
		/////////FIN PARTOS LAURA/////////////////////////
		// CODIGO PARA GUARDAR CHEQUEO
		case 'GuardarChequeo': // codigoVacaCase este nombre es asignado por uno, no viene de ningun lado
			$jTableResult = array();
				$jTableResult['msj']=""; // listVaca este nombre es asignado por uno, no viene de ningun lado
				$jTableResult['result']="";
				$query="INSERT INTO chequeo SET 
				estadoGestacionCheq = '".$_POST['estGestacion']."',
				fechPosibPartCheq = '".$_POST['fechPosibParto']."',
				observacionesCheq = '".$_POST['obsrvChequeo']."',
				fechChequeo = '".$_POST['fechaDCheq']."',
				fechRegistro = '".$_POST['fechaRegisCheq']."', 
				semGestacion = '".$_POST['semanasDGestacion']."', 
				nombreUsuRegistro = '".$_POST['nomUsuRegis']."', 
				idUsuRegistro = '".$_POST['idUsuarioRegis']."', 
				idAnimal = '".$_POST['idRazVacaCheq']."', 
				celoChequeo = '".$_POST['celoCheqJs']."', 
				fechUltservBaseCheq = '".$_POST['fechUltSerJs']."', 
				fechSecaBaseCheq = '".$_POST['fechSecJs']."', 
				responsableCheq = '".$_POST['RespCheq']."';";
				if ($resultado = mysqli_query($conn, $query))
					{
						mysqli_commit($conn);
						$jTableResult['msj']="DATO GUARDADO CORRECTAMENTE"; 
						$jTableResult['result']="1";
					}
				else
					{
						mysqli_rollback($conn);
						$jTableResult['msj']="ERROR AL GUARDAR, VUELVA A INTENTAR"; 
						$jTableResult['result']="0";
					}
			print json_encode($jTableResult);
		break;
		// CODIGO PARA GUARDAR ALARMA
		case 'GuardarAlarma': // codigoVacaCase este nombre es asignado por uno, no viene de ningun lado
			$jTableResult = array();
				$jTableResult['msj']=""; // listVaca este nombre es asignado por uno, no viene de ningun lado
				$jTableResult['resultad']="";
				$query="INSERT INTO alertas SET 
				secadoAlert = '".$_POST['secadoAlarmJs']."',
				partoAlert = '".$_POST['partoAlarmJs']."',
				fechAlertSec = '".$_POST['fechAlarmSecJs']."',
				fechAlertPart = '".$_POST['fechAlarmPartJs']."',
				lunesAlert = '".$_POST['lunAlarmSecJs']."',
				martesAlarm = '".$_POST['marAlarmSecJs']."', 
				miercolesAlarm = '".$_POST['mierAlarmSecJs']."', 
				juevesAlarm = '".$_POST['jueAlarmSecJs']."', 
				viernesAlarm = '".$_POST['vierAlarmSecJs']."', 
				sabadoAlarm = '".$_POST['sabAlarmSecJs']."', 
				idAnimalAlert = '".$_POST['idRazVacaCheqAlarm']."', 
				horaAlerta = '".$_POST['relojAlarmSecJs']."';";
				if ($respuesta = mysqli_query($conn, $query))
					{
						mysqli_commit($conn);
						$jTableResult['msj']="DATO GUARDADO CORRECTAMENTE"; 
						$jTableResult['resultad']="1";
					}
				else
					{
						mysqli_rollback($conn);
						$jTableResult['msj']="ERROR AL GUARDAR, VUELVA A INTENTAR"; 
						$jTableResult['resultad']="0";
					}
			print json_encode($jTableResult);
		break;
		//CODIGO PARA TRAER LA ULTIMA FECHA DE SEVICIO DE LA BASE DE DATOS
		case 'fechUltmServ':
			$jTableResult['fechaCeloV']="";
			$sql = "SELECT fechaCelo FROM servicio WHERE codigoVacaRep = '".$_POST['idanimalCheq']."' ORDER BY fechaCelo DESC LIMIT 1;";
			$result = mysqli_query($conn, $sql);
			//$row = mysqli_fetch_assoc($result);
			while($registro = mysqli_fetch_array($result))
				{
					$jTableResult['fechaCeloV']= $registro['fechaCelo'];
				}
			print json_encode($jTableResult);
		break;
		// CODIGO PARA TRAER LA FECHA DE LA ALARMA CONFIGURADA
		case 'fechAlarmPart':
			$jTableResult['fechAlertParto']="";
			$sql = "SELECT fechAlertPart FROM alertas ORDER BY fechAlertPart DESC LIMIT 1;";
			$result = mysqli_query($conn, $sql);
			//$row = mysqli_fetch_assoc($result);
			while($registro = mysqli_fetch_array($result))
				{
					$jTableResult['fechAlertParto']= $registro['fechAlertPart'];
				}
			print json_encode($jTableResult);
		break;
		case 'consultaBase':
			$jTableResult['fechAlertParto']="";
			$sql = "SELECT fechAlertPart FROM alertas;";
			$result = mysqli_query($conn, $sql);
			//$row = mysqli_fetch_assoc($result);
			while($registro = mysqli_fetch_array($result))
				{
					$jTableResult['fechAlertParto']= $registro['fechAlertPart'];
				}
			print json_encode($jTableResult);
		break;
		// CODIGO PARA LISTAR LOS CHEQUEOS REGISTRADOS
		case 'listChequeo':
			$jTableResult = array();
			$rows = array();
			$sql = "SELECT fechRegistro, fechChequeo, estadoGestacionCheq, idChequeo FROM chequeo WHERE idAnimal = '".$_POST['idanimalCheq']."'";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
				$rowData = array(
					'fechaRegBar' => mysqli_real_escape_string($conn, $row['fechRegistro']),
					'chequeosBase' => mysqli_real_escape_string($conn, $row['fechChequeo']),
					'estadoGestBar' => mysqli_real_escape_string($conn, $row['estadoGestacionCheq']),
					'idestadoGestBar' => mysqli_real_escape_string($conn, $row['idChequeo'])
				);
				$rows[] = $rowData;
			}
			$jTableResult['rows'] = $rows;
			print json_encode($jTableResult);
		break;
		case 'actualizarTttlPartosAnimal':
			$jTableResult = array();
			$query = $conn->prepare("UPDATE animales SET ttlPartosAnimal=? WHERE idAnimal=?");
			$query -> bind_param('ii', $_POST['ttlPartosAnimal'], $_POST['idAnimalTtlPartos']);
			if($query->execute()){
				
			}else{
				
			}
		break;
		case 'actualizarFechaUltimoParto':
			$query = $conn->prepare("SELECT fechaParto FROM partos WHERE idAnimalParto_FK=? ORDER BY  fechaParto DESC LIMIT 1");
			$query -> bind_param('i', $_POST['idAnimalFechUltPartos']);
			if($query->execute()){
				$resultado = $query -> get_result();
				$registro = $resultado->fetch_assoc();
				$fechaUltimoParto = $registro['fechaParto'];
				echo"fecha ultimo parto es: ". $fechaUltimoParto;
				// Crear un objeto DateTime a partir de la fecha inicial
				$fecha = new DateTime($fechaUltimoParto);

				// Agregar 12 meses
				$fecha->modify('+10 months');

				// Obtener la nueva fecha
				$nuevaFecha = $fecha->format('Y-m-d');
				echo "fecha de lactancia es: ".$nuevaFecha;
				$query = $conn->prepare("UPDATE animales SET inicioLactancia=?, finLactancia=? WHERE idAnimal=?");
				$query -> bind_param('ssi', $fechaUltimoParto, $nuevaFecha, $_POST['idAnimalFechUltPartos']);
				$query->execute();
			}
		break;
	}
mysqli_close($conn);
?>