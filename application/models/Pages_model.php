<?php

class Pages_model extends CI_Model
{
    public function get()
    {
        // Carrega o database para usar o db
        $this->load->database();
        $query = $this->db->get('pages');
        return $query->result();
    }
}
