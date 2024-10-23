<?php
header('Cache-Control: no-cache, must-revalidate');
include('../../include/parametros_index.php');
date_default_timezone_set('America/Bogota');
include('../../include/conex.php');
session_start();
$conn=Conectarse();
$horaTime = date("H:i:s");
    switch ($_REQUEST['action']) {
		case 'listarUnidadEspecie':
			$jTableResult = array();
				$jTableResult['unidadesEspecie']="";
				$jTableResult['unidadesEspecie']="<option value='0' selected >Seleccione</option>";
				$query=" SELECT idUnidadPro, nombreUnidadPro from unidades"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['unidadesEspecie'].="<option value='".$registro['idUnidadPro']."' >".$registro['nombreUnidadPro']."</option>"; //cambiar datos por los de la tabla
					}				
			print json_encode($jTableResult);
		break;
        case 'guardarEspecie':
            $jTableResult = array();
            $jTableResult['msj']="";
            $jTableResult['resultd']="";
            if(($_POST['nombreEs']=="") or ($_POST['UnidadEs']==0)){
                $jTableResult['msj']="CAMPOS OBLIGATORIOS";
                $jTableResult['resultd']="0";
            }else{
                $query = $conn->prepare("INSERT INTO especiesmnrs(nombreEspecie, idUnidad_FK) VALUES(?, ?)");
                $query->bind_param("si", $_POST['nombreEs'], $_POST['UnidadEs']);
                if ($query->execute()) {
                    mysqli_commit($conn);
                    $jTableResult['msj'] = "DATO GUARDADO CORRECTAMENTE";
                    $jTableResult['resultd'] = "1";
                }
                else{
                    mysqli_rollback($conn); 
				    $jTableResult['msj'] = "ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
				    $jTableResult['resultd'] = "0";
                }
                // Cerrar consulta preparada
				$query->close();
            }
            print json_encode($jTableResult);
        break;
		case 'cardEspecie':
			$jTableResult = array();
			$jTableResult['tabsEspecie'] = "";
			$jTableResult['numeroFilas'] = "";
			$var_dato_Unidad = $_POST['buscarPorUnidad'];
			$query = "SELECT idEspecie, nombreEspecie, unidades.nombreUnidadPro AS unidadEspecie
					  FROM especiesmnrs 
					  INNER JOIN unidades ON unidades.idUnidadPro = especiesmnrs.idUnidad_FK 
					  WHERE idUnidad_FK ='".$var_dato_Unidad."';";
			$resultado = mysqli_query($conn, $query);
			$numero = mysqli_num_rows($resultado);
			$jTableResult['numeroFilas'] = $numero;
			$jTableResult['tabsEspecie'] .= "<div class='card'>
								<div class='card-header' style='background-color:$varCabeceraTabla; color: white;'>
									<h5 class='card-title'>LISTA DE ESPECIES</h5>
									<div class='d-flex justify-content-end align-items-center'>   
										<p>total: <strong>$numero</strong></p>
									</div>
								</div>
								<div class='card-body' style='max-height: 400px; overflow-y: auto;'>";
			if($numero > 0) {
				while($registro = mysqli_fetch_array($resultado)) { 
					$jTableResult['tabsEspecie'] .= "<div class='card mb-10'>
														<div class='card-body'>
															<div class='row'>
																<div class='col-sm-6'>
																	<h6 class='modal-title'>".$registro['nombreEspecie']."</h6>
																</div>
																<div class='col-sm-6 d-flex justify-content-end align-items-center'>
																	<button class='btn' id='btnEliminarCardEspecie' data-idEspecie='".$registro['idEspecie']."' data-tipo='3' style='background-color: red; color: #fff; margin-right: 0.5rem;'><i class='fa-solid fa-trash'></i></button>
																	<button class='btn' id='btnActualizarCardEspecie' data-idEspecieUpdate='".$registro['idEspecie']."' data-tipo-update='3' data-toggle='modal' data-target='#updateEspecie' style='background-color: #FFC300; color: black;'><i class='fa-solid fa-pen-to-square'></i></button>
																</div>                                                    
															</div>                    
														</div>
													</div>";
				}
			} else {
				$jTableResult['tabsEspecie'] .= "<div class='card mb-10'>
													<div class='card-body'>
														<center><h6>NO SE ENCONTRARON RESULTADOS</h6></center>                
													</div>
												</div>";
			}
			$jTableResult['tabsEspecie'] .= "    </div>
											</div>";
			print json_encode($jTableResult);
		break;
        case 'eliminarEspecie':
			$jTableResult = array();
			$jTableResult['msj'] = "";
			$jTableResult['resultd'] = "";
			$query = $conn->prepare("DELETE FROM especiesmnrs WHERE idEspecie =?");
			$query->bind_param("i", $_POST['eliminarEspecie']);
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
		case 'rellenarDatosEsp'://BUSCAR INFORMACION PARA LLENAR FORMULARIO A ACTUALIZAR
			$jTableResult = array();
				$jTableResult['nombreEspecie']="";
				$jTableResult['nombreUnidadFk']="";
				$jTableResult['idEspecie']="";
				$query = $conn->prepare("SELECT idEspecie, nombreEspecie, idUnidad_FK, unidades.nombreUnidadPro AS nombreUndPro FROM especiesmnrs INNER JOIN unidades ON unidades.idUnidadPro = especiesmnrs.idUnidad_FK WHERE idEspecie = ?");
				$query->bind_param("i", $_POST['rellenarEspecie']);
				$query->execute();
				$resultado = $query->get_result();
				if ($registro = $resultado->fetch_assoc()) {
					$jTableResult['idEspecie'] = $registro['idEspecie']; 
					$jTableResult['nombreEspecie'] = $registro['nombreEspecie'];
					$jTableResult['nombreUnidadFk'] = $registro['nombreUndPro'];
				}
			// Cerrar consulta preparada
			$query->close();	
			print json_encode($jTableResult);
		break;
		case 'actualizarEspecie'://BUSCAR INFORMACION PARA LLENAR FORMULARIO A ACTUALIZAR
			$jTableResult = array();
			$jTableResult['msj']="";
			$jTableResult['resultd']="";
			$query=$conn->prepare("UPDATE especiesmnrs SET nombreEspecie=?  WHERE idEspecie=?");
			$query->bind_param("si", $_POST['nombreEsUptd'], $_POST['idEspecieUptd']);
			if ($query->execute()){
				mysqli_commit($conn);
				$jTableResult['msj']="DATO ACTUALIZADO CORRECTAMENTE";
				$jTableResult['resultd']="1";
			} else {
				mysqli_rollback($conn);
				$jTableResult['msj']="ERROR AL ACTUALIZAR. INTENTE NUEVAMENTE.";
				$jTableResult['resultd']="0";
			}
			// Cerrar consulta preparada
			$query -> close();	   		
		print json_encode($jTableResult);
		break;
    }
	mysqli_close($conn);
?>




