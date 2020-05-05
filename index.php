<?php
    session_start();
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
<?php
  require 'global/conection.php';
  $sentencia=$conn->prepare("SELECT * FROM productos where categoria = 'inicio'");
  $sentencia->execute();
  $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi Tienda</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/estilos.css">
  <link rel="stylesheet" href="cookies/cookiealert.css">
  <script src="cookies/cookiealert-standalone.js"></script>
</head>
<body class="bg-dark">
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
                  <li class="nav-item active">
                    <a class="nav-link" href="carrito.php" tabindex="-1" aria-disabled="true">Carrito(
                    <?php echo (empty($SESSION['CARRITO']))?0:count($SESSION['CARRITO']); ?>
                  )</a>
                </li>
                </li>
            </ul>
            <div>
              <?php if(!empty($user)): ?>
                <div class="bg-dark text-light text-center">
                  <h3> Hola de nuevo <?= $user['nombre']; ?></h3>
                  <br>Has iniciado sesión correctamente
                  <a href="global/logout.php" class="text-success">
                    Cerrar Sesión
                  </a>
                </div>  
              <?php endif; ?>
            </div>
            <div id="botones">
              <a href="global/registro.php" class="p-3 text-success"><strong>Regístrese</strong></a>
              <a href="global/login.php" class="p-3 text-success"><strong>Iniciar Sesión</strong></a>
            </div>
        </div>
    </nav>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" id="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner" id="slider">
        <div class="carousel-item active">
          <img class="d-block w-100" src="img/jefe.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="img/marcus.jpg" alt="Second slide">

        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="img/coche.jpg" alt="Third slide">

        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="img/ori.jpg" alt="Fourth slide">

        </div>
      </div>
      <a class="carousel-control-prev bg-success"  href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      </a>
      <a class="carousel-control-next bg-dark" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
      </a>
    </div>
        <div class="container">
      <h1 class="text-light text-center font-italic">Productos Destacados</h1>
      <div class="row m-2">
          <?php foreach($listaProductos as $producto){ ?>
          <div class="col-md-4 col-11 p-2">
            <img src="<?php echo $producto['Imagen'] ?>" class="img-fluid">
            <div class="bg-success p-2 rounded">
              <h4><?php echo $producto['Nombre'] ?></h4>
              <h5><?php echo $producto['Descripcion'] ?></h5>
              <p>Precio: <strong><?php echo $producto['Precio'] ?>€</strong></p>
              <form method="post" action="carrito.php">
                <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY); ?>">
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
    </div>
    <div class="row m-2 bg-success p-2">
        <div class="accordion w-100" id="accordionExample">
          <div class="card ">
              <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link text-light bg-success active" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <h3>¡Conoce al equipo!</h3>
                    </button>
                    <img src="img/equipo.png" class="img-fluid float-right">
                  </h2>
              </div>
              <div id="collapseOne" id="texto" class="collapse p-2" aria-labelledby="headingOne" data-parent="#accordionExample">
                <p>En la actualidad, Generación Xbox cuenta con un reducido equipo que hace posible la web. Sin embargo, siempre estamos en constante evolución y ninguna ayuda o talento sobra.</p><p>Nos dedicamos principalmente a la venta de consolas, videojuegos y todo lo relacionado con la marca verde y si estás interesado visita nuestra tienda con los mejores precios. Te esperamos!!</p>
              </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed text-light bg-success" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <h3>Contacta con Nosotros</h3>
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                  <select class="form-control form-control-lg" >
                <option disabled="yes">De que se trata tu petición?</option>
                <option>Sugerencia</option>
                <option>Reportar un error</option>
                <option>Necesito ayuda</option>
              </select>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon2">Email</span>
                </div>
                <input type="text" class="form-control" placeholder="Correo o nombre de usuario" aria-label="Username" aria-describedby="basic-addon2">
              </div>
              <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Descripción</span>
                  </div>
                  <textarea class="form-control" aria-label="With textarea" placeholder="Dinos tu situación"></textarea>
              </div>
              <div class="card-footer"><button type="submit" class="btn btn-success float-right">Enviar</button></div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed text-light bg-success" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <h3>De dónde es el equipo?</h3>
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12708.128083496955!2d-3.698220565166154!3d37.223214777815905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd71fe396562a841%3A0xba6ef7eda8fabb83!2s18230%20Atarfe%2C%20Granada!5e0!3m2!1sen!2ses!4v1586450556006!5m2!1sen!2ses" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" class="w-100"></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
<footer class="row w-100">
      <div class="col-12" id="social">
          <a href="https://www.facebook.com/GeneracionXbox/" target="_blank"><img src="img/facebook.png"></a>
          <a href="https://twitter.com/GeneracionXbox" target="_blank"><img src="img/twitter.png"></a>
          <a href="https://www.youtube.com/channel/UCnV9bMldetfUNkdo8N0IOyg" target="_blank"><img src="img/youtube.png"></a>
          <a href="https://mixer.com/generacionxbox" target="_blank"><img src="img/twitch.png"></a>
          <a href="https://www.instagram.com/generacionxbox/" target="_blank"><img src="img/instagram.png"></a>
      </div>
    </footer>
    <p class="text-center"><span class="text-secondary">© 2020 Copyright</span> <span class="text-white">FranciscoNavarro.com</span></p>
    <div class="alert alert-dismissible text-center cookiealert" role="alert">
      <div class="cookiealert-container">
          <b>Te gustan las galletas?</b> &#x1F36A; Usamos cookies en nuestra página web para que tengas una mejor experiencia mientras navegas <a href="http://cookiesandyou.com/" target="_blank">Más información</a>

          <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
              Estoy de acuerdo.
          </button>
      </div>
    </div>  
</html>
<script src="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.js"></script>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>