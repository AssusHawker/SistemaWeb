<?php
session_start();
include "includes/scripts.php";

include "conexion.php";


if (empty ($_POST["sap"]) || empty($_POST["ean"]) || empty($_POST["descripcion_sap"])){
 echo "Faltan Parametros";


}else{
    $sap = $_POST["sap"];
    $ean = $_POST["ean"];
    $descrip = $_POST["descripcion_sap"];
   /*
    FALTA COMPROBACION DEL SAP ANTES DE GUARDAR
   */
    $sql_update = mysqli_query($link,"UPDATE articulos
    SET sap_articulo = $sap,
     descr_articulo = '$descrip'
    WHERE  sap_articulo = $sap

");
/* falta la comprobacion de 13 digitos de codigo de barras
 y falta que en vez de agregar un barra que copmpruebe si existe antes 
 o muestre el total de codigos de barra
 
*/
$sql_update1 = mysqli_query($link,"INSERT INTO cod_barras (barra_sap,cod_barra)
VALUES ($sap,$ean)

");

echo "Registro Actualizado Correctamente";
echo " <button class=\"btn btn-success\" onclick=\"location.href='Buscar_articulos.php'\"> Volver</button>";
}
