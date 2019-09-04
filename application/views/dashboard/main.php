<section class="content">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="<?= site_url('employee') ?>" class="info-link">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Data <strong>Karyawan</strong></span>
                        <span class="info-box-number"><?= number_format($employee) ?></span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="<?= site_url('family') ?>" class="info-link">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Data <strong>Keluarga</strong></span>
                        <span class="info-box-number"><?= number_format($family) ?></span>
                    </div>
                </div>
            </a>
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="<?= site_url('flight') ?>" class="info-link">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-plane"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total <strong>Maskapai</strong></span>
                        <span class="info-box-number"><?= number_format($flight) ?></span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="<?= site_url('route') ?>" class="info-link">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-map"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total <strong>Rute Perjalanan</strong></span>
                        <span class="info-box-number"><?= number_format($route) ?></span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="fa fa-pie-chart"></i>
                        Statistik <strong>Pernikahan</strong>
                    </h3>
                </div>

                <div class="box-body">
                    <canvas id="jumlahPernikahan" height="400" style="width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="fa fa-pie-chart"></i>
                        Statistik <strong>Jumlah Anak</strong>
                    </h3>
                </div>

                <div class="box-body">
                    <canvas id="jumlahAnak" height="400" style="width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="fa fa-bar-chart text-warning"></i>
                        Statistik <strong>Reservasi Reimbursement</strong>
                    </h3>
                </div>

                <div class="box-body">
                    <canvas id="rsvp_rembursement" height="400" style="width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="fa fa-bar-chart text-warning"></i>
                        Statistik <strong>Reservasi Homebase</strong>
                    </h3>
                </div>

                <div class="box-body">
                    <canvas id="rsvp_homebase" height="400" style="width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="fa fa-table text-warning"></i>
                        <strong>Reservasi Homebase</strong> Terakhir
                    </h3>
                </div>

                <div class="box-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Rute</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($rsvp_homebase_last as $key => $data): ?>
                                <tr>
                                    <td><?= $data->id ?></td>
                                    <td><?= $data->nama ?></td>
                                    <td><?= $data->nik ?></td>
                                    <td>
                                        <?php if ($data->trip == 'single') { ?>
                                        <?= $data->route_from ?> – <?= $data->route_to ?>
                                        <?php } else { ?>
                                        <?= $data->route_from ?> – <?= $data->route_to ?>,  <?= $data->route_to ?> – <?= $data->route_from ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>    
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="fa fa-table text-warning"></i>
                        <strong>Reservasi Reimbursement</strong> Terakhir
                    </h3>
                </div>

                <div class="box-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Rute</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($rsvp_reimbursement_last as $key => $data): ?>
                                <tr>
                                    <td><?= $data->id ?></td>
                                    <td><?= $data->nama ?></td>
                                    <td><?= $data->nik ?></td>
                                    <td>
                                        <?php if ($data->trip == 'single') { ?>
                                        <?= $data->route_from ?> – <?= $data->route_to ?>
                                        <?php } else { ?>
                                        <?= $data->route_from ?> – <?= $data->route_to ?>,  <?= $data->route_to ?> – <?= $data->route_from ?>
                                        <?php } ?>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>
    var contextAnak = document.getElementById('jumlahAnak').getContext('2d');

    var dataAnak = {
        datasets: [{
            data: [
                <?= $child_nh ?>,
                <?= $child_1 ?>,
                <?= $child_2 ?>,
                <?= $child_3 ?>,
                <?= $child_m3 ?>
            ],
            backgroundColor: [
                '#ff6384',
                '#f39c12',
                '#ea6972',
                '#ff3a3a',
                '#B40D1A'
            ]
        }],
        labels: [
            'Tidak Mempunyai Anak',
            '1 Anak',
            '2 Anak',
            '3 Anak',
            'Lebih dari 3 Anak'
        ]
    };

    var myPieChart = new Chart(contextAnak, {
        type: 'pie',
        data: dataAnak
    });
</script>


<script>
    var contextMarriage = document.getElementById('jumlahPernikahan').getContext('2d');

    var dataPernikahan = {
        datasets: [{
            data: [
                <?= $marriage_true ?>,
                <?= $marriage_false ?>
            ],
            backgroundColor: [
                '#f39c12',
                '#B40D1A'
            ]
        }],
        labels: [
            'Sudah Menikah',
            'Belum Menikah'
        ]
    };

    var myPieChart = new Chart(contextMarriage, {
        type: 'doughnut',
        data: dataPernikahan
    });
</script>

<script>
    var ctx = document.getElementById('rsvp_rembursement').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                '<?= date('F', strtotime("-3 months")) ?>', 
                '<?= date('F', strtotime("-2 months")) ?>', 
                '<?= date('F', strtotime("-1 months")) ?>', 
                'Bulan Ini (<?= date('F') ?>)'
            ],
            datasets: [{
                label: '# Reservasi Reimbursement',
                data: [
                    <?php if (isset($rsvp_reimbursement_min3_month[0]->total)) print $rsvp_reimbursement_min3_month[0]->total; else print 0; ?>, 
                    <?php if (isset($rsvp_reimbursement_min2_month[0]->total)) print $rsvp_reimbursement_min2_month[0]->total; else print 0; ?>,
                    <?php if (isset($rsvp_reimbursement_min1_month[0]->total)) print $rsvp_reimbursement_min1_month[0]->total; else print 0; ?>, 
                    <?php if (isset($rsvp_reimbursement_this_month[0]->total)) print $rsvp_reimbursement_this_month[0]->total; else print 0; ?>
                ],
                backgroundColor: [
                    '#ff6384',
                    '#f39c12',
                    '#ea6972',
                    '#ff3a3a',
                    '#B40D1A'
                ]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('rsvp_homebase').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                '<?= date('F', strtotime("-3 months")) ?>', 
                '<?= date('F', strtotime("-2 months")) ?>', 
                '<?= date('F', strtotime("-1 months")) ?>', 
                'Bulan Ini (<?= date('F') ?>)'
            ],
            datasets: [{
                label: '# Reservasi Homebase',
                data: [
                    <?php if (isset($rsvp_homebase_min3_month[0]->total)) print $rsvp_homebase_min3_month[0]->total; else print 0; ?>, 
                    <?php if (isset($rsvp_homebase_min2_month[0]->total)) print $rsvp_homebase_min2_month[0]->total; else print 0; ?>,
                    <?php if (isset($rsvp_homebase_min1_month[0]->total)) print $rsvp_homebase_min1_month[0]->total; else print 0; ?>, 
                    <?php if (isset($rsvp_homebase_this_month[0]->total)) print $rsvp_homebase_this_month[0]->total; else print 0; ?>
                ],
                backgroundColor: [
                    '#e2c498',
                    '#d1ac75',
                    '#ce9846',
                    '#f39c12'
                ]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>