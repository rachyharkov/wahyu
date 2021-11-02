<div class="row">
    <div class="col-12">
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
                 ?></td></tr>
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
                <tr><td>Approved By</td><td><?php echo $approved_by; ?></td></tr>
                <tr><td>Attachment</td><td><?php echo $attachment; ?> <a class="btn btn-primary btn-xs sketsa_preview" href="#modal-dialog-sketch-preview" picture="<?php echo $attachment; ?>" data-bs-toggle="modal"><i class="fas fa-eye"></i></a>
                    
                </td></tr>
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
                    <button type="button" class="btn btn-info waiting-list-data"><i class="fas fa-undo"></i> Kembali</button>
                </td></tr>
            </table>
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