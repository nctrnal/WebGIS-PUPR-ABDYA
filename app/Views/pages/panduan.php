<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<h1 style="margin: 0.3cm 1cm 1cm 3cm">PANDUAN</h1>
    <div id="grid-container" class="container grid-container">
        <div >
            <h3>Halaman Berita</h3>
            <h6>Halaman berita berisi berita terkait irigasi di Kabupaten Aceh Barat Daya. Berita memiliki beberapa kategori yaitu Umum, Khusus, dan Pemerintah Aceh.</h6>
            <h6 style="margin-left: 0.5cm;">1. Umum</h6>
            <h6 style="margin-left: 1cm;">Kategori Umum berisikan berita tentang kegiatan dan juga dokumentasi Dinas PUPR Kabupaten Aceh Barat Daya. Berita yang disajikan mencakup semua bidang yang ada.</h6>
            <h6 style="margin-left: 0.5cm;">2. Khusus</h6>
            <h6 style="margin-left: 1cm;">Kategori Khusu berisikan berita tentang kegiatan dan juga dokumentasi Bidang Irigasi DInas PUPR Kabupaten Aceh Barat Daya. </h6>
            <h6 style="margin-left: 0.5cm;">3. Pemerintah Aceh</h6>
            <h6 style="margin-left: 1cm;">Kategori Pemerintah Aceh berisikan berita tentang kegiatan dan juga dokumentasi yang dilakukan oleh Pemerinta Aceh yang berkaitan dengan Dinas PUPR Kabupaten Aceh Barat Daya.</h6>
        </div>
        <div class="img"><img src="<?= base_url('img/background.png'); ?>" alt=""></div>
        <div class="img"><img src="<?= base_url('img/pelaporan.png'); ?>" alt=""></div>
        <div >
            <h3>Pelaporan</h3>
            <h6>Pelaporan merupakan sebuah fitur yang dapat digunakan oleh masyarakat secara umum untuk melaporkan kerusakan irigasi. Fitur ini dapat ditemukan di halaman beranda dengan menekan tombol Buat Laporan. Masyarakat dapat membuat laporan dengan memberikan beberapa informasi yang dibutuhkan untuk validasi laporan kerusakan, seperti nama pelapor, identitas pelapor, lokasi kerusakan irigasi, deskripsi kerusakan irigasi, dan foto bukti kerusakan irigasi. Untuk foto yang akan diupload sebaiknya diambil menggunkan <a href="https://play.google.com/store/apps/details?id=com.jkfantasy.gpsmapcamera">GPS Map Camera</a> agar foto yang diupload memiliki koordinat, sehingga memudahkan admin atau staf Bidang Irigasi dalam melakukan validasi laporan.</h6>
        </div>
        <div >
            <h3>Halaman Peta Daerah Irigasi</h3>
            <h6>Halaman ini akan menampilkan informasi persebaran daerah irigasi yang ada di Kabupaten Aceh Barat Daya. Informasi yang ditampilkan berupa sebuah peta yang didalam peta tersebut terdapat area dalam bentuk polygon. Setiap area dapat diklik dan akan memunculkan informasi yang berkaitan dengan area yang diklik. informasi yang ditampilkan tersebut berupa nama daerah, luas daerah, dan kecamatan.</h6>
        </div>
        <div class="img"><img src="<?= base_url('img/peta.png'); ?>" alt=""></div>
        <div class="img"><img src="<?= base_url('img/bangunan.png'); ?>" alt=""></div>
        <div >
            <h3>Halaman Peta Bangunan Irigasi</h3>
            <h6>Halaman ini akan menampilkan informasi terkait persebaran bangunan irigasi yang ada di Kabupaten Aceh Barat Daya. Informasi yang ditampilkan berupa sebuah peta yang didalam peta tersebut terdapat titik (point). Jika point tersebut dilkik, maka akan manampilkan pop up yang berisi informasi tentang titik tersebut, yaitu nama daerah, lebar bawah bangunan, lebar atas bangunan, kecamatan, kondisi bangunan irigasi, dan foto bangunan irigasi. setiap titik akan mewakili bangunan irigasi yang ada di Kabupaten Aceh Barat Daya. </h6>
        </div>
        <div ></div>
        <div ></div>
        <div >
            <h3>Halaman Peta Jaringan Irigasi</h3>
            <h6>Halaman ini akan menampilkan informasi terkait persebaran bangunan irigasi yang ada di Kabupaten Aceh Barat Daya. Informasi yang ditampilkan berupa sebuah peta yang didalam peta tersebut terdapat garis (polyline). Jika garis tersebut dilkik, maka akan menampilkan pop up yang berisi informasi tentang jarringan irigasi, informasi yang ditampilkan yaitu nama daerah, panjangan jaringan irigasi, kecamatan dan foto jaringan irigasi.</h6>
        </div>
        <div class="img"><img src="<?= base_url('img/peta2.png'); ?>" alt=""></div>
        <div class="img"><img src="<?= base_url('img/berkas.png'); ?>" alt=""></div>
        <div >
            <h3>Halaman Berkas</h3>
            <h6>Halaman berkas terdiri dari halaman daerah irigasi dan halaman jaringan irigasi. Setiap halaman akan menampilkan daftar dokumen irigasi setiap daerah. Setiap dokumen dapat dilihat secara langsung ataupun bagi masyarakat yang ingin mengunduh dokumen, dapat menekan tombol donwload yang sudah disediakan.</h6>
        </div>
        <div ></div>
        <div ></div>
        <div >
            <h3>Halaman Geojson</h3>
            <h6>Halaman ini terdiri dari halaman bangunan irigasi geojson, halaman daerah irigasi geojson, dan halaman jaringan irigasi geojson. Setiap halaman akan menampilkan daftar Geojson setiap daerah. File geojson dapat dikonversi kedalam bentuk Shapefile, pengguna dapat melakukan konversi menggunakan tools online ataupun tools lainnya (website ini belum menyediakan fitur konversi Geojseon ke Shapefile).</h6>
        </div>
        <div class="img"><img src="<?= base_url('img/geojson.png'); ?>" alt=""></div>
        <div id="map" style="height: 500px; width: 800px;"></div>
        <div >
            <h3>Kontak Dinas Pekerjaan Umum dan Penataan Umum</h3>
            <h6>Jl. Bukit Hijau, Keude Paya, Komplek Perkantoran</h6>
            <h6>Pemerintah Kabupaten Aceh Barat Daya</h6>
            <h6><em>E-mail : pupr@acehbaratdayakab.go.id</em></h6>
        </div>
    </div>
    <script>
        const map = L.map('map').setView([3.740462162674002, 96.8535704392758], 14);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

        var marker = L.marker([3.740462162674002, 96.8535704392758]).addTo(map);
        marker.bindPopup("Dinas Pekerjaan Umum dan Penataan Ruang<br>"+
                        "Kabupaten Aceh Barat Daya<br>"+
                        "<img id='fotoPeta' src='<?= base_url('img/pupr.png'); ?>'>");
    </script>

<?= $this->endSection('content'); ?>