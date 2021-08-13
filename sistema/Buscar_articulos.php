<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "includes/scripts.php"; ?>
	<title>Busqueda general de articulos</title>
</head>

<body>
	<?php include "includes/header.php"; ?>

	<h1 class="row justify-content-center align-items-center m-3 p-3 ">Busqueda general de articulos</h1>

	<br>
	<div class="row justify-content-center align-items-center" style="display: block;margin:auto;">
		<form action="buscar_articulo_res.php" method="get" autocomplete="off">
			<div class="input-group shadow">
				<div class="input-group-prepend">
					<div class="input-group-text w-100">
						<input type="text" required name="busqueda" id="busqueda" placeholder="Buscar" class="form-control" autofocus>

						<div class="input-group">
							<select required name="Xbusqueda" class="form-control" id="Xbusqueda">
								<option value="Xsap">Por SAP</option>
								<option value="Xdescripcion">Por Descripcion</option>

							</select>
							<div class="input-group-append">
								<input type="submit" value="Buscar" class="btn btn-success">
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div style="height: 400px;">


	</div>

	<?php
	include "includes/footer.php";
	include "includes/sesiones.php";
	?>

</body>

</html>