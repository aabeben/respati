<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="fa fa-plane"></i>
                        Data <strong>Maskapai</strong>
                    </h3>
                    
                    <a href="<?= site_url('flight/form/create') ?>" class="btn btn-danger btn-lg">
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
                                <th>Kode</th>
                                <th>Maskapai</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($series as $key => $data): ?>
                                <tr>
                                    <td><?= $key+1; ?></td>
                                    <td><strong><?= $data->kode_flight; ?></strong></td>
                                    <td><strong><?= $data->flight; ?></strong> <small>Kode KLP: <strong><?= strtoupper($data->kodeklp) ?></strong></small></td>
                                    <td>
                                        <a href="<?= site_url('flight/form/' . $data->id) ?>" class="btn btn-warning btn-md" data-toggle="tooltip" title="Update">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <a href="<?= site_url('flight/destroy/' . $data->id) ?>" class="btn btn-primary btn-md" data-toggle="tooltip" title="Hapus">
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