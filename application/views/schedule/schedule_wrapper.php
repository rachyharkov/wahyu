<style>
.recommended {
    animation: owoglow 800ms infinite alternate;
}

@keyframes owoglow {
  from {
    box-shadow: 1px 1px 5px -5px #fff;
  }
  to {
    box-shadow: 1px 1px 5px 5px #fff;
  }
}

</style>


<div id="content" class="app-content">
	<?php $classnyak->machine_list() ?>
    <h1 class="page-header"></h1>  
    
    <div class="accordion" id="accordiontwo">
      <div class="accordion-item border-0">
        <div class="accordion-header" id="headingOne">
          <button class="accordion-button bg-gray-900 text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
            <i class="fa fa-circle fa-fw text-blue me-2 fs-8px"></i> Schedule
          </button>
        </div>
        <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordiontwo">
          <div class="accordion-body bg-gray-800 text-white">
            <div class="row">
                <div class="col-4">
                    <div class="card text-center border-0">
                        <div class="card-header fw-bold">
                            READY
                        </div>
                        <div class="card-body" style="overflow-y: scroll;height: 55vh;">
                            <?php $classnyak->get_production_ready_schedule()?>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-center border-0">
                        <div class="card-header fw-bold">
                            ON GOING
                        </div>
                        <div class="card-body" style="overflow-y: scroll;height: 55vh;">
                            <?php $classnyak->get_production_ongoing_schedule()?>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card text-center border-0">
                        <div class="card-header fw-bold">
                            DONE
                        </div>
                        <div class="card-body" style="overflow-y: scroll;height: 55vh;">
                            <?php $classnyak->get_production_done_schedule()?>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/assets/plugins/clipboard/dist/clipboard.min.js"></script>
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

        <script type="text/javascript">

            function changewindowtitle(text) {
                $('.panel-title').text(text);
            }

            $(document).ready(function() {
                var clipboard = new ClipboardJS("[data-toggle='clipboard']");
  
              clipboard.on("success", function(e) {
                $(e.trigger).tooltip({
                  title: "Copied",
                  placement: "top"
                });
                $(e.trigger).tooltip("show");
                setTimeout(function() {
                  $(e.trigger).tooltip("dispose");
                }, 500);
              });
            })
            
            $(document).on('click','.tambah_data', function() {
                $('.btn-loading').click()
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url() ?>produksi/create",
                    success: function(data){
                        $('#panel-body').html(data);
                        changewindowtitle('Tambah Data Produksi')
                    },
                    error: function(error) {
                        Swal.fire({
                          icon: 'error',
                          title: "Oops!",
                          text: 'Tidak dapat tersambung dengan server, pastikan koneksi anda aktif, jika masih terjadi hubungi admin IT'
                        })
                    }
                });
            })

            $(document).on('click','.list-data', function(e) {
                e.preventDefault()
                $('.btn-loading').click()
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url() ?>produksi/list",
                    success: function(data){
                        $('#panel-body').html(data);
                        changewindowtitle('List Produksi')
                    },
                    error: function(error) {
                        Swal.fire({
                          icon: 'error',
                          title: "Oops!",
                          text: 'Tidak dapat tersambung dengan server, pastikan koneksi anda aktif, jika masih terjadi hubungi admin IT'
                        })
                    }
                });
            })

            $(document).on('click','.read_data', function() {

                const id = $(this).attr('id')
                $('.btn-loading').click()
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>produksi/read",
                    data: {
                        id:id,
                    },
                    success: function(data){
                        $('#panel-body').html(data);
                        changewindowtitle('Detail Produksi')
                    },
                    error: function(error) {
                        Swal.fire({
                          icon: 'error',
                          title: "Oops!",
                          text: 'Tidak dapat tersambung dengan server, pastikan koneksi anda aktif, jika masih terjadi hubungi admin IT'
                        })
                    }
                });
            })

            $(document).on('click','.update_data', function() {

                const id = $(this).attr('id')
                $('.btn-loading').click()
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>produksi/update",
                    data: {
                        id:id,
                    },
                    success: function(data){
                        $('#panel-body').html(data);
                        changewindowtitle('Edit Data Produksi')
                    },
                    error: function(error) {
                        Swal.fire({
                          icon: 'error',
                          title: "Oops!",
                          text: 'Tidak dapat tersambung dengan server, pastikan koneksi anda aktif, jika masih terjadi hubungi admin IT'
                        })
                    }
                });
            })

            $(document).on('click','.delete_data', function() {
                Swal.fire({
                  title: 'Yakin dihapus?',
                  text: "Data tidak dapat dikembalikan jika terhapus",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes'
                }).then((result) => {
                  if (result.isConfirmed) {
                    const id = $(this).attr('id')
                    $('.btn-loading').click()
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() ?>produksi/delete",
                        data: {
                            id:id,
                        },
                        success: function(data){
                            Swal.fire({
                              icon: 'success',
                              title: "Sukses",
                              text: 'Data produksi berhasil dihapus'
                            })
                            $('#panel-body').html(data);
                            changewindowtitle('List Produksi')
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

            $(document).on('submit','#form_create_action', function(e) {

                e.preventDefault()
                
                if ($(this).valid) return false;

                Swal.fire({
                  title: 'Konfirmasi Tindakan',
                  text: "Yakin disimpan?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes'
                }).then((result) => {
                  if (result.isConfirmed) {
                    dataString = $("#form_create_action").serialize();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() ?>produksi/create_action",
                        data: dataString,
                        success: function(data){
                            Swal.fire({
                              icon: 'success',
                              title: "Sukses",
                              text: 'Data produksi berhasil tercatat'
                            })
                            changewindowtitle('List Produksi')
                            $('#panel-body').html(data);
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

            $(document).on('submit','#form_update_action', function(e) {

                e.preventDefault()
                
                if ($(this).valid) return false;

                Swal.fire({
                  title: 'Konfirmasi Tindakan',
                  text: "Yakin diupdate?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes'
                }).then((result) => {
                  if (result.isConfirmed) {
                    dataString = $("#form_update_action").serialize();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() ?>produksi/update_action",
                        data: dataString,
                        success: function(data){
                            Swal.fire({
                              icon: 'success',
                              title: "Sukses",
                              text: 'Data produksi berhasil diupdate'
                            })
                            changewindowtitle('List Produksi')
                            $('#panel-body').html(data);
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