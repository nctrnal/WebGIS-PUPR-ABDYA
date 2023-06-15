<?= $this->extend('layouts/templateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>

<div class="container">
    <div class="row">
        <h2 class="judul-data">Update Daerah Irigasi</h2>
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
                    <form method="post" action="<?= base_url('/Irigasi/simpanUbahDaerahIrigasi/' . $daerah->id); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?= $daerah->nama; ?>" required>
                            <label for="nama" class="form-label">Nama Daerah</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="number" class="form-control" name="luas" id="luas" placeholder="luas" value="<?= $daerah->luas; ?>" required>
                            <label for="luas" class="form-label">Luas</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="kecamatan" value="<?= $daerah->kecamatan; ?>" required>
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                        </div>
                        <div class="form my-3">
                            <label for="json" class="form-label">File json</label>
                            <input type="file" class="form-control" name="json" id="json" placeholder="json" value="<?= $daerah->json; ?>" required>
                        </div>
                        <div class="form-floating my-3">
                            <input type="color" class="form-control" name="warna" id="warna" placeholder="warna" required>
                            <label for="warna" class="form-label">Warna Layer</label>
                        </div>
                        <button id="button" type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('contentAdmin'); ?>