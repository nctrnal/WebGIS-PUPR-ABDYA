<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <div style="margin-bottom: 1cm;">
                <h2>Pelaporan Kerusakan Irigasi</h2>
            </div>
            <div style="margin-bottom: 2cm;">
                <h6>Petunjuk Pengisian Form</h6>
                <ul>
                    <li>
                        <p>Mohon isikan data dengan benar, data yang dikirimkan harus dapat dipertanggung jawabkan</p>
                    </li>
                    <li>
                        <p>Foto sebaiknya diambil menggunakan <a href="https://play.google.com/store/apps/details?id=com.jkfantasy.gpsmapcamera">MAPs CAM</a></p>
                    </li>
                    <li>
                        <p>Data yang dikirimkan hanya digunakan untuk keperluan validasi pelaporan</p>
                    </li>
                    <li>
                        <p>Saat membuat laporan kerusakan, diharapkan GPS dari perangkat yang digunakan dalam keadaan hidup </p>
                    </li>
                </ul>
            </div>
            <div style="color:red;">
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="mt-3 alert alert-error alert-dismissible fade show" role="alert">
                        <?php echo session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <form method="post" action="<?= base_url(); ?>/Admin/saveLaporan" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-floating my-3">
                    <input type="text" class="form-control" name="nama_pelapor" id="nama_pelapor" placeholder="nama" required autofocus>
                    <label for="nama_pelapor" class="form-label">Nama Pelapor</label>
                </div>
                <div class="form-floating my-3">
                    <select class="form-control" id="pelapor" name="pelapor" required>
                        <option value="Petani" selected>Petani</option>
                        <option value="POB (Penjaga Operasi Bendung)">POB (Penjaga Operasi Bendung)</option>
                        <option value="PPA (Penjaga Pintu Air)">PPA (Penjaga Pintu Air)</option>
                        <option value="Masyarakat Umum">Masyarakat Umum</option>
                    </select>
                    <label for="floatingSelect">---Pilih Identitas Pelapor---</label>
                </div>
                <div class="form-floating my-3">
                    <textarea style="height: 200px;" class="form-control" name="lokasi" id="lokasi" placeholder="lokasi" required></textarea>
                    <label for="lokasi" class="form-label">Lokasi</label>
                </div>
                <div class="form-floating my-3">
                    <textarea style="height: 150px;" class="form-control" name="deskripsi" id="deskripsi" placeholder="deskripsi" required></textarea>
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                </div>
                <div class="form my-3">
                    <small style="color: red;">Note : <em>Silahkan tekan "koordinat" untuk mendapatkan koordinat saat ini</em></small><br>
                    <label for="koordinat" class="form-label">Koordinat</label>
                    <input onclick="getLocation()" type="text" class="form-control" name="koordinat" id="koordinat" placeholder="koordinat" style="width: 200px;" required readonly>
                </div>
                <div class="form my-3">
                    <label for="bukti" class="form-label">Bukti</label>
                    <input type="file" class="form-control" name="bukti" id="bukti" placeholder="bukti" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="button" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var x = document.getElementById("koordinat");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("browser anda tidak support");
        }
    }

    function showPosition(position) {
        x.value = position.coords.latitude + " , " + position.coords.longitude;
    }
</script>

<?= $this->endSection('content'); ?>