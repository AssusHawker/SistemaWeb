<?php
session_start();

include "conexion.php";


if (!empty($_POST)) {
			
		$clave  = md5($_POST['clave']);

	
			if (!empty($clave)) {
				$iduser = $_SESSION['idUser'];
				$sql_update = mysqli_query($link, "UPDATE usuarios
												  SET 
												  clave = '$clave'
												  WHERE  legajo_usuario = $iduser;

				
				
				");
			}

			if ($sql_update) {
				$alert = '<p class="alert-success">Usuario Actualizado correctamente.</p>';
			} else {
				$alert = '<p class="alert-warning">Error al Actualizar el usuario.</p>';
				
			}
		}
	


/////////////////////////


$iduser = $_SESSION['idUser'];

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
	<title>Editar Usuario</title>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<h1 class="row justify-content-center align-items-center">Editar Usuario</h1>
			<hr>
			<div><?php echo isset($alert) ? $alert : ''; ?></div>
			<div class="row justify-content-center align-items-center">
				
				<form action="" method="post" autocomplete="off" class="w-25 bg-light p-3 m-3">
					<div class="form-group">
						<input class="form-control" type="hidden" name="legajo" id="legajo" placeholder="Legajo" value="<?php echo $legajo_usuario; ?>">
						<label for="nombre">Legajo</label>
						<input class="form-control" type="number" name="legajo" id="legajo" placeholder="Legajo" value="<?php echo $legajo_usuario; ?>" disabled>
						<label for="correo">Apellido</label>
						<input required class="form-control" type="text" name="apellido" id="apellido" placeholder="Apellido" value="<?php echo $apelli_usuario; ?>"disabled>
						<label for="usuario">Nombre</label>
						<input required class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre_usuario; ?>"disabled>
						<label for="clave">Clave</label>
						<input class="form-control" type="password" name="clave" id="clave" placeholder="Clave de acceso" required>

						<br>
						<input type="submit" value="Guardar Cambios" class="btn btn-primary m-1 p-1">

					</div>
				</form>


			</div>
		</div>

	</section>
	<?php 
	include "includes/footer.php"; 
	include "includes/sesiones.php";
	?>
</body>

</html>