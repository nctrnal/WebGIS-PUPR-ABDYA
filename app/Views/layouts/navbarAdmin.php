<nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Admin"><img id="icon" src="<?= base_url('img/logo.png'); ?>" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse dropdown" id="navbarNav">
            <ul class="navbar-nav ">
                <li class="nav-item" id="nav-id">
                    <a class="nav-link <?php if ($title == 'Beranda') : ?> active <?php endif; ?>" aria-current="page" href="/Admin">Berita</a>
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
                    <a class="nav-link <?php if ($title == 'Berkas Daerah Irigasi') : ?> active <?php endif; ?>" href="/Admin/dataDaerahIrigasiAdmin">Berkas Daerah Irigasi</a>
                </li>
                <li class="nav-item" id="nav-id">
                    <a class="nav-link <?php if ($title == 'Berkas Jaringan Irigasi') : ?> active <?php endif; ?>" href="/Admin/dataJaringanIrigasiAdmin">Berkas Jaringan Irigasi</a>
                </li>
            </ul>
            <ul class="navbar-nav" id="nav-login">
                <li class=" nav-item">
                    <a id="button" class="nav-link btn btn-success <?php if ($title == 'Login') : ?> active <?php endif; ?> btn btn-success" href="<?= base_url(); ?>Login/logout"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                        </svg> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>