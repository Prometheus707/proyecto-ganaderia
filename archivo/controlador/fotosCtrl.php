<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imagenes = array(); // ALMACENAMIENTO DE LAS IMAGENES
    $data = $_POST['image'];
    
    $data = str_replace('data:image/png;base64,', '', $data);
    $data = str_replace(' ', '+', $data);
    $imageData = base64_decode($data);
    
    $tempDir = 'temp_images/';
    if (!file_exists($tempDir)) {
        mkdir($tempDir, 0777, true);
    }
    
    $fileName = $tempDir . uniqid() . '.png';

    
    if (file_put_contents($fileName, $imageData) !== false) {
        echo json_encode(array('success' => true, 'url' => $fileName));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error al guardar la imagen.'));
    }
     // Iterar la carpeta temporal y agregar los datos binarios de las imágenes a la lista
    $files = glob($tempDir . '*.png');
    $count = count($files);
    echo "Número de imágenes en la carpeta temporal: " . $count;
    foreach ($files as $file) {
        $imageData = file_get_contents($file);
        $imagenes[] = $imageData;
    }
    echo "<h2>Lista de imágenes:</h2>";
    echo "<pre>";
    print_r($imagenes);
    echo "</pre>";

} else {
    echo json_encode(array('success' => false, 'message' => 'Método no permitido.'));
}


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $data = $_POST['image'];
//     $data = str_replace('data:image/png;base64,', '', $data);
//     $data = str_replace(' ', '+', $data);
//     $imageData = base64_decode($data);
    
//     $fileName = 'images/' . uniqid() . '.png';
    
//     if (file_put_contents($fileName, $imageData) !== false) {
//         echo 'Imagen guardada correctamente.';
//     } else {
//         echo 'Error al guardar la imagen.';
//     }
// } else {
//     echo 'Método no permitido.';
// }
?>
