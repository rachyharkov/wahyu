<button type="button" class="btn btn-info list-data mb-15px"><i class="fas fa-undo"></i> Kembali</button>
<div class="mb-15px alert alert-success">
	Test
</div>
<div class="row">
	<div class="col">
		
	</div>

	<div class="col-md-8 col-sm-12 col-xs-12">
		<form id="<?php echo $action; ?>">
			<input type="hidden" name="order_id" value="<?php echo $order_id; ?>" /> 
			<div class="row">
				<div class="col">
					<div class="mb-15px">
					  <label for="nama_pemesan" class="form-label mb-15px">
					    Nama Pemesan <span style="color: red">*</span>
					  </label>
					  <input type="text" class="form-control form-control-lg" name="nama_pemesan" id="nama_pemesan" placeholder="Masukan inputan anda" value="<?php echo $nama_pemesan; ?>" />
					</div>

					<div class="mb-15px">
					  <label for="bagian" class="form-label mb-15px">Bagian</label>
					  <select>
					  	<option>-pilih-</option>
					  	<?php
					  		foreach ($bagian_list as $key => $value) {
					  			?>
					  			<option value="<?php echo $value->id_bagian ?>" <?php echo $bagian == $value->id_bagian ? 'selected' : '' ?>><?php echo $value->nama_bagian ?> ?></option>
					  			<?php
					  		}
					  	?>
					  </select>
					  <input type="text" class="form-control form-control-lg" name="bagian" id="bagian" placeholder="Masukan inputan anda" value="<?php echo $bagian; ?>" />
					</div>

					<div class="mb-15px">
					  <label for="no_kontak" class="form-label mb-15px">No Kontak</label>
					  <input type="text" name="no_kontak" id="no_kontak" class="form-control form-control-lg" value="<?php echo $no_kontak ?>" placeholder="Masukan inputan anda" />
					</div>

					<div class="mb-15px">
						<label for="keterangan" class="form-label mb-15px">
					    Keterangan
					  	</label>
					  <select name="keterangan" class="form-control form-control-lg" id="keterangan">
		    			<option selected>-pilih-</option>
		    			<option value="1" <?php echo $keterangan == 1 ? 'selected' : '' ?>>Part Baru</option>
		    			<option value="2" <?php echo $keterangan == 2 ? 'selected' : '' ?>>Repair</option>
		    			<option value="3" <?php echo $keterangan == 3 ? 'selected' : '' ?>>Modifikasi</option>
		    		  </select>
					</div>

					<div class="mb-15px">
					 <label for="priority" class="form-label mb-15px">
					    Prioritas
					  </label>
					  <select class="form-control form-control-lg" name="priority" id="priority">
			    			<option selected>-pilih-</option>
			    			<option value="1" <?php echo $priority == 1 ? 'selected' : '' ?> >Biasa</option>
			    			<option value="2" <?php echo $priority == 2 ? 'selected' : '' ?>>Urgent</option>
			    			<option value="3" <?php echo $priority == 3 ? 'selected' : '' ?>>Top Urgent</option>
			    	  </select>
					</div>

					<div class="mb-15px">
					  <label for="nama_barang" class="form-label mb-15px">
					    Nama Barang
					  </label>
					  <input type="text" name="nama_barang" value="<?php echo $nama_barang ?>" id="nama_barang" placeholder="Masukan inputan anda" class="form-control form-control-lg" />
					</div>

					<div class="mb-15px">
					  <label for="qty" class="form-label mb-15px">
					    Quantity
					  </label>
					  <input type="number" name="qty" value="<?php echo $qty ?>" id="qty" class="form-control form-control-lg" placeholder="Masukan inputan anda" />
					</div>

					<div class="mb-15px">
					  <label for="Due Date" class="form-label mb-15px">
					    Due Date
					  </label>
					  <input type="date" name="due_date" value="<?php echo $due_date ?>" id="due_date" class="form-control form-control-lg" placeholder="Masukan inputan anda" />
					</div>

					<div class="mb-15px">
					  <label for="note" class="form-label mb-15px">
					    Catatan
					  </label>
					  <textarea type="text" name="note" rows="4" value="<?php echo $note ?>" id="note" class="form-control form-control-lg" placeholder="Masukan inputan anda"></textarea>
					</div>

					<label for="attachment" class="form-label mb-15px">
					    Attachment
					</label>
					<img id="frame" src="<?php echo base_url().'assets/internal/'.$attachment ?>" width="100%" height="200px" style="object-fit: cover; display: none;" />
					<div class="mb-15px">
					  <input class="form-control form-control-lg" name="attachment" id="attachment" type="file" onchange="preview(this)" required/>
			    		<input type="hidden" name="attachment_old" id="attachment_old" placeholder="Attachment" value="<?php echo $attachment; ?>" />
					</div>

					<button type="submit" class="btn btn-action btn-danger btn-submit"><i class="fas fa-save"></i> Simpan</button>
					<button type="reset" class="btn btn-action btn-info"><i class="fas fa-redo"></i> Bersihkan</button> 

				</div>
			</div>
		</form>	
	</div>

	<div class="col">
		
	</div>
</div>


<script src="<?php echo base_url() ?>assets/assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
<script type="text/javascript">

	$("#no_kontak").mask("999-9999-9999");

	function preview(s) {
		if(s.files[0].size > 2097152){
	       this.value = ""
	       frame.style.display = "none"
	       alert("Maksimal lampiran 2 MB")
	    } else {
	    	frame.style.display = "block"
	    	frame.src=URL.createObjectURL(event.target.files[0]);
	    }
	}

</script>