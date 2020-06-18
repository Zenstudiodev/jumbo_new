<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 12/05/2020
 * Time: 8:55 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
class Productos extends Base_Controller
{
    function __construct()
    {
        parent::__construct();
        // Modelos
        $this->load->library('email');
        $this->load->model('Productos_model');
        $this->load->model('User_model');
    }

    function index()
    {
        $data['productos'] = $this->Productos_model->get_productos_recientes();
        $data['lineas_productos'] = $this->Productos_model->get_lineas();
        echo $this->templates->render('public/productos', $data);
    }
    function ver_producto(){

        $codigo_producto =  $this->uri->segment(3);

        $data['producto'] = $this->Productos_model->get_info_producto($codigo_producto);
        $data['lineas_productos'] = $this->Productos_model->get_lineas();

        if ($this->session->flashdata('mensaje')) {
            $data['mensaje'] = $this->session->flashdata('mensaje');
        }
        echo $this->templates->render('public/producto', $data);
    }
    function linea(){
        $linea =  $this->uri->segment(3);
        $data['lineas_productos'] = $this->Productos_model->get_lineas();
        $categorias= $this->Productos_model->get_categorias_linea($linea);

        $data['categorias'] = $categorias;
        $data['linea_actual'] = $linea;
        echo $this->templates->render('public/categorias', $data);
    }
    function categoria(){
        $linea =  $this->uri->segment(3);
        $categoria = urldecode($this->uri->segment(4));


        $data['productos_categoria'] = $this->Productos_model->get_productos_categoria($linea, $categoria);
        $data['lineas_productos'] = $this->Productos_model->get_lineas();
        echo $this->templates->render('public/productos_categoria', $data);

    }
    function crear_predido(){
        //comprobamos que este logueado
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'index.php/User/login');
        }
        //obtenemos datos de usuario
        $user_id = $this->ion_auth->get_user_id();
        //$user_data = $this->User_model->get_user_by_id($user_id);
        //$user_data = $user_data->row();

        //obtenemos datos de carrito
        $productos_pedido = $this->cart->contents();
        $total_pedido = $this->cart->total();
       // print_contenido($productos_pedido);
        //echo 'total: '.$total_pedido;
        //generamos set de datos del pedido
        $datos_pedido  = array(
            'user_id' => $user_id,
            'total_pedido' => $total_pedido
        );
        //print_contenido($datos_pedido);

        //guardamos el pedido en base de datos
        $pedido_id = $this->Productos_model->guardar_pedido($datos_pedido);
        //echo 'peddido id '.$pedido_id;

        //asignamos productos a pedido
        foreach ($productos_pedido as $producto){
            //print_contenido($producto);
            $datos_producto = $this->Productos_model->get_info_producto($producto['id']);
            $datos_producto = $datos_producto->row();
            //print_contenido($datos_producto);
            //set de datos
            $producto_pedido =array(
                'pedido_id' =>$pedido_id,
                'codigo_producto' =>$producto['id'],
                'linea_producto' =>$datos_producto->producto_linea,
                'categoria_producto' =>$datos_producto->producto_categoria,
                'cantidad_producto' =>$producto['qty'],
                'precio_producto' =>$producto['price'],
            );
            $this->Productos_model->guardar_producto_pedido($producto_pedido);
            //print_contenido($producto_pedido);

        }
        //notificamos pedido

        $this->email->from('info@corporacionjumbo.com', 'JUMBO');
        $this->email->to('csamayoa@zenstudiogt.com');
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');
        $this->email->subject('Pedido');
        $this->email->message('Se genero un pedido');
        $this->email->send();



        //vaciamos carrito
        $this->cart->destroy();

        redirect(base_url().'index.php/carrito/ver');

    }
    function pagar_pedido(){
        //comprobar que este logueado
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'index.php/User/login');
        }
        $user_id = $this->ion_auth->get_user_id();
        //comporbar que sea su pedido
        $pedido_id =  $this->uri->segment(3);
        $datos_pedido = $this->Productos_model->get_pedido_by_id_user_id($pedido_id, $user_id);

        //datos del pedido
        if($datos_pedido){
            $datos_pedido = $datos_pedido->row();
        }
        //print_contenido($datos_pedido);
        //productos del pedido
        $productos_pedido = $this->Productos_model->get_productos_pedido($pedido_id);
        if($productos_pedido){
            $productos_pedido = $productos_pedido->result();
        }
        //print_contenido($productos_pedido);

        //vista de pago del pedido
        $data['datos_pedido'] = $datos_pedido;
        $data['productos_pedido'] = $productos_pedido;
        echo $this->templates->render('public/productos_categoria', $data);


    }

}