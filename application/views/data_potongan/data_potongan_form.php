<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">KELOLA DATA DATA_POTONGAN</h4>
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
          <tr>
            <td >Karyawan <?php echo form_error('karyawan_id') ?></td>
            <td><select name="karyawan_id" class="form-control">
                <option value="">-- Pilih -- </option>
                <?php foreach ($karyawan as $key => $data) { ?>
                  <?php if ($karyawan_id == $data->karyawan_id) { ?>
                    <option value="<?php echo $data->karyawan_id ?>" selected><?php echo $data->nama_karyawan ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $data->karyawan_id ?>"><?php echo $data->nama_karyawan ?></option>
                  <?php } ?>
                <?php } ?>
              </select></td>
          </tr>


	    <tr>
            <td >Categori Potongan <?php echo form_error('categori_potongan_id') ?></td>
            <td><select name="categori_potongan_id" class="form-control">
                <option value="">-- Pilih -- </option>
                <?php foreach ($categori_potongan as $key => $data) { ?>
                  <?php if ($categori_potongan_id == $data->categori_potongan_id) { ?>
                    <option value="<?php echo $data->categori_potongan_id ?>" selected><?php echo $data->nama_categori_potongan ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $data->categori_potongan_id ?>"><?php echo $data->nama_categori_potongan ?></option>
                  <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
	    <tr><td >Besar Potongan <?php echo form_error('besar_potongan') ?></td><td><input type="text" class="form-control" name="besar_potongan" id="besar_potongan" placeholder="Besar Potongan" value="<?php echo $besar_potongan; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="data_potongan_id" value="<?php echo $data_potongan_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('data_potongan') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a></td></tr>
</thead>
	</table></form>        </div>
</div>
</div>
</div>