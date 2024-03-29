<?php

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');  // Carrega o model
        $this->load->library('session');    // Carrega a sessão
        $this->load->helper('url');         // Carrega a url
    }

    public function register()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Nome', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Senha', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('auth/register');
            $this->load->view('templates/footer');
        } else {
            $data['back'] = '/';
            $this->users_model->new();
            $this->load->view('templates/success', $data);
        }
    }

    public function login()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Senha', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        } else {
            $user = $this->users_model->getByEmailAndPassword();
            if ($user) {
                $this->session->set_userdata(['user'=>$user]);
                redirect('pages', 'location', 302);
                die();
            }
            echo 'Usuário ou senha não encontrado';
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect('auth/login', 'location', 302);
        die();
    }
}