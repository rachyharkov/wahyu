<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kasbon extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Setting_app_model');
        $this->load->model('Karyawan_model');
        $this->load->model('Kasbon_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $kasbon = $this->Kasbon_model->get_all();
        $data = array(
            'kasbon_data' => $kasbon,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
        $this->template->load('template','kasbon/kasbon_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Kasbon_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'kasbon_id' => $row->kasbon_id,
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'karyawan_id' => $row->karyawan_id,
		'besar_kasbon' => $row->besar_kasbon,
		'tanggal' => $row->tanggal,
		'deskripsi' => $row->deskripsi,
	    );
            $this->template->load('template','kasbon/kasbon_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kasbon'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'karyawan' =>$this->Karyawan_model->get_all(),
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => site_url('kasbon/create_action'),
	    'kasbon_id' => set_value('kasbon_id'),
	    'karyawan_id' => set_value('karyawan_id'),
	    'besar_kasbon' => set_value('besar_kasbon'),
	    'tanggal' => set_value('tanggal'),
	    'deskripsi' => set_value('deskripsi'),
	);
        $this->template->load('template','kasbon/kasbon_form', $data);
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
		'besar_kasbon' => $this->input->post('besar_kasbon',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
	    );

            $this->Kasbon_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kasbon'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Kasbon_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'karyawan' =>$this->Karyawan_model->get_all(),
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
                'action' => site_url('kasbon/update_action'),
		'kasbon_id' => set_value('kasbon_id', $row->kasbon_id),
		'karyawan_id' => set_value('karyawan_id', $row->karyawan_id),
		'besar_kasbon' => set_value('besar_kasbon', $row->besar_kasbon),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
	    );
            $this->template->load('template','kasbon/kasbon_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kasbon'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kasbon_id', TRUE));
        } else {
            $data = array(
		'karyawan_id' => $this->input->post('karyawan_id',TRUE),
		'besar_kasbon' => $this->input->post('besar_kasbon',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
	    );

            $this->Kasbon_model->update($this->input->post('kasbon_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kasbon'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Kasbon_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Kasbon_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kasbon'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('kasbon'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('karyawan_id', 'karyawan id', 'trim|required');
	$this->form_validation->set_rules('besar_kasbon', 'besar kasbon', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

	$this->form_validation->set_rules('kasbon_id', 'kasbon_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "kasbon.xls";
        $judul = "kasbon";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Besar Kasbon");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");

	foreach ($this->Kasbon_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->karyawan_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->besar_kasbon);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Kasbon.php */
/* Location: ./application/controllers/Kasbon.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-27 05:29:39 */
/* http://harviacode.com */
