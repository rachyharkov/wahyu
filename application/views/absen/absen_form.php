<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">KELOLA DATA ABSEN</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>
<div class="panel-body">
        
            <form action="<?php echo $action; ?>" method="post">
            
            <table class="table  table-bordered table-hover table-td-valign-middle">
            <thead>
	    <tr><td >Karyawan Id <?php echo form_error('karyawan_id') ?></td><td><input type="text" class="form-control" name="karyawan_id" id="karyawan_id" placeholder="Karyawan Id" value="<?php echo $karyawan_id; ?>" /></td></tr>
	    <tr><td >Status <?php echo form_error('status') ?></td><td><input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" /></td></tr>
	    
        <tr><td >Alasan <?php echo form_error('alasan') ?></td><td> <textarea class="form-control" rows="3" name="alasan" id="alasan" placeholder="Alasan"><?php echo $alasan; ?></textarea></td></tr>
	    <tr><td >Photo <?php echo form_error('photo') ?></td><td><input type="text" class="form-control" name="photo" id="photo" placeholder="Photo" value="<?php echo $photo; ?>" /></td></tr>
	    <tr><td >Tanggal <?php echo form_error('tanggal') ?></td><td><input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" /></td></tr>
	    <tr><td >Jam Masuk <?php echo form_error('jam_masuk') ?></td><td><input type="text" class="form-control" name="jam_masuk" id="jam_masuk" placeholder="Jam Masuk" value="<?php echo $jam_masuk; ?>" /></td></tr>
	    <tr><td >Jam Pulang <?php echo form_error('jam_pulang') ?></td><td><input type="text" class="form-control" name="jam_pulang" id="jam_pulang" placeholder="Jam Pulang" value="<?php echo $jam_pulang; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="absen_id" value="<?php echo $absen_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('absen') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a></td></tr>
</thead>
	</table></form>        </div>
</div>
</div>
</div>