<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= current_url(true)->getSegment(2) === 'home' ? 'active' : '' ?>" href="<?= base_url(); ?>/home">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= current_url(true)->getSegment(2) === 'pengguna' ? 'active' : '' ?>" href="<?= base_url(); ?>/pengguna">
                    <span data-feather="user"></span>
                    Pengguna
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= current_url(true)->getSegment(2) === 'supplier' ? 'active' : '' ?>" href="<?= base_url(); ?>/supplier">
                    <span data-feather="users"></span>
                    Supplier
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= current_url(true)->getSegment(2) === 'pembelian' ? 'active' : '' ?>" href="<?= base_url(); ?>/pembelian">
                    <span data-feather="shopping-cart"></span>
                    Pembelian Hutang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= current_url(true)->getSegment(2) === 'pembayaran' ? 'active' : '' ?>" href="<?= base_url(); ?>/pembayaran">
                    <span data-feather="plus-square"></span>
                    Pembayaran Hutang
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Laporan</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link <?= current_url(true)->getSegment(2) === 'laporan_hutang' ? 'active' : '' ?>" href="<?= base_url(); ?>/laporan_hutang">
                    <span data-feather="file-text"></span>
                    Laporan Pembayaran Hutang
                </a>
            </li>
        </ul>
        <hr/>
        <h6 class="d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted" style="padding-top :100px;">
            <div class="row">
                <span class="col-12" style="font-size: 18px;">By Yahya Abdul Hamid</span>
                <span class="col-12" style="font-size: 17px;"><u>2440090625</u></span>
            </div>
        </h6>
    </div>
</nav>