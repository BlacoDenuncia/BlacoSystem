<?php

class Boletim_model extends CI_Model {

    const TABELA = 'CasosRacismoDiscriminacao';

    function __construct() {
        parent::__construct();
    }

    function registra_denuncia($id_denuncia, $data_hora_caso, $nome_vitima, $idade_vitima, $contato_vitima, $email_vitima, $genero_vitima, $etnia_vitima, $tipo_violencia, $descricao_agressor, $descricao_caso, $rua, $bairro, $cidade, $estado, $tipo_estabelecimento, $permite_dados){
							   	
        $arrayInsert = array(
            'id_denuncia' => $id_denuncia,
            'data_hora_caso' => $data_hora_caso,
            'nome_vitima' => $nome_vitima,
            'idade_vitima' => $idade_vitima,
            'contato_vitima' => $contato_vitima,
            'email_vitima' => $email_vitima,
            'genero_vitima' => $genero_vitima,
            'etnia_vitima' => $etnia_vitima,
            'tipo_violencia' => $tipo_violencia,
            'descricao_agressor' => $descricao_agressor,
            'descricao_caso' => $descricao_caso,
            'rua' => $rua,
            'bairro' => $bairro,
            'cidade' => $cidade,
            'estado' => $estado,
            'tipo_estabelecimento' => $tipo_estabelecimento,
            'permissao_uso_dados' => $permite_dados
        );
        $inserir = $this->db->insert(self::TABELA, $arrayInsert);		
    
        if($inserir)
            return true;
        else
            return false;
    } 
}

?>