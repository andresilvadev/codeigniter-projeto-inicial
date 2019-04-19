<?php

class Pages extends CI_Controller 
{

    public function index() 
    {
        echo "Pages::index()";
    }

    public function view($id)
    {
        echo "Pages::view('. $id .')";
    }

}