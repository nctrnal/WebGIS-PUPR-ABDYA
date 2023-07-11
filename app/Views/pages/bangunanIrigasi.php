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
    var bendung =
        <?php foreach ($bendung as $b) { ?>
    $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $b->json); ?>", function(data) {
        geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    opacity: 1.0,
                    color: '<?= $b->warna; ?>',
                }
            },
        });

        geoLayer.eachLayer(function(layer) {
            geoLayer.bindPopup("Nama    : <?= $b->nama; ?><br>" +
                "Lebar Bawah : <?= $b->lebar_bawah; ?> Meter <br>" +
                "Lebar Atas : <?= $b->lebar_atas; ?> Meter <br>" +
                "Keterangan : <?= $b->keterangan; ?> Meter <br>" +
                "Kondisi    : <?= $b->kondisi; ?> Meter <br>" +
                "Kecamatan : <?= $b->kecamatan; ?><br><br>");
        });
    });
    <?php } ?>

    var bangunan = L.layerGroup([bendung]);

    // Base Map
    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    });

    //Default Base Map
    var map = L.map('map', {
        center: [3.696924, 96.885114],
        zoom: 11,
        layers: [osm, bangunan]
    });

    //Layer Control For Base Layer
    var baseLayers = {
        'OpenStreetMap': osm,
        'ESRI': Esri_WorldImagery
    };

    // Control Layer for Legend
    var overlays = {
        'Bangunan Irigasi': bangunan,
    };

    //Geojson


    // Legend


    //Add Control Layer
    var layerControl = L.control.layers(baseLayers, overlays).addTo(map);
</script>

<?= $this->endSection('content'); ?>