<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Karyawan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $karyawan = $this->Karyawan_model->get_all();
        $data = array(
            'karyawan_data' => $karyawan,
        );
        $this->template->load('template','karyawan/karyawan_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Karyawan_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'karyawan_id' => $row->karyawan_id,
		'npk' => $row->npk,
		'nama_karyawan' => $row->nama_karyawan,
		'status_karyawan' => $row->status_karyawan,
		'skill_level' => $row->skill_level,
	    );
            $this->template->load('template','karyawan/karyawan_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'action' => site_url('karyawan/create_action'),
	    'karyawan_id' => set_value('karyawan_id'),
	    'npk' => set_value('npk'),
	    'nama_karyawan' => set_value('nama_karyawan'),
	    'status_karyawan' => set_value('status_karyawan'),
	    'skill_level' => set_value('skill_level'),
	);
        $this->template->load('template','karyawan/karyawan_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'npk' => $this->input->post('npk',TRUE),
		'nama_karyawan' => $this->input->post('nama_karyawan',TRUE),
		'status_karyawan' => $this->input->post('status_karyawan',TRUE),
		'skill_level' => $this->input->post('skill_level',TRUE),
	    );

            $this->Karyawan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('karyawan'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Karyawan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('karyawan/update_action'),
		'karyawan_id' => set_value('karyawan_id', $row->karyawan_id),
		'npk' => set_value('npk', $row->npk),
		'nama_karyawan' => set_value('nama_karyawan', $row->nama_karyawan),
		'status_karyawan' => set_value('status_karyawan', $row->status_karyawan),
		'skill_level' => set_value('skill_level', $row->skill_level),
	    );
            $this->template->load('template','karyawan/karyawan_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('karyawan_id', TRUE));
        } else {
            $data = array(
		'npk' => $this->input->post('npk',TRUE),
		'nama_karyawan' => $this->input->post('nama_karyawan',TRUE),
		'status_karyawan' => $this->input->post('status_karyawan',TRUE),
		'skill_level' => $this->input->post('skill_level',TRUE),
	    );

            $this->Karyawan_model->update($this->input->post('karyawan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('karyawan'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Karyawan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Karyawan_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('karyawan'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('npk', 'npk', 'trim|required');
	$this->form_validation->set_rules('nama_karyawan', 'nama karyawan', 'trim|required');
	$this->form_validation->set_rules('status_karyawan', 'status karyawan', 'trim|required');
	$this->form_validation->set_rules('skill_level', 'skill level', 'trim|required');

	$this->form_validation->set_rules('karyawan_id', 'karyawan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "karyawan.xls";
        $judul = "karyawan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Npk");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Karyawan");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Karyawan");
	xlsWriteLabel($tablehead, $kolomhead++, "Skill Level");

	foreach ($this->Karyawan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->npk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_karyawan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->skill_level);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Karyawan.php */
/* Location: ./application/controllers/Karyawan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-05 05:36:19 */
/* http://harviacode.com */