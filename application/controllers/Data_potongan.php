<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_potongan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Data_potongan_model');
        $this->load->model('Karyawan_model');
        $this->load->model('Categori_potongan_model');
        $this->load->model('Setting_app_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $data_potongan = $this->Data_potongan_model->get_all();
        $data = array(
            'data_potongan_data' => $data_potongan,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
        $this->template->load('template','data_potongan/data_potongan_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Data_potongan_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'data_potongan_id' => $row->data_potongan_id,
		'karyawan_id' => $row->karyawan_id,
		'categori_potongan_id' => $row->categori_potongan_id,
		'besar_potongan' => $row->besar_potongan,
	    );
            $this->template->load('template','data_potongan/data_potongan_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('data_potongan'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'categori_potongan' =>$this->Categori_potongan_model->get_all(),
            'karyawan' =>$this->Karyawan_model->get_all(),
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => site_url('data_potongan/create_action'),
	    'data_potongan_id' => set_value('data_potongan_id'),
	    'karyawan_id' => set_value('karyawan_id'),
	    'categori_potongan_id' => set_value('categori_potongan_id'),
	    'besar_potongan' => set_value('besar_potongan'),
	);
        $this->template->load('template','data_potongan/data_potongan_form', $data);
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
		'categori_potongan_id' => $this->input->post('categori_potongan_id',TRUE),
		'besar_potongan' => $this->input->post('besar_potongan',TRUE),
	    );

            $this->Data_potongan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_potongan'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Data_potongan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'categori_potongan' =>$this->Categori_potongan_model->get_all(),
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
                'karyawan' =>$this->Karyawan_model->get_all(),
                'action' => site_url('data_potongan/update_action'),
		'data_potongan_id' => set_value('data_potongan_id', $row->data_potongan_id),
		'karyawan_id' => set_value('karyawan_id', $row->karyawan_id),
		'categori_potongan_id' => set_value('categori_potongan_id', $row->categori_potongan_id),
		'besar_potongan' => set_value('besar_potongan', $row->besar_potongan),
	    );
            $this->template->load('template','data_potongan/data_potongan_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('data_potongan'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('data_potongan_id', TRUE));
        } else {
            $data = array(
		'karyawan_id' => $this->input->post('karyawan_id',TRUE),
		'categori_potongan_id' => $this->input->post('categori_potongan_id',TRUE),
		'besar_potongan' => $this->input->post('besar_potongan',TRUE),
	    );

            $this->Data_potongan_model->update($this->input->post('data_potongan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_potongan'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Data_potongan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Data_potongan_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_potongan'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('data_potongan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('karyawan_id', 'karyawan id', 'trim|required');
	$this->form_validation->set_rules('categori_potongan_id', 'categori potongan id', 'trim|required');
	$this->form_validation->set_rules('besar_potongan', 'besar potongan', 'trim|required');

	$this->form_validation->set_rules('data_potongan_id', 'data_potongan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "data_potongan.xls";
        $judul = "data_potongan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Categori Potongan Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Besar Potongan");

	foreach ($this->Data_potongan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->karyawan_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->categori_potongan_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->besar_potongan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Data_potongan.php */
/* Location: ./application/controllers/Data_potongan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-27 05:29:19 */
/* http://harviacode.com */
