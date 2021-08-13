<?php

if (empty($_SESSION['active'])) {
	header('location: ../');
}

?>
<header>
	<div class="container-fluid" style="background: #294389 ; height: 50px; ">
		<div class="row">
			<div class="col-4 mt-2 mb-2">
				<h3 style="color:white;">Sistema Web  <i class="fas fa-tools"></i></h3>
			</div>
			<div class="col-4 mt-3 mb-2">
				<h6 style="color:#ffffff;"> <?php 
				$DateAndTime = date('m/d/Y h:i a', time());
				echo "$DateAndTime";
				
				?></h6>

			</div>

			<div class="mt-3 mb-2 col" style="float: right;">
										
				<a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir del Sistema"></a>
			</div>

		</div>
	</div>

	<?php
	include "includes/autoLoad.php";
	include "nav.php";
	 ?>
</header>