<?php

    class Cep_model extends MY_Model {

        function __construct()
        {
            parent::__construct();
        }

        public function busca_cep($cep){
 
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://viacep.com.br/ws/{$cep}/xml/");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
    
            $simple_xml = @simplexml_load_string($result);
    
            if($simple_xml === false){

                throw new \RuntimeException('Erro na leitura do arquivo');
            }
    
            return $simple_xml;
        }
    }
?>