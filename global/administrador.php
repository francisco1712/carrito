<?php
  require 'conection.php';
  $sentencia=$conn->prepare("SELECT * FROM productos");
  $sentencia->execute();
  $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
	require 'funciones-administrador.php';
	$funcion= new FuncionesCarrito();
	if (isset($_POST['eliminar'])) {
		$funcion->eliminar($_POST['id']);
		header('Location: /php/carrito');		
	// si la variable accion enviada por GET es == 'a', envía a la página actualizar.php 
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Pantalla de Administración</title>
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
                  <li class="nav-item active">
                    <a class="nav-link" href="carrito.php" tabindex="-1" aria-disabled="true">Carrito(
                    <?php echo (empty($SESSION['CARRITO']))?0:count($SESSION['CARRITO']); ?>
                  )</a>
                </li>
                </li>
            </ul>
            <div id="botones">
              <a href="registro.php" class="p-3 text-success"><strong>Regístrese</strong></a>
              <a href="login.php" class="p-3 text-success"><strong>Iniciar Sesión</strong></a>
            </div>
        </div>
    </nav>
    <br>
    <div class="w-100 bg-light">
    	<div class="container m-5 bg-light">
    	<h1>Productos</h1>
		<table class="table-bordered">
			<tbody>
				<tr>
					<th width="10%">ID</th>
					<th width="10%">Nombre</th>
					<th width="30%">Descripción</th>
					<th width="10%">Precio</th>
					<th width="20%">Imagen</th>
					<th width="10%">Categoría</th>
					<th width="10%">--</th>
				</tr>
				<?php foreach($listaProductos as $producto){?>	
					<tr>
						<td width="10%"><?php echo $producto['ID'] ?></td>
						<td width="10%"><?php echo $producto['Nombre'] ?></td>
						<td width="30%"><?php echo $producto['Descripcion'] ?></td>
						<td width="10%"><?php echo $producto['Precio'] ?>€</td>
						<td width="20%"><img src="<?php echo $producto['Imagen'] ?>" class="img-fluid"></td>
						<td width="10%"><?php echo $producto['categoria'] ?></td>
						<td width="10%">
							<form method="post" action="administrador.php">
								<input type="hidden" name="id" value="<?php echo $producto['ID'] ?>">
								<button class="btn btn-danger mt-2" name="eliminar" value="Eliminar" type="submit">Eliminar</button>
							</form>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
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