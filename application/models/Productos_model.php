<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 20/02/2020
 * Time: 10:03 AM
 */

class Productos_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function limpiar_tabla(){
        $this->db->truncate('productos');
    }

    public function get_productos_recomendados_home(){
        $this->db->limit(6);
        $this->db->order_by('producto_linea', 'RANDOM');
        $query = $this->db->get('productos');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function get_productos()
    {
        $query = $this->db->get('productos');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function get_productos_recientes()
    {
       // $this->db->limit(9);
        $query = $this->db->get('productos');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function importar_productos($data){


        $datos_de_producto = array(
            //'producto_id' => $data['producto_id'],
            'producto_nombre' => $data['producto_nombre'],
            'producto_codigo' => $data['producto_codigo'],
            'producto_linea' => $data['producto_linea'],
            'producto_categoria' => $data['producto_categoria'],
            'producto_material' => $data['producto_material'],
            'producto_marca' => $data['producto_marca'],
            'producto_descripcion' => $data['producto_descripcion'],
            'producto_color' => $data['producto_color'],
            'producto_medidas' => $data['productdo_medida'],
            'producto_estilo' => $data['producto_estilo'],
            'producto_precio' => $data['producto_precio'],
            'producto_precio_empresario' => $data['producto_precio_empresario'],
            'producto_tecnica_de_impresion' => $data['producto_tecnica_de_impresion'],
            'producto_envio' => $data['producto_envio'],
        );
        // insertamon en la base de datos
        $this->db->insert('productos', $datos_de_producto);


    }
    public function get_lineas (){
        $this->db->distinct('producto_linea');
        $this->db->select('producto_linea');
        $this->db->from('productos');
        $this->db->order_by('producto_linea', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function get_categorias_linea($linea){
        $this->db->distinct('producto_categoria');
        $this->db->select('producto_categoria');
        $this->db->from('productos');
        $this->db->where('producto_linea', $linea);
        $this->db->order_by('producto_linea', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function get_info_producto($codigo_producto){
        $this->db->where('producto_codigo', $codigo_producto);
        $this->db->order_by('producto_codigo', 'ASC');
        $this->db->from('productos');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function get_productos_categoria($linea, $categoria){
        $this->db->where('producto_linea', $linea);
        $this->db->where('producto_categoria', $categoria);
        $this->db->order_by('producto_codigo', 'ASC');
        $this->db->from('productos');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function guardar_pedido($data){

        $fecha = New DateTime();
        $datos_pedido = array(
            'fecha_pedido' => $fecha->format('Y-m-d'),
            'user_id_pedido' => $data['user_id'],
            'total_pedido' => $data['total_pedido'],
        );
        $this->db->insert('pedidos', $datos_pedido);
        $insert_id = $this->db->insert_id();
        return $insert_id;

    }
    public function guardar_producto_pedido($data){
        $datos_producto = array(
            'pedido_id' => $data['pedido_id'],
            'codigo_producto' => $data['codigo_producto'],
            'linea_producto' => $data['linea_producto'],
            'categoria_producto' => $data['categoria_producto'],
            'cantidad_producto' => $data['cantidad_producto'],
            'precio_producto' => $data['precio_producto'],
        );
        $this->db->insert(' productos_pedido', $datos_producto);
        //$insert_id = $this->db->insert_id();
       // return $insert_id;
    }
    public function get_pedidos_user_id($user_id){
        $this->db->where('user_id_pedido', $user_id);
        //$this->db->order_by('producto_codigo', 'ASC');
        $this->db->from('pedidos');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function get_pedido_by_id_user_id($pedido_id, $user_id){
        $this->db->where('id_pedido', $pedido_id);
        $this->db->where('user_id_pedido', $user_id);
        //$this->db->order_by('producto_codigo', 'ASC');
        $this->db->from('pedidos');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
    public function get_productos_pedido($pedido_id){
        $this->db->where('pedido_id', $pedido_id);
        //$this->db->where('user_id_pedido', $user_id);
        //$this->db->order_by('producto_codigo', 'ASC');
        $this->db->from('productos_pedido');
        $query = $this->db->get();
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
}