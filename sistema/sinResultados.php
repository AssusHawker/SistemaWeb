<?php
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include "includes/scripts.php"; ?>
		<!-- Titulo de la web -->
		<title>Sistema WEB </title>
</head>

<body>
	<?php include "includes/header.php"; ?>

    <!-- inicio del codigo -->
   
<div  style="background-color: #4CC2C2;">

<span ><h2 style="color: white;" >No se encontro lo que buscabas</h2></span>

<img src="img/error.jpg" alt="" srcset="">
<button class="btn btn-primary" onclick="location.href='index.php'"> Volver</button>
</div>








	<?php

	include "includes/footer.php";
	include "includes/sesiones.php";
	?>

</body>

</html>