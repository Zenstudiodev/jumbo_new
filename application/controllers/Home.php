<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 21/01/2018
 * Time: 2:10 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Base_Controller
{
	function __construct()
	{
		parent::__construct();
        // Modelos
        $this->load->model('Productos_model');
        $this->load->model('User_model');
	}

	function index()
	{
        $data['productos'] = $this->Productos_model->get_productos();
        $data['productos_recomendados'] = $this->Productos_model->get_productos_recomendados_home();

	    echo $this->templates->render('public/home', $data);
	}
	function homed (){
        $data['home_d'] = '';
        echo $this->templates->render('public/homed', $data);
    }

    function error_404 (){
        $data['home_d'] = '';
        echo $this->templates->render('errors/html/error_404', $data);
    }


}