<?php

class Pages_model extends CI_Model
{

    public function __construct() 
    {
        parent::__construct(); //Sempre chamar esse cara para evitar erro dele não sobre escrever o método
        $this->load->database(); // Carrega o database para usar o db
    }

    public function get()
    {               
        $query = $this->db->get('pages');
        return $query->result();
    }

    public function new()
    {
        $this->load->helper('url');
        $slug = url_title($this->input->post('title'), 'dash', true);

        $data = [
            'title' => $this->input->post('title'),
            'body' => $this->input->post('body'),
            'slug' => $this->input->post('slug'),
        ];

        return $this->db->insert('pages', $data); // Realiza inserção no banco, tabela pages, com os dados
    }
}
