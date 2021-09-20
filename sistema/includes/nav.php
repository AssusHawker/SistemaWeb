<?php 
             require_once "setStatusBoc.php";
             $rojo = color("rojo");
             $amarillo = color("amarillo");
             $verde = color("verde");
?>
<script src="js/jquery-3.6.0.min.js "></script>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Buscar</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">


      <li class="nav-item dropdown ml-2 pl-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Boc
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="SetBoc.php"><i class="far fa-clone"></i> Cargar Boc</a>
         
         

        </div>
      </li>




      <li class="nav-item dropdown ml-2 pl-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Articulos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="Buscar_articulos.php"><i class="fas fa-search"></i>  Buscar Articulo</a>
          <a class="dropdown-item" href="editar_articulo.php"><i class="fas fa-edit"></i>  Editar Articulo</a>
          <a class="dropdown-item" href="carga_articulos.php"><i class="far fa-plus-square"></i>  Cargar Articulo Nuevo</a>
          
        
          
        </div>
      </li>







      <?php
      if (($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3)) {  ?>
        <li class="nav-item dropdown ml-2 pl-2">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Jefes
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="registro_usuario.php"><i class="fas fa-user-plus"></i> Registrar Usuarios</a>




          </div>
        </li>
      <?php } ?>

      <li class="nav-item dropdown ml-2 pl-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dashboard
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="registro_usuario.php"><i class="fas fa-user-plus"></i> Ejemplo</a>

          <?php
          if ($_SESSION['rol'] == 2) {  ?>



          <?php }   ?>

    </ul>
            
   

    <ul class="navbar-nav">
      <li class="nav-item dropdown  ml-2 pl-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['nombre'] . "-" . $_SESSION['apellido']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

          <a class="dropdown-item" href="usuarios-pw.php">Editar Usuario</a>
        </div>
      </li>
    </ul>

  </div>
   <!-- inicio botones -->
   <div class="m-2">
      <button type="button" onclick=location.href="listarBoc.php?color=rojo" class="btn btn-danger ml-1">
       Rojo <span class="badge bg-secondary"><?php echo $rojo ;?></span>
      </button>
      <button type="button" onclick=location.href="listarBoc.php?color=amarillo" class="btn btn-warning">
        Amarillo <span class="badge bg-secondary"><?php echo $amarillo ;?></span>
      </button>
      <button type="button" onclick=location.href="listarBoc.php?color=verde" class="btn btn-success">
        Verde <span class="badge bg-secondary"><?php echo $verde ;?></span>
      </button>
    </div>

    <!-- fin botones -->
</nav>