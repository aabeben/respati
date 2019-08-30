<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url() ?>assets/vendor/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>

            <div class="pull-left info">
                <p><?= $this->session->name ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <ul class="sidebar-menu" data-widget="tree">
            <li class="singleview <?php if($this->uri->uri_string() == 'dashboard') { print 'class="active"'; } ?>">
                <a href="#">
                    <i class="fa fa-pie-chart"></i> <span>Dasbor</span>
                </a>
            </li>

            <li class="header">Data Master</li>
            <li class="treeview <?php if($this->uri->uri_string() == 'employee' || $this->uri->uri_string() == 'family') { print 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Pihak</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li <?php if ($this->uri->uri_string() == 'employee') { print 'class="active"'; } ?>>
                        <a href="<?= site_url('employee') ?>">
                            <i class="fa fa-circle-o"></i> Karyawan
                        </a>
                    </li>

                    <li <?php if ($this->uri->uri_string() == 'family') { print 'class="active"'; } ?>>
                        <a href="<?= site_url('family') ?>">
                            <i class="fa fa-circle-o"></i> Keluarga
                        </a>
                    </li>
                </ul>
            </li>
            <li class="singleview <?php if ($this->uri->uri_string() == 'reservation/homebase') { print 'class="active"'; } ?>">
                <a href="<?= site_url('flight') ?>">
                    <i class="fa fa-plane"></i> <span>Maskapai</span>
                </a>
            </li>

            <li class="header">Pemesanan Tiket</li>
            <li class="singleview <?php if ($this->uri->uri_string() == 'reservation/homebase') { print 'class="active"'; } ?>">
                <a href="#">
                    <i class="fa fa-ticket"></i> <span>Homebase</span>
                </a>
            </li>
            <li class="singleview <?php if($this->uri->uri_string() == 'reservation/reimbursement') { print 'class="active"'; } ?>">
                <a href="#">
                    <i class="fa fa-ticket"></i> <span>Reimbursement</span>
                </a>
            </li>
        </ul>
    </section>
</aside>