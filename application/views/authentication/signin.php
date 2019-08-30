<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Respati 2.0 - Signin</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/adminlte/css/AdminLTE.css">
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-box-body">
			<p class="login-box-msg">Masuk ke <strong>Respati 2.0</strong></p>

			<?php if (!empty($this->session->flashdata('status'))) { ?>
				<div class="alert alert-warning">
					Username atau password tidak sesuai.
				</div>
			<?php } ?>

			<form action="<?= site_url('authentication/session') ?>" method="POST">
				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control" placeholder="NIK">
				</div>
				
				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control" placeholder="Password">
				</div>

				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="<?= base_url() ?>assets/vendor/jquery/dist/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
