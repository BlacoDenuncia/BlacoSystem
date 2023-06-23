
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boletim_controller extends CI_Controller {

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
	public function determineCurrentPage(){
		$current_page = "boletim";
		return $current_page;
	}
	public function index()
	{
		$page = $this->determineCurrentPage();
		$current_page = array(
			'current_page' => $page
		);
        $this->template->write_view('content', 'usuarios/boletim/boletim_view', $current_page, FALSE,);
        $this->template->write_view('menu', 'usuarios/menu_user', $current_page, FALSE);
        $this->template->render();
	}
	function registrar_denuncia() {
        //$idana = $this->input->post('idana');
		//Recebe dados
        
		$id_denuncia = null;
		$data_hora_caso = $this->input->post('data_hora_caso');
        $nome_vitima  = $this->input->post('nome_vitima');
        $idade_vitima = $this->input->post('idade_vitima');
        $contato_vitima  = $this->input->post('contato_vitima');
        $email_vitima = $this->input->post('email_vitima');
		$genero_vitima = $this->input->post('genero_vitima');
        $etnia_vitima = $this->input->post('etnia_vitima');
        $tipo_violencia = $this->input->post('tipo_violencia');
        $descricao_agressor = $this->input->post('descricao_agressor');
		$descricao_caso = $this->input->post('descricao_caso');
        $rua  = $this->input->post('rua');
        $numero_do_local = $this->input->post('numero_do_local');
        $bairro = $this->input->post('bairro');
		$cidade = $this->input->post('cidade');
        $estado = $this->input->post('estado');
        $tipo_estabelecimento = $this->input->post('tipo_estabelecimento');
        $nome_estabelecimento = $this->input->post('nome_estabelecimento');
		$nome_testemunha = $this->input->post('nome_testemunha');
        $contato_testemunha = $this->input->post('contato_testemunha');
        $email_testemunha = $this->input->post('email_testemunha');
        $acoes_tomadas = $this->input->post('acoes_tomadas');
		$impacto_emocional = $this->input->post('impacto_emocional');

        $this->load->model('Boletim_model');
               
        $inserir = $this->Boletim_model->registra_denuncia($id_denuncia, $data_hora_caso, $nome_vitima, $idade_vitima, $contato_vitima, $email_vitima, $genero_vitima, $etnia_vitima, $tipo_violencia, $descricao_agressor, $descricao_caso, $rua, $numero_do_local, $bairro, $cidade, $estado, $tipo_estabelecimento, $nome_estabelecimento, $nome_testemunha, $contato_testemunha, $email_testemunha, $acoes_tomadas, $impacto_emocional);		
        if($inserir){
            
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
        }else{
            $mensagem = array('tipo' => 'error'); //comentado errorL
            echo json_encode($mensagem);
        }
    }
}