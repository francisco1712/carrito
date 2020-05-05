<?php
    if (isset($_POST['btnaccion'])) {
        # code...
        switch ($_POST['btnaccion']) {
            case 'Agregar':
                # code...
                    //desencriptamos los valores de los productos
                    if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                        $ID=openssl_decrypt($_POST['id'],COD,KEY);

                    }
                    if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
                        $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);
                    }
                    if(is_numeric(openssl_decrypt($_POST['precio'],COD,KEY))){
                        $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);

                    }if(is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY))){
                        $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY);

                    }

                    if (!isset($SESSION['CARRITO'])) {
                         # code...
                        $producto=array(
                            'ID'=>$ID,
                            'NOMBRE'=>$NOMBRE,
                            'PRECIO'=>$PRECIO,
                            'CANTIDAD'=>$CANTIDAD
                        );
                        $SESSION['CARRITO'][0]=$producto;
                     }else{
                        $NumeroProductos=count($SESSION['CARRITO']);
                        $producto=array(
                            'ID'=>$ID,
                            'NOMBRE'=>$NOMBRE,
                            'PRECIO'=>$PRECIO,
                            'CANTIDAD'=>$CANTIDAD
                        );
                        $SESSION['CARRITO'][$NumeroProductos]=$producto;
                     } 
            break;
        }
    }
?>