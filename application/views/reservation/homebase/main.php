<?php date_default_timezone_set("Asia/Jakarta"); ?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header rsvp">
                    <h3 class="box-title">
                        <i class="fa fa-ticket"></i>
                        Homebase
                    </h3>
                    
                    <?php 
                        $last_segment = $this->uri->total_segments();
                        $record_num = $this->uri->segment($last_segment);
                        if ($record_num != 'homebase_history') { 
                    ?>
                    <?php if ($this->session->type === 'employee') { ?>
                    <a href="#!" data-toggle="modal" data-target="#modal-reimbursement" class="btn btn-danger btn-lg">
                        <i class="fa fa-plus"></i> Tambah Data Baru
                    </a>
                    <?php } ?>
                    <?php } ?>
                </div>

                    <?php if ($this->session->flashdata('state') == 'updated' || $this->session->flashdata('state') == 'stored') { ?>
                        <div style="margin-top:20px;">
                            <div class="alert alert-success">
                                <i class="fa fa-check-square-o"></i> Data telah tersimpan.
                            </div>
                        </div>
                    <?php } else if ($this->session->flashdata('state') == 'destroyed') { ?>
                        <div style="margin-top:20px;">
                            <div class="alert alert-danger">
                                <i class="fa fa-check-square-o"></i> Data telah terhapus.
                            </div>
                        </div>
                    <?php } ?>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box">
                        <div class="box-header rsvp-block">
                            <h4>
                                <i class="fa fa-share text-danger"></i>
                                Data <strong>Keberangkatan</strong>
                            </h4>
                        </div>

                        <?php if ($this->session->type === 'employee') { ?>
                        <div class="box-body">
                            <table class="table table-bordered table-striped table-data">
                                <thead>
                                    <tr>
                                        <th>No. Reservasi</th>
                                        <th>Nama</th>
                                        <th>Maskapai</th>
                                        <th>Rute</th>
                                        <th>Tanggal</th>
                                        <th>Kode Flight</th>
                                        <th>Harga Tiket</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($depart as $key => $data): ?>
                                        <tr>
                                            <td><?= $data->id; ?></td>
                                            <td><strong><?= $data->nama; ?></strong> <small>NIK: <strong><?= $data->nik ?></strong></small></td>
                                            <td><strong><?= $data->flightDepart->flight; ?></strong></td>
                                            <td><strong><?= $data->routeFrom->city; ?> (<?= $data->routeFrom->id; ?>) - <?= $data->routeTo->city; ?> (<?= $data->routeTo->id; ?>)</strong></td>
                                            <td><strong><?= $data->tgl_berangkat; ?>, <?= $data->waktu_berangkat; ?></strong></td>
                                            <td><strong><?= $data->kode_flight; ?></strong></td>
                                            <td><strong>Rp<?= number_format($data->harga); ?></strong></td>
                                            <td>
                                                <?php if ($data->st_approv == 'false') { ?>
                                                    <span class="label label-primary">Menunggu Approval</span>
                                                <?php } else if ($data->st_approv == 'reject') { ?>
                                                    <span class="label label-danger">Telah Direject</span>
                                                <?php } else { ?>
                                                    <span class="label label-success">Sudah di Approve</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                            <?php if ($data->st_approv == 'false') { ?>
                                                <a href="<?= site_url('reservation/destroy/' . $data->id) ?>" class="btn btn-warning btn-md" data-toggle="tooltip" title="Batalkan Permintaan Reimbursement">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php } else { ?>
                        <div class="box-body">
                            <table class="table table-bordered table-striped table-data">
                                <thead>
                                    <tr>
                                        <th>Reservasi</th>
                                        <th>Nama</th>
                                        <th>Maskapai</th>
                                        <th>Rute</th>
                                        <th>Tanggal</th>
                                        <th>Kode Flight</th>
                                        <th>Harga Tiket</th>
                                        <th>Tgl Pengajuan</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($depart as $key => $data): ?>
                                        <tr>
                                            <td><?= $data->id; ?></td>
                                            <td><strong><?= $data->nama; ?></strong> <small>NIK: <strong><?= $data->nik ?></strong></small></td>
                                            <td><strong><?= $data->flightDepart->flight; ?></strong></td>
                                            <td><strong><?= $data->routeFrom->city; ?> (<?= $data->routeFrom->id; ?>) - <?= $data->routeTo->city; ?> (<?= $data->routeTo->id; ?>)</strong></td>
                                            <td><strong><?= $data->tgl_berangkat; ?>, <?= $data->waktu_berangkat; ?></strong></td>
                                            <td><strong><?= $data->kode_flight; ?></strong></td>
                                            <td><strong>Rp<?= number_format($data->harga); ?></strong></td>
                                            <td><?= $data->created_at ?></td>
                                            <td>
                                                <?php if ($data->st_approv == 'false') { ?>
                                                    <span class="label label-primary">Menunggu Approval</span>
                                                <?php } else if ($data->st_approv == 'reject') { ?>
                                                    <span class="label label-danger">Telah Direject</span>
                                                <?php } else { ?>
                                                    <span class="label label-success">Sudah di Approve</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($data->st_approv == 'false') { ?>
                                                <a href="<?= site_url('reservation/approval/' . $data->id) ?>?action=true&back=homebase" class="btn btn-success text-white btn-md" style="color: white;" data-toggle="tooltip" title="Reject">
                                                    <i class="fa fa-check"></i> Approve
                                                </a>
                                                <a href="<?= site_url('reservation/approval/' . $data->id) ?>?action=reject&back=homebase" class="btn btn-danger btn-md" data-toggle="tooltip" title="Reject">
                                                    <i class="fa fa-times"></i> Reject
                                                </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box">
                        <div class="box-header rsvp-block">
                            <h4>
                                <i class="fa fa-share fa-flip-horizontal text-danger"></i>
                                Data <strong>Kepulangan</strong>
                            </h4>
                        </div>

                        <?php if ($this->session->type === 'employee') { ?>
                        <div class="box-body">
                            <table class="table table-bordered table-striped table-data">
                                <thead>
                                    <tr>
                                        <th>No. Reservasi</th>
                                        <th>Nama</th>
                                        <th>Maskapai</th>
                                        <th>Rute</th>
                                        <th>Tanggal Pulang</th>
                                        <th>Kode Flight</th>
                                        <th>Harga Tiket</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($return as $key => $data): ?>
                                        <tr>
                                            <td><?= $data->id; ?></td>
                                            <td><strong><?= $data->nama; ?></strong> <small>NIK: <strong><?= $data->nik ?></strong></small></td>
                                            <td><strong><?= $data->flightReturn->flight; ?></strong></td>
                                            <td><strong><?= $data->routeTo->city; ?> (<?= $data->routeTo->id; ?>) - <?= $data->routeFrom->city; ?> (<?= $data->routeFrom->id; ?>)</strong></td>
                                            <td><strong><?= $data->tgl_pulang; ?>, <?= $data->waktu_berangkat; ?></strong></td>
                                            <td><strong><?= $data->kode_flight; ?></strong></td>
                                            <td><strong>Rp<?= number_format($data->harga_pulang); ?></strong></td>
                                            <td>
                                                <?php if ($data->st_approv == 'false') { ?>
                                                    <span class="label label-primary">Menunggu Approval</span>
                                                <?php } else if ($data->st_approv == 'reject') { ?>
                                                    <span class="label label-danger">Telah Direject</span>
                                                <?php } else { ?>
                                                    <span class="label label-success">Sudah di Approve</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                            <?php if ($data->st_approv == 'false') { ?>
                                                <a href="<?= site_url('reservation/destroy/' . $data->id) ?>" class="btn btn-warning btn-md" data-toggle="tooltip" title="Batalkan Permintaan Reimbursement">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php } else { ?>
                            <div class="box-body">
                                <table class="table table-bordered table-striped table-data">
                                    <thead>
                                        <tr>
                                            <th>No. Reservasi</th>
                                            <th>Nama</th>
                                            <th>Maskapai</th>
                                            <th>Rute</th>
                                            <th>Tanggal Pulang</th>
                                            <th>Kode Flight</th>
                                            <th>Harga Tiket</th>
                                            <th>Tgl Pengajuan</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($return as $key => $data): ?>
                                            <tr>
                                                <td><?= $data->id; ?></td>
                                                <td><strong><?= $data->nama; ?></strong> <small>NIK: <strong><?= $data->nik ?></strong></small></td>
                                                <td><strong><?= $data->flightReturn->flight; ?></strong></td>
                                                <td><strong><?= $data->routeTo->city; ?> (<?= $data->routeTo->id; ?>) - <?= $data->routeFrom->city; ?> (<?= $data->routeFrom->id; ?>)</strong></td>
                                                <td><strong><?= $data->tgl_pulang; ?>, <?= $data->waktu_berangkat; ?></strong></td>
                                                <td><strong><?= $data->kode_flight; ?></strong></td>
                                                <td><strong>Rp<?= number_format($data->harga_pulang); ?></strong></td>
                                                
                                                <td><?= $data->created_at ?></td>
                                                <td>
                                                    <?php if ($data->st_approv == 'false') { ?>
                                                        <span class="label label-primary">Menunggu Approval</span>
                                                    <?php } else if ($data->st_approv == 'reject') { ?>
                                                        <span class="label label-danger">Telah Direject</span>
                                                    <?php } else { ?>
                                                        <span class="label label-success">Sudah di Approve</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($data->st_approv == 'false') { ?>
                                                    <a href="<?= site_url('reservation/approval/' . $data->id) ?>?action=true&back=homebase" class="btn btn-success text-white btn-md" style="color: white;" data-toggle="tooltip" title="Reject">
                                                        <i class="fa fa-check"></i> Approve
                                                    </a>
                                                    <a href="<?= site_url('reservation/approval/' . $data->id) ?>?action=reject&back=homebase" class="btn btn-danger btn-md" data-toggle="tooltip" title="Reject">
                                                        <i class="fa fa-times"></i> Reject
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div id="modal-reimbursement" class="modal fade" role="dialog">
                    <form method="POST" action="<?= site_url('reservation/store') ?>" enctype='multipart/form-data'>
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    <h4 class="modal-title">
                                        <i class="fa fa-ticket text-danger"></i> Tambah Data <strong>Homebase</strong>
                                    </h4>
                                </div>
                                
                                <div class="modal-body">
                                    <div class="form-group-hidden">
                                        <input type="hidden" id="entity" name="entity" class="form-control" value="HOMEBASE">
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <ul class="nav nav-tabs nav-digi">
                                                <li class="active" sequence="1"><a data-toggle="tab" href="#data-party" onclick="validation(1)">1. Data Diri</a></li>
                                                <li sequence="2"><a data-toggle="tab" href="#data-route" onclick="validation(2)">2. Keberangkatan & Tujuan</a></li>
                                                <li sequence="3"><a data-toggle="tab" href="#data-flight" onclick="validation(3)">3. Maskapai</a></li>
                                                <li sequence="4"><a data-toggle="tab" href="#data-date" onclick="validation(4)">4. Tanggal</a></li>
                                                <li sequence="5"><a data-toggle="tab" href="#data-information" onclick="validation(5)">5. Kode Flight & Harga Tiket</a></li>
                                            </ul>
                                        </div>

                                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                            <div class="tab-content">
                                                <div id="data-party" class="tab-pane fade in active" sequence="1">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3><strong>Data Diri</strong></h3>
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="form-group">
                                                                        <label style="display: block;">Tipe Perjalanan</label>

                                                                        <div class="radio">
                                                                            <label><input type="radio" name="typetrip" value="single" checked>Sekali Jalan</label>
                                                                        </div>

                                                                        <div class="radio">
                                                                            <label><input type="radio" name="typetrip" value="double">Pulang Pergi</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Nama</label>

                                                                        <select class="form-control form-search" name="party" id="party" required>
                                                                            <option selected disabled>-- Pilih --</option>
                                                                            <option value="<?= $this->session->identity ?>" statusku="SELF">Saya Sendiri (<?= $this->session->name ?>, <?= $this->session->identity ?>)</option>
                                                                            <option value="<?= $this->session->identity ?>" statusku="Add">Additional</option>
                                                                            <option disabled>---</option>
                                                                            <?php foreach ($family as $key => $data): ?>
                                                                                <option familyIdentity="<?= $data->nama ?>" value="<?= $data->nik ?>" familyRsvpFlag="<?= $data->rsvp_flag ?>" familyRsvpLimit="<?= $data->rsvp_limit ?>" statusku="<?= $data->relationship ?>"><?= $data->nama ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group" id="name-wrapper" style="display: none;">
                                                                        <label>Nama Additional</label>
                                                                        <input type="hidden" class="form-control" id="statusku" name="statusku">
                                                                        <input type="text" class="form-control" id="nama" name="nama">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="data-route" class="tab-pane fade" sequence="2">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3><strong>Data Keberangkatan & Tujuan</strong></h3>
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="form-group">
                                                                        <label>Dari</label>
                                                                        <select class="form-control form-search" name="route_from" id="route_from" required>
                                                                            <?php foreach ($route as $key => $data): ?>
                                                                                <option value="<?= $data->id ?>"><?= $data->id ?> – <?= $data->city ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Ke</label>
                                                                        <select class="form-control form-search" name="route_to" id="route_to" required>
                                                                            <?php foreach ($route as $key => $data): ?>
                                                                                <option value="<?= $data->id ?>"><?= $data->id ?> – <?= $data->city ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="data-flight" class="tab-pane fade" sequence="3">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3><strong>Data Maskapai</strong></h3>
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="form-group">
                                                                        <label>Berangkat</label>
                                                                        <select class="form-control form-search" name="maskapai_berangkat" id="maskapai_berangkat" required>
                                                                            <?php foreach ($flight as $key => $data): ?>
                                                                                <option value="<?= $data->id ?>"><?= $data->flight ?> – <?= $data->kode_flight ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group" id="return-wrapper" style="display: none;">
                                                                        <label>Pulang</label>
                                                                        <select class="form-control form-search" name="maskapai_pulang" id="maskapai_pulang" required>
                                                                            <?php foreach ($flight as $key => $data): ?>
                                                                                <option value="<?= $data->id ?>"><?= $data->flight ?> – <?= $data->kode_flight ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="data-date" class="tab-pane fade" sequence="4">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3><strong>Tanggal</strong></h3>
                                                                </div>

                                                                <div id="date_berangkat">
                                                                    <h5 style="padding: 10px 15px; padding-bottom: 0; margin-bottom: 0px;">Berangkat</h5>
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Keberangkatan</label>
                                                                            <input type="text" class="form-control form-date" value="<?= date('m/d/Y') ?>" id="tgl_berangkat" name="tgl_berangkat">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Waktu Keberangkatan</label>
                                                                            <input type="time" class="form-control" id="waktu_berangkat" value="<?= date('h:i') ?>" name="waktu_berangkat">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="date-return" style="display: none;">
                                                                    <h5 style="padding: 10px 15px; padding-bottom: 0; margin-bottom: 0px;">Pulang</h5>
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Pulang</label>
                                                                            <input type="text" class="form-control form-date" value="<?= date('m/d/Y') ?>" id="tgl_pulang" name="tgl_pulang">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Waktu Kepulangan</label>
                                                                            <input type="time" class="form-control" value="<?= date('h:i') ?>" id="waktu_pulang" name="waktu_pulang">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="data-information" class="tab-pane fade" sequence="5">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3><strong>Kode Flight & Harga</strong></h3>
                                                                </div>

                                                                <div id="information-depart">
                                                                    <h5 style="padding: 10px 15px; padding-bottom: 0; margin-bottom: 0px;">Berangkat</h5>
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                            <label>Kode Flight</label>
                                                                            <input type="text" class="form-control" id="kode_flight" name="kode_flight" required>
                                                                        </div>

                                                                        <label style="display: block;">Harga Tiket</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">Rp</span>
                                                                            <input id="harga" type="number" class="form-control" name="harga" required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="information-return" style="display: none;">
                                                                    <h5 style="padding: 10px 15px; padding-bottom: 0; margin-bottom: 0px;">Pulang</h5>
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                            <label>Kode Flight</label>
                                                                            <input type="text" class="form-control" id="kode_flight_pulang" name="kode_flight_pulang">
                                                                        </div>

                                                                        <label style="display: block;">Harga Tiket</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">Rp</span>
                                                                            <input id="harga_pulang" type="number" class="form-control" name="harga_pulang">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button id="btnPrev" type="button" class="btn btn-default" onclick="navigate('back')">Kembali</button>
                                    <button id="btnNext" type="button" class="btn btn-success" onclick="navigate('next')">Berikutnya</button>
                                    <button id="btnSubmit" type="submit" class="btn btn-success" style="display: none;">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
    </script>

</section>

<script src="<?= base_url() ?>assets/vendor/jquery/dist/jquery.min.js"></script>
<script>
    let flaggedFamily = <?= $flagged_family ?>

    $(document).ready(function() {
        $('#party').change(function() {
            let party    = $(this).val(),
                statusku = $(this).select2('data')[0].element.getAttribute('statusku')

            $('#statusku').val(statusku)

            if (statusku === 'Add') {
                $('#name-wrapper').show()
                $('#nama').val('')
            } else if (statusku === 'SELF') {
                $('#name-wrapper').hide()
                $('#nama').val('<?= $this->session->name ?>')
            } else {
                $('#nama').val($(this).select2('data')[0].text)
                $('#name-wrapper').hide()
            }
        }) 

        const child      = flaggedFamily.filter(flagged => flagged.statusku === 'CHILD').length,
              spouse     = flaggedFamily.filter(flagged => flagged.statusku === 'SPOUSE').length,
              additional = flaggedFamily.filter(flagged => flagged.statusku === 'Add').length,
              self       = flaggedFamily.filter(flagged => flagged.statusku === 'SELF').length

        if (child === 3)
            $('#party [statusku=CHILD]').attr('disabled', true)

        if (spouse === 1)
            $('#party [statusku=SPOUSE]').attr('disabled', true)

        if (additional === 1)
            $('#party [statusku=Add]').attr('disabled', true)

        if (self === 1)
            $('#party [statusku=SELF]').attr('disabled', true)

        for (let i = 0; i <flaggedFamily.length; i++) {
            $('#party [familyIdentity="'+ flaggedFamily[i].nama +'"]').attr('disabled', true)
        }

        $('input[name=typetrip]').click(function() {
            checkRadio()
        })

        checkRadio()
    })

    function validation(step) {
        switch(parseInt(step)) {
            case 1:
                if ($('#nama').val() === '' || $('#nama').val() === null) {
                    $('.nav-digi > li').removeClass('fade active')
                    $('.tab-pane').removeClass('fade active')

                    swal("Error", 'Nama tidak boleh kosong', 'error');

                    $('.nav-digi > li[sequence='+ step +']').addClass('fade in active')
                    $('.tab-pane[sequence='+step+']').addClass('fade in active')

                    return false
                } else {
                    let nama = $('#nama').val(),
                        trip = $('input[name=typetrip]:checked').val() === 'single' ? 'Sekali Jalan' : 'Pulang Pergi',
                        textToShow = 'Nama Pemesan: ' + nama + ', Tipe Perjalanan: ' + trip

                    swal({
                        title: "Apakah anda yakin?",
                        text: textToShow,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-warning",
                        confirmButtonText: "Tentu",
                        cancelButtonText: "Tidak",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            return true;
                        } else {
                            $('.nav-digi > li').removeClass('fade active')
                            $('.tab-pane').removeClass('fade active')

                            $('.nav-digi > li[sequence=1]').addClass('fade in active')
                            $('.tab-pane[sequence=1]').addClass('fade in active')
                        }
                    });
                }
            break

            case 2:
                let route_from = $('#route_from').val(),
                    route_to = $('#route_to').val(),

                    textToShow = 'Keberangkatan dari ' + route_from + ', Tujuan ke ' + route_to

                    swal({
                        title: "Apakah anda yakin?",
                        text: textToShow,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-warning",
                        confirmButtonText: "Tentu",
                        cancelButtonText: "Tidak",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            return true;
                        } else {
                            $('.nav-digi > li').removeClass('fade active')
                            $('.tab-pane').removeClass('fade active')

                            $('.nav-digi > li[sequence=2]').addClass('fade in active')
                            $('.tab-pane[sequence=2]').addClass('fade in active')
                        }
                    });
            break

            case 3:
                let maskapai_berangkat = $('#maskapai_berangkat option:selected').text(),
                    maskapai_pulang = $('#maskapai_pulang option:selected').text()

                    let textToShown = ''


                    let checkValue = $('input[name=typetrip]:checked').val();

                    if (checkValue === 'single') {
                        textToShown = 'Maskapai: ' + maskapai_berangkat
                    } else {
                        textToShown = 'Maskapai Berangkat: ' + maskapai_berangkat + ', Maskapai Pulang:' + maskapai_pulang
                    }

                    swal({
                        title: "Apakah anda yakin?",
                        text: textToShown,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-warning",
                        confirmButtonText: "Tentu",
                        cancelButtonText: "Tidak",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            return true;
                        } else {
                            $('.nav-digi > li').removeClass('fade active')
                            $('.tab-pane').removeClass('fade active')

                            $('.nav-digi > li[sequence=3]').addClass('fade in active')
                            $('.tab-pane[sequence=3]').addClass('fade in active')
                        }
                    });
            break

            case 4:
                let tgl_berangkat = $('#tgl_berangkat').val(),
                    waktu_berangkat = $('#waktu_berangkat').val(),
                    tgl_pulang = $('#tgl_pulang').val(),
                    waktu_pulang = $('#waktu_pulang').val()

                    let textToShown2 = ''


                    let checkValue2 = $('input[name=typetrip]:checked').val();

                    if (checkValue2 === 'single') {
                        textToShown2 = 'Tanggal & Waktu Berangkat: ' + tgl_berangkat + ', ' + waktu_berangkat
                    } else {
                        textToShown2 = 'Tanggal & Waktu Berangkat: ' + tgl_berangkat + ', ' + waktu_berangkat + ', Tanggal & Waktu Pulang: ' + tgl_pulang + ', ' + waktu_pulang
                    }

                    swal({
                        title: "Apakah anda yakin?",
                        text: textToShown2,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-warning",
                        confirmButtonText: "Tentu",
                        cancelButtonText: "Tidak",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            return true;
                        } else {
                            $('.nav-digi > li').removeClass('fade active')
                            $('.tab-pane').removeClass('fade active')

                            $('.nav-digi > li[sequence=3]').addClass('fade in active')
                            $('.tab-pane[sequence=3]').addClass('fade in active')
                        }
                    });
            break

            case 5:
                let kode_flight_berangkat = $('#kode_flight').val(),
                    harga_berangkat = $('#harga').val(),
                    kode_flight_pulang = $('#kode_flight_pulang').val(),
                    harga_pulang = $('#harga_pulang').val()

                    let textToShown3 = ''


                    let checkValue3 = $('input[name=typetrip]:checked').val();

                    if (checkValue3 === 'single') {
                        textToShown3 = 'Kode Flight & Harga: ' + kode_flight_berangkat + ', Rp' + harga_berangkat
                    } else {
                        textToShown3 = 'Kode Flight & Harga Berangkat: ' + kode_flight_berangkat + ', ' + harga_berangkat + ', Kode Flight & Harga Pulang: ' + kode_flight_pulang + ', Rp' + harga_pulang
                    }

                    swal({
                        title: "Apakah anda yakin?",
                        text: textToShown2,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-warning",
                        confirmButtonText: "Tentu",
                        cancelButtonText: "Tidak",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            return true;
                        } else {
                            $('.nav-digi > li').removeClass('fade active')
                            $('.tab-pane').removeClass('fade active')

                            $('.nav-digi > li[sequence=3]').addClass('fade in active')
                            $('.tab-pane[sequence=3]').addClass('fade in active')
                        }
                    });
            break

            case 2:
            case 3:
            case 4:
                if ($('#nama').val() === '' || $('#nama').val() === null) {
                    setTimeout(() => {
                        $('.nav-digi > li[sequence]').removeClass('fade in active')
                        $('.tab-pane').removeClass('fade in active')

                        swal("Error", 'Masih ada data yang belum terisi di step pertama.', 'error');

                        $('.nav-digi > li[sequence=1]').addClass('fade in active')
                        $('.tab-pane[sequence=1]').addClass('fade in active')
                    }, 200);
                }
            break


            case 5:
                if ($('#nama').val() === '' || $('#nama').val() === null) {
                    setTimeout(() => {
                        $('.nav-digi > li[sequence]').removeClass('fade in active')
                        $('.tab-pane').removeClass('fade in active')

                        swal("Error", 'Masih ada data yang belum terisi di step pertama.', 'error');

                        $('.nav-digi > li[sequence=1]').addClass('fade in active')
                        $('.tab-pane[sequence=1]').addClass('fade in active')
                    }, 200);
                } else {
                    let checkValue = $('input[name=typetrip]:checked').val();

                    if (checkValue === 'single') {
                        if ($('#kode_flight').val() === '' || $('#kode_flight').val() === null || $('#harga').val() === '' || $('#harga').val() === null) {
                            swal("Error", 'Field tidak boleh kosong.', "error");
                            return false
                        }
                    } else {
                        if ($('#kode_flight').val() === '' || $('#kode_flight').val() === null || $('#harga').val() === '' || $('#harga').val() === null || $('#kode_flight_pulang').val() === '' || $('#kode_flight_pulang').val() === null || $('#harga_pulang').val() === '' || $('#harga_pulang').val() === null) {
                            swal("Error", 'Field tidak boleh kosong.', "error");
                            return false
                        }
                    }
                }
            break
        }

        return true
    }

    function navigate(direction) {
        let list = $('.nav-digi > li.active')[0].getAttribute('sequence')

        if (direction === 'next') {
            const validate = validation(list)

            if (validate) {
                if (parseInt(list) === 6) {
                    return false
                } else {
                    $('.nav-digi > li').removeClass('fade in active')
                    $('.tab-pane').removeClass('fade in active')

                    list = parseInt(list) + 1

                    $('.nav-digi > li[sequence='+ list +']').addClass('fade in active')
                    $('.tab-pane[sequence='+list+']').addClass('fade in active')
                }
            }
        } else {
            if (parseInt(list) === 1) {
                return false
            } else {
                $('.nav-digi > li').removeClass('fade in active')
                $('.tab-pane').removeClass('fade in active')

                list = parseInt(list) - 1

                $('.nav-digi > li[sequence='+ list +']').addClass('fade in active')
                $('.tab-pane[sequence='+list+']').addClass('fade in active')
            }
        }

        if (parseInt(list) === 5) {
            $('#btnNext').hide()
            $('#btnSubmit').show()
        } else {
            $('#btnNext').show()
            $('#btnSubmit').hide()
        }
    }

    function checkRadio() {
        let checkValue = $('input[name=typetrip]:checked').val();

        if (checkValue === 'single') {
            $('#information-return').hide()
            $('#date-return').hide()
            $('#return-wrapper').hide()

            $('#harga_pulang').attr('required', false)
            $('#kode_flight_pulang').attr('required', false)
        } else {
            $('#information-return').show()
            $('#date-return').show()
            $('#return-wrapper').show()

            $('#harga_pulang').attr('required', true)
            $('#kode_flight_pulang').attr('required', true)
        }
    }
</script>   

<script>
    $(document).ready(function() {
        let party = $('#party [familyIdentity]');

        for (i=0; i<party.length; i++) {
            let nama = party[i].getAttribute('familyIdentity'),
                nik = party[i].value,
                limit = party[i].getAttribute('familyRsvpLimit')

            
            requestLimitation(nama, nik, limit)
        }
    })

    function requestLimitation(nama, nik, limit) {
        $.ajax({
            url: "<?= site_url('family/serviceRsvpLimit') ?>?nama="+ nama +"&nik=" + nik,
            type: 'GET',
            success: function(response) {
                let used = parseInt(JSON.parse(response)[0].total),
                    total = parseInt(limit) - used

                if (total === 0) {
                    $('#party [familyIdentity='+ nama +']').attr('disabled', true)
                }
            }
        });
    }
</script>