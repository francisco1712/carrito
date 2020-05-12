<?php

  require 'conection.php';

  $message = '';
  //SI LOS VALORES NO SON NULOS, INGRESA EL NUEVO USUARIO EN LA BASE DE DATOS
  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nombre'])) {
    $sql = "INSERT INTO clientes (email, pass, nombre) VALUES (:email, :password, :nombre)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    //CUANDO EJECUTA LA INSERCIÓN DEL USUARIO MUESTRA UN MENSAJE, SINO MUESTRA OTRO DE ERROR
    if ($stmt->execute()) {
      $message = 'Nuevo usuario creado con éxito';
    } else {
      $message = 'Ha habido algún error en la creación del usuario';
    }
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Registro</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
</head>
<style type="text/css">
	body{
		background-image: url('../img/jefe.jpg');
		width: 100%;
	}
</style>
<body>
	 <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="../index.php"><img src="../templates/logo.png"></a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="../index.php">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown show">
                  <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Tienda</a>
                  <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item nav-link bg-dark" href="../global/videojuegos.php">Videojuegos</a>
                    <a class="dropdown-item nav-link bg-dark" href="../global/consolas.php">Consolas</a>
                    <a class="dropdown-item nav-link bg-dark" href="../global/merchandising.php">Merchandising</a>
                  </div>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="../carrito.php" tabindex="-1" aria-disabled="true">Carrito</a>
                </li>
            </ul>
            <div id="botones">
              <a href="../global/registro.php" class="p-3 text-success"><strong>Regístrese</strong></a>
              <a href="../global/login.php" class="p-3 text-success"><strong>Iniciar Sesión</strong></a>
            </div>
        </div>
        
    </nav>
	<div class="row w-100">
		<!-- Modal -->
		<form action="registro.php" method="post" class="m-auto">
			<div class="form w-100 col-12" id="registro" tabindex="-1" role="dialog" aria-labelledby="registro" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
				   	<div class="modal-content">
				      	<div class="modal-header bg-success text-dark">
				        	<h5 class="modal-title" id="registro">Regístrese</h5>
				      	</div>
				    	<div class="modal-body bg-dark text-success">
				      		<form class="needs-validation" novalidate>
				      			<div class="form-group">
				      				<label for="registro">Nombre</label>
				      				<input name="nombre" type="name" class="form-control" id="registro" placeholder="Introduce tu nombre" required="yes">
				      			</div>
				      			<div class="form-group">
				      				<label for="registro">Apellidos</label>
				      				<input name="apellido" type="name" class="form-control" id="registro" placeholder="Introduce tus apellidos" required="yes">
				      			</div>
				        		<div class="form-group">
								    <label for="registro">Email</label>
								    <input name="email" type="email" class="form-control" id="registro" aria-describedby="emailHelp" placeholder="Introduce tu email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required="yes">
								</div>
								<div class="form-group">
								    <label for="registro">Contraseña</label>
								    <input name="password" type="password" class="form-control" id="registro" placeholder="Introduce tu contraseña" minlength="8" required="yes">
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-success text-dark">Únete!!</button>
								</div>
				    		</form>
				    		<div class="text-center">
								<?php if(!empty($message)): //MENSAJE DE CONFIRMACIÓN DEL NUEVO USUARIO?>
						      		<p class="text-light bg-dark"> <?= $message ?></p>
						    	<?php endif; ?>
							</div>
				  		</div>
					</div>
				</div>
			</div>
		</form>
	</div>		
</body>
<footer class="row m-0 bg-dark">
      <div class="col-12 w-100" id="social">
          <a href="https://www.facebook.com/GeneracionXbox/" target="_blank"><img src="../img/facebook.png"></a>
          <a href="https://twitter.com/GeneracionXbox" target="_blank"><img src="../img/twitter.png"></a>
          <a href="https://www.youtube.com/channel/UCnV9bMldetfUNkdo8N0IOyg" target="_blank"><img src="../img/youtube.png"></a>
          <a href="https://mixer.com/generacionxbox" target="_blank"><img src="../img/twitch.png"></a>
          <a href="https://www.instagram.com/generacionxbox/" target="_blank"><img src="../img/instagram.png"></a>
      </div>
      <p class="col-12 bg-dark"><span class="text-secondary">© 2020 Copyright</span> <span class="text-white">FranciscoNavarro.com</span></p>
</footer>
    
</html>