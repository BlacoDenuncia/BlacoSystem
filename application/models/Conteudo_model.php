<?php
class Conteudo_model extends CI_Model
{
    const TABELA = 'posts';

    public function getPostsFromDB()
    {
        
        $query = $this->db->get(self::TABELA);
        return $query->result();
    }
}
?>