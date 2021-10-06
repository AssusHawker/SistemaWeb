<?php
$mensaje = "<span class='badge bg-danger'> El articulo no existe en la base de datos, por favor verifique el producto .</span>";
$mensaje_exede = "<span class='badge bg-danger'> EL NUMERO INGRESADO TIENE DEMASIADOS DIGITOS</span>";
$msg3 = "<span class='badge bg-danger'>Error al comprobar la descripcion del producto</span>";
$mensajeBoc = "<span class='badge '>ERROR - BOC EXISTENTE</span>";

require_once("DBController.php");
$db_handle = new DBController();
include "conexion.php";
require_once "includes/functions.php";


//CONSULTO BOC 
/**
 * funcion consultarBoc() Boleano 
 */

if (!empty($_POST["boc"])){
  $resultado =consultarBoc($_POST["boc"]);
  if($resultado == 1){
      echo "<span class=\"badge bg-secondary\">";
      echo  $mensajeBoc;
      echo "</span>";
      echo "<script>
                      var botonEnviar = document.getElementById('boton');
					            botonEnviar.disabled = true;
            </script>";
 
   
}
}

//comprobacion de BARRA y SAP con AJAX//
///CODIGO 1//
if (!empty($_POST["sap1"])) {

   ///////codigo 1 por barra
  $CuentaSap1 = strlen($_POST['sap1']); //compruebo los 13 caracteres/
  $barra1 = $_POST['sap1'];
  if ($CuentaSap1 == 13) {
    $query = mysqli_query($link, "SELECT  
			                  			    	articulos.sap_articulo,
			                  		        articulos.descr_articulo,
			                  		        cod_barras.cod_barra
			                  	          	FROM     cod_barras 
			                  	          	INNER JOIN articulos  ON cod_barras.barra_sap = articulos.sap_articulo
			                  	          	WHERE cod_barra = '$barra1'");


    $result = mysqli_num_rows($query);
    //// Enable o Disable al boton enviar si no cumple con el Barra
    if ($result > 0) {
      $data = mysqli_fetch_array($query);
      echo "<span class=\"badge bg-secondary\">";
      echo $data["descr_articulo"];
      echo "</span>";
      echo "<script>
                                     let botonEnviar = document.getElementById('boton');
					                            botonEnviar.disabled = false;
                                      
					                           </script>";
    } else {
      echo $msg3;
      echo "<script>
					                              let botonEnviar = document.getElementById('boton');
					                              botonEnviar.disabled = true;
                                        
					                              </script>";
    }
    //////////
  }
  ///////codigo 1 por sap
  if ($CuentaSap1 < 13) {
    
    $query = "SELECT * FROM articulos WHERE sap_articulo='" . $_POST["sap1"] . "'";
    $result = $link->query("SELECT * FROM articulos WHERE sap_articulo='" . $_POST["sap1"] . "'");

    $user_count = $db_handle->numRows($query);
    
    $row = $result->fetch_object();
    
    //// Enable o Disable al boton enviar si no cumple con el SAP
   
    if ($user_count > 0) {
      echo "<span class=\"badge bg-secondary\">";
      echo "$row->descr_articulo<br>";
      echo "</span>";
      echo "<script>					
					          let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = false;     
                               
					          </script>";
    } else {

      echo $mensaje;
      echo "<script>
										let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = true;
					          </script>";
    }
  }
  if ($CuentaSap1 > 13) {
    echo $mensaje_exede;
    echo "<script>
										let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = true;
					          </script>";
  }
  //////////

}
//////FIN DE LA COMPROBACION////



///comprobacion de BARRA y SAP con AJAX//
///CODIGO 2//
if (!empty($_POST["sap2"])) {


  ///////codigo 2 por barra
  $CuentaSap2 = strlen($_POST['sap2']); //compruebo los 13 caracteres/
  $barra2 = $_POST['sap2'];
  if ($CuentaSap2 == 13) {
    $query = mysqli_query($link, "SELECT  
                        articulos.sap_articulo,
                        articulos.descr_articulo,
                        cod_barras.cod_barra
                          FROM     cod_barras 
                          INNER JOIN articulos  ON cod_barras.barra_sap = articulos.sap_articulo
                          WHERE cod_barra = '$barra2'");


    $result = mysqli_num_rows($query);
    //// Enable o Disable al boton enviar si no cumple con el Barra
    if ($result > 0) {
      $data = mysqli_fetch_array($query);
      echo "<span class=\"badge bg-secondary\">";
      
      echo $data["descr_articulo"];
      echo "</span>";
      echo "
                        <script>

                          let botonEnviar = document.getElementById('boton');
                          botonEnviar.disabled = false;

                          </script>


                        ";
    } else {
      echo $msg3;
      echo "
                          <script>

                            let botonEnviar = document.getElementById('boton');
                            botonEnviar.disabled = true;

                            </script>


                          ";
    }
    ////////////////////////////////////////////////////////////  

  }
  ///////codigo 2 por sap
  if ($CuentaSap2 < 13) {
    $query = "SELECT * FROM articulos WHERE sap_articulo='" . $_POST["sap2"] . "'";
    $result = $link->query("SELECT * FROM articulos WHERE sap_articulo='" . $_POST["sap2"] . "'");

    $user_count = $db_handle->numRows($query);
    $row = $result->fetch_object();
    //// Enable o Disable al boton enviar si no cumple con el SAP
    if ($user_count > 0) {
      echo "<span class=\"badge bg-secondary\">";
      echo "$row->descr_articulo<br>";
      echo "</span>";
      echo "<script>					
					          let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = false;                       
					          </script>";
    } else {

      echo $mensaje;
      echo "<script>
										let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = true;
					          </script>";
    }
  }
  if ($CuentaSap2> 13) {
    echo $mensaje_exede;
    echo "<script>
										let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = true;
					          </script>";
  }
  //////////

}
//////FIN DE LA COMPROBACION////



///comprobacion de BARRA y SAP con AJAX//
///CODIGO 3//
if (!empty($_POST["sap3"])) {


  ///////codigo 3 por barra
  $CuentaSap3 = strlen($_POST['sap3']); //compruebo los 13 caracteres/
  $barra3 = $_POST['sap3'];
  if ($CuentaSap3 == 13) {
    $query = mysqli_query($link, "SELECT  
                        articulos.sap_articulo,
                        articulos.descr_articulo,
                        cod_barras.cod_barra
                          FROM     cod_barras 
                          INNER JOIN articulos  ON cod_barras.barra_sap = articulos.sap_articulo
                          WHERE cod_barra = '$barra3'");


    $result = mysqli_num_rows($query);
    //// Enable o Disable al boton enviar si no cumple con el Barra
    if ($result > 0) {
      $data = mysqli_fetch_array($query);
      echo "<span class=\"badge bg-secondary\">";
      echo $data["descr_articulo"];
      echo "</span>";
      echo "
                        <script>

                          let botonEnviar = document.getElementById('boton');
                          botonEnviar.disabled = false;

                          </script>


                        ";
    } else {
      echo $msg3;
      echo "
                          <script>

                            let botonEnviar = document.getElementById('boton');
                            botonEnviar.disabled = true;

                            </script>


                          ";
    }
    ////////////////////////////////////////////////////////////  
  }
  ///////codigo 3 por sap
  if ($CuentaSap3 < 13) {
    $query = "SELECT * FROM articulos WHERE sap_articulo='" . $_POST["sap3"] . "'";
    $result = $link->query("SELECT * FROM articulos WHERE sap_articulo='" . $_POST["sap3"] . "'");

    $user_count = $db_handle->numRows($query);
    $row = $result->fetch_object();
    //// Enable o Disable al boton enviar si no cumple con el SAP
    if ($user_count > 0) {
      echo "<span class=\"badge bg-secondary\">";
      echo "$row->descr_articulo<br>";
      echo "</span>";
      echo "<script>					
					          let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = false;                       
					          </script>";
    } else {

      echo $mensaje;
      echo "<script>
										let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = true;
					          </script>";
    }
  }
  if ($CuentaSap3 > 13) {
    echo $mensaje_exede;
    echo "<script>
										let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = true;
					          </script>";
  }
  //////////

}
//////FIN DE LA COMPROBACION////


///comprobacion de BARRA y SAP con AJAX//
///CODIGO 4//

if (!empty($_POST["sap4"])) {


  ///////codigo 4 por barra
  $CuentaSap4 = strlen($_POST['sap4']); //compruebo los 13 caracteres/
  $barra4 = $_POST['sap4'];
  if ($CuentaSap4 == 13) {
    $query = mysqli_query($link, "SELECT  
                        articulos.sap_articulo,
                        articulos.descr_articulo,
                        cod_barras.cod_barra
                          FROM     cod_barras 
                          INNER JOIN articulos  ON cod_barras.barra_sap = articulos.sap_articulo
                          WHERE cod_barra = '$barra4'");


    $result = mysqli_num_rows($query);
    //// Enable o Disable al boton enviar si no cumple con el Barra
    if ($result > 0) {
      $data = mysqli_fetch_array($query);
      echo "<span class=\"badge bg-secondary\">";
      echo $data["descr_articulo"];
      echo "</span>";
      echo "<script>

                        let botonEnviar = document.getElementById('boton');
                        botonEnviar.disabled = false;

                        </script>";
    } else {
      echo $msg3;
      echo "
                        <script>

                          let botonEnviar = document.getElementById('boton');
                          botonEnviar.disabled = true;

                          </script>


                        ";
    }
    ////////////////////////////////////////////////////////////  
  }
  ///////codigo 4 por sap
  if ($CuentaSap4 < 13) {
    $query = "SELECT * FROM articulos WHERE sap_articulo='" . $_POST["sap4"] . "'";
    $result = $link->query("SELECT * FROM articulos WHERE sap_articulo='" . $_POST["sap4"] . "'");

    $user_count = $db_handle->numRows($query);
    $row = $result->fetch_object();
    //// Enable o Disable al boton enviar si no cumple con el SAP
    if ($user_count > 0) {
      echo "<span class=\"badge bg-secondary\">";
      echo "$row->descr_articulo<br>";
      echo "</span>";
      echo "<script>					
					          let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = false;                       
					          </script>";
    } else {

      echo $mensaje;
      echo "<script>
										let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = true;
					          </script>";
    }
  }
  if ($CuentaSap4 > 13) {
    echo $mensaje_exede;
    echo "<script>
										let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = true;
					          </script>";
  }
  //////////

}
//////FIN DE LA COMPROBACION////

///comprobacion de BARRA y SAP con AJAX//
///CODIGO 5//

if (!empty($_POST["sap5"])) {


  ///////codigo 5 por barra
  $CuentaSap5 = strlen($_POST['sap5']); //compruebo los 13 caracteres/
  $barra5 = $_POST['sap5'];
  if ($CuentaSap5 == 13) {
    $query = mysqli_query($link, "SELECT  
                        articulos.sap_articulo,
                        articulos.descr_articulo,
                        cod_barras.cod_barra
                          FROM     cod_barras 
                          INNER JOIN articulos  ON cod_barras.barra_sap = articulos.sap_articulo
                          WHERE cod_barra = '$barra5'");


    $result = mysqli_num_rows($query);
    //// Enable o Disable al boton enviar si no cumple con el Barra
    if ($result > 0) {
      $data = mysqli_fetch_array($query);
      echo "<span class=\"badge bg-secondary\">";
      echo $data["descr_articulo"];
      echo "</span>";
      echo "
                      <script>

                        let botonEnviar = document.getElementById('boton');
                        botonEnviar.disabled = false;

                        </script>


                      ";
    } else {
      echo $msg3;
      echo "
                        <script>

                          let botonEnviar = document.getElementById('boton');
                          botonEnviar.disabled = true;

                          </script>


                        ";
    }
    ////////////////////////////////////////////////////////////  
    //////////
  }
  ///////codigo 5 por sap
  if ($CuentaSap5 < 13) {
    $query = "SELECT * FROM articulos WHERE sap_articulo='" . $_POST["sap5"] . "'";
    $result = $link->query("SELECT * FROM articulos WHERE sap_articulo='" . $_POST["sap5"] . "'");

    $user_count = $db_handle->numRows($query);
    $row = $result->fetch_object();
    //// Enable o Disable al boton enviar si no cumple con el SAP
    if ($user_count > 0) {
      echo "<span class=\"badge bg-secondary\">";
      echo "$row->descr_articulo<br>";
      echo "</span>";
      echo "<script>					
					          let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = false;                       
					          </script>";
    } else {

      echo $mensaje;
      echo "<script>
										let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = true;
					          </script>";
    }
  }
  if ($CuentaSap5 > 13) {
    echo $mensaje_exede;
    echo "<script>
										let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = true;
					          </script>";
  }
  //////////

}
//////FIN DE LA COMPROBACION////





///comprobacion de BARRA y SAP con AJAX//
///CODIGO 6//

if (!empty($_POST["sap6"])) {


  ///////codigo 6 por barra
  $CuentaSap6 = strlen($_POST['sap6']); //compruebo los 13 caracteres/
  $barra6 = $_POST['sap6'];
  if ($CuentaSap6 == 13) {
    $query = mysqli_query($link, "SELECT  
                        articulos.sap_articulo,
                        articulos.descr_articulo,
                        cod_barras.cod_barra
                          FROM     cod_barras 
                          INNER JOIN articulos  ON cod_barras.barra_sap = articulos.sap_articulo
                          WHERE cod_barra = '$barra6'");


    $result = mysqli_num_rows($query);
    //// Enable o Disable al boton enviar si no cumple con el Barra
    if ($result > 0) {
      $data = mysqli_fetch_array($query);
      echo "<span class=\"badge bg-secondary\">";
      echo $data["descr_articulo"];
      echo "</span>";
      echo "
                        <script>

                          let botonEnviar = document.getElementById('boton');
                          botonEnviar.disabled = false;

                          </script>


                        ";
    } else {
      echo $msg3;
      echo "
                          <script>

                            let botonEnviar = document.getElementById('boton');
                            botonEnviar.disabled = true;

                            </script>


                          ";
    }
    ////////////////////////////////////////////////////////////  
  }
  ///////codigo 6 por sap
  if ($CuentaSap6 < 13) {
    $query = "SELECT * FROM articulos WHERE sap_articulo='" . $_POST["sap6"] . "'";
    $result = $link->query("SELECT * FROM articulos WHERE sap_articulo='" . $_POST["sap6"] . "'");

    $user_count = $db_handle->numRows($query);
    $row = $result->fetch_object();
    //// Enable o Disable al boton enviar si no cumple con el SAP
    if ($user_count > 0) {
      echo "<span class=\"badge bg-secondary\">";
      echo "$row->descr_articulo<br>";
      echo "</span>";
      echo "<script>					
					          let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = false;                       
					          </script>";
    } else {

      echo $mensaje;
      echo "<script>
										let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = true;
					          </script>";
    }
  }
  if ($CuentaSap6 > 13) {
    echo $mensaje_exede;
    echo "<script>
										let botonEnviar = document.getElementById('boton');
					          botonEnviar.disabled = true;
					          </script>";
  }
  //////////

}
//////FIN DE LA COMPROBACION////
