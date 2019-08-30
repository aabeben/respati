<section class="content">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="box-title">
                                <i class="fa fa-user"></i>
                                <?php if ($entity == 'create') { ?>
                                    Tambah Data
                                <?php } else { ?>
                                    Update Data <strong><?= $flight->flight ?></strong>
                                <?php } ?>
                            </h3>
                            
                            <a href="<?= site_url('flight') ?>" class="btn btn-warning btn-lg">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <?php if ($entity == 'create') { ?>
                        <form method="POST" action="<?= site_url('flight/store') ?>">
                    <?php } else { ?>
                        <form method="POST" action="<?= site_url('flight/update/' . $flight->id) ?>">
                    <?php } ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nama Maskapai <span class="text-danger">*</span></label>
                                    <input type="text" name="flight" value="<?= $flight->flight ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Kode Maskapai <span class="text-danger">*</span></label>
                                    <input type="text" name="kode_flight" value="<?= $flight->kode_flight ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Kode KLP</label>
                                    <input type="text" name="kodeklp" value="<?= $flight->kodeklp ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fa fa-save"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>