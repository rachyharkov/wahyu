<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Divisi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Divisi_model');
        $this->load->model('Setting_app_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $divisi = $this->Divisi_model->get_all();
        $data = array(
            'divisi_data' => $divisi,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1), 
        );
        $this->template->load('template','divisi/divisi_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Divisi_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'divisi_id' => $row->divisi_id,
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'kode_divisi' => $row->kode_divisi,
		'nama_divisi' => $row->nama_divisi,
	    );
            $this->template->load('template','divisi/divisi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('divisi'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => site_url('divisi/create_action'),
	    'divisi_id' => set_value('divisi_id'),
	    'kode_divisi' => set_value('kode_divisi'),
	    'nama_divisi' => set_value('nama_divisi'),
	);
        $this->template->load('template','divisi/divisi_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_divisi' => $this->input->post('kode_divisi',TRUE),
		'nama_divisi' => $this->input->post('nama_divisi',TRUE),
	    );

            $this->Divisi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('divisi'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Divisi_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
                'action' => site_url('divisi/update_action'),
		'divisi_id' => set_value('divisi_id', $row->divisi_id),
		'kode_divisi' => set_value('kode_divisi', $row->kode_divisi),
		'nama_divisi' => set_value('nama_divisi', $row->nama_divisi),
	    );
            $this->template->load('template','divisi/divisi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('divisi'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('divisi_id', TRUE));
        } else {
            $data = array(
		'kode_divisi' => $this->input->post('kode_divisi',TRUE),
		'nama_divisi' => $this->input->post('nama_divisi',TRUE),
	    );

            $this->Divisi_model->update($this->input->post('divisi_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('divisi'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Divisi_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Divisi_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('divisi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('divisi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_divisi', 'kode divisi', 'trim|required');
	$this->form_validation->set_rules('nama_divisi', 'nama divisi', 'trim|required');

	$this->form_validation->set_rules('divisi_id', 'divisi_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "divisi.xls";
        $judul = "divisi";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Divisi");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Divisi");

	foreach ($this->Divisi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_divisi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_divisi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Divisi.php */
/* Location: ./application/controllers/Divisi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-22 09:19:21 */
/* http://harviacode.com */