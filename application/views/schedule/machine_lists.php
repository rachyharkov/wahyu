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
													<input type="text" class="form-control" value="Maman">
												</div>
											</div>
											<div class="option">
												<div class="option-label">Produksi</div>
												<div class="option-input">
													<input type="text" class="form-control" value="P129187817">
												</div>
											</div>
											<div class="option">
												<div class="option-label">Status:</div>
												<div class="option-input" style="display: flex;">
													<div class="form-check form-switch">
														<input class="form-check-input" type="checkbox" name="" id="product1" checked="" value="1">
														<label class="form-check-label" for="product1"></label>
													</div>
													<label class="badge bg-danger">OFF</label>
												</div>
											</div>
											<small class="text-gray"><i>Last run: 21-09-2021 21:23:00</i></small>
										</div>
									</div>
									<div class="product-action">
										<a href="#" class="btn btn-default"><i class="fa fa-times fa-fw"></i> Cancel</a>
										<a href="#" class="btn btn-success"><i class="fa fa-check fa-fw"></i> Update</a>
									</div>
								</div>
							</div>
						</div>
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
