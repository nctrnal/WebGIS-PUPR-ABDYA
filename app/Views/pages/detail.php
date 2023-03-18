<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card text-center" style="width: auto;">

                <div class="text-center mt-3">
                    <img src="/img/irigasi/<?= $berkas->id; ?>.png" class="rounded" alt="...">
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>