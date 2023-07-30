<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index_controller extends CI_Controller
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

	//Determina a página atual manualmente
	public function determineCurrentPage()
	{
		$current_page = "index";
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

			$this->template->write_view('content', 'usuarios/index_view', $data, FALSE);
			$this->template->write_view('menu', 'usuarios/menu_user', $data, FALSE);
			$this->template->render();
		}else{
			$this->template->write_view('content', 'usuarios/index_view', $current_page, FALSE);
			$this->template->write_view('menu', 'usuarios/menu_user', $current_page, FALSE);
			$this->template->render();
		}
		

	}
}