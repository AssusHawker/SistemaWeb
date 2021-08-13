<?php
session_start();
$alert = '';
include "conexion.php";
require_once("DBcontroller.php");
$db_handle = new DBController();
$sql = "SELECT * from articulos";
$faq = $db_handle->runQuery($sql);

if (!empty($_POST)) {
	if (empty($_POST['boc']) || empty($_POST['metro']) || empty($_POST['ubicacion']) || empty($_POST['pasillo'])) {
		$alert = '<h5 class="btn btn-danger">Todos los campos son obligatorios.</h5>';
	}
	//cuento la cantidad de items de la matriz
	function vaciarArray($arreglo){

		foreach($arreglo as $key => $link) 
		{ 
			if($link === '') 
			{ 
				unset($arreglo[$key]); 
			} 
		} 
		return $arreglo;
	}
	
	
	
	$sap = vaciarArray($_POST['sap']);
	$cantidad = vaciarArray($_POST['cantidad']);
	$numSap = count($sap);
	$numCantidad = count($cantidad);
	

	$boc = $_POST['boc'];
	$metro = $_POST['metro'];
	$ubicacion = $_POST['ubicacion'];
	$pasillo = $_POST['pasillo'];
	$comentarios = $_POST['comentarios'];
	if ($_SESSION['active'] = true) {
		$legajo = $_SESSION['idUser'];

		//Insertar primer boc
		$query_insert = mysqli_query($link, "INSERT INTO `boletas`(	`boc`, `pasillo`, `metro`, `letra`, `Usuarios_legajo_usuario`,`comentarios`)
						                             VALUES ('$boc','$pasillo','$metro','$ubicacion','$legajo','$comentarios')");


		for ($i = 0; $i < $numSap; $i++) {
			$sap = $i;
			$cantidad = $i;
			$sap = $sap++;
			$cantidad = $cantidad++;
			$sap = $_POST["sap"][$i];
			$cantidad = $_POST["cantidad"][$i];



			//////////////////////////////insertar Articulo 1/////////////
			$query_insert = mysqli_query($link, "INSERT INTO `boletas_descripcion` (`boc`, `Articulos_sap_articulo`, `cantidad_articulos`) 
				VALUES ($boc, '$sap', $cantidad); ");


			if ($query_insert) {
				$alert = '<h5 class="alert alert-dark" role="alert">Registro Guardado.</h5>';
			} else {
				$alert = '<h5 class="alert alert-danger" role="alert">Error al guardar el registro.</h5>';
			}
		}
	}
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include "includes/scripts.php"; ?>
	<!-- Titulo de la web -->
	<title>Sistema WEB</title>
	<?php $estado = 1; ?>
	<script>
		function AgregarMas() {
			$("<div>").load("InputDinamico.php", function() {
				$("#items").append($(this).html());
			});

			//document.getElementById('EstadoSap1').id = 'EstadoSap2';

		}

		function BorrarRegistro() {
			$('div.dinamico').each(function(index, item) {
				jQuery(':checkbox', this).each(function() {
					if ($(this).is(':checked')) {
						$(item).remove();
					}
				});

			});
		}
	</script>



	<script src="js/buscarsap.js"></script>


</head>

<body>

	<?php include "includes/header.php"; ?>
	<!-- inicio del codigo -->
	<div class="container mt-0">


		<div class="row">
			<div class="col mt-4 mb-4">
				<?php echo $alert; ?>


				<form action="" class="form-inline" method="POST" id="form" autocomplete="off">
					<h4>Numero de Boc</h4>
					<div class="row">
						<div class="col-3"><input type="number" onBlur="comprobarBoc()" required class="form-control m-1 p-1" name="boc" id="boc" placeholder="Boc" autofocus></div>
						<div class="col m-0"><span id="EstadoBoc" style="font-size: 23px;"></span></div>
					</div>
					<!-- Form Dinamico -->

					



					<div class="btn-action float-clear">
						<!-- <input class="btn btn-success" type="button" name="agregar_registros" value="Agregar Mas" onClick="AgregarMas();" /> -->
						<!-- <input class="btn btn-danger" type="button" name="borrar_registros" value="Borrar Campos" onClick="BorrarRegistro();" /> -->
						<span class="success"><?php if (isset($resultado)) {
													echo $resultado;
												} ?></span>
					</div>


					<!-- INICIO2-->
					<div class="container p-1">
						<div class="row">

							<div class="col-2"><input type="number" class="form-control" onBlur="comprobarSap2()" name="sap[]" id="sap2" placeholder="Codigo" autofocus>
							</div>
							<div class="col-2 m-0"><input type="number" class="form-control" name="cantidad[]" id="cantidad2" placeholder="Cantidad"></div>

							<div class="col-6 m-0 dinamico"><span id="EstadoSap2" style="font-size: 23px;"></span></div>

						</div>
					</div>

					<!-- FIN -->
					<!-- INICIO3-->
					<div class="container p-1">
						<div class="row">

							<div class="col-2"><input type="number" class="form-control" onBlur="comprobarSap3()" name="sap[]" id="sap3" placeholder="Codigo" autofocus>
							</div>
							<div class="col-2 m-0"><input type="number" class="form-control" name="cantidad[]" id="cantidad3" placeholder="Cantidad"></div>

							<div class="col-6 m-0 dinamico"><span id="EstadoSap3" style="font-size: 23px;"></span></div>

						</div>
					</div>

					<!-- FIN -->
					<!-- INICIO4-->
					<div class="container p-1">
						<div class="row">

							<div class="col-2"><input type="number" class="form-control" onBlur="comprobarSap4()" name="sap[]" id="sap4" placeholder="Codigo" autofocus>
							</div>
							<div class="col-2 m-0"><input type="number" class="form-control" name="cantidad[]" id="cantidad4" placeholder="Cantidad"></div>

							<div class="col-6 m-0 dinamico"><span id="EstadoSap4" style="font-size: 23px;"></span></div>

						</div>
					</div>

					<!-- FIN -->
					<!-- INICIO5-->
					<div class="container p-1">
						<div class="row">

							<div class="col-2"><input type="number" class="form-control" onBlur="comprobarSap5()" name="sap[]" id="sap5" placeholder="Codigo" autofocus>
							</div>
							<div class="col-2 m-0"><input type="number" class="form-control" name="cantidad[]" id="cantidad5" placeholder="Cantidad"></div>

							<div class="col-6 m-0 dinamico"><span id="EstadoSap5" style="font-size: 23px;"></span></div>

						</div>
					</div>

					<!-- FIN -->
					<!-- INICIO6-->
					<div class="container p-1">
						<div class="row">

							<div class="col-2"><input type="number" class="form-control" onBlur="comprobarSap6()" name="sap[]" id="sap6" placeholder="Codigo" autofocus>
							</div>
							<div class="col-2 m-0"><input type="number" class="form-control" name="cantidad[]" id="cantidad6" placeholder="Cantidad"></div>

							<div class="col-6 m-0 dinamico"><span id="EstadoSap6" style="font-size: 23px;"></span></div>

						</div>
					</div>

					<!-- FIN -->

				

					<div id="items">
						<?php require_once("InputDinamico.php") ?>
					</div>


					<input class="btn btn-success m-2" type="button" name="agregar_registros" value="Agregar Mas" onClick="AgregarMas();" />
					<input class="btn btn-danger" type="button" name="borrar_registros" value="Borrar Campos" onClick="BorrarRegistro();" />
					<div class="row">


						<h4 class="p-1 m-1 ml-2 col-md-12">Ubicacion</h4>

						<div class="row">
							<div class="col-1 ml-3 mr-3 form-group">
								<select required name="pasillo" class="form-control">
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
							<div class="col-1  ml-3 mr-3 form-group">
								<select required name="metro" class="form-control">
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
							<div class="col-2  ml-3 mr-3 form-group">
								<select required name="ubicacion" class="form-control">
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

						<div class="col-lg-12">
							<h4 class="p-1 m-1 col-md-6">Comentarios</h4>
							<textarea placeholder="Ej Articulos para reparacion / con faltante, etc " class="form-control w-50 p-2 m-2" id="comentarios" name="comentarios" rows="2"></textarea>
							<div>
								<input type="reset" class="btn btn-secondary" value="Limpiar">
								<input type="submit" value="Crear Pedido" class="btn btn-success" id="boton" disabled>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<br>
	<br>


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
					// 	// si no existe otro elemento, hago submit

					form.submit();
				}
				return false;
			}
		});
		//
	</script>

	<?php

	include "includes/footer.php";
	include "includes/sesiones.php";
	?>

</body>

</html>