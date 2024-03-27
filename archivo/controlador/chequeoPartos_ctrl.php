<?php
	include("../../include/conex.php");

	$conn=Conectarse();
	switch ($_REQUEST['action']) 
	{
		case 'GuardarParto': // codigoVacaCase este nombre es asignado por uno, no viene de ningun lado
			$jTableResult = array();
				$jTableResult['msj']=""; 
				$jTableResult['result']="";
				$query="INSERT INTO partos SET 
				fechaRealParto = '".$_POST['fechPart']."',
				sexoCria = '".$_POST['sexCriaP']."',
				pesoNacidoPartos = '".$_POST['pesoNaceCria']."',
				unidadPesoPartos = '".$_POST['UnidPeso']."',
				observacionesRep = '".$_POST['Obseva']."';";				
				if ($resultado = mysqli_query($conn, $query))
					{
						mysqli_commit($conn);
						$jTableResult['alertify']="DATO GUARDADO CORRECTAMENTE"; 
						$jTableResult['result']="1";
					}

				else
					{
						mysqli_rollback($conn);
						$jTableResult['msj']="ERROR AL GUARDAR, VUELVA A"; 
						$jTableResult['result']="0";
					}
			print json_encode($jTableResult);
		break;
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
		case 'fechUltmServ':
			$jTableResult['fechaCeloV']="";
			$sql = "SELECT fechaCelo FROM servicio ORDER BY codigoVacaRep = 2 ASC LIMIT 1;";
			$result = mysqli_query($conn, $sql);
			//$row = mysqli_fetch_assoc($result);
			while($registro = mysqli_fetch_array($result))
				{
					$jTableResult['fechaCeloV']= $registro['fechaCelo'];
				}
			print json_encode($jTableResult);
		break;
	}
mysqli_close($conn);
?>