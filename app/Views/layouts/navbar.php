<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img id="icon" src="<?= base_url('img/logo.png'); ?>" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link <?php if ($title == 'Beranda') : ?> active <?php endif; ?>" aria-current="page" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($title == 'Jaringan Irigasi') : ?> active <?php endif; ?>" href="/pages/jaringanIrigasi">Jaringan Irigasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($title == 'Bangunan Irigasi') : ?> active <?php endif; ?>" href="/pages/bangunanIrigasi">Bangunan Irigasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($title == 'Daerah Irigasi') : ?> active <?php endif; ?>" href="/pages/daerahIrigasi">Daerah Irigasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($title == 'Pelaporan') : ?> active <?php endif; ?>" href="/pages/pelaporan">Pelaporan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($title == 'Data Irigasi') : ?> active <?php endif; ?>" href="/pages/dataIrigasi">Data</a>
                </li>
            </ul>
            <ul class="navbar-nav nav-login">
                <li class=" nav-item">
                    <a class="nav-link <?php if ($title == 'Login') : ?> active <?php endif; ?>" href="/pages/login">Login</a>
                </li>
            </ul>

        </div>
    </div>
</nav>