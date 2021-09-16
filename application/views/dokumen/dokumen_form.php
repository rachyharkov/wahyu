<!-- #modal-dialog -->
    <div class="modal fade" id="modal-dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
          </div>
          <div class="modal-body">
            <img src="" id="berkas_dokumen_modal" width="100%" frameborder="0" width="100%" height="400px" />
          </div>
          <div class="modal-footer">
            <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Close</a>
            <a class="btn btn-primary" id="download" href=""><i class="ace-icon fa fa-download"></i> Download</a>
          </div>
        </div>
      </div>
    </div>


<div id="content" class="app-content">
<div class="col-xl-12 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">KELOLA DATA DOKUMEN</h4>
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
	    <tr><td >Nama Dokumen <?php echo form_error('nama_dokumen') ?></td><td><input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen" placeholder="Nama Dokumen" value="<?php echo $nama_dokumen; ?>" /></td></tr>
	    <tr><td >Tgl Pembuatan <?php echo form_error('tgl_pembuatan') ?></td><td><input type="date" class="form-control" name="tgl_pembuatan" id="tgl_pembuatan" placeholder="Tgl Pembuatan" value="<?php echo $tgl_pembuatan; ?>" /></td></tr>
	    <tr><td >Tgl Expired <?php echo form_error('tgl_expired') ?></td><td><input type="date" class="form-control" name="tgl_expired" id="tgl_expired" placeholder="Tgl Expired" value="<?php echo $tgl_expired; ?>" /></td></tr>
	    <tr><td >Tempat Pembuatan <?php echo form_error('tempat_pembuatan') ?></td><td><input type="text" class="form-control" name="tempat_pembuatan" id="tempat_pembuatan" placeholder="Tempat Pembuatan" value="<?php echo $tempat_pembuatan; ?>" /></td></tr>


	    <?php if ($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'create_action' ) { ?>
                     <tr><td >Berkas Dokumen <?php echo form_error('berkas_dokumen') ?></td><td><input type="file" class="form-control" name="berkas_dokumen" id="berkas_dokumen" placeholder="Berkas Dokumen" required="" value="" onchange="return validasiEkstensi()" />
                        <!-- <div id="preview"></div> -->
                     </td></tr>
                  <?php }else{ ?>
                  <div class="form-group">
                    <tr>
                        <td >Berkas Dokumen <?php echo form_error('berkas_dokumen') ?></td>
                        <td>
                       <!--     <a
                            id="view_gambar"
                            href="#modal-dialog"
                            data-bs-toggle="modal"
	                        data-berkas_dokumen_modal="<?php echo $berkas_dokumen; ?>"> -->
	                            <embed width="100%" height="400px"  src="<?= base_url() ?>assets/assets/img/dokumen/<?php echo $berkas_dokumen; ?>" /></embed>
                     <!--    	</a> -->

                            <input type="hidden" name="berkas_dokumen_lama" value="<?=$berkas_dokumen?>">
                            <p style="color: red">Note :Pilih Beras Dokumen Jika Ingin Merubah</p>
                            <input type="file" class="form-control" name="berkas_dokumen" id="berkas_dokumen" placeholder="berkas_dokumen" value="" onchange="return validasiEkstensi()" />
                        </td>

                    </tr>

                    
                  </div>
                  <?php } ?>




	    <tr><td></td><td><input type="hidden" name="dokumen_id" value="<?php echo $dokumen_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('dokumen') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a></td></tr>
</thead>
	</table></form>        </div>
</div>
</div>
</div>


     <script type="text/javascript">
        $(document).on('click','#view_gambar',function(){
          var berkas_dokumen = $(this).data('berkas_dokumen_modal');
          $('#modal-dialog #berkas_dokumen_modal').attr("src", "assets/assets/img/dokumen/"+berkas_dokumen);
          $('#modal-dialog #download').attr("href", "karyawan/download/"+berkas_dokumen);
        })
    </script>

<script type="text/javascript">
  function validasiEkstensi(){
    var inputFile = document.getElementById('berkas_dokumen');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi .jpeg/.jpg/.png/.pdf');
        inputFile.value = '';
        return false;
    }else{
        // Preview berkas_dokumen
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