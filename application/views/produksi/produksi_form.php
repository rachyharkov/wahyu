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
			<input required type="date" class="form-control" name="tanggal_produksi" id="tanggal_produksi" placeholder="Tanggal Produksi" value="<?php echo $tanggal_produksi; ?>" />
		</div>
	</div>

	<div class="row mb-15px">
		<label class="form-label col-form-label col-md-3">Target Selesai</label>
		<div class="col-md-9">
			<input required type="date" class="form-control" name="rencana_selesai" id="rencana_selesai" placeholder="Tanggal Produksi" value="<?php echo $rencana_selesai; ?>" />
		</div>
	</div>

	<div class="row mb-15px">
		<label class="form-label col-form-label col-md-3">Machine Use</label>
		<div class="col-md-9">
			<div class="row">
				<div class="col-4">
					<div class="input-group">
						<span class="input-group-text">Total Material</span>
						<input type="text" name="totalmaterial" class="form-control">
					</div>
				</div>
				<div class="col-4" style="padding-top: 1vh;">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" id="optionone" data-bs-toggle="collapse" data-bs-target="#collapseOne"/>
		  				<label class="form-check-label text-white" for="optionone">Smart Allocate</label>
					</div>
				</div>
			</div>

			
			<table class="table table-hover table-sm">
				<thead>
					<tr>
						<th>Machine Name</th>
						<th>Used For</th>
						<th>Estimated done time per-goods (in minute)</th>
						<th>Material allocated</th>
						<th>Time spent</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$arrbarangdoneperminuteonsinglemachine = [15, 25, 27 ,28 ,21];

					if ($machine_list) {
						foreach ($machine_list as $key => $value) {
							?>
							<tr>
								<td>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="checkbox<?php echo $value->mesin_id ?>">
										<label class="form-check-label" for="checkbox<?php echo $value->mesin_id ?>"><?php echo $value->kd_mesin.' ('.$value->jenis_mesin.')' ?></label>
									</div>
								</td>
								<td>
									<input type="text" name="machineusedfor[]" class="form-control-plaintext" readonly value="<?php echo $value->used_for ?>">	
								</td>
								<td>
									<div class="input-group">
										<input type="text" name="estimateddonepergoodsinminute" class="form-control estimateddonepergoodsinminute">
										<span class="input-group-text">
											Minute(s)
										</span>
									</div>
								</td>
								<td>
									<input type="text" name="materialallocated" class="form-control-plaintext materialallocated">
								</td>
								<td>
									<div class="input-group">
										<input type="text" name="timespentpermachine" class="form-control-plaintext">
									</div>
								</td>

							</tr>
							<?php
						}
					}
					?>
					<tr>
						<td colspan="2"><b>Total</b></td>
						<td><input type="text" name="totaldoneinminute" class="form-control-plaintext"></td>
						<td><input type="text" name="totalmaterialused" class="form-control-plaintext"></td>
						<td><input type="text" name="predictiondone" class="form-control-plaintext"></td>
					</tr>
					
				</tbody>
			</table>
		</div>
	</div>

	<div class="row mb-15px">
		<label class="form-label col-form-label col-md-3">Total Barang Jadi <?php echo form_error('total_barang_jadi') ?></label>
		<div class="col-md-4">
			<div class="input-group" style="width: 150px;">
				<input type="number" class="form-control" name="total_barang_jadi" id="total_barang_jadi" placeholder="Total Barang Jadi" value="<?php echo $total_barang_jadi; ?>" required/>
				<span class="input-group-text">Pcs</span>
			</div>
		</div>
		<div class="col-md-5">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="hidden" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
			<div class="input-group">
			    <button type="submit" class="btn btn-danger btn-create-produksi disabled" disabled=""><i class="fas fa-save"></i> <?php echo $button ?></button> 
			    <button type="button" class="btn btn-info list-data"><i class="fas fa-undo"></i> Kembali</button>
			</div>
		</div>
	</div>

	<div class="container">
		<h4>Kebutuhan Material per-barang</h4>
		<div class="alertdiv">
			
		</div>
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
						<?php
						if ($material_needs) {
							foreach ($material_needs as $key => $value) {
								?>
								<tr id="<?php echo $value->kd_material ?>">
					        		<td></td>
					        		<td><input type="text" name="material_dibutuhkan[]" readonly class="form-control-plaintext ready-to-use-<?php echo $value->kd_material ?>-material" value="<?php echo $value->kd_material ?>" /></td>
					        		<td><input type="text" name="stok_dibutuhkan[]" readonly class="form-control-plaintext ready-to-use-<?php echo $value->kd_material ?>-qty" value="<?php echo $value->jumlah_bahan ?>" /></td>
					        		<td style="width: 80px;">
					        			<div class="input-group">
					        			<button type="button" id="<?php echo $value->kd_material ?>" class="btn btn-xs btn-secondary btn-kurangi-material"><i class="fas fa-minus"></i></button><button type="button" id="<?php echo $value->kd_material ?>" class="btn btn-xs btn-danger btn-hapus-material"><i class="fas fa-times"></i></button></td>
					        			</div>
					        	</tr>
								<?php
							}
						}
						?>
						
					</tbody>
				</table>
			</div>
			<div class="col-md-5">
				<table class="table table-hover table-sm tabel-material-yang-ada table-td-valign-middle">
					<thead>
						<tr>
							<th rowspan="2">Kode Material</th>
							<th rowspan="2">Weight/Pcs (Kg)</th>
							<th colspan="3">Dimensi</th>
							<th rowspan="2">Stock</th>
							<th rowspan="2">Action</th>
						</tr>
						<tr>
							<th>D/T (mm)</th>
							<th>P (mm)</th>
							<th>L (mm)</th>
						</tr>
					</thead>
					<tbody id="materials_available">
						<?php
						if ($material) {
							$o = 1;
							foreach ($material as $key => $value) {
								?>
								<tr class="material-available material-available-<?php echo $value->kd_material ?>">
									<td><input type="hidden" name="id_material_in_stock[]" value="<?php echo $value->id ?>"><input type="text" readonly class="form-control-plaintext" value="<?php echo $value->kd_material ?>"/></td>
									<td><span class="txtberatperpcs"><?php echo $value->berat_per_pcs ?></span></td>
									<?php

									$jsonanu = json_decode($value->dimensi, TRUE);
										?>
										<td>
											<input type="text" class="form-control-plaintext" name="dimensidiametertebal" value="<?php echo $jsonanu['diametertebal'] ?>">
										</td>
										<td>
											<input type="text" class="form-control-plaintext" name="dimensipanjang" value="<?php echo $jsonanu['panjang'] ?>">
										</td>
										<td>
											<input type="text" class="form-control-plaintext" name="dimensilebar" value="<?php echo $jsonanu['lebar'] ?>">
										</td>
										<?php
									?>
									<td><input type="text" name="qty_material_in_stock[]" readonly class="form-control-plaintext stock<?php echo $value->kd_material ?>" value="<?php echo $value->qty ?>"/></td>
									<td style="width: 80px;">
										<div class="input-group">
											<button type="button" id="<?php echo $value->kd_material ?>" class="btn btn-xs btn-success btn-detail-material"><i class="fas fa-eye"></i></button>
											<button type="button" id="<?php echo $value->kd_material ?>" class="btn btn-xs btn-primary btn-add-material"><i class="fas fa-plus-square"></i></button>
										</div>
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
</form>

<script type="text/javascript">
	$(document).ready(function() {

		function checkdisablecreateproductionbutton() {
			if ($('.tabel-material-ready-to-use tbody tr').length > 0 ){
				$('.btn-create-produksi').removeAttr('disabled').removeClass('disabled');
			} else {
				$('.btn-create-produksi').attr('disabled',true).addClass('disabled');
			}
		}

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
		    let stockvalue = $('.stock' + nama_material)

		    if (stockvalue.val() > 0) {
		    	if ($('.tabel-material-ready-to-use tbody tr#' + nama_material).length > 0) {
			    	//let oldval = $('.ready-to-use-' + nama_material + '-qty').val()
			    	$('.ready-to-use-' + nama_material + '-qty').get(0).value++
			    } else {
			        $('#materials_ready_to_use').append(`
			        	<tr id="${nama_material}">
			        		<td></td>
			        		<td><input type="text" name="material_dibutuhkan[]" readonly class="form-control-plaintext ready-to-use-` + nama_material + `-material" value="${nama_material}" /></td>
			        		<td><input type="text" name="stok_dibutuhkan[]" readonly class="form-control-plaintext ready-to-use-` + nama_material + `-qty" value="1" /></td>
			        		<td style="width: 80px;">
			        			<div class="input-group">
			        			<button type="button" id="${nama_material}" class="btn btn-xs btn-secondary btn-kurangi-material"><i class="fas fa-minus"></i></button><button type="button" id="${nama_material}" class="btn btn-xs btn-danger btn-hapus-material"><i class="fas fa-times"></i></button></td>
			        			</div>
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
		    checkdisablecreateproductionbutton()
	    });

	    $('.tabel-material-ready-to-use').on('click','.btn-kurangi-material', function() {
	        const nama_material = $(this).attr('id')
	        const thisel = $(this)
	        let thisrow = thisel.parents('tr')
		    let stockvalue = $('.ready-to-use-' + nama_material + '-qty')

		    if (stockvalue.val() > 1) {
		    	stockvalue.get(0).value--
		    } else {
		        thisrow.remove()
		        urutan--    	
		    }

		    $('.stock' + nama_material).get(0).value++
		    checkdisablecreateproductionbutton()
	    });

    	// let sumtreshold = 0;
    	
   //  	function rumus_treshold_dummy() {
		    
   //  		let sumtresholddummy = 0;
   //  		var totalbarangjadi = $('#total_barang_jadi').val()

		 //    $(".treshold-material").each(function(){
		 //    	var nama_material = $(this).attr('id')

		 //    	var qtymaterial = $('.ready-to-use-' + nama_material + '-qty').val()
		 //    	var treshold_qty = $(this).val()

		 //    	var anu = treshold_qty * qtymaterial
		 //        // sumtresholddummy += +$(this).val();
		 //        sumtresholddummy += anu
		 //    });

		 //    sumtreshold = sumtresholddummy

		 //    $('.treshold-material').removeClass('is-invalid')
			// $('.treshold-material').next().remove()

	  //   	$('.alertdiv').html('')
		 //    if (sumtreshold > totalbarangjadi) {
		 //    	$('.alertdiv').html('<div class="alert alert-danger"><b>Perhatian!</b> Melebihi batas penggunaan bahan target barang jadi</div>')
		 //    }
		 //    console.log(sumtreshold)
   //  	}

   //  	$('#total_barang_jadi').on('input', function() {
   //  		rumus_treshold_dummy()
   //  	})

	  //   function rumus_treshold(total_barang_jadi, treshold_qty, qty, id_material, elem = null) {

	  //   	sumtreshold = 0
	  //   	var totalbarangjadi = $('#total_barang_jadi').val()

		 //    $(".treshold-material").each(function(){
		 //    	var anu = treshold_qty * qty
		 //        // sumtreshold += +$(this).val();
		 //        sumtreshold += anu
		 //    });

		 //    var thisel = $('#' + id_material + '.treshold-material')

		 //    console.log(sumtreshold)
	  //   	thisel.removeClass('is-invalid')
			// thisel.next().remove()
		 //    if (sumtreshold > totalbarangjadi) {
		 //    	thisel.addClass('is-invalid')
			// 	thisel.after(`<div class="invalid-feedback">Melebihi batas penggunaan bahan target barang jadi</div>`)
		 //    }
	  //   }


	   //  $('.tabel-material-ready-to-use').on('input','.treshold-material', function() {

	   //  	const nama_material = $(this).attr('id')

	   //  	var totalbarangjadi = $('#total_barang_jadi').val()
	   //  	var treshold_qty = $(this).val()
	   //  	var qtymaterial = $('.ready-to-use-' + nama_material + '-qty').val()
	   //  	const id_material = $(this).attr('id')

	   //  	var thisel = $('#' + id_material + '.treshold-material')

	   //  	// rumus_treshold(total_barang_jadi, treshold_qty, qtymaterial, id_material)
	   //  	rumus_treshold_dummy()

	   //  	if(thisel.val() < sumtreshold) {
	   //  		thisel.removeClass('is-invalid')
				// thisel.next().remove()
	   //  	}
	   //  });

	    $('.tabel-material-ready-to-use').on('click','.btn-hapus-material', function() {
	        const nama_material = $(this).attr('id')
	        const thisel = $(this)
	        let thisrow = thisel.parents('tr')
		    let stockvalue = $('.ready-to-use-' + nama_material + '-qty')

		    let a = parseInt($('.stock' + nama_material).get(0).value)
		    let b = parseInt(stockvalue.val())

		   	$('.stock' + nama_material).get(0).value = a + b
			thisrow.remove()
			checkdisablecreateproductionbutton()

	    });
	})
</script>