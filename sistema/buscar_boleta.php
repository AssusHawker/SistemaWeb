<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "includes/scripts.php"; ?>
	<title>Busqueda en Techo</title>
</head>

<body>
	<?php include "includes/header.php"; ?>

	<h2 class="row justify-content-center align-items-center">Busqueda y borrado de Boc</h2>
	
	<hr>
	<div class="row justify-content-center align-items-center">
	<form action="buscar_boleta2.php" method="get" autocomplete="off">
		<div class="input-group p-2 m-2">
			<div class="input-group-prepend">
				<div class="input-group-text rounded shadow bg-light">
					<input type="number" required name="busqueda" id="busqueda" placeholder="N° de Boleta" class="form-control" autofocus>

					<div class="input-group">

						<div class="input-group-append">
							<input type="submit" value="Buscar" class="btn btn-success m-2">
						</div>
					</div>
				</div>

			</div>
			
		</div>
	</form>
	</div>

	


	<?php
	include "includes/footer.php";
	include "includes/sesiones.php";
	?>
</body>

</html>