<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <p class="my-3">Bagi masyarakat yang ingin membuat pengaduan<br>terkait kerusakan irigasi dapat membuat laporan<br>dengan menekan tombil berikut</p>
    <small style="color: red;">*Harap laporan yang dikirimkan dapat dipertanggung jawabkan</small><br>
    <button id="button" type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#laporKerusakan">
        <i class="bi bi-pen"></i> Buat Laporan
    </button>
    <div class="row">
        <div class="col">
            <div class="card my-3" id="card-berita-home">
                <div id="berita">
                    <img src="<?= base_url('uploads/berita/' . $berita->foto); ?>" alt="<?= $berita->kategori; ?>" id="img-berita-card" class="img-fluid">
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


<!-- Modal Upload -->
<div class="modal fade" id="laporKerusakan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Buat Laporan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                <form method="post" action="<?= base_url(); ?>/Admin/saveLaporan" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="nama_pelapor" id="nama_pelapor" placeholder="nama" required autofocus>
                        <label for="nama_pelapor" class="form-label">Nama Pelapor</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="lokasi" required>
                        <label for="lokasi" class="form-label">Lokasi</label>
                    </div>
                    <div class="form-floating my-3">
                        <textarea style="height: 300px;" class="form-control" name="deskripsi" id="deskripsi" placeholder="deskripsi" required></textarea>
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                    </div>
                    <div class="form my-3">
                        <label for="bukti" class="form-label">Bukti</label>
                        <input type="file" class="form-control" name="bukti" id="bukti" placeholder="bukti" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="button" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>