<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Produksi_model');
        $this->load->model('Material_model');
        $this->load->model('Setting_app_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $produksi = $this->Produksi_model->get_all();
        $data = array(
            'produksi_data' => $produksi,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'classnyak' => $this
        );
        $this->template->load('template','produksi/produksi_wrapper', $data);
    }

    public function list()
    {
        is_allowed($this->uri->segment(1),null);
        $produksi = $this->Produksi_model->get_all();
        $data = array(
            'produksi_data' => $produksi,
        );
        $this->load->view('produksi/produksi_list', $data);
    }

    public function read()
    {
        is_allowed($this->uri->segment(1),'read');

        $id = $this->input->post('id');

        $row = $this->Produksi_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
        		'id' => $row->id,
        		'tanggal_produksi' => $row->tanggal_produksi,
        		'total_barang_jadi' => $row->total_barang_jadi,
        		'id_detail_material' => $row->id_detail_material,
        		'user_id' => $row->user_id,
    	    );
            $this->load->view('produksi/produksi_read', $data);
        } else {
            echo 'not found';
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'action' => 'form_create_action',
            'material' => $this->Material_model->get_all(),
    	    'id' => set_value('id'),
    	    'tanggal_produksi' => set_value('tanggal_produksi',date('Y-m-d')),
    	    'total_barang_jadi' => set_value('total_barang_jadi'),
    	    'material_needs' => null,
    	    'user_id' => set_value('user_id'),
        );
        $this->load->view('produksi/produksi_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');

        $data = array(
    		'id' => $this->input->post('id',TRUE),
    		'tanggal_produksi' => $this->input->post('tanggal_produksi',TRUE),
    		'total_barang_jadi' => $this->input->post('total_barang_jadi',TRUE),
    		'id_detail_material' => $this->input->post('id_detail_material',TRUE),
    		'user_id' => $this->input->post('user_id',TRUE),
	    );
        $this->Produksi_model->insert($data);
        $this->list();
    }
    
    public function update() 
    {
        is_allowed($this->uri->segment(1),'update');

        $id = $this->input->post('id');

        $row = $this->Produksi_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => 'form_update_action',
        		'id' => $row->id,
        		'tanggal_produksi' => set_value('tanggal_produksi', $row->tanggal_produksi),
        		'total_barang_jadi' => set_value('total_barang_jadi', $row->total_barang_jadi),
                'material' => $this->Material_model->get_all(),
                'material_needs' => $this->Material_model->get_material_for($row->id_detail_material),
                'user_id' => set_value('user_id', $row->user_id),
	        );
            $this->load->view('produksi/produksi_form', $data);
        } else {
            echo 'not found';
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
       
        $data = array(
    		'tanggal_produksi' => $this->input->post('tanggal_produksi',TRUE),
    		'total_barang_jadi' => $this->input->post('total_barang_jadi',TRUE),
    		'id_detail_material' => $this->input->post('id_detail_material',TRUE),
    		'user_id' => $this->input->post('user_id',TRUE),
	    );

        $this->Produksi_model->update($this->input->post('id', TRUE), $data);
        $this->list();
    }
    
    public function delete() 
    {
        is_allowed($this->uri->segment(1),'delete');

        $id = $this->input->post('id');

        $row = $this->Produksi_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Produksi_model->delete(decrypt_url($id));
        } else {
            echo 'not found';
        }

        $this->list();
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id', 'id', 'trim|required');
	$this->form_validation->set_rules('tanggal_produksi', 'tanggal produksi', 'trim|required');
	$this->form_validation->set_rules('total_barang_jadi', 'total barang jadi', 'trim|required');
	$this->form_validation->set_rules('id_detail_material', 'id detail material', 'trim|required');
	$this->form_validation->set_rules('user_id', 'user id', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "produksi.xls";
        $judul = "produksi";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Produksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Total Barang Jadi");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Detail Material");
	xlsWriteLabel($tablehead, $kolomhead++, "User Id");

	foreach ($this->Produksi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_produksi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->total_barang_jadi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_detail_material);
	    xlsWriteNumber($tablebody, $kolombody++, $data->user_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Produksi.php */
/* Location: ./application/controllers/Produksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-06 08:45:29 */
/* http://harviacode.com */