<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">UPLOAD BERKAS KARYAWAN</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>
<div class="panel-body">       
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <table class="table table-bordered" id="dynamic_field">
		            <tr>
		                <td><input type="hidden" name="karyawan_id[]" value="<?php echo $karyawan_id; ?>" />
		                	<input type="text" name="nama_berkas[]" placeholder="Nama Berkas" class="form-control nama_berkas" required="" /></td>
		                <td><input type="file" name="berkas[]" class="form-control berkas_list" required="" /></td>
		                <td><button type="button" name="add_berkas" id="add_berkas" class="btn btn-success">Add</button></td>
		             </tr>
		</table>
		<button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
		<a href="<?php echo site_url('karyawan') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a>
</form>
</div>
</div>
</div>
</div>

<script>
$(document).ready(function() {
    var i = 1;
    $('#add_berkas').click(function() {
        i++;
        $('#dynamic_field').append('<tr id="row' + i +
            '"><td><input type="hidden" name="karyawan_id[]" value="<?php echo $karyawan_id; ?>" /><input type="text" name="nama_berkas[]" placeholder="Nama Berkas" class="form-control" required="" /></td><td><input type="file" name="berkas[]" class="form-control" required="" /></td><td><button type="button" name="remove" id="' +
            i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    });

    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

});
</script>
