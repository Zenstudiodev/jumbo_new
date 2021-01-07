<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 12/05/2020
 * Time: 10:06 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends  Base_Controller
{
    function __construct()
    {
        parent::__construct();
        // Modelos
        $this->load->library('email');
        $this->load->model('Productos_model');
        $this->load->model('User_model');
        $this->load->model('Banners_model');
    }

    function index()
    {
        //$data['productos'] = $this->Productos_model->get_productos();
        echo $this->templates->render('admin/home');

    }
    function importar_productos(){

        $this->Productos_model->limpiar_tabla();
        $json = file_get_contents('https://ajumbo.com/upload/json/productos.json');

        $data = json_decode($json,true);
        //$data = json_decode($json);

        //print_contenido($data);

        foreach($data as $producto) {

           //print_contenido($producto);

            //echo $producto['producto_codigo'];

            //obtenemos los dastos del array individual del producto
            $datos_de_producto = array(
                'producto_id' => $producto['producto_id'],
                'producto_nombre' => $producto['producto_nombre'],
                'producto_codigo' => $producto['producto_codigo'],
                'producto_linea' => $producto['producto_linea'],
                'producto_categoria' => $producto['producto_categoria'],
                'producto_material' => $producto['producto_material'],
                'producto_marca' => $producto['producto_marca'],
                'producto_descripcion' => $producto['producto_descripcion'],
                'producto_color' => $producto['producto_color'],
                'productdo_medida' => $producto['productdo_medida'],
                'producto_estilo' => $producto['producto_estilo'],
                'producto_precio' => $producto['producto_precio'],
                'producto_precio_empresario' => $producto['producto_precio_empresario'],
                'producto_tecnica_de_impresion' => $producto['producto_tecnica_de_impresion'],
                //'producto_envio' => $producto['producto_envio'],
            );
            //guardamos datos de formulario en base de datos
            //print_r($datos_de_producto);
            $this->Productos_model->importar_productos($datos_de_producto);
            echo'guardado'.'<br/>';

            // echo $key . " => " . $value . "<br>";
        }



        //print_r($Geonames);

    }

    public function listado_pedidos(){
        $data['pedidos'] = $this->Productos_model->get_pedidos();
        echo $this->templates->render('admin/pedidos', $data);
    }
    public function revisar_pedido(){
        $id_pedido = $this->uri->segment(3);
        $data['datos_pedido'] = $this->Productos_model->get_pedido_by_id($id_pedido);
        $data['datos_envio'] = $this->Productos_model->get_direccion_pedido($id_pedido);
        $data['datos_comprobante'] = $this->Productos_model->get_comporbante_pago_by_pedido_id($id_pedido);
        if($data['datos_pedido']){
            $pedido = $data['datos_pedido']->row();
            $data['cliente'] = $this->User_model->get_user_by_id($pedido->user_id_pedido);
            $data['productos_pedido'] = $this->Productos_model->get_productos_pedido($id_pedido);
        }


        echo $this->templates->render('admin/revisar_pedido', $data);
    }
    public function actualizar_pedido(){
       $id_pedido= $this->input->post('id_pedido');
       $estado_pedido= $this->input->post('estado_pedido');

        $datos_pedido = array(
            'pedido_id' => $id_pedido,
            'estado_pedido' => $estado_pedido,
        );
        $this->Productos_model->actualizar_pedido($datos_pedido);

       redirect(base_url().'index.php/admin/listado_pedidos');
    }


    //banners
    public function banners()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }

    }
    public function banners_inactivos()
    {
    }
    public function crear_banner()
    {
    }
    public function guardar_banner()
    {
    }
    public function desactivar_banner()
    {
    }
    public function crear_banner_header()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }

        $user_id = $this->ion_auth->get_user_id();

        if (!$this->ion_auth->in_group('administracion',$user_id)){
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }
        $data['titulo'] = 'Crear Banner Header';

        if ($this->session->flashdata('mensaje')) {
            $data['mensaje'] = $this->session->flashdata('mensaje');
        }

        echo $this->templates->render('admin/admin_crear_banner_header', $data);
    }
    public function guardar_banner_header()
    {
         //print_contenido($_POST);

        $titulo = $this->input->post('titulo');

        $nombre_imagen = str_replace(' ', '_', $titulo);

        $config['upload_path'] = './ui/public/imagenes/banners';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $nombre_imagen;
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('imagen')) {
            $error = array('error' => $this->upload->display_errors());
            print_contenido($error);
            //$this->load->view('upload_form', $error);
        } else {
            $post_data = array(
                'titulo' => $titulo,
                'link' => $this->input->post('link'),
                'imagen' => $nombre_imagen,
                'area' => $this->input->post('area'),
                'vencimiento' => $this->input->post('vencimiento'),
                'estado' => $this->input->post('estado'),
            );


            //print_r($post_data);

            $this->Banners_model->crear_banners_header($post_data);
            redirect(base_url() . 'index.php/admin/banners_header');
        }


    }
    public function banners_header()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }

        $user_id = $this->ion_auth->get_user_id();

        if (!$this->ion_auth->in_group('administracion',$user_id)){
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }

        $data['banners'] = $this->Banners_model->banners_header();
        echo $this->templates->render('admin/admin_banners_header', $data);
    }
    public function editar_banner_header()
    {
        //id banner
        $data['id_banner'] = $this->uri->segment(3);
        $data['banner_data'] = $this->Banners_model->banner_header_data($data['id_banner']);
        echo $this->templates->render('admin/admin_editar_banner_header', $data);
    }
    public function actualizar_banner_header()
    {
        /* echo '<pre>';
         print_r($_POST);
         echo '</pre>';
         exit();*/
        $post_data = array(
            'id' => $this->input->post('id'),
            'titulo' => $this->input->post('titulo'),
            'link' => $this->input->post('link'),
            'imagen' => $this->input->post('imagen'),
            'area' => $this->input->post('area'),
            'vencimiento' => $this->input->post('vencimiento'),
            'estado' => $this->input->post('estado'),
        );
        //print_r($post_data);

        $this->Banners_model->actualizar_banners_header($post_data);
        redirect(base_url() . 'index.php/admin/banners_header/');
    }
    public function actualizar_banner()
    {
        $post_data = array(
            'id' => $this->input->post('id'),
            'titulo' => $this->input->post('titulo'),
            'link' => $this->input->post('link'),
            'imagen' => $this->input->post('imagen'),
            'area' => $this->input->post('area'),
            'vencimiento' => $this->input->post('vencimiento'),
            'estado' => $this->input->post('estado'),
        );
        //print_r($post_data);

        $this->Banners_model->actualizar_banners($post_data);
        redirect(base_url() . 'admin/banners/');
    }
    public function borrar_banner_header(){
        $id_banner = $this->uri->segment(3);
        $this->Banners_model->borrar_banner_header($id_banner);
        redirect(base_url() . 'admin/banners_header/');
    }


    //productos de portada
    public function productos_portada(){
        $data['productos_portada'] = $this->Productos_model->get_productos_portada();
        $data['productos_no_portada'] = $this->Productos_model->get_productos_no_portada();

        echo $this->templates->render('admin/productos_portada', $data);
    }
    public function asignar_portada(){
        $codigo_producto = $this->uri->segment(3);
        $this->Productos_model->asignar_producto_portada($codigo_producto);
        redirect(base_url().'index.php/admin/productos_portada');
    }
    public function quitar_portada(){
        $codigo_producto = $this->uri->segment(3);
        $this->Productos_model->quitar_producto_portada($codigo_producto);
        redirect(base_url().'index.php/admin/productos_portada');
    }
    public function iconos_lineas(){
        $data['lineas_productos'] = $this->Productos_model->get_lineas();

        echo $this->templates->render('admin/iconos_lineas', $data);
    }
    public function asignar_icono_linea (){
        $linea = $this->uri->segment(3);
        $data['linea'] = $linea;
        echo $this->templates->render('admin/asignar_icono_linea', $data);
    }

    public function  guardar_icono_linea(){
        // print_contenido($_POST);

        $titulo = $this->input->post('linea');

        $nombre_imagen = str_replace(' ', '_', $titulo);

        $config['upload_path'] = './upload/iconos/lineas';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $nombre_imagen;
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('imagen')) {
            $error = array('error' => $this->upload->display_errors());
            print_contenido($error);
            //$this->load->view('upload_form', $error);
        } else {
            $post_data = array(
                'linea' => $titulo,
                'imagen' => $nombre_imagen,
            );


            //print_r($post_data);

            $this->Productos_model->asignar_icono_linea($post_data);
            redirect(base_url() . 'index.php/admin/iconos_lineas');
        }


    }

    public function borrar_icono_linea(){
        $linea = $this->uri->segment(3);

        $datos_imagen = $this->Productos_model->linea_tiene_icono($linea);
        if ($datos_imagen) {
            $datos_imagen = $datos_imagen->row();
            $nombre_imagen = $datos_imagen->imagen;

            //borrado de registro
            $this->Productos_model->borrar_icono_linea($linea);

            //borrado de imagen
            //echo '/home/corpjcgd/public_html/new/upload/iconos/lineas/' . $nombre_imagen.'.png';
            if (file_exists('/home/corpjcgd/public_html/new/upload/iconos/lineas/' . $nombre_imagen.'.png')) {
               // echo 'imagen existe';
                if (unlink('/home/corpjcgd/public_html/new/upload/iconos/lineas/' . $nombre_imagen.'.png')) {
                    $this->session->set_flashdata('mensaje', 'se borro el icono');
                    redirect(base_url() . 'index.php/admin/iconos_lineas');
                } else {
                    echo 'no se borro';
                }

            } else {

                echo 'la imagen no existe';
            }


        } else {
            $this->session->set_flashdata('mensaje', 'imagen no existe');
            redirect(base_url() . 'index.php/admin/iconos_lineas');

        }
    }
    public function actualizar_icono_linea(){

    }



    //Catalogos
    public function catalogos(){
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }
        $user_id = $this->ion_auth->get_user_id();
        if (!$this->ion_auth->in_group('administracion',$user_id)){
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }
        $data['catalogos_list'] = $this->Productos_model->get_catalogos();

        echo $this->templates->render('admin/admin_catalogos', $data);
    }
    public function crear_catalogo(){
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'User/login');
        }
        $user_id = $this->ion_auth->get_user_id();

        if (!$this->ion_auth->in_group('administracion',$user_id)){
            // redirect them to the login page
            redirect(base_url() . 'User/perfil');
        }
        $data['titulo'] = 'Crear Banner Header';
        if ($this->session->flashdata('mensaje')) {
            $data['mensaje'] = $this->session->flashdata('mensaje');
        }
        echo $this->templates->render('admin/admin_crear_catalogos', $data);
    }
    public function guardar_catalogo(){
        //print_contenido($_POST);

        $post_data = array(
            'titulo' => $this->input->post('titulo'),
            'link' => $this->input->post('link'),
        );
        $this->Productos_model->crear_catalogo($post_data);
        redirect(base_url() . 'Admin/catalogos');



    }
    public function editar_catalogo()
    {
        //id banner
        $data['id_catalogo'] = $this->uri->segment(3);
        $data['catalogo_data'] = $this->Productos_model->catalogo_data($data['id_catalogo']);
        echo $this->templates->render('admin/admin_editar_catalogos', $data);
    }
    public function actualizar_catalogo()
    {
        /* echo '<pre>';
         print_r($_POST);
         echo '</pre>';
         exit();*/
        $post_data = array(
            'catalogo_id' => $this->input->post('catalogo_id'),
            'titulo' => $this->input->post('titulo'),
            'link' => $this->input->post('link'),
        );
        //print_r($post_data);

        $this->Productos_model->actualizar_catalogo($post_data);
        redirect(base_url() . 'Admin/catalogos');
    }
    public function borrar_catalogo(){
        $id_catalogo = $this->uri->segment(3);
        $this->Productos_model->borrar_catalogo($id_catalogo);
        redirect(base_url() . 'Admin/catalogos');

    }

}