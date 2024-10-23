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
            ///////CONSULTA PARA TRAER LA INFROMACION DEL ANIMAL///////
            $query = $conn -> prepare("SELECT nombreAnimal, codAnimal,  colorAnimal, fechaRegistro,  fechaNacimiento, especiesmnrs.nombreEspecie AS nombreEspecie, raza.nombreRaza AS nombreRaza, idSexo 
                                        FROM animales 
                                        INNER JOIN especiesmnrs ON  animales.idEspecie_FK = especiesmnrs.idEspecie 
                                        INNER JOIN raza ON animales.idRaza_FK = raza.idRaza
                                        WHERE idAnimal=?;");
            $query -> bind_param('i',$_POST['idAnimaPdf']);
            if($query -> execute()){
                $resultado = $query -> get_result();
                if($registro = $resultado -> fetch_assoc()){
                    ///////////CONSULTA PARA TRAER LA DIRECCION DE LA FOTO////////
                    $queryPhoto = $conn -> prepare("SELECT file_name FROM photos WHERE idAnimalPhoto =? AND is_main = 1"); 
                    $queryPhoto -> bind_param('i',$_POST['idAnimaPdf']);
                    $queryPhoto -> execute();
                    $result = $queryPhoto -> get_result();
                    $numeroPhotos = $result -> num_rows;
                    $row = $result -> fetch_assoc();
                    $fotoAnimPdf = $row['file_name'];
                    if($numeroPhotos > 0){//Si la foto existe en base de edatos
                        $imagePath = realpath('../../files/fotos/'.$fotoAnimPdf);
                    }else{
                        $imagePath = realpath('../../files/fotos/defaultPerfilAnimal.png');
                    }
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $src = 'data:image/png;base64,' . $imageData;
                    $imageSenaPath = realpath('../../imagenes/logoGeernSena.png');
                    $imageDataSena = base64_encode(file_get_contents($imageSenaPath));
                    $srcSena = 'data:image/png;base64,' . $imageDataSena;
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
                                            width: 500px;
                                            margin: auto;
                                            border-radius: 10px;
                                            color: white;
                                            font-family: Arial, sans-serif;
                                        }
                                        .header {
                                            text-align: center;
                                            padding: 10px;
                                            border-radius: 10px 10px 0 0;
                                            color: #29a900;
                                        }
                                        .content {
                                            padding-left: 20px;
                                            background: white;
                                            color: black;
                                            padding-right: 2rem;
                                        }
                                        .image-container {
                                            width: 100%;
                                            text-align: center;
                                            max-width: 150px; /* Ajusta el tamaño máximo del contenedor de la imagen */  
                                            padding-left: 16rem;
                                            margin-bottom: 1rem;
                                            margin-left: 1rem;
                                            border-bottom: 1px solid #29a900;
                                            position: relative
                                        }
                                        .image-container img {
                                            max-width: 100%;
                                            height: auto;
                                            border-radius: 10px;
                                        }
                                        .animal-info {
                                            display: flex;
                                            flex-direction: row;
                                            flex-wrap: wrap; /* Permite que los elementos se envuelvan a la siguiente línea */
                                            margin-bottom: 1rem;
                                        }
                                        .info-item {
                                            flex: 1 1 45%; /* Ajusta el tamaño de los elementos y permite que se envuelvan */
                                            margin: 5px; /* Espacio entre los elementos */
                                            border-bottom: 1px solid #ccc;
                                            padding-bottom: 5px;
                                            width: 96%;
                                        }
                                        .info-label { 
                                            font-weight: bold; 
                                            font-size: 12px;
                                            color: #29a900;
                                        }
                                        .info-value { 
                                            margin-top: 2px;
                                            font-size: 14px;
                                        }
                                        .img_animal{
                                            margin-bottom: 1rem; 
                                            width: 120px;
                                        }
                                        .img_sena{
                                            width: 80px;
                                            height: auto;
                                            position: absolute;
                                            left: 40px;
                                            top: 10px;
                                        }
                                        .reginal-gray{
                                            color: #29a900;
                                            margin:0;
                                            padding:0;
                                        }
                                    </style>
                                </head>
                                <body>
                                    <div class="animal-id-card">
                                        <div class="header">
                                            <strong><p class="reginal-gray">Regional Cauca </p>Centro Agropecuario</strong><br>
                                            <small >Documento De Identidad Animal</small>
                                        </div>
                                        <div class="content"> 
                                            <div class="image-container">
                                                <img class="img_sena" src="'.$srcSena.'" alt="Foto Sena">
                                                <img class="img_animal" src="'.$src.'" alt="Foto del animal">
                                            </div>
                                            <div class="animal-info">
                                                <div class="info-item">
                                                    <div class="info-label">Nombre</div>
                                                    <div class="info-value">'.$registro['nombreAnimal'].'</div>
                                                </div>
                                                <div class="info-item">
                                                    <div class="info-label">Codigo</div>
                                                    <div class="info-value">'.$registro['codAnimal'].'</div>
                                                </div>
                                                <div class="info-item">
                                                    <div class="info-label">Color</div>
                                                    <div class="info-value">'.$registro['colorAnimal'].'</div>
                                                </div>
                                                <div class="info-item">
                                                    <div class="info-label">Fecha Registro</div>
                                                    <div class="info-value">'.$registro['fechaRegistro'].'</div>
                                                </div>
                                                <div class="info-item">
                                                    <div class="info-label">Fecha Nacimiento</div>
                                                    <div class="info-value">'.$registro['fechaNacimiento'].'</div>
                                                </div>
                                                <div class="info-item">
                                                    <div class="info-label">especie</div>
                                                    <div class="info-value">'.$registro['nombreEspecie'].'</div>
                                                </div>
                                                <div class="info-item">
                                                    <div class="info-label">Raza</div>
                                                    <div class="info-value">'.$registro['nombreRaza'].'</div>
                                                </div>
                                                <div class="info-item">
                                                    <div class="info-label">Sexo</div>
                                                    <div class="info-value">'.(($registro['idSexo'])==1 ? 'Macho' : 'Hembra').'</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </body>
                            </html>
                            ';    
                    // Generar el PDF
                    $dompdf->loadHtml($html);
                    $dompdf->setPaper('A4', 'portrait');
                    $dompdf->render();
                    // Enviar el PDF al navegador
                    header('Content-Type: application/pdf');
                    echo $dompdf->output();
                    $query->close();
                }
            }
        break;
    }
    mysqli_close($conn);
?>
 