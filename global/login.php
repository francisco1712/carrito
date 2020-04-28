<?php
 
  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php/carrito');
  }
  require 'conection.php';

  if (!empty($_POST['email']) && !empty($_POST['pass'])) {
    $records = $conn->prepare('SELECT id, email, pass, nombre FROM clientes WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';
    if (!empty($results) > 0 && password_verify($_POST['pass'], $results['pass'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /php/carrito");
    } else {
      $message = 'Lo siento, las credenciales no son correctas';
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inicio de sesión</title>
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
		background-image: url('../img/marcus.jpg');
		width: 100%;
	}

</style>
<body>
	<div class="bg-dark text-light text-center p-3">
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
	</div>
	<div class="text-center">
		<?php if(!empty($message)): ?>
      		<p class="bg-dark text-light"> <?= $message ?></p>
    	<?php endif; ?>
	</div>
	<div class="form w-100" id="login" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-success text-dark">
					<h5 class="modal-title" id="login">Inicia sesión</h5>
				</div>
				<div class="modal-body bg-dark text-success">
					<form action="login.php" method="post">
						<div class="form-group">
							<label for="login">Email</label>
							<input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Introduce tu email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required="yes">
						</div>
						<div class="form-group">
							<label for="login">Contraseña</label>
								<input name="pass" type="password" class="form-control" placeholder="Introduce tu contraseña" minlength="8" required="yes">
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success text-dark">Enviar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
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