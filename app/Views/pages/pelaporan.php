<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card my-3">
                <div class="card-body width: 100px">
                    <h2 class="my-3">Form Pelaporan Kerusakan Irigasi</h2>
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
                            <label for="nama_pelapor" class="form-label">Nama</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="lokasi" required>
                            <label for="lokasi" class="form-label">Lokasi</label>
                        </div>
                        <div class="form-floating my-3">
                            <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="deskripsi" required></textarea>
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                        </div>
                        <div class="form my-3">
                            <label for="bukti" class="form-label">Bukti</label>
                            <input type="file" class="form-control" name="bukti" id="bukti" placeholder="bukti" required>
                        </div>
                        <button type="submit" id="button" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>