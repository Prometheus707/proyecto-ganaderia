<?php  /* 	opciones con modal 		https://getbootstrap.esdocu.com/docs/5.1/components/modal/    */
include_once('../../include/config.php');
date_default_timezone_set('America/Bogota');
include_once('../../include/parametros_index.php');
header('Cache-Control: no-cache, must-revalidate');
header('Content-Type: text/html; charset='.$charset);
session_name($session_name);
session_start();
if (isset($_SESSION['id_Usu'])){	
$fecha = date("Y-m-d"); 
$fecha_Banner = date("Y-m-d"); ?>
<html>
	<head>
		<title>RUPS</title>
		<script src='https://kit.fontawesome.com/459929adcc.js' crossorigin='anonymous'></script>
		<?php include('head.php');?>
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<?php include('cabeceraMenu.php');?>
		<?php include('pieMenu.php'); ?>		
	</body>
</html>
<?php  } else {	header("Location: ../../index.php");	}?>