<?php

require_once FCPATH . 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

defined('BASEPATH') or exit('No direct script access allowed');

class Planilhas_controller extends CI_Controller
{

    public function determineCurrentPage()
    {
        $current_page = 'planilhas';
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
                $this->template->write_view('content', 'admin/planilhas_view', $current_page, FALSE);
                $this->template->write_view('menu', 'admin/admin_menu', $current_page, FALSE);
                $this->template->render();
            } else {
                redirect(login_controller);
            }
        } else {
            redirect(login_controller);
        }

    }
    public function generate_geral_excel()
    {

        $this->load->model('Admin_model');
        $data = $this->Admin_model->gerar_planilha_geral();


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        $headers = array(
            'ID Denuncia',
            'ID Usuário',
            'Data/Hora Envio',
            'Nome da Vítima',
            'Idade da Vítima',
            'Contato da Vítima',
            'Email da Vítima',
            'Gênero da Vítima',
            'Etnia da Vítima',
            'Bairro',
            'Cidade',
            'Rua',
            'Estado',
            'Tipo de Violência',
            'Descrição do Caso',
            'Descrição do Agressor',
            'Tipo de Estabelecimento',
            'Permitiu Uso de Dados'
        );

        $columnIndex = 1;
        foreach ($headers as $header) {
            $cellAddress = $this->getColumnLetter($columnIndex) . '1';
            $sheet->setCellValue($cellAddress, $header);
            $columnIndex++;
        }

        // Example: Write data to the Excel file
        $row = 2; // Start from row 2 since row 1 contains headers
        foreach ($data as $row_data) {
            $columnIndex = 1;
            foreach ($row_data as $cellValue) {
                $cellAddress = $this->getColumnLetter($columnIndex) . $row;
                $sheet->setCellValue($cellAddress, $cellValue);
                $columnIndex++;
            }
            $row++;
        }

        // Set the response content type and headers for the Excel file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="boletim_data.xlsx"');
        header('Cache-Control: max-age=0');

        // Save the Excel file to PHP output buffer (no need to save on the server)
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        // Exit the script to prevent any further output
        exit();
    }

    // Function to get column letter based on column index (e.g., 1 -> 'A', 2 -> 'B', ...)
    
    public function generate_excel_with_permission()
    {
        $this->load->model('Admin_model');
        $data = $this->Admin_model->gerar_planilhas_permitidas();

        if (empty($data)) {
            
            echo json_encode(array('status' => 'error', 'message' => 'No data with permission found.'));
            return;
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = array(
            'ID Denuncia',
            'ID Usuário',
            'Data/Hora Envio',
            'Nome da Vítima',
            'Idade da Vítima',
            'Contato da Vítima',
            'Email da Vítima',
            'Gênero da Vítima',
            'Etnia da Vítima',
            'Bairro',
            'Cidade',
            'Rua',
            'Estado',
            'Tipo de Violência',
            'Descrição do Caso',
            'Descrição do Agressor',
            'Tipo de Estabelecimento',
            'Permissão Uso de Dados'
        );

        $columnIndex = 1;
        foreach ($headers as $header) {
            $cellAddress = $this->getColumnLetter($columnIndex) . '1';
            $sheet->setCellValue($cellAddress, $header);
            $columnIndex++;
        }

        $row = 2;
        foreach ($data as $row_data) {
            $columnIndex = 1;
            foreach ($row_data as $cellValue) {
                $cellAddress = $this->getColumnLetter($columnIndex) . $row;
                $sheet->setCellValue($cellAddress, $cellValue);
                $columnIndex++;
            }
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="boletim_data_with_permission.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        exit();
    }
    private function getColumnLetter($columnIndex)
    {
        return chr(65 + ($columnIndex - 1));
    }
}