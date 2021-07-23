<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Supplier_model');
        $this->load->model('Setting_app_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $supplier = $this->Supplier_model->get_all();
        $data = array(
            'supplier_data' => $supplier,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
        $this->template->load('template','supplier/supplier_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Supplier_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'supplier_id' => $row->supplier_id,
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'nama_vendor' => $row->nama_vendor,
		'no_hp_vendor' => $row->no_hp_vendor,
		'email' => $row->email,
		'alamat' => $row->alamat,
		'deskripsi' => $row->deskripsi,
	    );
            $this->template->load('template','supplier/supplier_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('supplier'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'action' => site_url('supplier/create_action'),
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
	    'supplier_id' => set_value('supplier_id'),
	    'nama_vendor' => set_value('nama_vendor'),
	    'no_hp_vendor' => set_value('no_hp_vendor'),
	    'email' => set_value('email'),
	    'alamat' => set_value('alamat'),
	    'deskripsi' => set_value('deskripsi'),
	);
        $this->template->load('template','supplier/supplier_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_vendor' => $this->input->post('nama_vendor',TRUE),
		'no_hp_vendor' => $this->input->post('no_hp_vendor',TRUE),
		'email' => $this->input->post('email',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
	    );

            $this->Supplier_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('supplier'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Supplier_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('supplier/update_action'),
		'supplier_id' => set_value('supplier_id', $row->supplier_id),
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'nama_vendor' => set_value('nama_vendor', $row->nama_vendor),
		'no_hp_vendor' => set_value('no_hp_vendor', $row->no_hp_vendor),
		'email' => set_value('email', $row->email),
		'alamat' => set_value('alamat', $row->alamat),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
	    );
            $this->template->load('template','supplier/supplier_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('supplier'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('supplier_id', TRUE));
        } else {
            $data = array(
		'nama_vendor' => $this->input->post('nama_vendor',TRUE),
		'no_hp_vendor' => $this->input->post('no_hp_vendor',TRUE),
		'email' => $this->input->post('email',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
	    );

            $this->Supplier_model->update($this->input->post('supplier_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('supplier'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Supplier_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Supplier_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('supplier'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('supplier'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_vendor', 'nama vendor', 'trim|required');
	$this->form_validation->set_rules('no_hp_vendor', 'no hp vendor', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

	$this->form_validation->set_rules('supplier_id', 'supplier_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "supplier.xls";
        $judul = "supplier";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Vendor");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp Vendor");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");

	foreach ($this->Supplier_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_vendor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp_vendor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Supplier.php */
/* Location: ./application/controllers/Supplier.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-22 10:31:30 */
/* http://harviacode.com */