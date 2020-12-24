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
        $this->load->model('Banners_model');
        $this->load->model('User_model');
    }

    function index()
    {
        $data['productos'] = $this->Productos_model->get_productos_portada();
        $data['lineas_productos'] = $this->Productos_model->get_lineas();
        $data['header_banners'] = $this->Banners_model->header_banners_activos();
        $data['catalogos_list'] = $this->Productos_model->get_catalogos();
        echo $this->templates->render('public/productos', $data);
    }
    function t()
    {
        $data['productos'] = $this->Productos_model->get_productos_recientes();
        $data['lineas_productos'] = $this->Productos_model->get_lineas();
        echo $this->templates->render('public/productos', $data);
    }

    function ver_producto()
    {

        $codigo_producto = $this->uri->segment(3);

        $data['producto'] = $this->Productos_model->get_info_producto($codigo_producto);
        $data['lineas_productos'] = $this->Productos_model->get_lineas();
        $data['catalogos_list'] = $this->Productos_model->get_catalogos();


        if ($this->session->flashdata('mensaje')) {
            $data['mensaje'] = $this->session->flashdata('mensaje');
        }
        echo $this->templates->render('public/producto', $data);
    }

    function linea()
    {
        $linea = $this->uri->segment(3);
        $data['lineas_productos'] = $this->Productos_model->get_lineas();
        $categorias = $this->Productos_model->get_categorias_linea($linea);

        $data['categorias'] = $categorias;
        $data['linea_actual'] = $linea;
        echo $this->templates->render('public/categorias', $data);
    }

    function categoria()
    {
        $linea = $this->uri->segment(3);
        $categoria = urldecode($this->uri->segment(4));

        $data['linea'] = $linea;
        $data['categoria'] =$categoria;

        $data['productos_categoria'] = $this->Productos_model->get_productos_categoria($linea, $categoria);
        $data['lineas_productos'] = $this->Productos_model->get_lineas();
        $data['catalogos_list'] = $this->Productos_model->get_catalogos();
        echo $this->templates->render('public/productos_categoria', $data);

    }

    function crear_predido()
    {

        //comprobamos que este logueado
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'index.php/User/login');
        }
        //obtenemos datos de usuario
        $user_id = $this->ion_auth->get_user_id();
        $user_data = $this->User_model->get_user_by_id($user_id);
        $user_data = $user_data->row();
        $nombre = $user_data->first_name.' '.$user_data->last_name;

       /* print_contenido($user_data);
        print_contenido($_POST);*/
        //exit();
        //obtenemos datos de carrito
        $productos_pedido = $this->cart->contents();
        $total_pedido = $this->cart->total();
        // print_contenido($productos_pedido);
        //echo 'total: '.$total_pedido;
        //generamos set de datos del pedido
        $datos_pedido = array(
            'user_id' => $user_id,
            'total_pedido' => $total_pedido
        );
        //print_contenido($datos_pedido);

        //guardamos el pedido en base de datos
        $pedido_id = $this->Productos_model->guardar_pedido($datos_pedido);
        //echo 'peddido id '.$pedido_id;

        //asignamos productos a pedido
        foreach ($productos_pedido as $producto) {
            //print_contenido($producto);
            $datos_producto = $this->Productos_model->get_info_producto($producto['id']);
            $datos_producto = $datos_producto->row();
            //print_contenido($datos_producto);
            //set de datos
            $producto_pedido = array(
                'pedido_id' => $pedido_id,
                'codigo_producto' => $producto['id'],
                'linea_producto' => $datos_producto->producto_linea,
                'categoria_producto' => $datos_producto->producto_categoria,
                'cantidad_producto' => $producto['qty'],
                'precio_producto' => $producto['price'],
            );
            $this->Productos_model->guardar_producto_pedido($producto_pedido);



        }
        //guardamos direccion de pedido
        $direccion_pedido = array(
            'pedido_id' => $pedido_id,
            'direccion_pais' => $this->input->post('pais_envio'),
            'direccion_departamento' => $this->input->post('departamento_envio'),
            'direccion_municipio' => $this->input->post('municipio_envio'),
            'direccion_zona' => $this->input->post('zona_envio'),
            'direccion_direccion' => $this->input->post('direccion_envio'),
            'direccion_recibe' => $this->input->post('recibe_envio'),
            'direccion_telefono' => $this->input->post('telefono_envio'),
            'facturacion_nombre' => $this->input->post('facturacion_nombre'),
            'facturacion_nit' => $this->input->post('facturacion_nit'),
            'facturacion_direccion' => $this->input->post('facturacion_direccion'),
        );
        $this->Productos_model->guardar_direcicon_pedido($direccion_pedido);
        //print_contenido($producto_pedido);
        //notificamos pedido




        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $this->email->from('info@corporacionjumbo.com', 'JUMBO');
        $this->email->to('ventasonline@ajumbo.com ');
        $this->email->cc('ventas@ajumbo.com');
        $this->email->bcc('csamayoa@zenstudiogt.com');
        $this->email->subject('Pedido');


        $message = '<html><body>';
        $message .= '<img src="'.base_url().'/ui/public/imagenes/logo.png" alt="JUMBO" />';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= "<tr style='background: #eee;'><td>SE GENERO UN PEDIDO</td></tr>";
        $message .= "<tr style='background: #eee;'><td><strong>Nombre del cliente:</strong> </td><td>" .strip_tags($nombre) ."</td></tr>";
        $message .= "<tr><td><strong>Pedido</strong> </td><td>" . strip_tags($pedido_id) . "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";


        $this->email->message($message);

        $this->email->send();

        if ( ! $this->email->send())
        {
            // Generate error
        }


        //vaciamos carrito
        $this->cart->destroy();

        redirect(base_url() . 'index.php/user/perfil');

    }

    function pagar_pedido()
    {
        //comprobar que este logueado
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'index.php/User/login');
        }
        $user_id = $this->ion_auth->get_user_id();
        //comporbar que sea su pedido
        $pedido_id = $this->uri->segment(3);
        $datos_pedido = $this->Productos_model->get_pedido_by_id_user_id($pedido_id, $user_id);

        //datos del pedido
        if ($datos_pedido) {
            $datos_pedido = $datos_pedido->row();
        }
        //print_contenido($datos_pedido);
        //productos del pedido
        $productos_pedido = $this->Productos_model->get_productos_pedido($pedido_id);
        if ($productos_pedido) {
            $productos_pedido = $productos_pedido->result();
        }
        //print_contenido($productos_pedido);

        //direccion de pedido
        $direccion_pedido = $this->Productos_model->get_direccion_pedido($pedido_id);
        if ($direccion_pedido) {
            $direccion_pedido = $direccion_pedido->row();
        }
        //vista de pago del pedido
        $data['datos_pedido'] = $datos_pedido;
        $data['productos_pedido'] = $productos_pedido;
        $data['direccion_pedido'] = $direccion_pedido;
        echo $this->templates->render('public/pagar_pedido', $data);


    }

    function procesar_pago()
    {
        print_contenido($_POST);
        //comprobar que este logueado
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect(base_url() . 'index.php/User/login');
        }

        //datos de usuario
        $user_id = $this->ion_auth->get_user_id();
        $datos_usuario = $this->User_model->get_user_by_id($user_id);
        $datos_usuario = $datos_usuario->row();
        $nombre_usuario = $datos_usuario->first_name . ' ' . $datos_usuario->last_name;
        $data['email'] = $this->session->email;
        $data['ip_adress'] = $this->input->ip_address();

        $direccion_factura = 'direccion';
        $ciudad = 'Guatemala';
        $departamento = 'Guatemala';

        $numero_tarjeta = $this->input->post('numero_tarjeta');
        $expirationMonth = $this->input->post('mes_vencimiento_tarjeta');
        $expirationYear = $this->input->post('ano_vencimiento_tarjeta');
        $cvv = $this->input->post('cvv_tarjeta');


        $pedido_id = $this->input->post('pedido_id');
        $datos_pedido = $this->Productos_model->get_pedido_by_id_user_id($pedido_id, $user_id);
        if ($datos_pedido) {
            $datos_pedido = $datos_pedido->row();
        }


        $referenceCode = 'visanetgt_almacenjumbo';

        $client = new CybsSoapClient();
        $request = $client->createRequest($referenceCode);
        // This section contains a sample transaction request for the authorization
        //// service with complete billing, payment card, and purchase (two items) information.

        $ccAuthService = new stdClass();
        $ccAuthService->run = 'true';
        $request->ccAuthService = $ccAuthService;

        $billTo = new stdClass();
        $billTo->firstName = $datos_usuario->first_name;
        $billTo->lastName = $datos_usuario->last_name;
        $billTo->street1 = $direccion_factura;
        $billTo->city = $ciudad;
        $billTo->state = $departamento;
        $billTo->postalCode = '01010';
        $billTo->country = 'GT';
        $billTo->email = $data['email'];
        $billTo->ipAddress = $data['ip_adress'];
        $request->billTo = $billTo;

        $card = new stdClass();
        $card->accountNumber = $numero_tarjeta;
        $card->expirationMonth = $expirationMonth;
        $card->expirationYear = $expirationYear;
        $card->cvNumber = $cvv;
        $request->card = $card;


        $purchaseTotals = new stdClass();
        $purchaseTotals->currency = 'GTQ';
        $request->purchaseTotals = $purchaseTotals;


        $request->deviceFingerprintID = $this->input->post('deviceFingerprintID');
        //echo $this->input->post('deviceFingerprintID');

        /*$item0 = new stdClass();
        $item0->unitPrice = '12.34';
        $item0->quantity = '2';
        $item0->id = '0';*/

        $item1 = new stdClass();
        //prueba
        //$item1->unitPrice = '1';
        $item1->unitPrice = $datos_pedido->total_pedido;
        $item1->productName = 'productos jumbo';
        $item1->id = '1';

        //$request->item = array($item0, $item1);
        $request->item = array($item1);

        //print_contenido($request);
        $reply = $client->runTransaction($request);

// This section will show all the reply fields.
        print("\nAUTH RESPONSE: " . print_contenido($reply, true));

        if ($reply->decision == 'ACCEPT' or $reply->ccAuthReply->reasonCode == '100') {

            //correo notificacion de pago
            /* $this->notiticacion_pago($user_id, $data['email'], $nombre_usuario, $total_a_pagar, $data['tipo_anuncio'], 'Pago con tarjeta');

             $datos_cliente = (object)null;
             $datos_cliente->nitComprador = $nit;
             $datos_cliente->nombreComercialComprador = $nombre_factura;
             $datos_cliente->direccionComercialComprador = $direccion_factura;
             $datos_cliente->telefonoComprador = '0';
             $datos_cliente->correoComprador = $data['email'];
             $producto_facturar = (object)null;

             //$anuncio_vip = true;
             //$anuncio_individual = true;

             if ($this->session->facebook) {

                 $precio_unitario = $precio_facebook;
                 $monto_bruto = $precio_unitario / 1.12;
                 $monto_bruto = round($monto_bruto, 2);
                 $iva = $monto_bruto * 0.12;
                 $iva = round($iva, 2);

                 $total_a_pagar = $total_a_pagar + $precio_facebook->parametro_valor;
                 $producto_facturar->vip = (object)array(
                     'producto' => 'vip',
                     'cantidad' => '1',
                     'unidadMedida' => 'UND',
                     'codigoProducto' => '001-2020',
                     'descripcionProducto' => 'Anuncio Facebook',
                     'precioUnitario' => $precio_unitario,
                     'montoBruto' => $monto_bruto,
                     'montoDescuento' => '0',
                     'importeNetoGravado' => $precio_unitario,
                     'detalleImpuestosIva' => $iva,
                     'importeExento' => '0',
                     'otrosImpuestos' => '0',
                     'importeOtrosImpuestos' => '0',
                     'importeTotalOperacion' => $precio_unitario,
                     'tipoProducto' => 'S',

                 );

             }


             if ($data['tipo_anuncio'] == 'vip') {
                 $producto_facturar->vip = (object)array(
                     'producto' => 'vip',
                     'cantidad' => '1',
                     'unidadMedida' => 'UND',
                     'codigoProducto' => '001-2020',
                     'descripcionProducto' => 'Anuncio Vip',
                     'precioUnitario' => '0',
                     'montoBruto' => '0',
                     'montoDescuento' => '0',
                     'importeNetoGravado' => '0',
                     'detalleImpuestosIva' => '0',
                     'importeExento' => '0',
                     'otrosImpuestos' => '0',
                     'importeOtrosImpuestos' => '0',
                     'importeTotalOperacion' => '0',
                     'tipoProducto' => 'S',

                 );
             }
             /* if ($data['tipo_anuncio'] == 'vip') {
                  $producto_facturar->vip = (object)array(
                      'producto' => 'vip',
                      'cantidad' => '1',
                      'unidadMedida' => 'UND',
                      'codigoProducto' => '001-2020',
                      'descripcionProducto' => 'Anuncio Vip',
                      'precioUnitario' => '275',
                      'montoBruto' => '245.54',
                      'montoDescuento' => '0',
                      'importeNetoGravado' => '275',
                      'detalleImpuestosIva' => '29.46',
                      'importeExento' => '0',
                      'otrosImpuestos' => '0',
                      'importeOtrosImpuestos' => '0',
                      'importeTotalOperacion' => '275',
                      'tipoProducto' => 'S',

                  );
              }*/

            /*
                        if ($data['tipo_anuncio'] == 'individual') {
                            $producto_facturar->individual = (object)array(
                                'producto' => 'individual',
                                'cantidad' => '1',
                                'unidadMedida' => 'UND',
                                'codigoProducto' => '002-2020',
                                'descripcionProducto' => 'Anuncio Individual',
                                'precioUnitario' => '75',
                                'montoBruto' => '66.96',// 75 /1.12= 66.96
                                'montoDescuento' => '0',
                                'importeNetoGravado' => '175',
                                'detalleImpuestosIva' => '8.03',// 66.96*0.12= 8.03
                                'importeExento' => '0',
                                'otrosImpuestos' => '0',
                                'importeOtrosImpuestos' => '0',
                                'importeTotalOperacion' => '175',
                                'tipoProducto' => 'S',
                            );

                        }

                        $this->facturar_global($producto_facturar, $datos_cliente);

            */

            /*if ($data['tipo_anuncio'] == 'individual') {
                redirect(base_url() . 'cliente/publicar_carro');
            }
            if ($data['tipo_anuncio'] == 'vip') {
                redirect(base_url() . 'cliente/publicar_carro_vip');
            }*/

            //pasar pedido a pagado
            $this->session->set_flashdata('mensaje', 'el pedido se pago correctamente');
            $this->Productos_model->pasar_pedido_a_pagado($pedido_id);
            redirect(base_url() . 'index.php/user/perfil');


            //redirect(base_url() . 'cliente/perfil');
            //redirect(base_url() . 'cliente/publicar_carro');
            //echo 'guardar numero de transaccion en base de datos';
            //echo $reply->requestID;
        } else {
            $this->session->set_flashdata('error', $reply->reasonCode);
            //$this->notiticacion_error_pago($user_id, $data['email'], $nombre_usuario, $datos_pedido->total_pedido, $data['tipo_anuncio'], 'Pago con tarjeta', $reply);
            //redirect(base_url() . 'cliente/datos_pago');
            //echo 'poner mensaje de error redireccionar';
            //print("\nFailed auth request.\n");
            // This section will show all the reply fields.
            //echo '<pre>';
            //print("\nRESPONSE: " . print_r($reply, true));
            //echo '</pre>';
            return;
        }

// Build a capture using the request ID in the response as the auth request ID
        /* $ccCaptureService = new stdClass();
         $ccCaptureService->run = 'true';
         $ccCaptureService->authRequestID = $reply->requestID;

         $captureRequest = $client->createRequest($referenceCode);
         $captureRequest->ccCaptureService = $ccCaptureService;
         $captureRequest->item = array($item1);
         $captureRequest->purchaseTotals = $purchaseTotals;

         $captureReply = $client->runTransaction($captureRequest);
        */
        // This section will show all the reply fields.
        // print("\nCAPTRUE RESPONSE: " . print_contenido($captureReply, true));


    }

    function buscar(){

        $keyword= $this->input->post('keyword');
        if($keyword){

            $productos = $this->Productos_model->buscar($keyword);
            $data['keyword'] = $keyword;
            $data['productos_categoria'] = $productos;
            $data['lineas_productos'] = $this->Productos_model->get_lineas();
            $data['catalogos_list'] = $this->Productos_model->get_catalogos();
            //print_contenido($productos->result());
            echo $this->templates->render('public/productos_categoria', $data);
        }else{
            redirect(base_url());
        }






    }

}