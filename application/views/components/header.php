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
                            <a href="<?= site_url('family') ?>">Pengaturan Keluarga</a>
                            <?php } ?>
                            <a href="<?= site_url('authentication/revoke') ?>">Keluar</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>