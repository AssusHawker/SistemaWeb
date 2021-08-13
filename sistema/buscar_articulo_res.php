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

                <?php



                //cargo lo que viene del GET en variable busqueda y lo hago minuscula con strtolower
                $busqueda = strtolower($_REQUEST['busqueda']);
                $Xbusqueda = ($_REQUEST['Xbusqueda']);




                if ($Xbusqueda == 'Xsap') {


                    ///busqueda por sap exacto

                    $query = mysqli_query($link, "SELECT   articulos.sap_articulo,
                `articulos`.`descr_articulo`,
                `cod_barras`.`barra_sap`,
                `cod_barras`.`cod_barra`
                 FROM  `articulos` 
                 INNER JOIN `cod_barras`  ON `articulos`.`sap_articulo` = `cod_barras`.`barra_sap` 
                        WHERE articulos.sap_articulo = $busqueda

                    ");
                }
                //Esta parte donde dice boletas.boleta_estado_boleta_estado_id = 1  es para que no muestre las boletas "borradas"
                if ($Xbusqueda == 'Xdescripcion') {



                    //busqueda por descripcion
                    $query = mysqli_query($link, "SELECT 
                   articulos.sap_articulo,
                   articulos.descr_articulo
                 FROM  articulos
                 WHERE articulos.descr_articulo LIKE '%$busqueda%'
                 LIMIT 20
                   
                  

                   ");
                }






                $result = mysqli_num_rows($query);
                if ($result > 0) {
                ?>
                    <table class="table table-hover">
                        <tr>
                            <th>Sap</th>
                            <th>Ean</th>
                            <th>Descripcion</th>
                            <th>Imagen</th>
                        </tr>
                        <?php


                        while ($data = mysqli_fetch_array($query)) {

                        ?>

                            <tr>
                                <td><?php echo $data["sap_articulo"]; ?></td>
                                <td><?php echo $data["cod_barra"]; ?></td>
                                <td><?php echo $data["descr_articulo"]; ?></td>
                                <td> <img height="150" width="150" src=" <?php echo imagen($data["sap_articulo"]); ?>"> </td>

                                <td> <a class="btn btn-danger" href="eliminar_confirmar_articulo.php?sap=<?php echo $data["sap_articulo"]; ?>&barra=<?php echo $data["cod_barra"]; ?>">Eliminar</a>
                                    |
                                    <button class="btn btn-primary" onclick="location.href='editar_articulo.php?sap=<?php echo $data["sap_articulo"]; ?>'"> Editar </button>
                                </td>


                            </tr>
                        <?php } ?>
                    <?php } else {

                    echo "<div class=\"alert alert-danger w-50\" role=\"alert\"> La busqueda no arrojo resultados </div>";
                }

                echo " <button class=\"btn btn-success\" onclick=\"location.href='Buscar_articulos.php'\"> Volver</button>";



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