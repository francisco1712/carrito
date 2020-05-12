<?php  
	  require '../global/conection.php';
	  /**
	   * 
	   */
	  class FuncionesCarrito{
	  	
	  	function __construct(){}

		public function eliminar($id){
			require '../global/conection.php';
			$eliminar=$conn->prepare('DELETE FROM productos WHERE ID=:id');
			$eliminar->bindValue('id',$id);
			$eliminar->execute();
		}

		public function insertar($nombre, $precio, $descripcion, $imagen, $categoria){
			require '../global/conection.php';
			$insertar=$conn->prepare('INSERT INTO productos values(NULL,:nombre,:precio,:descripcion,:imagen,:categoria)');
			$insertar->bindValue('nombre',$nombre);
			$insertar->bindValue('precio',$precio);
			$insertar->bindValue('descripcion',$descripcion);
			$insertar->bindValue('imagen',$imagen);
			$insertar->bindValue('categoria',$categoria);
			$insertar->execute();

		}
 
		}





?>