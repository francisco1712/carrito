<?php  
	  require 'conection.php';
	  /**
	   * 
	   */
	  class FuncionesCarrito{
	  	
	  	function __construct(){}

		public function eliminar($id){
			require 'conection.php';
			$eliminar=$conn->prepare('DELETE FROM productos WHERE ID=:id');
			$eliminar->bindValue('id',$id);
			$eliminar->execute();
		}
 
		}





?>