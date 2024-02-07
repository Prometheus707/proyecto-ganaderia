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
				$query="SELECT  prsn.id_persona,  prsn.fecha_Registro_Usu,  prsn.numero_identificacion,  prsn.nombre, prsn.apellido,  prsn.telefono,  prsn.email, prsn.estado,  prsn.id_rol_fk, rl.nombre_rol
				FROM persona prsn INNER JOIN rol rl ON prsn.id_rol_fk = rl.Id_rol
				WHERE prsn.numero_identificacion='".$_POST['inputusuario']."' AND prsn.clave='".$_POST['inputclave']."';";
				$regis = mysqli_query($conn, $query);
				$numero = mysqli_num_rows($regis);
				if($numero==0)
					{
						$query="SELECT prsn.estado FROM persona prsn WHERE prsn.numero_identificacion='".$_POST['inputusuario']."' AND prsn.clave='".$_POST['inputclave']."';";
						$regis = mysqli_query($conn, $query);
						$numero = mysqli_num_rows($regis);
						if($numero==1){
							while($registro=mysqli_fetch_array($regis)){
								if($registro['estado']=="0"){
									$jTableResult['msj_DelSistema']="USUARIO SIN PERMISOS DE ENTRADA.";
									$jTableResult['Resultado']= "0";
								}}}	
						if($numero==0){	
								$jTableResult['msj_DelSistema']= "USUARIO NO EXISTE.";								
								$jTableResult['Resultado']= "0";
							}	
					}
				else if($numero==1)
					{
						while($registro = mysqli_fetch_array($regis))
							{	
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
									$jTableResult['Resultado'] = "1";
								}								
							}
					}
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
		case 'actualizarUsuLog':
			$jTableResult = array(); 
				$query ="SELECT id_persona, numero_identificacion FROM persona WHERE email='".$_POST['correo_update']."' AND id_persona!='".$_POST['id_persona']."';"; 
				$resultado = mysqli_query($conn, $query);
				$numero = mysqli_num_rows($resultado);
				if($numero>0)
					{
						$jTableResult['msj_DelSistema']= "CORREO ELECTRONICO YA EXISTE.";
						$jTableResult['Resultado']= "0";
					}
				else 
					{	$_POST['clave_update'];
						if($_POST['clave_update']==""){	 $varClave_update = "";	}else{  $varClave_update = " clave = ".$_POST['clave_update']." ,";	}
						$query="UPDATE persona SET						
						nombre='".$_POST['nombre_update']."',	
						apellido='".$_POST['apellido_update']."',	
						telefono='".$_POST['telefono_update']."',	
						email='".$_POST['correo_update']."',
						".$varClave_update."
						id_area_FK='".$_POST['id_area_FK_update']."' 
						WHERE id_persona='".$_POST['id_persona']."';";
						if($resultado = mysqli_query($conn, $query))
							{
								$jTableResult['msj_delSistema']= "Actualizacion realizada con exito.";
								$jTableResult['Resultado']= "1";
							}
						else
							{
								$jTableResult['msj_delSistema']= "Intenta Nuevamente. Se presento un problema.";
								$jTableResult['Resultado']= "0";
							}
					}	
			print json_encode($jTableResult);
		break;		
		/*case 'asignarNuevaClave':
			$jTableResult = array();
				$query ="SELECT id_persona, numero_identificacion, nombre, apellido, estado, email 
				FROM persona WHERE numero_identificacion='".$_POST['inputUsuario']."';";
				$resultado = mysqli_query($conn, $query);
				$numero = mysqli_num_rows($resultado);
				if($numero==0)
					{
						$jTableResult['msj_DelSistema']= "Usuario no existe.";
						$jTableResult['Resultado']= "0";
					}
				else
					{				
						$num1=rand(1, 10);
						$var_NewClave = generaCodigo($num1); //md5('$Newpassword')
						while($row = mysqli_fetch_array($resultado))
						{
							$var_Usu=$row['nombre']." ".$row['apellido']." ";
							$varCorreoDestino=$row['email'];
							//$var_Contenido = crearMsj($var_Usu, $var_NewClave);
							//$enviando = enviarEmail($var_Contenido, $varCorreoDestino, $var_Usu);							
							// $jTableResult['Resultado'] = "1";
						}
						echo "\nContenido: ".$var_Contenido;
						exit();
					}
			print json_encode($jTableResult);
		break;		*/
		case 'registrarUsuario':
			$jTableResult = array();
				if(($_POST['identificacion_Registro']==NULL) 
					or ($_POST['nombre_Registro']==NULL) 
					or ($_POST['apellido_Registro']==NULL) 
					or ($_POST['correo_Registro']==NULL) 
					or ($_POST['telefono_Registro'] ==NULL) 
					or ($_POST['clave_Registro']==NULL))
					{
						$jTableResult['msj_DelSistema']= "UN CAMPO O VARIOS CAMPOS";
						$jTableResult['msj_DelSistema'].= "<br>";
						$jTableResult['msj_DelSistema'].= "ESTAN SIN DILIGENCIAR.";
						$jTableResult['Resultado']= "0";						
					}
				else
					{
						$query ="SELECT id_persona FROM persona WHERE numero_identificacion='".$_POST['identificacion_Registro']."'; ";
						$resultado = mysqli_query($conn, $query);
						$numero = mysqli_num_rows($resultado);
						if($numero>0)
							{
								$jTableResult['msj_DelSistema']= "EL NUMERO DE CEDULA YA EXISTE.";
								$jTableResult['Resultado']= "0";
							}
						else
							{
								$query ="SELECT id_persona FROM persona WHERE email='".$_POST['correo_Registro']."'";
								$resultado = mysqli_query($conn, $query);
								$numero = mysqli_num_rows($resultado);
								if($numero>0)
									{
										$jTableResult['msj_DelSistema']= "CORREO ELECTRONICO YA EXISTE.";
										$jTableResult['Resultado']= "0";
									}
								else 
									{
										mysqli_autocommit($conn, TRUE);
										mysqli_begin_transaction($conn);
										$query="INSERT INTO persona 
										SET fecha_Registro_Usu ='".$_POST['fecha_Registro']."', 
										numero_identificacion ='".$_POST['identificacion_Registro']."',
										nombre ='".$_POST['nombre_Registro']."', 
										apellido ='".$_POST['apellido_Registro']."',
										telefono ='".$_POST['telefono_Registro']."',
										email ='".$_POST['correo_Registro']."',
										estado ='".$var_Estado."',
										id_rol_fk ='".$varRol."',
										clave ='".$_POST['clave_Registro']."';"; 
										if($result= mysqli_query($conn,$query))
											{
												mysqli_commit($conn);
												$jTableResult['msj_DelSistema']= "REGISTRO REALIZADO CON EXITO.";
												$jTableResult['msj_DelSistema'].= " <br> ";
												$jTableResult['msj_DelSistema'].= "TU USUARIO DEBE SER ACTIVADO";
												$jTableResult['msj_DelSistema'].= " <br> ";
												$jTableResult['msj_DelSistema'].= "PARA PODER ACCEDER.";
												$jTableResult['Resultado']= "1";	
											}
										else
											{
												mysqli_rollback($conn);
												$jTableResult['msj_DelSistema']= "SEPRESENTO UN ERROR. INTENTA NUEVAMENTE. O COMUNICA A LOS ENCARGADOS.";
												$jTableResult['Resultado']= "0";
											}
									}
							}
					}					
			print json_encode($jTableResult);
		break;
	}		
mysqli_close($conn);
?> 