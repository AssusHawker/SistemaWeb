<?php
session_start();

include "conexion.php";
if (!empty($_GET)) {
	$boc = $_GET['boc'];
	

?>




	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include "includes/scripts.php"; ?>
		<!-- Titulo de la web -->
		<title>Detalles BOC N° <?php echo $boc; ?> </title>
		

	</head>

	<body>
		<?php include "includes/header.php"; ?>
		<!-- inicio del codigo -->

			<h2>BOC N° <?php echo $boc; ?> </h2>
			<button class="btn btn-primary" onclick="location.href='index.php'"> Volver</button>
			|
			<button class="btn btn-success" onclick="location.href='editar_boc.php?boc=<?php echo  $boc; ?>'"> Editar</button>
			|
			<button class="btn btn-danger" onclick="location.href='eliminar_confirmarb_boc.php?boc=<?php echo  $boc; ?>'"> Borrar</button>
			<?php 
			
			$query = mysqli_query($link, " SELECT
							boletas_descripcion.Articulos_sap_articulo,
                			boletas_descripcion.cantidad_articulos,
                			boletas.fecha_bol,
                			boletas.boc,
                			boletas.comentarios,
                			usuarios.apelli_usuario,
                			usuarios.nombre_usuario,
                			articulos.descr_articulo,
                			boletas.pasillo,
                			boletas.metro,
                			boletas.letra
      				 FROM     boletas_descripcion
      				 INNER JOIN `boletas`  ON `boletas_descripcion`.`boc` = `boletas`.`boc` 
      				 INNER JOIN `usuarios`  ON `boletas`.`Usuarios_legajo_usuario` = `usuarios`.`legajo_usuario` 
      				 INNER JOIN `articulos`  ON `boletas_descripcion`.`Articulos_sap_articulo` = `articulos`.`sap_articulo` 
					WHERE  boletas.boc = '$boc' 
					LIMIT 50
						 
						  ");
		
			$result = mysqli_num_rows($query);
			if ($result > 0) {
				?>
				<table class="table table-hover">
                            <tr>
                                <th>Sap</th>
                                <th>Descripcion</th>
                                <th>Cantidad</th>
                                <th>Ubicacion</th>
                                <th>Comentarios de la Boleta</th>
                                <th>Fecha Subida</th>
                                <th>Boc N°</th>
                                <th>Usuario</th>
                                <th>Imagen</th>
                                </tr>
				<?php

				while ($data = mysqli_fetch_array($query)) {
					$sap =  $data["Articulos_sap_articulo"];
					$cantidad =  $data["cantidad_articulos"];
					$descripcion =  $data["descr_articulo"];
					$img =  imagen($data["Articulos_sap_articulo"]);	
					?>


					<tr>
                    <td><?php echo $data["Articulos_sap_articulo"]; ?></td>
                    <td><?php echo $data["descr_articulo"] ; ?></td>
                    <td><?php echo $data["cantidad_articulos"]; ?></td>
                    <td><?php echo $data["pasillo"]."-".$data["metro"]."-".$data["letra"]; ?></td>
                    <td><?php echo $data["comentarios"]; ?></td>
                    <td><?php echo $data["fecha_bol"]; ?></td>
                    <td><?php echo $data["boc"]; ?></td>
                    <td><?php echo $data["nombre_usuario"]." ".$data["apelli_usuario"]; ?></td>

                    <td>
                      <img height="100" width="100" src="  <?php echo $img; ?>">
                    </td>
                    
                    
                    </tr>
					
					<?php
				}
			}
			?>


		

		<?php

		include "includes/footer.php";
		include "includes/sesiones.php";
		?>

	</body>

	</html>
<?php } else {
	echo "<h1>BOC inexistente</h1>";
}


?>