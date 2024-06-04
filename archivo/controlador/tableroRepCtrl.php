<?php
include('../../include/conex.php');
$conn=conectarse();
date_default_timezone_set('America/Bogota');
$varDateHoy = date("Y/M/D h:m");
$horaTime = date("H:i:s");
switch ($_REQUEST['action']) {

    case'cargarTableroReproduccion':
        echo "mostrar info tablero";
    break;
}


?>