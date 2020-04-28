<?php session_start();
class opciones {
    protected $contenido_lista = array();
    
    public function __construct(){
        // Obtiene el carrito de la sesion
        $this->contenido_lista = !empty($_SESSION['contenido_lista'])?$_SESSION['contenido_lista']:NULL;
        if ($this->contenido_lista === NULL){
            $this->contenido_lista = array('total_lista' => 0, 'total_articulos' => 0);
        }
    }
    
    /**
     * Devuelve el carrito entero
     * @param    bool
     * @return    array
     */
    public function contenido(){
        // Devuelve el contenido del carrito en forma de array
        $lista = array_reverse($this->contenido_lista);

        unset($lista['total_articulos']);
        unset($lista['total_lista']);

        return $lista;
    }
    
    /**
     * Devuelve un articulo en especifico
     * @param    string    $row_id
     * @return    array
     */
    public function get_item($row_id){
        return (in_array($row_id, array('total_articulos', 'total_lista'), TRUE) OR ! isset($this->contenido_lista[$row_id]))
            ? FALSE
            : $this->contenido_lista[$row_id];
    }
    
    /**
     * Devuelve el total de articulos
     * @return    int
     */
    public function total_articulos(){
        return $this->contenido_lista['total_articulos'];
    }
    
    /**
     * Devuelve el precio total
     * @return    int
     */
    public function total(){
        return $this->contenido_lista['total_lista'];
    }
    
    /**
     * Inserta articulos dentro del carrito y los guarda en la sesion
     * @param    array
     * @return    bool
     */
    public function insert($item = array()){
        if(!is_array($item) OR count($item) === 0){
            return FALSE;
        }else{
            if(!isset($item['id'], $item['nombre'], $item['precio'], $item['cantidad'])){
                return FALSE;
            }else{
                /*
                 * Inserta Articulo
                 */
                $item['cantidad'] = (float) $item['cantidad'];
                if($item['cantidad'] == 0){
                    return FALSE;
                }
                $item['precio'] = (float) $item['precio'];
                // crea un id para el articulo insertado
                $rowid = md5($item['id']);
                // obtiene la cantidad y lo agrega
                $old = isset($this->contenido_lista[$rowid]['cantidad']) ? (int) $this->contenido_lista[$rowid]['cantidad'] : 0;
                $item['rowid'] = $rowid;
                $item['qty'] += $old;
                $this->contenido_lista[$rowid] = $item;
                
                // guarda el articulo
                if($this->guardar_lista()){
                    return isset($rowid) ? $rowid : TRUE;
                }else{
                    return FALSE;
                }
            }
        }
    }
    
    /**
     * Actualiza la lista
     * @param    array
     * @return    bool
     */
    public function update($item = array()){
        if (!is_array($item) OR count($item) === 0){
            return FALSE;
        }else{
            if (!isset($item['rowid'], $this->contenido_lista[$item['rowid']])){
                return FALSE;
            }else{
                // lista la cantidad
                if(isset($item['qty'])){
                    $item['qty'] = (float) $item['qty'];
                    // borra el articulo de la lista si la cantidad es cero
                    if ($item['qty'] == 0){
                        unset($this->contenido_lista[$item['rowid']]);
                        return TRUE;
                    }
                }
                $keys = array_intersect(array_keys($this->contenido_lista[$item['rowid']]), array_keys($item));
                if(isset($item['price'])){
                    $item['price'] = (float) $item['price'];
                }
                foreach(array_diff($keys, array('id', 'name')) as $key){
                    $this->contenido_lista[$item['rowid']][$key] = $item[$key];
                }
                $this->guardar_lista();
                return TRUE;
            }
        }
    }
    /**
     * Save the lista array to the session
     * @return    bool
     */
    protected function guardar_lista(){
        $this->contenido_lista['total_articulos'] = $this->contenido_lista['total_lista'] = 0;
        foreach ($this->contenido_lista as $key => $val){
            // make sure the array contains the proper indexes
            if(!is_array($val) OR !isset($val['price'], $val['qty'])){
                continue;
            }
     
            $this->contenido_lista['total_lista'] += ($val['price'] * $val['qty']);
            $this->contenido_lista['total_articulos'] += $val['qty'];
            $this->contenido_lista[$key]['subtotal'] = ($this->contenido_lista[$key]['price'] * $this->contenido_lista[$key]['qty']);
        }
        
        // if lista empty, delete it from the session
        if(count($this->contenido_lista) <= 2){
            unset($_SESSION['contenido_lista']);
            return FALSE;
        }else{
            $_SESSION['contenido_lista'] = $this->contenido_lista;
            return TRUE;
        }
    }
    
    /**
     * Remove Item: Removes an item from the lista
     * @param    int
     * @return    bool
     */
     public function borrar($row_id){
        // unset & save
        unset($this->contenido_lista[$row_id]);
        $this->guardar_lista();
        return TRUE;
     }
}