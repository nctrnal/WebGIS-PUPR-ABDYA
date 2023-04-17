<?= $this->extend('layouts/templateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>

<div class="container">
    <div class="row">
        <h2 class="judul-data">Update Jaringan Irigasi</h2>
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
                    <form method="post" action="<?= base_url('/Irigasi/simpanUbahJaringanIrigasi/' . $irigasi->id); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?= $irigasi->nama; ?>" required>
                            <label for="nama" class="form-label">Nama Daerah</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="number" class="form-control" name="panjang" id="panjang" placeholder="panjang" value="<?= $irigasi->panjang; ?>" required>
                            <label for="panjang" class="form-label">Panjang Jaringan Irigasi</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="kecamatan" value="<?= $irigasi->kecamatan; ?>" required>
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                        </div>
                        <div class="form my-3">
                            <label for="json" class="form-label">File json</label>
                            <input type="file" class="form-control" name="json" id="json" placeholder="json" value="<?= $irigasi->json; ?>" required>
                        </div>
                        <div class="form-floating my-3">
                            <input type="color" class="form-control" name="warna" id="warna" placeholder="warna" required>
                            <label for="warna" class="form-label">Warna Layer</label>
                        </div>
                        <div class="form my-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto" placeholder="foto" value="<?= $irigasi->foto; ?>" required>
                        </div>
                        <button id="button" type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('contentAdmin'); ?>