<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">KELOLA DATA REQUEST_FORM</h4>
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
	    


	    <?php if ($button =="Create") { ?>
	    	<tr><td >Kode Request Form <?php echo form_error('kode_request_form') ?></td><td><input type="text" readonly="" class="form-control" name="kode_request_form" id="kode_request_form" placeholder="Kode Request Form" value="RF<?php echo $kode; ?>" /></td></tr>
			<input type="hidden" class="form-control" name="user_id" readonly="" id="user_id" placeholder="User Id" value="<?= $this->fungsi->user_login()->user_id; ?>" />
			<tr><td >Tanggal Request <?php echo form_error('tanggal_request') ?></td><td><input type="text" class="form-control" name="tanggal_request" id="tanggal_request" placeholder="Tanggal Request" readonly="" value="<?php echo date('Y-m-d')?>" /></td></tr>
	    <?php }else{ ?>
	    	<tr><td >Kode Request Form <?php echo form_error('kode_request_form') ?></td><td><input type="text" readonly="" class="form-control" name="kode_request_form" readonly="" id="kode_request_form" placeholder="Kode Request Form" value="<?php echo $kode_request_form; ?>" /></td></tr>
	    	<input type="hidden" class="form-control" name="user_id" readonly="" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
	    	<tr><td >Tanggal Request <?php echo form_error('tanggal_request') ?></td><td><input type="text" class="form-control" name="tanggal_request" id="tanggal_request" placeholder="Tanggal Request" readonly="" value="<?php echo $tanggal_request; ?>"  /></td></tr>

	    <?php } ?>  

	    <tr><td >Categori Request<?php echo form_error('categori_request_id') ?></td><td>
	    	<select class="form-control" id="ex-basic"  name="categori_request_id">
				<option>-- Pilih --</option>
			</select>
	    </td>
	</tr>
	    
        <tr><td >Keterangan <?php echo form_error('keterangan') ?></td><td> <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea></td></tr>

        <tr><td >Attachment File<?php echo form_error('>attachment_ile') ?></td>
        	<td>
		        <table class="table table-bordered" id="dynamic_field">
				            <tr style="border: none;">
				                <td style="border: none;">
				                	<input type="text" name="nama_berkas[]" placeholder="Nama File" class="form-control nama_berkas" required="" /></td>
				                <td style="border: none;"><input type="file" name="berkas[]" class="form-control berkas_list" required="" /></td>
				                <td style="border: none;"><button type="button" name="add_berkas" id="add_berkas" class="btn btn-success">Add</button></td>
				             </tr>
				</table>
	        </td>
    	</tr>

         


	    <tr><td></td><td><input type="hidden" name="request_form_id" value="<?php echo $request_form_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('request_form') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a></td></tr>
</thead>
	</table></form>        </div>
</div>
</div>
</div>

<script>
$(document).ready(function() {
    var i = 1;
    $('#add_berkas').click(function() {
        i++;
        $('#dynamic_field').append('<tr style="border: none;" id="row' + i +
            '"><td style="border: none;"><input type="text" name="nama_berkas[]" placeholder="Nama File" class="form-control" required="" /></td><td style="border: none;"><input type="file" name="berkas[]" class="form-control" required="" /></td><td style="border: none;"><button type="button" name="remove" id="' +
            i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    });

    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

});
</script>