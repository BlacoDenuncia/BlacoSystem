<?php

class Admin_model extends CI_Model
{
    function gerar_planilha_geral()
    {
        $query = $this->db->get('CasosRacismoDiscriminacao');
        return $query->result_array();
    }
    public function gerar_planilhas_permitidas()
    {
        
        $this->db->select('id_denuncia, idusuario, data_hora_envio, nome_vitima, idade_vitima, contato_vitima, email_vitima, genero_vitima, etnia_vitima, bairro, cidade, rua, estado, tipo_violencia, descricao_caso, descricao_agressor, tipo_estabelecimento, permissao_uso_dados');
        $this->db->where('permissao_uso_dados', 1);
        $query = $this->db->get('CasosRacismoDiscriminacao'); 

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}