<?php
	//CIERRA LA SESIÓN Y NOS DEVUELVE AL INDEX
  session_start();

  session_unset();

  session_destroy();

  header('Location: /php/carrito');
?>