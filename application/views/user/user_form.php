<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">KELOLA DATA USER</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>
<div class="panel-body">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
      <table id="data-table-default" class="table  table-bordered table-hover table-td-valign-middle">
        <thead>
	    <tr><td width='200'>Nama User <?php echo form_error('nama_user') ?></td><td><input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Nama User" value="<?php echo $nama_user; ?>" /></td></tr>
	    <tr><td width='200'>Username <?php echo form_error('username') ?></td><td><input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" /></td></tr>
	    
	    <?php if ($this->uri->segment(2)== "create" || $this->uri->segment(2)== "create_action") { ?>
        <tr><td width='200'>Password <?php echo form_error('password') ?></td><td><input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" /></td></tr>
      <?php }else{ ?>
        <tr><td width='200'>Password <?php echo form_error('password') ?></td><td><input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" />
      <small style="color: red">(Biarkan kosong jika tidak diganti)</small></td></tr>
      <?php } ?>
	    

	    <tr>
            <td width='200'>level <?php echo form_error('level_id') ?></td>
            <td><select name="level_id" class="form-control">
                <option value="">-- Pilih -- </option>
                <?php foreach ($level as $key => $data) { ?>
                  <?php if ($level_id == $data->level_id) { ?>
                    <option value="<?php echo $data->level_id ?>" selected><?php echo $data->nama_level ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $data->level_id ?>"><?php echo $data->nama_level ?></option>
                  <?php } ?>
                <?php } ?>
              </select></td>
          </tr>


	    <tr><td width='200'>Email <?php echo form_error('email') ?></td><td><input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" /></td></tr>
	    <tr><td width='200'>No Hp User <?php echo form_error('no_hp_user') ?></td><td><input type="text" class="form-control" name="no_hp_user" id="no_hp_user" placeholder="No Hp User" value="<?php echo $no_hp_user; ?>" /></td></tr>
	    
        <tr><td width='200'>Alamat User <?php echo form_error('alamat_user') ?></td><td>
          <textarea class="textarea form-control" id="wysihtml5" name="alamat_user" placeholder="Alamat User" rows="5"><?php echo $alamat_user; ?></textarea>
        </td></tr>

	    <?php if ($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'create_action' ) { ?>
                     <tr><td width='200'>photo <?php echo form_error('photo') ?></td><td><input type="file" class="form-control" name="photo" id="photo" placeholder="photo" required="" value="" onchange="return validasiEkstensi()" />
                        <!-- <div id="preview"></div> -->
                     </td></tr>
                  <?php }else{ ?>
                  <div class="form-group">
                    

                    <tr>
                        <td width='200'>Photo <?php echo form_error('photo') ?></td>
                        <td>
                            <a href="#modal-dialog" data-bs-toggle="modal"><img  src="<?php echo base_url();?>assets/assets/img/user/<?=$photo?>" style="width: 150px;height: 150px;border-radius: 50%;"></img></a>
                            <input type="hidden" name="photo_lama" value="<?=$photo?>">
                            <p style="color: red">Note :Pilih photo Jika Ingin Merubah photo</p>
                            <input type="file" class="form-control" name="photo" id="photo" placeholder="photo" value="" onchange="return validasiEkstensi()" />
                            <!-- <div id="preview"></div> -->
                        </td>

                    </tr>

                    
                  </div>
                  <?php } ?>

	    <tr><td></td><td><input type="hidden" name="user_id" value="<?php echo $user_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('user') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a></td></tr>
      </thead>
	</table>
</form>
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
        <img src="<?php echo base_url();?>assets/assets/img/user/<?=$photo?>" width="100%" />
      </div>
      <div class="modal-footer">
        <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Close</a>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  function validasiEkstensi(){
    var inputFile = document.getElementById('photo');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi .jpeg/.jpg/.png');
        inputFile.value = '';
        return false;
    }else{
        // Preview photo
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').innerHTML = '<iframe src="'+e.target.result+'" style="height:400px; width:600px"/>';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
</script>