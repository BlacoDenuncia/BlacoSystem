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

			$this->template->write_view('content', 'usuarios/boletim/boletim_view', $data, FALSE);
			$this->template->write_view('menu', 'usuarios/menu_user', $data, FALSE);
			$this->template->render();
		}else{
			$this->template->write_view('content', 'usuarios/boletim/boletim_view', $current_page, FALSE);
			$this->template->write_view('menu', 'usuarios/menu_user', $current_page, FALSE);
			$this->template->render();
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
            /*
            //registra o log da ação
            $result = $this->Turmas_model->busca_ultimo_id();
            $idturma = $result[0]->max_id;       
            $session_data = $this->session->userdata('logged_in');
            $usuario = $session_data["idpessoa"];
            $nome = $session_data["nome"];        
            require_once(APPPATH."libraries/Logs.php");
            $log = new Logs();
            $log->inserirLog("turma",$idturma,$usuario." - ".$nome,"Cadastrou um índice de Turma para a unidade $unidade_educacional");            
            */
        } else {
            $mensagem = array('tipo' => 'error'); //comentado errorL
            echo json_encode($mensagem);
        }
    }

    public function enviar_email()
    {
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

        // Compõe a mensagem de email
        $message = "Nome da vítima: $nome_vitima\n";
        $message .= "Idade da vítima: $idade_vitima\n";
        $message .= "Etnia da vítima: $etnia_vitima\n";
        $message .= "Genero da vítima: $genero_vitima\n";
        $message .= "Contato da vítima: $contato_vitima\n";
        $message .= "Tipo de violência: $tipo_violencia\n";
        $message .= "Descrição do agressor: $descricao_agressor\n";
        $message .= "Descrição do caso: $descricao_caso\n";
        $message .= "Tipo do estabelecimento: $tipo_estabelecimento\n";
        $message .= "Rua: $rua\n";
        $message .= "Bairro: $bairro\n";
        $message .= "Cidade: $cidade\n";
        $message .= "Estado: $estado\n";

        // Configura os email, no caso tem que colocar os emails da BLACO
        $headers = "From: sender@example.com\r\n";
        $headers .= "Reply-To: sender@example.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        $to = $email_vitima;
        $subject = "Denúncia registrada";

        // Use the mail() function to send the email
        $enviaEmail = mail($to, $subject, $message, $headers);
        if ($enviaEmail) {
            $mensagem = array('tipo' => 'success'); //comentado errorL
            echo json_encode($mensagem);
        } else {
            $mensagem = array('tipo' => 'error'); //comentado errorL
            echo json_encode($mensagem);
        }
    }
}