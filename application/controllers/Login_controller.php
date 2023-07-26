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
        $this->template->write_view('content', 'usuarios/conta/login_view', $current_page, FALSE, );
        $this->template->write_view('menu', 'usuarios/menu_user', $current_page, FALSE);
        $this->template->render();
    }


    public function valida_login()
    {
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');
        
        $this->load->model('login_model');

        $acesso = $this->login_model->verifica_login($email, $senha);
        if ($acesso) {
            $this->setupSessionData($acesso);

            $mensagem = array('tipo' => 'sucess');
            echo json_encode($mensagem);
        } else {

            $mensagem = array('tipo' => 'error');
            echo json_encode($mensagem);
        }
    }

    public function logout()
    {
        $session_data = $this->session->userdata('logged_in');
        $perfil = $session_data['perfil'];
        $this->session->sess_destroy();

        if ($perfil != "admin") {
            redirect("login_controller");
        } else {
            redirect("login_controller");
        }
    }

    private function setupSessionData($acesso)
    {

        $sess_array = array(
            'idusuario' => $acesso->idusuario,
            'nome' => $acesso->nome_user,
            'data_nascimento' => $acesso->data_nasc_user,
            'email' => $acesso->email_user,
            'telefone' => $acesso->telefone_user,
            'observacoes' => $acesso->bio_user,
        );
        $this->session->set_userdata('logged_in', $sess_array);
    }
}
?>