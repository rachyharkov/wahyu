<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Absen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Absen_model');
        $this->load->model('Setting_app_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $absen = $this->Absen_model->get_all();
        $data = array(
            'absen_data' => $absen,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
        $this->template->load('template','absen/absen_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Absen_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'absen_id' => $row->absen_id,
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'karyawan_id' => $row->karyawan_id,
		'status' => $row->status,
		'alasan' => $row->alasan,
		'photo' => $row->photo,
		'tanggal' => $row->tanggal,
		'jam_masuk' => $row->jam_masuk,
		'jam_pulang' => $row->jam_pulang,
	    );
            $this->template->load('template','absen/absen_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('absen'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => site_url('absen/create_action'),
	    'absen_id' => set_value('absen_id'),
	    'karyawan_id' => set_value('karyawan_id'),
	    'status' => set_value('status'),
	    'alasan' => set_value('alasan'),
	    'photo' => set_value('photo'),
	    'tanggal' => set_value('tanggal'),
	    'jam_masuk' => set_value('jam_masuk'),
	    'jam_pulang' => set_value('jam_pulang'),
	);
        $this->template->load('template','absen/absen_form', $data);
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
		'status' => $this->input->post('status',TRUE),
		'alasan' => $this->input->post('alasan',TRUE),
		'photo' => $this->input->post('photo',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'jam_masuk' => $this->input->post('jam_masuk',TRUE),
		'jam_pulang' => $this->input->post('jam_pulang',TRUE),
	    );

            $this->Absen_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('absen'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Absen_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
                'action' => site_url('absen/update_action'),
		'absen_id' => set_value('absen_id', $row->absen_id),
		'karyawan_id' => set_value('karyawan_id', $row->karyawan_id),
		'status' => set_value('status', $row->status),
		'alasan' => set_value('alasan', $row->alasan),
		'photo' => set_value('photo', $row->photo),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'jam_masuk' => set_value('jam_masuk', $row->jam_masuk),
		'jam_pulang' => set_value('jam_pulang', $row->jam_pulang),
	    );
            $this->template->load('template','absen/absen_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('absen'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('absen_id', TRUE));
        } else {
            $data = array(
		'karyawan_id' => $this->input->post('karyawan_id',TRUE),
		'status' => $this->input->post('status',TRUE),
		'alasan' => $this->input->post('alasan',TRUE),
		'photo' => $this->input->post('photo',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'jam_masuk' => $this->input->post('jam_masuk',TRUE),
		'jam_pulang' => $this->input->post('jam_pulang',TRUE),
	    );

            $this->Absen_model->update($this->input->post('absen_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('absen'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Absen_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Absen_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('absen'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('absen'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('karyawan_id', 'karyawan id', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('alasan', 'alasan', 'trim|required');
	$this->form_validation->set_rules('photo', 'photo', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('jam_masuk', 'jam masuk', 'trim|required');
	$this->form_validation->set_rules('jam_pulang', 'jam pulang', 'trim|required');

	$this->form_validation->set_rules('absen_id', 'absen_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "absen.xls";
        $judul = "absen";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Alasan");
	xlsWriteLabel($tablehead, $kolomhead++, "Photo");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Jam Masuk");
	xlsWriteLabel($tablehead, $kolomhead++, "Jam Pulang");

	foreach ($this->Absen_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->karyawan_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alasan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->photo);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam_masuk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam_pulang);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Absen.php */
/* Location: ./application/controllers/Absen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-26 09:15:09 */
/* http://harviacode.com */
