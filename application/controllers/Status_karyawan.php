<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Status_karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Status_karyawan_model');
        $this->load->model('Setting_app_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $status_karyawan = $this->Status_karyawan_model->get_all();
        $data = array(
            'status_karyawan_data' => $status_karyawan,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1), 
        );
        $this->template->load('template','status_karyawan/status_karyawan_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Status_karyawan_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'status_karyawan_id' => $row->status_karyawan_id,
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'nama_status_karyawan' => $row->nama_status_karyawan,
	    );
            $this->template->load('template','status_karyawan/status_karyawan_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('status_karyawan'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => site_url('status_karyawan/create_action'),
	    'status_karyawan_id' => set_value('status_karyawan_id'),
	    'nama_status_karyawan' => set_value('nama_status_karyawan'),
	);
        $this->template->load('template','status_karyawan/status_karyawan_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_status_karyawan' => $this->input->post('nama_status_karyawan',TRUE),
	    );

            $this->Status_karyawan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('status_karyawan'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Status_karyawan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
                'action' => site_url('status_karyawan/update_action'),
		'status_karyawan_id' => set_value('status_karyawan_id', $row->status_karyawan_id),
		'nama_status_karyawan' => set_value('nama_status_karyawan', $row->nama_status_karyawan),
	    );
            $this->template->load('template','status_karyawan/status_karyawan_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('status_karyawan'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('status_karyawan_id', TRUE));
        } else {
            $data = array(
		'nama_status_karyawan' => $this->input->post('nama_status_karyawan',TRUE),
	    );

            $this->Status_karyawan_model->update($this->input->post('status_karyawan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('status_karyawan'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Status_karyawan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Status_karyawan_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('status_karyawan'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('status_karyawan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_status_karyawan', 'nama status karyawan', 'trim|required');

	$this->form_validation->set_rules('status_karyawan_id', 'status_karyawan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "status_karyawan.xls";
        $judul = "status_karyawan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Status Karyawan");

	foreach ($this->Status_karyawan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_status_karyawan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Status_karyawan.php */
/* Location: ./application/controllers/Status_karyawan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-22 08:57:36 */
/* http://harviacode.com */
