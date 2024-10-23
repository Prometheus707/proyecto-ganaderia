<?php
require_once('config.php');
header('Content-Type: text/html; charset='.$charset);
header('Cache-Control: no-cache, must-revalidate');
include_once('parametros_index.php');
session_name($session_name);
session_start();
// include('enviar_email.php');
// include('admin_encri.php');
// include('generador.php');
// include('table_msj.php');
include('conex.php');
$conn=Conectarse();
switch ($_REQUEST['action']) 
	{
		case 'salir':
			unset($_SESSION['id_Usu']);
			unset($_SESSION['nombre_Usu']);
			unset($_SESSION['apellido_Usu']);
			unset($_SESSION['telefono_Usu']);
			unset($_SESSION['email_Usu']);
			unset($_SESSION['estado_Usu']);
			unset($_SESSION['id_rol_fk']);
			unset($_SESSION['usuario_Logeado']);			
			unset($_SESSION['nombre_rol']);			
			unset($_SESSION['nombre_area']);
			unset($_SESSION['almacen']);			
			session_destroy();
			header('Location: ../index.php');
		break;
		case 'inicioSesion':
			$jTableResult = array();
				$query = $conn -> prepare("SELECT  prsn.id_persona,  prsn.fecha_Registro_Usu,  prsn.numero_identificacion, prsn.regionalUsuario_fk, prsn.nombre, prsn.apellido,  prsn.telefono,  prsn.email, prsn.estado, prsn.centroUusario_fk,  prsn.id_rol_fk, rl.nombre_rol
				FROM persona prsn INNER JOIN rol rl ON prsn.id_rol_fk = rl.Id_rol
				WHERE prsn.numero_identificacion=? AND prsn.clave=?;");
				$query -> bind_param('is', $_POST['inputusuario'], $_POST['inputclave']);
				if($query -> execute()){
					$resultado = $query -> get_result();
					$numero = $resultado -> num_rows;
					if($numero == 0){
						$jTableResult['msj_DelSistema']= "USUARIO NO EXISTE.";								
						$jTableResult['Resultado']= "0";
					}
					else{
						while($registro = $resultado -> fetch_assoc()){
							if($registro['estado']=="0"){
								$jTableResult['msj_DelSistema']="USUARIO SIN PERMISOS DE ENTRADA.";
								$jTableResult['Resultado']= "0";
							}else{	
								$_SESSION['id_Usu'] = $registro['id_persona'];
								$_SESSION['nombre_Usu']	= $registro['nombre'];
								$_SESSION['apellido_Usu'] = $registro['apellido'];
								$_SESSION['telefono_Usu'] = $registro['telefono'];
								$_SESSION['usuario_Logeado'] =$registro['nombre'];
								//$_SESSION['usuario_Logeado'] = utf8_encode($_SESSION['usuario_Logeado']);
								$_SESSION['email_Usu'] = $registro['email'];
								$_SESSION['estado_Usu'] = $registro['estado'];
								$_SESSION['id_rol_fk'] = $registro['id_rol_fk'];
								$_SESSION['nombre_rol'] = $registro['nombre_rol'];	
								$_SESSION['numero_identificacion'] = $registro['numero_identificacion'];
								$_SESSION['centroUusario_fk'] = $registro['centroUusario_fk'];
								$_SESSION['regionalUsuario_fk'] = $registro['regionalUsuario_fk'];
								$jTableResult['Resultado'] = "1";
							}							
						}
					}
				}
			$query -> close();
			print json_encode($jTableResult);
		break;		
		case 'buscarId_Usu':
			$jTableResult = array();
			$jTableResult['id_persona']="";
			$jTableResult['numero_identificacion']="";
			$jTableResult['nombre']="";
			$jTableResult['apellido']="";
			$jTableResult['telefono']="";
			$jTableResult['email']="";
			$jTableResult['estado']="";
			$jTableResult['Id_rol_fk']="";
			$jTableResult['nombre_rol']="";
			$jTableResult['id_area_FK']="";
			$jTableResult['areas']="";
				$query = " SELECT  prsn.id_persona,  prsn.fecha_Registro_Usu,  prsn.numero_identificacion,  prsn.nombre,
				prsn.apellido,  prsn.telefono,  prsn.email,  prsn.clave,  prsn.estado,  prsn.id_rol_fk,
				rl.nombre_rol
				FROM    persona prsn INNER JOIN rol rl ON prsn.id_rol_fk = rl.Id_rol 
				WHERE prsn.id_persona='".$_SESSION['id_Usu']."';"; 
				//exit();
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['id_persona']=$registro['id_persona'];
						$jTableResult['numero_identificacion']=$registro['numero_identificacion'];
						$jTableResult['nombre']=$registro['nombre'];
						$jTableResult['apellido']=$registro['apellido'];
						$jTableResult['telefono']=$registro['telefono'];
						$jTableResult['email']=$registro['email'];
						$jTableResult['estado']=$registro['estado'];
						$jTableResult['Id_rol_fk']=$registro['id_rol_fk'];
						$jTableResult['nombre_rol']=$registro['nombre_rol'];
						$jTableResult['id_area_FK']=$registro['id_area_FK'];
					}
				$jTableResult['areas']="<option value='0'>:.</option>";
				$query = " select id_area, nombre_area FROM area";	
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						if($jTableResult['id_area_FK']==$registro['id_area']){
							$jTableResult['areas'].="<option value='".$registro['id_area']."' selected >".$registro['nombre_area']."</option>";
						}else{
							$jTableResult['areas'].="<option value='".$registro['id_area']."'>".$registro['nombre_area']."</option>";							
						}
					}					
			print json_encode($jTableResult);
		break;		
		case 'buscarUsuarioInicio':
			$jTableResult = array();
			$jTableResult['id_persona']="";
			$jTableResult['numero_identificacion']="";
			$jTableResult['nombre']="";
			$jTableResult['apellido']="";
			$jTableResult['telefono']="";
			$jTableResult['email']="";
			$jTableResult['estado']="";
			$jTableResult['Id_rol_fk']="";
			$jTableResult['nombre_rol']="";
			$jTableResult['idRegPerson']="";
			$jTableResult['idCentPerson']="";
			$jTableResult['id_area_FK']="";
			$jTableResult['areas']="";
				$query = " SELECT  prsn.id_persona,  prsn.fecha_Registro_Usu,  prsn.numero_identificacion,  prsn.nombre,
				prsn.apellido,  prsn.telefono,  prsn.email,  prsn.clave,  prsn.estado,  prsn.id_rol_fk,
				rl.nombre_rol, prsn.regionalUsuario_fk, prsn.centroUusario_fk, prsn.areaUsu_fk
				FROM    persona prsn INNER JOIN rol rl ON prsn.id_rol_fk = rl.Id_rol 
				WHERE prsn.id_persona='".$_SESSION['id_Usu']."';"; 
				//exit();
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['id_persona']=$registro['id_persona'];
						$jTableResult['numero_identificacion']=$registro['numero_identificacion'];
						$jTableResult['nombre']=$registro['nombre'];
						$jTableResult['apellido']=$registro['apellido'];
						$jTableResult['telefono']=$registro['telefono'];
						$jTableResult['email']=$registro['email'];
						$jTableResult['estado']=$registro['estado'];
						$jTableResult['Id_rol_fk']=$registro['id_rol_fk'];
						$jTableResult['nombre_rol']=$registro['nombre_rol'];
						$jTableResult['idRegPerson']=$registro['regionalUsuario_fk'];
						$jTableResult['idCentPerson']=$registro['centroUusario_fk'];
						$jTableResult['id_area_FK']=$registro['areaUsu_fk'];
						
					}	
			print json_encode($jTableResult);
		break;
		/////////////SANTIAGO/////////////////////////////////
		case 'listarRegionalUsuario':
			$jTableResult = array();
			$jTableResult['listaRegionalUs'] = "<option value='0' selected>Regionales.....</option>";
			$query = "SELECT idRegional, nombreRegional FROM regional";
			$resultado = mysqli_query($conn, $query);
			if ($resultado) {
				while ($registro = mysqli_fetch_assoc($resultado)) {
					$jTableResult['listaRegionalUs'] .= "<option value='".mb_convert_encoding($registro['idRegional'], 'UTF-8', 'auto')."'>" . 
														mb_convert_encoding($registro['nombreRegional'], 'UTF-8', 'auto')."</option>";
				}
				$resultado->free();
			}
			echo json_encode($jTableResult);
		break;		
		case 'listarCentroUsuario':
			$jTableResult = array();
			$jTableResult['listaCentroUs'] = "<option value='0' selected>Centros...</option>";
				$query = $conn->prepare("SELECT idCentro, nombreCentro FROM centro WHERE idRegional = ?");
				$query->bind_param('i',$_POST['idReginalUsu']);		
				if ($resultado=$query->execute()) {
					$resultado = $query->get_result();
					while ($registro = $resultado->fetch_assoc()) {
						$jTableResult['listaCentroUs'] .= "<option value='" . $registro['idCentro'] . "'>" . $registro['nombreCentro'] . "</option>";
					}
					$resultado->free();
				}
				// Cerrar consulta preparada
				$query->close();
			echo json_encode($jTableResult);
		break;
		case 'listarAreasUsu':
			$jTableResult = array();
			$jTableResult['listaAreasUs'] = "<option value='0' selected>Areas...</option>";
				$query = $conn->prepare("SELECT idAreaUsu, nombreAreaUsu FROM areas WHERE idCentro_FK = ?");
				$query->bind_param('i', $_POST['idCentroUsu']);		
				if ($resultado=$query->execute()) {
					$resultado = $query->get_result();
					while ($registro = $resultado->fetch_assoc()) {
						$jTableResult['listaAreasUs'] .= "<option value='" . $registro['idAreaUsu'] . "'>" . utf8_encode($registro['nombreAreaUsu']) . "</option>";
					}
					$resultado->free();
				}
				// Cerrar consulta preparada
				$query->close();
			echo json_encode($jTableResult);
		break;
		case 'actualizarUsuLog':
			$jTableResult = array();
			$jTableResult['msj']="";
			$jTableResult['resultd']="";
			if(($_POST['nombreUsuUpdate']=="") OR ($_POST['apellidoUsuUpdate']=="") OR ($_POST['numCelUsuUpdate']=="") OR ($_POST['correroUsuUpdate']=="") OR ($_POST['regionUsuUpdate']==0) OR($_POST['centroUsuUpdate']==0) OR ($_POST['areaUpdate']==0)){
				$jTableResult['msj']="TIENE CAMPOS OBLIGATORIOS POR LLENAR";
				$jTableResult['resultd']="0";
			}else{
				$query = $conn->prepare("UPDATE persona SET numero_identificacion=?, nombre=?, apellido=?, telefono=?, email=?, regionalUsuario_fk=?, centroUusario_fk=?, areaUsu_fk=? WHERE id_persona='".$_SESSION['id_Usu']."' ");
				$query->bind_param('sssssiii', $_POST['docUpdate'], $_POST['nombreUsuUpdate'], $_POST['apellidoUsuUpdate'], $_POST['numCelUsuUpdate'], $_POST['correroUsuUpdate'], $_POST['regionUsuUpdate'], $_POST['centroUsuUpdate'], $_POST['areaUpdate'] );
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
		/////////////CIERRE SANTIAGO/////////////////////////////////
		case 'vericarUsuUp':
			$jTableResult = array();
			$jTableResult['msj']="";
			$jTableResult['resultd']="";
			$query = $conn -> prepare("SELECT id_persona FROM persona WHERE id_persona=? AND clave=?");
			$query -> bind_param('is', $_POST['idVeriUsu'], $_POST['claveVeriForm']);
			if($query -> execute()){
				$resultado = $query -> get_result();
				$numero = $resultado -> num_rows;
				if($numero == 0){
					$jTableResult['msj']="CONTRASEÑA INCORRECTA";
					$jTableResult['resultd']="0";
				}else{
					$jTableResult['msj']="CARGAR FORMULARIO ACTUALIZAR";
					$jTableResult['resultd']="1";
				}
			}else{
				$jTableResult['msj']="NO SE PUDO EJECUTAR LA CONSULTA";
				$jTableResult['resultd']="0";
			}
			print json_encode($jTableResult);
		break;
		case 'registrarUsuario':
			$jTableResult = array();
				if(($_POST['identificacion_Registro']==NULL) 
					or ($_POST['nombre_Registro']==NULL) 
					or ($_POST['apellido_Registro']==NULL) 
					or ($_POST['correo_Registro']==NULL) 
					or ($_POST['telefono_Registro'] ==NULL) 
					or ($_POST['regional_usuario']==0 or NULL)
					or ($_POST['centro_usuario']==0 or NULL)
					or ($_POST['clave_Registro']==NULL))
					{
						$jTableResult['msj_DelSistema']= "UN CAMPO O VARIOS CAMPOS";
						$jTableResult['msj_DelSistema'].= "<br>";
						$jTableResult['msj_DelSistema'].= "ESTAN SIN DILIGENCIAR.";
						$jTableResult['Resultado']= "0";						
					}
				else
					{
						$query = $conn->prepare("SELECT id_persona FROM persona WHERE numero_identificacion=?");
						$query->bind_param('i', $_POST['identificacion_Registro']);
						if($query->execute()){
							$resultado = $query->get_result();
							$numero = $resultado->num_rows;
							if($numero>0){
								$jTableResult['msj_DelSistema']= "EL NUMERO DE CEDULA YA EXISTE.";
								$jTableResult['Resultado']= "0";
							}
							else
							{
								$query = $conn->prepare("SELECT id_persona FROM persona WHERE email=?");
								$query->bind_param('s',$_POST['correo_Registro']);
								if($query->execute()){
									$resultado = $query->get_result();
									$numero = $resultado->num_rows;
									if($numero>0){
										$jTableResult['msj_DelSistema']= "CORREO ELECTRONICO YA EXISTE.";
										$jTableResult['Resultado']= "0";
									}
									else{
										mysqli_autocommit($conn, TRUE);
										mysqli_begin_transaction($conn);
										$query = $conn->prepare("INSERT INTO persona 
										SET fecha_Registro_Usu =?, 
										numero_identificacion =?,
										nombre =?, 
										apellido =?,
										telefono =?,
										email =?,
										estado ='".$var_Estado."',
										id_rol_fk ='".$varRol."',
										regionalUsuario_fk = ?,
										centroUusario_fk = ?,
										areaUsu_fk = ?,
										clave =?");
										$query->bind_param('ssssssiiis',
										$_POST['fecha_Registro'], 
										$_POST['identificacion_Registro'], 
										$_POST['nombre_Registro'], 
										$_POST['apellido_Registro'], 
										$_POST['telefono_Registro'], 
										$_POST['correo_Registro'],
										$_POST['regional_usuario'],
										$_POST['centro_usuario'],
										$_POST['idAreaUsua'],
										$_POST['clave_Registro']);
										if($query->execute()){
											mysqli_commit($conn);
												$jTableResult['msj_DelSistema']= "REGISTRO REALIZADO CON EXITO.";
												$jTableResult['msj_DelSistema'].= " <br> ";
												$jTableResult['msj_DelSistema'].= "TU USUARIO DEBE SER ACTIVADO";
												$jTableResult['msj_DelSistema'].= " <br> ";
												$jTableResult['msj_DelSistema'].= "PARA PODER ACCEDER.";
												$jTableResult['Resultado']= "1";	
										}else{
											mysqli_rollback($conn);
												$jTableResult['msj_DelSistema']= "SEPRESENTO UN ERROR. INTENTA NUEVAMENTE. O COMUNICA A LOS ENCARGADOS.";
												$jTableResult['Resultado']= "0";
										}
									}
								}
							}
						}
					}			
			$query->close();		
			print json_encode($jTableResult);
		break;
	}		
mysqli_close($conn);
?> 