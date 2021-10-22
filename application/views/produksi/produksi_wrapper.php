<div id="content" class="app-content">
    <h1 class="page-header">KELOLA DATA PRODUKSI</h1>
    <div class="row">
        <div class="col-md-8">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                <h4 class="panel-title panel-title-produksi">Produksi</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success btn-loading" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    </div>
                <div class="panel-body" id="panel-body">
                    <?php $classnyak->list() ?>
                    
                </div>
            </div>  
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
              <div class="panel-heading">
                <h4 class="panel-title">Smart Assist</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    </div>
                <div class="panel-body">
                    <div class="row">
                      <div class="col-4" style="text-align: center;"><i class="fab fa-github-alt fa-4x"></i></div>
                      <div class="col-8">
                        <h4 id="smart_assist_title" style="font-weight: bold;">Selamat Pagi!</h4>
                        <div id="smart_assist_message">Smart Assist membantu anda untuk melakkan tindakan dengan efisien. Kelihatannya semua terkendali!</div>
                        <div id="smart_assist_recommendation">
                            
                        </div>
                      </div>
                    </div>
                    <!-- <?php $classnyak->showCalendar(date('m'),date('Y')) ?> -->
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


            //THIS IS FOR PRODUKSI
            
            function changewindowtitle(text) {
                $('.panel-title-produksi').text(text);
            }
            
            $(document).on('click','.tambah_data', function() {
                $('.btn-loading').click()
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url() ?>produksi/create",
                    success: function(data){
                        $('#panel-body').html(data);
                        $('#smart_assist_title').text('Kode Order diperlukan')
                        $('#smart_assist_message').html('Harap isi kode order sesuai dengan yang sudah diinput pada laman "Order"')
                        $('#smart_assist_recommendation').html("")
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
                        $('#smart_assist_title').text('Selamat Pagi!')
                        $('#smart_assist_message').html('Smart Assist membantu anda untuk melakkan tindakan dengan efisien. Kelihatannya semua terkendali!')
                        $('#smart_assist_recommendation').html("")
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

        </script>