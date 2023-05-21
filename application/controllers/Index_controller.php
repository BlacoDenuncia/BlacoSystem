
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index_controller extends CI_Controller {
	
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
	public function determineCurrentPage(){
		$current_page = "index";
		return $current_page;
	}
	public function index()
	{
		//configurações de página
		$page = $this->determineCurrentPage();
		$current_page = array(
			'current_page' => $page
		);
        
		//comparar tipo de login e carrega views adequadas
		if ($this->session->userdata('logged_in')) {
            
            $session_data = $this->session->userdata('logged_in');
            $perfil = $session_data['perfil'];
            $acessos = $session_data['acessos'];
            if(($perfil=="admin")){          
				//admin logado 
                $this->template->write_view('content', 'usuarios/erros/indisponivel_view', $current_page, FALSE);
        		$this->template->write_view('menu', 'usuarios/menu_user', $current_page, FALSE);
        		$this->template->render();
            }else{
                //usuário comum logado
                $this->template->write_view('content', 'usuarios/erros/indisponivel_view', $current_page, FALSE);
        		$this->template->write_view('menu', 'usuarios/menu_user', $current_page, FALSE);
        		$this->template->render();
            }
            
        } else {
			//usuário não logado
            $this->template->write_view('content', 'usuarios/mapas/mapa_provisorio', $current_page, FALSE);
        	$this->template->write_view('menu', 'usuarios/menu_user', $current_page, FALSE);
        	$this->template->render();
        }
	}
}