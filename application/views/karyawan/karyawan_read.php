<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">Karyawan Read</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>
<div class="panel-body">
<table id="data-table-default" class="table table-hover table-bordered table-td-valign-middle">
	    <tr><td>Nama Karyawan</td><td><?php echo $nama_karyawan; ?></td></tr>
	    <tr><td>Nik</td><td><?php echo $nik; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>No Hp</td><td><?php echo $no_hp; ?></td></tr>
	    <tr><td>Pendidikan</td><td><?php echo $pendidikan; ?></td></tr>
	    <tr><td>Lokasi Kerja</td><td><?php echo $nama_lokasi; ?></td></tr>
	    <tr><td>Divisi</td><td><?php echo $nama_divisi; ?></td></tr>
	    <tr><td>Jabatan</td><td><?php echo $nama_jabatan; ?></td></tr>
	    <tr><td>Status Karyawan</td><td><?php echo $nama_status_karyawan; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Jenis Kelamin</td><td><?php echo $jenis_kelamin; ?></td></tr>
	    <tr><td>Status Kawin</td><td><?php echo $status_kawin; ?></td></tr>
	    <tr><td>Tgl Masuk</td><td><?php echo $tgl_masuk; ?></td></tr>
	    <tr><td>Photo</td><td>
	    	<a href="#modal-dialog" data-bs-toggle="modal"><img style="width: 150px;height: 150px;border-radius: 50%;" src="<?php echo base_url().'/assets/assets/img/karyawan/'.$photo ?>" /></a></td></tr>
	    	
	    	<tr><td>Status Keaktifan</td><td><?php echo $status_keaktifan; ?></td></tr>
	    <tr>
	    	<td>Berkas Karyawan</td>
	    	<td>
	    		<table class="table table-sm table-bordered">	    		
	    			
	    				<tr>
		                  <th>Nama Berkas</th>
		                  <th>Download</th>
		                  <th>Hapus</th>
		                </tr>
		                <?php foreach ($berkas->result() as $key => $data) { ?>
		    			<tr>
		    				<td> <?php echo $data->nama_berkas ?></td>
		    				<td><a href="<?php echo base_url(); ?>karyawan/download_berkas/<?php echo $data->photo ?>"><i class="ace-icon fa fa-download"></i> Download</a></td>
		    				<td><a href="<?=site_url('karyawan/del_berkas/'.$data->berkas_id.'/' .$this->uri->segment(3))?>" onclick="return confirm('Yakin Akan Hapus ?')" class ="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></a></td>
		    			</tr>
	    			<?php } ?>
	    		</table>  		
	    		
	    	
	    	</td>
	    </tr>

	    <tr>
	    	<td></td>
	    	<td>
	    		<a href="<?php echo site_url('karyawan/pdf/'.encrypt_url($karyawan_id)) ?>" class="btn btn-warning" target="_blank"><i class="fas fa-print" aria-hidden="true"></i> Print</a>
	    		<a href="<?php echo site_url('karyawan') ?>" class="btn btn-default">Cancel</a>
	    	</td>
	    </tr>
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
        <h4 class="modal-title">Photo <?php echo $nama_karyawan; ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body">
        <img src="<?php echo base_url().'/assets/assets/img/karyawan/'.$photo ?>" width="100%" />
      </div>
      <div class="modal-footer">
        <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Close</a>
        <a class="btn btn-primary" href="<?php echo base_url(); ?>karyawan/download/<?php echo $photo ?>"><i
                        class="ace-icon fa fa-download"></i> Download</a>
      </div>
    </div>
  </div>
</div>