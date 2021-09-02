<?php
session_start();
include "conexion.php";
$alert = "";
if (!$_GET){
	header('Location: index.php');

}



if (!empty($_POST)) {
	$boc = $_POST['boc'];
	$query_delete = mysqli_query($link, "UPDATE boletas 
	SET boleta_estado_boleta_estado_id = 5
	 WHERE boc = $boc ");
	mysqli_close($link);
	if ($query_delete) {
		$alert = '<div class="alert alert-success text-center" role="alert"> <h3>Boc Borrado</h3> </div>';
	}
}

$idboleta = $_GET['boc'];




?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";
	
	?>
	
	<title>Borrar Boc?</title>
</head>

<body>
	<?php include "includes/header.php";
	echo $alert;
	?>
	<div class="row justify-content-center align-items-center">
			<div class="card w-25 justify-content-center align-items-center m-3 rounded shadow-lg">
				<div class="card-header w-100">
					<h3>Borrar Boc?</h3>
				</div>
				<div class="card-body">
					<img src="img/borrar_boleta.png" alt="Borrar Usuario" class="w-100 mx-auto d-block">


					</p>

				</div>
				<div class="card-footer w-100">

					<h4 class="card-text row justify-content-center align-items-center">Boc Numero:</h4>
					<h3 class="row justify-content-center align-items-center"><?php echo $idboleta; ?></h3>
					<div class="row justify-content-center align-items-center">

					<form method="POST" action="">
						<div style="display: flex; justify-content: center;" >
						<input type="hidden" name="boc" value="<?php echo $idboleta; ?>">
						
						<input  type="submit" value="Aceptar" class="btn btn-success m-2 ">
					
						<a href="index.php" class="btn btn-dark m-2">Cancelar</a>
						</div>
					</form>
					</div>
				</div>
			</div>


</div>
	
	<?php 
	include "includes/footer.php"; 
	include "includes/sesiones.php";
	
	?>
</body>

</html>