<?php
session_start();
include "conexion.php";
//
if (!empty($_GET)) {
	$sap_articulo = $_GET['sap'];
	$barra = $_GET['barra'];



	$query_delete = mysqli_query($link, "DELETE FROM articulos WHERE sap_articulo = $sap_articulo ");
	//validamos si el query se ejecuta
	if ($query_delete) {
		echo "Registro eliminado Correctamente";
	} else {

		echo "Error al eliminar";
	}
}


if (empty($_REQUEST['id'])) {
	header("location: Buscar_articulos.php");
} else {

	$sap_articulo = $_REQUEST['id'];
	$query = mysqli_query($link, "SELECT `sap_articulo`,`descr_articulo` 
							FROM `articulos`
							 WHERE `sap_articulo` = '$sap_articulo'");

	$result = mysqli_num_rows($query);
	if ($result > 0) {
		while ($data = mysqli_fetch_array($query)) {
			$sap_articulo = $data['sap_articulo'];
			$descripcion = $data['descr_articulo'];
		}
	} else {
		header("location: Buscar_articulos.php");
	}
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Eliminar Articulo</title>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>Esta seguro de eliminar el sigiente registro?</h2>
			<p>SAP: <span><?php echo $sap_articulo; ?> </span> </p>
			<p>Descripcion: <span><?php echo $descripcion; ?> </span> </p>

			<img height="500" width="500" src=<?php echo "https://media.easy.com.ar/is/image/EasyArg/" . $sap_articulo; ?> alt="<?php $descripcion; ?>">
			<form method="POST" action="">
				<input type="hidden" name="sap_articulo" value="<?php echo $sap_articulo; ?>">
				<a href="buscar_articulos.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">



			</form>

		</div>


	</section>
	<?php
	include "includes/sesiones.php";
	?>
</body>

</html>