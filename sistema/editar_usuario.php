<?php
session_start();
if ($_SESSION['rol'] != 2) {
	header("location: ./");
}

include "../conexion.php";

if (!empty($_POST)) {
	$alert = '';
	if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['rol'])) {
		$alert = '<p class="alert-danger">Todos los campos son obligatorios.</p>';
	} else {

		$legajo = $_POST['legajo'];
		$nombre  = $_POST['nombre'];
		$apellido   = $_POST['apellido'];
		$clave  = md5($_POST['clave']);
		$rol    = $_POST['rol'];



		$query = mysqli_query($link, "SELECT * FROM usuarios
									WHERE legajo_usuario = '$legajo'
								    AND apelli_usuario !=  '$apellido'
							    	AND nombre_usuario != '$nombre'
									 AND rol != $rol

		 
		 
		 ");





		$result = mysqli_fetch_array($query);
		if ($result > 0) {
			$alert = '<p class="alert-danger">El usuario ya existe.</p>';
		} else {

			if (empty($clave)) {

				$sql_update = mysqli_query($link, "UPDATE usuarios
												  SET nombre_usuario = '$nombre',
												  apelli_usuario = '$apellido',
												  rol = '$rol'
												  WHERE  legajo_usuario = $legajo

				
				
				");
			} else {
				$sql_update = mysqli_query($link, "UPDATE usuarios
												  SET nombre_usuario = '$nombre',
												  apelli_usuario = '$apellido',
												  rol = '$rol',
												  clave = '$clave'
												  WHERE  legajo_usuario = $legajo

				
				
				");
			}

			if ($sql_update) {
				$alert = '<p class="alert-success">Usuario Actualizado correctamente.</p>';
			} else {
				$alert = '<p class="alert-warning">Error al Actualizar el usuario.</p>';
			}
		}
	}
}
/////////////////////////
if (empty($_GET['id'])) {
	header('location: lista_usuarios.php');
	mysqli_close($link);
}

$iduser = $_GET['id'];


$sql = mysqli_query($link, "SELECT u.legajo_usuario,u.apelli_usuario,u.nombre_usuario,u.rol as id_rol, (r.rol) as rol  
								FROM usuarios u
								INNER JOIN roles r
								on u.rol = r.id_rol
								WHERE legajo_usuario=$iduser");


//Traigo cantidad de registros de la consulta anterior, si es igual a cero no existe
//y se lo llevo al index principal
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	header('location: lista_usuarios.php');
} else {
	//guardo los datos en el array $data
	while ($data = mysqli_fetch_array($sql)) {
		$legajo_usuario = $data['legajo_usuario'];
		$apelli_usuario = $data['apelli_usuario'];
		$nombre_usuario = $data['nombre_usuario'];
		$idrol = $data['id_rol'];
		$rol = $data['rol'];
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
			<h1>Registrar Usuario</h1>
			<hr>
			<div><?php echo isset($alert) ? $alert : ''; ?></div>

			<img class="w-25 bg-light p-3 m-3" src="img/register_user.png" alt="">
			<form action="" method="post" autocomplete="off" class="w-25 bg-light p-3 m-3">
				<div class="form-group">
					<input class="form-control" type="hidden" name="legajo" id="legajo" placeholder="Legajo" value="<?php echo $legajo_usuario; ?>">
					<label for="nombre">Legajo</label>
					<input class="form-control" type="number" name="legajo" id="legajo" placeholder="Legajo" value="<?php echo $legajo_usuario; ?>" disabled>
					<label for="correo">Apellido</label>
					<input required class="form-control" type="text" name="apellido" id="apellido" placeholder="Apellido" value="<?php echo $apelli_usuario; ?>">
					<label for="usuario">Nombre</label>
					<input required class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre_usuario; ?>">
					<label for="clave">Clave</label>
					<input class="form-control" type="password" name="clave" id="clave" placeholder="Clave de acceso">
					<label for="rol">Tipo Usuario</label>
					<select required class="form-control" name="rol" id="rol">
						<option value="">Seleccionar</option>
						<option value="1">Usuario</option>
						<option value="3">Jefe</option>
						<option value="2">Administrador</option>

					</select>
					<br>
					<input type="submit" value="Guardar Cambios" class="btn btn-primary m-1 p-1">

				</div>
			</form>


		</div>


	</section>
	<?php
	include "includes/footer.php";
	include "includes/sesiones.php";
	?>
</body>

</html>