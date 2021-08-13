<?php
session_start();

include "conexion.php";

if (!empty($_POST)) {
	$alert = '';
	if (empty($_POST['sap']) || empty($_POST['ean']) || empty($_POST['descripcion'])) {
		$alert = '<p class="btn btn-warning">Todos los campos son obligatorios.</p>';
	} else {

		$ean13 = strlen($_POST['ean']);
		if ($ean13 == 13) {
			$sap = $_POST['sap'];
			$ean = $_POST['ean'];
			$descripcion  = $_POST['descripcion'];



			///COMPRUEBO NUMERO SAP
			$query = mysqli_query($link, "SELECT * FROM articulos WHERE sap_articulo = '$sap'");
			$result = mysqli_fetch_array($query);
			if ($result > 0) {
				$alert = '<p class="btn btn-danger">El numero de Sap ya existe.</p>';
			} else {
				//COMPRUEBO EAN
				$query1 = mysqli_query($link, "SELECT * FROM cod_barras WHERE cod_barra = '$ean'");
				$result1 = mysqli_fetch_array($query1);
				if ($result1 > 0) {
					$alert = '<p class="btn btn-danger">El Codigo de barras ya existe.</p>';
				} else {

					/////
					$query_insert = mysqli_query($link, "INSERT INTO `articulos`(`sap_articulo`, `descr_articulo`)
                                                     VALUES ('$sap','$descripcion');");

					if ($query_insert) {

						$query_insert1 = mysqli_query($link, "INSERT INTO `cod_barras`(`barra_sap`, `cod_barra`)
                                                     VALUES ('$sap','$ean');");
						if ($query_insert1) {
							$alert = '<p class="btn btn-success">Articulo creado correctamente.</p>';
						} else {
							$alert = '<p class="btn btn-danger">Error al cargar Articulo.</p>';
						}
					} else {
						$alert = '<p class="btn btn-danger">Error al cargar el numero Articulo.</p>';
					}



					////
				}
			}
		} else {
			$alert = '<p class="btn btn-danger">Error el codigo EAN debe tener 13 caracteres.</p>';
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Cargar Articulos</title>
</head>

<body>
	<?php include "includes/header.php"; ?>



	<h1 class="row justify-content-center align-items-center mt-2">Cargar Articulos</h1>
	<hr>

	<div class="row justify-content-center align-items-center m-3 p-2" style="width: 50%; ">


		<form action="" method="post" autocomplete="off">
			<div class="p-3"><?php echo isset($alert) ? $alert : ''; ?></div>

			<label for="Sap">Sap</label>
			<input type="number" name="sap" id="sap" placeholder="Sap" class="form-control" autofocus require>
			<label for="barra" class="mt-3">Codigo de Barras</label>
			<input type="number" name="ean" id="ean" placeholder="Codigo de barras" class="form-control" autofocus require>
			<label for="descripcion" class="mt-1">Descripcion</label>
			<textarea name="descripcion" id="descripcion" placeholder="Descripcion" class="form-control"></textarea>
			<p class="bg-warning mt-2">Para la descripcion por favor copiarla de la web oficial haciendo click aca -->> <a href="http://www.easy.com.ar" target="_blank">EASY</a></p>
			<br>
			<input type="submit" value="Cargar Articulo" class="btn btn-success">


		</form>
	</div>





	<?php
	include "includes/footer.php";

	?>
	<script>
		//Funcion para pasar el foco al dar enter 

		///
		$("body").on("keydown", "input, select, textarea", function(e) {
			var self = $(this),
				form = self.parents("form:eq(0)"),
				focusable,
				next;

			// si presiono el enter
			if (e.keyCode == 13) {
				// busco el siguiente elemento
				focusable = form.find("input,a,select,button,textarea").filter(":visible");
				next = focusable.eq(focusable.index(this) + 1);

				// si existe siguiente elemento, hago foco
				if (next.length) {
					next.focus();
				} else {
					// si no existe otro elemento, hago submit

					form.submit();
				}
				return false;
			}
		});
	</script>
</body>

</html>