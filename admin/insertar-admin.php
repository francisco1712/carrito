<?php
    session_start();
    require '../global/../global/conection.php';
    if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, pass, nombre FROM clientes WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    if (count($results) > 0) {
      $user = $results;
    }
  }
?>
<?php
	require 'funciones-administrador.php';
	$funcion= new FuncionesCarrito();
	if (isset($_POST['insertar'])) {
		$funcion->insertar($_POST['nombre'], $_POST['precio'], $_POST['descripcion'], $_POST['url'], $_POST['categoria']);
		header('Location: /php/carrito');		
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Agregar productos</title>
	<meta charset="utf-8">
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
<body class="bg-dark">
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
                  <li class="nav-item active">
                    <a class="nav-link" href="../carrito.php" tabindex="-1" aria-disabled="true">Carrito(
                    <?php echo (empty($SESSION['user_id']))?0:count($SESSION['user_id']); ?>
                  )</a>
                </li>
                </li>
            </ul>
                <?php if($user['email'] == 'francisconavarroblanco@gmail.com'): ?> 
                  <div class="bg-dark text-light text-center">
                    <h3>Pestaña de Administración</h3>
                    <a href="administrador.php" class="text-success">Lista de productos</a>
                    <a href="insertar-admin.php" class="text-success">Agregar nuevo producto</a> 
                  </div>
                <?php endif;?>
            <div id="botones">
              <a href="../global/registro.php" class="p-3 text-success"><strong>Regístrese</strong></a>
              <a href="../global/login.php" class="p-3 text-success"><strong>Iniciar Sesión</strong></a>
            </div>
        </div>
    </nav>
    <br>
    <div class="w-100 bg-light">
	    <div class="container w-100 bg-light m-5 p-5">
	    	<h1>Formulario de inserción de productos</h1>
	    	<form method="post" action="insertar-admin.php">	
		    	<label><strong>Nombre</strong></label>
		    	<div class="input-group mb-3">
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="basic-addon1">Nombre del producto</span>
				  </div>
				  <input type="text" name="nombre" class="form-control" aria-describedby="basic-addon1">
				</div>

				<label><strong>Precio</strong></label>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
				    <span class="input-group-text">€</span>
				  </div>
				  <input type="text" name="precio" class="form-control">
				  <div class="input-group-append">
				    <span class="input-group-text">.00</span>
				  </div>
				</div>

				<label for="basic-url"><strong>Imagen del producto</strong></label>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="basic-addon3">URL de la imagen</span>
				  </div>
				  <input type="url" class="form-control" name="url" aria-describedby="basic-addon3">
				</div>
				<label><strong>Descripción</strong></label>
				<div class="input-group">
				  <div class="input-group-prepend">
				    <span class="input-group-text">Descripción del producto</span>
				  </div>
				  <textarea class="form-control" name="descripcion" aria-label="With textarea"></textarea>
				</div>
				<label><strong>Categoría</strong></label>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
				    <label class="input-group-text">Categoría</label>
				  </div>
				  <select name="categoria" class="form-control" >
				    <option selected>Elige el tipo de producto</option>
				    <option value="consolas">Consolas</option>
				    <option value="videojuegos">Videojuegos</option>
				    <option value="merch">Merchandising</option>
				    <option value="inicio">Inicio (productos para el index)</option>
				  </select>
				</div>
			  	<button class="btn btn-success mt-2" name="insertar" value="insertar" type="submit">Insertar</button>
			  </form>
			</div>
	    </div>
	</div>
    <footer class="row w-100">
      <div class="col-12" id="social">
          <a href="https://www.facebook.com/GeneracionXbox/" target="_blank"><img src="../img/facebook.png"></a>
          <a href="https://twitter.com/GeneracionXbox" target="_blank"><img src="../img/twitter.png"></a>
          <a href="https://www.youtube.com/channel/UCnV9bMldetfUNkdo8N0IOyg" target="_blank"><img src="../img/youtube.png"></a>
          <a href="https://mixer.com/generacionxbox" target="_blank"><img src="../img/twitch.png"></a>
          <a href="https://www.instagram.com/generacionxbox/" target="_blank"><img src="../img/instagram.png"></a>
      </div>
    </footer>
    <p class="text-center"><span class="text-secondary">© 2020 Copyright</span> <span class="text-white">FranciscoNavarro.com</span></p>
</body>
</html>