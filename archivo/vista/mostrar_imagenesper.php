<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mostrar Imágenes</title>
</head>
<body>
<h1>Imágenes Guardadas</h1>
<?php
$rutaGuardar = 'fotosnovedades/';
$imagenes = glob($rutaGuardar . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

if (count($imagenes) > 0) {
    foreach ($imagenes as $imagen) {
        echo '<img src="' . $imagen . '" style="max-width: 300px; max-height: 300px; margin: 10px;">';
    }
} else {
    echo 'No hay imágenes para mostrar.';
}
?>
</body>
</html>