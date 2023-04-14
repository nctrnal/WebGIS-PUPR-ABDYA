<?= $this->extend('layouts/templateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 style="margin-top: 1cm;">Daftar Berita</h2>
            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <a id="button" href="<?= base_url(); ?>/Admin/berita" class="btn btn-primary my-3">Tambah Berita</a>
            <table class="table table-bordered">
                <thead class="bg-secondary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">penulis</th>
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
                                <a href="<?= base_url(); ?>Admin/update/<?= $value->id_berita; ?>" class="btn btn-success mx-1px">Update</a>
                                <a href="<?= base_url(); ?>Admin/delete/<?= $value->id_berita; ?>" class="btn btn-danger mx-1px">Delete</a>
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


<div class="container">
    <div class="row">
        <div class="col">
            <div id="summernote">
                <p>summenote</p>
            </div>
        </div>
    </div>
</div>

<script>
    $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>

<?= $this->endSection('contentAdmin'); ?>