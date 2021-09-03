<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lokasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Lokasi_model');
        $this->load->model('Setting_app_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $lokasi = $this->Lokasi_model->get_all();
        $data = array(
            'lokasi_data' => $lokasi,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
        $this->template->load('template','lokasi/lokasi_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Lokasi_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'lokasi_id' => $row->lokasi_id,
		'nama_lokasi' => $row->nama_lokasi,
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
	    );
            $this->template->load('template','lokasi/lokasi_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('lokasi'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => site_url('lokasi/create_action'),
	    'lokasi_id' => set_value('lokasi_id'),
	    'nama_lokasi' => set_value('nama_lokasi'),
	);
        $this->template->load('template','lokasi/lokasi_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_lokasi' => $this->input->post('nama_lokasi',TRUE),
	    );

            $this->Lokasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('lokasi'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Lokasi_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
                'action' => site_url('lokasi/update_action'),
		'lokasi_id' => set_value('lokasi_id', $row->lokasi_id),
		'nama_lokasi' => set_value('nama_lokasi', $row->nama_lokasi),
	    );
            $this->template->load('template','lokasi/lokasi_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('lokasi'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('lokasi_id', TRUE));
        } else {
            $data = array(
		'nama_lokasi' => $this->input->post('nama_lokasi',TRUE),
	    );

            $this->Lokasi_model->update($this->input->post('lokasi_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('lokasi'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Lokasi_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Lokasi_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('lokasi'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('lokasi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_lokasi', 'nama lokasi', 'trim|required');

	$this->form_validation->set_rules('lokasi_id', 'lokasi_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "lokasi.xls";
        $judul = "lokasi";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Lokasi");

	foreach ($this->Lokasi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lokasi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Lokasi.php */
/* Location: ./application/controllers/Lokasi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-09-02 10:15:07 */
/* http://harviacode.com */
