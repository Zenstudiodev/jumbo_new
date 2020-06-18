<?php
/**
 * Created by PhpStorm.
 * User: Latios-ws
 * Date: 11/05/2020
 * Time: 6:47 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Empresa extends Base_Controller
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
        $data['productos'] = $this->Productos_model->get_productos();
        echo $this->templates->render('public/home', $data);
    }
    function quienes_somos(){
        $data['productos'] = $this->Productos_model->get_productos();
        echo $this->templates->render('public/quienes_somos', $data);
    }
    function contacto(){
        $data['productos'] = $this->Productos_model->get_productos();
        echo $this->templates->render('public/contacto', $data);
    }
    function enviar_formulario_contacto(){
        print_contenido($_POST);


        //comprobamos que exista post
        if($this->input->post('correo_contacto')){
            //leemos datos desde post
            $nombre = $this->input->post('nombre_contacto');
            $correo = $this->input->post('correo_contacto');
            $mensaje= $this->input->post('mensaje_contacto');


            $this->email->from('info@ajumbo.com', 'JUMBO');
            $this->email->to('csamayoa@zenstudiogt.com');
            $this->email->bcc('csamayoa@zenstudiogt.com');

            $this->email->subject('FORMULARIO DE CONTACO SITIO WEB');

            //mensaje
            $message = '<html><body>';
            //$message .= '<img src="'.base_url().'/ui/public/imagenes/logo.png" alt="JUMBO" />';
            $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            $message .= "<tr style='background: #eee;'><td><strong>nombre:</strong> </td><td>" .strip_tags($nombre) ."</td></tr>";
            $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($correo) . "</td></tr>";
            $message .= "<tr><td><strong>Mensaje:</strong> </td><td>" . strip_tags($mensaje) . "</td></tr>";
            $message .= "</table>";
            $message .= "</body></html>";

            $this->email->message($message);
            //enviar correo
            $this->email->send();


            echo'send';
        }else{
            //redirigir al home
            redirect(base_url().'/index.php/Empresa/contacto');
        }
    }
}