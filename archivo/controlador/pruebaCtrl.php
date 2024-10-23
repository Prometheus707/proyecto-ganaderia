<?php
header('Cache-Control: no-cache, must-revalidate');
include('../../include/parametros_index.php');
date_default_timezone_set('America/Bogota');
include('../../include/conex.php');
session_start();
$conn=Conectarse();
switch ($_REQUEST['action']) 
	{
        case 'EvaluarCrecimientoGeneral':
            
        break;
    }
mysqli_close($conn);
?> 


