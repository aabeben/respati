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
                                    Update Data <strong><?= $family->nama ?></strong>
                                <?php } ?>
                            </h3>
                            
                            <a href="<?= site_url('family') ?>" class="btn btn-warning btn-lg">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <?php if ($entity == 'create') { ?>
                        <form method="POST" action="<?= site_url('family/store') ?>">
                    <?php } else { ?>
                        <form method="POST" action="<?= site_url('family/update/' . $family->id) ?>">
                    <?php } ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" value="<?= $family->nama ?>" class="form-control" required>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Anggota Keluarga Dari <span class="text-danger">*</span></label>
                                    <select name="nik" class="form-control form-search">
                                        <option selected disabled>-- Pilih Karyawan --</option>
                                        <?php foreach ($employee as $key => $data): ?>
                                            <option value="<?= $data->nik ?>" <?php if ($data->nik == $family->nik) { print 'selected'; } ?>><?= $data->nama_lengkap ?> – <?= $data->nik ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Hubungan <span class="text-danger">*</span></label>
                                    <select name="relationship" class="form-control" required>
                                        <option selected disabled>-- Pilih Hubungan --</option>
                                        <option value="SPOUSE">Pasangan</option>
                                        <option value="CHILD">Anak</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" value="<?= $family->tgl_lahir ?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="gender" class="form-control">
                                        <option selected disabled>-- Pilih Jenis Kelamin --</option>
                                        <option value="Male" <?php if ($family->gender == 'Male') { print 'selected'; } ?>>Laki-Laki</option>
                                        <option value="Female" <?php if ($family->gender == 'Female') { print 'selected'; } ?>>Perempuan</option>
                                    </select>
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