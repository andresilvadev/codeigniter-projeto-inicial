<?php

class AuthHook
{
    private $controller = [
        'auth'
    ];

    public function check()
    {
        $CI =& get_instance();

        if(!isset($CI->session)) {
            $CI->load->library('session');
        }

        $CI->load->helper('url');

        $user = $CI->session->user ?? null;     
        $controller = $CI->uri->segment(1);     //Segment pega o primeiro item da url, no caso 'auth'  http://localhost:8000/auth/login

        if (!$user and !in_array($controller, $this->controller)) {
            redirect('auth/login', 'locations', 302);
            die();
        }
    }
}
