<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid wrap-content">
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

    <?php foreach ($bangunan as $value) { ?>
        $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $value->json); ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        opacity: 1.0,
                        color: 'black',
                        fillOpacity: 0.5,
                        fillColor: '<?= $value->warna; ?>'
                    }
                },
            }).addTo(map);

            geoLayer.eachLayer(function(layer) {
                layer.bindPopup("Nama : <?= $value->nama; ?><br>" +
                    "Lebar Bawah : <?= $value->lebar_bawah; ?><br>" +
                    "Lebar Atas : <?= $value->lebar_atas; ?><br>" +
                    "Keterangan : <?= $value->keterangan; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "Kondisi : <?= $value->kondisi; ?><br>" +
                    "<img id='fotoPeta' src='<?= base_url('uploads/fotoIrigasi/bangunanIrigasi/' . $value->foto); ?>' >");
            });
        });
    <?php } ?>
</script>

<?= $this->endSection('content'); ?>