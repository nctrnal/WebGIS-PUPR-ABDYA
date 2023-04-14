<?= $this->extend('layouts/templateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>
<div class="container">
    <h2 class="mt-3">DATA DAERAH IRIGASI</h2>
    <div class="col">
        <button id="button" type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#tambahDaerah">
            <i class="bi bi-plus-square"></i> Tambah Data
        </button>
        <div class="row">
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Periksa Entrian Form</h4>
                    </hr />
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <!-- <div class="card">
                <div class="card-body"> -->
            <table class="table table-bordered table-striped">
                <thead class="bg-secondary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Daerah</th>
                        <th scope="col">Lebar Atas</th>
                        <th scope="col">Lebar Bawah</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Kondisi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no  = 1;
                    foreach ($daerah as $value) {
                    ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $value->nama; ?> </td>
                            <td><?= $value->lebar_atas; ?> </td>
                            <td><?= $value->lebar_bawah; ?> </td>
                            <td><?= $value->keterangan; ?> </td>
                            <td><?= $value->kecamatan; ?> </td>
                            <td><?= $value->kondisi; ?> </td>
                            <td>
                                <a href="<?= base_url(); ?>/Irigasi/ubahDaerahIrigasi/<?= $value->id; ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i> Detail</a>
                                <a href="<?= base_url(); ?>/Irigasi/hapusDaerahIrigasi/<?= $value->id; ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <!-- </div>
            </div> -->
        </div>
    </div>
</div>

<script>
    // function picker() {
    //     var pick = document.getElementById("pick").value;
    //     var warna = document.getElementById("warna");
    //     warna.value = pick;
    // }

    // document.getElementById("pick").addEventListener('change', function() {

    //     document.getElementById("warna").value = document.getElementById('pick').value;
    // })
</script>


<!-- Modal Upload -->
<div class="modal fade" id="tambahDaerah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url(); ?>/Irigasi/simpanDaerahIrigasi" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-floating my-3">
                        <input type="color" class="form-control" name="warna" id="warna" placeholder="warna" required>
                        <label for="warna" class="form-label">Warna Layer</label>
                    </div>
                    <!-- <div class="form-floating my-3">
                        <input type="text" class="form-control" name="warna" id="warna" placeholder="warna" readonly required>
                        <label for="warna" class="form-label">Warna Layer</label>
                    </div> -->
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" autofocus required>
                        <label for="nama" class="form-label">Nama Daerah</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="number" class="form-control" name="lebar_bawah" id="lebar_bawah" placeholder="lebar_bawah" required>
                        <label for="lebar_bawah" class="form-label">Lebar Bawah Daerah Irigasi</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="number" class="form-control" name="lebar_atas" id="lebar_atas" placeholder="lebar_atas" required>
                        <label for="lebar_atas" class="form-label">Lebar Atas Daerah Irigasi</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="keterangan" required>
                        <label for="keterangan" class="form-label">Keterangan</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="kecamatan" required>
                        <label for="kecamatan" class="form-label">Kecamatan</label>
                    </div>
                    <div class="form-floating my-3">
                        <select class="form-control" id="kondisi" name="kondisi" required>
                            <option disabled>--Kondisi--</option>
                            <?php foreach ($kategori as $value) { ?>
                                <option value="<?= $value->kerusakan; ?>"><?= $value->kerusakan; ?></option>
                            <?php } ?>
                        </select>
                        <label for="floatingSelect">---Kondisi---</label>
                    </div>
                    <div class="form my-3">
                        <label for="json" class="form-label">File json</label>
                        <input type="file" class="form-control" name="json" id="json" placeholder="json" required>
                    </div>
                    <div class="form my-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" name="foto" id="foto" placeholder="foto" required>
                    </div>
                    <button id="button" type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection('contentAdmin'); ?>