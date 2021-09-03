<div id="content" class="app-content">
  <h1 class="page-header">KELOLA DATA MENU</h1>
  <div class="row">
    <div class="col-xl-6">

      <div class="panel panel-inverse" data-sortable-id="table-basic-1">
<!--         <div class="note note-warning  m-b-15">
          <div class="note-icon"><i class="fa fa-info"></i></div>
          <div class="note-content">
            <h4><b>Note !</b></h4>
            <p>
              Ketika Menghapus Menu Parent maka sub menu yang di bawahnya akan terhapus Juga
            </p>
          </div>
        </div> -->
        <div class="panel-heading">
          <h4 class="panel-title">
            <div class="pull-left">
               <?php echo anchor(site_url('menu/create'), '<i class="fas fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
            </div>
          </h4>
          <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
        </div>


        <div class="panel-body">

          <div class="table-responsive">
            <table class="table table-bordered table-hover m-b-0 text-white" id="data-table-default" >
              <thead>
                <tr>
                  <th width="1%">No</th>
                  <th>Nama</th>
                  <th>Icon</th>
                  <th>Urutan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($menu_data as $menu) { ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?php echo $menu->menu ?></td>
                    <td><?php echo $menu->icon ?></td>
                    <td><?php echo $menu->urutan ?></td>
                    <td style="text-align:center" >
                      <?php 
                      echo anchor(site_url('menu/read/'.$menu->menu_id),'<i class="fas fa-eye" aria-hidden="true"></i>','class="btn btn-success btn-sm"'); 
                      echo '  '; 
                      echo anchor(site_url('menu/update/'.$menu->menu_id),'<i class="fas fa-pencil-alt" aria-hidden="true"></i>','class="btn btn-primary btn-sm"'); 
                      echo '  '; 
                      echo anchor(site_url('menu/delete/'.$menu->menu_id),'<i class="fas fa-trash-alt" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                      ?>
                    </td>
                  </tr>
                <?php
                } ?>

              </tbody>
            </table>
          </div>

        </div>

      </div>
    </div>


    <div class="col-xl-6">

      <div class="panel panel-inverse" data-sortable-id="table-basic-7">

        <div class="panel-heading">
          <h4 class="panel-title"><div class="pull-left">
              <?php echo anchor(site_url('sub_menu/create'), '<i class="fas fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
            </div></h4>
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
          </div>
        </div>


        <div class="panel-body">

          <div class="table-responsive">
            <table class="table table-bordered table-hover m-b-0 text-white" id="data-table-default2"> 
              <thead>
                <tr>
                  <th width="1%">No</th>
                  <th>Menu</th>
                  <th>Nama Sub Menu</th>
                  <th>Url</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($sub_menu_data as $sub_menu) { ?>
                  <tr>
                    <td><?= $no++?></td>
                    <td><?php echo $sub_menu->menu ?></td>
                    <td><?php echo $sub_menu->nama_sub_menu ?></td>
                    <td><?php echo $sub_menu->url ?></td>
                    <td style="text-align:center" >
                      <?php 
                      echo anchor(site_url('sub_menu/read/'.$sub_menu->sub_menu_id),'<i class="fas fa-eye" aria-hidden="true"></i>','class="btn btn-success btn-sm"'); 
                      echo '  '; 
                      echo anchor(site_url('sub_menu/update/'.$sub_menu->sub_menu_id),'<i class="fas fa-pencil-alt" aria-hidden="true"></i>','class="btn btn-primary btn-sm"'); 
                      echo '  '; 
                      echo anchor(site_url('sub_menu/delete/'.$sub_menu->sub_menu_id),'<i class="fas fa-trash-alt" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                      ?>
                    </td>
                  </tr>
                <?php
                } ?>

              </tbody>
            </table>
          </div>

        </div>
      </div>

    </div>

  </div>

</div>