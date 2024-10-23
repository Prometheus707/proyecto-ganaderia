<?php
include("../include/conex.php");
$conn=Conectarse();
date_default_timezone_set("America/Bogota");
$dateFile = date('Y-m-d'); 

$imagenCodificada = file_get_contents("php://input");//Obtener la imagen
if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
//La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
$imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));

//Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
//todo el contenido lo guardamos en un archivo
$imagenDecodificada = base64_decode($imagenCodificadaLimpia);

//Calcular un nombre único
$nombreFoto = uniqid() . ".png";
$nombreImagenGuardada = "../files/fotos/" .$nombreFoto;


//Escribir el archivo
//file_put_contents($nombreImagenGuardada, $imagenDecodificada);
// Escribir el archivo
// Escribir el archivo
if (file_put_contents($nombreImagenGuardada, $imagenDecodificada) === FALSE) {
    exit("Error al guardar la imagen en la ruta: " . $nombreImagenGuardada);
}

// Comprobar la conexión a la base de datos antes de ejecutar la consulta
if ($conn->connect_error) {
    exit("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Insertar datos en la base de datos
$queryInsert = "INSERT INTO archivos (nameFile, dateFile) VALUES ('$nombreFoto','$dateFile')";
$resultInsert = mysqli_query($conn, $queryInsert);

// Comprobar si la consulta se ejecutó correctamente
if ($resultInsert) {
    echo "Imagen guardada y datos insertados correctamente: " . $nombreFoto;
} else {
    echo "Error al insertar en la base de datos: " . mysqli_error($conn);
}

//Terminar y regresar el nombre de la foto
exit($nombreFoto);
?>