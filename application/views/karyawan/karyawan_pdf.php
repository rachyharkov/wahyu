<!DOCTYPE html>
 <html><head>
    <title>Laporan Data Karyawan</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 0px 0px;
            }

            #footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 80px; 

                text-align: center;
                line-height: 16px;
            }
        </style>
</head><body >
    <table border="0" cellpadding="0" align="center">
                    <tr>
                        <td style="width: 20%;">
                            <img  width="150" height="100" src="assets/assets/img/logo/logo.png"  >
                        </td>
                        <td style="width: 80%;text-align: center;">
                            <h2><?= $sett_apps->company ?></h2>
                            <p style="padding: 5px"><?= $sett_apps->alamat ?></p>
                        </td>
                    </tr>
    </table>
    <table >
        
    </table>

    <table class="word-table" style="line-height: 22px; padding: 3px">
        <tr><td style="padding: 2px">Photo Karyawan</td><td style="padding: 2px"><img  width="150" height="100" src="assets/assets/img/karyawan/<?= $photo ?>"  ></td></tr>
        <tr><td style="padding: 2px">Nama Karyawan</td><td style="padding: 2px"><?php echo $nama_karyawan; ?></td></tr>
        <tr><td style="padding: 2px">NIK</td><td style="padding: 2px"><?php echo $nik; ?></td></tr>
        <tr><td style="padding: 2px">Email</td><td style="padding: 2px"><?php echo $email; ?></td></tr>
        <tr><td style="padding: 2px">No Hp</td><td style="padding: 2px"><?php echo $no_hp; ?></td></tr>
        <tr><td style="padding: 2px">Pendidikan</td><td style="padding: 2px"><?php echo $pendidikan; ?></td></tr>
        <tr><td style="padding: 2px">Lokasi Kerja</td><td style="padding: 2px"><?php echo $nama_lokasi; ?></td></tr>
        <tr><td style="padding: 2px">Divisi</td><td style="padding: 2px"><?php echo $nama_divisi; ?></td></tr>
        <tr><td style="padding: 2px">Jabatan</td><td style="padding: 2px"><?php echo $nama_jabatan; ?></td></tr>
        <tr><td style="padding: 2px">Status Karyawan</td><td style="padding: 2px"><?php echo $nama_status_karyawan; ?></td></tr>
        <tr><td style="padding: 2px">Alamat</td><td style="padding: 2px"><?php echo $alamat; ?></td></tr>
        <tr><td style="padding: 2px">Jenis Kelamin</td><td style="padding: 2px"><?php echo $jenis_kelamin; ?></td></tr>
        <tr><td style="padding: 2px">Status Kawin</td><td style="padding: 2px"><?php echo $status_kawin; ?></td></tr>
        <tr><td style="padding: 2px">Tgl Masuk</td><td style="padding: 2px"><?php echo $tgl_masuk; ?></td></tr>
        <tr><td style="padding: 2px">Status Keaktifan</td><td style="padding: 2px"><?php echo $status_keaktifan; ?></td></tr>
<!--         <tr><td>Photo</td><td>
            <a href="#modal-dialog" data-bs-toggle="modal"><img style="width: 150px;height: 150px;border-radius: 50%;" src="<?php echo base_url().'/assets/assets/img/karyawan/'.$photo ?>" /></a></td></tr> -->
        <tr>
            <td>Berkas Karyawan</td>
            <td>
                <table class="word-table" style="line-height: 20px;" >               
                    
                        <tr>
                          <th style="padding: 2px">Nama Berkas</th>
                          <th style="padding: 2px">Download</th>
                        </tr>
                        <?php foreach ($berkas->result() as $key => $data) { ?>
                        <tr>
                            <td style="padding: 2px"> <?php echo $data->nama_berkas ?></td>
                            <td style="padding: 2px"><a href="<?php echo base_url(); ?>karyawan/download_berkas/<?php echo $data->photo ?>"><i class="ace-icon fa fa-download"></i> Download</a></td>
                        </tr>
                    <?php } ?>
                </table>        
                
            
            </td>
        </tr>
    </table>

    <table class="" style="margin-top: 30px; width: 200px;text-align: center; margin-left: 375px">
        <tr> 
          <td width="200px">Jakarta, <?= date('d F Y') ?></td> 
        </tr>
        <tr>
          <td style="height: 80px;"></td>
        </tr>
        <tr>
          <td>Manager HRGA</td>
        </tr>
                
</table>



<table id="footer" width="100%">
  <tr>
    <td width="100%"><b><?= $sett_apps->company ?> </b> || <?= $sett_apps->alamat ?></td>
  </tr>
</table>