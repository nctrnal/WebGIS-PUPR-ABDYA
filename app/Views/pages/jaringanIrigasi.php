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
        layers: [osm]
    });

    //Layer Control For Base Layer
    var baseLayers = {
        'OpenStreetMap': osm,
        'ESRI': Esri_WorldImagery
    };

    var layerControl = L.control.layers(baseLayers);

    //Iterasi untuk menampilkan semua SHP yang ada di database
    // var jaringan = L.layerGroup();

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
                    "Panjang : <?= $value->panjang; ?> Meter <br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br><br>" +
                    "<img id='fotoPeta' src='<?= base_url('uploads/fotoIrigasi/jaringanIrigasi/' . $value->foto); ?>'>");
            });
            layerControl.addOverlay(geoLayer, "<?= $value->nama; ?>");
        });
    <?php } ?>

    layerControl.addTo(map);
</script>

<?= $this->endSection('content'); ?>