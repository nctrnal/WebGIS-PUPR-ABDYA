<?= $this->extend('layouts/templateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Daftar Berita</h2>
            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <a id="button" href="<?= base_url(); ?>/Admin/berita" class="btn btn-primary my-3"><i class="bi bi-plus-square"></i> Tambah Berita</a><br>
            <input type="text" class="cd-search table-filter" data-table="table" placeholder="Cari" />
            <table class="table table-bordered data-table">
                <thead class="bg-secondary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col" style="width:650px;">Judul</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Publish</th>
                        <th scope="col">aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no  = 1;
                    foreach ($berita as $value) {
                    ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td> <?= $value->judul; ?> </td>
                            <td> <?= $value->kategori; ?> </td>
                            <td> <?= $value->penulis; ?> </td>
                            <td> <?= $value->created_at; ?> </td>
                            <td id="aksi">
                                <a href="<?= base_url(); ?>Admin/update/<?= $value->id_berita; ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i> Update</a>
                                <a href="<?= base_url(); ?>Admin/delete/<?= $value->id_berita; ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</a>
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


<?= $this->endSection('contentAdmin'); ?>