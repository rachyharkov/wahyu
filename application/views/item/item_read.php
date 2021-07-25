<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">Item Read</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>
<div class="panel-body">
<table id="data-table-default" class="table table-hover table-bordered table-td-valign-middle">
	    <tr><td>Kd Internal Item</td><td><?php echo $kd_internal_item; ?></td></tr>
	    <tr><td>Kd External Item</td><td><?php echo $kd_external_item; ?></td></tr>
	    <tr><td>Nama Item</td><td><?php echo $nama_item; ?></td></tr>
	    <tr><td>Kategori Id</td><td><?php echo $kategori_id; ?></td></tr>
	    <tr><td>Unit Id</td><td><?php echo $unit_id; ?></td></tr>
	    <tr><td>Deskripsi</td><td><?php echo $deskripsi; ?></td></tr>
	    <tr><td>Can Be Sold</td><td><?php echo $can_be_sold; ?></td></tr>
	    <tr><td>Can Be Purchased</td><td><?php echo $can_be_purchased; ?></td></tr>
	    <tr><td>Estimasi Harga</td><td><?php echo $estimasi_harga; ?></td></tr>
	    <tr><td>Stok</td><td><?php echo $stok; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('item') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
			</div>
        </div>
    </div>
</div>