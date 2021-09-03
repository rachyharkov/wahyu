
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
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
    <?php if ($this->session->flashdata('message') ) : ?>

    <?php endif; ?>
<div class="app-cover"></div>
<div id="loader" class="app-loader">
<span class="spinner"></span>
</div>


<div id="app" class="app">

<div class="login login-v2 fw-bold">

<div class="login-cover">
<div class="login-cover-img" style="background-image: url(assets/assets/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
<div class="login-cover-bg"></div>
</div>


<div class="login-container">

<div class="login-header">
<div class="brand">
<div class="d-flex align-items-center">
<span class="logo"></span><?= $sett_apps->nama_aplikasi ?>
</div>
<small>Sign in to start your session</small>
</div>

<div class="icon">
<i class="fa fa-lock"></i>
</div>
</div>

<div class="login-content">
  <?php $this->view('messages') ?>

<form action="<?=site_url('auth/process')?>" method="post">
<div class="form-floating mb-20px">
<input type="text" required="" class="form-control fs-13px h-45px border-0" placeholder="Username" id="username" autocomplete="off" name="username" />
<label for="username" class="d-flex align-items-center text-gray-300 fs-13px">Username</label>
</div>
<div class="form-floating mb-20px">
<input type="password" required="" name="password" autocomplete="off" id="password" class="form-control fs-13px h-45px border-0" placeholder="Password" />
<label for="password" class="d-flex align-items-center text-gray-300 fs-13px">Password</label>
</div>
<div class="form-check mb-20px">
<input class="form-check-input border-0" type="checkbox" value="1" id="rememberMe" onclick="myFunction()" />
<label class="form-check-label fs-13px text-gray-500" for="rememberMe">
Show Password
</label>
</div>
<div class="mb-20px">
<button type="submit" name="login" class="btn btn-success d-block w-100 h-45px btn-lg">Sign me in</button>
<div class="text-gray-500">
Forgot password? Click <a href="<?php echo base_url() ?>auth/lupa_password" class="text-white">here</a> to reset password.
</div>





</div>
</form>
</div>

</div>

</div>

<div class="login-bg-list clearfix">
<div class="login-bg-list-item active"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="assets/assets/img/login-bg/login-bg-17.jpg" style="background-image: url(assets/assets/img/login-bg/login-bg-17.jpg)"></a></div>

<div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="assets/assets/img/login-bg/login-bg-16.jpg" style="background-image: url(assets/assets/img/login-bg/login-bg-16.jpg)"></a></div>

<div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="assets/assets/img/login-bg/login-bg-15.jpg" style="background-image: url(assets/assets/img/login-bg/login-bg-15.jpg)"></a></div>

<div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="assets/assets/img/login-bg/login-bg-14.jpg" style="background-image: url(assets/assets/img/login-bg/login-bg-14.jpg)"></a></div>

<div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="assets/assets/img/login-bg/login-bg-13.jpg" style="background-image: url(assets/assets/img/login-bg/login-bg-13.jpg)"></a></div>

<div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="assets/assets/img/login-bg/login-bg-12.jpg" style="background-image: url(assets/assets/img/login-bg/login-bg-12.jpg)"></a></div>
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


<script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>