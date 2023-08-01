<?php

class Admin_model extends CI_Model
{
    function gerar_planilha_geral()
    {
        $query = $this->db->get('CasosRacismoDiscriminacao');
        return $query->result_array();
    }
}