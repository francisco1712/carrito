<?php
    // initializ shopping cart class
    include 'global/opciones.php';
    $opciones = new opciones;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>View Cart - PHP Shopping Cart Tutorial</title>
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
    <script>
    function updateCartItem(obj,id){
        $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
    </script>
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
                <li class="nav-item active">
                    <a class="nav-link" href="carrito.php" tabindex="-1" aria-disabled="true">Carrito</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1>Tu Carrito</h1>
        <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th> </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($opciones->total_articulos() > 0){
                //get cart items from session
                $cartItems = $opciones->contents();
                foreach($cartItems as $item){
            ?>
            <tr>
                <td><?php echo $item["nombre"]; ?></td>
                <td><?php echo '$'.$item["precio"].' USD'; ?></td>
                <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
                <td><?php echo '$'.$item["subtotal"].' USD'; ?></td>
                <td>
                    <a href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="5"><p>Tu carrito está vacío.....</p></td>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td><a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Seguir Comprando</a></td>
                <td colspan="2"></td>
                <?php if($opciones->total_articulos() > 0){ ?>
                <td class="text-center"><strong>Total <?php echo '$'.$cart->total().' USD'; ?></strong></td>
                <td><a href="checkout.php" class="btn btn-success btn-block">Checkout <i class="glyphicon glyphicon-menu-right"></i></a></td>
                <?php } ?>
            </tr>
        </tfoot>
        </table>
    </div>
</body>
</html>