<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Conta_controller extends CI_Controller
{

	public function determineCurrentPage()
	{
		$current_page = "conta";
		return $current_page;
	}
	public function index()
	{
		
		$page = $this->determineCurrentPage();
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

			$this->template->write_view('content', 'usuarios/conta/perfil_view', $data, FALSE);
			$this->template->write_view('menu', 'usuarios/menu_user', $data, FALSE);
			$this->template->render();
		}else{
			$this->template->write_view('content', 'usuarios/conta/login_view', $page, FALSE, );
			$this->template->write_view('menu', 'usuarios/menu_user', $page, FALSE);
			$this->template->render();
		}

		
	}
}