<?php
session_start();

$pasillo = $_SESSION['pasillo'];
$metro = $_SESSION['metro'];
$ubicacion = $_SESSION['ubicacion'];

header('Content-type:aplication/xls');
header('Content-Disposition: attachment; filename=techos.xls');

include "conexion.php";
$pasillo = $_SESSION['pasillo'];
$metro = $_SESSION['metro'];
$ubicacion = $_SESSION['ubicacion'];


$query = "SELECT 
         boletas.boletasid,
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
Where pasillo LIKE '%$pasillo%' AND metro LIKE '%$metro' AND letra LIKE '%$ubicacion' AND boleta_estado_boleta_estado_id = 1
                   
                  ";






$result = mysqli_query($link, $query);

?>
<table border="1">
    <tr style="background-color:grey;">
        <th>Numero Boleta</th>
        <th>Pasillo</th>
        <th>Metro</th>
        <th>Ubicacion</th>
        <th>Comentarios</th>
        <th>Fecha de Subida</th>
        <th>Usuario</th>

    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td><?php echo $row['boletasid']; ?></td>
            <td><?php echo $row["pasillo"] ?></td>
            <td><?php echo $row["metro"] ?></td>
            <td><?php echo $row["letra"] ?></td>
            <td><?php echo $row['comentarios']; ?></td>
            <td><?php echo $row['fecha_bol']; ?></td>
            <td><?php echo $row["nombre_usuario"] . " " . $row["apelli_usuario"]; ?></td>

        </tr>
        <!-- inicio de la opcion detallada -->

        <!-- inicio del ciclo de detalles -->
        <?php

        $boletaid = $row["boletasid"];

        if ($_SESSION['detallado'] == true) {

            $query2 = mysqli_query($link, " SELECT
                                                `boletas_descripcion`.`boletas_boletasid`,
                                                `boletas_descripcion`.`Articulos_sap_articulo`,
                                                `boletas_descripcion`.`cantidad_articulos`,
                                                `articulos`.`sap_articulo`,
                                                `articulos`.`descr_articulo`
                                       FROM     `boletas_descripcion` 
                                       INNER JOIN `articulos`  ON `boletas_descripcion`.`Articulos_sap_articulo` = `articulos`.`sap_articulo` 
                                                             WHERE  boletas_boletasid = $boletaid
                                                              ");
        ?>
            <tr style="color: black ; font-weight: bold; background-color: #eeeded; ">
                <td></td>
                <td></td>
                <td>SAP</td>
                <td>Descripcion</td>
                <td>Cantidad</td>
                <td></td>
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
                    <td></td>
                </tr>


                <!-- FIN TABLA -->


            <?php  }  ?>
        <?php  }  ?>

    <?php
    }

    ?>
</table>