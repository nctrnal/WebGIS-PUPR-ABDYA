<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 style="margin-top: 1cm; margin-bottom: 10pt">Data Irigasi</h2>
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Daerah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($berkas as $value) {
                    ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $value->namaDaerah; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>/Pages/detail/<?= $value->id; ?>" class="btn btn-success"><i class="bi bi-arrow-up-right"></i> Detail</a>
                                <a href="<?= base_url(); ?>/Berkas/download/<?= $value->id; ?>" class="btn btn-primary"><i class="bi bi-download"></i> Download</a>
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

<?= $this->endSection('content'); ?>