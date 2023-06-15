<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
  <h1 style="
      text-align: center;
      margin-top: 1cm;
      margin-bottom: 1cm;
      align-content: center;
    ">
    SISTEM INFORMASI PERSEBARAN IRIGASI DI KABUPATEN ACEH BARAT DAYA
  </h1>
</div>

<div class="container">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
      <div style="background-color: #69b69e;" class="card" id="peta_home">
        <a href="/pages/daerahIrigasi">
          <img width="250px" height="250px" src="<?= base_url('img/daerahIrigasi.png'); ?>" class="card-img-top" alt="...">
        </a>
        <div class="card-body">
          <h5 class="card-title justify-content-center">Daerah Irigasi</h5>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card" style="background-color: #69b69e;">
        <a href="/pages/jaringanIrigasi">
          <img width="250px" height="250px" src="<?= base_url('img/jaringanIrigasi.png'); ?>" class="card-img-top" alt="...">
        </a>
        <div class="card-body">
          <h5 class="card-title justify-content-center">Jaringan Irigasi</h5>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card" style="background-color: #69b69e;">
        <a href="/pages/bangunanIrigasi">
          <img width="250px" height="250px" src="<?= base_url('img/bangunanIrigasi.png'); ?>" class="card-img-top" alt="...">
        </a>
        <div class="card-body">
          <h5 class="card-title justify-content-center">Bangunan Irigasi</h5>
        </div>
      </div>
    </div>
  </div>
</div>

<h1 style="margin-top: 1cm; margin-bottom: 1cm; text-align: center; background-color: #69b69e">BERITA</h1>
<div class="container">
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

  <div class="container">
    <div class="row">
      <?php foreach ($berita1 as $a) { ?>
        <div class="col-md-4 mb-3">
          <div class="card" id="card-berita-home">
            <div class="position-absolute p-2 text-white" style="background-color: rgba(0, 0, 0, 0.7)">
              <a class="text-decoration-none text-white"><?= $a->kategori; ?></a>
            </div>
            <div style="max-height: 350px; overflow: hidden">
              <img src="<?= base_url('uploads/berita/' . $a->foto); ?>" alt="<?= $a->kategori; ?>" class="img-fluid" />
            </div>
            <div class="card-body">
              <h5 class="card-title">
                <a href="/Pages/berita/<?= $a->id_berita; ?>" class="text-decoration-none text-dark">
                  <?= $a->judul; ?>
                </a>
              </h5>
              <p>
                <small>
                  Diupload oleh
                  <span class="text-decoration-none">
                    <?= $a->penulis; ?> pada
                  </span>
                  <?= $a->created_at; ?>
                </small>
              </p>
              <span class="card-text"><?= substr($a->body, 0, 100); ?>...</span><br />
              <a id="button" style="margin-top: 10px" href="/Pages/berita/<?= $a->id_berita; ?>" class="btn btn-primary">Read more...</a>
            </div>
          </div>
        </div>
      <?php } ?>
      <div style="align-content: center">
        <?= $pager->links('berita1', 'pagination'); ?>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection('content'); ?>