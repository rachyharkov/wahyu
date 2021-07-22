<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">KELOLA DATA SUB_MENU</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>
<div class="panel-body">
        
            <form action="<?php echo $action; ?>" method="post">
            <table id="data-table-default" class="table  table-bordered table-hover table-td-valign-middle">
	    <tr>
            <td width='200'>Menu <?php echo form_error('menu_id') ?></td>
            <td><select name="menu_id" class="form-control">
                <option value="">-- Pilih -- </option>
                <?php foreach ($menu as $key => $data) { ?>
                  <?php if ($menu_id == $data->menu_id) { ?>
                    <option value="<?php echo $data->menu_id ?>" selected><?php echo $data->menu ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $data->menu_id ?>"><?php echo $data->menu ?></option>
                  <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
	    <tr><td width='200'>Nama Sub Menu <?php echo form_error('nama_sub_menu') ?></td><td><input type="text" class="form-control" name="nama_sub_menu" id="nama_sub_menu" placeholder="Nama Sub Menu" value="<?php echo $nama_sub_menu; ?>" /></td></tr>
	    <tr><td width='200'>Url <?php echo form_error('url') ?></td><td><input type="text" class="form-control" name="url" id="url" placeholder="Url" value="<?php echo $url; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="sub_menu_id" value="<?php echo $sub_menu_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('menu') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>
</div>