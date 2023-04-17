<?= $this->extend('layouts/templateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>
<div class="container">
    <h2 class="mt-3">DATA JARINGAN IRIGASI</h2>
    <div class="col">
        <button id="button" type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#tambahJaringan">
            <i class="bi bi-plus-square"></i> Tambah Data
        </button>
        <div class="row">

            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Periksa Entrian Form</h4>
                    </hr />
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <input type="text" class="cd-search table-filter" data-table="table" placeholder="Cari" />
            <table class="table table-bordered table-striped">
                <thead class="bg-secondary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Daerah</th>
                        <th scope="col">Panjang Jaringan (meter)</th>
                        <th scope="col">Kondisi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no  = 1;
                    foreach ($jaringan as $value) {
                    ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $value->nama; ?></td>
                            <td><?= $value->panjang; ?></td>
                            <td><?= $value->kecamatan; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>/Irigasi/ubahJaringanIrigasi/<?= $value->id; ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i> Detail</a>
                                <a href="<?= base_url(); ?>/Irigasi/hapusJaringanIrigasi/<?= $value->id; ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Modal Upload -->
<div class="modal fade" id="tambahJaringan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url(); ?>/Irigasi/simpanJaringanIrigasi" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" required autofocus>
                        <label for="nama" class="form-label">Nama Daerah</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="number" class="form-control" name="panjang" id="panjang" placeholder="panjang" required>
                        <label for="panjang" class="form-label">Panjang Jaringan Irigasi</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="kecamatan" required autofocus>
                        <label for="kecamatan" class="form-label">Kecamatan</label>
                    </div>
                    <div class="form my-3">
                        <label for="json" class="form-label">File json</label>
                        <input type="file" class="form-control" name="json" id="json" placeholder="json" required>
                    </div>
                    <div class="form-floating my-3">
                        <input type="color" class="form-control" name="warna" id="warna" placeholder="warna" required>
                        <label for="warna" class="form-label">Warna Layer</label>
                    </div>
                    <div class="form my-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" name="foto" id="foto" placeholder="foto" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('contentAdmin'); ?>