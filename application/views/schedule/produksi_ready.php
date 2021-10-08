<?php
    if ($listofready) {
        foreach ($listofready as $key => $value) {
            ?>
            <div class="card border-0 mb-2 <?php if($value->DIFF <= 10){ echo 'recommended'; } ?>" style="text-align: left;">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $value->id ?></h4>
                    <p class="card-text">Target <?php echo $value->total_barang_jadi ?> pcs yang direncanakan selesai <b><?php echo $value->rencana_selesai ?></b> (<?php echo $value->DIFF ?> Hari done).</p>
                </div>
                <div class="card-footer fw-bold">
                    <i style="font-size: 0.6rem;color: gray;">Start at <?php echo $value->tanggal_produksi ?></i>
                    <div style="float: right;">
                        <label class="badge bg-danger">Ready</label>
                        <?php if($value->DIFF <= 10){ ?> <label class="badge bg-warning">Recommended</label> <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <div style="width: 100%; height: 200px; text-align: center; padding: 40px 0;">
            Belum ada jadwal produksi
        </div>
        <?php
    }

?>