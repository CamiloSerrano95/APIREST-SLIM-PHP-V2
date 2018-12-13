<?php
    namespace App\Lib;

    class Response {
        
	    public $response   = false;
	    public $message    = 'Ocurrio un error inesperado.';
        public $result     = null;
        
        public function SetResponse($response, $message = '') {
            $this->response = $response;
            $this->message = $message;

            if(!$response && $message = '') $this->response = 'Ocurrio un error inesperado';
        }
    }
?>