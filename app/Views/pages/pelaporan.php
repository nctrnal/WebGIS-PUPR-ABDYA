<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<style>
    .preview-image {
        max-width: 150px;
        max-height: 150px;
    }
</style>

<div class="container">
    <div class="card my-3">
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
                        <p>Foto sebaiknya diambil menggunakan <a href="https://play.google.com/store/apps/details?id=com.jkfantasy.gpsmapcamera">MAPs CAM</a>, atau dapat menggunakan kamera default yang dapat menyimpan informasi lokasi</p>
                    </li>
                    <li>
                        <p>Data yang dikirimkan hanya digunakan untuk keperluan validasi pelaporan</p>
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
                    <label for="gambar"><strong>Tambah Gambar</strong><a href="#"></a></label>
                    <label for="ket.gambar">(Silahkan Masukkan gambar dari GPS Map Camera, Open Camera, dan GPS Map)</label>
                    <label for="bukti" class="form-label">Bukti</label>
                    <input type="file" class="form-control" name="bukti" id="bukti" placeholder="bukti" onchange="previewImage(event)" required>
                </div>
                <div id="preview-container"></div>
                <div id="error-message" class="error-message"></div>
                <div class="modal-footer"></div>
                <div class="form my-3">
                    <label for="latitude"><strong>Latitude</strong><a href="#">*</a></label>
                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Silahkan masukkan gambar dari gps map" rows="3" readonly required>
                </div>
                <div class="form my-3">
                    <label for="longitude"><strong>Longitude</strong><a href="#">*</a></label>
                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Silahkan masukkan gambar dari gps map" rows="3" readonly required>
                </div>
                <button type="submit" id="button" class="btn btn-success">Submit</button>
        </div>
        </form>
    </div>
</div>

<!-- untuk baca koordinat kamera -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/2.3.0/exif.min.js"></script>

<script>
    // script gambar
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function() {
            var imgElement = document.createElement('img');
            imgElement.setAttribute('src', reader.result);
            imgElement.setAttribute('class', 'preview-image');
            var previewContainer = document.getElementById('preview-container');
            previewContainer.innerHTML = '';
            previewContainer.appendChild(imgElement);

            getCoordinates(input.files[0]);
        };

        reader.readAsDataURL(input.files[0]);
    }

    function getCoordinates(file) {
        if (file) {
            EXIF.getData(file, function() {
                var latitude = EXIF.getTag(this, 'GPSLatitude');
                var longitude = EXIF.getTag(this, 'GPSLongitude');

                if (latitude && longitude) {
                    latitude = convertToDecimal(latitude);
                    longitude = convertToDecimal(longitude);

                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;
                    document.getElementById('error-message').textContent = "";
                    document.getElementById('simpan-data').disabled = false;
                } else {
                    document.getElementById('latitude').value = "";
                    document.getElementById('longitude').value = "";
                    document.getElementById('error-message').textContent = "Koordinat tidak ditemukan dalam metadata foto.";
                    document.getElementById('simpan-data').disabled = true;
                }
            });
        }
    }


    function convertToDecimal(coordinates) {
        var degrees = coordinates[0].numerator;
        var minutes = coordinates[1].numerator;
        var seconds = coordinates[2].numerator / coordinates[2].denominator;

        var decimalDegrees = degrees + (minutes / 60) + (seconds / 3600);

        return decimalDegrees.toFixed(6);
    }
</script>

<?= $this->endSection('content'); ?>