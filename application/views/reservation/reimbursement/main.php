<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header rsvp">
                    <h3 class="box-title">
                        <i class="fa fa-ticket"></i>
                        Reimbursement
                    </h3>
                    
                    <a href="<?= site_url('route/form/create') ?>" class="btn btn-danger btn-lg">
                        <i class="fa fa-plus"></i> Tambah Data Baru
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="box">
                        <div class="box-header rsvp-block">
                            <h4>
                                <i class="fa fa-share text-danger"></i>
                                Reimbursement untuk <strong>Keberangkatan</strong>
                            </h4>
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
                                        <th>Kode</th>
                                        <th>Kota</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($series as $key => $data): ?>
                                        <tr>
                                            <td><?= $key+1; ?></td>
                                            <td><strong><?= $data->id; ?></strong></td>
                                            <td><strong><?= $data->city; ?></strong></td>
                                            <td>
                                                <a href="<?= site_url('route/form/' . $data->id) ?>" class="btn btn-warning btn-md" data-toggle="tooltip" title="Update">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                <a href="<?= site_url('route/destroy/' . $data->id) ?>" class="btn btn-primary btn-md" data-toggle="tooltip" title="Hapus">
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

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="box">
                        <div class="box-header rsvp-block">
                            <h4>
                                <i class="fa fa-share fa-flip-horizontal text-danger"></i>
                                Reimbursement untuk <strong>Kepulangan</strong>
                            </h4>
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
                                        <th>Kode</th>
                                        <th>Kota</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($series as $key => $data): ?>
                                        <tr>
                                            <td><?= $key+1; ?></td>
                                            <td><strong><?= $data->id; ?></strong></td>
                                            <td><strong><?= $data->city; ?></strong></td>
                                            <td>
                                                <a href="<?= site_url('route/form/' . $data->id) ?>" class="btn btn-warning btn-md" data-toggle="tooltip" title="Update">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                <a href="<?= site_url('route/destroy/' . $data->id) ?>" class="btn btn-primary btn-md" data-toggle="tooltip" title="Hapus">
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
        </div>
    </div>
</section>