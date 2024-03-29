<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <article>
                <h2><?= $detail->judul; ?></h2>
                <div style="max-height: 350px; overflow:hidden">
                    <img id="img-berita" src="<?= base_url('uploads/berita/' . $detail->foto); ?>" alt="<?= $detail->judul; ?>" class="img-fluid">
                </div>
                <p>Diupload oleh <span class="text-decoration-none"> <?= $detail->penulis; ?> </span> dengan kategori <span class="text-decoration-none"> <?= $detail->kategori; ?></span> pada <?= $detail->created_at; ?></p>
                <article class="my-3 fs-5">
                    <?= $detail->body; ?>
                </article>
            </article>
            <a href="/" class="btn btn-success" id="button"><span data-feather="arrow-left"></span>Back to Home</a>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>