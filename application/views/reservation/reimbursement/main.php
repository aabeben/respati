<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header rsvp">
                    <h3 class="box-title">
                        <i class="fa fa-ticket"></i>
                        Reimbursement 
                    </h3>
                    <?php 
                        $last_segment = $this->uri->total_segments();
                        $record_num = $this->uri->segment($last_segment);
                        if ($record_num != 'reimbursement_history') { 
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
                                Reimbursement untuk <strong>Keberangkatan</strong>
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
                                        <th>Harga Tiket</th>¸
                                        <th>Boarding Pass</th>¸
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
                                            <td><strong>Rp<?= $data->harga; ?></strong></td>
                                            <td>
                                                <?php if ($data->document === null || $data->document === '') { ?>
                                                    <span class="text-danger">-</span>
                                                <?php } else { ?>
                                                    <a href="<?= base_url() ?>/assets/storage/image/boarding/<?= $data->document ?>" target="_blank" class="text-success" style="color: #1d9b95;"><strong>Klik <i class="fa fa-picture-o"></i></strong></a>
                                                <?php } ?>
                                            </td>
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

                                                <a class="btn btn-info btn-md" style="color: white;" onClick="changeAttachment(<?= $data->id ?>, '<?= base_url() ?>/assets/storage/image/boarding/<?= $data->document ?>', '<?= $data->nama ?>')" title="Ubah Boarding Pass">
                                                    Ubah Boarding Pass
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
                                            <th>Flight</th>
                                            <th>Harga Tiket</th>
                                            <th>Dokumen</th>
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
                                                <td><strong>Rp<?= $data->harga; ?></strong></td>
                                                <td>
                                                    <?php if ($data->document === null || $data->document === '') { ?>
                                                        <span class="text-danger">-</span>
                                                    <?php } else { ?>
                                                        <a href="<?= base_url() ?>/assets/storage/image/boarding/<?= $data->document ?>" target="_blank" class="text-success" style="color: #1d9b95;"><strong>Klik <i class="fa fa-picture-o"></i></strong></a>
                                                    <?php } ?>
                                                </td>
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
                                                        <a href="#" onClick="proofDocument(<?= $data->id ?>, 'true', 'reimbursement')" class="btn btn-success text-white btn-md" style="color: white;" data-toggle="tooltip" title="Approve">
                                                        <i class="fa fa-check"></i> Approve
                                                    </a>
                                                    <a href="<?= site_url('reservation/approval/' . $data->id) ?>?action=reject&back=reimbursement" class="btn btn-danger btn-md" data-toggle="tooltip" title="Reject">
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
                                Reimbursement untuk <strong>Kepulangan</strong>
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
                                            <td><strong>Rp<?= $data->harga_pulang; ?></strong></td>
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

                                                <a class="btn btn-info btn-md" style="color: white;" onClick="changeAttachment(<?= $data->id ?>, '<?= base_url() ?>/assets/storage/image/boarding/<?= $data->document ?>', '<?= $data->nama ?>')" title="Ubah Boarding Pass">
                                                    Ubah Boarding Pass
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
                                        <th>Tanggal Pulang</th>
                                        <th>Kode Flight</th>
                                        <th>Harga Tiket</th>
                                        <th>Dokumen</th>
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
                                            <td><strong>Rp<?= $data->harga_pulang; ?></strong></td>
                                            <td>
                                                <?php if ($data->document === null || $data->document === '') { ?>
                                                    <span class="text-danger">Tidak ada dokumen boarding pass.</span>
                                                <?php } else { ?>
                                                    <a href="<?= base_url() ?>/assets/storage/image/boarding/<?= $data->document ?>" target="_blank" class="text-success" style="color: #1d9b95;"><strong>Klik <i class="fa fa-picture-o"></i></strong></a>
                                                <?php } ?>
                                            </td>
                                            <td><?= $data->created_at; ?></td>
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
                                                    <a href="#" onClick="proofDocument(<?= $data->id ?>, 'true', 'reimbursement')" class="btn btn-success text-white btn-md" style="color: white;" data-toggle="tooltip" title="Approve">
                                                        <i class="fa fa-check"></i> Approve
                                                    </a>
                                                    
                                                    <a href="<?= site_url('reservation/approval/' . $data->id) ?>?action=true&back=reimbursement" class="btn btn-danger btn-md" data-toggle="tooltip" title="Reject">
                                                        <i class="fa fa-times"></i> Reject
                                                    </a>
                                                <?php } else if ($data->st_approv == 'reject') { ?>
                                                    <?php if ($data->st_info != null || $data->st_info != '' || $data->st_info != 'false') { ?>
                                                        Catatan: <?= $data->st_info ?>
                                                    <?php } ?>
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

                <div id="mdlProofDocument" class="modal fade" role="dialog" style="margin-top: -125px;">
                    <div class="modal-dialog" >
                        <div class="modal-content">
                        <form method="POST" id="proofDocumentForm" enctype='multipart/form-data'>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><i class="fa fa-picture-o" style="margin-right: 10px;"></i> Upload Bukti Transfer</h4>
                            </div>
                            
                            <div class="modal-body">
                                <input type="hidden" id="rsvp_id" name="rsvp_id" class="form-control">
                                
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <h6><strong>Upload Bukti Transfer</strong></h6>
                                        <input type="file" name="file_transfer" id="file_transfer" required> 
                                        <small class="text-danger">File maximal 5mb.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

                <div id="mdlAttachment" class="modal fade" role="dialog" style="margin-top: -125px;">
                    <div class="modal-dialog" >
                        <div class="modal-content">
                        <form method="POST" action="<?= site_url('reservation/attachmentChange') ?>" enctype='multipart/form-data'>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><i class="fa fa-picture-o" style="margin-right: 10px;"></i> Edit Boarding Pass <strong id="rsvp_name_"></strong></h4>
                            </div>
                            
                            <div class="modal-body">
                                <input type="hidden" id="rsvp_id_attachment" name="rsvp_id" class="form-control">
                                
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <h6><strong>Boarding Pass saat ini</strong></h6>
                                        <img src="" id="rsvp_attachment" class="img-responsive">
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <h6><strong>Upload Boarding Pass terbaru</strong></h6>
                                        <input type="file" name="boarding" id="boarding"> 
                                        <small class="text-danger">File maximal 5mb.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>


                <div id="modal-reimbursement" class="modal fade" role="dialog">
                    <form method="POST" action="<?= site_url('reservation/store') ?>" enctype='multipart/form-data'>
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    <h4 class="modal-title">
                                        <i class="fa fa-ticket text-danger"></i> Tambah Data <strong>Reimbursement</strong>
                                    </h4>
                                </div>
                                
                                <div class="modal-body">
                                    <div class="form-group-hidden">
                                        <input type="hidden" id="entity" name="entity" class="form-control" value="REIMBURSEMENT">
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <ul class="nav nav-tabs nav-digi">
                                                <li class="active" sequence="1"><a>1. Data Diri</a></li>
                                                <li sequence="2"><a>2. Keberangkatan & Tujuan</a></li>
                                                <li sequence="3"><a>3. Maskapai</a></li>
                                                <li sequence="4"><a>4. Tanggal</a></li>
                                                <li sequence="5"><a>5. Kode Flight & Harga Tiket</a></li>
                                                <li sequence="6"><a>6. Upload Berkas</a></li>
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
                                                                            <input type="text" class="form-control form-date" id="tgl_pulang" value="<?= date('m/d/Y') ?>" name="tgl_pulang">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Waktu Kepulangan</label>
                                                                            <input type="time" class="form-control" id="waktu_pulang" value="<?= date('h:i') ?>" name="waktu_pulang">
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
                                                                            <input id="harga" onchange="setTwoNumberDecimal()" type="text" class="form-control niw" name="harga">
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
                                                                            <input id="harga_pulang" type="text" class="form-control niw2" name="harga_pulang">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div id="data-document" class="tab-pane fade" sequence="6">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3><strong>Upload Berkas</strong></h3>
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="form-group">
                                                                        <label>Boarding Pass</label>
                                                                        <input type="file" class="form-control" id="boarding" name="boarding" required>
                                                                        <small class="text-danger">File maximal 5mb.</small>
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
                                    <button id="btnSubmit" type="button" onClick="showModalLast()"  class="btn btn-success" style="display: none;">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div id="modalLast" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Konfirmasi</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label><strong>Tipe Perjalanan</strong></label>
                            <h5 id="show_typetrip" style="margin-top: 0px;">Pulang Pergi</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label><strong>Nama Pemesan</strong></label>
                            <h5 id="show_nama" style="margin-top: 0px;"></h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label><strong>Rute Keberangkatan</strong></label>
                            <h5 id="show_route_from" style="margin-top: 0px;"></h5>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label><strong>Rute Tujuan</strong></label>
                            <h5 id="show_route_to" style="margin-top: 0px;"></h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label><strong>Maskapai Berangkat</strong></label>
                            <h5 id="show_maskapai_berangkat" style="margin-top: 0px;"></h5>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label><strong>Maskapai Pulang</strong></label>
                            <h5 id="show_maskapai_pulang" style="margin-top: 0px;"></h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label><strong>Tanggal Berangkat</strong></label>
                            <h5 id="show_tgl_berangkat" style="margin-top: 0px;"></h5>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label><strong>Waktu Berangkat</strong></label>
                            <h5 id="show_waktu_berangkat" style="margin-top: 0px;"></h5>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label><strong>Tanggal Pulang</strong></label>
                            <h5 id="show_tgl_pulang" style="margin-top: 0px;"></h5>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label><strong>Waktu Pulang</strong></label>
                            <h5 id="show_waktu_pulang" style="margin-top: 0px;"></h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label><strong>Kode Flight Berangkat</strong></label>
                            <h5 id="show_kode_flight_berangkat" style="margin-top: 0px;"></h5>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label><strong>Harga Tiket</strong></label>
                            <h5 id="show_harga_berangkat" style="margin-top: 0px;"></h5>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label><strong>Kode Flight Pulang</strong></label>
                            <h5 id="show_kode_flight_pulang" style="margin-top: 0px;"></h5>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <label><strong>Harga Tiket Pulang</strong></label>
                            <h5 id="show_harga_pulang" style="margin-top: 0px;"></h5>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>


    </form>

    <script>
    </script>

</section>

<script src="<?= base_url() ?>assets/vendor/jquery/dist/jquery.min.js"></script>

<script>
    function changeAttachment(rsvp_id, attachment, rsvp_name) {
        $('#mdlAttachment').modal('show')

        $('#rsvp_id_attachment').val(rsvp_id)
        $('#rsvp_name_').html(rsvp_name)
        $('#rsvp_attachment').attr('src', attachment)
    }
</script>
<script>
    function proofDocument(id, st_approv, redirection) {
        $('#mdlProofDocument').modal('show')

        $('#proofDocumentForm').attr('action', '<?= site_url('reservation/approval/') ?>' + id + '?back=' + redirection + '&action=' + st_approv)
    }

    <?php if ($this->session->type === 'employee') { ?>
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

<?php } ?>

    function showModalLast() {
        let trip = $('input[name=typetrip]:checked').val() === 'single' ? 'Sekali Jalan' : 'Pulang Pergi',
            nama = $('#nama').val(),
            route_from = $('#route_from option:selected').text(),
            route_to   = $('#route_to option:selected').text(),
            maskapai_berangkat = $('#maskapai_berangkat option:selected').text(),
            maskapai_pulang = $('#maskapai_pulang option:selected').text()

            let tgl_berangkat = $('#tgl_berangkat').val(),
                waktu_berangkat = $('#waktu_berangkat').val(),
                tgl_pulang = $('#tgl_pulang').val(),
                waktu_pulang = $('#waktu_pulang').val()

            let kode_flight_berangkat = $('#kode_flight').val(),
                harga_berangkat = $('#harga').val(),
                kode_flight_pulang = $('#kode_flight_pulang').val(),
                harga_pulang = $('#harga_pulang').val()

        $('#show_typetrip').html(trip)
        $('#show_nama').html(nama)
        $('#show_route_from').html(route_from)
        $('#show_route_to').html(route_to)
        $('#show_tgl_berangkat').html(tgl_berangkat)
        $('#show_waktu_berangkat').html(waktu_berangkat)
        $('#show_maskapai_berangkat').html(maskapai_berangkat)
        $('#show_kode_flight_berangkat').html(kode_flight_berangkat)
        $('#show_harga_berangkat').html(harga_berangkat)

        if (trip !== 'Sekali Jalan') {
            $('#show_maskapai_pulang').html(maskapai_pulang)

            $('#show_tgl_pulang').html(tgl_pulang)
            $('#show_waktu_pulang').html(waktu_pulang)


        $('#show_kode_flight_pulang').html(kode_flight_pulang)
        $('#show_harga_pulang').html(harga_pulang)
        } else {
            $('#show_maskapai_pulang').html('-')
            $('#show_tgl_pulang').html('-')
            $('#show_waktu_pulang').html('-')


            $('#show_kode_flight_pulang').html('-')
            $('#show_harga_pulang').html('-')
        }
        
        $('#modalLast').modal('show')
    }

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

                $('#btnPrev').attr('disabled', true)
                $('#btnNext').attr('disabled', true)
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

                $('#btnPrev').attr('disabled', false)
                $('#btnNext').attr('disabled', false)
                            return true;
                        } else {

                $('#btnPrev').attr('disabled', false)
                $('#btnNext').attr('disabled', false)
                            $('.nav-digi > li').removeClass('fade active')
                            $('.tab-pane').removeClass('fade active')

                            $('.nav-digi > li[sequence=1]').addClass('fade in active')
                            $('.tab-pane[sequence=1]').addClass('fade in active')
                        }
                    });
                }
            break

            case 2:

            $('#btnPrev').attr('disabled', true)
                $('#btnNext').attr('disabled', true)

                let route_from = $('#route_from option:selected').text(),
                    route_to = $('#route_to option:selected').text(),

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
                $('#btnPrev').attr('disabled', false)
                $('#btnNext').attr('disabled', false)
                            return true;
                        } else {


                $('#btnPrev').attr('disabled', false)
                $('#btnNext').attr('disabled', false)
                            $('.nav-digi > li').removeClass('fade active')
                            $('.tab-pane').removeClass('fade active')

                            $('.nav-digi > li[sequence=2]').addClass('fade in active')
                            $('.tab-pane[sequence=2]').addClass('fade in active')
                        }
                    });
            break

            case 3:
                $('#btnPrev').attr('disabled', true)
                $('#btnNext').attr('disabled', true)
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

                $('#btnPrev').attr('disabled', false)
                $('#btnNext').attr('disabled', false)
                            return true;
                        } else {

                $('#btnPrev').attr('disabled', false)
                $('#btnNext').attr('disabled', false)
                            $('.nav-digi > li').removeClass('fade active')
                            $('.tab-pane').removeClass('fade active')

                            $('.nav-digi > li[sequence=3]').addClass('fade in active')
                            $('.tab-pane[sequence=3]').addClass('fade in active')
                        }
                    });
            break

            case 4:

            $('#btnPrev').attr('disabled', true)
                $('#btnNext').attr('disabled', true)

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

                $('#btnPrev').attr('disabled', false)
                $('#btnNext').attr('disabled', false)
                            return true;
                        } else {

                $('#btnPrev').attr('disabled', false)
                $('#btnNext').attr('disabled', false)
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
                        } else {

                            $('#btnPrev').attr('disabled', true)
                            $('#btnNext').attr('disabled', true)
                            
                            let kode_flight_berangkat = $('#kode_flight').val(),
                            harga_berangkat = $('#harga').val(),
                            kode_flight_pulang = $('#kode_flight_pulang').val(),
                            harga_pulang = $('#harga_pulang').val()

                            let textToShown34 = ''

                            let checkValue34 = $('input[name=typetrip]:checked').val();

                            if (checkValue34 === 'single') {
                                textToShown34 = 'Kode Flight & Harga: ' + kode_flight_berangkat + ', Rp' + harga_berangkat
                            } else {
                                textToShown34 = 'Kode Flight & Harga Berangkat: ' + kode_flight_berangkat + ', ' + harga_berangkat + ', Kode Flight & Harga Pulang: ' + kode_flight_pulang + ', Rp' + harga_pulang
                            }

                            swal({
                                title: "Apakah anda yakin?",
                                text: textToShown34,
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

                $('#btnPrev').attr('disabled', false)
                $('#btnNext').attr('disabled', false)
                                    return true;
                                } else {

                $('#btnPrev').attr('disabled', false)
                $('#btnNext').attr('disabled', false)
                                    $('.nav-digi > li').removeClass('fade active')
                                    $('.tab-pane').removeClass('fade active')

                                    $('.nav-digi > li[sequence=3]').addClass('fade in active')
                                    $('.tab-pane[sequence=3]').addClass('fade in active')
                                }
                            });
                        }
                    } else {
                        if ($('#kode_flight').val() === '' || $('#kode_flight').val() === null || $('#harga').val() === '' || $('#harga').val() === null || $('#kode_flight_pulang').val() === '' || $('#kode_flight_pulang').val() === null || $('#harga_pulang').val() === '' || $('#harga_pulang').val() === null) {
                            swal("Error", 'Field tidak boleh kosong.', "error");
                            return false
                        } else {
                $('#btnPrev').attr('disabled', true)
                $('#btnNext').attr('disabled', true)
                            
                            let kode_flight_berangkat = $('#kode_flight').val(),
                            harga_berangkat = $('#harga').val(),
                            kode_flight_pulang = $('#kode_flight_pulang').val(),
                            harga_pulang = $('#harga_pulang').val()

                            let textToShown35 = ''

                            let checkValue35 = $('input[name=typetrip]:checked').val();

                            if (checkValue35 === 'single') {
                                textToShown35 = 'Kode Flight & Harga: ' + kode_flight_berangkat + ', Rp' + harga_berangkat
                            } else {
                                textToShown35 = 'Kode Flight & Harga Berangkat: ' + kode_flight_berangkat + ', ' + harga_berangkat + ', Kode Flight & Harga Pulang: ' + kode_flight_pulang + ', Rp' + harga_pulang
                            }

                            swal({
                                title: "Apakah anda yakin?",
                                text: textToShown35,
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

                $('#btnPrev').attr('disabled', false)
                $('#btnNext').attr('disabled', false)
                                    return true;
                                } else {

                $('#btnPrev').attr('disabled', false)
                $('#btnNext').attr('disabled', false)
                                    $('.nav-digi > li').removeClass('fade active')
                                    $('.tab-pane').removeClass('fade active')

                                    $('.nav-digi > li[sequence=3]').addClass('fade in active')
                                    $('.tab-pane[sequence=3]').addClass('fade in active')
                                }
                            });
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

        if (parseInt(list) === 6) {
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