<nav id="navbar" class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Admin"><img id="icon" src="<?= base_url('img/logo.png'); ?>" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">


            <ul class="navbar-nav ">
                <li class="nav-item" id="nav-id">
                    <a class="nav-link <?php if ($title == 'Beranda') : ?> active <?php endif; ?>" aria-current="page" href="/Admin">Beranda</a>
                </li>
                <li class="nav-item" id="nav-id">
                    <a class="nav-link <?php if ($title == 'Jaringan Irigasi') : ?> active <?php endif; ?>" href="/Irigasi/jaringanIrigasiAdmin">Jaringan Irigasi</a>
                </li>
                <li class="nav-item" id="nav-id">
                    <a class="nav-link <?php if ($title == 'Bangunan Irigasi') : ?> active <?php endif; ?>" href="/Irigasi/bangunanIrigasiAdmin">Bangunan Irigasi</a>
                </li>
                <li class="nav-item" id="nav-id">
                    <a class="nav-link <?php if ($title == 'Daerah Irigasi') : ?> active <?php endif; ?>" href="/Irigasi/daerahIrigasiAdmin">Daerah Irigasi</a>
                </li>
                <li class="nav-item" id="nav-id">
                    <a class="nav-link <?php if ($title == 'Pelaporan') : ?> active <?php endif; ?>" href="/Admin/lihatLaporan">Pelaporan</a>
                </li>
                <li class="nav-item" id="nav-id">
                    <a class="nav-link <?php if ($title == 'Data Irigasi') : ?> active <?php endif; ?>" href="/Admin/dataIrigasiAdmin">Data</a>
                </li>
            </ul>
            <ul class="navbar-nav nav-login">
                <li class=" nav-item">
                    <a style="border-radius: 15px;" class="nav-link <?php if ($title == 'Login') : ?> active <?php endif; ?> btn btn-success" href="<?= base_url(); ?>Login/logout"><i class="bi bi-box-arrow-left"></i> Logout</a>
                </li>
            </ul>

        </div>
    </div>
</nav>