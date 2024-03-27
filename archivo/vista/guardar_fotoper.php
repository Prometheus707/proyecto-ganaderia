
<?php
include('../../include/conex.php');
$conn=Conectarse();
if(isset($_POST['foto'])) {
    $fotoData = $_POST['foto'];
    $fotoData = str_replace('data:image/png;base64,', '', $fotoData);
    $fotoData = str_replace(' ', '+', $fotoData);
    $fotoBinary = base64_decode($fotoData);

    $rutaGuardar = 'fotosnovedades/';
    $nombreFoto = uniqid() . '.png';
    $rutaCompleta = $rutaGuardar . $nombreFoto;
    
    if(file_put_contents($rutaCompleta, $fotoBinary)) {
        echo "La foto se ha guardado correctamente en: $rutaCompleta";
    } else {
        echo "Error al guardar la foto.";
    }
} else {
    echo "No se recibió ninguna foto para guardar.";
} 

?>

<?php


    // $idAnimalFoto = 2;
    
    			

     $query="INSERT INTO fotoanimal (guardarFotoAnimal) VALUES ('$rutaCompleta');";
     if($result= mysqli_query($conn,$query))
         { 
             mysqli_commit($conn);
             echo "DATO GUARDADO CORRECTAMENTE.";
        
         }
     else
         {
             mysqli_rollback($conn);
             echo "ERROR AL GUARDAR. INTENTE NUEVAMENTE.";				
            
         }


?>

