<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_benefit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Data_benefit_model');
        $this->load->model('Karyawan_model');
        $this->load->model('Categori_benefit_model');
        $this->load->model('Setting_app_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $data_benefit = $this->Data_benefit_model->get_all();
        $data = array(
            'data_benefit_data' => $data_benefit,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
        $this->template->load('template','data_benefit/data_benefit_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Data_benefit_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'data_benefit_id' => $row->data_benefit_id,
		'karyawan_id' => $row->karyawan_id,
		'categori_benefit_id' => $row->categori_benefit_id,
		'besar_benefit' => $row->besar_benefit,
	    );
            $this->template->load('template','data_benefit/data_benefit_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('data_benefit'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'karyawan' =>$this->Karyawan_model->get_all(),
            'categori_benefit' =>$this->Categori_benefit_model->get_all(),
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => site_url('data_benefit/create_action'),
	    'data_benefit_id' => set_value('data_benefit_id'),
	    'karyawan_id' => set_value('karyawan_id'),
	    'categori_benefit_id' => set_value('categori_benefit_id'),
	    'besar_benefit' => set_value('besar_benefit'),
	);
        $this->template->load('template','data_benefit/data_benefit_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'karyawan_id' => $this->input->post('karyawan_id',TRUE),
		'categori_benefit_id' => $this->input->post('categori_benefit_id',TRUE),
		'besar_benefit' => $this->input->post('besar_benefit',TRUE),
	    );

            $this->Data_benefit_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_benefit'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Data_benefit_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'karyawan' =>$this->Karyawan_model->get_all(),
                'categori_benefit' =>$this->Categori_benefit_model->get_all(),
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
                'action' => site_url('data_benefit/update_action'),
		'data_benefit_id' => set_value('data_benefit_id', $row->data_benefit_id),
		'karyawan_id' => set_value('karyawan_id', $row->karyawan_id),
		'categori_benefit_id' => set_value('categori_benefit_id', $row->categori_benefit_id),
		'besar_benefit' => set_value('besar_benefit', $row->besar_benefit),
	    );
            $this->template->load('template','data_benefit/data_benefit_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('data_benefit'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('data_benefit_id', TRUE));
        } else {
            $data = array(
		'karyawan_id' => $this->input->post('karyawan_id',TRUE),
		'categori_benefit_id' => $this->input->post('categori_benefit_id',TRUE),
		'besar_benefit' => $this->input->post('besar_benefit',TRUE),
	    );

            $this->Data_benefit_model->update($this->input->post('data_benefit_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_benefit'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Data_benefit_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Data_benefit_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_benefit'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('data_benefit'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('karyawan_id', 'karyawan id', 'trim|required');
	$this->form_validation->set_rules('categori_benefit_id', 'categori benefit id', 'trim|required');
	$this->form_validation->set_rules('besar_benefit', 'besar benefit', 'trim|required');

	$this->form_validation->set_rules('data_benefit_id', 'data_benefit_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "data_benefit.xls";
        $judul = "data_benefit";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Karyawan Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Categori Benefit Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Besar Benefit");

	foreach ($this->Data_benefit_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->karyawan_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->categori_benefit_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->besar_benefit);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Data_benefit.php */
/* Location: ./application/controllers/Data_benefit.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-27 05:29:28 */
/* http://harviacode.com */
