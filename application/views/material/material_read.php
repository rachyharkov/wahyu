<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">Material Read</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>
<div class="panel-body">
<table id="data-table-default" class="table table-hover table-bordered table-td-valign-middle">
	    <tr><td>Id Material</td><td><?php echo $kd_material; ?></td></tr>
	    <tr><td>Id Bentuk</td><td><?php echo $id_bentuk; ?></td></tr>
	    <tr><td>Id Jenis Material</td><td><?php echo $id_jenis_material; ?></td></tr>
	    <tr><td>Dimensi</td><td><?php echo $dimensi; ?></td></tr>
	    <tr><td>Berat Per Pcs</td><td><?php echo $berat_per_pcs; ?></td></tr>
	    <tr><td>Berat Total</td><td><?php echo $berat_total; ?></td></tr>
	    <tr><td>Qty</td><td><?php echo $qty; ?></td></tr>
	    <tr><td>Masa Jenis Material</td><td><?php echo $masa_jenis_material; ?></td></tr>
	    <tr><td>Volume</td><td><?php echo $volume; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('material') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
			</div>
        </div>
    </div>
</div>