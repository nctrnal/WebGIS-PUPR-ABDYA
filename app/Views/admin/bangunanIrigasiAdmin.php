<?= $this->extend('layouts/templateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>


<div class="container-fluid">
    <button class="btn btn-primary mt-1"><i class="bi bi-pen "></i> Edit</button>
    <div class="card mt-3">
        <div class="card-body">
            <div id="map" style="height: 600px;"></div>
        </div>
    </div>
</div>

<script>
    const map = L.map('map').setView([3.837549, 96.871154], 11);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {})
        .addTo(map);
</script>

<?= $this->endSection('contentAdmin'); ?>