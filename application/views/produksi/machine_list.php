<table class="table table-hover table-sm tabel-machine">
	<thead>
		<tr>
			<th>Machine Name</th>
			<th hidden>Used For</th>
			<th>Throughput</th>
			<th>Shift</th>
			<th>Material Processed</th>
			<th>Products</th>
			<th>Time</th>
			<th hidden="hidden">T. Minutes</th>
		</tr>
	</thead>
	<tbody>
		<?php

		if ($machine_list) {
			
			if ($data_produksi) {

				$data_mesin_produksi_aktif = json_decode($data_produksi->machine_use, true);

				$datamesin = [];

				foreach ($data_mesin_produksi_aktif as $key => $value) {
					array_push($datamesin, $value['machine_id']);
				}

				foreach ($machine_list as $key => $value) {

					//deteksi penggunan mesin bila ada data produksi pada tanggal tsb
					if (!in_array($value->mesin_id, $datamesin)) {
						//ambil data mesin pada produksi

						?>
						<tr class="available-machine" id="<?php echo $value->mesin_id ?>">
							<td>
								<div class="form-check">
									<input class="form-check-input checkboxmachine" name="machine_use[]" type="checkbox" id="checkbox<?php echo $value->mesin_id ?>" value="<?php echo $value->mesin_id ?>">
									<label class="form-check-label" for="checkbox<?php echo $value->mesin_id ?>"><?php echo $value->kd_mesin.' ('.$value->jenis_mesin.')' ?></label>
								</div>
							</td>
							<td hidden>
								<input type="text" name="machineusedfor[]" class="form-control-plaintext" readonly value="<?php echo $value->used_for ?>">	
							</td>
							<td>
								<div class="input-group">
									<input type="number" name="troughputperproduct[]" class="form-control troughputperproduct" value="0" min="0">
									<span class="input-group-text">
										Minute(s)/Pd.
									</span>
								</div>
							</td>
							<td>
								<div class="form-check form-check-inline">
									<input class="form-check-input checkboxshiftformachine<?php echo $value->mesin_id ?>" name="shift1machine<?php echo $value->mesin_id ?>" type="checkbox" id="shift1machine<?php echo $value->mesin_id ?>" checked value="1" />
									<label class="form-check-label" for="shift1machine<?php echo $value->mesin_id ?>">1</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input checkboxshiftformachine<?php echo $value->mesin_id ?>" name="shift2machine<?php echo $value->mesin_id ?>" type="checkbox" id="shift2machine<?php echo $value->mesin_id ?>" value="0"/>
									<label class="form-check-label" for="shift2machine<?php echo $value->mesin_id ?>">2</label>
								</div>
							</td>
							<td>
								<input type="number" name="materialallocated[]" class="form-control materialallocated" value="0">
							</td>
							<td>
								<input type="text" name="goodsallocated[]" readonly class="form-control-plaintext goodsallocated" value="0">
							</td>
							<td>
								<div class="input-group">
									<input type="text" name="timespentpermachine[]" class="form-control-plaintext" readonly>
								</div>
							</td>
							<td hidden>
								<input type="number" name="totalminutes" class="totalminutespermachine" value="0">
							</td>

						</tr>
						<?php
					}
				}
			} else {
				foreach ($machine_list as $key => $value) {
					?>
					<tr class="available-machine" id="<?php echo $value->mesin_id ?>">
						<td>
							<div class="form-check">
								<input class="form-check-input checkboxmachine" name="machine_use[]" type="checkbox" id="checkbox<?php echo $value->mesin_id ?>" value="<?php echo $value->mesin_id ?>">
								<label class="form-check-label" for="checkbox<?php echo $value->mesin_id ?>"><?php echo $value->nama_mesin ?></label>
							</div>
						</td>
						<td hidden>
							<input type="text" name="machineusedfor[]" class="form-control-plaintext" readonly value="<?php echo $value->used_for ?>">	
						</td>
						<td>
							<div class="input-group">
								<input type="number" name="troughputperproduct[]" class="form-control troughputperproduct" value="0" min="0">
								<span class="input-group-text">
									Minute(s)/Pd.
								</span>
							</div>
						</td>
						<td>
							<div class="form-check form-check-inline">
								<input class="form-check-input checkboxshiftformachine<?php echo $value->mesin_id ?>" name="shift1machine<?php echo $value->mesin_id ?>" type="checkbox" id="shift1machine<?php echo $value->mesin_id ?>" checked value="1" />
								<label class="form-check-label" for="shift1machine<?php echo $value->mesin_id ?>">1</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input checkboxshiftformachine<?php echo $value->mesin_id ?>" name="shift2machine<?php echo $value->mesin_id ?>" type="checkbox" id="shift2machine<?php echo $value->mesin_id ?>" value="0"/>
								<label class="form-check-label" for="shift2machine<?php echo $value->mesin_id ?>">2</label>
							</div>
						</td>
						<td>
							<input type="number" name="materialallocated[]" class="form-control materialallocated" value="0">
						</td>
						<td>
							<input type="text" name="goodsallocated[]" readonly class="form-control-plaintext goodsallocated" value="0">
						</td>
						<td>
							<div class="input-group">
								<input type="text" name="timespentpermachine[]" class="form-control-plaintext" readonly>
							</div>
						</td>
						<td hidden>
							<input type="number" name="totalminutes" class="totalminutespermachine" value="0">
						</td>

					</tr>
					<?php
				}
			}
			
		} else {
			echo 'Tidak ada mesin tersedia, coba untuk mulai menambah';
		}
		?>
		<tr>
			<td colspan="4" style="text-align: right; font-size: 14px;"><b>Total</b></td>
			<td><input type="text" name="totalmaterialused" class="form-control-plaintext totalmaterialused"></td>
			<td><input type="text" name="totalproductions" class="form-control-plaintext totalproductions"></td>
			<td><input type="text" name="predictiondone" class="form-control-plaintext predictiondone"></td>
			<td hidden><input type="number" name="totalminuteseverymachine" class="totalminuteseverymachine" value="0"></td>
		</tr>
		
	</tbody>
</table>