<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Boletim_controller extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function determineCurrentPage()
    {
        $current_page = "boletim";
        return $current_page;
    }
    public function index()
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

            $this->template->write_view('content', 'usuarios/boletim/chat_denuncia_view', $data, FALSE);
            $this->template->write_view('menu', 'usuarios/menu_user', $data, FALSE);
            $this->template->render();
        } else {
            $this->template->write_view('content', 'usuarios/boletim/chat_denuncia_view', $current_page, FALSE);
            $this->template->write_view('menu', 'usuarios/menu_user', $current_page, FALSE);
            $this->template->render();
        }
    }
    function buscar_mensagens()
    {
        // Obter o valor da mensagem enviado pelo usuário
        $mensagem_numero = $this->input->post('messageNumber');

        $mensagens = [
            1 => 'Olá, responda as perguntas a seguir para que possamos te ajudar com a denúncia. Garantimos a segurança 
            dos dados e que dados pessoais não serão divulgados. </br> </br> De início, qual o seu nome?',
            2 => 'Informe a sua idade:',
            3 => 'Digite o numero do telefone de contato',
            4 => 'Digite o email de contato: ( uma cópia da denuncia será enviada ao seu email )',
            5 => 'Selecione o seu gênero:',
            6 => 'Selecione a raça/cor que melhor te identifica:',
            7 => 'Sobre a denúncia, qual o tipo de violência você considera ter sofrido? Selecione abaixo',
            8 => 'Faça uma descrição das características do agressor:',
            9 => 'Descreva com o máximo de detalhes o que ocorreu:',
            10 => 'Informe a localização do ocorrido: Qual a rua?',
            11 => 'Informe o bairro:',
            12 => 'Informe a cidade',
            13 => 'Informe o Estado',
            14 => 'Qual o tipo do estabelecimento?',
            15 => 'Informações enviadas serão enviadas para um orgão de segurança e, dados não pessoais, utilizadas para fins estatísticos e de pesquisa. Elas não serão compartilhadas publicamente </br></br> <input type="checkbox" class="form-check-input" id="aceitaDadosCheck">
            <label class="form-check-label" for="aceitaDadosCheck">Eu aceito a utilização dos dados da minha
               denúncia</label>',
            16 => 'Chegamos ao fim! Ao contribuir com essa denúncia, orgãos públicos e privados podem ajudar de forma mais eficiente nos combate a desigualdades e preconceitos. </br></br> Encaminharemos a denúncia e a ajuda necessária entrará em contato',
            17 => '<button type="button" class="btn btn-success btnEnviarDenuncia" id="btnEnviarDenuncia">
            <span class="bi bi-check" aria-hidden="true"></span> Enviar
         </button>',
            
        ];

        // Verificar se o número está presente nas mensagens
        if (isset($mensagens[$mensagem_numero])) {
            $mensagem = array('tipo' => $mensagens[$mensagem_numero]); //comentado errorL
            echo json_encode($mensagem);
        } else {
            $mensagem = array('tipo' => 'error'); //comentado errorL
            echo json_encode($mensagem);
        }
    }
    function validar_email()
    {
        $email_vitima = $this->input->post('email_vitima');
        if (filter_var($email_vitima, FILTER_VALIDATE_EMAIL)) {
            // Email syntax is valid
            $mensagem = array('tipo' => 'email-valido'); //comentado errorL
            echo json_encode($mensagem);
        } else {
            // Email syntax is invalid
            $mensagem = array('tipo' => 'email-invalido'); //comentado errorL
            echo json_encode($mensagem);
        }
    }
    function registrar_denuncia()
    {
        //$idana = $this->input->post('idana');
        //Recebe dados
        $id_usuario = $this->input->post('id_usuario');
        $id_denuncia = null;
        $data_hora_envio = $this->input->post('data_hora_envio');
        $nome_vitima = $this->input->post('nome_vitima');
        $idade_vitima = $this->input->post('idade_vitima');
        $contato_vitima = $this->input->post('contato_vitima');
        $email_vitima = $this->input->post('email_vitima');
        $genero_vitima = $this->input->post('genero_vitima');
        $etnia_vitima = $this->input->post('etnia_vitima');
        $tipo_violencia = $this->input->post('tipo_violencia');
        $descricao_agressor = $this->input->post('descricao_agressor');
        $descricao_caso = $this->input->post('descricao_caso');
        $rua = $this->input->post('rua');
        $bairro = $this->input->post('bairro');
        $cidade = $this->input->post('cidade');
        $estado = $this->input->post('estado');
        $tipo_estabelecimento = $this->input->post('tipo_estabelecimento');
        $permite_dados = ($this->input->post('permite_dados') === 'true') ? 1 : 0;

        $this->load->model('Boletim_model');

        $inserir = $this->Boletim_model->registra_denuncia($id_usuario, $id_denuncia, $data_hora_envio, $nome_vitima, $idade_vitima, $contato_vitima, $email_vitima, $genero_vitima, $etnia_vitima, $tipo_violencia, $descricao_agressor, $descricao_caso, $rua, $bairro, $cidade, $estado, $tipo_estabelecimento, $permite_dados);
        if ($inserir) {

            $mensagem = array('tipo' => 'success');
            echo json_encode($mensagem);
        } else {
            $mensagem = array('tipo' => 'error'); //comentado errorL
            echo json_encode($mensagem);
        }
    }

    public function enviar_email()
    {
        $this->load->library('phpmailer_lib');
        /* PHPMailer object */
        $mail = $this->phpmailer_lib->load();

        /* SMTP configuration */
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'suporte@blaco.com.br';
        $mail->Password = 'BLACO.252863.suporte';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        //Recebe dados do JS
        $data_hora_envio = $this->input->post('data_hora_envio');
        $nome_vitima = $this->input->post('nome_vitima');
        $idade_vitima = $this->input->post('idade_vitima');
        $contato_vitima = $this->input->post('contato_vitima');
        $email_vitima = $this->input->post('email_vitima');
        $genero_vitima = $this->input->post('genero_vitima');
        $etnia_vitima = $this->input->post('etnia_vitima');
        $tipo_violencia = $this->input->post('tipo_violencia');
        $descricao_agressor = $this->input->post('descricao_agressor');
        $descricao_caso = $this->input->post('descricao_caso');
        $rua = $this->input->post('rua');
        $bairro = $this->input->post('bairro');
        $cidade = $this->input->post('cidade');
        $estado = $this->input->post('estado');
        $tipo_estabelecimento = $this->input->post('tipo_estabelecimento');

        $mail->setFrom('suporte@blaco.com.br', 'BLACO Suporte');
        $mail->addAddress($email_vitima, $nome_vitima);

        $mail->isHTML(TRUE);
        $mail->Subject = 'Denúncia Registrada';

        $emailBody = '<html><body>';
        $emailBody .= '<h1>Detalhes da Denúncia</h1>';
        $emailBody .= '<p><strong>Data e Hora do Envio:</strong> ' . $data_hora_envio . '</p>';
        $emailBody .= '<p><strong>Nome da Vítima:</strong> ' . $nome_vitima . '</p>';
        $emailBody .= '<p><strong>Idade da Vítima:</strong> ' . $idade_vitima . '</p>';
        $emailBody .= '<p><strong>Contato da Vítima:</strong> ' . $contato_vitima . '</p>';
        $emailBody .= '<p><strong>Email da Vítima:</strong> ' . $email_vitima . '</p>';
        $emailBody .= '<p><strong>Gênero da Vítima:</strong> ' . $genero_vitima . '</p>';
        $emailBody .= '<p><strong>Etnia da Vítima:</strong> ' . $etnia_vitima . '</p>';
        $emailBody .= '<p><strong>Tipo de Violência:</strong> ' . $tipo_violencia . '</p>';
        $emailBody .= '<p><strong>Descrição do Agressor:</strong> ' . $descricao_agressor . '</p>';
        $emailBody .= '<p><strong>Descrição do Caso:</strong> ' . $descricao_caso . '</p>';
        $emailBody .= '<p><strong>Rua:</strong> ' . $rua . '</p>';
        $emailBody .= '<p><strong>Bairro:</strong> ' . $bairro . '</p>';
        $emailBody .= '<p><strong>Cidade:</strong> ' . $cidade . '</p>';
        $emailBody .= '<p><strong>Estado:</strong> ' . $estado . '</p>';
        $emailBody .= '<p><strong>Tipo do Estabelecimento:</strong> ' . $tipo_estabelecimento . '</p>';
        $emailBody .= '</body></html>';

        // Assign the email body
        $mail->Body = $emailBody;

        // Use the mail() function to send the email
        if (!$mail->send()) {
            $mensagem = array('tipo' => 'error'); //comentado errorL
            echo json_encode($mensagem);
        } else {
            $mensagem = array('tipo' => 'success'); //comentado errorL
            echo json_encode($mensagem);
        }
    }
}