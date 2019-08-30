<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="fa fa-user"></i>
                        Data <strong>Karyawan</strong>
                    </h3>
                    
                    <a href="<?= site_url('employee/form/create') ?>" class="btn btn-danger btn-lg">
                        <i class="fa fa-plus"></i> Tambah Data Baru
                    </a>
                </div>

                <div class="box-body">
                    <?php if ($this->session->flashdata('status') == 'updated' || $this->session->flashdata('status') == 'stored') { ?>
                        <div class="alert alert-success">
                            <i class="fa fa-check-square-o"></i> Data telah tersimpan.
                        </div>
                    <?php } else if ($this->session->flashdata('status') == 'destroyed') { ?>
                        <div class="alert alert-danger">
                        <i class="fa fa-check-square-o"></i> Data telah terhapus.
                        </div>
                    <?php } ?>

                    <table class="table table-bordered table-striped table-data">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Informasi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($party as $key => $parties): ?>
                                <tr>
                                    <td><?= $key+1; ?></td>
                                    <td><?= $parties->nama_lengkap; ?></td>
                                    <td><strong>NIK: <?= $parties->nik; ?></strong> <small>Email: <span class="lowercase"><?= $parties->email ?></span></small></td>
                                    <td>
                                        <a href="<?= site_url('employee/form/' . $parties->id) ?>" class="btn btn-warning btn-md" data-toggle="tooltip" title="Update">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <a href="<?= site_url('employee/destroy/' . $parties->id) ?>" class="btn btn-primary btn-md" data-toggle="tooltip" title="Hapus">
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