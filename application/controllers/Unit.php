<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Unit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Unit_model');
        $this->load->model('Setting_app_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $unit = $this->Unit_model->get_all();
        $data = array(
            'unit_data' => $unit,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1), 
        );
        $this->template->load('template','unit/unit_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Unit_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'unit_id' => $row->unit_id,
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'nama_unit' => $row->nama_unit,
	    );
            $this->template->load('template','unit/unit_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('unit'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => site_url('unit/create_action'),
	    'unit_id' => set_value('unit_id'),
	    'nama_unit' => set_value('nama_unit'),
	);
        $this->template->load('template','unit/unit_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_unit' => $this->input->post('nama_unit',TRUE),
	    );

            $this->Unit_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('unit'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Unit_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
                'action' => site_url('unit/update_action'),
		'unit_id' => set_value('unit_id', $row->unit_id),
		'nama_unit' => set_value('nama_unit', $row->nama_unit),
	    );
            $this->template->load('template','unit/unit_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('unit'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('unit_id', TRUE));
        } else {
            $data = array(
		'nama_unit' => $this->input->post('nama_unit',TRUE),
	    );

            $this->Unit_model->update($this->input->post('unit_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('unit'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Unit_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Unit_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('unit'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('unit'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_unit', 'nama unit', 'trim|required');

	$this->form_validation->set_rules('unit_id', 'unit_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'export');
        $this->load->helper('exportexcel');
        $namaFile = "unit.xls";
        $judul = "unit";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Unit");

	foreach ($this->Unit_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_unit);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Unit.php */
/* Location: ./application/controllers/Unit.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-16 13:36:37 */
/* http://harviacode.com */
