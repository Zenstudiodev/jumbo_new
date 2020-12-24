<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 16/06/2020
 * Time: 11:56 PM
 */



function nombre_de_producto_por_codigo($producto_id){
    $ci =& get_instance();
    $datos_de_producto = $ci->Productos_model->get_info_producto($producto_id);
    if($datos_de_producto){
        $datos_de_producto = $datos_de_producto->row();
    }
    return $datos_de_producto;
}
function categorias_de_linea($linea){
    $ci =& get_instance();
    $categorias = $ci->Productos_model->get_categorias_linea($linea);
    if($categorias){
        return $categorias->result();
    }else{
        return false;
    }

}
function linea_tiene_icono($linea){
    $ci =& get_instance();
    $categorias = $ci->Productos_model->linea_tiene_icono($linea);
    if($categorias){
        return $categorias->result();
    }else{
        return false;
    }
}
function get_icono_linea($linea){
    $ci =& get_instance();
    $categorias = $ci->Productos_model->linea_tiene_icono($linea);
    if($categorias){
        $categorias = $categorias->row();
        //print_contenido($categorias->Imagen);
        return base_url().'upload/iconos/lineas/'.$categorias->imagen.'.png';
    }else{
        return false;
    }
}

?>