<div id="content" class="app-content">
            <h1 class="page-header">KELOLA DATA HISTORY_LOGIN</h1>  
            <div class="panel panel-inverse">
              <div class="panel-heading">
                <h4 class="panel-title">List Data history_login </h4>
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
                                    <div class='row'>
                                        <div class='col-md-9'>
                                            <div style="padding-bottom: 10px;">
<!--         <?php echo anchor(site_url('history_login/create'), '<i class="fas fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?> -->
		<?php echo anchor(site_url('history_login/excel'), '<i class="far fa-file-excel" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm export_data"'); ?>
                </div>
            </div>
        </div>    
        <div class="box-body" style="overflow-x: scroll; ">
        <div class="panel-body">
        <table id="data-table-default" class="table table-bordered table-hover table-td-valign-middle text-white">
         <thead>
            <tr>
        <th width="1%">No</th>
		<th>User</th>
		<th>Info</th>
		<th>Tanggal</th>
		<th>User Agent</th>
		<th>Action</th>
            </tr></thead><tbody><?php $no = 1;
            foreach ($history_login_data as $history_login)
            {
                ?>
                <tr>
			<td><?= $no++?></td>
			<td><?php echo $history_login->username ?></td>
			<td><?php echo $history_login->info ?></td>
			<td><?php echo $history_login->tanggal ?></td>
			<td><?php echo $history_login->user_agent ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('history_login/read/'.$history_login->history_login_id),'<i class="fas fa-eye" aria-hidden="true"></i>','class="btn btn-success btn-sm read_data"'); 
				// echo '  '; 
				// echo anchor(site_url('history_login/update/'.$history_login->history_login_id),'<i class="fas fa-pencil-alt" aria-hidden="true"></i>','class="btn btn-primary btn-sm"'); 
				// echo '  '; 
				// echo anchor(site_url('history_login/delete/'.$history_login->history_login_id),'<i class="fas fa-trash-alt" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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


                        <?php
        if (is_allowed_button($this->uri->segment(1),'read')<1) { ?>
            <script type="text/javascript">
                    $('.read_data').css('display','none')
            </script>
        <?php } ?>

        <?php
        if (is_allowed_button($this->uri->segment(1),'create')<1) { ?>
            <script type="text/javascript">
                    $('.tambah_data').css('display','none')
            </script>
        <?php } ?>

        <?php
        if (is_allowed_button($this->uri->segment(1),'export')<1) { ?>
            <script type="text/javascript">
                    $('.export_data').css('display','none')
            </script>
        <?php } ?>

        <?php
        if (is_allowed_button($this->uri->segment(1),'update')<1) { ?>
            <script type="text/javascript">
                    $('.update_data').css('display','none')
            </script>
        <?php } ?>

        <?php
        if (is_allowed_button($this->uri->segment(1),'delete')<1) { ?>
            <script type="text/javascript">
                    $('.delete_data').css('display','none')
            </script>
        <?php } ?>