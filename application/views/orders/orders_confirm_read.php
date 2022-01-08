<div class="container">
    <div class="container" style="overflow-x: scroll;">
        <table class="table table-bordered table-responsive table-hover table-td-valign-middle">
            <thead>
                <?php

                function isWeekend($date) {
                    return (date('N', strtotime($date)) >= 6);
                }

                $date1  = $tanggal_order;
                $date2  = $rencana_selesai;
                $output = [];
                $time   = strtotime($date1);
                $last   = date('M-Y', strtotime($date2));

                do {
                    $month = date('M-Y', $time);
                    $total = date('t', $time);

                    $output[] = $month;

                    $time = strtotime('+1 month', $time);
                } while ($month != $last);

                $strmonth = '';

                if (count($output) > 1) {
                    $strmonth = reset($output).' - '.end($output);
                } else {
                    $strmonth = $output[0];
                }

                $period = new DatePeriod(new DateTime('01-01-2020'), new DateInterval('P1D'), new DateTime('01-02-2020'));

                // echo implode(",", $output);

                ?>
                <tr>
                    <td colspan="<?php echo count($output) + 6 ?>" style="font-size: 15px; font-weight: bold;">SCHEDULE LOADING <?php echo '('.$strmonth.')' ?> </td>
                </tr>
                <tr>
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
                $dataorder = $classnyak->get_data_order_pure($kd_order,$produksi_id);
                ?>
                <tr>
                    <td><?php echo $produksi_id ?></td>
                    <td><?php echo $dataorder['barang'] ?></td>
                    <td><?php echo $dataorder['qty'] ?></td>
                    <td>P</td>
                    <?php

                    $datestartnya = date('d', strtotime($dataorder['tanggal_produksi']));
                    $dateendnya = date('d', strtotime($dataorder['rencana_selesai']));
                    foreach ($period as $value) {
                        $weekdaykh = isWeekend($value->format('Y-m-d'));
                        if ($value->format('d') >= $datestartnya && $value->format('d') <= $dateendnya) {

                            ?>
                                <td style="background-color: green; text-align: center;">
                                    <?php

                                    if ($weekdaykh == 1) {
                                        ?>
                                            <span style="display: block; height: 20px; width: 20px; transform: scale(0.5); background-color: red;"></span>
                                        <?php
                                    }
                                    ?>

                                </td>
                            <?php
                        } else {
                            ?>
                            <td>
                                <?php
                               if ($weekdaykh == 1) {
                                    ?>
                                        <span style="display: block; height: 20px; width: 20px; transform: scale(0.5); background-color: red;"></span>
                                    <?php
                                }
                                ?>
                            </td>
                            <?php
                        }
                    }
                    ?>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>A</td>
                    <?php
                    foreach ($period as $value) {
                        ?>
                        <td></td>
                        <?php
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-6">
            <table class="table table-borderless table-td-valign-middle text-white">
                <tr><td>Nama Pemesan</td><td>:</td><td><?php echo $nama_pemesan; ?></td></tr>
                <tr><td>Bagian</td><td>:</td><td><?php echo $classnyak->getbagiandata($bagian)->nama_bagian; ?></td></tr>
                <tr><td>No. Kontak</td><td>:</td><td><?php echo $no_kontak; ?></td></tr>

                <tr><td>Nama Barang</td><td>:</td><td><?php echo $nama_barang; ?></td></tr>
                <tr><td>Quantity</td><td>:</td><td><?php echo $qty; ?></td></tr>
                <tr><td>Due Date</td><td>:</td><td><?php echo $due_date; ?></td></tr>
                <tr><td>Note</td><td>:</td><td><?php echo $note; ?></td></tr>
                <tr><td>Priority</td><td>:</td><td><?php 

                $op = $priority;
                $badge = '';
                if ($op == 1) {
                    $badge = '<label class="badge bg-success">Biasa</label>';
                }
                if ($op == 2) {         
                    $badge = '<label class="badge bg-warning">Urgent</label>';
                }
                if ($op == 3) {
                    $badge = '<label class="badge bg-danger">Top Urgent</label>';
                }
                
                echo $badge;

                 ?></td></tr>
                <tr><td>Keterangan</td><td>:</td><td><?php 
                if ($keterangan == 1) {
                    echo 'Part Baru';
                }

                if ($keterangan == 2) {
                    echo 'Repair';
                }

                if ($keterangan == 3) {
                    echo 'Modifikasi';
                }
                 ?></td></tr>

                <tr><td>Status</td><td>:</td><td><?php echo $status; ?></td></tr>
                <tr><td>Tanggal Produksi</td><td>:</td><td><?php echo $tanggal_produksi; ?></td></tr>
                <tr><td>Rencana Selesai</td><td>:</td><td><?php echo $rencana_selesai; ?></td></tr>
                <tr><td>Total Barang Jadi</td><td>:</td><td><?php echo $total_barang_jadi; ?></td></tr>
                <tr>
                    <td>Mesin Digunakan</td>
                    <td>:</td>
                    <td>
                        <ul>
                            <?php

                            $mu = json_decode($machine_used, TRUE);

                            foreach ($mu as $key => $value) {
                                ?>
                                <li><?php echo $classnyak->getmachinedetail($value['machine_id'])->kd_mesin ?></li>
                                <table class="table table-sm table-hover">
                                    <tr>
                                        <td>Estimasi Selesai per-barang</td>
                                        <td><?php echo $value['estimateddonepergoods'] ?> Minute(s)</td>
                                    </tr>
                                    <tr>
                                        <td>Shift</td>
                                        <td><?php if ($value['shift1']) {
                                            ?>
                                            <label class="badge bg-success">Shift 1</label>
                                            <?php
                                        } ?>
                                        <?php if ($value['shift2']) {
                                            ?>
                                            <label class="badge bg-success">Shift 2</label>
                                            <?php
                                        } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Estimasi</td>
                                        <td><?php echo $value['etapermachine'] ?></td>
                                    </tr>
                                </table>
                                <?php
                            }

                            ?>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-6">
            <div class="form-confirmation-order">
                <form id="form_confirm_order">
                    <table class="table table-borderless table-td-valign-middle text-white">
                        <tr>
                            <td>Plan</td><td>:</td><td><?php echo $rencana_selesai ?></td>
                        </tr>
                        <tr>
                            <td>Actual</td><td>:</td><td><input required type="date" class="form-control" name="tanggal_actual" id="tanggal_actual" /></td>
                        </tr>
                    </table>
                </form>
            </div>
            <button class="btn btn-lg btn-success" style="width: 100%;">Konfirmasi Selesai</button>
        </div>
    </div>
</div>