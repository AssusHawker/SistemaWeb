<?php


require "conexion.php";


$now = date("Y-m-d");

/**
 * actualiza automaticamente los estados de los boc de acuerdo a la fecha
 * De 0 a 6 dias Estado 1 (VERDE) 
 * De 7 a 9 dias Estado 2 (Amarillo)
 * de 10 en adelante estado (ROJO)
 * 
 */
//de 7 a 9 dias//
$amarillo = strtotime('-9 day', strtotime($now));
$amarillo_p = date('Y-m-d', $amarillo);

$amarillo_date = strtotime('-7 day', strtotime($now));
$amarillo_f = date('Y-m-d', $amarillo_date);
//
$query = mysqli_query($link, "SELECT * from boletas 
                                WHERE CAST(fecha_bol AS DATE) 
                                BETWEEN '$amarillo_p' AND  '$amarillo_f'
");

// actualiza los BOC de un estado a otro dependiendo la fecha
//
            $result = mysqli_num_rows($query);
            if ($result > 0) {
            
                while ($data = mysqli_fetch_array($query)) {
                    $dataBoc = $data['boc'];
                          
                    if ($data['boleta_estado_boleta_estado_id'] == 4){
                            continue;

                    }

                    $sql_update = mysqli_query($link,"UPDATE boletas 
                                                     SET boleta_estado_boleta_estado_id = '2'
                                                     WHERE boc = '$dataBoc';
                                                  ");  

                }        
            }


//de 9 o mas dias//
$pass_rojo = strtotime('-100 day', strtotime($now));
$rojo_p = date('Y-m-d', $pass_rojo);

$date_rojo = strtotime('-10 day', strtotime($now));
$rojo_f = date('Y-m-d', $date_rojo);


//
$query = mysqli_query($link, "SELECT * from boletas 
                                WHERE CAST(fecha_bol AS DATE) 
                                BETWEEN '$rojo_p' AND  '$rojo_f'
");

// actualiza los BOC de un estado a otro dependiendo la fecha
//
            $result = mysqli_num_rows($query);
            if ($result > 0) {
            
                while ($data = mysqli_fetch_array($query)) {
                    $dataBoc = $data['boc'];
                          
                    if ($data['boleta_estado_boleta_estado_id'] == 4){
                            continue;

                    }

                    $sql_update = mysqli_query($link,"UPDATE boletas 
                                                     SET boleta_estado_boleta_estado_id = '3'
                                                     WHERE boc = '$dataBoc' AND NOT boleta_estado_boleta_estado_id = '5' ;
                                                  ");            							
                }           
            }



      
