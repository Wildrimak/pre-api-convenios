<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

// use Restserver\Libraries\REST_Controller;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class Login_Controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
        $this->load->model('paciente_model');
    }

    public function token_post()
    {
        $cpf = $this->post('cpf');
        $senha = $this->post('senha');
        $paciente = $this->paciente_model->get_by_cpf($cpf);
        

        if ($paciente != Null && $cpf === $paciente->cpf && $senha === $paciente->senha) {
            $token = AUTHORIZATION::generateToken(['username' => $paciente->cpf]);
            $status = REST_Controller::HTTP_OK;
            $response = ['status' => $status, 'token' => $token];
            $this->response($response, $status);
        } else {
            $status = REST_Controller::HTTP_FORBIDDEN;
            $response = ['status' => $status, 'token' => 'invalid'];
            $this->response($response, $status);
        }
    }

    private function verify_request()
    {
        // Get all the headers
        $headers = $this->input->request_headers();
        // Extract the token
        $token = $headers['Authorization'];
        // Use try-catch
        // JWT library throws exception if the token is not valid
        try {
            // Validate the token
            // Successfull validation will return the decoded user data else returns false
            $data = AUTHORIZATION::validateToken($token);
            if ($data === false) {
                $status = parent::HTTP_UNAUTHORIZED;
                $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
                $this->response($response, $status);
                exit();
            } else {
                return $data;
            }
        } catch (Exception $e) {
            // Token is invalid
            // Send the unathorized access message
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

}
