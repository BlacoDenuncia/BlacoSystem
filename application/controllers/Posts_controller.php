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
                redirect('login_controller');
            }
        } else {
            redirect('login_controller');
        }

    }

    public function upload_image()
    {
        if (!empty($_FILES['file']['name'])) {

            $config['upload_path'] = FCPATH . 'postImages/';

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 777, true);
            }

            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 5120; //5mb

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {

                $image_path = 'postImages/' . $this->upload->data('file_name');

                $response = array(
                    'success' => true,
                    'image_path' => $image_path,
                );
                echo json_encode($response);
            } else {

                $response = array(
                    'success' => false,
                    'message' => $this->upload->display_errors(),
                );
                echo json_encode($response);
            }
        } else {

            $response = array(
                'success' => false,
                'message' => 'Please select an image to upload.',
            );
            echo json_encode($response);
        }
    }

    public function criarPost()
    {
        $post_title = $this->input->post('post_title_data');
        $post_subtitle = $this->input->post('post_subtitle_data');
        $post_type = $this->input->post('post_type_data');
        $conteudo = $this->input->post('conteudo_data');
        $image_path = $this->input->post('image_path_data');

        $this->load->model('posts_model');
        $post_status = $this->posts_model->armazenarPost($post_title, $post_subtitle, $post_type, $conteudo, $image_path);

        if ($post_status) {
            $mensagem = array('tipo' => 'sucess');
            echo json_encode($mensagem);
        } else {
            $mensagem = array('tipo' => 'error');
            echo json_encode($mensagem);
        }
    }
    public function excluirImagem()
    {
        // Verifique se a solicitação é POST
        if ($this->input->method(TRUE) == 'POST') {
            // Obtenha o caminho da imagem a ser excluída
            $image_path = $this->input->post('image_path');

            $remove = unlink(FCPATH . $image_path);

            if ($remove) {
                // Envie uma resposta JSON indicando o sucesso ou falha
                $response = array('success' => true);
                echo json_encode($response);
            } else {
                // Envie uma resposta JSON indicando o sucesso ou falha
                $response = array('success' => false);
                echo json_encode($response);
            }

        } else {
            // Se não for uma solicitação POST, retorne um erro
            show_404();
        }
    }
}
?>