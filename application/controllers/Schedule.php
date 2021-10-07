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
		$data = array(
            'machine_list' => $getallmachine,
			'classnyak' => $this
        );
		$this->load->view('schedule/machine_lists',$data);
	}

	function show_machine($mesin_id)
	{
		$getalloperator = $this->Karyawan_model->get_all();
		$getallproduksi = $this->Produksi_model->get_all('READY');
		$datamesin = $this->Mesin_model->get_by_id($mesin_id);

		$data = array(
			'getalloperator' => $getalloperator,
			'getallproduksi' => $getallproduksi,
			'datamesin' => $datamesin
		);
		$this->load->view('schedule/machine_data',$data);
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

	function getdataoperator($id)
	{
		return $this->Karyawan_model->get_by_id($id);
	}
}