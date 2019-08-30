<header class="main-header">
    <a href="#" class="logo">
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url() ?>assets/vendor/adminlte/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= $this->session->name ?></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?= base_url() ?>assets/vendor/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                            <p>
                                <?= $this->session->name ?>
                                <small><?= ucfirst($this->session->type) ?>, <?= $this->session->identity ?></small>
                            </p>
                        </li>


                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile Saya</a>
                            </div>

                            <div class="pull-right">
                                <a href="<?= site_url('authentication/revoke') ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>