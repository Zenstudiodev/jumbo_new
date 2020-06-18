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
    }

    function index()
    {
        $data['productos'] = $this->Productos_model->get_productos();
        echo $this->templates->render('public/home', $data);
    }
    function importar_productos(){

        $this->Productos_model->limpiar_tabla();
        $json = file_get_contents('https://corporacionjumbo.com/new/upload/json/productos.json');

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
                'producto_envio' => $producto['producto_envio'],
            );
            //guardamos datos de formulario en base de datos
            //print_r($datos_de_producto);
            $this->Productos_model->importar_productos($datos_de_producto);
            echo'guardado'.'<br/>';

            // echo $key . " => " . $value . "<br>";
        }



        //print_r($Geonames);

    }

}