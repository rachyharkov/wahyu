<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dokumen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Dokumen_model');
        $this->load->library('form_validation');
        $this->load->model('Setting_app_model');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $dokumen = $this->Dokumen_model->get_all();
        $data = array(
            'dokumen_data' => $dokumen,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
        $this->template->load('template','dokumen/dokumen_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Dokumen_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'dokumen_id' => $row->dokumen_id,
		'nama_dokumen' => $row->nama_dokumen,
		'tgl_pembuatan' => $row->tgl_pembuatan,
		'tgl_expired' => $row->tgl_expired,
		'tempat_pembuatan' => $row->tempat_pembuatan,
		'berkas_dokumen' => $row->berkas_dokumen,
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
	    );
            $this->template->load('template','dokumen/dokumen_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('dokumen'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'action' => site_url('dokumen/create_action'),
	    'dokumen_id' => set_value('dokumen_id'),
	    'nama_dokumen' => set_value('nama_dokumen'),
	    'tgl_pembuatan' => set_value('tgl_pembuatan'),
	    'tgl_expired' => set_value('tgl_expired'),
	    'tempat_pembuatan' => set_value('tempat_pembuatan'),
	    'berkas_dokumen' => set_value('berkas_dokumen'),
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
	);
        $this->template->load('template','dokumen/dokumen_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

        $config['upload_path']      = './assets/assets/img/dokumen'; 
        $config['allowed_types']    = 'jpg|png|jpeg|pdf|doc|docx'; 
        $config['max_size']         = 20048; 
        $config['file_name']        = 'Doc-'.date('ymd').'-'.substr(sha1(rand()),0,10); 
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        $this->upload->do_upload("berkas_dokumen");
        $data = $this->upload->data();
        $berkas_dokumen =$data['file_name'];

            $data = array(
		'nama_dokumen' => $this->input->post('nama_dokumen',TRUE),
		'tgl_pembuatan' => $this->input->post('tgl_pembuatan',TRUE),
		'tgl_expired' => $this->input->post('tgl_expired',TRUE),
		'tempat_pembuatan' => $this->input->post('tempat_pembuatan',TRUE),
		'berkas_dokumen' => $berkas_dokumen,
	    );

            $this->Dokumen_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('dokumen'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Dokumen_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('dokumen/update_action'),
		'dokumen_id' => set_value('dokumen_id', $row->dokumen_id),
		'nama_dokumen' => set_value('nama_dokumen', $row->nama_dokumen),
		'tgl_pembuatan' => set_value('tgl_pembuatan', $row->tgl_pembuatan),
		'tgl_expired' => set_value('tgl_expired', $row->tgl_expired),
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'tempat_pembuatan' => set_value('tempat_pembuatan', $row->tempat_pembuatan),
		'berkas_dokumen' => set_value('berkas_dokumen', $row->berkas_dokumen),
	    );
            $this->template->load('template','dokumen/dokumen_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('dokumen'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('dokumen_id', TRUE));
        } else {

        $config['upload_path']      = './assets/assets/img/dokumen'; 
            $config['allowed_types']    = 'jpg|png|jpeg|pdf|doc|docx'; 
            $config['max_size']         = 20048; 
            $config['file_name']        = 'File-'.date('ymd').'-'.substr(sha1(rand()),0,10); 
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload("berkas_dokumen")) {
            $id = $this->input->post('dokumen_id');
            $row = $this->Dokumen_model->get_by_id($id);
            $data = $this->upload->data();
            $berkas_dokumen =$data['file_name'];
            if($row->berkas_dokumen==null || $row->berkas_dokumen=='' ){
            }else{
            $target_file = './assets/assets/img/dokumen/'.$row->berkas_dokumen;
            unlink($target_file);
            }
                }else{
                $berkas_dokumen = $this->input->post('berkas_dokumen_lama');
            }


            $data = array(
		'nama_dokumen' => $this->input->post('nama_dokumen',TRUE),
		'tgl_pembuatan' => $this->input->post('tgl_pembuatan',TRUE),
		'tgl_expired' => $this->input->post('tgl_expired',TRUE),
		'tempat_pembuatan' => $this->input->post('tempat_pembuatan',TRUE),
		'berkas_dokumen' => $berkas_dokumen,
	    );

            $this->Dokumen_model->update($this->input->post('dokumen_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('dokumen'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Dokumen_model->get_by_id(decrypt_url($id));

        if ($row) {

            if($row->berkas_dokumen==null || $row->berkas_dokumen=='' ){
                }else{
                $target_file = './assets/assets/img/dokumen/'.$row->berkas_dokumen;
                unlink($target_file);
                }
            $this->Dokumen_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('dokumen'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('dokumen'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_dokumen', 'nama dokumen', 'trim|required');
	$this->form_validation->set_rules('tgl_pembuatan', 'tgl pembuatan', 'trim|required');
	$this->form_validation->set_rules('tgl_expired', 'tgl expired', 'trim|required');
	$this->form_validation->set_rules('tempat_pembuatan', 'tempat pembuatan', 'trim|required');
	$this->form_validation->set_rules('berkas_dokumen', 'berkas dokumen', 'trim');

	$this->form_validation->set_rules('dokumen_id', 'dokumen_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "dokumen.xls";
        $judul = "dokumen";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Dokumen");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Pembuatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Expired");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Pembuatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Berkas Dokumen");

	foreach ($this->Dokumen_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_dokumen);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_pembuatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_expired);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_pembuatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->berkas_dokumen);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function download($berkas_dokumen){
        force_download('assets/assets/img/dokumen/'.$berkas_dokumen,NULL);
    }

}

/* End of file Dokumen.php */
/* Location: ./application/controllers/Dokumen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-09-06 06:28:54 */
/* http://harviacode.com */