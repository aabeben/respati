<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Respati 2.0</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/adminlte/css/AdminLTE.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/adminlte/css/skins/skin-red-light.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,600,700,300italic">
    <link rel="stylesheet" href="https://daneden.github.io/animate.css/animate.min.css">
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
    <script src="<?= base_url() ?>assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/select2/dist/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/fastclick/lib/fastclick.js"></script>
    <script src="https://unpkg.com/autonumeric@4.5.4/dist/autoNumeric.min.js"></script>
    <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
    <script src="<?= base_url() ?>assets/vendor/adminlte/js/adminlte.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/adminlte/js/init.js"></script>

    <script>
        function setTwoNumberDecimal(event) {
            this.value = parseFloat(this.value).toFixed(2);
        }
        
        $(document).ready(function() {
            $.ajax({
                url: "<?= site_url('reservation/serviceRsvpNotification') ?>",
                type: 'GET',
                success: function(response) {
                    let dataRes = JSON.parse(response)[0]

                    if (dataRes.total > 0) {
                        $('#updateNotiTrigger').addClass('animated infinite jello')
                        $('#total_noti').html(dataRes.total)
                    } else {
                        $('#updateNotiTrigger').removeClass('animated infinite jello')
                    }

                    $('#noti_homebase_approve').html(dataRes.noti_homebase_approve)
                    $('#noti_homebase_reject').html(dataRes.noti_homebase_reject)
                    $('#noti_reimbursement_approve').html(dataRes.noti_reimbursement_approve)
                    $('#noti_reimbursement_reject').html(dataRes.noti_reimbursement_reject)

                    if (dataRes.noti_homebase_approve === 0)
                        $('#noti_homebase_approve_wrap').hide()
                    else
                        $('#noti_homebase_approve_wrap').show()


                    if (dataRes.noti_homebase_reject === 0)
                        $('#noti_homebase_reject_wrap').hide()
                    else
                        $('#noti_homebase_reject_wrap').show()

                    if (dataRes.noti_reimbursement_approve === 0)
                        $('#noti_reimbursement_approve_wrap').hide()
                    else
                        $('#noti_reimbursement_approve_wrap').show()


                    if (dataRes.noti_reimbursement_reject === 0)
                        $('#noti_reimbursement_reject_wrap').hide()
                    else
                        $('#noti_reimbursement_reject_wrap').show()
                }
            });
        })

        function updateNoti() {
            $.ajax({
                url: "<?= site_url('reservation/updateNoti') ?>",
                type: 'GET',
                success: function(response) {
                    return true
                }
            });
        }
    </script>
</body>
</html>
