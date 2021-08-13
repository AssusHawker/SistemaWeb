<?php 
 session_start();
 require_once "conexion.php";
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
           
            <?php 




if (empty($_GET)) {

    Echo"No hay datos";
}
    
	

$idboleta = $_GET['id'];

$query = mysqli_query($link,"SELECT
                boletas_descripcion.Articulos_sap_articulo,
                boletas_descripcion.cantidad_articulos,
                boletas.fecha_bol,
                boletas.boc,
                boletas.comentarios,
                boletas.boc,
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
WHERE  boletas.boc = '$idboleta' AND boletas.boleta_estado_boleta_estado_id = 1 




                   ");

$result = mysqli_num_rows($query);
            			if($result > 0){
                 ?>
                            <table class="table table-hover">
                            <tr>
                                <th>Sap</th>
                                <th>Descripcion</th>
                                <th>Cantidad</th>
                                <th>Ubicacion</th>
                                <th>Comentarios</th>
                                <th>Fecha Subida</th>
                                <th>Boc N°</th>
                                <th>Usuario</th>
                                <th>Imagen</th>
                                </tr>
              <?php
                            
				while ($data = mysqli_fetch_array($query)) {
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
                      <img height="100" width="100" src="<?php echo $img;?>">
                    </td>
                    
                    
                    </tr>
                        <?php } ?>
                    <?php }else{
                    
                       echo "<div class=\"alert alert-danger w-50\" role=\"alert\"> La busqueda no arrojo resultados </div>";
                        
                    }

                      echo " <button class=\"btn btn-success\" onclick=\"location.href='index.php'\"> Volver</button>";

                    
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









