<?php
	header('Cache-Control: no-cache, must-revalidate');
	include('../../include/parametros_index.php');
	date_default_timezone_set('America/Bogota');
	include('../../include/conex.php');
	session_start();
	$conn=Conectarse();
	//$horaTime =date("H:i:s");
	// echo "action :  ".$_REQUEST['action']; exit();
	Switch ($_REQUEST['action']) 
	{ 
		case 'numCelosF':
			
			$jTableResult = array();
				
				$jTableResult['ttlServicioF']="";

				$query="SELECT idReproduccion from servicio WHERE codigoVacaRep='".$_POST['idAnimalTtlF']."';";
					$resultado=mysqli_query($conn, $query);
					$numeroSer=mysqli_num_rows($resultado);
					$jTableResult['ttlServicioF']=$numeroSer;
			print json_encode($jTableResult);
		break;
	
		case 'buscarPajillaUpdate'://BUSCAR INFORMACION PARA LLENAR FORMULARIO A ACTUALIZAR
			$jTableResult = array();
				$jTableResult['numeroRegistroPa']="";
				$jTableResult['nombreToroPa']="";
				$jTableResult['razaListaPajillaAid']="";
				$jTableResult['idPajlaUp']="";
				$query ="SELECT idPajilla, numeroRegistro, nombrePajilla, razaPajilla FROM pajilla WHERE idPajilla = '".$_POST['idPajiUpdate']."';";
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['numeroRegistroPa']=$registro['numeroRegistro']; //cambiar datos por los de la tabla
						$jTableResult['nombreToroPa']=$registro['nombrePajilla'];
						$jTableResult['razaListaPajillaAid']=$registro['razaPajilla'];
						$jTableResult['idPajlaUp']=$registro['idPajilla'];
					}		
			print json_encode($jTableResult);
		break;
		case 'buscarCeloUpdate'://BUSCAR INFORMACION PARA LLENAR FORMULARIO A ACTUALIZAR
			//echo "el id del celo es: ".$_POST['idcelUpdate'];
			$jTableResult = array();
				$idTipoCeloUpdate = $_POST['tipCeloUpdate'];
				$jTableResult['fechaCeloUp']="";
				$jTableResult['servidoUp']="";
				$jTableResult['metodoRepUp']="";
				$jTableResult['numeroRegistroMUpda']="";
				$jTableResult['observacionesServUp']="";

				if($idTipoCeloUpdate == 1 or $idTipoCeloUpdate == 2 ){
					$jTableResult['fechaCeloUp']="";
					$jTableResult['servidoUp']="";
					$jTableResult['metodoRepUp']="";
					$jTableResult['numeroRegistroMUpda']="";
					$jTableResult['observacionesServUp']="";
					$query = "SELECT idReproduccion, fechaCelo, servido, metodoRep, numeroRegistroM, observacionesServ FROM servicio WHERE idReproduccion ='".$_POST['idcelUpdate']."';";
					$resultado = mysqli_query($conn, $query);
					while($registro = mysqli_fetch_array($resultado))
						{
							$jTableResult['fechaCeloUp']=$registro['fechaCelo'];
							$jTableResult['servidoUp']=$registro['servido'];
							$jTableResult['metodoRepUp']=$registro['metodoRep'];
							$jTableResult['numeroRegistroMUpda']=$registro['numeroRegistroM'];
							$jTableResult['observacionesServUp']=$registro['observacionesServ'];
						}	
				}
				else{
						if($idTipoCeloUpdate == 3){
							$jTableResult['servidoUp']="";
							$jTableResult['observacionesServUp']="";
							$jTableResult['fechaCeloUp']="";
							$query = "SELECT idReproduccion, fechaCelo, servido, metodoRep, numeroRegistroM, observacionesServ FROM servicio WHERE idReproduccion ='".$_POST['idcelUpdate']."';";
							$resultado = mysqli_query($conn, $query);
							while($registro = mysqli_fetch_array($resultado))
							{
								$jTableResult['fechaCeloUp']=$registro['fechaCelo'];
								$jTableResult['servidoUp']=$registro['servido'];
								$jTableResult['observacionesServUp']=$registro['observacionesServ'];
							}	
						}
					}
			print json_encode($jTableResult);
		break;



		//arrelo lista de tarjetas que se muestran de con boton monta
		case 'arregloMonta':
				$jTableResult = array();
					$jTableResult['tabsMonta']="";
					$jTableResult['numeroFilas'] = "";
					$query="SELECT servicio.idReproduccion,
					servicio.codigoVacaRep,
					animales.nombreAnimal as nombreAnimMonta,
					animales.codAnimal AS codigoAnimMonta,
					servicio.fechaCelo, 
					servicio.servido,
					servicio.metodoRep,
					servicio.numeroRegistroM,
					servicio.observacionesServ
					FROM servicio
					INNER JOIN animales  
					ON servicio.numeroRegistroM = animales.idAnimal
					WHERE  metodoRep = 1  AND codigoVacaRep ='".$_POST['idAnimalListCelo']."' ORDER BY `fechaCelo` DESC ;";
					$resultado = mysqli_query($conn, $query);
					$numero = mysqli_num_rows($resultado);
					$jTableResult['numeroFilas'] = $numero;
					$jTableResult['tabsMonta'] .= "<div class='card'>
                                    <div class='card-header' style='background-color:$varCabeceraTabla; color: white;'>
                                        <h5 class='card-title'>LISTA MONTA</h5>
										<div class=' d-flex justify-content-end align-items-center'>   
											<p>total: <strong>$numero</strong></p>
										</div>
                                    </div>
                                    <div class='card-body' style='max-height: 400px; overflow-y: auto;'>
                    ";
					while($registro = mysqli_fetch_array($resultado)){ 
						$jTableResult['tabsMonta'] .= "<div class='card mb-10'>
                                        <div class='card-body'>
											<div class='row' >
											    <!--<div>
													<input type='text' id='idServicioAn' value='" . $registro['idReproduccion'] . "'>
												</div>-->
												
												<div class='col-sm-3' >
													<h6 class='modal-title'><strong>Fecha: </strong></h6>
												</div>												
												<div class='col-sm-4' >
													<h6 class='modal-title'>'".$registro['fechaCelo']."'</h6>
												</div>
												<div class='col-sm-5 d-flex justify-content-end align-items-center'>
												
													<button class='btn' id='btnEliminarCardCel' data-idReproduccion='".$registro['idReproduccion']."'  data-tipo='1' style='background-color: red; color: #fff;  margin-right: 1rem;'><i class='fa-solid fa-trash'></i></button>     

													<button class='btn' id='btnActualizarCardCelo' data-idReproduccionCeloUpdate='".$registro['idReproduccion']."'  data-tipo-update='1'  data-toggle='modal'
													data-target='#mdreproduccionUpdate'  style='background-color: #FFC300; color: black;'><i class='fa-solid fa-pen-to-square'></i></button>

												</div>								
											</div>
											<div class='row'>
												<div class='col-sm-3' >
													<h6 class='modal-title font-weight-bold'>Servido: </h6>
												</div>												
												<div class='col-sm-3' margin-bottom: 5rem;>
													<h6 class='modal-title '>'".(($registro['servido'])== '1' ? 'Si' : '')."'</h6>
													
												</div>
											</div>	
											<div class='row'>
												<div class='col-sm-3' >
													<h6 class='modal-title font-weight-bold' >Metodo: </h6>
												</div>												
												<div class='col-sm-3' >
													<h6 class='modal-title'>'".(($registro['metodoRep'])== '1' ? 'Monta' : '')."'</h6>
												</div>
											</div>	
											<div class='row'>
												<div class='col-sm-4' >
													<h6 class='modal-title font-weight-bold'>Macho: </h6>
												</div>												
												<div class='col-sm-8' >
													<h6 class='modal-title'>'".$registro['codigoAnimMonta']."'</h6>
												</div>
											</div>
											<div class='row'>
												<div class='col-sm-4' >
													<h6 class='modal-title font-weight-bold'>Nombre: </h6>
												</div>												
												<div class='col-sm-8' >
													<h6 class='modal-title'>'".$registro['nombreAnimMonta']."'</h6>
												</div>
											</div>
											<div class='row'>
												<div class='col-sm-4' >
													<h6 class='modal-title font-weight-bold'>Observacion: </h6>
												</div>												
												<div class='col-sm-8' >
													<h6 class='modal-title'>'".$registro['observacionesServ']."'</h6>
												</div>
											</div>												
                                        </div>
                                    </div>";
						}
						
						$jTableResult['tabsMonta'] .= "    </div>
						</div>";
		print json_encode($jTableResult);
		break;
		//arrelo lista de tarjetas que se muestran de con boton inseminacion
		case 'arregloInseminacion':
			$jTableResult = array();
				$jTableResult['tabsInseminacion']="";
				$jTableResult['numeroFilas'] = "";
				$query="SELECT servicio.idReproduccion,
				servicio.codigoVacaRep,
				pajilla.nombrePajilla as nombreAnimPajilla,
				pajilla.numeroRegistro as registroPajillaN,
				servicio.fechaCelo, 
				servicio.servido,
				servicio.metodoRep,
				servicio.numeroRegistroM,
				servicio.observacionesServ
				FROM servicio
				INNER JOIN pajilla  
				ON servicio.numeroRegistroM = pajilla.idPajilla
				WHERE  metodoRep = 2  AND codigoVacaRep ='".$_POST['idAnimalListCeloI']."' ORDER BY `fechaCelo` DESC ;";
				$resultado = mysqli_query($conn, $query);
				$numero = mysqli_num_rows($resultado);
				$jTableResult['numeroFilas'] = $numero;
				$jTableResult['tabsInseminacion'] .= "<div class='card'>
									<div class='card-header' style='background-color:$varCabeceraTabla; color: white;'>
										<h5 class='card-title'>LISTA INSEMINACION</h5>
										<div class=' d-flex justify-content-end align-items-center'>   
											<p>total: <strong>$numero</strong></p>
										</div>
									</div>
                                    <div class='card-body' style='max-height: 400px; overflow-y: auto;'>
                    ";
				while($registro = mysqli_fetch_array($resultado)){ 
				$jTableResult['tabsInseminacion'] .= "<div class='card mb-10'>
                                        <div class='card-body'>
											<div class='row'>
												<!--<div>
													<input type='text' id='idServicioAn' value='" . $registro['idReproduccion'] . "'>
												</div>-->
												<div class='col-sm-3' >
													<h6 class='modal-title'><strong>Fecha: </strong></h6>
												</div>												
												<div class='col-sm-4' >
													<h6 class='modal-title'>'".$registro['fechaCelo']."'</h6>
												</div>
												<div class='col-sm-5 d-flex justify-content-end align-items-center' >
													<button class='btn' id='btnEliminarCardCel' data-idReproduccion='".$registro['idReproduccion']."' data-tipo='2' style='background-color: red; color: #fff; margin-right: 1rem;'><i class='fa-solid fa-trash'></i></button>

													<button class='btn' id='btnActualizarCardCelo' data-idReproduccionCeloUpdate='".$registro['idReproduccion']."'  data-tipo-update='2' data-toggle='modal' data-target='#mdreproduccionUpdate'  style='background-color: #FFC300; color: black;  '><i class='fa-solid fa-pen-to-square'></i></button>	
												</div>										
											</div> 
											<div class='row'>
												<div class='col-sm-3' >
													<h6 class='modal-title font-weight-bold'>Servido: </h6>
												</div>												
												<div class='col-sm-3' >
													<h6 class='modal-title '>'".(($registro['servido'])== '1' ? 'Si' : '')."'</h6>
												</div>
											</div>	
											<div class='row'>
												<div class='col-sm-3' >
													<h6 class='modal-title font-weight-bold'>Metodo: </h6>
												</div>												
												<div class='col-sm-3' >
													<h6 class='modal-title'>'".(($registro['metodoRep'])== '2' ? 'I.A' : '')."'</h6>
												</div>
											</div>	
											<div class='row'>
												<div class='col-sm-4' >
													<h6 class='modal-title font-weight-bold'>Macho: </h6>
												</div>												
												<div class='col-sm-8' >
													<h6 class='modal-title'>'".$registro['registroPajillaN']."'</h6>
												</div>
											</div>
											<div class='row'>
												<div class='col-sm-4' >
													<h6 class='modal-title font-weight-bold'>Nombre: </h6>
												</div>												
												<div class='col-sm-8' >
													<h6 class='modal-title'>'".$registro['nombreAnimPajilla']."'</h6>
												</div>
											</div>
											<div class='row'>
												<div class='col-sm-4' >
													<h6 class='modal-title font-weight-bold'>Observacion: </h6>
												</div>												
												<div class='col-sm-8' >
													<h6 class='modal-title'>'".$registro['observacionesServ']."'</h6>
												</div>
											</div>												
                                        </div>
                                    </div>";
						}
						
						$jTableResult['tabsInseminacion'] .= "    </div>
						</div>";
	    print json_encode($jTableResult);
		break;
		case 'arregloNoservidos':
			$jTableResult = array();
				$jTableResult['tabsNoServidos']="";
				$jTableResult['numeroFilas'] = "";
				$query="SELECT servicio.idReproduccion,
				servicio.codigoVacaRep,
				servicio.fechaCelo, 
				servicio.servido,
				servicio.observacionesServ
				FROM servicio
				WHERE  servido = 2  AND codigoVacaRep ='".$_POST['idAnimalListCeloNo']."' ORDER BY `fechaCelo` DESC ;";
				$resultado = mysqli_query($conn, $query);
				$numero = mysqli_num_rows($resultado);
				$jTableResult['numeroFilas'] = $numero;
				$jTableResult['tabsNoServidos'] .= "<div class='card'>
									<div class='card-header' style='background-color:$varCabeceraTabla; color: white;'>
										<h5 class='card-title'>NO SERVIDO</h5>
										<div class=' d-flex justify-content-end align-items-center'>   
											<p>total: <strong>$numero</strong></p>
										</div>
									</div>
                                    <div class='card-body' style='max-height: 400px; overflow-y: auto;'>
                    ";
				while($registro = mysqli_fetch_array($resultado)){ 
				$jTableResult['tabsNoServidos'] .= "<div class='card mb-10 '>
                                        <div class='card-body'>
											<div class='row'>
												<!--<div>		
													<input type='text'  value='" . $registro['idReproduccion'] . "'>
												</div>-->
												<div class='col-sm-3' >
													<h6 class='modal-title'><strong>Fecha: </strong></h6>
												</div>												
												<div class='col-sm-4' >
													<h6 class='modal-title'>'".$registro['fechaCelo']."'</h6>
												</div>
												<div class='col-sm-5 d-flex justify-content-end align-items-center' >
													<button class='btn' id='btnEliminarCardCel' data-idReproduccion='".$registro['idReproduccion']."' data-tipo='3' style='background-color: red; color: #fff;  margin-right: 1rem;'><i class='fa-solid fa-trash'></i></button>

													<button class='btn' id='btnActualizarCardCelo' data-idReproduccionCeloUpdate='".$registro['idReproduccion']."' data-tipo-update='3'  data-toggle='modal'   data-target='#mdreproduccionUpdate' 
													style='background-color: #FFC300; color: black; '><i class='fa-solid fa-pen-to-square'></i></button>
												</div>													
											</div>
											<div class='row'>
												<div class='col-sm-3' >
													<h6 class='modal-title font-weight-bold'>Servido: </h6>
												</div>												
												<div class='col-sm-3' >
													<h6 class='modal-title '>'".(($registro['servido'])== '2' ? 'No' : '')."'</h6>
												</div>
											</div>	
											<div class='row'>
												<div class='col-sm-4' >
													<h6 class='modal-title font-weight-bold'>Observacion: </h6>
												</div>												
												<div class='col-sm-8' >
													<h6 class='modal-title'>'".$registro['observacionesServ']."'</h6>
												</div>
											</div>												
                                        </div>
                                    </div>";
						}
						$jTableResult['tabsNoServidos'] .= "    </div>
						</div>";
	    print json_encode($jTableResult);
		break;
		case 'arregloPajillaCel':
			$jTableResult = array();
				$jTableResult['tabsPajilla']="";
				$jTableResult['numTtPajillas']="";
				$query="SELECT pajilla.idPajilla, 
				pajilla.fechaRegistroP,
				pajilla.numeroRegistro, 
				pajilla.nombrePajilla, 
				pajilla.razaPajilla, 
				raza.nombreRaza AS razaPajillaP 
				FROM pajilla 
				INNER JOIN raza
				ON pajilla.razaPajilla = raza.idRaza ORDER BY `fechaRegistroP` DESC;";
				$resultado = mysqli_query($conn, $query);
				$numero = mysqli_num_rows($resultado);
				$jTableResult['numTtPajillas']=$numero;
				$jTableResult['tabsPajilla'] .= "<div class='card'>
									<div class='card-header' style='background-color:$varCabeceraTabla; color: white;'>
										<h5 class='card-title'>PAJILLAS</h5></h5>
										<div class=' d-flex justify-content-end align-items-center'>   
											<p>total: <strong>$numero</strong></p>
										</div>
									</div>
                                    <div class='card-body' style='max-height: 400px; overflow-y: auto;'>
                    ";
				while($registro = mysqli_fetch_array($resultado)){ 
				$jTableResult['tabsPajilla'] .= "<div class='card mb-10'>
                                        <div class='card-body'>
											<div class='row'>
												<div class='col-sm-3' >
													<h6 class='modal-title'><strong>Fecha: </strong></h6>
												</div>												
												<div class='col-sm-4' >
													<h6 class='modal-title'>'".$registro['fechaRegistroP']."'</h6>
												</div>
												<div class='col-sm-5 d-flex justify-content-end align-items-center' >
													<button class='btn' id='btnEliminarCardPajilla' data-pajillaId = '".$registro['idPajilla']."' style='background-color: red; color: #fff; margin-right: 1rem;' ><i class='fa-solid fa-trash'></i></button>

													<button class='btn' id='btnActualizarCardPajilla' data-pajillaIdUpdate = '".$registro['idPajilla']."' style='background-color: #FFC300; color: black;'  data-toggle='modal' data-backdrop='false' data-target='#actualizarPajilla' ><i class='fa-solid fa-pen-to-square'></i></button>
												</div>													
											</div>
											<div class='row'>
												<div class='col-sm-4' >
													<h6 class='modal-title'><strong>N°registro: </strong></h6>
												</div>												
												<div class='col-sm-6' >
													<h6 class='modal-title'>'".$registro['numeroRegistro']."'</h6>
												</div>
											</div>
											<div class='row'>
												<div class='col-sm-4' >
													<h6 class='modal-title font-weight-bold'>Nombre: </h6>
												</div>												
												<div class='col-sm-8' >
													<h6 class='modal-title '>'".$registro['nombrePajilla']."'</h6>
												</div>
											</div>	
											<div class='row'>
												<div class='col-sm-4' >
													<h6 class='modal-title font-weight-bold'>Raza: </h6>
												</div>												
												<div class='col-sm-8' >
													<h6 class='modal-title'>'".$registro['razaPajillaP']."'</h6>
												</div>
											</div>												
                                        </div>
                                    </div>";
						}
						$jTableResult['tabsPajilla'] .= "    </div>
						</div>";
	    print json_encode($jTableResult);
		break;
		case 'codigoVaca':
			$jTableResult = array();
				$jTableResult['codigoVaca']="";
				$jTableResult['codigoVaca']="<option value='0' selected >Seleccione</option>";
				$query=" SELECT idAnimal,codAnimal,nombreAnimal,idRaza_FK from animales WHERE idEspecie_FK = 1;"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['codigoVaca'].="<option value='".$registro['idAnimal']."' >".$registro['codAnimal']."</option>"; //cambiar datos por los de la tabla
					}				
			print json_encode($jTableResult);
		break;
		case 'buscarRazas':
			$jTableResult = array();
				$jTableResult['listaRaza']="";
				$jTableResult['listaRaza']="<option value='0' selected >Seleccione</option>";
				$query=" SELECT idRaza, nombreRaza from raza"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['listaRaza'].="<option value='".$registro['idRaza']."'>".$registro['nombreRaza']."</option>"; //cambiar datos por los de la tabla
					}				
			// echo "<pre>";
			// print_r ($jTableResult['listRaza']);
			// echo "</pre>";
			// exit();
			print json_encode($jTableResult);
		break;
		case 'cargarServicio':
			$jTableResult = array();
				//echo "id recibido: ".$_POST['idanimals']; exit();
				$jTableResult['idAnimal']="";
			 	$jTableResult['nombreAnimal']="";
				$jTableResult['codAnimal']="";
				$jTableResult['idRaza_FK']="";
				$jTableResult['nombreRaza']="";
				$query="SELECT idAnimal, codAnimal, nombreAnimal, idRaza_FK from animales where idAnimal='".$_POST['idanimals']."';"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['idAnimal']=$registro['idAnimal']; //cambiar datos por los de la tabla
						$jTableResult['nombreAnimal']=$registro['nombreAnimal'];
						$jTableResult['codAnimal']=$registro['codAnimal'];
						$jTableResult['idRaza_FK']=$registro['idRaza_FK'];
					}		
				$query=" SELECT nombreRaza from raza where idRaza='".$jTableResult['idRaza_FK']."';"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['nombreRaza']=$registro['nombreRaza']; //cambiar datos por los de la tabla
					}		
			print json_encode($jTableResult);
		break;
		case 'cargarPerson':
			$jTableResult = array();
				//echo "id recibido: ".$_POST['idanimals']; exit();
				$jTableResult['idPersonaS']="";
			 	$jTableResult['nombrePerson']="";
				$jTableResult['apellidoPerson']="";
				$query=" SELECT id_persona, nombre, apellido from persona where id_persona='".$_POST['idPersons']."';"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['idPersonaS']=$registro['id_persona']; 
						$jTableResult['nombrePerson']=$registro['nombre'];
						$jTableResult['apellidoPerson']=$registro['apellido'];
					}		

			print json_encode($jTableResult);
		break;
		/*case 'decicionServicio':
			$jTableResult = array();
				//echo "id recibido: ".$_POST['idanimals']; exit();
				$jTableResult['idAnimal']="";
			 	$jTableResult['nombreAnimal']="";
				$jTableResult['codAnimal']="";
				$jTableResult['idRaza_FK']="";
				$jTableResult['nombreRaza']="";
				$query=" SELECT idAnimal, codAnimal, nombreAnimal, idRaza_FK from animales where idAnimal='".$_POST['idanimals']."';"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['idAnimal']=$registro['idAnimal']; //cambiar datos por los de la tabla
						$jTableResult['nombreAnimal']=$registro['nombreAnimal'];
						$jTableResult['codAnimal']=$registro['codAnimal'];
						$jTableResult['idRaza_FK']=$registro['idRaza_FK'];
					}		

			
				$query=" SELECT nombreRaza from raza where idRaza='".$jTableResult['idRaza_FK']."';"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['nombreRaza']=$registro['nombreRaza']; //cambiar datos por los de la tabla
					}		
			print json_encode($jTableResult);
		break;*/
		case 'cargarServicioPjailla':
			$jTableResult = array();
				//echo "id recibido: ".$_POST['idanimals']; exit();
				$jTableResult['idPajilla']="";
			 	$jTableResult['numeroRegistro']="";
				$jTableResult['nombrePajilla']="";
				$jTableResult['razaPajilla']="";
			
				$query=" SELECT idPajilla, numeroRegistro, nombrePajilla, razaPajilla FROM pajilla where idPajilla ='".$_POST['numReg']."';"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['idPajilla']=$registro['idPajilla']; //cambiar datos por los de la tabla
						$jTableResult['numeroRegistro']=$registro['numeroRegistro'];
						$jTableResult['nombrePajilla']=$registro['nombrePajilla'];
						$jTableResult['numrazaPajilla']=$registro['razaPajilla'];
					}		

			
				$query="SELECT nombreRaza from raza where idRaza='".$jTableResult['numrazaPajilla']."';"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['nombreRazaP']=$registro['nombreRaza']; //cambiar datos por los de la tabla
					}		
			print json_encode($jTableResult);
		break;
		case 'cargarRazaPaj':
			$jTableResult = array();
				//echo "id recibido: ".$_POST['idRazaPaji']; exit();
				$jTableResult['idPajillaPaj']="";
		
				$query="SELECT idRaza FROM raza WHERE idRaza ='".$_POST['idRazaPaji']."';"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['idPajillaPaj']=$registro['idRaza']; //cambiar datos por los de la tabla
					}		
			print json_encode($jTableResult);
		break;
		case 'encargado':
			$jTableResult = array();
				$jTableResult['encargado']="";
				$jTableResult['encargado']="<option value='0' selected >seleccione:.</option>";
				$query=" SELECT id_persona, nombre, apellido from persona;"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['encargado'].="<option value='".$registro['id_persona']."' >".$registro['nombre']."".$registro['apellido']."</option>"; //cambiar datos por los de la tabla
					}				
			print json_encode($jTableResult);
		break;
		//LISTA DEPENDIENDO SI ES POR MONTA O INSEMINACION
		case 'listarTipo':
			$jTableResult = array();				
				$jTableResult['tipo']="";
				$jTableResult['tipo']="<option value='0' selected >seleccione:.</option>";
				if($_POST['tipoEnsiminacion']==1){
					$jTableResult['tipo']="";
					$jTableResult['tipo']="<option value='0' selected >seleccione:.</option>";
					$query="SELECT idAnimal, codAnimal from animales WHERE idSexo = 1;"; // cambiar el nombre de la tabla y los campos de la tabla
					$resultado = mysqli_query($conn, $query);
					while($registro = mysqli_fetch_array($resultado))
						{
							$jTableResult['tipo'].="<option value='".$registro['idAnimal']."' >".$registro['codAnimal']."</option>"; //cambiar datos por los de la tabla
						}
				}
				if($_POST['tipoEnsiminacion']==2){
					$query=" SELECT idPajilla, numeroRegistro, nombrePajilla, razaPajilla from pajilla;"; // cambiar el nombre de la tabla y los campos de la tabla
					$resultado = mysqli_query($conn, $query);
					while($registro = mysqli_fetch_array($resultado))
						{
							$jTableResult['tipo'].="<option value='".$registro['idPajilla']."' >".$registro['numeroRegistro']."</option>"; //cambiar datos por los de la tabla
						}
				}								
			print json_encode($jTableResult);
		break;
		/*REGISTRAR PAJILLA*/ 
		// case 'guardarPajilla':
        //     $jTableResult = array();
        //     $jTableResult['msj']="";
        //     $jTableResult['resultd']="";

		// 		$query2 = "SELECT idPajilla  FROM pajilla WHERE numeroRegistro= '".$_POST['numeroRegistroR']."';   ";
		// 		$resultado = mysqli_query($conn, $query2);
		// 		$numero = mysqli_num_rows($resultado);
		// 		if($numero==0) {
		// 			if(($_POST['numeroRegistroR']=="") or ($_POST['nombreToroP']=="") or ($_POST['idrazaToroP']=="") or ($_POST['selRazPaj'] == "0")){
		// 				$jTableResult['msj']="CAMPOS OBLIGATORIOS";
		// 				$jTableResult['resultd']="0";
		// 			}
		// 			else{
		// 				$query="INSERT INTO pajilla SET 
		// 				fechaRegistroP='".$_POST['fechRegPaji']."',
		// 				razaPajilla='".$_POST['idrazaToroP']."',
		// 				nombrePajilla='".$_POST['nombreToroP']."',
		// 				respRegPajilla='".$_POST['idRespRegP']."',
		// 				numeroRegistro='".$_POST['numeroRegistroR']."';";
		// 				if ($resultado=mysqli_query($conn,$query)){
		// 					mysqli_commit($conn);
		// 					$jTableResult['msj']="  DATO GUARDADO CORRECTAMENTE";
		// 					$jTableResult['resultd']="1";
		// 				} else {
		// 					mysqli_rollback($conn);
		// 					$jTableResult['msj']="  ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
		// 					$jTableResult['resultd']="0";
		// 				}
		// 			}
					
		// 		}else{
		// 			//mysqli_commit($conn);
		// 			$jTableResult['msj']="CODIGO DE LA PAJILLA YA EXISTE";
		// 			$jTableResult['resultd']="0";
		// 		}                
        //     print json_encode($jTableResult);
        // break;
		case 'guardarPajilla':
            $jTableResult = array();
            $jTableResult['msj']="";
            $jTableResult['resultd']="";

				$queryCheck = "SELECT idPajilla  FROM pajilla WHERE numeroRegistro=?    ";
				$statementCheck = $conn->prepare($queryCheck);
				$statementCheck->bind_param("s", $_POST['numeroRegistroR']);
				$statementCheck->execute();
				$statementCheck->store_result();
				$numero = $statementCheck->num_rows;
				$statementCheck->close();
				if($numero==0) {
					if(($_POST['numeroRegistroR']=="") or ($_POST['nombreToroP']=="") or ($_POST['idrazaToroP']=="") or ($_POST['selRazPaj'] == "0")){
						$jTableResult['msj']="CAMPOS OBLIGATORIOS";
						$jTableResult['resultd']="0";
					}
					else{
						 // Crear consulta preparada para insertar la pajilla
						 $query = $conn->prepare("INSERT INTO pajilla (fechaRegistroP, razaPajilla, nombrePajilla, respRegPajilla, numeroRegistro) VALUES (?, ?, ?, ?, ?)");
						 $query->bind_param("sisis", $_POST['fechRegPaji'], $_POST['idrazaToroP'], $_POST['nombreToroP'], $_POST['idRespRegP'], $_POST['numeroRegistroR']);
			 
						 // Ejecutar consulta preparada
						 if ($query->execute()) {
							 mysqli_commit($conn);
							 $jTableResult['msj'] = "DATO GUARDADO CORRECTAMENTE";
							 $jTableResult['resultd'] = "1";
						 } else {
							 mysqli_rollback($conn);
							 $jTableResult['msj'] = "ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
							 $jTableResult['resultd'] = "0";
						 }
			 
						 // Cerrar consulta preparada
						 $query->close();
					}
					
				}else{
					//mysqli_commit($conn);
					$jTableResult['msj']="CODIGO DE LA PAJILLA YA EXISTE";
					$jTableResult['resultd']="0";
				}                
            print json_encode($jTableResult);
        break;
		case 'actualizarPajilla':
			//echo "al pajilla es actualizacion numero: ".$_POST['idRespUpdP'];
			$jTableResult = array();
				$jTableResult['msj']="";
				$jTableResult['resultd']="";
					$query=$conn->prepare("UPDATE pajilla SET fechaRegistroP = ?, 
					numeroRegistro =  ?,
					nombrePajilla = ?, 
					razaPajilla = ?,
					respRegPajilla = ?
					WHERE idPajilla = ?");
					$query->bind_param("sssiii",
					 $_POST['fechaRegPaUp'], 
					 $_POST['numRegUpPa'], 
					 $_POST['nombretUpd'], 
					 $_POST['razSelPaUp'],
					 $_POST['idRespUpdP'],
					 $_POST['datPajiIdU']);
						if ($query->execute()){
							mysqli_commit($conn);
							$jTableResult['msj']="  DATO GUARDADO CORRECTAMENTE";
							$jTableResult['resultd']="1";
						} else {
							mysqli_rollback($conn);
							$jTableResult['msj']="  ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
							$jTableResult['resultd']="0";
						}
					$query -> close();
				       
			print json_encode($jTableResult);
		break;
		/*REGISTRAR REPRODUCCION*/ 
		// case 'guardarCheck':
        //     $jTableResult = array();
        //     $jTableResult['msj']="";
        //     $jTableResult['resultd']="";
		// 		if (($_POST['servicio']=="") or ($_POST['observacionesRep']=="")){
		// 			$jTableResult['msj']="TIENES CAMPOS OBLIGATORIOS POR LLENAR";
		// 			$jTableResult['resultd']="0";
		// 		}
		// 		else{
		// 			$query="INSERT INTO servicio SET 
		// 			codigoVacaRep='".$_POST['codVaca']."',
		// 			fechaCelo='".$_POST['fechCelo']."',
		// 			servido='".$_POST['servicio']."',
		// 			observacionesServ='".$_POST['observacionesRep']."',
		// 			idUsuario='".$_POST['idRespCelo']."';";
		// 			if ($resultado=mysqli_query($conn,$query))
		// 				{
		// 					mysqli_commit($conn);
		// 					$jTableResult['msj']="  DATO GUARDADO CORRECTAMENTE";
		// 					$jTableResult['resultd']="1";
		// 				}
		// 			else
		// 				{
		// 					mysqli_rollback($conn);
		// 					$jTableResult['msj']="  ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
		// 					$jTableResult['resultd']="0";
		// 				}
		// 		}
		// 	print json_encode($jTableResult);
        // break;
		case 'guardarCheck':
            $jTableResult = array();
            $jTableResult['msj']="";
            $jTableResult['resultd']="";
				if (($_POST['servicio']=="") or ($_POST['observacionesRep']=="")){
					$jTableResult['msj']="TIENES CAMPOS OBLIGATORIOS POR LLENAR";
					$jTableResult['resultd']="0";
				}
				else{

					$query=$conn->prepare("INSERT INTO servicio (codigoVacaRep, fechaCelo, servido, observacionesServ, idUsuario) VALUES (?, ?, ?, ?, ?)");

					$query ->bind_param("isssi", $_POST['codVaca'], $_POST['fechCelo'], $_POST['servicio'], $_POST['observacionesRep'], $_POST['idRespCelo']);

					if ($query -> execute())
						{
							mysqli_commit($conn);
							$jTableResult['msj'] = "DATO GUARDADO CORRECTAMENTE";
							$jTableResult['resultd'] = "1";
						}
					else
						{
							mysqli_rollback($conn);
							$jTableResult['msj']="  ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
							$jTableResult['resultd']="0";
						}
					$query -> close();
				}
			print json_encode($jTableResult);
        break;
		// case 'actualizarCheck':
        //     $jTableResult = array();
        //     $jTableResult['msj']="";
        //     $jTableResult['resultd']="";
		// 		if (($_POST['servicioUpNo']=="") or ($_POST['observacionesRepUpNo']=="")){
		// 			$jTableResult['msj']="TIENES CAMPOS OBLIGATORIOS POR LLENAR";
		// 			$jTableResult['resultd']="0";
		// 		}
		// 		else{
		// 			$query="UPDATE servicio SET
		// 			codigoVacaRep='".$_POST['codVacaUpNo']."',
		// 			fechaCelo='".$_POST['fechCeloUpNo']."',
		// 			servido='".$_POST['servicioUpNo']."',
		// 			observacionesServ='".$_POST['observacionesRepUpNo']."',
		// 			metodoRep = '0',
		// 			numeroRegistroM= '0',
		// 			idUsuario='".$_POST['idRespCeloUpNo']."'
		// 			where idReproduccion='".$_POST['idCeloFormUpdate']."';";
		// 			if ($resultado=mysqli_query($conn,$query))
		// 				{
		// 					mysqli_commit($conn);
		// 					$jTableResult['msj']="  DATO ACTUALIZADO CORRECTAMENTE";
		// 					$jTableResult['resultd']="1";
		// 				}
		// 			else
		// 				{
		// 					mysqli_rollback($conn);
		// 					$jTableResult['msj']="  ERROR AL ACTUALIZAR. INTENTE NUEVAMENTE.";
		// 					$jTableResult['resultd']="0";
		// 				}
		// 		}
		// 	print json_encode($jTableResult);
        // break;
		case 'actualizarCheck':
            $jTableResult = array();
            $jTableResult['msj']="";
            $jTableResult['resultd']="";
				if (($_POST['servicioUpNo']=="") or ($_POST['observacionesRepUpNo']=="")){
					$jTableResult['msj']="TIENES CAMPOS OBLIGATORIOS POR LLENAR";
					$jTableResult['resultd']="0";
				}
				else{
					 // Crear consulta preparada para actualizar el servicio
					$query = $conn->prepare("UPDATE servicio SET codigoVacaRep=?, fechaCelo=?, servido=?, observacionesServ=?, metodoRep='0', numeroRegistroM='0', idUsuario=? WHERE idReproduccion=?");
					$query->bind_param("ssissi", $_POST['codVacaUpNo'], $_POST['fechCeloUpNo'], $_POST['servicioUpNo'], $_POST['observacionesRepUpNo'], $_POST['idRespCeloUpNo'], $_POST['idCeloFormUpdate']);

					// Ejecutar consulta preparada
					if ($query->execute()) {
						mysqli_commit($conn);
						$jTableResult['msj'] = "DATO ACTUALIZADO CORRECTAMENTE";
						$jTableResult['resultd'] = "1";
					} else {
						mysqli_rollback($conn);
						$jTableResult['msj'] = "ERROR AL ACTUALIZAR. INTENTE NUEVAMENTE.";
						$jTableResult['resultd'] = "0";
					}
					// Cerrar consulta preparada
					$query->close();
				}
			print json_encode($jTableResult);
        break;
		case 'actualizarCheckCompleto':
            $jTableResult = array();
            $jTableResult['msj']="";
            $jTableResult['resultd']="";
				if(($_POST['servicioUpdate']=="") or ($_POST['metodoRepUpdate'] =="") or ($_POST['codigoTorPUpdate'] ==0)){
					$jTableResult['msj']="TIENES CAMPOS OBLIGATORIOS POR LLENAR";
					$jTableResult['resultd']="0";
				}
				else{
						 // Crear consulta preparada para actualizar el servicio
					$query = $conn->prepare("UPDATE servicio SET codigoVacaRep=?, fechaCelo=?, servido=?, metodoRep=?, numeroRegistroM=?, observacionesServ=?, idUsuario=? WHERE idReproduccion=?");
					$query->bind_param("ssiiissi", $_POST['codVacaUpdate'], $_POST['fechCeloUpdate'], $_POST['servicioUpdate'], $_POST['metodoRepUpdate'], $_POST['codigoTorPUpdate'], $_POST['observacionesRepUpdate'], $_POST['idRespCeloUpdate'], $_POST['idCeloFormUpdateUp']);

					// Ejecutar consulta preparada
					if ($query->execute()) {
						mysqli_commit($conn);
						$jTableResult['msj'] = "DATO ACTUALIZADO CORRECTAMENTE";
						$jTableResult['resultd'] = "1";
					} else {
						mysqli_rollback($conn);
						$jTableResult['msj'] = "ERROR AL ACTUALIZAR. INTENTE NUEVAMENTE.";
						$jTableResult['resultd'] = "0";
					}

					// Cerrar consulta preparada
					$query->close();
				}
            print json_encode($jTableResult);
        break;
		// case 'guardarCheckCompleto':
        //     $jTableResult = array();
        //     $jTableResult['msj']="";
        //     $jTableResult['resultd']="";
		// 		if(($_POST['servicio']=="") or ($_POST['metodoRep'] =="") or ($_POST['codigoTorP'] ==0)){
		// 			$jTableResult['msj']="TIENES CAMPOS OBLIGATORIOS POR LLENAR";
		// 			$jTableResult['resultd']="0";
		// 		}
		// 		else{
		// 				$query="INSERT INTO servicio SET 
		// 				codigoVacaRep='".$_POST['codVaca']."',
		// 				fechaCelo='".$_POST['fechCelo']."',
		// 				servido='".$_POST['servicio']."',
		// 				metodoRep='".$_POST['metodoRep']."',
		// 				numeroRegistroM='".$_POST['codigoTorP']."',
		// 				observacionesServ='".$_POST['observacionesRep']."',
		// 				idUsuario='".$_POST['idRespCelo']."';";
		// 				if ($resultado=mysqli_query($conn,$query))
		// 					{
		// 						mysqli_commit($conn);
		// 						$jTableResult['msj']="  DATO GUARDADO CORRECTAMENTE";
		// 						$jTableResult['resultd']="1";
		// 					}
		// 				else
		// 					{
		// 						mysqli_rollback($conn);
		// 						$jTableResult['msj']="  ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
		// 						$jTableResult['resultd']="0";
		// 					}
		// 		}
        //     print json_encode($jTableResult);
        // break;
		case 'guardarCheckCompleto':
			$jTableResult = array();
			$jTableResult['msj'] = "";
			$jTableResult['resultd'] = "";
		
			// Verificar si los campos obligatorios están llenos
			if ($_POST['servicio'] == "" || $_POST['metodoRep'] == "" || $_POST['codigoTorP'] == 0) {
				$jTableResult['msj'] = "TIENES CAMPOS OBLIGATORIOS POR LLENAR";
				$jTableResult['resultd'] = "0";
			} else {
				// Crear consulta preparada
				$query = $conn->prepare("INSERT INTO servicio (codigoVacaRep, fechaCelo, servido, metodoRep, numeroRegistroM, observacionesServ, idUsuario) VALUES (?, ?, ?, ?, ?, ?, ?)");
		
				// Vincular parámetros
				$query->bind_param("isiiisi", $_POST['codVaca'], $_POST['fechCelo'], $_POST['servicio'], $_POST['metodoRep'], $_POST['codigoTorP'], $_POST['observacionesRep'], $_POST['idRespCelo']);
		
				// Ejecutar consulta preparada
				if ($query->execute()) {
					mysqli_commit($conn);
					$jTableResult['msj'] = "DATO GUARDADO CORRECTAMENTE";
					$jTableResult['resultd'] = "1";
				} else {
					mysqli_rollback($conn);
					$jTableResult['msj'] = "ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
					$jTableResult['resultd'] = "0";
				}
		
				// Cerrar consulta preparada
				$query->close();
			}
			
			print json_encode($jTableResult);
		break;
		
		case 'eliminarRegistroCelo':
			$jTableResult = array();
			$jTableResult['msj'] = "";
			$jTableResult['resultd'] = "";
		
			$query = $conn->prepare("DELETE FROM servicio WHERE idReproduccion = ?");
			$query->bind_param("i", $_POST['idCeloRepA']);
		
			// Ejecutar consulta preparada
			if ($query->execute()) {
				mysqli_commit($conn);
				$jTableResult['msj'] = "DATO ELIMINADO CORRECTAMENTE";
				$jTableResult['resultd'] = "1";
			} else {
				mysqli_rollback($conn);
				$jTableResult['msj'] = "ERROR AL ELIMINAR. INTENTE NUEVAMENTE. " . mysqli_error($conn);
				$jTableResult['resultd'] = "0";
			}
		
			// Cerrar consulta preparada
			$query->close();
			print json_encode($jTableResult);
		break;
		case 'eliminarRegistroPajilla':
			$jTableResult = array();
			$jTableResult['msj'] = "";
			$jTableResult['resultd'] = "";
		
			$query = $conn->prepare("DELETE FROM pajilla WHERE idPajilla = ?");
			$query->bind_param("i", $_POST['datPajiId']);
		
			// Ejecutar consulta preparada
			if ($query->execute()) {
				mysqli_commit($conn);
				$jTableResult['msj'] = "DATO ELIMINADO CORRECTAMENTE";
				$jTableResult['resultd'] = "1";
			} else {
				mysqli_rollback($conn);
				$jTableResult['msj'] = "ERROR AL ELIMINAR. INTENTE NUEVAMENTE. " . mysqli_error($conn);
				$jTableResult['resultd'] = "0";
			}
		
			// Cerrar consulta preparada
			$query->close();
		
			print json_encode($jTableResult);
		break;
	}		
mysqli_close($conn);
?>