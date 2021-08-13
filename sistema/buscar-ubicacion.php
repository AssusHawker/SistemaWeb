<?php
session_start();

if(empty($_GET))
	{
		header("location: ./");
	}



include "conexion.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php
    require_once "includes/scripts.php";
    require_once "includes/functions.php" ;
    
    ?>
    <title>Resultados de la Busqueda</title>
    <br>

</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container p-2 m-2">
        <h1>Resultados de la Busqueda</h1>
        <br>
        <h3><kbd>Buscando datos en la Ubicacion:
        <?php
            echo " ".$_GET['pasillo']." ".$_GET['metro']." ".$_GET['ubicacion'];

        ?>
        
        </kbd></h3>
        <div class="row">
            <div class="col">

                <?php

                if (!empty($_GET)) {

                    if (empty($_GET['metro']) && empty($_GET['ubicacion']) && empty($_GET['pasillo'])) {
                        echo "<div class=\"alert alert-danger w-50\" role=\"alert\"> Debe Seleccionar al menos un campo </div>";
                    } else {

                        $pasillo = $_GET['pasillo'];
                        $metro   = $_GET['metro'];
                        $ubicacion = ($_GET['ubicacion']);

                        ///code

                        $query = mysqli_query($link, " SELECT 
         boletas.boc,
         boletas.pasillo,
         boletas.metro,
         boletas.letra,
         boletas.boleta_estado_boleta_estado_id,
         usuarios.nombre_usuario,
         usuarios.apelli_usuario,
         boletas.fecha_bol,
         boletas.comentarios
FROM     boletas 
INNER JOIN `usuarios`  ON `boletas`.`Usuarios_legajo_usuario` = `usuarios`.`legajo_usuario` 
Where pasillo LIKE '%$pasillo%' AND metro LIKE '%$metro' AND letra LIKE '%$ubicacion' AND boleta_estado_boleta_estado_id != 4
                   
                  ");


                        $_SESSION['pasillo'] = $pasillo;
                        $_SESSION['metro'] = $metro;
                        $_SESSION['ubicacion'] = $ubicacion;

                       

                        $result = mysqli_num_rows($query);
                        if ($result > 0) {
                ?>
                            <table class="table table-hover">
                                <tr style="color: white; background-color:grey">
                                    <th>N° Boleta</th>
                                    <th>Ubicacion</th>
                                    <th>Comentarios de la Boleta</th>
                                    <th>Fecha Subida</th>
                                    <th>Usuario</th>
                                    <th></th>

                                </tr>
                                <?php

                                while ($data = mysqli_fetch_array($query)) {
                                    $fecha = FechaNueva($data["fecha_bol"]);

                                ?>

                                    <tr style="background-color: #dddddd;font-weight: bold;">
                                        <td><?php echo $data["boc"]; ?></td>
                                        <td><?php echo $data["pasillo"] . "-" . $data["metro"] . "-" . $data["letra"]; ?></td>
                                        <td><?php echo $data["comentarios"]; ?></td>
                                        <td><?php echo $fecha; ?></td>
                                        <td><?php echo $data["nombre_usuario"] . " " . $data["apelli_usuario"]; ?></td>
                                        <td>
                                           
                                            <!-- aca va es estado -->
                                            <?php

                                            switch ($data["boleta_estado_boleta_estado_id"]) {
                                                case '1':
                                                    $colorEstado = 'Verde';
                                                    $colorFondo = 'bg-success';
                                                    break;
                                                case '2':
                                                    $colorEstado  = 'Amarillo';
                                                    $colorFondo = 'bg-success';
                                                     break;
                                                 case '3':
                                                    $colorEstado = 'Rojo';
                                                    $colorFondo = 'bg-success';       
                                                  break;
                                                

                                            }
                                            
                                            
                                            echo '<h3><span class="badge '.$colorFondo.'">'.$colorEstado.'</span></h3>'; ?>
                                            <?php
                                            if (!isset($_GET['detalle'])) {

                                            ?>
                                                |
                                                <a class="btn btn-success" href="detalle_boleta.php?id=<?php echo $data["boletasid"]; ?>" target="_blank">Detalles</a>

                                        </td>

                                    <?php } ?>
                                    </tr>


                                    <!-- inicio del ciclo de detalles -->
                                    <?php
                                    $boletaid = $data["boc"];
                                    if (isset($_GET['detalle']) && $_GET['detalle'] == '1') {
                                        $_SESSION['detallado'] = true;
                                        $query2 = mysqli_query($link, " SELECT
                                                `boletas_descripcion`.`boc`,
                                                `boletas_descripcion`.`Articulos_sap_articulo`,
                                                `boletas_descripcion`.`cantidad_articulos`,
                                                `articulos`.`sap_articulo`,
                                                `articulos`.`descr_articulo`
                                       FROM     `boletas_descripcion` 
                                       INNER JOIN `articulos`  ON `boletas_descripcion`.`Articulos_sap_articulo` = `articulos`.`sap_articulo` 

                                                             WHERE  boc = $boletaid
                                                              ");
                                    ?>
                                        <tr style="color: black ; font-weight: bold; background-color: #eeeded; ">
                                            <td></td>
                                            <td></td>
                                            <td>SAP</td>
                                            <td>Descripcion</td>
                                            <td>Cantidad</td>
                                            <td>Imagen</td>
                                        </tr>

                                        <?php
                                      
                                        while ($data2 = mysqli_fetch_array($query2)) {


                                        ?>

                                            <!-- tabla -->



                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><?php echo $data2["Articulos_sap_articulo"]; ?></td>
                                                <td><?php echo $data2["descr_articulo"]; ?></td>
                                                <td><?php echo $data2["cantidad_articulos"]; ?></td>
                                                <td>
                                                    <!-- Inicio de la busqueda de Imagen -->
                                                    <?php $img = imagen($data2["Articulos_sap_articulo"]); ?>
                                                    <img height="100" width="100" src=" <?php echo $img; ?> "> <!-- Fin de la busqueda de imagen -->
                                                </td>
                                            </tr>


                                            <!-- FIN TABLA -->









                                        <?php  }  ?>



                                    <?php  } else {
                                        $_SESSION['detallado'] = false;
                                    }

                                    ?>








                                <?php } ?>
                    <?php } else {

                            echo "<div class=\"alert alert-danger w-50\" role=\"alert\"> La busqueda no arrojo resultados </div>";
                        }

                        echo " <button class=\"btn btn-dark\" onclick=\"location.href='index.php'\"> Volver</button>";
                       

                        mysqli_close($link);
                    }
                }
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