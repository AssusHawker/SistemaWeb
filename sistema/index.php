<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include "includes/scripts.php"; ?>
	<!-- Titulo de la web -->
	<title>Buscar</title>

</head>

<body>
	<?php include "includes/header.php"; ?>
	

	<br>



	<div class="row justify-content-center align-items-center" style="height: 100px;">
	<div class="bg-light border rounded shadow col-5 justify-content-center align-items-center ">
		<form action="buscarBoc.php" method="get" autocomplete="off" class="form-inline">
		<h3 class="p-1 m-1 col-md-12">Buscar boc</h3>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text bg-light p-3 m-3 rounded shadow">
						<input type="text" required name="busqueda" id="busqueda" placeholder="Buscar" class="form-control m-2" autofocus>

						<div class="input-group ml-2">
							<select required name="Xbusqueda" class="form-control" id="Xbusqueda" style="width: 200px;">
								<option value="XNboleta">Por Boc</option>

								<option value="1">Por Ubicacion</option>

							</select>
						</div>
						<div class="input-group-append">
							<input type="submit" value="Buscar" class="btn btn-success m-2">
						</div>
					</div>

				</div>
			</div>
		</form>
	</div>
	</div>
	

	<div class="row justify-content-center align-items-center mt-5">
		<!-- dejo el bloque con Hidden y lo muestro con JS -->
		<div id="hidden_div" style="display: none; height: 150px;" class="bg-light border rounded shadow col-5 justify-content-center align-items-center mt-5">

			<form action="buscar-ubicacion.php" method="get" autocomplete="off" class="form-inline">
				<h3 class="p-1 m-1 col-md-12">Buscar por ubicacion</h3>
				<div class="row bg-light col-12" style="display: flex; justify-content: center;" >
					<div class="col-4">

						<select name="pasillo" class="form-control" required>
							<?php
							include "conexion.php";
							echo "<option value=''>" . 'Pasillo' . "</option>";
							$sql = mysqli_query($link, "SELECT NombrePasillo FROM pasillos");
							while ($row = $sql->fetch_assoc()) {
								echo "<option>" . $row['NombrePasillo'] . "</option>";
							}
							mysqli_close($link);
							?>
						</select>

					</div>

					<div class="col-4">
						<select name="metro" class="form-control">
							<?php
							include "conexion.php";
							echo "<option value=''>" . 'Metro' . "</option>";
							$sql = mysqli_query($link, "SELECT NombreMetro FROM metro");
							while ($row = $sql->fetch_assoc()) {
								echo "<option>" . $row['NombreMetro'] . "</option>";
							}
							mysqli_close($link);
							?>
						</select>
					</div>

					<div class="col-4">
						<select name="ubicacion" class="form-control">
							<?php
							include "conexion.php";
							echo "<option value=''>" . 'Ubicacion' . "</option>";
							$sql = mysqli_query($link, "SELECT NombreUbicacion FROM ubicacionletra");
							while ($row = $sql->fetch_assoc()) {
								echo "<option>" . $row['NombreUbicacion'] . "</option>";
							}
							mysqli_close($link);
							?>
						</select>
					</div>
				</div>
				<div class="form-group form-check">

					<input type="checkbox" class="form-check-input" id="detalle" name="detalle" value="1">
					<label class="form-check-label" for="detalle">Busqueda Detallada</label>


					<input type="submit" value="Buscar" class="btn btn-success m-2">
				</div>

			</form>
		</div>
		<br>
	</div>
	<script>
		document.getElementById('Xbusqueda').addEventListener('change', function() {
			var style = this.value == 1 ? 'block' : 'none';
			document.getElementById('hidden_div').style.display = style;
		});
	</script>


	</div>


	<?php
	require_once "includes/footer.php";
	require_once "includes/sesiones.php";
	?>

</body>

</html>