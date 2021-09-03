<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categori_benefit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Categori_benefit_model');
        $this->load->model('Setting_app_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $categori_benefit = $this->Categori_benefit_model->get_all();
        $data = array(
            'categori_benefit_data' => $categori_benefit,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
        $this->template->load('template','categori_benefit/categori_benefit_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Categori_benefit_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'categori_benefit_id' => $row->categori_benefit_id,
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'nama_categori_benefit' => $row->nama_categori_benefit,
	    );
            $this->template->load('template','categori_benefit/categori_benefit_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('categori_benefit'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => site_url('categori_benefit/create_action'),
	    'categori_benefit_id' => set_value('categori_benefit_id'),
	    'nama_categori_benefit' => set_value('nama_categori_benefit'),
	);
        $this->template->load('template','categori_benefit/categori_benefit_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_categori_benefit' => $this->input->post('nama_categori_benefit',TRUE),
	    );

            $this->Categori_benefit_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('categori_benefit'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Categori_benefit_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
                'action' => site_url('categori_benefit/update_action'),
		'categori_benefit_id' => set_value('categori_benefit_id', $row->categori_benefit_id),
		'nama_categori_benefit' => set_value('nama_categori_benefit', $row->nama_categori_benefit),
	    );
            $this->template->load('template','categori_benefit/categori_benefit_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('categori_benefit'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('categori_benefit_id', TRUE));
        } else {
            $data = array(
		'nama_categori_benefit' => $this->input->post('nama_categori_benefit',TRUE),
	    );

            $this->Categori_benefit_model->update($this->input->post('categori_benefit_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('categori_benefit'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Categori_benefit_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Categori_benefit_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('categori_benefit'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('categori_benefit'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_categori_benefit', 'nama categori benefit', 'trim|required');

	$this->form_validation->set_rules('categori_benefit_id', 'categori_benefit_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "categori_benefit.xls";
        $judul = "categori_benefit";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Categori Benefit");

	foreach ($this->Categori_benefit_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_categori_benefit);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Categori_benefit.php */
/* Location: ./application/controllers/Categori_benefit.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-27 05:13:15 */
/* http://harviacode.com */
