<header class="main-header">
    <a href="<?= site_url('dashboard') ?>" class="logo">
        <span class="logo-mini">
            <strong>R</strong>
        </span>

        <span class="logo-lg">
            <strong>Respati</strong> 2.0
        </span>
    </a>

    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if ($this->session->type == 'employee') { ?>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" id="updateNotiTrigger" onclick="updateNoti()" data-toggle="dropdown">
                        <i class="fa fa-bell-o inh"></i>
                        <span class=" label label-danger inh" id="total_noti"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <ul class="menu">
                                <li id="noti_homebase_approve_wrap" style="display:none">
                                    <a href="<?= site_url('reservation/homebase_reporting') ?>?from_date=<?= date('Y-m-d') ?>&to_date=<?= date('Y-m-d') ?>">
                                        <i class="fa fa-check text-success"></i> <strong id="noti_homebase_approve">0</strong> Reservasi Homebase Di Approve.
                                    </a>
                                </li>

                                <li id="noti_homebase_reject_wrap" style="display:none">
                                    <a href="<?= site_url('reservation/reimbursement_reporting') ?>?from_date=<?= date('Y-m-d') ?>&to_date=<?= date('Y-m-d') ?>">
                                        <i class="fa fa-times text-danger"></i> <strong id="noti_homebase_reject">0</strong> Reservasi Homebase Di Reject.
                                    </a>
                                </li>

                                <li id="noti_reimbursement_approve_wrap" style="display:none">
                                    <a href="<?= site_url('reservation/reimbursement_reporting') ?>?from_date=<?= date('Y-m-d') ?>&to_date=<?= date('Y-m-d') ?>">
                                        <i class="fa fa-check text-success"></i> <strong id="noti_reimbursement_approve">10</strong> Reimbursement Di Approve.
                                    </a>
                                </li>

                                <li id="noti_reimbursement_reject_wrap" style="display:none">
                                    <a href="<?= site_url('reservation/reimbursement_reporting') ?>?from_date=<?= date('Y-m-d') ?>&to_date=<?= date('Y-m-d') ?>">
                                        <i class="fa fa-check text-danger"></i> <strong id="noti_reimbursement_reject">8</strong> Reimbursement Di Reject.
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php } ?>

                <li class="dropdown user user-menu">
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <span>
                            <?php if ($this->session->type !== 'administrator') { ?>
                                <strong><?= $this->session->name ?></strong>, <?= $this->session->identity ?> <i class="fa fa-chevron-down dropdown--user"></i>
                            <?php } else { ?>
                                <strong><?= $this->session->name ?></strong>, Administrator
                            <?php } ?>
                        </span>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <?php if ($this->session->type === 'employee') { ?>
                            <a href="<?= site_url('employee/form/' . $this->session->unique ) ?>">Profil Saya</a>
                            <!-- <a href="<?= site_url('family') ?>">Pengaturan Keluarga</a> -->
                            <?php } ?>
                            <a href="<?= site_url('authentication/revoke') ?>">Keluar</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>