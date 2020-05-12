<?php
    if (isset($_POST['btnaccion'])) {
        # code...
        //ACCIONES DE LOS BOTONES
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
                    //SI NO HAY UNA SESIÓNN INICIADA EL CARRITO NO GUARDA LOS PRODUCTOS SELECCIONADOS ANTES
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
                        //SI TIENE LA SESION INICIADA SUMA LOS PRODUCTOS AGREGADOS AL CARRITO
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