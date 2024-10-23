<?php
header('Cache-Control: no-cache, must-revalidate');
include('../../include/parametros_index.php');
date_default_timezone_set('America/Bogota');
include('../../include/conex.php');
session_start();
$conn = Conectarse();
// include("../../files/fotos"); // Esta línea parece innecesaria, la he comentado

Switch ($_POST['action']) 
{ 
    case 'guardarImagen':
        $jTableResult = array();
        $jTableResult['msj'] = "";
        $jTableResult['resultd'] = "";
        // Obtener los datos de la imagen
        $imageData = $_POST['imagen'];
        // Eliminar el encabezado de la cadena base64
        $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        // Decodificar la imagen
        $imageBinary = base64_decode($imageData);
        // Generar un nombre único para el archivo
        $fileName = 'animal_' . time() . '.jpg';
        // Definir la ruta completa del archivo
        $filePath = '../../files/fotos/' . $fileName;
    
        // Intentar guardar la imagen en el servidor y verifica si se guardo la imagen en la carpeta fotos
        if (file_put_contents($filePath, $imageBinary)) {
            // La imagen se guardó correctamente, ahora guardar en la base de datos
            $sql = "INSERT INTO photos (file_name, file_path, idAnimalPhoto, created_at) VALUES (?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                $jTableResult['msj'] = "Error en la preparación de la consulta: " . $conn->error;
                $jTableResult['resultd'] = "0";
            } else {
                $stmt->bind_param("ssi", $fileName, $filePath, $_POST['idAnimalImg']);
                if ($stmt->execute()) {
                    mysqli_commit($conn);
                    $jTableResult['msj'] = "IMAGEN GUARDADA CORRECTAMENTE";
                    $jTableResult['resultd'] = "1";
                } else {
                    mysqli_rollback($conn);
                    $jTableResult['msj'] = "ERROR AL GUARDAR EN LA BASE DE DATOS. INTENTE NUEVAMENTE.";
                    $jTableResult['resultd'] = "0";
                    // Eliminar la imagen si no se pudo guardar en la base de datos
                    unlink($filePath);
                }
                $stmt->close();
            }
        } else {
            $jTableResult['msj'] = "ERROR AL GUARDAR LA IMAGEN EN EL SERVIDOR. INTENTE NUEVAMENTE.";
            $jTableResult['resultd'] = "0";
        }
    
        echo json_encode($jTableResult);
    break;
    case 'listarImagenesAnimal':
        $sql = "SELECT idPhotoAnimal, file_name, file_path FROM photos WHERE idAnimalPhoto='".$_POST['idAnimalImg']."'";
        $result = $conn->query($sql);
        $jTableResult = array();
        $jTableResult['tarjetasImagenes'] = "";
        $jTableResult['numeroFotosAnimales'] = "";
        $numero = $result->num_rows;
        $jTableResult['numeroFotosAnimales']=$numero;
        $jTableResult['tarjetasImagenes'] .= "<div class='card'>
                                <div class='card-header' style='background-color:#29a900; color: white;'>
                                    <h5 class='card-title'>LISTA DE IMÁGENES</h5>
                                    <div class='d-flex justify-content-end align-items-center'>   
                                        <p>Total: <strong>$numero</strong></p>
                                    </div>
                                </div>
                                <div class='card-body' style='max-height: 400px; overflow-y: auto;'>
                                <div class='row'>";
    
        if ($numero > 0) {
            while($row = $result->fetch_assoc()) {
                $imagen = $row['file_name'];
                $ruta = $row['file_path'];
                $id = $row['idPhotoAnimal'];
                $jTableResult['tarjetasImagenes'] .= "<div class='col-3 mb-3'>
                                                           <div class='card'>
                                                                <div class='card-body p-0' id='contendorImagenAnimal'>
                                                                    <button class='btn btnElimImagen'  id='btnEliminarCardImagen' data-imagen='$id' data-rutaFoto='$imagen' style='background-color: red; color: #fff; position:absolute; top: -12px; right: -12px; z-index: 1; border-radius: 50%;'>
                                                                        <i class='fa-solid fa-x'></i>
                                                                    </button>
                                                                    <img src='$ruta' alt='$imagen' class='img-fluid zoom' style='width: 100%; height: auto; object-fit: contain; border-radius: 5px;'>
                                                                </div>
                                                            </div>
                                                      </div>";
            }
        } else {
            $jTableResult['tarjetasImagenes'] .= "<div class='col-12 mb-3'>
                                                    <div class='card'>
                                                        <div class='card-body'>
                                                            <center><h6>SIN FOTOS (┬┬﹏┬┬)</h6></center>                
                                                        </div>
                                                    </div>
                                                  </div>";
        }
        $jTableResult['tarjetasImagenes'] .= "    </div>
                                            </div>
                                        </div>";
    
        echo json_encode(['success' => true, 'tarjetasImagenes' => $jTableResult['tarjetasImagenes'], 'numeroFotosAnimales' => $jTableResult['numeroFotosAnimales']]);
    break;
    case 'eliminarImagen':
        $jTableResult = array();
        $jTableResult['msj'] ="";
        $jTableResult['resultd'] ="";
        $directorio = '../../files/fotos/';
        $rutaImagen = $directorio . $_POST['imagenRuta'];
        if (file_exists($rutaImagen)) {
           //el archivo existe
            if (is_writable($rutaImagen)) {
               //archivo tiene permisos de escritura
                if (unlink($rutaImagen)) {
                    $query = $conn->prepare("DELETE FROM photos WHERE idPhotoAnimal =?");
                    $query->bind_param("i", $_POST['idImagen']);
                    // Ejecutar consulta preparada
                    if ($query->execute()) {
                        mysqli_commit($conn);
                        $jTableResult['msj'] = "IMAGEN ELIMINADA CORRECTAMENTE";
                        $jTableResult['resultd'] = "1";
                    } else {
                        mysqli_rollback($conn);
                        $jTableResult['msj'] = "ERROR AL ELIMINAR. INTENTE NUEVAMENTE. " . mysqli_error($conn);
                        $jTableResult['resultd'] = "0";
                    }
                    // Cerrar consulta preparada
                    $query->close();
                } else {
                     $jTableResult['msj'] = "ERROR AL ELIMINAR LA IMAGEN DE LA CARPETA";
                    $jTableResult['resultd'] = "1";
                }
            } else {
                $jTableResult['msj'] = "NO SE TIENE PERMISOS DE ESCRITURA PARA ELIMINAR ARCHIVO. ";
                $jTableResult['resultd'] = "0";
            }
        } else {
            $jTableResult['msj'] = "IMAGEN NO EXISTE. ";
            $jTableResult['resultd'] = "0";
        }
        print json_encode($jTableResult);
    break; 
    //////////////////////////////////////////////////////////////////////////////////// 
    ////////////////////////SECCION PARA LA IMAGEN PRINCIPAL///////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
    case 'listImgHistory':
        $sql = "SELECT idPhotoAnimal, file_name, file_path FROM photos WHERE idAnimalPhoto='".$_POST['idFotosH']."'";
        $result = $conn->query($sql);
        $jTableResult = array();
        $jTableResult['imgHistory'] = "";
        $numero = $result->num_rows;
        if ($numero > 0) {
            while($row = $result->fetch_assoc()) {
                $imagen = $row['file_name'];
                $ruta = $row['file_path'];
                $id = $row['idPhotoAnimal'];
                $jTableResult['imgHistory'] .= "<div class='col-6 col-md-4 col-lg-3 col-xl-3 mb-2'>
                                                    <img src='$ruta' alt='$imagen' id='imgHistory' class='img-fluid zoom' data-id-img='$id' style='height: auto; object-fit: contain; border-radius: 5px;'>
                                                </div>
                                                ";
            }
        } else {
            $jTableResult['imgHistory'] .= "<div class='col-12 mb-3'>
                                                <center><h6>SIN FOTOS (┬┬﹏┬┬)</h6></center>
                                            </div>";
        }
        echo json_encode(['success' => true, 'imgHistory' => $jTableResult['imgHistory']]);
    break;
    case 'llenarImgMain':
        $jTableResult = array();
        $jTableResult['idPhotoAnimal'] = "";
        $jTableResult['file_name'] = "";
        $jTableResult['file_path'] = "";
        $jTableResult['sin_img'] = "";
        $query = $conn -> prepare("SELECT idPhotoAnimal, file_name, file_path FROM photos WHERE idAnimalPhoto=? AND is_main ='1';");
        $query -> bind_param('i', $_POST['idAnimalFhistory']);
        $query -> execute();
        $resultado = $query -> get_result();
        $numero = $resultado -> num_rows;
        if($numero > 0){
            while($registro = $resultado -> fetch_assoc()) {
                $jTableResult['idPhotoAnimal'] = $registro['idPhotoAnimal']; 
                $jTableResult['file_name'] = $registro['file_name'];
                $jTableResult['file_path'] = $registro['file_path'];
                $jTableResult['sin_img'] = false;
            }
        }else{
            $jTableResult['sin_img'] = true;
        }
       
        print json_encode($jTableResult); 
    break;
    case 'cambioImagenPrincipal':
        $jTableResult = array();
        $jTableResult['msj'] = "";
        $jTableResult['resultd'] = "";
        $query = $conn->prepare("SELECT idPhotoAnimal FROM photos WHERE idAnimalPhoto =? AND is_main ='1';");
        $query -> bind_param('i', $_POST['idAnimalFhistory']);
        $query -> execute();
        $resultado = $query -> get_result();
        $numero = $resultado -> num_rows;
        //echo "numero de fiolas son ".$numero;
        if($numero > 0){
            $query = $conn->prepare("UPDATE photos SET is_main ='0' WHERE idPhotoAnimal =?;");
            $query -> bind_param('i', $_POST['idImgMain']);
            $query -> execute();
        }
        $query = $conn->prepare("UPDATE photos SET is_main ='1' WHERE idPhotoAnimal =?;");
        $query -> bind_param('i', $_POST['idDataFhistory']);
        $query -> execute();
        if ($query->execute()) {
            mysqli_commit($conn);
            $jTableResult['msj'] = "IMAGEN ACTUALIZADA CON EXITO";
            $jTableResult['resultd'] = "1";
        } else {
            mysqli_rollback($conn);
            $jTableResult['msj'] = "ERROR AL ACTUALIZAR IMAGEN. INTENTE NUEVAMENTE. " . mysqli_error($conn);
            $jTableResult['resultd'] = "0";
        }
        print json_encode($jTableResult);
    break;
}
mysqli_close($conn);
?>