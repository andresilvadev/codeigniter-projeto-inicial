<?php

class Pages extends CI_Controller 
{

    public function index() 
    {
        $this->load->model('pages_model');

        $results = $this->pages_model->get();

        $this->load->view('templates/header');
        $this->load->view('pages/index', ['pages' => $results ]);
        $this->load->view('templates/footer');     
    }

    public function view($id)
    {
        echo "Pages::view('. $id .')";
    }

}