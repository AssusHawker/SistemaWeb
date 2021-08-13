<?php
session_start();
if ($_SESSION['rol'] == 1) {
	header("location: ./");
}

include "conexion.php";

if (!empty($_POST)) {
	$alert = '';
	if (empty($_POST['legajo']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['clave']) || empty($_POST['rol'])) {
		$alert = '<p class="alert-danger">Todos los campos son obligatorios.</p>';
	} else {

		$legajo = $_POST['legajo'];
		$nombre  = $_POST['nombre'];
		$apellido   = $_POST['apellido'];
		$clave  = md5($_POST['clave']);
		$rol    = $_POST['rol'];


		$query = mysqli_query($link, "SELECT * FROM usuarios WHERE legajo_usuario = '$legajo'");
		$result = mysqli_fetch_array($query);
		if ($result > 0) {
			$alert = '<p class="alert-danger">El usuario ya existe.</p>';
		} else {

			$query_insert = mysqli_query($link, "INSERT INTO usuarios(legajo_usuario,apelli_usuario,nombre_usuario,clave,rol)
																	VALUES('$legajo','$apellido','$nombre','$clave',$rol)");

			if ($query_insert) {
				$alert = '<p class="alert-success">Usuario creado correctamente.</p>';
			} else {
				$alert = '<p class="alert-warning">Error al crear el usuario.</p>';
			}
		}
	}
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Usuario</title>
</head>

<body>
<?php include "includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<h1 class="row justify-content-center align-items-center">Registrar Usuario</h1>
			<hr>
			<div class="row justify-content-center align-items-center"><?php echo isset($alert) ? $alert : ''; ?></div>
			<div class="row justify-content-center align-items-center">
			
			
			<form action="" method="post" autocomplete="off" class="w-25 bg-light p-3 m-3">
					<div class="form-group">
					<label for="nombre">Legajo</label> 
					<input required class="form-control" type="number" name="legajo" id="legajo" placeholder="Legajo" autofocus>
					<label for="correo">Apellido</label>
					<input required class="form-control" type="text" name="apellido" id="apellido" placeholder="Apellido">
					<label for="usuario">Nombre</label>
					<input required class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre">
					<label for="clave">Clave</label>
					<input required class="form-control" type="password" name="clave" id="clave" placeholder="Clave de acceso">
					<label for="rol">Tipo Usuario</label>
					<select required class="form-control" name="rol" id="rol">
						<option value="1">Usuario</option>
						
					</select>
					<br>
					<input type="submit" value="Crear Usuario" class="btn btn-primary m-1 p-1 shadow">

				</div>
			</form>
		</div>

	</div>


	<script>
		//Funcion para pasar el foco al dar enter
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
	<?php
	 include "includes/footer.php";
	 include "includes/sesiones.php";
	  ?>
</body>

</html>