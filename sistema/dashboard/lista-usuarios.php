<?php
session_start();
if ($_SESSION['rol'] != 2) {
    header("location: ./");
}

include "../conexion.php";
                      
                 




?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Panel de Control</title>
</head>

<body>

    



    <div class="w-100">
        <div>
            <h1 class="font-weight-bold bg-dark" style="color: white; text-align:center ;">Panel de control</h1>
        </div>

       
        <section id="container">

            <h1> - <i class="icon ion-md-person"></i> - Lista de usuarios</h1>
            <a href="../registro_usuario.php" class="btn btn-success">Crear usuario</a> <br>



            <table class="table table-hover">
                <tr>
                    <th>Legajo</th>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
                <?php
                //Paginador
                $sql_registe = mysqli_query($link, "SELECT COUNT(*) as total_registro FROM usuarios");
                $result_register = mysqli_fetch_array($sql_registe);
                $total_registro = $result_register['total_registro'];

                $por_pagina = 25;

                if (empty($_GET['pagina'])) {
                    $pagina = 1;
                } else {
                    $pagina = $_GET['pagina'];
                }

                $desde = ($pagina - 1) * $por_pagina;
                $total_paginas = ceil($total_registro / $por_pagina);

                $query = mysqli_query($link, "SELECT u.legajo_usuario, u.apelli_usuario, u.nombre_usuario,r.rol
			 FROM usuarios u 
			 INNER JOIN roles r ON u.rol = r.id_rol  WHERE status=1
			 ORDER BY u.apelli_usuario ASC LIMIT $desde,$por_pagina 
				");

                mysqli_close($link);

                $result = mysqli_num_rows($query);
                if ($result > 0) {

                    while ($data = mysqli_fetch_array($query)) {

                ?>
                        <tr>
                            <td><?php echo $data["legajo_usuario"]; ?></td>
                            <td><?php echo $data["apelli_usuario"]; ?></td>
                            <td><?php echo $data["nombre_usuario"]; ?></td>
                            <td><?php echo $data['rol'] ?></td>
                            <td>
                                <a class="btn btn-success" href="../editar_usuario.php?id=<?php echo $data["legajo_usuario"]; ?>">Editar</a>

                                <?php if ($data["legajo_usuario"] != 0000 && $data["legajo_usuario"] != 410688)/*el usuario admin*/ { ?>
                                    |
                                    <a class="btn btn-danger" href="../eliminar_confirmar_usuario.php?id=<?php echo $data["legajo_usuario"]; ?>">Eliminar</a>
                                <?php } ?>

                            </td>
                        </tr>

                <?php
                    }
                }
                ?>


            </table>
            <div class="paginador">
                <ul>
                    <?php
                    if ($pagina != 1) {
                    ?>
                        <li><a href="?pagina=<?php echo 1; ?>">|<< /a>
                        </li>
                        <li><a href="?pagina=<?php echo $pagina - 1; ?>">
                                <<< /a>
                        </li> <?php
                            }
                            for ($i = 1; $i <= $total_paginas; $i++) {
                                # code...
                                if ($i == $pagina) {
                                    echo '<li class="pageSelected">' . $i . '</li>';
                                } else {
                                    echo '<li><a href="?pagina=' . $i . '">' . $i . '</a></li>';
                                }
                            }

                            if ($pagina != $total_paginas) {
                                ?> <li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
                        <li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
                    <?php }

                    ?>
                </ul>
            </div>


        </section>
    </div>
    </div>

</body>

</html>