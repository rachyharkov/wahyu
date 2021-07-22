<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">User Read</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>
<div class="panel-body">
<table id="data-table-default" class="table table-hover table-bordered table-td-valign-middle">
	    <tr><td>Nama User</td><td><?php echo $nama_user; ?></td></tr>
	    <tr><td>Username</td><td><?php echo $username; ?></td></tr>
	    <tr><td>Level</td><td><?php echo $level_id; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>No Hp User</td><td><?php echo $no_hp_user; ?></td></tr>
	    <tr><td>Alamat User</td><td><?php echo $alamat_user; ?></td></tr>
	    <tr><td>Photo</td><td>
	    	<a href="#modal-dialog" data-bs-toggle="modal"><img style="width: 150px;height: 150px;border-radius: 50%;" src="<?php echo base_url().'/assets/assets/img/user/'.$photo ?>" /></a></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('user') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
			</div>
        </div>
    </div>
</div>


<!-- #modal-dialog -->
<div class="modal fade" id="modal-dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Photo <?php echo $nama_user; ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body">
        <img src="<?php echo base_url().'/assets/assets/img/user/'.$photo ?>" width="100%" />
      </div>
      <div class="modal-footer">
        <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Close</a>
        <a class="btn btn-primary" href="<?php echo base_url(); ?>user/download/<?php echo $photo ?>"><i
                        class="ace-icon fa fa-download"></i> Download</a>
      </div>
    </div>
  </div>
</div>