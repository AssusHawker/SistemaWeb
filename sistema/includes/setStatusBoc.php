<?php

/**
 * Requiere un array con color
 * 1-Verde
 * 2-Amarillo
 * 3-Rojo
 * Funcion que al pasarle el color devuelve la cantidad de BOC con ese estado
 * 
 */
function color($color)
{

    require "conexion.php";

    switch ($color) {
        case 'verde':

            $query = mysqli_query($link,"SELECT
                    COUNT(*) totalBoc 
                    FROM boletas 
                    WHERE boleta_estado_boleta_estado_id = 1

                                  ");

            $result = mysqli_num_rows($query);
            if ($result > 0) {
                $data = mysqli_fetch_array($query);

                $total = $data["totalBoc"];
                return $total;
            }

            break;
        case 'amarillo':
            $query = mysqli_query($link,"SELECT
                    COUNT(*) totalBoc 
                    FROM boletas 
                    WHERE boleta_estado_boleta_estado_id = 2

                                  ");

            $result = mysqli_num_rows($query);
            if ($result > 0) {
                $data = mysqli_fetch_array($query);

                $total = $data["totalBoc"];
                return $total;
            }


            break;
        case 'rojo':
            $query = mysqli_query($link,"SELECT
                    COUNT(*) totalBoc 
                    FROM boletas 
                    WHERE boleta_estado_boleta_estado_id = 3

                                  ");

            $result = mysqli_num_rows($query);
            if ($result > 0) {
                $data = mysqli_fetch_array($query);

                $total = $data["totalBoc"];
                return $total;
            }


            break;
    }
}


