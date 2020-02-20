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
    public function get_productos()
    {
        $query = $this->db->get('productos');
        if ($query->num_rows() > 0) return $query;
        else return false;
    }
}