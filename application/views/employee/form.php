<section class="content">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="box">
                <?php if ($this->session->type === 'administrator') { ?>
                    <div class="box-header">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h3 class="box-title">
                                    <i class="fa fa-user"></i>
                                    <?php if ($entity == 'create') { ?>
                                        Tambah Data
                                    <?php } else { ?>
                                        Update Data <strong><?= $party->nama_lengkap ?></strong>
                                    <?php } ?>
                                </h3>
                                
                                <a href="<?= site_url('employee') ?>" class="btn btn-warning btn-lg">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="box-header">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h3 class="box-title">
                                    <i class="fa fa-user"></i>
                                    <strong>Profil</strong> Saya
                                </h3>

                                <?php if ($this->session->flashdata('state') == 'updated' || $this->session->flashdata('state') == 'stored') { ?>
                                    <div class="alert alert-success">
                                        <i class="fa fa-check-square-o"></i> Data telah tersimpan.
                                    </div>
                                <?php } else if ($this->session->flashdata('state') == 'destroyed') { ?>
                                    <div class="alert alert-danger">
                                    <i class="fa fa-check-square-o"></i> Data telah terhapus.
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="box-body">
                    <?php if ($entity == 'create') { ?>
                        <form method="POST" action="<?= site_url('employee/store') ?>">
                    <?php } else { ?>
                        <form method="POST" action="<?= site_url('employee/update/' . $party->id) ?>">
                    <?php } ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_lengkap" value="<?= $party->nama_lengkap ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="<?= $party->email ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>NIK <span class="text-danger">*</span></label>
                                    <input type="number" name="id_user" value="<?= $party->id_user ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nomor Handphone</label>
                                    <input type="text" name="no_hp" value="<?= $party->no_hp ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nomor Handphone Atasan</label>
                                    <input type="text" name="nohp_atasan" value="<?= $party->nohp_atasan ?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Email Atasan</label>
                                    <input type="email" name="email_atasan" value="<?= $party->email_atasan ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input type="text" name="jabatan" value="<?= $party->jabatan ?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Department</label>
                                    <input type="text" name="departemen" value="<?= $party->departemen ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Lokasi Kerja</label>
                                    <input type="text" name="lokasi_kerja" value="<?= $party->lokasi_kerja ?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Homebase</label>
                                    <input type="text" name="homebase" value="<?= $party->homebase ?>" class="form-control">
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