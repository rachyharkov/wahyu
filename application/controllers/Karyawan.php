<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Karyawan_model');
        $this->load->model('Setting_app_model');
        $this->load->model('Status_karyawan_model');
        $this->load->model('Lokasi_model');
        $this->load->model('Jabatan_model');
        $this->load->model('Divisi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);
        $karyawan = $this->Karyawan_model->get_all();
        $data = array(
            'karyawan_data' => $karyawan,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
        $this->template->load('template','karyawan/karyawan_list', $data);
    }

    public function read($id) 
    {
        is_allowed($this->uri->segment(1),'read');
        $row = $this->Karyawan_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
        'berkas' =>$this->Karyawan_model->get_berkas(decrypt_url($id)),
		'karyawan_id' => $row->karyawan_id,
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		'nama_karyawan' => $row->nama_karyawan,
		'nik' => $row->nik,
		'email' => $row->email,
		'no_hp' => $row->no_hp,
		'pendidikan' => $row->pendidikan,
        'nama_lokasi' => $row->nama_lokasi,
        'nama_divisi' => $row->nama_divisi,
		'nama_jabatan' => $row->nama_jabatan,
		'nama_status_karyawan' => $row->nama_status_karyawan,
		'alamat' => $row->alamat,
        'gaji_pokok' => $row->gaji_pokok,
		'jenis_kelamin' => $row->jenis_kelamin,
		'status_kawin' => $row->status_kawin,
		'tgl_masuk' => $row->tgl_masuk,
		'photo' => $row->photo,
        'status_keaktifan' => $row->status_keaktifan,
	    );

            
            $this->template->load('template','karyawan/karyawan_read', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function create() 
    {
        is_allowed($this->uri->segment(1),'create');
        $data = array(
            'button' => 'Create',
            'jabatan' =>$this->Jabatan_model->get_all(),
            'status_karyawan' =>$this->Status_karyawan_model->get_all(),
            'lokasi' =>$this->Lokasi_model->get_all(),
            'jabatan' =>$this->Jabatan_model->get_all(),
            'divisi' =>$this->Divisi_model->get_all(),
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => site_url('karyawan/create_action'),
	    'karyawan_id' => set_value('karyawan_id'),
	    'nama_karyawan' => set_value('nama_karyawan'),
        'gaji_pokok' => set_value('gaji_pokok'),
	    'nik' => set_value('nik'),
	    'email' => set_value('email'),
	    'no_hp' => set_value('no_hp'),
	    'pendidikan' => set_value('pendidikan'),
        'lokasi_id' => set_value('lokasi_id'),
	    'jabatan_id' => set_value('jabatan_id'),
        'divisi_id' => set_value('divisi_id'),
	    'status_karyawan_id' => set_value('status_karyawan_id'),
	    'alamat' => set_value('alamat'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'status_kawin' => set_value('status_kawin'),
	    'tgl_masuk' => set_value('tgl_masuk'),
	    'photo' => set_value('photo'),
        'status_keaktifan' => set_value('status_keaktifan'),
	);
        $this->template->load('template','karyawan/karyawan_form', $data);
    }
    
    public function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $config['upload_path']      = './assets/assets/img/karyawan'; 
        $config['allowed_types']    = 'jpg|png|jpeg'; 
        $config['max_size']         = 10048; 
        $config['file_name']        = 'File-'.date('ymd').'-'.substr(sha1(rand()),0,10); 
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        $this->upload->do_upload("photo");
        $data = $this->upload->data();
        $photo =$data['file_name'];
            $data = array(
		'nama_karyawan' => $this->input->post('nama_karyawan',TRUE),
		'nik' => $this->input->post('nik',TRUE),
		'email' => $this->input->post('email',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'pendidikan' => $this->input->post('pendidikan',TRUE),
        'divisi_id' => $this->input->post('divisi_id',TRUE),
        'lokasi_id' => $this->input->post('lokasi_id',TRUE),
		'jabatan_id' => $this->input->post('jabatan_id',TRUE),
        'gaji_pokok' => $this->input->post('gaji_pokok',TRUE),
		'status_karyawan_id' => $this->input->post('status_karyawan_id',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'status_kawin' => $this->input->post('status_kawin',TRUE),
		'tgl_masuk' => $this->input->post('tgl_masuk',TRUE),
		'photo' => $photo,
        'status_keaktifan' => $status_keaktifan,
	    );

            $this->Karyawan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('karyawan'));
        }
    }
    
    public function update($id) 
    {
        is_allowed($this->uri->segment(1),'update');
        $row = $this->Karyawan_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
                'button' => 'Update',
                'status_karyawan' =>$this->Status_karyawan_model->get_all(),
                'jabatan' =>$this->Jabatan_model->get_all(),
                'divisi' =>$this->Divisi_model->get_all(),
                'lokasi' =>$this->Lokasi_model->get_all(),
                'sett_apps' =>$this->Setting_app_model->get_by_id(1),
                'action' => site_url('karyawan/update_action'),
		'karyawan_id' => set_value('karyawan_id', $row->karyawan_id),
		'nama_karyawan' => set_value('nama_karyawan', $row->nama_karyawan),
		'nik' => set_value('nik', $row->nik),
		'email' => set_value('email', $row->email),
		'no_hp' => set_value('no_hp', $row->no_hp),
        'gaji_pokok' => set_value('gaji_pokok', $row->gaji_pokok),
		'pendidikan' => set_value('pendidikan', $row->pendidikan),
        'divisi_id' => set_value('divisi_id', $row->divisi_id),
        'lokasi_id' => set_value('lokasi_id', $row->lokasi_id),
		'jabatan_id' => set_value('jabatan_id', $row->jabatan_id),
		'status_karyawan_id' => set_value('status_karyawan_id', $row->status_karyawan_id),
		'alamat' => set_value('alamat', $row->alamat),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'status_kawin' => set_value('status_kawin', $row->status_kawin),
		'tgl_masuk' => set_value('tgl_masuk', $row->tgl_masuk),
		'photo' => set_value('photo', $row->photo),
        'status_keaktifan' => set_value('status_keaktifan', $row->status_keaktifan),
	    );

            $this->template->load('template','karyawan/karyawan_form', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('karyawan_id', TRUE));
        } else {

            $config['upload_path']      = './assets/assets/img/karyawan'; 
            $config['allowed_types']    = 'jpg|png|jpeg|gif'; 
            $config['max_size']         = 10048; 
            $config['file_name']        = 'File-'.date('ymd').'-'.substr(sha1(rand()),0,10); 
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload("photo")) {
            $id = $this->input->post('karyawan_id');
            $row = $this->Karyawan_model->get_by_id($id);
            $data = $this->upload->data();
            $photo =$data['file_name'];
            if($row->photo==null || $row->photo=='' ){
            }else{

            $target_file = './assets/assets/img/karyawan/'.$row->photo;
            unlink($target_file);
            }
                }else{
                $photo = $this->input->post('photo_lama');
            }


            $data = array(
		'nama_karyawan' => $this->input->post('nama_karyawan',TRUE),
		'nik' => $this->input->post('nik',TRUE),
		'email' => $this->input->post('email',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'pendidikan' => $this->input->post('pendidikan',TRUE),
        'lokasi_id' => $this->input->post('lokasi_id',TRUE),
        'divisi_id' => $this->input->post('divisi_id',TRUE),
        'gaji_pokok' => $this->input->post('gaji_pokok',TRUE),
		'jabatan_id' => $this->input->post('jabatan_id',TRUE),
		'status_karyawan_id' => $this->input->post('status_karyawan_id',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'status_kawin' => $this->input->post('status_kawin',TRUE),
		'tgl_masuk' => $this->input->post('tgl_masuk',TRUE),
        'status_keaktifan' => $this->input->post('status_keaktifan',TRUE),
		'photo' => $photo,
	    );

            $this->Karyawan_model->update($this->input->post('karyawan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('karyawan'));
        }
    }
    
    public function delete($id) 
    {
        is_allowed($this->uri->segment(1),'delete');
        $row = $this->Karyawan_model->get_by_id(decrypt_url($id));

        if ($row) {
            if($row->photo==null || $row->photo=='' ){
                }else{
                $target_file = './assets/assets/img/karyawan/'.$row->photo;
                unlink($target_file);
                }


            $this->Karyawan_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('karyawan'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_karyawan', 'nama karyawan', 'trim|required');
	$this->form_validation->set_rules('nik', 'nik', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('pendidikan', 'pendidikan', 'trim|required');
	$this->form_validation->set_rules('jabatan_id', 'jabatan id', 'trim|required');
	$this->form_validation->set_rules('status_karyawan_id', 'status karyawan id', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('status_kawin', 'status kawin', 'trim|required');
	$this->form_validation->set_rules('tgl_masuk', 'tgl masuk', 'trim|required');
    $this->form_validation->set_rules('lokasi_id', 'lokasi Kerja', 'trim|required');
    $this->form_validation->set_rules('status_keaktifan', 'Status Keaktifan', 'trim|required');
	$this->form_validation->set_rules('photo', 'photo', 'trim');
	$this->form_validation->set_rules('karyawan_id', 'karyawan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "karyawan.xls";
        $judul = "karyawan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Karyawan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nik");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp");
	xlsWriteLabel($tablehead, $kolomhead++, "Pendidikan");
	xlsWriteLabel($tablehead, $kolomhead++, "Jabatan Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Karyawan Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Kawin");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Masuk");
	xlsWriteLabel($tablehead, $kolomhead++, "Photo");

	foreach ($this->Karyawan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
	    xlsWriteNumber($tablebody, $kolombody++, $data->pendidikan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jabatan_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->status_karyawan_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_kawin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_masuk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->photo);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function download($gambar){
        force_download('assets/assets/img/karyawan/'.$gambar,NULL);
    }

    public function download_berkas($gambar){
        force_download('assets/assets/img/berkas/'.$gambar,NULL);
    }

    public function upload($id){
        $data = array(
            'karyawan_id' =>decrypt_url($id),
            'button' => 'Upload',
            'action' => site_url('karyawan/upload_berkas'),
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
        $this->template->load('template','karyawan/upload',$data);
    }

    public function upload_berkas(){
        $nama               = $_POST['nama_berkas'];
        $karyawan_id       = $_POST['karyawan_id'];         
        $config['upload_path']          = './assets/assets/img/berkas'; 
        $config['allowed_types']        = 'jpg|png|pdf|docx|doc|jpeg';
        $config['max_size']             = 10048;
        $config['encrypt_name']         = true;
        $this->load->library('upload',$config);
        
        $jumlah_data = count($karyawan_id);

        for($i = 0; $i < $jumlah_data;$i++)
        {
            if(!empty($_FILES['berkas']['name'][$i])){
 
                $_FILES['file']['name'] = $_FILES['berkas']['name'][$i];
                $_FILES['file']['type'] = $_FILES['berkas']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['berkas']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['berkas']['error'][$i];
                $_FILES['file']['size'] = $_FILES['berkas']['size'][$i];
       
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $data['karyawan_id'] = $karyawan_id[$i];
                    $data['nama_berkas'] = $nama[$i];
                    $data['photo'] = $uploadData['file_name'];
                    $this->db->insert('berkas',$data);
                }
            }
        }

        redirect(site_url('karyawan'));

    }

    public function del_berkas($id,$uri) 
    {
        is_allowed($this->uri->segment(1),'delete');   
        $row = $this->Karyawan_model->get_berkas_by_id($id);

        if ($row) {
            if($row->photo==null || $row->photo==''){
                }else{
                $target_file = './assets/assets/img/berkas/'.$row->photo;
                unlink($target_file);
                }
            $this->Karyawan_model->delete_berkas($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Karyawan/read/'.$uri));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('Karyawan/read/'.$uri));
        }
    }

    public function pdf($id)
    {
        is_allowed($this->uri->segment(1),'read');
        $this->load->library('dompdf_gen');

       $row = $this->Karyawan_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
        'berkas' =>$this->Karyawan_model->get_berkas(decrypt_url($id)),
        'karyawan_id' => $row->karyawan_id,
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        'nama_karyawan' => $row->nama_karyawan,
        'nik' => $row->nik,
        'email' => $row->email,
        'no_hp' => $row->no_hp,
        'pendidikan' => $row->pendidikan,
        'nama_lokasi' => $row->nama_lokasi,
        'nama_divisi' => $row->nama_divisi,
        'nama_jabatan' => $row->nama_jabatan,
        'nama_status_karyawan' => $row->nama_status_karyawan,
        'alamat' => $row->alamat,
        'gaji_pokok' => $row->gaji_pokok,
        'jenis_kelamin' => $row->jenis_kelamin,
        'status_kawin' => $row->status_kawin,
        'tgl_masuk' => $row->tgl_masuk,
        'photo' => $row->photo,
        'status_keaktifan' => $row->status_keaktifan,
        'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );

       $this->load->view('karyawan/karyawan_pdf',$data);
       $paper_size = 'A4';
       $orientation = 'portrait';
       $html = $this->output->get_output();
       $this->dompdf->set_paper($paper_size, $orientation);
       $this->dompdf->load_html($html);
       $this->dompdf->render();
       $this->dompdf->stream("laporan_data_karyawan.pdf", array('Attachment' =>0));
   }

}
}
