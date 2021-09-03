<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categori_potongan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Categori_potongan_model');
        $this->load->model('Setting_app_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $categori_potongan = $this->Categori_potongan_model->get_all();
        $data = array(
            'categori_potongan_data' => $categori_potongan,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
        $this->template->load('template','categori_potongan/categori_potongan_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Categori_potongan_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'categori_potongan_id' => $row->categori_potongan_id,
		'nama_categori_potongan' => $row->nama_categori_potongan,
	    );
            $this->template->load('template','categori_potongan/categori_potongan_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('categori_potongan'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => site_url('categori_potongan/create_action'),
	    'categori_potongan_id' => set_value('categori_potongan_id'),
	    'nama_categori_potongan' => set_value('nama_categori_potongan'),
	);
        $this->template->load('template','categori_potongan/categori_potongan_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_categori_potongan' => $this->input->post('nama_categori_potongan',TRUE),
	    );

            $this->Categori_potongan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('categori_potongan'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Categori_potongan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
                'action' => site_url('categori_potongan/update_action'),
		'categori_potongan_id' => set_value('categori_potongan_id', $row->categori_potongan_id),
		'nama_categori_potongan' => set_value('nama_categori_potongan', $row->nama_categori_potongan),
	    );
            $this->template->load('template','categori_potongan/categori_potongan_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('categori_potongan'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('categori_potongan_id', TRUE));
        } else {
            $data = array(
		'nama_categori_potongan' => $this->input->post('nama_categori_potongan',TRUE),
	    );

            $this->Categori_potongan_model->update($this->input->post('categori_potongan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('categori_potongan'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Categori_potongan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Categori_potongan_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('categori_potongan'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('categori_potongan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_categori_potongan', 'nama categori potongan', 'trim|required');

	$this->form_validation->set_rules('categori_potongan_id', 'categori_potongan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "categori_potongan.xls";
        $judul = "categori_potongan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Categori Potongan");

	foreach ($this->Categori_potongan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_categori_potongan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Categori_potongan.php */
/* Location: ./application/controllers/Categori_potongan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-27 05:13:22 */
/* http://harviacode.com */
