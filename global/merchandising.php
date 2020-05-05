<?php
    session_start();
    require 'conection.php';
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
	require 'conection.php';
	$sentencia=$conn->prepare("SELECT * FROM productos where categoria = 'merch'");
	$sentencia->execute();
	$listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Merchandising</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mi Tienda</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<style type="text/css">
</style>
<body class="bg-dark">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="../index.php"><img src="../templates/logo.png"></a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown show">
                  <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Tienda</a>
                  <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item nav-link bg-dark" href="videojuegos.php">Videojuegos</a>
                    <a class="dropdown-item nav-link bg-dark" href="consolas.php">Consolas</a>
                    <a class="dropdown-item nav-link bg-dark" href="merchandising.php">Merchandising</a>
                  </div>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="../carrito.php" tabindex="-1" aria-disabled="true">Carrito(
                    <?php echo (empty($SESSION['CARRITO']))?0:count($SESSION['CARRITO']); ?>
                  )</a>
                </li>
            </ul>
            <div>
              <?php if(!empty($user)): ?>
                <div class="bg-dark text-light text-center">
                  <h3> Hola de nuevo <?= $user['nombre']; ?></h3>
                  <br>Has iniciado sesión correctamente
                  <a href="logout.php" class="text-success">
                    Cerrar Sesión
                  </a>
                </div>  
              <?php endif; ?>
            </div>
            <div id="botones">
              <a href="registro.php" class="p-3 text-success"><strong>Regístrese</strong></a>
              <a href="login.php" class="p-3 text-success"><strong>Iniciar Sesión</strong></a>
            </div>
        </div>
    </nav>
    	<div id="carouselExampleIndicators" class="carousel slide bg-light" data-ride="carousel" id="carousel">
	      <div class="carousel-inner" id="slider">
	        <div class="carousel-item active">
	          	<img class="d-block w-50 h-50 m-auto" src="../img/productos/merch/funko-jefe.jpg" alt="First slide">
	        </div>
	        <div class="carousel-item">
	          <img class="d-block w-50 h-50 m-auto" src="../img/productos/merch/mochila.jpg" alt="Second slide">
	        </div>
	        <div class="carousel-item">
	          <img class="d-block w-50 h-50 m-auto" src="../img/productos/merch/figura-marcus.jpg" alt="Third slide">
	        </div>
	      </div>
	      <a class="carousel-control-prev bg-success"  href="#carouselExampleIndicators" role="button" data-slide="prev">
	        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	      </a>
	      <a class="carousel-control-next bg-dark" href="#carouselExampleIndicators" role="button" data-slide="next">
	        <span class="carousel-control-next-icon" aria-hidden="true"></span>
	      </a>
    	</div>
    	<h1 class="text-light text-center font-italic">Una figura de tu juego favorito siempre alegra el día</h1>
    		<div class="row m-2">
	    		<?php foreach($listaProductos as $producto){ ?>
					<div class="col-md-4 col-11 p-2">
						<img src="<?php echo $producto['Imagen'] ?>" class="img-fluid">
						<div class="bg-success p-2 rounded">
							<h4><?php echo $producto['Nombre'] ?></h4>
							<h5><?php echo $producto['Descripcion'] ?></h5>
							<p>Precio: <strong><?php echo $producto['Precio'] ?>€</strong></p>
							<form method="post" action="../carrito.php">
								<input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id_Productos'],COD,KEY); ?>">
								<input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'],COD,KEY); ?>">
								<input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'],COD,KEY); ?>">
								<input type="hidden" name="categoria" id="Categoria" value="<?php echo openssl_encrypt($producto['Categoria'],COD,KEY); ?>">
								<label>Cantidad: </label>
								<input type="number" name="cantidad" id="cantidad" min="1" max="10" size="1" required value="1">
								<br>
								<button class="btn btn-dark mt-2" name="btnaccion" value="Agregar" type="submit">Añadir a la cesta </button>
							</form>
						</div> 
					</div>
				<?php } ?>
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