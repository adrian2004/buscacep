<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CepController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cep_model', 'cepmodel');
    }

    public function index()
    {
        $this->load->view('buscarcep_view');
    }

    public function getCep()
    {
        $cep = $this->input->post('cep');
        $error = false;
        $message = '';

        sleep(1);

        try{
            if ($cep == NULL) {
                throw new Exception("Cep não informado.");
            }

            $result = $this->cepmodel->busca_cep($cep);

        }catch(Throwable $throwable){

            $error = true;
            $message = $throwable->getMessage();
        }

        echo json_encode([
            'status' => $error ? 400 : 200,
            'response' => $error ? $message : $result
        ]);
    }
}
