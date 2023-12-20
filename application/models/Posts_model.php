<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts_model extends CI_Model {

    const TABELA = 'posts';

    public function __construct(){
        parent::__construct();
    }

    function armazenarPost($post_title, $post_subtitle, $conteudo, $image_path){
        $arrayInsert = array(
            'post_id' => $post_title,
            'title' => $post_title,
            'subtitle' => $post_subtitle,
            'content' => $conteudo,
            'image_path' => $image_path
        );
        $inserir = $this->db->insert(self::TABELA, $arrayInsert);

        if($inserir){
            return true;
        } else {
            return false;
        }
    }
}

?>