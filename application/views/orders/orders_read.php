
<table id="data-table-default" class="table table-hover table-bordered table-td-valign-middle">
    <tr><td>Nama Pemesan</td><td><?php echo $nama_pemesan; ?></td></tr>
    <tr><td>Bagian</td><td><?php echo $bagian; ?></td></tr>
    <tr><td>No. Kontak</td><td><?php echo $no_kontak; ?></td></tr>

    <tr><td>Nama Barang</td><td><?php echo $nama_barang; ?></td></tr>
    <tr><td>Quantity</td><td><?php echo $qty; ?></td></tr>
    <tr><td>Due Date</td><td><?php echo $due_date; ?></td></tr>
    <tr><td>Note</td><td><?php echo $note; ?></td></tr>
    <tr><td>Priority</td><td><?php echo $priority; ?></td></tr>
    <tr><td>Keterangan</td><td><?php 
    if ($keterangan == 1) {
        echo 'Part Baru';
    }

    if ($keterangan == 2) {
        echo 'Repair';
    }

    if ($keterangan == 3) {
        echo 'Modifikasi';
    } ?></td></tr>

    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
    <tr><td>Reject Note</td><td><?php echo $reject_note; ?></td></tr>
    <tr><td>Approved By</td><td><?php echo $approved_by; ?></td></tr>
    <tr><td>Attachment</td><td><?php echo $attachment; ?></td></tr>
    <tr><td></td><td>
        <button type="button" class="btn btn-info list-data"><i class="fas fa-undo"></i> Kembali</button></td></tr>
</table>