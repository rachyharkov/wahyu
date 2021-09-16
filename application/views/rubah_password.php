
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><?= $sett_apps->nama_aplikasi ?> - <?= $sett_apps->company ?> </title>
 <link rel="icon" type="image/png" href="<?php echo base_url('assets/') ?>/assets/img/favicon.png" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />

<link href="<?= base_url() ?>assets/assets/css/vendor.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/assets/css/transparent/app.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

</head>
<body class='pace-top'>
<div class="app-cover"></div>
<div id="loader" class="app-loader">
<span class="spinner"></span>
</div>


<div id="app" class="app">

<div class="login login-v2 fw-bold">

<div class="login-cover">
<div class="login-cover-img" style="background-image: url(../assets/assets/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
<div class="login-cover-bg"></div>
</div>


<div class="login-container">

<div class="login-header">
<div class="brand">
<div class="d-flex align-items-center">
<span class="logo"></span><?= $sett_apps->nama_aplikasi ?>
</div>
<small>Halaman Rubah Password</small>
</div>

<div class="icon">
<i class="fa fa-lock"></i>
</div>
</div>

<div class="login-content">
 <?php $this->view('messages') ?>

<form action="<?=site_url('auth/rubah_password')?>" method="post">
<div class="form-floating mb-20px">
<input id="password" class="form-control fs-13px h-45px border-0" name="password" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 6 Karakter' : ''); if(this.checkValidity()) form.passcon.pattern = this.value;" placeholder="Password Baru" required><label for="email" class="d-flex align-items-center text-gray-300 fs-13px">New Password</label>
</div>
<div class="form-floating mb-20px">
<input class="form-control fs-13px h-45px border-0" id="passcon" name="passcon" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Masukkan Password Yang Sama' : '');" placeholder="Verify Password" required>
<label for="email" class="d-flex align-items-center text-gray-300 fs-13px">Confirm Password</label>
</div>




<div class="mb-20px">
<button type="submit" name="login" class="btn btn-success d-block w-100 h-45px btn-lg">Update Password</button>
<!-- 	<div class="text-gray-500">
          <a href="<?php echo base_url() ?>auth" class="text-white" > Back to Login</a>
        </div>
 -->




</div>
</form>
</div>

</div>

</div>

<div class="login-bg-list clearfix">
<div class="login-bg-list-item active"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="../assets/assets/img/login-bg/login-bg-17.jpg" style="background-image: url(../assets/assets/img/login-bg/login-bg-17.jpg)"></a></div>

<div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="../assets/assets/img/login-bg/login-bg-16.jpg" style="background-image: url(../assets/assets/img/login-bg/login-bg-16.jpg)"></a></div>

<div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="../assets/assets/img/login-bg/login-bg-15.jpg" style="background-image: url(../assets/assets/img/login-bg/login-bg-15.jpg)"></a></div>

<div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="../assets/assets/img/login-bg/login-bg-14.jpg" style="background-image: url(../assets/assets/img/login-bg/login-bg-14.jpg)"></a></div>

<div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="../assets/assets/img/login-bg/login-bg-13.jpg" style="background-image: url(../assets/assets/img/login-bg/login-bg-13.jpg)"></a></div>

<div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="../assets/assets/img/login-bg/login-bg-12.jpg" style="background-image: url(../assets/assets/img/login-bg/login-bg-12.jpg)"></a></div>
</div>



<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

</div>


<script src="<?= base_url() ?>assets/assets/js/vendor.min.js" type="7c97e32a188e9ecd1f1c596f-text/javascript"></script>
<script src="<?= base_url() ?>assets/assets/js/app.min.js" type="7c97e32a188e9ecd1f1c596f-text/javascript"></script>
<script src="<?= base_url() ?>assets/assets/js/theme/transparent.min.js" type="7c97e32a188e9ecd1f1c596f-text/javascript"></script>

<script src="<?= base_url() ?>assets/assets/js/demo/login-v2.demo.js" type="7c97e32a188e9ecd1f1c596f-text/javascript"></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="7c97e32a188e9ecd1f1c596f-|49" defer=""></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/assets/js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/assets/js/sweetalert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> <!-- untuk sweet alret -->
<script src="<?php echo base_url();?>assets/assets/js/dataflash.js"></script>
</body>
</html>

