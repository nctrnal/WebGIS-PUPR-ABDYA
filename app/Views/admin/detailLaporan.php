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
                    <form method="post" action="<?= base_url('/Admin/terimaLaporan'); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="nama_pelapor" id="nama_pelapor" placeholder="nama" value="<?= $laporan->nama_pelapor; ?>" disabled>
                            <label for="nama_pelapor" class="form-label">Nama Pelapor</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="lokasi" value="<?= $laporan->lokasi; ?>" disabled>
                            <label for="lokasi" class="form-label">Lokasi</label>
                        </div>
                        <div class="form-floating my-3">
                            <select class="form-control" id="jenis_kerusakan" name="jenis_kerusakan" aria-label="Floating label select" disabled>
                                <option selected value="<?= $laporan->jenis_kerusakan; ?>"><?= $laporan->jenis_kerusakan; ?></option>
                                <option value="Sedang">Sedang</option>
                                <option value="Berat">Berat</option>
                            </select>
                            <label for="floatingSelect">--Pilih Jenis Kerusakan--</label>
                        </div>
                        <div class="form-floating my-3">
                            <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="deskripsi" disabled><?= $laporan->deskripsi; ?></textarea>
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                        </div>
                        <div class="form my-3">
                            <label for="bukti" class="form-label">Bukti</label>
                            <input type="file" class="form-control" name="bukti" id="bukti" placeholder="bukti" value="<?= base_url('uploads/bukti/.' . $laporan->bukti); ?>" disabled>
                            <img width="100px" src="<?= base_url('uploads/bukti/' . $laporan->bukti); ?>" alt="">
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('contentAdmin'); ?>