<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *  
 */
class Login_controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Sao_Paulo');
        ini_set("display_errors", 1);
        error_reporting(1);
    }
    public function determineCurrentPage()
    {
        $current_page = "conta";
        return $current_page;
    }
    function index()
    {
        $page = $this->determineCurrentPage();
        $current_page = array(
			'current_page' => $page
		);
        if ($this->session->userdata('logged_in')) {

            $user_data = $this->session->userdata('logged_in');


            $idusuario = $user_data['idusuario'];
            $nome = $user_data['nome'];
            $data_nascimento = $user_data['data_nascimento'];
            $email = $user_data['email'];
            $telefone = $user_data['telefone'];
            $observacoes = $user_data['observacoes'];

            $data = array(
                'idusuario' => $idusuario,
                'nome' => $nome,
                'data_nascimento' => $data_nascimento,
                'email' => $email,
                'telefone' => $telefone,
                'observacoes' => $observacoes,
                'current_page' => $this->determineCurrentPage()
            );

            $this->template->write_view('header', 'header_view', $data, FALSE);
            $this->template->write_view('content', 'usuarios/conta/perfil_view', $data, FALSE);
            $this->template->write_view('menu', 'usuarios/menu_user', $data, FALSE);
            $this->template->render();
        } else {
            $this->template->write_view('header', 'header_view', $current_page, FALSE);
            $this->template->write_view('content', 'usuarios/conta/login_view', $current_page, FALSE);
            $this->template->write_view('menu', 'usuarios/menu_user', $current_page, FALSE);
            $this->template->render();
        }
    }


    public function valida_login()
    {
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');

        $this->load->model('login_model');

        $acesso = $this->login_model->verifica_login($email, $senha);
        if ($acesso) {
            $user_id = $acesso->idusuario;
            $this->load->model('conta_model');
            $user_photo_url = $this->conta_model->get_user_photo_url($user_id);
            $this->setupSessionData($acesso, $user_photo_url);

            $mensagem = array('tipo' => 'sucess');
            echo json_encode($mensagem);
        } else {

            $mensagem = array('tipo' => 'error');
            echo json_encode($mensagem);
        }
    }

    private function setupSessionData($acesso, $user_photo_url)
    {

        $sess_array = array(
            'idusuario' => $acesso->idusuario,
            'nome' => $acesso->nome_user,
            'data_nascimento' => $acesso->data_nasc_user,
            'email' => $acesso->email_user,
            'telefone' => $acesso->telefone_user,
            'observacoes' => $acesso->bio_user,
            'perfil' => $acesso->perfil,
            'photo_path' => $user_photo_url,
        );
        $this->session->set_userdata('logged_in', $sess_array);
    }
}
?>