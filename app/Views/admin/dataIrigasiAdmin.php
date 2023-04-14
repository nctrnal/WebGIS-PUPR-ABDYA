<?= $this->extend('layouts/templateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3">DATA</h2>
            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <button id="button" type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#tambahData">
                <i class="bi bi-plus-square"></i> Tambah Data
            </button>
            <table class="table table-bordered table-striped">
                <thead class="bg-secondary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no  = 1;
                    foreach ($berkas as $value) {
                    ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td> <?= $value->namaDaerah; ?> </td>
                            <td>
                                <a href="<?= base_url(); ?>Berkas/update/<?= $value->id; ?>" class="btn btn-success mx-1px">Update</a>
                                <a href="<?= base_url(); ?>Berkas/delete/<?= $value->id; ?>" class="btn btn-danger mx-1px">Delete</a>
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
<div class="modal fade" id="tambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url(); ?>/Berkas/save" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="namaDaerah" class="form-label">Nama Daerah</label>
                        <input type="text" class="form-control" id="namaDaerah" name="namaDaerah" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="pdf" class="form-label">Data</label>
                        <input type="file" class="form-control" id="pdf" name="pdf">
                    </div>
                    <button id="button" type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection('contentAdmin'); ?>