<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">KELOLA DATA DATA_BENEFIT</h4>
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
            <td >Categori Benefit <?php echo form_error('categori_benefit_id') ?></td>
            <td><select name="categori_benefit_id" class="form-control">
                <option value="">-- Pilih -- </option>
                <?php foreach ($categori_benefit as $key => $data) { ?>
                  <?php if ($categori_benefit_id == $data->categori_benefit_id) { ?>
                    <option value="<?php echo $data->categori_benefit_id ?>" selected><?php echo $data->nama_categori_benefit ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $data->categori_benefit_id ?>"><?php echo $data->nama_categori_benefit ?></option>
                  <?php } ?>
                <?php } ?>
              </select></td>
          </tr>

	    <tr><td >Besar Benefit <?php echo form_error('besar_benefit') ?></td><td><input type="text" class="form-control" name="besar_benefit" id="besar_benefit" placeholder="Besar Benefit" value="<?php echo $besar_benefit; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="data_benefit_id" value="<?php echo $data_benefit_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('data_benefit') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a></td></tr>
</thead>
	</table></form>        </div>
</div>
</div>
</div>