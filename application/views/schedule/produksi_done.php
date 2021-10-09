<?php
    if ($listofdone) {
        foreach ($listofdone as $key => $value) {
            ?>
            <div class="card border-0 mb-2" style="text-align: left;">
                <div class="card-body">
                    <div class="input-group">
                        <input id="clipboard-default<?php echo $value->id ?>" type="text" class="form-control-plaintext" readonly value="<?php echo $value->id ?>" style="font-size: 1rem;flex: 1 0;" />    
                    </div>
                    <p class="card-text">Target <?php echo $value->total_barang_jadi ?> pcs yang direncanakan selesai <b><?php echo $value->rencana_selesai ?></b> (<?php echo $value->DIFF ?> Hari done).</p>
                </div>
                <div class="card-footer fw-bold">
                    <i style="font-size: 0.6rem;color: gray;">Aktual selesai <?php echo $value->aktual_selesai ?></i>
                    <div style="float: right;">
                        <label class="badge bg-success">Done</label>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <div style="width: 100%; height: 200px; text-align: center; padding: 40px 0;">
            Belum ada produksi yang selesai
        </div>
        <?php
    }

?>