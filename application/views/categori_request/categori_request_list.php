<style type="text/css">
    body{
    background:#eee;
    margin-top:20px;
}
.hori-timeline .events {
    border-top: 3px solid #e9ecef;
}
.hori-timeline .events .event-list {
    display: block;
    position: relative;
    text-align: center;
    padding-top: 70px;
    margin-right: 0;
}
.hori-timeline .events .event-list:before {
    content: "";
    position: absolute;
    height: 36px;
    border-right: 2px dashed #dee2e6;
    top: 0;
}
.hori-timeline .events .event-list .event-date {
    position: absolute;
    top: 38px;
    left: 0;
    right: 0;
    width: 75px;
    margin: 0 auto;
    border-radius: 4px;
    padding: 2px 4px;
}
@media (min-width: 1140px) {
    .hori-timeline .events .event-list {
        display: inline-block;
        width: 24%;
        padding-top: 45px;
    }
    .hori-timeline .events .event-list .event-date {
        top: -12px;
    }
}
.bg-soft-primary {
    background-color: rgba(64,144,203,.3)!important;
}
.bg-soft-success {
    background-color: rgba(71,189,154,.3)!important;
}
.bg-soft-danger {
    background-color: rgba(231,76,94,.3)!important;
}
.bg-soft-warning {
    background-color: rgba(249,213,112,.3)!important;
}
.card {
    border: none;
    margin-bottom: 24px;
    -webkit-box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
    box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
}


</style>
<!-- #modal-dialog -->
<div class="modal fade" id="modal-dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Approved </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body">
        <p id="request"></p>
        <form method="POST" action="<?= base_url() ?>categori_request/create_action_approved">
        <input style="color: #000; border-color: #C0C0C0" type="hidden" class="form-control" name="categori_request_id" id="categori_request_id" />
        <div class="form-group">
                      <label for="barcode">Step</label>
                      <input style="color: #000; border-color: #C0C0C0" type="number" class="form-control" name="step" id="step" required="" />
                    </div>
        <div class="form-group">
            <label for="barcode">User Approved</label>
            <select style="color: #000; border-color: #C0C0C0" name="user_id" id="user_id" class="form-control">
                <option value="">- Pilih -</option>
                <?php foreach ($user_data as $user){ ?>
                    <option value="<?php echo $user->user_id ?>"><?php echo $user->nama_user ?></option>
                <?php } ?>
            </select>
    </div>
      </div>
      <div class="modal-footer">
        <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal"> <i class="fas fa-undo"> </i> Kembali</a>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button> 
      </div>
      </form>
    </div>
  </div>
</div>

<!-- #modal-dialog -->
<div class="modal fade" id="modal-graph">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Flow Graph</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body">

                <div class="hori-timeline" dir="ltr">
                    <ul class="list-inline events">
                        <li class="list-inline-item event-list">
                            <div class="px-4">
                                <div class="event-date bg-soft-primary text-primary">Step 1</div>
                                <h5 class="font-size-16">Approved By Engge</h5>
                            </div>
                        </li>
                        <li class="list-inline-item event-list">
                            <div class="px-4">
                                <div class="event-date bg-soft-success text-success">Step 2</div>
                                <h5 class="font-size-16">Approved By Erun</h5>
                            </div>
                        </li>
                        <li class="list-inline-item event-list">
                            <div class="px-4">
                                <div class="event-date bg-soft-danger text-danger">Step 3</div>
                                <h5 class="font-size-16">Approved By Yunus</h5>
                            </div>
                        </li>
                        <li class="list-inline-item event-list">
                            <div class="px-4">
                                <div class="event-date bg-soft-warning text-warning">Step 4</div>
                                <h5 class="font-size-16">Approved By Erun</h5>
                            </div>
                        </li>
                    </ul>
                </div>
</div>
      </div>
    </div>
  </div>
</div>


<div id="content" class="app-content">
            <h1 class="page-header">KELOLA CATEGORI REQUEST</h1>  
            <div class="panel panel-inverse">
              <div class="panel-heading">
                <h4 class="panel-title">List Data</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">        
                                <div class="box-body">
                                    <div class="row">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a href="#default-tab-1" data-bs-toggle="tab" class="nav-link active">
                                                <span class="d-sm-none">Setting Flow Approved</span>
                                                <span class="d-sm-block d-none">Setting Flow Approved</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#default-tab-2" data-bs-toggle="tab" class="nav-link">
                                                <span class="d-sm-none">Categori Request</span>
                                                <span class="d-sm-block d-none">Categori Request</span>
                                                </a>
                                            </li>
                                        </ul>


    <div class="tab-content bg-white-transparent-2 p-3">
    <div class="tab-pane fade active show" id="default-tab-1">
        <div class="accordion" id="accordion">
            <?php $no = 1; foreach ($categori_request_data as $categori_request) { ?>
                <div class="accordion-item border-0">
                <div class="accordion-header" id="headingOne">
                <button class="accordion-button bg-gray-900 text-white px-3 py-10px pointer-cursor collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $categori_request->kd_request ?>" aria-expanded="false">
                <i class="fa fa-circle fa-fw text-blue me-2 fs-8px"></i> <?php echo $categori_request->request ?>
                </button>
                </div>
                <div id="<?php echo $categori_request->kd_request ?>" class="accordion-collapse collapse" data-bs-parent="#accordion" style="">
                <div class="accordion-body bg-gray-800 text-white">
                    <div style="padding-bottom: 10px;">
                       <a
                       id="tambah_approved"
                       href="#modal-dialog"
                       data-categori_request_id="<?php echo $categori_request->categori_request_id ?>"
                       data-request="<?php echo $categori_request->request ?>"
                        class="btn btn-primary" data-bs-toggle="modal"> <i class="fas fa-plus-square" aria-hidden="true"></i> Add</a>
                        <a
                       id="tambah_approved"
                       href="#modal-graph"
                        class="btn btn-success" data-bs-toggle="modal"> View Graph</a>
                    </div>
                    <table class="table table-bordered table-hover table-td-valign-middle text-white">
                     <thead>   
                        <tr>
                            <th width="10%">No / Step</th>
                            <th>User Approved</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <div class="menu-item">
                        <?php
                            $categori_request_id = $categori_request->categori_request_id;
                            $querySubMenu = "SELECT `flow_approved`.`flow_approved_id`,`flow_approved`.`step`, `flow_approved`.`user_id`,`flow_approved`.`categori_request_id`,`user`.*
                            FROM `flow_approved` JOIN `user` 
                              ON `flow_approved`.`user_id` = `user`.`user_id`
                           WHERE `flow_approved`.`categori_request_id` = $categori_request_id
                           ORDER BY `flow_approved`.`step` ASC;
                           ";
                            $subMenu = $this->db->query($querySubMenu)->result_array();
                        ?>
                        <?php foreach ($subMenu as $sm) : ?>
                                <tr>
                                    <td><?= $sm['step'] ?></td>
                                    <td><?= $sm['nama_user'] ?></td>
                                    <td>
                                        <?php   
                                        echo anchor(site_url('categori_request/delete_approved/'. encrypt_url($sm['flow_approved_id'])),'<i class="fas fa-trash-alt" aria-hidden="true"></i>','class="btn btn-danger btn-sm delete_data" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </div>                            
                        </tbody>
                    </table>
                </div>
                </div>
                </div>
            <?php } ?> 
        </div>
    </div>



    <div class="tab-pane fade" id="default-tab-2">
        <div class="panel-body">                                    
<div class='row'>
    <div class='col-md-9'>
        <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('categori_request/create'), '<i class="fas fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm tambah_data"'); ?>
        <?php echo anchor(site_url('categori_request/excel'), '<i class="far fa-file-excel" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm export_data"'); ?>
                </div>
            </div>
        </div>    
        <div class="box-body" style="overflow-x: scroll; ">
        <table class="table table-bordered table-hover table-td-valign-middle text-white">
         <thead>
            <tr>
        <th width="1%">No</th>
        <th>Kd Request</th>
        <th>Request</th>
        <th>Action</th>
            </tr></thead><tbody><?php $no = 1;
            foreach ($categori_request_data as $categori_request)
            {
                ?>
                <tr>
            <td><?= $no++?></td>
            <td><?php echo $categori_request->kd_request ?></td>
            <td><?php echo $categori_request->request ?></td>
            <td>
                <?php 
                echo anchor(site_url('categori_request/read/'.encrypt_url($categori_request->categori_request_id)),'<i class="fas fa-eye" aria-hidden="true"></i>','class="btn btn-success btn-sm read_data"'); 
                echo '  '; 
                echo anchor(site_url('categori_request/update/'.encrypt_url($categori_request->categori_request_id)),'<i class="fas fa-pencil-alt" aria-hidden="true"></i>','class="btn btn-primary btn-sm update_data"'); 
                echo '  '; 
                echo anchor(site_url('categori_request/delete/'.encrypt_url($categori_request->categori_request_id)),'<i class="fas fa-trash-alt" aria-hidden="true"></i>','class="btn btn-danger btn-sm delete_data" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
                <?php } ?>
            </tbody>
        </table>
                
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
        </div>
        <script type="text/javascript">
        $(document).on('click','#tambah_approved',function(){
          var categori_request_id = $(this).data('categori_request_id');
          var request = $(this).data('request');
          $('#request').text(request);
          $('#categori_request_id').val(categori_request_id);
        })
    </script>

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
