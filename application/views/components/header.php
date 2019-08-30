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
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <span>
                            <strong><?= $this->session->name ?></strong>, <?= $this->session->identity ?> <i class="fa fa-chevron-down dropdown--user"></i>
                        </span>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">Profile Saya</a>
                            <a href="#">Keluar</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>