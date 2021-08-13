<?php 
	session_start();
    include "conexion.php";

  ?>
  <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
    <title>Resultados de la Busqueda</title>
    <br>
    
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container p-2 m-2">
        <h1>Resultados de la Busqueda</h1>
        <br>
        <div class="row">
            <div class="col">
        <table class="table table-hover m-2 p-2">
			<tr>
				<th>N° Boc</th>
                <th>Ubicacion</th>
                <th>Comentarios</th>
            	<th>Fecha Subida</th>
                <th>Usuario</th>
                <th>Acciones</th>
				</tr>
        <?php 
        //cargo lo que viene del GET en variable busqueda y lo hago minuscula con strtolower
        $busqueda = strtolower($_REQUEST['busqueda']);
     
        $query = mysqli_query($link,"SELECT
        boletas_descripcion.Articulos_sap_articulo,
        boletas_descripcion.cantidad_articulos,
        boletas.fecha_bol,
        boletas.boc,
        boletas.comentarios,
        boletas.boleta_estado_boleta_estado_id,
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
WHERE  boletas.boc = $busqueda AND boletas.boleta_estado_boleta_estado_id = 1 



           ");





        $result = mysqli_num_rows($query);
                    if($result > 0){
                        
           $data = mysqli_fetch_array($query); 
               
        ?>
            
            <tr>
                <td><?php echo $data["boc"]; ?></td>
                <td><?php echo $data["pasillo"]."-".$data["metro"]."-".$data["letra"]; ?></td>
                <td><?php echo $data["comentarios"]; ?></td>
                <td><?php echo $data["fecha_bol"]; ?></td>
                <td><?php echo $data["nombre_usuario"]." ".$data["apelli_usuario"]; ?></td>

               
                <td>
						
                
						<a class="btn btn-success" href="detalle_boleta.php?id=<?php echo $data["boc"]; ?>" target="_blank">Detalles</a>
						|
						<a class="btn btn-danger" href="eliminar_confirmar_boleta.php?id=<?php echo $data["boc"]; ?>">Eliminar</a>
					
						
					</td>
                
 
                
                
                
                </tr>
                   
                <?php }else
                {

                  echo " <button class=\"btn btn-warning\" onclick=\"location.href='buscar_boleta.php'\"> Sin resultados-Volver</button>";

                }
                mysqli_close($link);
                                                    
                 ?>
               
      </table>
      </div>
      </div>
</section>
<?php 
include "includes/footer.php"; 
include "includes/sesiones.php";
?>
</body>
</html>


