<?php
	header('Cache-Control: no-cache, must-revalidate');
	include('../../include/parametros_index.php');
	date_default_timezone_set('America/Bogota');
	include('../../include/conex.php');
	session_start();
	$conn=Conectarse();
	//$horaTime = date("H:i:s");
	Switch ($_REQUEST['action']) 
	{

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

		case 'raza':
			$jTableResult = array();
				$jTableResult['raza']="";
				$jTableResult['raza']="<option value='0' selected >Seleccione</option>";
				$query=" SELECT idRaza, nombreRaza from raza"; // cambiar el nombre de la tabla y los campos de la tabla
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['raza'].="<option value='".$registro['idRaza']."'>".$registro['nombreRaza']."</option>"; //cambiar datos por los de la tabla

					}				
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

			
				$query=" SELECT nombreRaza from raza where idRaza='".$jTableResult['numrazaPajilla']."';"; // cambiar el nombre de la tabla y los campos de la tabla
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
					$query=" SELECT idAnimal, codAnimal from animales;"; // cambiar el nombre de la tabla y los campos de la tabla
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
		case 'guardarPajilla':
            $jTableResult = array();
            $jTableResult['msj']="";
            $jTableResult['resultd']="";
            $query="INSERT INTO pajilla SET 
                numeroRegistro='".$_POST['codToro']."',
                nombrePajilla='".$_POST['nombeToro']."',
				razaPajilla='".$_POST['razaToro']."';"; 
                if ($resultado=mysqli_query($conn,$query))
                    {
                        mysqli_commit($conn);
                        $jTableResult['msj']="  DATO GUARDADO CORRECTAMENTE";
                        $jTableResult['resultd']="1";
                    }
                else
                    {
                        mysqli_rollback($conn);
                        $jTableResult['msj']="  ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
                        $jTableResult['resultd']="0";
                    }
            print json_encode($jTableResult);
        break;

		/*REGISTRAR REPRODUCCION*/ 
		case 'guardarCheck':
            $jTableResult = array();
            $jTableResult['msj']="";
            $jTableResult['resultd']="";
                $query="INSERT INTO servicio SET 
                codigoVacaRep='".$_POST['codVaca']."',
                nombreVacaRep='".$_POST['nombeVaca']."',
				razaVacaRep='".$_POST['razaVaca']."',
				fechaCelo='".$_POST['fechCelo']."',
				servido='".$_POST['servicio']."',
				observacionesServ='".$_POST['observacionesRep']."',
				idUsuario='".isset($_SESSION['id_Usu'])."';";
                if ($resultado=mysqli_query($conn,$query))
                    {
                        mysqli_commit($conn);
                        $jTableResult['msj']="  DATO GUARDADO CORRECTAMENTE";
                        $jTableResult['resultd']="1";
                    }
                else
                    {
                        mysqli_rollback($conn);
                        $jTableResult['msj']="  ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
                        $jTableResult['resultd']="0";
                    }
            print json_encode($jTableResult);
        break;
		case 'guardarCheckCompleto':
		
            $jTableResult = array();
            $jTableResult['msj']="";
            $jTableResult['resultd']="";
                $query="INSERT INTO servicio SET 
                codigoVacaRep='".$_POST['codVaca']."',
                nombreVacaRep='".$_POST['nombeVaca']."',
				razaVacaRep='".$_POST['razaVaca']."',
				fechaCelo='".$_POST['fechCelo']."',
				servido='".$_POST['servicio']."',
				metodoRep='".$_POST['metodoRep']."',
				numeroRegistroP='".$_POST['codigoTorP']."',
				nombreToro='".$_POST['nombreTorP']."',
				razaToro='".$_POST['razaTorP']."',
				observacionesServ='".$_POST['observacionesRep']."',
				idUsuario='".isset($_SESSION['id_Usu'])."';";
                if ($resultado=mysqli_query($conn,$query))
                    {
                        mysqli_commit($conn);
                        $jTableResult['msj']="  DATO GUARDADO CORRECTAMENTE";
                        $jTableResult['resultd']="1";
                    }
                else
                    {
                        mysqli_rollback($conn);
                        $jTableResult['msj']="  ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
                        $jTableResult['resultd']="0";
                    }
            print json_encode($jTableResult);
        break;
	}		
mysqli_close($conn);
?>