<?= $this->extend('layouts/templateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>

<div class="container">
    <div class="row">
        <h2 class="judul-data">Detail Laporan Masyarakat</h2>
        <div class="col">
            <div class="card my-3">
                <div class="card-body width: 100px">
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-danger" role="alert">
                            <h4>Periksa Entrian Form</h4>
                            </hr />
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="<?= base_url('/Admin/terimaLaporan/' . $laporan->id_pelaporan); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="nama_pelapor" id="nama_pelapor" placeholder="nama" value="<?= $laporan->nama_pelapor; ?>" readonly>
                            <label for="nama_pelapor" class="form-label">Nama Pelapor</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="pelapor" id="pelapor" placeholder="nama" value="<?= $laporan->pelapor; ?>" readonly>
                            <label for="pelapor" class="form-label">Pelapor</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="lokasi" value="<?= $laporan->lokasi; ?>" readonly>
                            <label for="lokasi" class="form-label">Lokasi</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="longitude" id="lokasi" placeholder="longitude" value="<?= $laporan->longitude; ?>" readonly>
                            <label for="longitude" class="form-label">Longitude</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="latitude" id="lokasi" placeholder="latitude" value="<?= $laporan->latitude; ?>" readonly>
                            <label for="latitude" class="form-label">Latitude</label>
                        </div>
                        <br>
                        <i style="color: red;">*Silahkan tentukan jenis kerusakan berdasarkan bukti yang dikirimkan pelapor</i>
                        <div class="form-floating my-3">
                            <select class="form-control" id="jenis_kerusakan" name="jenis_kerusakan" required>
                                <?php foreach ($kategori as $value) { ?>
                                    <option selectes value="<?= $value->kerusakan; ?>"><?= $value->kerusakan; ?></option>
                                <?php } ?>
                            </select>
                            <label for="floatingSelect">---Pilih Jenis Kerusakan---</label>
                        </div>
                        <div class="form-floating my-3">
                            <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="deskripsi" readonly><?= $laporan->deskripsi; ?></textarea>
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                        </div>
                        <div class="form my-3">
                            <label for="bukti" class="form-label">Bukti</label>
                            <input type="text" class="form-control" name="bukti" id="bukti" placeholder="bukti" value="<?= $laporan->bukti; ?>" readonly>
                            <img width="100px" src="<?= base_url('uploads/bukti/' . $laporan->bukti); ?>" alt="">
                        </div>
                        <div>
                            <button id="button" type="submit" class="btn btn-success">Terima</button>
                            <a id="button" href="<?= base_url(); ?>Admin/tolakLaporan/<?= $laporan->id_pelaporan; ?>" class="btn btn-danger">Tolak</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('contentAdmin'); ?>