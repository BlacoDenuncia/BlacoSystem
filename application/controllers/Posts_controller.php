<?php
class Posts_controller extends CI_Controller
{

    public function determineCurrentPage()
    {
        $current_page = 'posts';
        return $current_page;
    }

    public function index()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(APPPATH);
		$dotenv->load();
        
        $page = $this->determineCurrentPage();
        $current_page = array(
            'current_page' => $page
        );
        if ($this->session->userdata('logged_in')) {

            $user_data = $this->session->userdata('logged_in');

            if ($user_data['perfil'] === 'admin') {
                $this->template->write_view('header', 'header_view', $current_page, FALSE);
                $this->template->write_view('content', 'admin/criar_posts_view', $current_page, FALSE);
                $this->template->write_view('menu', 'admin/admin_menu', $current_page, FALSE);
                $this->template->render();
            } else {
                redirect(login_controller);
            }
        } else {
            redirect(login_controller);
        }

    }
}
?>