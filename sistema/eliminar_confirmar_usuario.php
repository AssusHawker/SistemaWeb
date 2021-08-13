<?php
session_start();
// if ($_SESSION['rol'] != 2) {
// 	header("location: ./");
// }



include "../conexion.php";
if (!empty($_POST)) {
	if ($_POST['idusuario'] == 0) {
		header("location: lista_usuarios.php");
		mysqli_close($link);
		exit;
	}
	$idusuario = $_POST['idusuario'];

	//$query_delete = mysqli_query($link,"DELETE FROM usuario WHERE idusuario =$idusuario ");
	//no lo borro
	$query_delete = mysqli_query($link, "UPDATE usuarios SET status = 0 WHERE legajo_usuario = $idusuario ");
	mysqli_close($link);
	if ($query_delete) {
		header("location: lista_usuarios.php");
	} else {
		echo "Error al eliminar";
	}
}
//compruebo si existe la variable o si es legajo 410688(administrador)
if (empty($_REQUEST['id']) || $_REQUEST['id'] == 410688) /*mi legajo xD*/ {
	header("location: lista_usuarios.php");
	mysqli_close($link);
} else {

	$idusuario = $_REQUEST['id'];

	$query = mysqli_query($link, "SELECT u.apelli_usuario,u.legajo_usuario,r.rol
												from usuarios u 
												INNER JOIN
												roles r
												ON u.rol=r.id_rol
												WHERE u.legajo_usuario = $idusuario ");

	mysqli_close($link);
	$result = mysqli_num_rows($query);

	if ($result > 0) {
		while ($data = mysqli_fetch_array($query)) {
			# code...
			$apellido = $data['apelli_usuario'];
			$legajo = $data['legajo_usuario'];
			$rol     = $data['rol'];
		}
	} else {
		header("location: lista_usuarios.php");
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




	</div>
	<div id="container" class="bg-dark row justify-content-center align-items-center">
		<div class="card" style="width: 30%;">
			<div class="card-header">
				<h3>¿Eliminar el Usuario?</h3>
			</div>
			<div class="card-body">
				<div class="card-text align-items-center justify-content-center">
					<img src="img/register_user.png" alt="Borrar Usuario" class="w-100">
					<div class="row justify-content-center align-items-center">
						<h4>Apellido:</h4>
						<h4><?php echo $apellido; ?></h4>
					</div>
					<div class="row justify-content-center align-items-center">
						<h4>Legajo:</h4><?php echo $legajo; ?>
					</div>
					<div class="row justify-content-center align-items-center">
						<h4>Tipo Usuario:</h4><?php echo $rol; ?>
					</div>
				</div>

			</div>
			<div class="card-footer ">
				<form method="post" action="">
					<input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
					<a href="lista_usuarios.php" class="btn btn-success">Cancelar</a>
					<input type="submit" value="Aceptar" class="btn btn-danger ">
				</form>
			</div>



		</div>
		<div style="height: 25px;"></div>
		<?php
		include "includes/footer.php";
		include "includes/sesiones.php";
		?>
</body>

</html>