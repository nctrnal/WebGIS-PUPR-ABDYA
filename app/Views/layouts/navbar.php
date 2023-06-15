<nav class="navbar navbar-expand-lg navbar-light fixed-top header" id="navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img id="icon" src="<?= base_url('img/logo.png'); ?>" alt="logo">
        </a>
        <div class="collapse navbar-collapse header-nav" id="navbarNav">
            <ul class="navbar-nav">
                <li>
                    <a class="header-nav-link header-nav-top-link <?php if ($title == 'Beranda') : ?> active <?php endif; ?>" aria-current="page" href="/">Beranda</a>
                </li>
                <li>
                    <a class="header-nav-link header-nav-top-link <?php if ($title == 'Panduan') : ?> active <?php endif; ?>" aria-current="page" href="/pages/panduan">Panduan</a>
                </li>
                <li>
                    <a class="header-nav-link header-nav-top-link <?php if ($title == 'Pelaporan') : ?> active <?php endif; ?>" aria-current="page" href="/pages/pelaporan">Pelaporan</a>
                </li>
                <li>
                    <a href="#" class="header-nav-link header-nav-top-link <?php if ($title == 'Peta Irigasi') : ?> active <?php endif; ?>">Peta Irigasi</a>
                    <ul>
                        <li><a href="/pages/daerahIrigasi" class="header-nav-link header-nav-sub-link">Daerah Irigasi</a></li>
                        <li><a href="/pages/jaringanIrigasi" class="header-nav-link header-nav-sub-link">Jaringan Irigasi</a></li>
                        <li><a href="/pages/bangunanIrigasi" class="header-nav-link header-nav-sub-link">Bangunan Irigasi</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="header-nav-link header-nav-top-link <?php if ($title == 'Berkas') : ?> active <?php endif; ?>">Berkas Irigasi</a>
                    <ul>
                        <li><a href="/pages/dataDaerahIrigasi" class="header-nav-link header-nav-sub-link">Daerah Irigasi</a></li>
                        <li><a href="/pages/dataJaringanIrigasi" class="header-nav-link header-nav-sub-link">Jaringan Irigasi</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="header-nav-link header-nav-top-link <?php if ($title == 'Geojson') : ?> active <?php endif; ?>">Geojson</a>
                    <ul>
                        <li><a href="/pages/dataGeojsonDaerah" class="header-nav-link header-nav-sub-link <?php if ($title == 'Geojson') : ?> active <?php endif; ?>">Daerah Irigasi</a></li>
                            <li><a href="/pages/dataGeojsonJaringan" class="header-nav-link header-nav-sub-link <?php if ($title == 'Geojson') : ?> active <?php endif; ?>">Jaringan Irigasi</a></li>
                                <li><a href="/pages/dataGeojsonBangunan" class="header-nav-link header-nav-sub-link <?php if ($title == 'Geojson') : ?> active <?php endif; ?>">Bangunan Irigasi</a></li>
                            </ul>
                </li>
            </ul>
            
            <ul class="navbar-nav" id="nav-login">
                <li>
                    <button id="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                </li>
            </ul>

        </div>
    </div>
</nav>