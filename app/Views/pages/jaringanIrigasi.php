<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div id="map" style="height: 400px;"></div>

<script>
    const map = L.map('map').setView([5.554534278964322, 95.3172003330198], 15);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {})
        .addTo(map);
</script>

<?= $this->endSection('content'); ?>