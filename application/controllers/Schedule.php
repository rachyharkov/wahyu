<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Mesin_model');
        $this->load->model('Karyawan_model');
        $this->load->model('Produksi_model');
        $this->load->model('Setting_app_model');
    }

	public function index()
	{
		$data = array(
			'classnyak' => $this,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
		$this->template->load('template','schedule/schedule_wrapper',$data);
	}

	function machine_list()
	{
		$getallmachine = $this->Mesin_model->get_all();
		$getalloperator = $this->Karyawan_model->get_all();
		$getallproduksi = $this->Produksi_model->get_all('READY');
		$data = array(
            'machine_list' => $getallmachine,
			'getalloperator' => $getalloperator,
			'getallproduksi' => $getallproduksi,
        );
		$this->load->view('schedule/machine_lists',$data);
	}

	function update_machine()
	{
		$id_mesin = $this->input->post('id_mesin');
		$operator = $this->input->post('operator_name');
		$kode_produksi = $this->input->post('kode_produksi');
		$status_mesin = $this->input->post('status_mesin');

		$arrayName = array(
			'mesinid' => $id_mesin,
			'operator' => $operator,
			'kd_produksi' => $kode_produksi,
			'statusmesin' => $status_mesin
		);

		$status = '';
		$msg = '';

		if ($status_mesin) {
			$status = 'ok';
			$msg = 'Mesin ditandai sebagai sedang digunakan';
		}

		if(!$status_mesin) {
			$status = 'ok';
			$msg = 'Mesin ditandai sebagai sedang tidak digunakan';
		}

		$data = array(
			'status' => $status,
			'msg' => $msg
		);

		echo json_encode($data);
	}

}