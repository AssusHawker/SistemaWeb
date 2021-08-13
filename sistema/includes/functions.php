<?php 

/* uso imagen(numero de sap)
funcion que devuelve por return la direccion de la imagen
si la imagen no existe la busca en el servidor de easy y la baja para el posterior uso
si la imagen existe en el directorio la mustra
si no existe imagen muestra imagen generica de error
*/
	function imagen($sap){
		require "conexion.php";
				
		$sapImg = 'img-sap/' . $sap;
		if (file_exists($sapImg)) {
			return $sapImg;
		} else {
	
			if (imgUrl('https://media.easy.com.ar/is/image/EasyArg/' . $sap)) {
	
	
				$path = 'img-sap/' . $sap;
				$url = "https://media.easy.com.ar/is/image/EasyArg/" . $sap;
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
				$data = curl_exec($ch);
	
				curl_close($ch);
	
				file_put_contents($path, $data);
				return "https://media.easy.com.ar/is/image/EasyArg/" . $sap;
			} else {
	
				return 'img/error.png';
			}
		}
		
	}
	
/*
funcion 2 para la funcion imagen($sap) para poder bajar la imagen del sitio web


*/
function imgUrl($url)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_NOBODY, 1);
			curl_setopt($ch, CURLOPT_FAILONERROR, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			if (curl_exec($ch) !== FALSE) {
				return true;
			} else {
				return false;
			}
		}


/*
funcion  de llamar a la descripcion del producto pasando el sap parametro
USO descripcion($sap);
*/
function descripcion($sap){
	include "conexion.php";
    $query = mysqli_query($link, "SELECT  articulos.descr_articulo, articulos.sap_articulo
								FROM  articulos 
								WHERE articulos.sap_articulo = $sap");
	$result = mysqli_num_rows($query);
	if ($result > 0) {
		$data = mysqli_fetch_array($query);
		$sap_desc = $data["descr_articulo"];
		return $sap_desc;
	}else{
		return "Se produjo un error al comprobar la descripcion del producto";
	}
	
}

//
function consultar_ean($sap){
	include "conexion.php";
    $query = mysqli_query($link, "SELECT  cod_barra
								FROM  cod_barras 
								WHERE barra_sap = $sap");
	$result = mysqli_num_rows($query);
	if ($result > 0) {
		$data = mysqli_fetch_array($query);
		$ean = $data["cod_barra"];
		return $ean;
	}else{
		return "Se produjo un error al comprobar el EAN del producto";
	}
	
}

function consultarBoc($boc){
	include "conexion.php";
	$query = mysqli_query($link, "SELECT boc
									FROM `boletas`
									WHERE `boc` = $boc");

$result = mysqli_num_rows($query);
	return $result;


}

//fecha
function FechaNueva($originalDate)
{

	$newDate = date("d/m/Y H:i:s", strtotime($originalDate));
	return $newDate;
}

