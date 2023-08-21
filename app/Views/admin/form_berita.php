<?= $this->extend('layouts/templateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>

<style>
    #container {
        width: 1000px;
        margin: 20px auto;
    }

    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
    }

    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>


<div class="container">
    <div class="row">
        <div class="col">
            <div class="card my-3">
                <div class="card-body width: 100px">
                    <h2 class="my-3">Tambah Berita</h2>
                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                        <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="mt-3 alert alert-error alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="<?= base_url(); ?>/Admin/tambahBerita" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="judul" required autofocus>
                            <label for="judul" class="form-label">Judul</label>
                        </div>
                        <div class="form-floating my-3">
                            <select class="form-control" id="kategori" name="kategori" required>
                                <?php foreach ($kategori as $value) { ?>
                                    <option selectes value="<?= $value->kategori; ?>"><?= $value->kategori; ?></option>
                                <?php } ?>
                            </select>
                            <label for="floatingSelect">---Pilih Kategori---</label>
                        </div>
                        <div class="form my-3">
                            <label for="body" class="form-label">Body</label>
                            <textarea class="form-control" style="height: 100px;" name="body" id="body" placeholder="body" required></textarea>
                        </div>
                        <div class="form my-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto" placeholder="foto" required>
                        </div>
                        <button id="button" type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script>

</script>

<?= $this->endSection('contentAdmin'); ?>