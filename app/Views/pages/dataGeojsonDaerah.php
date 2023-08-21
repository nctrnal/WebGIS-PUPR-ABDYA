<?= $this->extend('layouts/template'); ?>

<script src='https://unpkg.com/@turf/turf@6/turf.min.js'></script>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 style="margin-top: 1cm; margin-bottom: 10pt">Geojson Daerah Irigasi</h2>
            <input type="text" class="cd-search table-filter" data-table="table" placeholder="Cari" />
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Daerah</th>
                        <th>Kecamatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($daerah as $value) {
                    ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $value->nama; ?></td>
                            <td><?= $value->kecamatan; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>Berkas/downloadDaerahGeojson/<?= $value->id; ?>" class="btn btn-primary"><i class="bi bi-download"></i> GeoJSON </a>
                                <a id="convert" href="<?= base_url(); ?>downloadShapefile/convert/<?= $value->id; ?>" class="btn btn-primary"><i class="bi bi-download"></i> Shapefile
                                </a>
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


<script src="<?= base_url('js/convert.js'); ?>"></script>

<?= $this->endSection('content'); ?>