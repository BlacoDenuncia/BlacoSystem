<?php
class Cadastro_controller extends CI_Controller
{
    public function determineCurrentPage()
    {
        $current_page = "cadastro";
        return $current_page;
    }
    function index()
    {
        $page = $this->determineCurrentPage();
        $current_page = array(
            'current_page' => $page
        );
        $this->template->write_view('content', 'usuarios/conta/cadastro_view', $current_page, FALSE, );
        $this->template->write_view('menu', 'usuarios/menu_user', $current_page, FALSE);
        $this->template->render();
    }


    public function cadastrar_usuario()
    {


        $data_usuario = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'telefone' => $this->input->post('telefone'),
            'data_nascimento' => $this->convertDateFormat($this->input->post('data_nascimento'))
        );
        $senha = password_hash($this->input->post('senha'), PASSWORD_DEFAULT);

        $this->load->model('login_model');
        $usuario_id = $this->login_model->cadastrar_usuario($data_usuario);
        if ($usuario_id) {

            $data_login = array(
                'usuario' => $usuario_id,
                'senha' => $senha,
                'perfil' => 'user',
            );

            $login_id = $this->login_model->cadastrar_login($data_login);
            if ($login_id) {
                $mensagem = array('tipo' => 'sucess');
                echo json_encode($mensagem);
            } else {
                $mensagem = array('tipo' => 'error');
                echo json_encode($mensagem);
            }
        } else {

            $mensagem = array('tipo' => 'error'); //comentado errorL
            echo json_encode($mensagem);
        }
    }
    private function convertDateFormat($date)
    {
        $newDate = date('Y-m-d', strtotime($date));
        return $newDate;
    }
}