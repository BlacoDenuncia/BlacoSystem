<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Conta_controller extends CI_Controller
{

    public function determineCurrentPage()
    {
        $current_page = 'conta';
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

            if ($user_data['perfil'] === 'admin') {
                $this->template->write_view('content', 'admin/dashboard_view', $current_page, FALSE);
                $this->template->write_view('menu', 'admin/admin_menu', $current_page, FALSE);
                $this->template->render();
            } else {
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
            }
        } else {
            $this->template->write_view('content', 'usuarios/conta/login_view', $current_page, FALSE, );
            $this->template->write_view('menu', 'usuarios/menu_user', $current_page, FALSE);
            $this->template->render();
        }

    }

    public function upload_photo()
    {
        $user_id = $this->session->userdata('logged_in')['idusuario'];

        if (!empty($_FILES['user_photo']['name'])) {

            $config['upload_path'] = FCPATH . 'usersPhotos/';

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }

            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            // 2 MB

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('user_photo')) {

                $photo_path = 'usersPhotos/' . $this->upload->data('file_name');

                $this->load->model('conta_model');
                $this->conta_model->save_user_photo($user_id, $photo_path);

                $user_data = $this->session->userdata('logged_in');
                $user_data['photo_path'] = $photo_path;
                $this->session->set_userdata('logged_in', $user_data);

                $response = array(
                    'success' => true,
                    'message' => 'Photo uploaded successfully.',
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
                'message' => 'Please select a photo to upload.',
            );
            echo json_encode($response);
        }
    }

    public function update_user_data()
    {
        if ($this->input->post()) {
            $user_data = $this->session->userdata('logged_in');

            if (isset($user_data) && isset($user_data['idusuario'])) {
                $user_id = $this->session->userdata('logged_in')['idusuario'];
                $data = array(
                    'nome' => $this->input->post('nome'),
                    'data_nascimento' => $this->convertDateFormat($this->input->post('data_nascimento')),
                    'email' => $this->input->post('email'),
                    'telefone' => $this->input->post('telefone'),
                );

                $this->load->model('conta_model');
                $atualizar = $this->conta_model->update_user_data($user_id, $data);
                if ($atualizar) {

                    $user_data['nome'] = $atualizar['nome'];
                    $user_data['data_nascimento'] = $atualizar['data_nascimento'];
                    $user_data['email'] = $atualizar['email'];
                    $user_data['telefone'] = $atualizar['telefone'];

                    // Set the modified session data back to the session
                    $this->session->set_userdata('logged_in', $user_data);

                    $mensagem = array('tipo' => 'success');
                    echo json_encode($mensagem);

                } else {
                    $mensagem = array('tipo' => 'error');
                    echo json_encode($mensagem);
                }
            }

        } else {
            $mensagem = array('tipo' => 'error');
            echo json_encode($mensagem);
        }

    }
    public function logout()
    {
        $this->session->unset_userdata('logged_in'); // Remove the user data from the session
        $mensagem = array('tipo' => 'sucess');
        echo json_encode($mensagem);
    }
    private function convertDateFormat($date)
    {
        $newDate = date('Y-m-d', strtotime($date));
        return $newDate;
    }
}