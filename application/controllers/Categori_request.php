<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categori_request extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Categori_request_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->model('Setting_app_model');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $categori_request = $this->Categori_request_model->get_all();
        $data = array(
            'categori_request_data' => $categori_request,
            'user_data' =>$this->User_model->get_all(),
             'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
        $this->template->load('template','categori_request/categori_request_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Categori_request_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'categori_request_id' => $row->categori_request_id,
         'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'kd_request' => $row->kd_request,
		'request' => $row->request,
	    );
            $this->template->load('template','categori_request/categori_request_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('categori_request'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
             'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => site_url('categori_request/create_action'),
	    'categori_request_id' => set_value('categori_request_id'),
	    'kd_request' => set_value('kd_request'),
	    'request' => set_value('request'),
	);
        $this->template->load('template','categori_request/categori_request_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kd_request' => $this->input->post('kd_request',TRUE),
		'request' => $this->input->post('request',TRUE),
	    );
            $this->Categori_request_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('categori_request'));
        }
    }

    public function create_action_approved() 
    {
        is_allowed($this->uri->segment(1),'create');
            $data = array(
        'step' => $this->input->post('step',TRUE),
        'categori_request_id' => $this->input->post('categori_request_id',TRUE),
        'user_id' => $this->input->post('user_id',TRUE),
        );
            $this->Categori_request_model->insert_approved($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('categori_request'));
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Categori_request_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                 'sett_apps' =>$this->Setting_app_model->get_by_id(1),
                'action' => site_url('categori_request/update_action'),
		'categori_request_id' => set_value('categori_request_id', $row->categori_request_id),
		'kd_request' => set_value('kd_request', $row->kd_request),
		'request' => set_value('request', $row->request),
	    );
            $this->template->load('template','categori_request/categori_request_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('categori_request'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('categori_request_id', TRUE));
        } else {
            $data = array(
		'kd_request' => $this->input->post('kd_request',TRUE),
		'request' => $this->input->post('request',TRUE),
	    );

            $this->Categori_request_model->update($this->input->post('categori_request_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('categori_request'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Categori_request_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Categori_request_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('categori_request'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('categori_request'));
        }
    }

    public function delete_approved($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Categori_request_model->get_by_id_approved(decrypt_url($id));
        if ($row) {
            $this->Categori_request_model->delete_approved(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('categori_request'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('categori_request'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kd_request', 'kd request', 'trim|required');
	$this->form_validation->set_rules('request', 'request', 'trim|required');

	$this->form_validation->set_rules('categori_request_id', 'categori_request_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "categori_request.xls";
        $judul = "categori_request";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kd Request");
	xlsWriteLabel($tablehead, $kolomhead++, "Request");

	foreach ($this->Categori_request_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kd_request);
	    xlsWriteLabel($tablebody, $kolombody++, $data->request);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Categori_request.php */
/* Location: ./application/controllers/Categori_request.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-29 06:14:25 */
/* http://harviacode.com */
