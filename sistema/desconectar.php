<?php
session_start();
if($_SESSION['idUser']){
	session_destroy();
	header("location: ../index.php");
}
else{
	header("location: /sistema/index.php");
}
?>