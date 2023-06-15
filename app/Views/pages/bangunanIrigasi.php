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
                    "Lebar Bawah : <?= $value->lebar_bawah; ?> cm <br>" +
                    "Lebar Atas : <?= $value->lebar_atas; ?> cm <br>" +
                    "Keterangan : <?= $value->keterangan; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "Kondisi : <?= $value->kondisi; ?><br>");
            });
        });
    <?php } ?>

    var legend = L.control({
        position: "topright"
    });

    legend.onAdd = function(map) {
        var div = L.DomUtil.create("div", "legend");
        div.innerHTML += "<h4>Tegnforklaring</h4>";
        div.innerHTML += '<i style="background: #477AC2"></i><span>Water</span><br>';
        div.innerHTML += '<i style="background: #448D40"></i><span>Forest</span><br>';
        div.innerHTML += '<i style="background: #E6E696"></i><span>Land</span><br>';
        div.innerHTML += '<i style="background: #E8E6E0"></i><span>Residential</span><br>';
        div.innerHTML += '<i style="background: #FFFFFF"></i><span>Ice</span><br>';
        div.innerHTML += '<i class="icon" style="background-image: url(https://d30y9cdsu7xlg0.cloudfront.net/png/194515-200.png);background-repeat: no-repeat;"></i><span>Grænse</span><br>';
        return div;
    };
    legend.addTo(map);
</script>

<?= $this->endSection('content'); ?>