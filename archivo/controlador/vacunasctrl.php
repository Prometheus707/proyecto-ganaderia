<?php
header('Cache-Control: no-cache, must-revalidate');
include('../../include/parametros_index.php');
date_default_timezone_set('America/Bogota');
include('../../include/conex.php');
session_start();
$conn=Conectarse();
$horaTime = date("H:i:s");
switch ($_REQUEST['action']) {
    ////////////////////////////VACUNACION//////////////////////////////////
    case 'selectVacunas':
        $jTableResult = array();
				$jTableResult['selectVacunas']="";
				$jTableResult['selectVacunas']="<option value='0' selected >seleccione:.</option>";
				$query = "SELECT idVacuna, nombreVacuna FROM vacunas";	
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['selectVacunas'].="<option value='".$registro['idVacuna']."' >".$registro['nombreVacuna']."</option>";
					}	
			print json_encode($jTableResult);
    break;
    case 'selectVeterinario':
        $jTableResult = array();
				$jTableResult['selectVacunas']="";
				$jTableResult['selectVeterinario']="<option value='0' selected >seleccione:.</option>";
				$query = "SELECT id_persona, CONCAT(nombre,' ', apellido) AS nombre_completo FROM persona WHERE id_rol_fk=12";	
				$resultado = mysqli_query($conn, $query);
				while($registro = mysqli_fetch_array($resultado))
					{
						$jTableResult['selectVeterinario'].="<option value='".$registro['id_persona']."' >".$registro['nombre_completo']."</option>";
					}	
			print json_encode($jTableResult);
    break;
    case 'guardarVacunacion':
        $jTableResult = array();
        $jTableResult['msj']="";
        $jTableResult['resultd']="";
        if(($_POST['nombreVacuna']==0) OR 
        ($_POST['laboratorioVacuna']=="") OR 
        ($_POST['numeroLoteVacuna']=="") OR 
        ($_POST['registroIcaVacuna']=="") OR 
        ($_POST['dosificacionVacuna']=="") OR 
        ($_POST['viaDeAdminVacuna']==0) OR 
        ($_POST['tiempoDeRetiroVacuna']=="") OR 
        ($_POST['idVeterinarioVacunacion']==0)){
            $jTableResult['msj'] = "TIENES CAMPOS OBLIGATORIOS POR LLENAR";
            $jTableResult['resultd'] = "0";
        }else{
            $query = $conn -> prepare("INSERT INTO vacunacion 
            (fechaVacunacion, 
            nombreVacuna, 
            laboratorioVacuna, 
            numeroLoteVacuna, 
            registroIcaVacuna, 
            dosificacionVacuna, 
            viaAdministracionVacuna, 
            tiempoRetiroVacuna, 
            obervacionesVacunacion,
            usuRegVacunacion,
            idAnimalVacunacion,
            veterinarioVacunacion) 
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $query -> bind_param('sssssssssiii', 
            $_POST['fechaVacunacion'],$_POST['nombreVacuna'],
            $_POST['laboratorioVacuna'],$_POST['numeroLoteVacuna'],
            $_POST['registroIcaVacuna'],$_POST['dosificacionVacuna'],
            $_POST['viaDeAdminVacuna'],$_POST['tiempoDeRetiroVacuna'],
            $_POST['observacionVacuna'], $_POST['idUsuRegVacunacion'],
            $_POST['idAnimalVacuna'],$_POST['idVeterinarioVacunacion']);
            if($query -> execute()){
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
    case 'updateVacunacion':
        $jTableResult = array();
        $jTableResult['msj']="";
        $jTableResult['resultd']="";
        if(($_POST['nombreVacunaUpdate']==0) OR 
        ($_POST['laboratorioVacunaUpdate']=="") OR 
        ($_POST['numeroLoteVacunaUpdate']=="") OR 
        ($_POST['registroIcaVacunaUpdate']=="") OR 
        ($_POST['dosificacionVacunaUpdate']=="") OR 
        ($_POST['viaDeAdminVacunaUpdate']==0) OR 
        ($_POST['tiempoDeRetiroVacunaUpdate']=="") OR 
        ($_POST['idVeterinarioVacunacionUpdate']==0)){
            $jTableResult['msj'] = "TIENES CAMPOS OBLIGATORIOS POR LLENAR";
            $jTableResult['resultd'] = "0";
        }else{
            $query = $conn -> prepare("UPDATE vacunacion SET
            fechaVacunacion=?, 
            nombreVacuna=?, 
            laboratorioVacuna=?, 
            numeroLoteVacuna=?, 
            registroIcaVacuna=?, 
            dosificacionVacuna=?, 
            viaAdministracionVacuna=?, 
            tiempoRetiroVacuna=?, 
            obervacionesVacunacion=?,
            usuRegVacunacion=?,
            idAnimalVacunacion=?,
            veterinarioVacunacion=? 
            WHERE idVacunacion=?");
            $query -> bind_param('sssssssssiiii', 
            $_POST['fechaVacunacionUpdate'],$_POST['nombreVacunaUpdate'],
            $_POST['laboratorioVacunaUpdate'],$_POST['numeroLoteVacunaUpdate'],
            $_POST['registroIcaVacunaUpdate'],$_POST['dosificacionVacunaUpdate'],
            $_POST['viaDeAdminVacunaUpdate'],$_POST['tiempoDeRetiroVacunaUpdate'],
            $_POST['observacionVacunaUpdate'], $_POST['idUsuRegVacunacionUpdate'],
            $_POST['idAnimalVacunaUpdate'],$_POST['idVeterinarioVacunacionUpdate'],
        $_POST['idVacunacionUpdate']);
            if($query -> execute()){
                mysqli_commit($conn);
                $jTableResult['msj'] ="DATO ACTUALIZADO CORRECTAMENTE";
                $jTableResult['resultd'] = "1"; 
            }else{
                mysqli_rollback($conn); 
                $jTableResult['msj'] ="ERROR AL ACTUALIZAR. INTENTE NUEVAMENTE.";
                $jTableResult['resultd'] = "0";
            }
        }
        print json_encode($jTableResult);
    break;
    case 'cardVacunaciones':
        $jTableResult = array();
        $jTableResult['tabsVacunacion'] = "";
        $jTableResult['numeroFilas'] = "";
        $var_dato_Vacunacion = $_POST['idAnimalVacunacion'];
        $query = "SELECT idVacunacion, fechaVacunacion, vacunas.nombreVacuna AS nombre_vacuna FROM vacunacion INNER JOIN vacunas ON vacunacion.nombreVacuna=vacunas.idVacuna WHERE idAnimalVacunacion='".$var_dato_Vacunacion."' ORDER BY fechaVacunacion DESC, idVacunacion DESC;;";
        $resultado = mysqli_query($conn, $query);
        $numero = mysqli_num_rows($resultado);
        $jTableResult['numeroFilas'] = $numero;
        $jTableResult['tabsVacunacion'] .= "<div class='card'>
                            <div class='card-header' style='background-color:$varCabeceraTabla; color: white;'>
                                <h5 class='card-title'>LISTA DE VACUNACIONES</h5>
                                <div class='d-flex justify-content-end align-items-center'>   
                                    <p>total: <strong>$numero</strong></p>
                                </div>
                            </div>
                            <div class='card-body' style='max-height: 400px; overflow-y: auto;'>";
        if($numero > 0) {
            while($registro = mysqli_fetch_array($resultado)) { 
                $jTableResult['tabsVacunacion'] .= "<div class='card mb-10'>
                                                    <div class='card-body'>
                                                        <div class='row'>
                                                            <div class='col-sm-3' >
                                                                <h6 class='modal-title font-weight-bold'>Fecha: </h6>
                                                            </div>	
                                                            <div class='col-sm-4'>
                                                                <h6 class='modal-title'>".$registro['fechaVacunacion']."</h6>
                                                            </div>
                                                            <div class='col-sm-5 d-flex justify-content-end align-items-center'>
                                                                <button class='btn' id='btnEliminarCardVacunacion' data-idVacunacion='".$registro['idVacunacion']."' data-tipo='3' style='background-color: red; color: #fff; margin-right: 0.5rem;'><i class='fa-solid fa-trash'></i></button>
                                                                <button class='btn' id='btnActualizarCardVacunacion' data-idVacunacionUpdate='".$registro['idVacunacion']."' data-tipo-update='3' data-toggle='modal' data-target='#updateVacunacion' style='background-color: #FFC300; color: black;'><i class='fa-solid fa-pen-to-square'></i></button>
                                                            </div>                                                    
                                                        </div> 
                                                        <div class='row'>
                                                            <div class='col-sm-3' >
                                                                <h6 class='modal-title font-weight-bold'>Vacuna: </h6>
                                                            </div>												
                                                            <div class='col-sm-8' margin-bottom: 5rem;>
                                                                <h6 class='modal-title '>".$registro['nombre_vacuna']."</h6>
                                                                
                                                            </div>
                                                        </div>	                   
                                                    </div>
                                                </div>";
            }
        } else {
            $jTableResult['tabsVacunacion'] .= "<div class='card mb-10'>
                                                <div class='card-body'>
                                                    <center><h6>NO SE ENCONTRARON RESULTADOS</h6></center>                
                                                </div>
                                            </div>";
        }
        $jTableResult['tabsVacunacion'] .= "    </div>
                                        </div>";
        print json_encode($jTableResult);
    break;
    case 'eliminarVacunacion';
        $jTableResult = array();
        $jTableResult['msj'] = "";
        $jTableResult['resultd'] = "";
        $query = $conn -> prepare("DELETE FROM vacunacion WHERE idVacunacion=?");
        $query -> bind_param('i', $_POST['idVacunacionDel']);
        if($query -> execute()){
            mysqli_commit($conn);
            $jTableResult['msj'] = "DATO ELIMINADO CORRECTAMENTE";
            $jTableResult['resultd'] = "1";
        }else{
            mysqli_rollback($conn);
            $jTableResult['msj'] = "ERROR AL ELIMINAR. INTENTE NUEVAMENTE.";
            $jTableResult['resultd'] = "0";
        }
        print json_encode($jTableResult);
    break;
    case 'llenarFormVacunacion':
        $jTableResult = array();
        $jTableResult['msj'] = "";
        $jTableResult['resultd'] = "";
        $jTableResult['fechaVacunacion'] = "";
        $jTableResult['nombreVacuna'] = "";
        $jTableResult['laboratorioVacuna'] = "";
        $jTableResult['numeroLoteVacuna'] = "";
        $jTableResult['registroIcaVacuna'] = "";
        $jTableResult['dosificacionVacuna'] = "";
        $jTableResult['viaAdministracionVacuna'] = "";
        $jTableResult['tiempoRetiroVacuna'] = "";
        $jTableResult['obervacionesVacunacion'] = "";
        $jTableResult['veterinarioVacunacion'] = "";
        $query = $conn -> prepare("SELECT idVacunacion, 
        fechaVacunacion, 
        nombreVacuna, 
        laboratorioVacuna, 
        numeroLoteVacuna, 
        registroIcaVacuna, 
        dosificacionVacuna, 
        viaAdministracionVacuna, 
        tiempoRetiroVacuna, 
        obervacionesVacunacion, 
        veterinarioVacunacion 
        FROM vacunacion 
        WHERE idVacunacion =?");
        $query -> bind_param('i', $_POST['idVacunacionUp']);
        if($query->execute()){
            $resultado = $query -> get_result();
            while($registro = $resultado->fetch_assoc()){
                $jTableResult['fechaVacunacion'] = $registro['fechaVacunacion'];
                $jTableResult['nombreVacuna'] = $registro['nombreVacuna'];
                $jTableResult['laboratorioVacuna'] = $registro['laboratorioVacuna'];
                $jTableResult['numeroLoteVacuna'] = $registro['numeroLoteVacuna'];
                $jTableResult['registroIcaVacuna'] = $registro['registroIcaVacuna'];
                $jTableResult['dosificacionVacuna'] = $registro['dosificacionVacuna'];
                $jTableResult['viaAdministracionVacuna'] = $registro['viaAdministracionVacuna'];
                $jTableResult['tiempoRetiroVacuna'] = $registro['tiempoRetiroVacuna'];
                $jTableResult['obervacionesVacunacion'] = $registro['obervacionesVacunacion'];
                $jTableResult['veterinarioVacunacion'] = $registro['veterinarioVacunacion']; 
            }
        }else{
            $jTableResult['msj'] = "NO SE EJECUTO LA CONSULTA";
            $jTableResult['resultd'] = "0";
        }
        print json_encode($jTableResult);
    break;
    ////////////////////////////VACUNAS//////////////////////////////////
    case 'guardarVacuna':
        $jTableResult = array();
        $jTableResult['msj']="";
        $jTableResult['resultd']="";
        if($_POST['nombreVacuna']==""){
            $jTableResult['msj'] = "TIENES CAMPOS OBLIGATORIOS POR LLENAR";
            $jTableResult['resultd'] = "0";
        }else{
            $query = $conn -> prepare("INSERT INTO vacunas 
            (fechaRegistroVacuna, 
            nombreVacuna, 
            observacionVacuna) 
            VALUES(?, ?, ?)");
            $query -> bind_param('sss', 
            $_POST['fechaVacuna'],$_POST['nombreVacuna'],$_POST['observacionVacuna']);
            if($query -> execute()){
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
    case 'updateVacuna':
        $jTableResult = array();
        $jTableResult['msj']="";
        $jTableResult['resultd']="";
        $query = $conn -> prepare("UPDATE vacunas SET
        fechaRegistroVacuna=?, 
        nombreVacuna=?, 
        observacionVacuna=? WHERE idVacuna=?");
        $query -> bind_param('sssi', 
        $_POST['fechaVacunaUpd'],$_POST['nombreVacunaUpdate'],$_POST['observacionVacunasUpdate'], $_POST['idVacunaUpdate']);
        if($query -> execute()){
            mysqli_commit($conn);
            $jTableResult['msj'] ="DATO ACTUALIZADO CORRECTAMENTE";
            $jTableResult['resultd'] = "1"; 
        }else{
            mysqli_rollback($conn); 
		    $jTableResult['msj'] ="ERROR AL ACTUALIZADO. INTENTE NUEVAMENTE.";
		    $jTableResult['resultd'] = "0";
        }
        print json_encode($jTableResult);
    break;
    case 'cardVacunas':
        $jTableResult = array();
        $jTableResult['tabsVacunas'] = "";
        $jTableResult['numeroFilas'] = "";
        $query = "SELECT idVacuna, fechaRegistroVacuna, nombreVacuna, observacionVacuna FROM vacunas ORDER BY fechaRegistroVacuna desc;";
        $resultado = mysqli_query($conn, $query);
        $numero = mysqli_num_rows($resultado);
        $jTableResult['numeroFilas'] = $numero;
        $jTableResult['tabsVacunas'] .= "<div class='card'>
                            <div class='card-header' style='background-color:$varCabeceraTabla; color: white;'>
                                <h5 class='card-title'>LISTA DE VACUNAS</h5>
                                <div class='d-flex justify-content-end align-items-center'>   
                                    <p>total: <strong>$numero</strong></p>
                                </div>
                            </div>
                            <div class='card-body' style='max-height: 400px; overflow-y: auto;'>";
        if($numero > 0) {
            while($registro = mysqli_fetch_array($resultado)) { 
                $jTableResult['tabsVacunas'] .= "<div class='card mb-10'>
                                                    <div class='card-body'>
                                                        <div class='row'>
                                                            <div class='col-sm-3' >
                                                                <h6 class='modal-title font-weight-bold'>Fecha: </h6>
                                                            </div>	
                                                            <div class='col-sm-4'>
                                                                <h6 class='modal-title'>".$registro['fechaRegistroVacuna']."</h6>
                                                            </div>
                                                            <div class='col-sm-5 d-flex justify-content-end align-items-center'>
                                                                <button class='btn' id='btnEliminarCardVacuna' data-idVacuna='".$registro['idVacuna']."' data-tipo='3' style='background-color: red; color: #fff; margin-right: 0.5rem;'><i class='fa-solid fa-trash'></i></button>
                                                                <button class='btn' id='btnActualizarCardVacuna' data-idVacunaUpdate='".$registro['idVacuna']."' data-tipo-update='3' data-toggle='modal' data-target='#updateVacunas' style='background-color: #FFC300; color: black;'><i class='fa-solid fa-pen-to-square'></i></button>
                                                            </div>                                                    
                                                        </div> 
                                                        <div class='row'>
                                                            <div class='col-sm-3' >
                                                                <h6 class='modal-title font-weight-bold'>Vacuna: </h6>
                                                            </div>												
                                                            <div class='col-sm-8' margin-bottom: 5rem;>
                                                                <h6 class='modal-title '>".$registro['nombreVacuna']."</h6>
                                                                
                                                            </div>
                                                        </div>	    
                                                        <div class='row'>
                                                            <div class='col-sm-4' >
                                                                <h6 class='modal-title font-weight-bold'>Obervaciones: </h6>
                                                            </div>												
                                                            <div class='col-sm-8' margin-bottom: 5rem;>
                                                                <h6 class='modal-title '>".$registro['observacionVacuna']."</h6>
                                                            </div>
                                                        </div>	                   
                                                    </div>
                                                </div>";
            }
        } else {
            $jTableResult['tabsVacunas'] .= "<div class='card mb-10'>
                                                <div class='card-body'>
                                                    <center><h6>NO SE ENCONTRARON RESULTADOS</h6></center>                
                                                </div>
                                            </div>";
        }
        $jTableResult['tabsVacunas'] .= "    </div>
                                        </div>";
        print json_encode($jTableResult);
    break;
    case 'EliminarVacuna';
        $jTableResult = array();
        $jTableResult['msj'] = "";
        $jTableResult['resultd'] = "";
        $query = $conn -> prepare("DELETE FROM vacunas WHERE idVacuna=?");
        $query -> bind_param('i', $_POST['idVacunaDelete']);
        if($query -> execute()){
            mysqli_commit($conn);
            $jTableResult['msj'] = "DATO ELIMINADO CORRECTAMENTE";
            $jTableResult['resultd'] = "1";
        }else{
            mysqli_rollback($conn);
            $jTableResult['msj'] = "ERROR AL ELIMINAR. INTENTE NUEVAMENTE.";
            $jTableResult['resultd'] = "0";
        }
        print json_encode($jTableResult);
    break;
    case 'rellanarVacuna':
        $jTableResult = array();
        $jTableResult['msj'] = "";
        $jTableResult['resultd'] = "";
        $jTableResult['fechaRegistroVacuna'] = "";
        $jTableResult['nombreVacuna'] = "";
        $jTableResult['observacionVacuna'] = "";
        $query = $conn -> prepare("SELECT idVacuna, 
        fechaRegistroVacuna, 
        nombreVacuna, 
        observacionVacuna
        FROM vacunas
        WHERE idVacuna =?");
        $query -> bind_param('i', $_POST['idVacunaRellenar']);
        if($query->execute()){
            $resultado = $query -> get_result();
            while($registro = $resultado->fetch_assoc()){
                $jTableResult['fechaRegistroVacuna'] = $registro['fechaRegistroVacuna'];
                $jTableResult['nombreVacuna'] = $registro['nombreVacuna'];
                $jTableResult['observacionVacuna'] = $registro['observacionVacuna'];
            }
        }else{
            $jTableResult['msj'] = "NO SE EJECUTO LA CONSULTA";
            $jTableResult['resultd'] = "0";
        }
        print json_encode($jTableResult);
    break;
}
mysqli_close($conn);
?>