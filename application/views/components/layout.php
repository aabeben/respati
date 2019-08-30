<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Respati 2.0</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/adminlte/css/AdminLTE.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/adminlte/css/skins/skin-red-light.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,600,700,300italic">
</head>
<body class="hold-transition skin-red-light sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('components/header') ?>
        <?php $this->load->view('components/sidebar') ?>

        <div class="content-wrapper">
            <?php $this->load->view($content) ?>
        </div>

        <?php $this->load->view('components/footer') ?>
    </div>

    <script src="<?= base_url() ?>assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/select2/dist/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url() ?>assets/vendor/adminlte/js/adminlte.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/adminlte/js/init.js"></script>
</body>
</html>
