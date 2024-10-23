<?php
header('Cache-Control: no-cache, must-revalidate');
include('../../include/parametros_index.php');
date_default_timezone_set('America/Bogota');
include('../../include/conex.php');
session_start();
$conn=Conectarse();
$horaTime = date("H:i:s");
    switch ($_REQUEST['action']) {
        case 'guardarControlSanitario':
            $jTableResult = array();
            $jTableResult['msj']="";
            $jTableResult['resultd']="";
            if(($_POST['fechaControlSnitario']=="") OR 
                ($_POST['eventoSanitario']=="") OR 
                ($_POST['productoUtilizado']=="") OR 
                ($_POST['dosisSanitario']=="")){
                $jTableResult['msj'] = "TIENES CAMPOS OBLIGATORIOS POR LLENAR";
                $jTableResult['resultd'] = "0";
            }else{
                $query = $conn -> prepare("INSERT INTO control_sanitario 
                (fechaControlSanitario, eventoSanitario, productoUtilizado, dosisSanitario, observacionesControl, idAnimalControl) 
                VALUES(?, ?, ?, ?, ?, ?)");
                $query -> bind_param('sssssi', 
                $_POST['fechaControlSnitario'], 
                $_POST['eventoSanitario'], 
                $_POST['productoUtilizado'], 
                $_POST['dosisSanitario'], 
                $_POST['observacionesSanitario'], 
                $_POST['idAnimalSanitario']);
                if($query->execute()){
                    mysqli_commit($conn);
                    $jTableResult['msj'] ="DATO GUARDADO CORRECTAMENTE";
                    $jTableResult['resultd'] = "1"; 
                }else{
                    mysqli_rollback($conn); 
                    $jTableResult['msj'] ="ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
                    $jTableResult['resultd'] = "0";
                }
            }
            print json_encode($jTableResult);
        break;
        case 'listarCardsControlSanitario':
			$jTableResult = array();
			$jTableResult['tabsControlSanitario'] = "";
			$jTableResult['numeroFilas'] = "";
			$var_dato_control_san = $_POST['idAnimalSanitarioCard'];
			$query = "SELECT idControlSanitario, fechaControlSanitario, eventoSanitario, productoUtilizado, dosisSanitario, observacionesControl FROM control_sanitario WHERE idAnimalControl='".$var_dato_control_san."';";
			$resultado = mysqli_query($conn, $query);
			$numero = mysqli_num_rows($resultado);
			$jTableResult['numeroFilas'] = $numero;
			$jTableResult['tabsControlSanitario'] .= "<div class='card'>
								<div class='card-header' style='background-color:$varCabeceraTabla; color: white;'>
									<h5 class='card-title'>LISTA DE CONTROL SANITARIO</h5>
									<div class='d-flex justify-content-end align-items-center'>   
										<p>total: <strong>$numero</strong></p>
									</div>
								</div>
								<div class='card-body' style='max-height: 400px; overflow-y: auto;'>";
			if($numero > 0) {
				while($registro = mysqli_fetch_array($resultado)) { 
					$jTableResult['tabsControlSanitario'] .= "<div class='card mb-10'>
														<div class='card-body'>
															<div class='row'>
																<div class='row' >
																	<div class='col-sm-3' >
																		<h6 class='modal-title'><strong>Fecha: </strong></h6>
																	</div>												
																	<div class='col-sm-4' >
																		<h6 class='modal-title'>".$registro['fechaControlSanitario']."</h6>
																	</div>
																	<div class='col-sm-5 d-flex justify-content-end align-items-center'>
																		<button type='button' id='deleteParto' data-idPartoDelete ='".$registro['idControlSanitario']."' class='btn' style='background-color: red; color: #fff; margin-right: 0.5rem;'><i class='fa-solid fa-trash'></i></button>
																		<button type='button' id='updateParto' data-idPartoUpdate ='".$registro['idControlSanitario']."' data-toggle='modal' data-target='#' class='btn' style='background-color: #ffc300;'><i class='fa-solid fa-pen-to-square'></i></button>
																	</div>								
																</div>         
																<div class='row' >
																	<div class='col-sm-5' >
																		<h6 class='modal-title'><strong>Evento sanitario: </strong></h6>
																	</div>												
																	<div class='col-sm-4' >
																		<h6 class='modal-title'>".$registro['eventoSanitario']."</h6>
																	</div>							
																</div>                                                 
																<div class='row' >
																	<div class='col-sm-5' >
																		<h6 class='modal-title'><strong>produ utilizado: </strong></h6>
																	</div>												
																	<div class='col-sm-4' >
																		<h6 class='modal-title'>".$registro['productoUtilizado']."</h6>
																	</div>							
																</div>                                                 
															</div>                    
														</div>
													</div>";
				}
			} else {
				$jTableResult['tabsControlSanitario'] .= "<div class='card mb-10'>
													<div class='card-body'>
														<center><h6>NO SE ENCONTRARON RESULTADOS</h6></center>                
													</div>
												</div>";
			}
			$jTableResult['tabsControlSanitario'] .= "    </div>
											</div>";
			print json_encode($jTableResult);
		break;
    }
    mysqli_close($conn);
?>