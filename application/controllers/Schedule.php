<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Mesin_model');
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
        );
		$this->load->view('schedule/machine_lists',$data);
	}

}