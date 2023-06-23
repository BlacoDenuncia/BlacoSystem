<?php

class Boletim_model extends CI_Model {

    const TABELA = 'CasosRacismoDiscriminacao';

    function __construct() {
        parent::__construct();
    }

    function registra_denuncia($id_denuncia, $data_hora_caso, $nome_vitima, $idade_vitima, $contato_vitima, $email_vitima, $genero_vitima, $etnia_vitima, $tipo_violencia, $descricao_agressor, $descricao_caso, $rua, $numero_do_local, $bairro, $cidade, $estado, $tipo_estabelecimento, $nome_estabelecimento, $nome_testemunha, $contato_testemunha, $email_testemunha, $acoes_tomadas, $impacto_emocional){
							   	
        $arrayInsert = array(
            'iddenuncia' => $id_denuncia,
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
            'numero_do_local' => $numero_do_local,
            'bairro' => $bairro,
            'cidade' => $cidade,
            'estado' => $estado,
            'tipo_estabelecimento' => $tipo_estabelecimento,
            'nome_estabelecimento' => $nome_estabelecimento,
            'nome_testemunha' => $nome_testemunha,
            'contato_testemunha' => $contato_testemunha,
            'email_testemunha' => $email_testemunha,
            'acoes_tomadas' => $acoes_tomadas,
            'impacto_emocional' => $impacto_emocional
        );
        $inserir = $this->db->insert(self::TABELA, $arrayInsert);		
    
        if($inserir)
            return true;
        else
            return false;
    } 
}

?>