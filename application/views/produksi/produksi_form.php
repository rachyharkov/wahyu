<style>
	
	.select2-container
	{
		width: 100%;
	}

	table.tabel-material-ready-to-use {
    	counter-reset: rowNumber;
	}

	table.tabel-material-ready-to-use tbody tr {
	    counter-increment: rowNumber;
	}

	table.tabel-material-ready-to-use tbody tr td:first-child::before {
	    content: counter(rowNumber);
	}

</style>

<form id="<?php echo $action; ?>" method="post">

	<div class="row mb-15px">
		<label class="form-label col-form-label col-md-3">Tanggal Produksi <?php echo form_error('tanggal_produksi') ?></label>
		<div class="col-md-9">
			<input type="date" class="form-control" name="tanggal_produksi" id="tanggal_produksi" placeholder="Tanggal Produksi" value="<?php echo $tanggal_produksi; ?>" />
		</div>
	</div>

	<div class="row mb-15px">
		<label class="form-label col-form-label col-md-3">Total Barang Jadi <?php echo form_error('total_barang_jadi') ?></label>
		<div class="col-md-9">
			<div class="input-group" style="width: 150px;">
				<input type="number" class="form-control" name="total_barang_jadi" id="total_barang_jadi" placeholder="Total Barang Jadi" value="<?php echo $total_barang_jadi; ?>" required/>
				<span class="input-group-text">Pcs</span>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<table class="table table-bordered table-hover table-td-valign-middle tabel-material-ready-to-use">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Material</th>
							<th>Qty</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="materials_ready_to_use">
						
					</tbody>
				</table>
			</div>
			<div class="col-md-5">
				<table class="table table-bordered table-hover table-td-valign-middle tabel-material-yang-ada">
					<thead>
						<tr>
							<th>Kode Material</th>
							<th>Weight/Pcs (Kg)</th>
							<th>Stock</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="materials_available">
						<?php
						if ($material) {
							$o = 1;
							foreach ($material as $key => $value) {
								?>
								<tr class="material-available material-available-<?php echo $value->kd_material ?>">
									<td><span class="txtkdmaterial"><?php echo $value->kd_material ?></span><input type="hidden" class="material_available" value="<?php echo $value->kd_material ?>"></td>
									<td><span class="txtberatperpcs"><?php echo $value->berat_per_pcs ?></span></td>
									<td><input type="text" readonly class="form-control-plaintext" value="<?php echo $value->qty ?>"/></td>
									<td>
										<button type="button" id="<?php echo $value->kd_material ?>" class="btn btn-xs btn-success btn-detail-material"><i class="fas fa-eye"></i></button>
										<button type="button" id="<?php echo $value->kd_material ?>" class="btn btn-xs btn-primary btn-add-material"><i class="fas fa-plus-square"></i></button>
									</td>
								</tr>
								<?php
							}
						} else {
							?>
							<tr>
								<td colspan="4">Tidak ada material tersedia</td>
							</tr>
							<?php
						}
						?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="hidden" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
    <button type="button" class="btn btn-info list-data"><i class="fas fa-undo"></i> Kembali</button>
</form>

<script type="text/javascript">
	$(document).ready(function() {
		let timeoutID = null;
		$('#kd_mesin').keyup(function(e){

			const thisel = $(this)

			const val = $(this).val()

			thisel.removeClass('is-invalid')
			thisel.removeClass('is-valid')
			thisel.nextAll('div').remove()

			clearTimeout(timeoutID);
			timeoutID = setTimeout(() => {

				if (val.length > 1) {
					$.ajax({
			            type : "POST",
			            url  : "<?php echo base_url() ?>mesin/detect_kd_mesin",
			            data : {
			                kd_mesin: val
			            },
			            success: function(data){
			                const dt = JSON.parse(data)

			                thisel.addClass(dt.class)
			                thisel.after(dt.appendedelement)
			                $('.btn-danger').css('display',dt.a)
			            },
			            error: function(e){
			              	thisel.addClass('is-invalid')
			                thisel.after(`<div class="invalid-feedback">Jaringan mengalami masalah</div>`)
			                $('.btn-danger').css('display','none')
			            }
			        });
				}

				if (val.length <= 1) {
					thisel.addClass('is-invalid')
			        thisel.after(`<div class="invalid-feedback">Wajib Diisi</div>`)
				}

			}, 500)
		})

		let urutan = 1;

	    $('.tabel-material-yang-ada').on('click','.btn-add-material', function() {
	        const nama_material = $(this).attr('id')
	        const thisel = $(this)
		    let stockvalue = thisel.parents('tr.material-available').find('td').eq(2).find('input')

		    if (stockvalue.val() > 0) {
		    	if ($('.tabel-material-ready-to-use tbody tr#' + nama_material).length > 0) {
			    	//let oldval = $('.ready-to-use-' + nama_material + '-qty').val()
			    	$('.ready-to-use-' + nama_material + '-qty').get(0).value++
			    } else {
			        $('#materials_ready_to_use').append(`
			        	<tr id="${nama_material}">
			        		<td></td>
			        		<td>${nama_material}</td>
			        		<td><input type="text" id="${nama_material}" readonly class="form-control-plaintext ready-to-use-` + nama_material + `-qty" value="1" /></td>
			        		<td><button type="button" id="${nama_material}" class="btn btn-xs btn-secondary btn-kurangi-material"><i class="fas fa-minus"></i></button><button type="button" class="btn btn-xs btn-danger btn-hapus-material"><i class="fas fa-times"></i></button></td>
			        	</tr>`);
			    }
			    stockvalue.get(0).value--
		    } else {
		    	Swal.fire({
                  icon: 'error',
                  title: "Stok Habis!",
                  text: 'Silahkan tambah pada menu material'
                })
		    }
	    });

	    $('.tabel-material-ready-to-use').on('click','.btn-kurangi-material', function() {
	        const nama_material = $(this).attr('id')
	        const thisel = $(this)
	        let thisrow = thisel.parents('tr')
		    let stockvalue = thisel.parents('tr').find('td').eq(2).find('input')

		    if (stockvalue.val() > 1) {
		    	stockvalue.get(0).value--
		    } else {
		        thisrow.remove()
		        urutan--    	
		    }

		    $('.material-available-' + nama_material + '').find('td').eq(2).find('input').get(0).value++
	    });
	})
</script>