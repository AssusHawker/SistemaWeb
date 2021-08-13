<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/scripts.php"; ?>
    <title>Editar Articulo</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">


</head>

<body>

    <?php include "includes/header.php"; ?>

    <?php
    if (empty($_GET)) { ?>
        <div class="col-lg-12 row justify-content-center align-items-center">
            <div class="col-lg-4 ">
                <h1 class="row justify-content-center align-items-center">Editar Articulo</h1>

                <form action="" method="GET">

                    <input type="number" required class="form-control m-1 p-1" name="sap" id="sap" placeholder="Sap" autofocus autocomplete="off">
                    <input type="submit" value="buscar" class="btn btn-secondary mt-1 col align-self-end shadow" id="boton" enable>
            </div>
            </form>
        </div>

    <?php } ?>

    <?php if (!empty($_GET)) {
        // POST
        include "conexion.php";
        $sap = $_GET["sap"];
        //llamo funcion de imagen
        $img = imagen($sap);
        //

        $descripcion_sap = descripcion($sap);
        $ean = consultar_ean($sap)


    ?>

        <section id="container">

            <div class="form_register">
                <h1 class="row justify-content-center align-items-center">Editar Articulo</h1>
                <hr>
                <div class="row justify-content-center align-items-center"><?php echo isset($alert) ? $alert : ''; ?></div>
                <div class="row justify-content-center align-items-center">
                    <div>
                    <img class="mt-1 " style="display:block;margin:auto;" src="<?php echo $img;  ?>  " alt="Imagen">
                    </div>
                    <form action="guardar_articulo.php" method="post" autocomplete="off" class="w-25 bg-light p-3 m-3" id="form">
                        <div class="form-group">
                            <label for="nombre">Sap</label>
                            <input required class="form-control" type="number" hidden name="sap" id="sap" value="<?php echo $sap; ?>">
                            <input required class="form-control" type="number" disabled name="sap2" id="sap2" value="<?php echo $sap; ?>">
                            <label for="correo">EAN</label>
                            <input required class="form-control" type="number" name="ean" id="ean" value="<?php echo $ean; ?>">
                            <label for="usuario">Descripcion</label>
                            <input required class="form-control" type="text" name="descripcion_sap" id="descripcion_sap" value="<?php echo $descripcion_sap ?>">


                            <br>
                            <input type="submit" value="Guardar" class="btn btn-primary m-1 p-1 shadow">

                        </div>
                    </form>
                </div>

            </div>


            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.getElementById("form").addEventListener('submit', validarFormulario);
                });

                function validarFormulario(evento) {
                    evento.preventDefault();
                    const ean = document.getElementById('ean').value;
                    if (ean.length !== 13) {
                        alert('El codigo EAN debe tener 13 aracteres!');
                        return;
                    }

                    this.submit();
                }
            </script>
















        <?php } ?>


        <?php
        include "includes/footer.php";
        include "includes/sesiones.php";
        ?>

</body>

</html>