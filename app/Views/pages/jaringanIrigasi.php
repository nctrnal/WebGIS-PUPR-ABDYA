<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-body">
            <div id="map" style="height: 600px;"></div>
        </div>
    </div>
</div>

<script>
    const map = L.map('map').setView([3.696924, 96.885114], 11);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    map.dragging.enable();

    <?php foreach ($jaringan as $value) { ?>
        $.getJSON("<?= base_url('geoJson/jaringanIrigasi/' . $value->json); ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        opacity: 1.0,
                        color: '<?= $value->warna; ?>',
                    }
                },
            }).addTo(map);

            geoLayer.eachLayer(function(layer) {
                geoLayer.bindPopup("Nama : <?= $value->nama; ?><br>" +
                    "Panjang : <?= $value->panjang; ?><br>" +
                    "Kodisi : <?= $value->kondisi; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "<img src='<?= base_url('uploads/fotoIrigasi/jaringanIrigasi/' . $value->foto); ?>'>");
            });
        });
    <?php } ?>
</script>

<?= $this->endSection('content'); ?>