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
        case 'guardarArea':
            $jTableResult = array();
            $jTableResult['msj']="";
            $jTableResult['resultd']="";
            if($_POST['nombreArea']==""){
                $jTableResult['msj']="CAMPOS OBLIGATORIOS";
                $jTableResult['resultd']="0";
            }else{
                $query = $conn ->prepare("SELECT idAreaUsu FROM areas WHERE nombreAreaUsu = ?");
                $query ->bind_param('s', $_POST['nombreArea']);
                $query -> execute();
                $resultado = $query -> get_result();
                $numero = $resultado -> num_rows;
                if ($numero == 0){
                    $query = $conn->prepare("INSERT INTO areas(nombreAreaUsu, idCentro_FK) VALUES(?, ?)");
                    $query->bind_param("si", $_POST['nombreArea'], $_POST['arexcentro']);
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
                }else{
                    $jTableResult['msj'] = "REGISTRO YA EXISTE. ";
                    $jTableResult['resultd'] = "0";
                }
				$query->close();
            }
            print json_encode($jTableResult);
        break;
        case 'updateArea':
            $jTableResult = array();
            $jTableResult['msj']="";
            $jTableResult['resultd']="";
                $query = $conn ->prepare("SELECT idAreaUsu FROM areas WHERE nombreAreaUsu = ?");
                $query ->bind_param('s', $_POST['nombreUpdateArea']);
                $query -> execute();
                $resultado = $query -> get_result();
                $numero = $resultado -> num_rows;
                if ($numero == 0){
                    $query = $conn->prepare("UPDATE areas SET nombreAreaUsu=? WHERE idAreaUsu=?");
                    $query->bind_param("si", $_POST['nombreUpdateArea'], $_POST['idUpdateArea']);
                    if ($query->execute()) {
                        mysqli_commit($conn);
                        $jTableResult['msj'] = "DATO ACTUALIZADO CORRECTAMENTE";
                        $jTableResult['resultd'] = "1";
                    }
                    else{
                        mysqli_rollback($conn);
                        $jTableResult['msj'] = "ERROR AL ACTUALIZAR. INTENTE NUEVAMENTE.";
                        $jTableResult['resultd'] = "0";
                    }
                }else{
                    $jTableResult['msj'] = "REGISTRO YA EXISTE. ";
                    $jTableResult['resultd'] = "0";
                }
                // Cerrar consulta preparada
			    $query->close();
            print json_encode($jTableResult);
        break;
        case 'DeleteArea':
            $jTableResult = array();
            $jTableResult['msj']="";
            $jTableResult['resultd']="";
                $query = $conn->prepare("DELETE FROM areas WHERE idAreaUsu=?");
                $query->bind_param("i", $_POST['idAreaDel']);
                if ($query->execute()) {
                    mysqli_commit($conn);
                    $jTableResult['msj'] = "DATO ELIMINADO CORRECTAMENTE";
                    $jTableResult['resultd'] = "1";
                }
                else{
                    mysqli_rollback($conn);
				    $jTableResult['msj'] = "ERROR AL ELIMINAR. INTENTE NUEVAMENTE.";
				    $jTableResult['resultd'] = "0";
                }
                // Cerrar consulta preparada
				$query->close();
            print json_encode($jTableResult);
        break;
        case 'llenarAreas':
            $jTableResult = array();
            $jTableResult['nombreArea'] = "";
            $query = $conn->prepare("SELECT nombreAreaUsu FROM areas WHERE idAreaUsu=?");
            if ($query) {
                $query->bind_param("i", $_POST['idLlenarArea']);
                if ($query->execute()) {
                    $query->bind_result($nombreArea);
                    if ($query->fetch()) {
                        $jTableResult['nombreArea'] = $nombreArea;
                    }
                }
                $query->close();
            }
            print json_encode($jTableResult);
        break;
        case 'listarArea':
			$jTableResult = array();
			$jTableResult['msj']= "";
			$jTableResult['restl']= "";		
			$jTableResult['listaArea']= "";	
			$var_area= 	"%".$_POST['var_area']."%";
				$query = $conn->prepare("SELECT idAreaUsu, nombreAreaUsu FROM areas WHERE nombreAreaUsu LIKE ? ;");
				$query -> bind_param('s', $var_area);
				if($query->execute()){
					$resultado = $query -> get_result();
					$numero = $resultado -> num_rows;
					if($numero > 0){
						$cont = 1;
						$jTableResult['listaArea']="
						<thead>
							<tr>
								<th scope='col'>#</th>
								<th scope='col'>ID</th>
								<th scope='col'>Nombre</th>
								<th scope='col'>Op</th>
							</tr>
						</thead>";
						while($registro = $resultado -> fetch_assoc())
						{
							$jTableResult['listaArea'].="
							<tr >
								<td width='1%' >".$cont."</td>
								<td width='3%'>".$registro['idAreaUsu']."</td>
								<td width='50%' >".$registro['nombreAreaUsu']."</td>
								<td>
									<button  
										class='btn' 
										id='btnActualizarCardArea' 
										data-idAreaUpdate='".$registro['idAreaUsu']."' 
										data-tipo-update='3' 
										data-toggle='modal' 
										data-target='#updateArea' 
										style='background-color: #FFC300; color: black;'>
										<i class='fa-solid fa-pen-to-square'></i>
									</button>
									<button  
										<button class='btn' 
										id='btnEliminarCardArea' 
										data-idArea='".$registro['idAreaUsu']."'
										data-tipo='3' style='background-color: red; color: #fff; margin-right: 0.5rem;'>
										<i class='fa-solid fa-trash'></i></button>
									</button>
								</td>							
							<tr>";
							$cont=$cont+1;
					    }
					}
					else{
						$jTableResult['listaArea']="
						<thead>
                            <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>ID</th>
                                <th scope='col'>Nombre</th>
                                <th scope='col'>Op</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td colspan='4'><center><h4>No se encontraron resultados</h4></center> </td>
                            </tr>
                        </tbody>";
					}
				}else{
					$jTableResult['restl']= "0";		
					$jTableResult['msj']= "HUBO UN PROBLEMA AL EJECUTAR LA CONSULTA";		
				}
			print json_encode($jTableResult);
		break;		
    }
    mysqli_close($conn);
?>