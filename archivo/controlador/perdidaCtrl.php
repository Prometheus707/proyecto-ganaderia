<?php
include('../../include/conex.php');
$conn=conectarse();
date_default_timezone_set('America/Bogota');
$varDateHoy = date("Y/M/D h:m");
$horaTime = date("H:i:s");
switch ($_REQUEST['action']) 
	{    
        case 'guardarperdida':
            $jTableResult = array();
            $jTableResult['msj']="";
            $jTableResult['resultd']="";
            $query="INSERT INTO perdida SET 
                fechaRegistroPérdida='".$varDateHoy."',
                fechaPerdida='".$_POST['fechaPerd']."',           
                idAnimalFK='".$_POST['idAnimalFK']."',
                observaciones='".$_POST['comentariospernamdi']."';"; 
                if ($resultado= mysqli_query($conn,$query))
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
           //listar animal
        case 'cargarperdida':
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
            case 'perdidas':
                $jTableResult = array();
                    $jTableResult['msj']="";
                    $jTableResult['resultd']="";
                            $query="INSERT INTO perdida SET 
                            observaciones ='".$_POST['obper']."',
                            fechaRegistroPérdida ='".$varDateHoy."',
                            idAnimalFK ='".$_POST['idAnimalFK']."',
                            fechaPerdida ='".$_POST['fechaPerdida']."';";
                            if ($resultado= mysqli_query($conn,$query)) {
                                    mysqli_commit($conn);
                                    $jTableResult['msj']="  DATO GUARDADO CORRECTAMENTE";
                                    $jTableResult['resultd']="1";
                                }
                            else {
                                    mysqli_rollback($conn);
                                    $jTableResult['msj']="  ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
                                    $jTableResult['resultd']="0";
                                }
                print json_encode($jTableResult); 
            break;
            case 'guardarImagen':
                $jTableResult = array();
                    $jTableResult['msj']="";
                    $jTableResult['resultd']="";
                            $query="INSERT INTO imagen SET 
                            imagenMuerte ='".$_POST['imagenMuerte']."';";
                            if ($resultado= mysqli_query($conn,$query)) {
                                    mysqli_commit($conn);
                                    $jTableResult['msj']="  DATO GUARDADO CORRECTAMENTE";
                                    $jTableResult['resultd']="1";
                                }
                            else {
                                    mysqli_rollback($conn);
                                    $jTableResult['msj']="  ERROR AL GUARDAR. INTENTE NUEVAMENTE.";
                                    $jTableResult['resultd']="0";
                                }
                print json_encode($jTableResult); 
            break;
            case 'fechaperdida':
                $jTableResult = array();
                $jTableResult['msj']="";
                $jTableResult['resultd']="";
                $query = "select fechaPerdida from perdida where fechaPerdida='".$_POST['perf']."'"; 
                $resultado = mysqli_query($conn, $query);
                $numero=mysqli_num_rows($resultado);
                if ($numero>0)
                    {
                        $jTableResult['msj']="LA FECHA YA EXISTE";
                        $jTableResult['resultd']="0";
                    }
                else
                    {
                        $query="INSERT INTO perdida SET fechaPerdida ='".$_POST['perf']. "',
                        '".$_POST['perf']."'; "; 
                        if ($resultado= mysqli_query($conn,$query))
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

                    }
                print json_encode($jTableResult);  
            break;
            default: echo "PETICION NO EXISTE..";
	}
mysqli_close($conn);
?>