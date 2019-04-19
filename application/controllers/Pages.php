<?php

class Pages extends CI_Controller 
{

    public function index() 
    {
        $this->load->view('templates/header');
        $this->load->view('pages/index', ['pages' => []]);
        $this->load->view('templates/footer');     
    }

    public function view($id)
    {
        echo "Pages::view('. $id .')";
    }

}