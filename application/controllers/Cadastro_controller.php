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
            $this->template->write_view('content', 'usuarios/conta/cadastro_view', $current_page, FALSE);
            $this->template->write_view('menu', 'usuarios/menu_user', $current_page, FALSE);
            $this->template->render();
        }
    }

    public function enviarEmail($emailUsuario, $randomCode)
    {
        $this->load->library('phpmailer_lib');

        $mail = $this->phpmailer_lib->load();

        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'suporte@blaco.com.br';
        $mail->Password = 'BLACO.252863.suporte';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('suporte@blaco.com.br', 'BLACO Suporte');
        $mail->addAddress($emailUsuario);

        $mail->isHTML(TRUE);
        $mail->Subject = 'Validação de cadastro BLACO';

        $emailTemplate = '<html> 
        <body> 
        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
        <h1> Seu código de verificação </h1> 
        <br> 

        <p> Obrigado por confiar em nosso serviço! Use o código abaixo para finalizar seu cadastro </p>
        <br>
        <div style="display: flex; justify-content: center; align-items: center; background-color: #fa5019; color: #fff; width: 100px; border-radius: 10px;">
        <p style="padding: 10px;"> ' . $randomCode . ' </p>
        </div>
        </div>
        </body> 
        </html>';

        $mail->Body = $emailTemplate;

        $enviou = $mail->send() ? true : false;
        return $enviou;

    }
    public function validar_cadastro()
    {
        $emailUsuario = $this->input->post('email');
        $randomCode = rand(100000, 999999);

        $enviouEmail = $this->enviarEmail($emailUsuario, $randomCode);

        if ($enviouEmail) {
            $mensagem = array('tipo' => 'sucess', 'code' => $randomCode);
        } else {
            $mensagem = array('tipo' => 'error', 'code' => NULL);
        }

        echo json_encode($mensagem);
    }
    public function buscar_cadastro()
    {
        $emailUsuario = $this->input->post('email');

        $this->load->model('login_model');
        $encontrou = $this->login_model->buscar_usuario($emailUsuario);

        if ($encontrou) {
            $mensagem = array('tipo' => true);
        } else {
            $mensagem = array('tipo' => false);
        }
        echo json_encode($mensagem);
    }


    public function cadastrar_usuario()
    {


        $data_usuario = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'telefone' => $this->input->post('telefone'),
            'data_nascimento' => $this->convertDateFormat($this->input->post('data_nascimento')),
            'perfil' => 'user',
        );
        $senha = password_hash($this->input->post('senha'), PASSWORD_DEFAULT);

        $this->load->model('login_model');
        $usuario_id = $this->login_model->cadastrar_usuario($data_usuario);
        if ($usuario_id) {

            $data_login = array(
                'usuario' => $usuario_id,
                'senha' => $senha,
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