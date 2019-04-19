<?php

class Pages extends CI_Controller 
{

    public function __construct() 
    {
        parent::__construct(); //Sempre chamar esse cara para evitar erro dele não sobre escrever o método
        $this->load->model('pages_model');
    }

    public function index() 
    {
        $results = $this->pages_model->get();

        $this->load->view('templates/header');
        $this->load->view('pages/index', ['pages' => $results ]);
        $this->load->view('templates/footer');     
    }

    public function view($id)
    {
        $page = $this->pages_model->get($id);

        $this->load->view('templates/header');
        $this->load->view('pages/view', ['page' => $page ]);
        $this->load->view('templates/footer');     
        //var_dump($page);
    }

    public function new()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Título','required');
        $this->form_validation->set_rules('body', 'Conteúdo','required');
        $this->form_validation->set_rules('slug', 'Slug','required');

        // Se o resultado da validacao for igual a false, então renderizo o formulário
        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header');
            $this->load->view('pages/new');
            $this->load->view('templates/footer');
        } else {
            $data['back'] = '/pages';
            $this->pages_model->new();
            $this->load->view('templates/success', $data);
        }
    }

    public function edit ($id = null)
    {
        $page = $this->pages_model->get($id);
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Título','required');
        $this->form_validation->set_rules('body', 'Conteúdo','required');
        $this->form_validation->set_rules('slug', 'Slug','required');

        // Se o resultado da validacao for igual a false, então renderizo o formulário
        if ($this->form_validation->run() === false) {
            
            $page = $this->pages_model->get($id);
            
            $this->load->view('templates/header');
            $this->load->view('pages/edit', ['page' => $page]);
            $this->load->view('templates/footer');
        } else {
            $data['back'] = '/pages/' . $id;
            $this->pages_model->update($id);
            $this->load->view('templates/success', $data);
        }
    }

    public function delete($id)
    {
        $data['back'] = '/pages';
        $this->pages_model->delete($id);
        $this->load->view('templates/success', $data);
    }

}