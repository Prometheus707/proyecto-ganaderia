<?php
header('Cache-Control: no-cache, must-revalidate');
include('../../include/parametros_index.php');
date_default_timezone_set('America/Bogota');
include('../../include/conex.php');
require('../dompdf/vendor/autoload.php');
use Dompdf\Dompdf;
session_start();
$conn = Conectarse();
$horaTime = date("H:i:s");
$dompdf = new Dompdf();

switch ($_REQUEST['action']) {
    case 'generarPdf':
        // Consulta a la base de datos
        $query = $conn -> prepare("SELECT nombreAnimal, colorAnimal FROM animales WHERE idAnimal =?;");
        $query -> bind_param('i',$_POST['idAnimaPdf']);
        if($query -> execute()){
            $resultado = $query -> get_result();
            if($registro = $resultado->fetch_assoc()){
                $imagePath = realpath('../../files/fotos/animal_1724456090.jpg');
                $imageData = base64_encode(file_get_contents($imagePath));
                $src = 'data:image/png;base64,' . $imageData;
                        $html = '
                    <!doctype html>
                    <html lang="es">
                    <head>
                        <title>Documento de Identidad del Animal</title>
                        <meta charset="utf-8" />
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
                        <style>
                            .animal-id-card {
                                border: 1px solid #ccc;
                                padding: 20px;
                                width: 500px;
                                margin: auto;
                                border-radius: 10px;
                                color: white;
                                font-family: Arial, sans-serif;
                                 box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
                            }
                            .header {
                               
                                text-align: center;
                                padding: 10px;
                                border-radius: 10px 10px 0 0;
                                color: black;
                            }
                            .content {
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                                padding: 20px;
                                background: white;
                                color: black;
                                border-radius: 0 0 10px 10px;
                            }
                            .image-container {
                                flex: 1;
                                text-align: center;
                                max-width: 150px; /* Ajusta el tamaño máximo del contenedor de la imagen */
                            }
                            .image-container img {
                                max-width: 100%;
                                height: auto;
                                border-radius: 10px;
                            }
                            .animal-info {
                                flex: 2;
                                padding-left: 20px;
                            }
                            .info-label {
                                font-weight: bold;
                            }
                            .info-value {
                                margin-bottom: 10px;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="animal-id-card">
                                <div  iv class="header">
                                SENA REGIONAL CAUCA-<br>
                                CENTRO AGROPECUARIO<br>
                                <small>DOCUMENTO DE IDENTIDAD</small>
                            </div>
                            <div class="content">
                                <div class="image-container">
                                    <img src="'.$src.'" alt="Foto del animal">
                                </div>
                                <div class="animal-info">
                                    <div class="info-label">Número</div>
                                    <div class="info-value">123456789098765</div>
                                    <div class="info-label">Nombre</div>
                                    <div class="info-value">MILO</div>
                                    <div class="info-label">Especie</div>
                                    <div class="info-value">PERRO</div>
                                    <div class="info-label">Raza</div>
                                    <div class="info-value">CRIOLO</div>
                                    <div class="info-label">Sexo</div>
                                    <div class="info-value">MACHO</div>
                                    <div class="info-label">Particularidad</div>
                                    <div class="info-value">RASGOS DE PERRO SIBERIANO</div>
                                      <div class="info-label">Número</div>
                                    <div class="info-value">123456789098765</div>
                                    <div class="info-label">Nombre</div>
                                    <div class="info-value">MILO</div>
                                    <div class="info-label">Especie</div>
                                    <div class="info-value">PERRO</div>
                                    <div class="info-label">Raza</div>
                                    <div class="info-value">CRIOLO</div>
                                    <div class="info-label">Sexo</div>
                                    <div class="info-value">MACHO</div>
                                    <div class="info-label">Particularidad</div>
                                    <div class="info-value">RASGOS DE PERRO SIBERIANO</div>
                                </div>
                               
                            </div>
                        </div>
                    </body>
                            </html>
                            ';
                        
                // Generar el PDF
                    // Generar el PDF
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();

                // Enviar el PDF al navegador
                header('Content-Type: application/pdf');
            echo $dompdf->output();

                
            }
        }
      
        break;
}
?>
