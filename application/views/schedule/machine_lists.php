<style>
	
	.pos-stock-product {
	    height: 100%;
	    padding: 0.46875rem;
	}

	.pos-stock-product .pos-stock-product-container {
	    background: rgba(102, 102, 102, 0.75);
	    height: 100%;
	}

	.pos-stock-product .pos-stock-product-container .product {
	    height: 100%;
	    overflow: hidden;
	    display: -webkit-box;
	    display: -ms-flexbox;
	    display: flex;
	    -webkit-box-orient: vertical;
	    -webkit-box-direction: normal;
	    -ms-flex-direction: column;
	    flex-direction: column;
	    border-radius: 6px;
	}

	.pos-stock-product .pos-stock-product-container .product .product-img i {
	    padding-top: 15%;
	    background-size: cover;
	    background-position: center;
	    background-repeat: no-repeat;
	}

	.pos-stock-product .pos-stock-product-container .product .product-info {
	    padding: 0.9375rem 1.17188rem;
	    -webkit-box-flex: 1;
	    -ms-flex: 1;
	    flex: 1;
	}

	.pos-stock-product .pos-stock-product-container .product .product-info .title {
	    font-size: 0.875rem;
	    font-weight: 500;
	}

	.pos-stock-product .pos-stock-product-container .product .product-info .desc {
	    color: rgba(255, 255, 255, 0.5);
	    margin-bottom: 0.9375rem;
	}

	.pos-stock-product .pos-stock-product-container .product .product-option {
	    margin: 0 0 0.3125rem;
	}
	
	.pos-stock-product .pos-stock-product-container .product .product-option .option + .option {
	    padding-top: 0.9375rem;
	}

	.pos-stock-product .pos-stock-product-container .product .product-option .option {
	    padding: 0;
	    -webkit-box-flex: 1;
	    -ms-flex: 1;
	    flex: 1;
	    display: -webkit-box;
	    display: -ms-flexbox;
	    display: flex;
	    -ms-flex-align: center;
	    align-items: center;
	}

	.pos-stock-product .pos-stock-product-container .product .product-option .option .option-label {

	    font-weight: 500;
	    width: 90px;
	    padding-right: 0.61875rem;

	}

	.pos-stock-product .pos-stock-product-container .product .product-option .option .option-input {
	    -webkit-box-flex: 1;
	    -ms-flex: 1;
	    flex: 1;
	}

	.pos-stock-product .pos-stock-product-container .product .product-option .option .option-input .form-control {
	    padding: 0.23438rem 0.61875rem;
	}

	.pos-stock-product .pos-stock-product-container .product .product-action {
	    display: -webkit-box;
	    display: -ms-flexbox;
	    display: flex;
	}

	.pos-stock-product .pos-stock-product-container .product .product-action .btn {
	    padding: 0.70312rem 0;
	    -webkit-box-flex: 1;
	    -ms-flex: 1;
	    flex: 1;
	    border-radius: 0;
	}
</style>

<div class="accordion" id="accordion">
  <div class="accordion-item border-0">
    <div class="accordion-header" id="headingOne">
      <button class="accordion-button bg-gray-900 text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
        <i class="fa fa-circle fa-fw text-blue me-2 fs-8px"></i> Machine List
      </button>
    </div>
    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordion">
      <div class="accordion-body bg-gray-800 text-white">
        <div class="row gx-0">
	
			<?php 
			if ($machine_list) {
				foreach ($machine_list as $key => $value) {
					?>
					<div class="col-xl-3 col-lg-4 col-md-5 col-sm-7">
						<form id="form_mesin_<?php echo $value->mesin_id ?>" method="post">
							<div class="pos-stock-product">
								<div class="pos-stock-product-container">
									<div class="product">
										<div class="product-img" style="text-align: center;">
											<i class="fas fa-cogs fa-fw fa-6x"></i>
										</div>
										<div class="product-info">
											<div class="title"><?php echo $value->nama_mesin.'('.$value->kd_mesin.')' ?></div>
											<div class="desc"><?php echo $value->Keterangan ?></div>
											<div class="product-option">
												<div class="option">
													<div class="option-label">Used by:</div>
													<div class="option-input">
														<select class="form-control" name="operator_name" required>
															<option value="">-</option>
															<?php
															foreach($getalloperator as $v)
															{
															?>
																<option value="<?php echo $v->karyawan_id ?>"><?php echo $v->nama_karyawan ?></option>
															<?php
															}
															?>
														}
														</select>
													</div>
												</div>
												<div class="option">
													<div class="option-label">Produksi</div>
													<div class="option-input">
														<select class="form-control" name="kode_produksi" required>
															<option value="">-</option>
															<?php
															foreach($getallproduksi as $v)
															{
															?>
																<option value="<?php echo $v->id ?>"><?php echo $v->id ?></option>
															<?php
															}
															?>
														}
														</select>
													</div>
												</div>
												<div class="option">
													<div class="option-label">Status:</div>
													<div class="option-input" style="display: flex;">
														<div class="form-check form-switch">
															<input class="form-check-input form-check-status-mesin" type="checkbox" name="status_mesin" id="mesin<?php echo $value->mesin_id ?>status" value="0">
															<label class="form-check-label" for="product1"></label>
														</div>
														<label class="badge bg-danger">OFF</label>
													</div>
												</div>
												<small class="text-gray"><i>Last run: 21-09-2021 21:23:00</i></small>
											</div>
										</div>
										<div class="product-action">
											<input type="hidden" name="id_mesin" value="<?php echo $value->mesin_id ?>">
											<button type="reset" class="btn btn-default"><i class="fa fa-times fa-fw"></i> Batal</button>
											<button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i> Update</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<?php
				}
			}
			?>

		</div>
      </div>
    </div>
  </div>
  
</div>

<script type="text/javascript">
	
	$('.form-check-status-mesin').change(function(){
		var thisel = $(this)
		if (thisel.is(':checked')) {
			thisel.attr('value',1)
		} else {
			thisel.attr('value',0)
		}
	})

</script>

<?php

if ($machine_list) {
	foreach ($machine_list as $key => $value) {

		?>
		<script type="text/javascript">
	
			$(document).on('submit','#form_mesin_<?php echo $value->mesin_id ?>', function(e) {

		        e.preventDefault()
		        
		        if ($(this).valid) return false;

		        Swal.fire({
		          title: 'Konfirmasi Tindakan',
		          text: "Yakin menjalankan mesin ini?",
		          icon: 'warning',
		          showCancelButton: true,
		          confirmButtonColor: '#3085d6',
		          cancelButtonColor: '#d33',
		          confirmButtonText: 'Yes'
		        }).then((result) => {
		          if (result.isConfirmed) {
		            dataString = $("#form_mesin_<?php echo $value->mesin_id ?>").serialize();
		            $.ajax({
		                type: "POST",
		                url: "<?php echo base_url() ?>schedule/update_machine",
		                data: dataString,
		                success: function(data){
		                    var dt = JSON.parse(data)

		                    if (dt.status == 'ok') {
			                    Swal.fire({
			                      icon: 'success',
			                      title: "Sukses",
			                      text: dt.msg
			                    })
		                    }

		                    if (dt.status == 'error') {
		                    	Swal.fire({
			                      icon: 'error',
			                      title: "Gagal",
			                      text: dt.msg
			                    })
		                    }

		                    // changewindowtitle('List Produksi')
		                    // $('#panel-body').html(data);
		                },
		                error: function(error) {
		                    Swal.fire({
		                      icon: 'error',
		                      title: "Oops!",
		                      text: 'Tidak dapat tersambung dengan server, pastikan koneksi anda aktif, jika masih terjadi hubungi admin IT'
		                    })
		                }
		            });

		          }
		        })

		    })

		</script>
		<?php

	}
}

?>