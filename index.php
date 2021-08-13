<?php
	$alert='';
session_start();
if(!empty($_SESSION['active']))
{
	header('location: sistema/');	
}else {




if(!empty($_POST))
 	if (empty($_POST['usuario']) || empty($_POST['clave']))
{
		$alert ='<p class="bg-danger">Todos los campos son Obligatorios</p>';
}else{
	require_once "sistema/conexion.php";
	$user = mysqli_real_escape_string($link,$_POST['usuario']);
	$pass = md5 (mysqli_real_escape_string($link,$_POST['clave']));

	$query=mysqli_query($link,"SELECT * FROM usuarios WHERE legajo_usuario= '$user' AND clave = '$pass'");
	$result = mysqli_num_rows($query);
	mysqli_close($link);
	if($result > 0)
	{
		$data = mysqli_fetch_array($query);
		$_SESSION['active'] = true;
		$_SESSION['idUser'] = $data['legajo_usuario'];
		$_SESSION['apellido'] = $data['apelli_usuario'];
		$_SESSION['nombre'] = $data['nombre_usuario'];
		$_SESSION['rol'] = $data['rol'];
		header('location: sistema/');

	}else {
		$alert ='<p class="btn btn-danger font-weight-bold">El usuario o la clave son incorrectos</p>';
		session_destroy();
		
	}


}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
	<title>Login | Web</title>
	<link rel="shortcut icon" href="/sistema/img/favicon.png" type="image/x-icon">
</head>
<body>
<style>

</style>
	<div class="container">
					<form action="" method="post" autocomplete="off">
	<div class="row justify-content-center align-items-center ">
	<div class="mt-4 col-md-5  col-sm-6 col-lg-4 col aliign-self-center align-items-center">
				
			<img class="ml-4" src="sistema/img/logoeasy.png" width="250" height="auto" alt="Login" style="align-items: center;">
			<h1 class="mt-1 "> Sistema Web</h1>
			<div><?php echo isset($alert) ? $alert: ''; ?></div>
			<h6>Ingrese Legajo</h6>
	<div class="form-group">
			<input type="text" tabindex="1" name="usuario" placeholder="Usuario" class="form-control" autofocus>
	</div>
			<h6>Ingrese contraseña</h6>
	<div class="form-group">
			<input tabindex="2" type="password" name="clave" placeholder="Contraseña" class="form-control">
			
	
	</div>	
	<div>
	<input type="submit" value="Iniciar sesión" tabindex="3" class="btn btn-secondary mt-1 col align-self-end shadow">
	</div>

		</form>
		</div>
		</div>

</div>
<script>

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

<footer> 
	




    
</footer>	

</body>
</html>