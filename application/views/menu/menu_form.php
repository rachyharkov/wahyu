<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">KELOLA DATA MENU</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>
<div class="panel-body">
        
            <form action="<?php echo $action; ?>" method="post">
            <table class="table table-bordered table-hover table-td-valign-middle">
	    <tr><td >Menu <?php echo form_error('menu') ?></td><td><input type="text" class="form-control" name="menu" id="menu" placeholder="Menu" value="<?php echo $menu; ?>" /></td></tr>
	    <tr><td >Icon <?php echo form_error('icon') ?></td><td><input type="text" class="form-control" name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" /></td></tr>
	    <tr><td >Urutan <?php echo form_error('urutan') ?></td><td><input type="text" class="form-control" name="urutan" id="urutan" placeholder="Urutan" value="<?php echo $urutan; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="menu_id" value="<?php echo $menu_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('menu') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>
</div>