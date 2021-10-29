<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Machine_schedule extends CI_Controller {

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
		$getallmachine = $this->Mesin_model->get_all();
		$data = array(
			'classnyak' => $this,
            'mesin_data' => $getallmachine,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
		$this->template->load('template','schedule_machine/schedule_machine_wrapper',$data);
	}

	function detail($machine,$month,$year)
	{
		$machinedata = $this->Mesin_model->get_by_kd_mesin($machine);
		$dataproduksi = $this->Produksi_model->find_produksi($machine, $month, $year);
		$data =  array(
			'machine_id' => $machinedata->mesin_id,
			'machine_name' => $machinedata->nama_mesin,
			'month' => $month,
			'year' => $year,

			'classnyak' => $this,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
		);
		$this->template->load('template','schedule_machine/schedule_machine_detail',$data);
	}
}