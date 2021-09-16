<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Request_form_model extends CI_Model
{

    public $table = 'request_form';
    public $id = 'request_form_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('request_form_id', $q);
	$this->db->or_like('kode_request_form', $q);
	$this->db->or_like('user_id', $q);
	$this->db->or_like('tanggal_request', $q);
	$this->db->or_like('categori_request_id', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }


    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_no_rf(){
        $q = $this->db->query("SELECT MAX(RIGHT(kode_request_form,4)) AS kd_max FROM request_form WHERE DATE(tanggal_request)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('Ydm').$kd;
    }

}

/* End of file Request_form_model.php */
/* Location: ./application/models/Request_form_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-09-14 11:13:12 */
/* http://harviacode.com */