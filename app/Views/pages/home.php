<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card my-3" id="card-berita-home">
                <div id="berita">
                    <img src="<?= base_url('uploads/berita/' . $berita->foto); ?>" alt="" id="img-berita-card">
                </div>
                <div class="card-body text-center">
                    <h3 class="card-title"><a href="/Pages/berita/<?= $berita->id_berita; ?>" class="text-decoration-none text-dark"><?= $berita->judul; ?></a></h3>
                    <p class="d-flex-center">
                        <small class="desc">
                            Diupload oleh <span class="text-decoration-none"> <?= $berita->penulis; ?> </span> dengan kategori <span class="text-decoration-none"> <?= $berita->kategori; ?></span> pada <?= $berita->created_at; ?>
                        </small>
                    </p>
                    <p class="card-text"><?= substr($berita->body, 0, 100); ?>...</p>
                    <a style="margin-top: 10px;" href="/Pages/berita/<?= $berita->id_berita; ?>" id="button" class="text-decoration-none btn btn-primary">Read more..</a>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <?php foreach ($berita1 as $a) { ?>
                        <div class="col-md-4 mb-3">
                            <div class="card" id="card-berita-home">
                                <div class="position-absolute  p-2 text-white" style="background-color: rgba(0, 0, 0, 0.7)"><a class="text-decoration-none text-white"><?= $a->kategori; ?></a></div>
                                <div style="max-height: 350px; overflow:hidden">
                                    <img src="<?= base_url('uploads/berita/' . $a->foto); ?>" alt="<?= $a->kategori; ?>" class="img-fluid">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><a href="/Pages/berita/<?= $a->id_berita; ?>" class="text-decoration-none text-dark"> <?= $a->judul; ?> </a></h5>
                                    <p>
                                        <small>
                                            Diupload oleh <span class="text-decoration-none"> <?= $a->penulis; ?> pada </span> <?= $a->created_at; ?>
                                        </small>
                                    </p>
                                    <span class="card-text"><?= substr($a->body, 0, 100); ?>...</span><br>
                                    <a id="button" style="margin-top: 10px;" href="/Pages/berita/<?= $a->id_berita; ?>" class="btn btn-primary">Read more...</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>