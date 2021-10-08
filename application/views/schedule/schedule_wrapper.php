<div id="content" class="app-content">
	<?php $classnyak->machine_list() ?>
    <h1 class="page-header"></h1>  
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Schedule</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-success btn-loading" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            </div>
        <div class="panel-body" id="panel-body">
            <div data-scrollbar="true" data-height="280px">
                <div class="row">
                    <div class="col-4">
                        <div class="card text-center border-0">
                            <div class="card-header fw-bold">
                                READY
                            </div>
                            <div class="card-body">
                                <div class="card border-0 mb-2" style="text-align: left;">
                                    <div class="card-body">
                                        <h4 class="card-title">Special title treatment</h4>
                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    </div>
                                    <div class="card-footer fw-bold">
                                        2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card text-center border-0">
                            <div class="card-header fw-bold">
                                ON GOING
                            </div>
                            <div class="card-body">
                                <div class="card border-0 mb-2" style="text-align: left;">
                                    <div class="card-body">
                                        <h4 class="card-title">Special title treatment</h4>
                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    </div>
                                    <div class="card-footer fw-bold">
                                        2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-center border-0">
                            <div class="card-header fw-bold">
                                READY
                            </div>
                            <div class="card-body">
                                <div class="card border-0 mb-2" style="text-align: left;">
                                    <div class="card-body">
                                        <h4 class="card-title">Special title treatment</h4>
                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    </div>
                                    <div class="card-footer fw-bold">
                                        2 days ago
                                    </div>
                                </div>
                                <div class="card border-0 mb-2" style="text-align: left;">
                                    <div class="card-body">
                                        <h4 class="card-title">Special title treatment</h4>
                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    </div>
                                    <div class="card-footer fw-bold">
                                        2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>

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