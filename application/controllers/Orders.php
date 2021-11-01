<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Orders extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Orders_model');
        $this->load->model('Material_model');
        $this->load->model('Bagian_model');
        $this->load->model('Setting_app_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_allowed($this->uri->segment(1),null);

        $action = $this->input->get('action');

        if ($action == 'waiting') {
            if ($this->session->userdata('level_id') == 219) {
                redirect('not_access');
            }
        }
        
        $data = array(
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
            'action' => $action,
            'classnyak' => $this
        );
        $this->template->load('template','orders/orders_wrapper', $data);
    }

    public function list()
    {
        is_allowed($this->uri->segment(1),null);
        $orders = $this->Orders_model->get_all_by_thisuser($this->session->userdata('userid'));
        $data = array(
            'orders_data' => $orders,
            'classnyak' => $this
        );
        $this->load->view('orders/orders_list', $data);
    }

    public function waiting()
    {
        is_allowed($this->uri->segment(1),null);
        $orders = $this->Orders_model->get_all_tertentu('WAITING');
        $data = array(
            'orders_data' => $orders,
            'action'=> 'waiting',
            'classnyak' => $this
        );
        $this->load->view('orders/orders_waiting_list', $data);
    }

    public function update_approve()
    {
        $id = $this->input->post('id');

        $attachment = $this->input->post('attachmentapprovestatus');
        $material = $this->input->post('materialavailablestatus');

        $kd_order = $this->input->post('kd_order');
        $reason = $this->input->post('txtrejectreason');

        if ($attachment && $material) {
            $arr = array(
                'response' => 2,
                'kd_order' => $kd_order
            );

            echo json_encode($arr);
        } else {

            $updatedataorder = array(
                'status' => 'REJECTED',
                'approved_by' => $this->session->userdata('userid'),
                'reject_note' => $reason
            );

            $this->Orders_model->update($id, $updatedataorder);

            $orders = $this->Orders_model->get_all_tertentu('WAITING');
            $data = array(
                'orders_data' => $orders,
                'action'=> 'waiting',
                'classnyak' => $this
            );

            $arr = array(
                'response' => 1,
                'page' => $this->load->view('orders/orders_waiting_list', $data, true)//$this->approve($id);
            );

            echo json_encode($arr);
        }
    }

    public function count_waiting_orders()
    {
        $count = $this->db->where('status', 'WAITING')->get('orders')->num_rows();

        echo json_encode($count);
    }

    // public function approve($id)
    // {
    //     $updatedataorder = array(
    //         'status' => 'ON PROGRESS',
    //         'approved_by' => $this->session->userdata('userid') 
    //     );

    //     $this->Orders_model->update($id, $updatedataorder);
    //     $this->waiting();
    // }

    public function reject($id, $reason)
    {
        $updatedataorder = array(
            'status' => 'REJECTED',
            'approved_by' => $this->session->userdata('userid'),
            'reject_note' => $reason
        );

        $this->Orders_model->update($id, $updatedataorder);
        $this->waiting();
    }

    public function read_w_order() 
    {
        is_allowed($this->uri->segment(1),'read');
        $id = $this->input->post('id');
        $row = $this->Orders_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
                'order_id' => $row->order_id,
                'nama_pemesan' => $row->nama_pemesan,
                'bagian' => $row->bagian,
                'keterangan' => $row->keterangan,
                'kd_order' => $row->kd_order,
                'nama_barang' => $row->nama_barang,
                'qty' => $row->qty,
                'due_date' => $row->due_date,
                'note' => $row->note,
                'no_kontak' => $row->no_kontak,

                'priority' => $row->priority,
                'approved_by' => $row->approved_by,
                'attachment' => $row->attachment,
                'status' => $row->status,
                'reject_note' => $row->reject_note,
                'classnyak' => $this,
                'material' => $this->Material_model->get_all()

            );
            $this->load->view('orders/orders_waiting_read', $data);
        } else {
            echo 'not found';
        }
    }

    public function read() 
    {
        is_allowed($this->uri->segment(1),'read');
        $id = $this->input->post('id');
        $row = $this->Orders_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
        		'order_id' => $row->order_id,
        		'nama_pemesan' => $row->nama_pemesan,
        		'bagian' => $row->bagian,
        		'keterangan' => $row->keterangan,

                'nama_barang' => $row->nama_barang,
                'qty' => $row->qty,
                'due_date' => $row->due_date,
                'note' => $row->note,
                'no_kontak' => $row->no_kontak,

        		'priority' => $row->priority,
        		'approved_by' => $row->approved_by,
        		'attachment' => $row->attachment,
                'status' => $row->status,
                'reject_note' => $row->reject_note
    	    );
            $this->load->view('orders/orders_read', $data);
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
    	    'order_id' => set_value('order_id'),
    	    'nama_pemesan' => set_value('nama_pemesan'),
    	    'bagian' => set_value('bagian'),
            'no_kontak' => set_value('no_kontak'),

            'nama_barang' => set_value('nama_barang'),
            'qty' => set_value('qty'),
            'due_date' => set_value('due_date'),
            'note' => set_value('note'),

    	    'keterangan' => set_value('keterangan'),
    	    'priority' => set_value('priority'),
    	    'approved_by' => set_value('approved_by'),
    	    'attachment' => set_value('attachment'),
            'datee' => date('Y-m-d h:m:s'),
            'bagian_list' => $this->Bagian_model->get_all()
    	);
        $this->load->view('orders/orders_form', $data);
    }
    
    function create_action() 
    {
        is_allowed($this->uri->segment(1),'create');

        $kode = $this->Orders_model->buat_kode();

   
        $this->load->library('upload'); //call library upload 

        if($_FILES['attachment']['name']){
            $filenamee = 'prodattach-'.date('ymdhms').'-'.substr(sha1(rand()),0,10);

            $config['upload_path']          = './assets/internal'; 
            $config['allowed_types']        = 'jpg|png|pdf';
            $config['max_size']             = 10000;
            $config['file_name']            = $filenamee;

            $_FILES['file']['name'] = $_FILES['attachment']['name'];
            $_FILES['file']['type'] = $_FILES['attachment']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['attachment']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['attachment']['error'];
            $_FILES['file']['size'] = $_FILES['attachment']['size'];
            $this->upload->initialize($config);
            $this->upload->do_upload('file');
            $uploadData = $this->upload->data();
            $data = array(
                'nama_pemesan' => $this->input->post('nama_pemesan',TRUE),
                'tanggal_order' => date('Y-m-d h:m:s'),
                'kd_order' => $kode,
                'bagian' => $this->input->post('bagian',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),

                'nama_barang' => $this->input->post('nama_barang',TRUE),
                'qty' => $this->input->post('qty',TRUE),
                'due_date' => $this->input->post('due_date',TRUE),
                'note' => $this->input->post('note',TRUE),
                'no_kontak' => $this->input->post('no_kontak',TRUE),

                'priority' => $this->input->post('priority',TRUE),
                'approved_by' => 'NULL',
                'attachment' => $uploadData['file_name'],
                'status' => 'WAITING',

                'reject_note' => null,

                'user_id' => $this->session->userdata('userid')
            );
            // print_r($data);

            $this->Orders_model->insert($data);
            $this->list();
        } else {
            echo 'no files for'.$_FILES['attachment']['name'].'???';
        }
        
    }

    public function redirect($towhere, $data = null)
    {
        if ($towhere == 'productionaddform') {
            $this->session->set_flashdata('kode_order', $data);
            redirect('produksi/', 'refresh');
        }
    }
    
    public function update() 
    {
        is_allowed($this->uri->segment(1),'update');
        $id = $this->input->post('id');
        $row = $this->Orders_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => 'form_update_action',
        		'order_id' => set_value('order_id', $row->order_id),
        		'nama_pemesan' => set_value('nama_pemesan', $row->nama_pemesan),
        		'bagian' => set_value('bagian', $row->bagian),
        		'keterangan' => set_value('keterangan', $row->keterangan),

                'nama_barang' => set_value('nama_barang', $row->nama_barang),
                'qty' => set_value('qty', $row->qty),
                'due_date' => set_value('due_date', $row->due_date),
                'note' => set_value('note', $row->note),
                'no_kontak' => set_value('no_kontak', $row->no_kontak),

        		'priority' => set_value('priority', $row->priority),
        		'attachment' => set_value('attachment', $row->attachment),
                'bagian_list' => $this->Bagian_model->get_all()
    	    );
            $this->load->view('orders/orders_form', $data);
        } else {
            echo 'not found';
        }
    }
    
    public function update_action() 
    {
        is_allowed($this->uri->segment(1),'update');

        $this->load->library('upload'); //call library upload 

        if($_FILES['attachment']['name']){

            unlink('./assets/internal/'.$this->input->post('attachment_old', TRUE));


            $filenamee = 'prodattach-'.date('ymdhms').'-'.substr(sha1(rand()),0,10);

            $config['upload_path']          = './assets/internal'; 
            $config['allowed_types']        = 'jpg|jpeg|png|pdf';
            $config['max_size']             = 10000;
            $config['file_name']            = $filenamee;

            $_FILES['file']['name'] = $_FILES['attachment']['name'];
            $_FILES['file']['type'] = $_FILES['attachment']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['attachment']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['attachment']['error'];
            $_FILES['file']['size'] = $_FILES['attachment']['size'];
            $this->upload->initialize($config);
            $this->upload->do_upload('file');
            $uploadData = $this->upload->data();
            $data = array(
                'nama_pemesan' => $this->input->post('nama_pemesan',TRUE),
                'bagian' => $this->input->post('bagian',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),

                'nama_barang' => $this->input->post('nama_barang',TRUE),
                'qty' => $this->input->post('qty',TRUE),
                'due_date' => $this->input->post('due_date',TRUE),
                'note' => $this->input->post('note',TRUE),
                'no_kontak' => $this->input->post('no_kontak',TRUE),

                'priority' => $this->input->post('priority',TRUE),
                'approved_by' => $this->input->post('approved_by',TRUE),
                'attachment' => $uploadData['file_name'],

                'status' => 'WAITING'
            );
            // print_r($data);

            $this->Orders_model->update($this->input->post('order_id', TRUE), $data);
            $this->list();

        } else {

            $this->list();
        }
    }
    
    public function delete() 
    {
        is_allowed($this->uri->segment(1),'delete');
        $id = $this->input->post('id');
        $row = $this->Orders_model->get_by_id(decrypt_url($id));

        if ($row) {
            unlink('./assets/internal/'.$row->attachment);
            $this->Orders_model->delete(decrypt_url($id));
        } else {
            echo 'not found';
        }

        $this->list();
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_pemesan', 'nama pemesan', 'trim|required');
	$this->form_validation->set_rules('bagian', 'bagian', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('priority', 'priority', 'trim|required');
	$this->form_validation->set_rules('approved_by', 'approved by', 'trim|required');
	$this->form_validation->set_rules('attachment', 'attachment', 'trim|required');

	$this->form_validation->set_rules('order_id', 'order_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        // is_allowed($this->uri->segment(1),'read');
        $this->load->helper('exportexcel');
        $namaFile = "orders.xls";
        $judul = "orders";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Order");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Order");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pemesan");
    	xlsWriteLabel($tablehead, $kolomhead++, "Bagian");
    	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
    	xlsWriteLabel($tablehead, $kolomhead++, "Priority");
    	xlsWriteLabel($tablehead, $kolomhead++, "Approved By");
    	xlsWriteLabel($tablehead, $kolomhead++, "Attachment");

    	foreach ($this->Orders_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->kd_order);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_order);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_pemesan);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->bagian);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->priority);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->approved_by);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->attachment);

    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function getbagiandata($id)
    {
        $data = $this->Bagian_model->get_by_id($id);
        return $data;
    }

    public function search_material($keyword)
    {
        $data = $this->db->like('kd_material',$keyword)->get('material')->result();

        if ($data) {
            $strbuttonresult = '';

            foreach ($data as $key => $value) {

                $dimensi = json_decode($value->dimensi, true);

                $dt = $dimensi['diametertebal'];
                $p = $dimensi['panjang'];
                $l = $dimensi['lebar'];

                $strbuttonresult.= '
                    <button class="btn btn-xs btn-primary btn-fetch-material" data-kdmaterial="'.$value->kd_material.'" data-diametertebal="'.$dt.'" data-panjang="'.$p.'" data-lebar="'.$l.'" data-weight="'.$value->berat_per_pcs.'" data-massamaterial="'.$value->masa_jenis_material.'" data-stok="'.$value->qty.'">'.$value->kd_material.' </button>
                ';
            }

            $output = array(
                'response' => 'found',
                'search_result' => $strbuttonresult,
                'message' => 'found'
            );

            echo json_encode($output);
        } else {
            $strbuttonresult = '';

            $output = array(
                'response' => 'not found',
                'search_result' => '-',
                'message' => '<p style="text-align: center;"><i class="fas fa-comment-alt"></i> Material tidak ditemukan</p></td>'
            );

            echo json_encode($output);
        }

    }

}

/* End of file Orders.php */
/* Location: ./application/controllers/Orders.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-21 04:38:29 */
/* http://harviacode.com */