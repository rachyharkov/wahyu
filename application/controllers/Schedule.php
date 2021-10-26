<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

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
		$getallmachine = $this->Mesin_model->get_all();
		$data = array(
			'classnyak' => $this,
            'machine_list' => $getallmachine,
            'sett_apps' =>$this->Setting_app_model->get_by_id(1),
        );
		$this->template->load('template','schedule/schedule_wrapper',$data);
	}

	function machine_list()
	{
		$getalloperator = $this->Karyawan_model->get_all();
		$getallreadyproduksi = $this->Produksi_model->get_all_ready();
		$getallreadyfinishingproduksi = $this->Produksi_model->get_all_ready_finishing();

		$getallmachineproduction = $this->Mesin_model->get_all('PRODUCTION');
		$getallmachinefinishing = $this->Mesin_model->get_all('FINISHING');

		$data = array(

			'classnyak' => $this,
			'getalloperator' => $getalloperator,
			'getallreadyproduksi' => $getallreadyproduksi,
			'getallreadyfinishingproduksi' => $getallreadyfinishingproduksi,
			'machine_list_production' => $getallmachineproduction,
            'machine_list_finishing' => $getallmachinefinishing
        );
		$this->load->view('schedule/machine_list',$data);
	}

	function schedule_list()
	{
		$data = array(
			'classnyak' => $this,
        );
		$this->load->view('schedule/schedule_list',$data);
	}

	function machine_listJSON()
	{
		$getalloperator = $this->Karyawan_model->get_all();
		$getallreadyproduksi = $this->Produksi_model->get_all_ready();
		$getallreadyfinishingproduksi = $this->Produksi_model->get_all_ready_finishing();

		$getallmachineproduction = $this->Mesin_model->get_all('PRODUCTION');
		$getallmachinefinishing = $this->Mesin_model->get_all('FINISHING');

		$data = array(

			'classnyak' => $this,
			'getalloperator' => $getalloperator,
			'getallreadyproduksi' => $getallreadyproduksi,
			'getallreadyfinishingproduksi' => $getallreadyfinishingproduksi,
			'machine_list_production' => $getallmachineproduction,
            'machine_list_finishing' => $getallmachinefinishing
        );
		return $this->load->view('schedule/machine_list',$data, true);
	}

	function update_machine()
	{
		$id_mesin = $this->input->post('id_mesin');
		$operator = $this->input->post('operator_name');
		$kode_produksi = $this->input->post('kode_produksi');
		// $status_mesin = $this->input->post('status_mesin');
		$action = $this->input->post('action');
		$jenis_mesin = $this->input->post('machine_type');

		$arrayName = array(
			'mesinid' => $id_mesin,
			'operator' => $operator,
			'kd_produksi' => $kode_produksi,
			// 'statusmesin' => $status_mesin,
			'action' => $action
		);

		$status = '';
		$msg = '';

		if ($action == 'activate') {
			$status = 'ok';
			$msg = 'Mesin ditandai sebagai sedang digunakan';

			$dataaa = array(
				'operator' => $operator,
				'kd_produksi' => $kode_produksi,
				'status' => 'IN USE',
				'tindakan_terakhir' => date('Y-m-d h:m:s')
			);

			$this->Mesin_model->update($id_mesin, $dataaa);

			if ($jenis_mesin == 'PRODUCTION') {
				$dataproduksi = array(
					'status' => 'ON GOING'
				);

				$this->Produksi_model->update($kode_produksi,$dataproduksi);
			}

			if ($jenis_mesin == 'FINISHING') {
				$dataproduksi = array(
					'status' => 'FINISHING',
				);
				$this->Produksi_model->update($kode_produksi,$dataproduksi);
			}
		}

		if ($action == 'pause') {
			$status = 'ok';
			$msg = 'Mesin ditandai sebagai ditahan penggunaannya';

			$dataaa = array(
				'operator' => $operator,
				'kd_produksi' => $kode_produksi,
				'status' => 'PAUSED',
				'tindakan_terakhir' => date('Y-m-d h:m:s')
			);

			$this->Mesin_model->update($id_mesin, $dataaa);
		}

		if($action == 'stop') {
			$status = 'ok';
			$msg = 'Mesin ditandai sebagai sedang tidak digunakan';

			if ($jenis_mesin == 'PRODUCTION') {
				$dataproduksi = array(
					'status' => 'READY FINISHING',
				);
				$this->Produksi_model->update($kode_produksi,$dataproduksi);
			}

			if ($jenis_mesin == 'FINISHING') {
				$dataproduksi = array(
					'status' => 'DONE',
					'aktual_selesai' => date('Y-m-d h:m:s')
				);
				$this->Produksi_model->update($kode_produksi,$dataproduksi);
			}

			$dataaa = array(
				'operator' => 'N/A',
				'kd_produksi' => 'N/A',
				'status' => 'READY',
				'tindakan_terakhir' => date('Y-m-d h:m:s')
			);

			$this->Mesin_model->update($id_mesin, $dataaa);
		}


		$data = array(
			'status' => $status,
			'msg' => $msg,
			'page' => $this->machine_listJSON()
		);

		echo json_encode($data);
	}

	function getdataoperator($id)
	{
		return $this->Karyawan_model->get_by_id($id);
	}
	function get_production_ready_schedule()
	{
		$data = array(
			'listofready' => $this->Produksi_model->get_production_ready()
		); 
		$this->load->view('schedule/produksi_ready',$data);
	}
	function get_production_ongoing_schedule()
	{
		$data = array(
			'listofongoing' => $this->Produksi_model->get_production_ongoing(),
			'classnyak' => $this
		);
		$this->load->view('schedule/produksi_ongoing',$data);
	}

	function get_production_done_schedule()
	{
		$data = array(
			'listofdone' => $this->Produksi_model->get_production_done(date('d'))
		);
		$this->load->view('schedule/produksi_done',$data);
	}

	function cekkodeproduksipadamesin($kode_produksi)
	{
		$cek = $this->Mesin_model->get_operator_mesin($kode_produksi);
		return $cek;
	}

	public function showCalendar($month, $year)
    {
        //http://keithdevens.com/software/php_calendar
        $time = time();
        $today = date('j', $time);
        $days = array($today => array(null, null,'<div class="today">' . $today . '</div>'));
        $pn = array('&laquo;' => date('n', $time) - 1, '&raquo;' => date('n', $time) + 1);
        echo $this->generate_calendar($year, $month, null, 1, null, 0);
    }

    // PHP Calendar (version 2 . 3), written by Keith Devens
    // http://keithdevens . com/software/php_calendar
    //  see example at http://keithdevens . com/weblog
    function generate_calendar($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 0, $pn = array())
    {
        $first_of_month = gmmktime(0, 0, 0, $month, 1, $year);
        // remember that mktime will automatically correct if invalid dates are entered
        // for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
        // this provides a built in "rounding" feature to generate_calendar()

        $day_names = array(); //generate all the day names according to the current locale
        for ($n = 0, $t = (3 + $first_day) * 86400; $n < 7; $n++, $t+=86400) //January 4, 1970 was a Sunday
            $day_names[$n] = ucfirst(gmstrftime('%A', $t)); //%A means full textual day name

        list($month, $year, $month_name, $weekday) = explode(',', gmstrftime('%m, %Y, %B, %w', $first_of_month));
        $weekday = ($weekday + 6 - $first_day) % 6; //adjust for $first_day
        $title   = htmlentities(ucfirst($month_name)) . $year;  //note that some locales don't capitalize month and day names

        //Begin calendar .  Uses a real <caption> .  See http://diveintomark . org/archives/2002/07/03
        @list($p, $pl) = each($pn); @list($n, $nl) = each($pn); //previous and next links, if applicable
        if($p) $p = '<span class="calendar-prev">' . ($pl ? '<a href="' . htmlspecialchars($pl) . '">' . $p . '</a>' : $p) . '</span>&nbsp;';
        if($n) $n = '&nbsp;<span class="calendar-next">' . ($nl ? '<a href="' . htmlspecialchars($nl) . '">' . $n . '</a>' : $n) . '</span>';
        $calendar = "<div class=\"mini_calendar\">\n<table class='table table-bordered table-light'>" . "\n" . 
            '<caption class="calendar-month">' . $p . ($month_href ? '<a href="' . htmlspecialchars($month_href) . '">' . $title . '</a>' : $title) . $n . "</caption>\n<tr>";

        if($day_name_length)
        {   //if the day names should be shown ($day_name_length > 0)
            //if day_name_length is >3, the full name of the day will be printed
            foreach($day_names as $d)
                $calendar  .= '<th abbr="' . htmlentities($d) . '">' . htmlentities($day_name_length < 4 ? substr($d,0,$day_name_length) : $d) . '</th>';
            $calendar  .= "</tr>\n<tr>";
        }

        if($weekday > 0) 
        {
            for ($i = 0; $i < $weekday; $i++) 
            {
                $calendar  .= '<td>&nbsp;</td>'; //initial 'empty' days
            }
        }


        for($day = 1, $days_in_month = gmdate('t',$first_of_month); $day <= $days_in_month; $day++, $weekday++)
        {
            if($weekday == 7)
            {
                $weekday   = 0; //start a new week
                $calendar  .= "</tr>\n<tr>";
            }
            if(isset($days[$day]) and is_array($days[$day]))
            {
                @list($link, $classes, $content) = $days[$day];
                if(is_null($content))  $content  = $day;
                $calendar  .= '<td' . ($classes ? ' class="' . htmlspecialchars($classes) . '">' : '>') . 
                    ($link ? '<a href="' . htmlspecialchars($link) . '">' . $content . '</a>' : $content) . '</td>';
            }
            else {
                $calendar  .= "<td>".$day."</td>";
                // if (in_array($day, $b)) {
                //     $calendar  .= "<td style='color: red;'>".$day."</td>";
                // } else {
                // }
            }
        }
        if($weekday != 7) $calendar  .= '<td id="emptydays" colspan="' . (7-$weekday) . '">&nbsp;</td>'; //remaining "empty" days

        return $calendar . "</tr>\n</table>\n</div>\n";
    }
}