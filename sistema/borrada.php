<?php 
	session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "includes/scripts.php"; ?>
	<title>Borrado</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
		
    <div class="alert alert-success row justify-content-center align-items-center" role="alert" >
   <h4>Registro eliminado Correctamente.</h4>
    </div>
    <div class="row justify-content-center align-items-center">

       
       
       <button class="btn btn-success" onclick="location.href='buscar_boleta.php'" autofocus>Volver</button>

  <?php 
  include "includes/footer.php";
  include "includes/sesiones.php";
   ?>
    </div>
</body>
</html>