<?php
/**
 * requiere numero de boc
 * Funcion para pasarle un BOC y devuelve la vida en dias
 * 
 */

function bocVida($boc){
    require "conexion.php";
     $query = mysqli_query($link, "SELECT *       
                                      
     FROM    boletas
     WHERE   boc = $boc 
     

           ");

$result = mysqli_num_rows($query);
            if ($result > 0) {
                $data = mysqli_fetch_array($query);
                             
                $fecha = $data["fecha_bol"];


           
                
 
}

}
