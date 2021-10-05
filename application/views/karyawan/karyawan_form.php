<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">KELOLA DATA KARYAWAN</h4>
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
	    <tr><td >NPK <?php echo form_error('npk') ?></td><td><input type="text" class="form-control" name="npk" id="npk" placeholder="NPK" value="<?php echo $npk; ?>" /></td></tr>
	    <tr><td >Nama Karyawan <?php echo form_error('nama_karyawan') ?></td><td><input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" placeholder="Nama Karyawan" value="<?php echo $nama_karyawan; ?>" /></td></tr>
	    <tr>
            <td >Status Karyawan <?php echo form_error('status_karyawan') ?></td>
            <td><select name="status_karyawan" class="form-control" value="<?= $status_karyawan ?>">
                <option value="" style="color: black">- Pilih -</option>
                <option style="color: black" value="Karyawan Tetap" <?php echo $status_karyawan == 'Karyawan Tetap' ? 'selected' : 'null' ?>>Karyawan Tetap</option>
                <option style="color: black" value="Karyawan Kontrak" <?php echo $status_karyawan == 'Karyawan Kontrak' ? 'selected' : 'null' ?>>Karyawan Kontrak</option>
              </select>
            </td>
          </tr>



	    <tr><td></td><td><input type="hidden" name="karyawan_id" value="<?php echo $karyawan_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('karyawan') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a></td></tr>
</thead>
	</table></form>        </div>
</div>
</div>
</div>