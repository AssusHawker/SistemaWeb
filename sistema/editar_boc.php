<?php
session_start();

if ($_GET) {
	require "conexion.php";
	$boc = $_GET['boc'];

	$query = mysqli_query($link, "SELECT
		boletas_descripcion.Articulos_sap_articulo,
		boletas_descripcion.cantidad_articulos,
		boletas.boleta_estado_boleta_estado_id,
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
		$data = mysqli_fetch_array($query);


		$sap =  $data["Articulos_sap_articulo"];
		$cantidad =  $data["cantidad_articulos"];
		$comentarios = $data["comentarios"];
		$fecha = $data["fecha_bol"];
		$boc = $data["boc"];
		$nombre = $data["nombre_usuario"];
		$apellido = $data["apelli_usuario"];
		$pasillo =  $data["pasillo"];
		$metro = $data["metro"];
		$ubicacion = $data["letra"];
		$estado = $data["boleta_estado_boleta_estado_id"];

		$date1 = date("Y-m-d", strtotime($fecha));
		$now = date("Y-m-d");
		//calculo de Diferencia de fechas en dias
		$datetime1 = date_create($date1);
		$datetime2 = date_create($now);
		$contador = date_diff($datetime1, $datetime2);
		$differenceFormat = '%a';
		$newDate = date("d/m/Y H:i:s", strtotime($fecha));

		//estados de color en BOC
		switch ($estado) {
			case '1':
				$color = 'bg-success';
				break;
			case '2':
				$color = 'bg-warning';
				break;
			case '3':
				$color = 'bg-danger';
				break;
			case '4':
				$color = 'bg-dark';
				break;
		}
	} ?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<?php include "includes/scripts.php"; ?>
			<!-- Titulo de la web -->
			<title>Sistema WEB</title>


	</head>

	<body>
		<?php include "includes/header.php"; ?>
		<!-- inicio del codigo -->
				
		<h2 style="color: white;" class="  <?php echo $color; ?>" >BOC N° <?php echo $boc . " Creado hace ". $contador->format($differenceFormat) . " Dias"; ?> </h2>

		


		

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
				<form action="editar_boc_res.php" class="form-inline" method="GET" autocomplete="off">
				<h4 class="p-1 m-1 ml-2 col-md-6">Editar ubicacion</h4>

						<div class="row">
							<div class="col-1 ml-3 mr-3 form-group">
								<select  name="pasillo" class="form-control">
									<?php
									include "conexion.php";
									echo "<option value='$pasillo '>" . $pasillo . "</option>";
									$sql = mysqli_query($link, "SELECT NombrePasillo FROM pasillos");
									while ($row = $sql->fetch_assoc()) {
										echo "<option>" . $row['NombrePasillo'] . "</option>";
									}
									mysqli_close($link);
									?>
								</select>
							</div>
							<div class="col-1  ml-3 mr-3 form-group">
								<select  name="metro" class="form-control">
									<?php
									include "conexion.php";
									echo "<option value='$metro'>" . $metro . "</option>";
									$sql = mysqli_query($link, "SELECT NombreMetro FROM metro");
									while ($row = $sql->fetch_assoc()) {
										echo "<option>" . $row['NombreMetro'] . "</option>";
									}
									mysqli_close($link);
									?>
								</select>
							</div>
							<div class="col-2  ml-3 mr-3 form-group">
								<select  name="ubicacion" class="form-control">
									<?php
									include "conexion.php";
									echo "<option value='$ubicacion'>" . $ubicacion . "</option>";
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
							<textarea placeholder="" class="form-control w-50 p-2 m-2" id="comentarios" name="comentarios" value="dsfdf" rows="2" ><?php echo $comentarios; ?></textarea>
							
						</div>

						
						<input id="boc" name="boc" type="hidden" value="<?php echo $boc; ?>">
						<button class="btn btn-success">Guardar</button>
				</form>				

		<!-- Fin -->
		<?php

		include "includes/footer.php";
		include "includes/sesiones.php"; ?>

	</body>

	</html>

<?php } ?>