<?php

class Pages_model extends CI_Model
{

    private $table_name = 'pages';

    public function __construct() 
    {
        parent::__construct(); //Sempre chamar esse cara para evitar erro dele não sobre escrever o método
        $this->load->database(); // Carrega o database para usar o db
    }

    public function get($id = null)
    {               
        if ($id === null) {
            $query = $this->db->get($this->table_name);
            return $query->result();
        }

        $query = $this->db->get_where($this->table_name, ['id' => $id]);
        return $query->first_row();
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

        return $this->db->insert($this->table_name, $data); // Realiza inserção no banco, tabela pages, com os dados
    }
}
