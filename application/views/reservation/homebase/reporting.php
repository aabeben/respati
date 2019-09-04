<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"/>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header rsvp">
                    <h3 class="box-title">
                        <i class="fa fa-ticket"></i>
                        <strong>Homebase</strong> Report
                    </h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h5>Filter</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <form class="form-inline" method="GET">
                                <?php if ($this->session->type != 'employee') { ?>
                                <div class="form-group">
                                    <label for="employee">Karyawan</label>
                                    <select id="employee" name="employee" class="form-control form-search">
                                        <option 
                                        <?php 
                                            if ($this->input->get('employee')) {
                                                if ($this->input->get('employee') == 'all') {
                                                        print 'selected';
                                                }
                                            }
                                        ?>
                                        value="all">-- Semua Karyawan --</option>
                                        <?php foreach ($employee as $key => $data): ?>
                                            <option
                                            <?php 
                                                if ($this->input->get('employee')) {
                                                    if ($this->input->get('employee') != 'all') {
                                                        if ($this->input->get('employee') == $data->nik) {
                                                            print 'selected';
                                                        }
                                                    }
                                                }
                                            ?>
                                             value="<?= $data->nik ?>"><?= $data->nama_lengkap ?> - <?= $data->nik ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php } ?>

                                <div class="form-group">
                                    <label for="from_date">Dari Tanggal</label>
                                    <input type="text" class="form-control form-date-mysql" id="from_date" value="<?= $this->input->get('from_date') ?>" name="from_date">
                                </div>

                                <div class="form-group">
                                    <label for="from_date">Ke Tanggal</label>
                                    <input type="text" class="form-control form-date-mysql" id="to_date" value="<?= $this->input->get('to_date') ?>" name="to_date">
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option
                                        <?php 
                                            if ($this->input->get('status')) {
                                                if ($this->input->get('status') == 'all') {
                                                    print 'selected';
                                                }
                                            }
                                        ?>
                                        value="all">-- Semua Status --</option>
                                        <option
                                        <?php 
                                            if ($this->input->get('status')) {
                                                if ($this->input->get('status') == 'true') {
                                                    print 'selected';
                                                }
                                            }
                                        ?> value="true">Approved</option>
                                        <option
                                        <?php 
                                            if ($this->input->get('status')) {
                                                if ($this->input->get('status') == 'reject') {
                                                    print 'selected';
                                                }
                                            }
                                        ?>
                                        value="reject">Reject</option>
                                        <option
                                        <?php 
                                            if ($this->input->get('status')) {
                                                if ($this->input->get('status') == 'false') {
                                                    print 'selected';
                                                }
                                            }
                                        ?>
                                        value="false">Open</option>
                                    </select>
                                </div>

                                <div class="form-group" style="display: block !important; margin-top: 10px;">
                                    <button type="submit" class="btn btn-primary ">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box">
                        <div class="box-header rsvp-block">
                            <h4>
                                <i class="fa fa-share text-danger"></i>
                                Data <strong>Keberangkatan</strong>
                            </h4>

                            <h5 style="position: relative; top: 17.5px;"><i class="fa fa-th"></i> <strong>Export Tools</strong></h5>
                        </div>

                        <div class="box-body">
                            <table class="table table-bordered table-striped table-b">
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
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box">
                        <div class="box-header rsvp-block">
                            <h4>
                                <i class="fa fa-share fa-flip-horizontal text-danger"></i>
                                Data <strong>Kepulangan</strong>
                            </h4>
                            
                            <h5 style="position: relative; top: 17.5px;"><i class="fa fa-th"></i> <strong>Export Tools</strong></h5>
                        </div>

                        
                        <div class="box-body">
                            <table class="table table-bordered table-striped table-b">
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
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
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
                                                                                <option familyIdentity="<?= $data->nama ?>" value="<?= $data->nik ?>" statusku="<?= $data->relationship ?>"><?= $data->nama ?></option>
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
                                                                            <input type="time" class="form-control" id="waktu_berangkat" name="waktu_berangkat">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="date-return" style="display: none;">
                                                                    <h5 style="padding: 10px 15px; padding-bottom: 0; margin-bottom: 0px;">Pulang</h5>
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Pulang</label>
                                                                            <input type="text" class="form-control form-date" id="tgl_pulang" name="tgl_pulang">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Waktu Keberangkatan</label>
                                                                            <input type="time" class="form-control" id="waktu_pulang" name="waktu_pulang">
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
                                                                            <input type="text" class="form-control" id="kode_flight" name="kode_flight">
                                                                        </div>

                                                                        <label style="display: block;">Harga Tiket</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">Rp</span>
                                                                            <input id="harga" type="number" class="form-control" name="harga">
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
    <script src="<?= base_url() ?>assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<script>
$('.table-b').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

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
                }
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
        } else {
            $('#information-return').show()
            $('#date-return').show()
            $('#return-wrapper').show()


        }
    }

</script>   