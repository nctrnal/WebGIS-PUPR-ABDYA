<?= $this->extend('layouts/templateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3">Laporan Masuk</h2>
            <a id="button" class="btn btn-primary mb-3" href="/Admin/laporanDiterima">
                <i class="bi bi-journal-check"> Laporan Diterima</i>
            </a>
            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-bordered table-striped">
                <thead class="bg-secondary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Kerusakan</th>
                        <th scope="col">Tanggal Laporan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no  = 1;
                    foreach ($laporan as $value) {
                    ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $value->lokasi; ?> </td>
                            <td><?= $value->deskripsi; ?> </td>
                            <td><?= $value->created_at; ?> </td>
                            <td>
                                <a href="<?= base_url(); ?>/Admin/detailLaporan/<?= $value->id_pelaporan; ?>" class="btn btn-success">Detail</a>
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