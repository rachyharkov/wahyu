<style type="text/css">

.need-attention {
    animation: glow 1s infinite alternate;
}

@keyframes glow {
  from {
    box-shadow: 0 0 5px -5px #ff7b01;
  }
  to {
    box-shadow: 0 0 5px 5px #ff7b01;
  }
}

.hori-timeline {
    margin-top: 15px;
}

.hori-timeline .events {
    border-top: 3px solid #e9ecef;
    display: block;
}
.hori-timeline .events .event-list {
    display: block;
    position: relative;
    text-align: center;
    padding-top: 70px;
    margin-right: 0;
}
.hori-timeline .events .event-list:before {
    content: "";
    position: absolute;
    height: 36px;
    border-right: 2px dashed #dee2e6;
    top: 0;
}
.hori-timeline .events .event-list .event-date {
    position: absolute;
    top: 38px;
    left: 0;
    right: 0;
    width: 75px;
    margin: 0 auto;
    border-radius: 4px;
    padding: 2px 4px;
}
@media (min-width: 768px) {
    
    .hori-timeline .events {
        display: flex !important;
        justify-content: center;
        align-items: center;
    }

    .hori-timeline .events .event-list {
        display: inline-block !important;
        width: 24%;
        padding-top: 45px;
    }
    .hori-timeline .events .event-list .event-date {
        top: -12px;
    }
}
.bg-soft-primary {
    background-color: rgba(64,144,203,.3)!important;
}
.bg-soft-success {
    background-color: rgba(71,189,154,.3)!important;
}
.bg-soft-danger {
    background-color: rgba(231,76,94,.3)!important;
}
.bg-soft-warning {
    background-color: rgba(249,213,112,.3)!important;
}
</style>

<div class="row">
    <div class="col-12">
        <div class="hori-timeline" dir="ltr">
            <ul class="list-inline events">

        <?php 
            $wh = json_decode($whoisreviewing, true);
            //print_r($wh);
            foreach ($wh as $key => $value) {
                if ($value['status'] == '-') {
                    ?>
                    <li class="list-inline-item event-list">
                        <div class="px-4">

                            <?php

                            if ($value['tanda_tangan'] == 'sekarang') {
                                ?>
                                <div class="event-date bg-warning need-attention">
                                    In Review
                                </div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <div class="event-date bg-primary">
                                    Pending
                                </div>
                                <?php   
                            }

                            ?>
                            <h5 class="font-size-13"><?php echo $classnyak->getlevelname($value['level_id'])->nama_level ?></h5>
                        </div>
                    </li>
                    <?php
                }

                if ($value['status'] == 'true') {
                    ?>
                    <li class="list-inline-item event-list">
                        <div class="px-4">
                            <div class="event-date bg-success">
                                Approved
                            </div>
                            <h5 class="font-size-13"><?php echo $classnyak->getlevelname($value['level_id'])->nama_level ?></h5>
                        </div>
                    </li>
                    <?php
                }

                if ($value['status'] == 'false') {
                    ?>
                    <li class="list-inline-item event-list">
                        <div class="px-4">
                            <a class="btn btn-danger event-date" data-bs-toggle="modal" href="#message-disapproved-dialog">
                                Dissaproved
                            </a>
                            <h5 class="font-size-13"><?php echo $classnyak->getlevelname($value['level_id'])->nama_level ?></h5>
                        </div>
                    </li>
                        
                    <?php
                }
            }
        ?>
            </ul>
        </div>
        <form id="form-approve">
            <table class="table table-hover table-bordered table-td-valign-middle">
                <tr><td>Nama Pemesan</td><td><?php echo $nama_pemesan; ?></td></tr>
                <tr><td>Bagian</td><td><?php echo $classnyak->getbagiandata($bagian)->nama_bagian; ?></td></tr>
                <tr><td>No. Kontak</td><td><?php echo $no_kontak; ?></td></tr>

                <tr><td>Nama Barang</td><td><?php echo $nama_barang; ?></td></tr>
                <tr><td>Quantity</td><td><?php echo $qty; ?></td></tr>
                <tr><td>Due Date</td><td><?php echo $due_date; ?></td></tr>
                <tr><td>Note</td><td><?php echo $note; ?></td></tr>
                <tr><td>Priority</td><td><?php 

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
                 ?><input type="hidden" name="priority" id="priority" value="<?php echo $badge; ?>"></td></tr>
                <tr><td>Keterangan</td><td><?php 
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

                <tr><td>Status</td><td><?php echo $status; ?></td></tr>
                <tr><td>Attachment</td><td><?php echo $attachment; ?> <a class="btn btn-primary btn-xs sketsa_preview" href="#modal-dialog-sketch-preview" picture="<?php echo $attachment; ?>" data-bs-toggle="modal"><i class="fas fa-eye"></i></a>
                    
                </td></tr>
                <?php

                if ($status == 'WAITING') {
                    $x = 'sekarang';
                    $result = []; // initialize results

                    foreach ($wh as $key => $value) {
                        if (array_search($x, $value)) {
                            $result[] = $wh[$key]; // push to result if found
                        }
                    }

                    if ($this->session->userdata('level_id') === $result[0]['level_id']) {
                        ?>

                        <tr>
                            <td>Approve Check</td>
                            <td>
                                <div class="form-check form-check-inline mb-15px">
                                    <input type="checkbox" class="form-check-input approve-check" name="attachmentapprovestatus" id="attachmentapprovestatus">
                                    <label for="attachmentapprovestatus" class="form-check-label">Gambar Sesuai</label>
                                </div>

                                <div class="form-check form-check-inline mb-15px">
                                    <input type="checkbox" class="form-check-input approve-check" name="materialavailablestatus" id="materialavailablestatus">
                                    <label for="materialavailablestatus" class="form-check-label">Material Tersedia</label>
                                    <button type="button" class="btn btn-xs btn-info btn-cek-material"><i class="fas fa-cube"></i> Cek Material</button>
                                </div>
                                <textarea id="txtrejectreason" name="txtrejectreason" rows="3" class="form-control" placeholder="Masukan catatan reject order"></textarea>
                            </td>
                        </tr>
                        <tr><td></td><td>
                            <input type="hidden" name="id" value="<?php echo $order_id ?>">
                            <input type="hidden" name="kd_order" value="<?php echo $kd_order ?>">
                            <button type="submit" class="btn btn-success save-waiting-data-approve" id="<?php echo encrypt_url($order_id) ?>"><i class="fas fa-save" aria-hidden="true"></i> Simpan</button>
                            <a href="#modal-reject-reason" data-bs-toggle="modal" class="btn btn-danger reject_waiting_data" id="<?php echo $order_id ?>" style="display: none;"><i class="fas fa-times" aria-hidden="true"></i> Reject</a>
                            
                        </td></tr>
                        <?php
                    }
                }

                ?>
            </table>
            <button type="button" class="btn btn-info waiting-list-data"><i class="fas fa-undo"></i> Kembali</button>
        </form>        
    </div>
</div>

<script type="text/javascript">
    $('.approve-check').click(function() {

        var owo = 0

        $('.approve-check').each(function() {
            if (!this.checked) {
                owo = 1
            }
        })

        if (owo == 1) {
            $('#txtrejectreason').css('display','block')
            $('.reject_waiting_data').css('display','none')
        }

        if (owo == 0) {
            $('#txtrejectreason').css('display','none')
            $('.reject_waiting_data').css('display','unset')
        }
    })
</script>

<script type="text/javascript">

      $(document).ready(function() {
        $('.loading-material').remove()
        $('.list-material').css('display', 'block')
      })

      $('.btn-cek-material').click(function() {

        document.querySelector('#material-finder').scrollIntoView({ behavior: 'smooth' })

        $('#material-finder').addClass('need-attention')

        setTimeout(function() {
            $('#material-finder').removeClass('need-attention')
        }, 2000)


      })
</script>