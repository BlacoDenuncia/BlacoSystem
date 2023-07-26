<?php

class Login_model extends CI_Model
{

    const TABELA = 'login';

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Sao_Paulo');
        //error_reporting(-1);
        //ini_set('display_errors', 1);
    }


    function verifica_login($email, $senha)
    {
        $sql = " SELECT *, u.*, l.senha as senha_hashed, u.nome as nome_user, "
            . "u.data_nascimento as data_nasc_user, "
            . "u.email as email_user, u.telefone as telefone_user, u.observacoes as bio_user "
            . "FROM usuarios u "
            . "JOIN login l ON u.idusuario = l.usuario "
            . "WHERE u.email = ? AND l.senha = ?";

        $query = $this->db->query($sql, array($email, $senha));

        if ($this->db->affected_rows() > 0) {
            return $query->result();
        } else {
            return false;

        }

    }
    public function cadastrar_usuario($data)
    {
        $this->db->insert('usuarios', $data);
        return $this->db->insert_id();
    }
    public function cadastrar_login($data)
    {
        $this->db->insert('login', $data);

        // Use the 'usuario' field as the login_id
        $login_id = $data['usuario'];

        // Check if the insert operation was successful
        if ($this->db->affected_rows() > 0) {
            return $login_id;
        } else {
            return false;
        }
    }
}