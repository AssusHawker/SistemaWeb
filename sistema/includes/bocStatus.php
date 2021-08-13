<?php

/**
 * Requiere un array con numero de BOC y devuelve el estado:
 * 1-Verde
 * 2-Amarillo
 * 3-Rojo
 * 4-Borrada 
 */

function bocStatus($boc)
{
    require "../conexion.php";

    $query = mysqli_query($link, "SELECT *       
                                      
     FROM    boletas
     WHERE   boc = $boc 
     LIMIT 50

           ");

$result = mysqli_num_rows($query);
            if ($result > 0) {
                $data = mysqli_fetch_array($query);
                             
                $estado = $data["boleta_estado_boleta_estado_id"];
                return $estado;
                
 
}else{
    return "el boc no existe";
}

}

?>