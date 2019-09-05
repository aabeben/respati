<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="fa fa-users"></i>
                        Data <strong>Keluarga</strong>
                    </h3>
                    
                    <a href="<?= site_url('family/form/create') ?>" class="btn btn-danger btn-lg">
                        <i class="fa fa-plus"></i> Tambah Data Baru
                    </a>
                </div>

                <div class="box-body">
                    <?php if ($this->session->flashdata('state') == 'updated' || $this->session->flashdata('state') == 'stored') { ?>
                        <div class="alert alert-success">
                            <i class="fa fa-check-square-o"></i> Data telah tersimpan.
                        </div>
                    <?php } else if ($this->session->flashdata('state') == 'destroyed') { ?>
                        <div class="alert alert-danger">
                        <i class="fa fa-check-square-o"></i> Data telah terhapus.
                        </div>
                    <?php } ?>

                    <table class="table table-bordered table-striped table-data">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Anggota Keluarga Dari</th>
                                <th>Jatah Reservasi</th>
                                <?php if ($this->session->type != 'administrator') { ?>
                                <th>Sisa Pemakaian Reservasi</th>
                                <?php } ?>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($family as $key => $data): ?>
                                <tr>
                                    <td><?= $key+1; ?></td>
                                    <td><strong><?= $data->nama; ?></strong></td>
                                    <td><strong><?= $data->employee->nama_lengkap; ?></strong> <small>NIK: <?= $data->employee->id_user; ?></small></td>
                                    
                                    <td><strong><?= $data->rsvp_limit; ?></strong></td>
                                    <?php if ($this->session->type != 'administrator') { ?>
                                    <td family-unique="<?= $data->id ?>" family-rsvp-limit="<?= $data->rsvp_limit ?>" family-name="<?= $data->nama ?>" family-nik="<?= $data->nik ?>"><small><i class="fa fa-spin fa-spinner"></i> Memuat..</small></td>
                                    <?php } ?>
                                    <td>
                                        <a href="<?= site_url('family/form/' . $data->id) ?>" class="btn btn-warning btn-md" data-toggle="tooltip" title="Update">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <a href="<?= site_url('family/destroy/' . $data->id) ?>" class="btn btn-primary btn-md" data-toggle="tooltip" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?= base_url() ?>assets/vendor/jquery/dist/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        setTimeout(function() {
            let column = $('[family-unique]')

            for (i=0; i<column.length; i++) {
                let columnFamilyName = column[i].getAttribute('family-name'),
                    columnFamilyUnique = column[i].getAttribute('family-unique'),
                    columnFamilyRSVPLimit = column[i].getAttribute('family-rsvp-limit'),
                    columnFamilyNIK  = column[i].getAttribute('family-nik')

                requestLimitation(columnFamilyName, columnFamilyNIK, columnFamilyUnique, columnFamilyRSVPLimit)
            }
        }, 1000)
    })

    function requestLimitation(nama, nik, unique, limit) {
        $.ajax({
            url: "<?= site_url('family/serviceRsvpLimit') ?>?nama="+ nama +"&nik=" + nik,
            type: 'GET',
            success: function(response) {
                let used = parseInt(JSON.parse(response)[0].total),
                    total = parseInt(limit) - used

                $('[family-unique='+ unique +']').html(
                    '<a href="<?= site_url('reservation/reimbursement_reporting') ?>" style="color: black; text-decoration: underline; font-weight: bold;">' + total + '</a>'
                )
            }
        });
    }
</script>