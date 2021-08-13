<?php

session_start();

include "conexion.php";

if ($_GET) {
	 
	$pasillo = mysqli_real_escape_string ($link,$_GET['pasillo']);
	$metro = mysqli_real_escape_string ($link,$_GET['metro']);
	$ubicacion = mysqli_real_escape_string ($link,$_GET['ubicacion']);
	$comentarios = mysqli_real_escape_string ($link,$_GET['comentarios']);
	$boc = mysqli_real_escape_string ($link,$_GET['boc']);

	
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

	<?php
	
	$sql_update = mysqli_query($link,"UPDATE boletas
	SET pasillo = '$pasillo',
	    metro = '$metro',
		letra = '$ubicacion',
		comentarios = '$comentarios'
	
	WHERE  boc = $boc



");

if ($sql_update) {
	$alert = '<p class="alert-success">Registro Actualizado Correctamente.</p>';
	echo $alert;
} else {
	$alert = '<p class="alert-warning">Error al Actualizar el registro.</p>';
	echo $alert;
}

	
?>
	








	<?php

    include "includes/footer.php";
    include "includes/sesiones.php"; ?>

</body>

</html>

<?php
} ?>