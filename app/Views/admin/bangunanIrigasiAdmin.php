<?= $this->extend('layouts/templateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>
<div class="container">
    <h2 class="mt-3">Data Bangunan Irigasi</h2>
    <div class="col">
        <button id="button" type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#tambahBangunan">
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
            <input type="text" class="cd-search table-filter" data-table="table" placeholder="Cari" />
            <table class="table table-bordered table-striped">
                <thead class="bg-secondary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Daerah</th>
                        <th scope="col">Lebar Atas (cm)</th>
                        <th scope="col">Lebar Bawah (cm)</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Kondisi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no  = 1;
                    foreach ($bangunan as $value) {
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
                                <a href="<?= base_url(); ?>/Irigasi/ubahBangunanIrigasi/<?= $value->id; ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i> Update</a>
                                <a href="<?= base_url(); ?>/Irigasi/hapusBangunanIrigasi/<?= $value->id; ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</a>
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


<!-- Modal Upload -->
<div class="modal fade" id="tambahBangunan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url(); ?>/Irigasi/simpanBangunanIrigasi" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" autofocus required>
                        <label for="nama" class="form-label">Nama Daerah</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="number" step="0.01" value="0.00" class="form-control" name="lebar_bawah" id="lebar_bawah" placeholder="lebar_bawah" required>
                        <label for="lebar_bawah" class="form-label">Lebar Bawah Bangunan Irigasi</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="number" step="0.01" value="0.00" class="form-control" name="lebar_atas" id="lebar_atas" placeholder="lebar_atas" required>
                        <label for="lebar_atas" class="form-label">Lebar Atas Bangunan Irigasi</label>
                    </div>
                    <div class="form-floating my-3">
                        <select class="form-control" id="keterangan" name="keterangan" required>
                            <option value="Bendung" selected>Bendung</option>
                            <option value="Jembatan">Jembatan</option>
                            <option value="Bangunan Bagi">Bangunan Bagi</option>
                            <option value="Gorong-Gorong">Gorong-Gorong</option>
                            <option value="Intake">Intake</option>
                            <option value="Sedimentasi">Sedimentasi</option>
                            <option value="Box Bagi">Box Bagi</option>
                            <option value="Primer">Primer</option>
                            <option value="Pintu Penguras">Pintu Penguras</option>
                            <option value="Lining">Lining</option>
                            <option value="Lantai">Lantai</option>
                        </select>
                        <label for="floatingSelect">---Pilih Keterangan---</label>
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
                    <div class="form-floating my-3">
                        <select class="form-control" id="warna" name="warna" required>
                            <option value="#dc143c" selected>(Bendungan) Merah</option>
                            <option value="#efef10">(Jembatan) Kuning</option>
                            <option value="#27ef10">(Bangunan Bagi) Hijau</option>
                            <option value="#10efef">(Gorong-Gorong) Biru</option>
                            <option value="#e010ef">(Intake) Ungu</option>
                            <option value="#000000">(Sedimentasi) Hitam</option>
                            <option value="#473a07">(Box Bagi) Coklat</option>
                            <option value="#070747">(Primer) Biru Tua</option>
                            <option value="#7b7c7c">(Pintu Penguras) Abu-Abu</option>
                            <option value="#ffffff">(lining) Putih</option>
                            <option value="#ea93bf">(Lantai) Merah Muda</option>
                        </select>
                        <label for="floatingSelect">---Pilih Identitas Pelapor---</label>
                    </div>
                    <button id="button" type="submit" class="btn btn-primary" value="Simpan"><i class="bi bi-upload"></i> Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection('contentAdmin'); ?>