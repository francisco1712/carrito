<?php 
    include 'global/config.php'; 
    include 'carrito.php';
?>
<?php
    require 'global/conection.php';
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
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Carrito</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
    .container{padding: 80px;}
    input[type="number"]{width: 20%;}
    </style>
</head>
</head>
<body>
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index.php"><img src="templates/logo.png"></a>
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
                    <a class="dropdown-item nav-link bg-dark" href="global/videojuegos.php">Videojuegos</a>
                    <a class="dropdown-item nav-link bg-dark" href="global/consolas.php">Consolas</a>
                    <a class="dropdown-item nav-link bg-dark" href="global/merchandising.php">Merchandising</a>
                  </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="carrito.php" tabindex="-1" aria-disabled="true">Carrito(
                    <?php echo (empty($SESSION['CARRITO']))?0:count($SESSION['CARRITO']); ?>
                  )</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1>Tu Carrito</h1>
        <?php if (!empty($_SESSION['CARRITO'])) { ?>
        <table class="table table-light table-bordered">
            <tbody>
                <tr>
                    <th width="40%">Producto</th>
                    <th width="15%" class="text-center">Cantidad</th>
                    <th width="20%" class="text-center">Precio</th>
                    <th width="20%" class="text-center">Total</th>
                    <th width="5%">---</th>
                </tr>
                <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){?>
                    <tr>
                        <th width="40%"><?php echo $producto['NOMBRE']?></th>
                        <th width="15%" class="text-center"><?php echo $producto['CANTIDAD']?></th>
                        <th width="20%" class="text-center"><?php echo $producto['PRECIO']?></th>
                        <th width="20%" class="text-center"><?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],2) ; ?></th>
                        <th width="5%"><button class="btn btn-danger" type="button">Eliminar</button></th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php }else{ ?>
        <div class="alert alert-success">
            El carrito está vacío.
        </div>
        <?php }?> 
    </div>
</body>
</html>