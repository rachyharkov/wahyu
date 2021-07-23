<div id="content" class="app-content">
            <h1 class="page-header">KELOLA DATA KARYAWAN</h1>  
            <div class="panel panel-inverse">
              <div class="panel-heading">
                <h4 class="panel-title">List Data karyawan </h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">        
                                <div class="box-body">
                                    <div class='row'>
                                        <div class='col-md-9'>
                                            <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('karyawan/create'), '<i class="fas fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm tambah_data"'); ?>
		<?php echo anchor(site_url('karyawan/excel'), '<i class="far fa-file-excel" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm export_data"'); ?>
                </div>
            </div>
        </div>   
        <div class="box-body" style="overflow-x: scroll; ">
        <table id="data-table-default" class="table table-bordered table-hover table-td-valign-middle text-white">
         <thead>
            <tr>
        <th width="1%">No</th>
        <th width="1%" data-orderable="false">Photo</th>
		<th>Nama Karyawan</th>
		<th>Nik</th>
		<th>Email</th>
		<th>No Hp</th>
		<th>Pendidikan</th>
		<th>Jabatan</th>
		<th>Status Karyawan</th>
		<th>Alamat</th>
		<th>Jenis Kelamin</th>
		<th>Status Kawin</th>
		<th>Tgl Masuk</th>
		<th>Action</th>
            </tr></thead><tbody><?php $no = 1;
            foreach ($karyawan_data as $karyawan)
            {
                ?>
                <tr>
			<td><?= $no++?></td>
            <td class="with-img">
                <a
                id="view_gambar"
                href="#modal-dialog"
                data-bs-toggle="modal"
                data-photo="<?php echo $karyawan->photo ?>"
                data-nama_karyawan="<?php echo $karyawan->nama_karyawan ?>">
                    <img src="<?= base_url() ?>assets/assets/img/karyawan/<?php echo $karyawan->photo ?>" class="rounded h-30px my-n1 mx-n1" />
                </a></td>
			<td><?php echo $karyawan->nama_karyawan ?></td>
			<td><?php echo $karyawan->nik ?></td>
			<td><?php echo $karyawan->email ?></td>
			<td><?php echo $karyawan->no_hp ?></td>
			<td><?php echo $karyawan->pendidikan ?></td>
			<td><?php echo $karyawan->nama_jabatan ?></td>
			<td><?php echo $karyawan->nama_status_karyawan ?></td>
			<td><?php echo $karyawan->alamat ?></td>
			<td><?php echo $karyawan->jenis_kelamin ?></td>
			<td><?php echo $karyawan->status_kawin ?></td>
			<td><?php echo $karyawan->tgl_masuk ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('karyawan/read/'.encrypt_url($karyawan->karyawan_id)),'<i class="fas fa-eye" aria-hidden="true"></i>','class="btn btn-success btn-sm read_data"'); 
				echo '  '; 
				echo anchor(site_url('karyawan/update/'.encrypt_url($karyawan->karyawan_id)),'<i class="fas fa-pencil-alt" aria-hidden="true"></i>','class="btn btn-primary btn-sm update_data"'); 
				echo '  '; 
				echo anchor(site_url('karyawan/delete/'.encrypt_url($karyawan->karyawan_id)),'<i class="fas fa-trash-alt" aria-hidden="true"></i>','class="btn btn-danger btn-sm delete_data" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php } ?>
            </tbody>
        </table>
                
	  </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </div>
             <!-- #modal-dialog -->
    <div class="modal fade" id="modal-dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Photo <span id="cuts"></span></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
          </div>
          <div class="modal-body">
            <img src="" id="photo_karyawan" width="100%" />
          </div>
          <div class="modal-footer">
            <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Close</a>
            <a class="btn btn-primary" id="download" href=""><i class="ace-icon fa fa-download"></i> Download</a>
          </div>
        </div>
      </div>
    </div>

   

    <script type="text/javascript">
        $(document).on('click','#view_gambar',function(){
          var nama_karyawan = $(this).data('nama_karyawan');
          var photo = $(this).data('photo');
          $('#modal-dialog #cuts').text(nama_karyawan);
          $('#modal-dialog #photo_karyawan').attr("src", "assets/assets/img/karyawan/"+photo);
          $('#modal-dialog #download').attr("href", "karyawan/download/"+photo);
        })
    </script>

        <?php
        if (is_allowed_button($this->uri->segment(1),'read')<1) { ?>
            <script>
                    $('.read_data').css('display','none')
            </script>
        <?php } ?>

        <?php
        if (is_allowed_button($this->uri->segment(1),'create')<1) { ?>
            <script>
                    $('.tambah_data').css('display','none')
            </script>
        <?php } ?>

        <?php
        if (is_allowed_button($this->uri->segment(1),'export')<1) { ?>
            <script>
                    $('.export_data').css('display','none')
            </script>
        <?php } ?>

        <?php
        if (is_allowed_button($this->uri->segment(1),'update')<1) { ?>
            <script>
                    $('.update_data').css('display','none')
            </script>
        <?php } ?>

        <?php
        if (is_allowed_button($this->uri->segment(1),'delete')<1) { ?>
            <script>
                    $('.delete_data').css('display','none')
            </script>
        <?php } ?>