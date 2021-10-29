<?php 
    
     //ubah timezone menjadi jakarta
                        // date_default_timezone_set("Asia/Jakarta");

                        //ambil jam dan menit
    $jam = date('H:i');

    //atur salam menggunakan IF
    if ($jam > '05:30' && $jam < '10:00') {
        $salam = 'Pagi';
    } elseif ($jam >= '10:00' && $jam < '15:00') {
        $salam = 'Siang';
    } elseif ($jam < '18:00') {
        $salam = 'Sore';
    } else {
        $salam = 'Malam';
    }

?>

<style>

.select-form-bulanan-1, .select-form-bulanan-2, .select-form-nya
{
    display: none;
}

.showed
{
    display: inline-block !important;
}

.recommended {
    animation: owoglow 800ms infinite alternate;
}

@keyframes owoglow {
  from {
    box-shadow: 1px 1px 5px -5px #fff;
  }
  to {
    box-shadow: 1px 1px 5px 5px #fff;
  }
}

</style>

<div id="content" class="app-content">
    <div class="accordion" id="accordion-work-calendar">
      <div class="accordion-item border-0">
        <div class="accordion-header" id="headingTne">
          <button class="accordion-button bg-gray-900 text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-work-calendar">
            <i class="fa fa-circle fa-fw text-blue me-2 fs-8px"></i> Calendar Work
          </button>
        </div>
        <div id="collapse-work-calendar" class="accordion-collapse collapse show" data-bs-parent="#accordion-work-calendar">
          <div class="accordion-body bg-gray-800 text-white">
          	<div class="container" style="overflow-x: scroll;">
	          	<table class="table table-bordered table-responsive table-hover table-td-valign-middle">
	          		<thead>
	          			<?php
	          			$start  = new DateTime($year.'-'.$month.'-01');
						$end    = $start->format('t') - 1;
						$period = new DatePeriod($start, new DateInterval('P1D'), $end);

						$dateObj   = DateTime::createFromFormat('!m', $month);
						$monthName = $dateObj->format('F'); // March


	          			?>
	          			<tr>
	          				<td colspan="<?php echo $end + 6 ?>" style="font-size: 15px; font-weight: bold;">SCHEDULE LOADING <?php echo $machine_name.' ('.$monthName.' '.$year.')' ?> </td>
	          			</tr>
	          			<tr>
	          				<td>No</td>
	          				<td>Job Order</td>
	          				<td>Produksi</td>
	          				<td>Qty</td>
	          				<td>Plan Actual</td>
	          				<?php
								foreach($period as $day){
								  ?>
								  <td><?php echo $day->format('d') ?></td>
								  <?php
								}

							?>
	          			</tr>
	          		</thead>
	          		<tbody>
	          			<?php

	          			?>
	          			<tr></tr>
	          		</tbody>
	          	</table>
          	</div>
          </div>
        </div>
      </div>
    </div>
</div>