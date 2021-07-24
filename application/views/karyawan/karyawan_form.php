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
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <table class="table  table-bordered table-hover table-td-valign-middle">
            	<thead>
	    <tr><td >Nama Karyawan <?php echo form_error('nama_karyawan') ?></td><td><input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" placeholder="Nama Karyawan" value="<?php echo $nama_karyawan; ?>" /></td></tr>
	    <tr><td >NIK <?php echo form_error('nik') ?></td><td><input type="text" class="form-control" name="nik" id="nik" placeholder="NIK" value="<?php echo $nik; ?>" /></td></tr>
	    <tr><td >Email <?php echo form_error('email') ?></td><td><input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" /></td></tr>
	    <tr><td >No Hp <?php echo form_error('no_hp') ?></td><td><input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" /></td></tr>
	    <tr>
            <td >Pendidikan <?php echo form_error('pendidikan') ?></td>
            <td><select name="pendidikan" class="form-control" value="<?= $pendidikan ?>">
                <option value="">- Pilih -</option>
                <option value="SD/MI" <?php echo $pendidikan == 'SD/MI' ? 'selected' : 'null' ?>>SD/MI</option>
                <option value="SMP/MTS" <?php echo $pendidikan == 'SMP/MTS' ? 'selected' : 'null' ?>>SMP/MTS</option>
                <option value="SMA/SMK" <?php echo $pendidikan == 'SMA/SMK' ? 'selected' : 'null' ?>>SMA/SMK</option>
                <option value="D3" <?php echo $pendidikan == 'D3' ? 'selected' : 'null' ?>>D3</option>
                <option value="S1" <?php echo $pendidikan == 'S1' ? 'selected' : 'null' ?>>S1</option>
                <option value="S2" <?php echo $pendidikan == 'S2' ? 'selected' : 'null' ?>>S2</option>
                <option value="S3" <?php echo $pendidikan == 'S3' ? 'selected' : 'null' ?>>S3</option>
              </select>
            </td>
          </tr>

          <tr>
            <td >Divisi <?php echo form_error('divisi_id') ?></td>
            <td><select name="divisi_id" class="form-control">
                <option value="">-- Pilih -- </option>
                <?php foreach ($divisi as $key => $data) { ?>
                  <?php if ($divisi_id == $data->divisi_id) { ?>
                    <option value="<?php echo $data->divisi_id ?>" selected><?php echo $data->nama_divisi ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $data->divisi_id ?>"><?php echo $data->nama_divisi ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
          </td>
          </tr>


	    <tr>
            <td >Jabatan <?php echo form_error('jabatan_id') ?></td>
            <td><select name="jabatan_id" class="form-control">
                <option value="">-- Pilih -- </option>
                <?php foreach ($jabatan as $key => $data) { ?>
                  <?php if ($jabatan_id == $data->jabatan_id) { ?>
                    <option value="<?php echo $data->jabatan_id ?>" selected><?php echo $data->nama_jabatan ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $data->jabatan_id ?>"><?php echo $data->nama_jabatan ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
          </td>
          </tr>

         <tr>
            <td >Status Karyawan <?php echo form_error('status_karyawan_id') ?></td>
            <td><select name="status_karyawan_id" class="form-control">
                <option value="">-- Pilih -- </option>
                <?php foreach ($status_karyawan as $key => $data) { ?>
                  <?php if ($status_karyawan_id == $data->status_karyawan_id) { ?>
                    <option value="<?php echo $data->status_karyawan_id ?>" selected><?php echo $data->nama_status_karyawan ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $data->status_karyawan_id ?>"><?php echo $data->nama_status_karyawan ?></option>
                  <?php } ?>
                <?php } ?>
              </select></td>
          </tr>	    
        <tr><td >Alamat <?php echo form_error('alamat') ?></td><td> <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea></td></tr>

      <tr>
            <td >Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></td>
            <td>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="jenis_kelamin1" name="jenis_kelamin" value="Laki Laki" <?php echo $jenis_kelamin == 'Laki Laki' ? 'checked' : 'null' ?>>
                <label class="form-check-label" for="jenis_kelamin1">Laki Laki</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="jenis_kelamin2" name="jenis_kelamin" value="Perempuan" <?php echo $jenis_kelamin == 'Perempuan' ? 'checked' : 'null' ?>>
                <label class="form-check-label" for="jenis_kelamin2">Perempuan</label>
              </div>

            </td>
          </tr>


	    <tr><td>Status Kawin <?php echo form_error('status_kawin') ?></td>
        <td>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status_kawin1" name="status_kawin" value="Belum Kawin" <?php echo $status_kawin == 'Belum Kawin' ? 'checked' : 'null' ?>>
            <label class="form-check-label" for="status_kawin1">Belum Kawin</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status_kawin2" name="status_kawin" value="Kawin" <?php echo $status_kawin == 'Kawin' ? 'checked' : 'null' ?>>
            <label class="form-check-label" for="status_kawin2">Kawin</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status_kawin3" name="status_kawin" value="Cerai Hidup" <?php echo $status_kawin == 'Cerai Hidup' ? 'checked' : 'null' ?>>
            <label class="form-check-label" for="status_kawin3">Cerai Hidup</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="status_kawin4" name="status_kawin" value="Cerai Mati" <?php echo $status_kawin == 'Cerai Mati' ? 'checked' : 'null' ?>>
            <label class="form-check-label" for="status_kawin4">Cerai Mati</label>
          </div>
        </td>
      </tr>


	    <tr><td >Tgl Masuk <?php echo form_error('tgl_masuk') ?></td><td><input type="date" class="form-control" name="tgl_masuk" id="tgl_masuk" placeholder="Tgl Masuk" value="<?php echo $tgl_masuk; ?>" /></td></tr>

	    	    <?php if ($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'create_action' ) { ?>
                     <tr><td >photo <?php echo form_error('photo') ?></td><td><input type="file" class="form-control" name="photo" id="photo" placeholder="photo" required="" value="" onchange="return validasiEkstensi()" />
                        <!-- <div id="preview"></div> -->
                     </td></tr>
                  <?php }else{ ?>
                  <div class="form-group">
                    <tr>
                        <td >Photo <?php echo form_error('photo') ?></td>
                        <td>
                            <a href="#modal-dialog" data-bs-toggle="modal"><img  src="<?php echo base_url();?>assets/assets/img/karyawan/<?=$photo?>" style="width: 150px;height: 150px;border-radius: 50%;"></img></a>
                            <input type="hidden" name="photo_lama" value="<?=$photo?>">
                            <p style="color: red">Note :Pilih photo Jika Ingin Merubah photo</p>
                            <input type="file" class="form-control" name="photo" id="photo" placeholder="photo" value="" onchange="return validasiEkstensi()" />
                        </td>

                    </tr>

                    
                  </div>
                  <?php } ?>


	    <tr><td></td><td><input type="hidden" name="karyawan_id" value="<?php echo $karyawan_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('karyawan') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a></td></tr>
</thead>
	</table></form>        </div>
</div>
</div>
</div>


<script type="text/javascript">
  function validasiEkstensi(){
    var inputFile = document.getElementById('photo');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png)$/i;
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