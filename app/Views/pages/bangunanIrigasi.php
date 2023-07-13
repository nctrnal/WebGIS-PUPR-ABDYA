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

    //BENDUNGAN
    var bendungIcon = L.icon({
        iconUrl: '<?= base_url('icon/bendungan.svg'); ?>',
        iconSize: [30, 35], // ukuran ikon dalam piksel

    });

    var bendung = L.layerGroup();
    var layerControl = L.control.layers(baseLayers);
    <?php foreach ($bendung as $value) { ?>
        $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $value->json); ?>", function(data) {
            //Load geoJson ke map
            geoLayer = L.geoJson(data, {
                pointToLayer: function(feature, latlng) {
                    return L.marker(latlng, {
                        icon: bendungIcon
                    });
                }
            });

            geoLayer.eachLayer(function(layer) {
                geoLayer.bindPopup("Nama Daerah : <?= $value->nama; ?><br>" +
                    "Keterangan : <?= $value->keterangan; ?><br>" +
                    "Kondisi : <?= $value->kondisi; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "Lebar Atas : <?= $value->lebar_atas; ?><br>" +
                    "Lebar Bawah : <?= $value->lebar_bawah; ?><br>");
            });
            bendung.addLayer(geoLayer); // Add the geoLayer to the allGeoLayers layer group


        });
    <?php } ?>
    layerControl.addOverlay(bendung, "Bendungan"); // Add the allGeoLayers layer group to the layer control

    //JEMBATAN
    var jembatanIcon = L.icon({
        iconUrl: '<?= base_url('icon/jembatan.svg'); ?>',
        iconSize: [30, 35], // ukuran ikon dalam piksel

    });

    var jembatan = L.layerGroup();
    <?php foreach ($jembatan as $value) { ?>
        $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $value->json); ?>", function(data) {
            //Load geoJson ke map
            geoLayer = L.geoJson(data, {
                pointToLayer: function(feature, latlng) {
                    return L.marker(latlng, {
                        icon: bendungIcon
                    });
                }
            });

            geoLayer.eachLayer(function(layer) {
                geoLayer.bindPopup("Nama Daerah : <?= $value->nama; ?><br>" +
                    "Keterangan : <?= $value->keterangan; ?><br>" +
                    "Kondisi : <?= $value->kondisi; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "Lebar Atas : <?= $value->lebar_atas; ?><br>" +
                    "Lebar Bawah : <?= $value->lebar_bawah; ?><br>");
            });
            jembatan.addLayer(geoLayer); // Add the geoLayer to the allGeoLayers layer group


        });
    <?php } ?>
    layerControl.addOverlay(jembatan, "Jembatan"); // Add the allGeoLayers layer group to the layer control

    //GORONG - GORONG
    var gorongIcon = L.icon({
        iconUrl: '<?= base_url('icon/gorong.svg'); ?>',
        iconSize: [30, 35], // ukuran ikon dalam piksel

    });

    var gorong = L.layerGroup();
    <?php foreach ($gorong as $value) { ?>
        $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $value->json); ?>", function(data) {
            //Load geoJson ke map
            geoLayer = L.geoJson(data, {
                pointToLayer: function(feature, latlng) {
                    return L.marker(latlng, {
                        icon: bendungIcon
                    });
                }
            });

            geoLayer.eachLayer(function(layer) {
                geoLayer.bindPopup("Nama Daerah : <?= $value->nama; ?><br>" +
                    "Keterangan : <?= $value->keterangan; ?><br>" +
                    "Kondisi : <?= $value->kondisi; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "Lebar Atas : <?= $value->lebar_atas; ?><br>" +
                    "Lebar Bawah : <?= $value->lebar_bawah; ?><br>");
            });
            gorong.addLayer(geoLayer); // Add the geoLayer to the allGeoLayers layer group


        });
    <?php } ?>
    //aaaaaaa
    layerControl.addOverlay(gorong, "Gorong"); // Add the allGeoLayers layer group to the layer control

    //BANGUNAN BAGI
    var bangunanBagi = L.layerGroup();
    <?php foreach ($bangunanBagi as $value) { ?>
        $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $value->json); ?>", function(data) {
            //Load geoJson ke map
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        opacity: 1.0,
                        color: '<?= $value->warna; ?>',
                    }
                }
            });

            geoLayer.eachLayer(function(layer) {
                geoLayer.bindPopup("Nama Daerah : <?= $value->nama; ?><br>" +
                    "Keterangan : <?= $value->keterangan; ?><br>" +
                    "Kondisi : <?= $value->kondisi; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "Lebar Atas : <?= $value->lebar_atas; ?><br>" +
                    "Lebar Bawah : <?= $value->lebar_bawah; ?><br>");
            });
            bangunanBagi.addLayer(geoLayer); // Add the geoLayer to the allGeoLayers layer group


        });
    <?php } ?>
    //aaaaaaa
    layerControl.addOverlay(bangunanBagi, "Bangunan Bagi"); // Add the allGeoLayers layer group to the layer control

    //LANTAI
    var lantai = L.layerGroup();
    <?php foreach ($lantai as $value) { ?>
        $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $value->json); ?>", function(data) {
            //Load geoJson ke map
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        opacity: 1.0,
                        color: '<?= $value->warna; ?>',
                    }
                }
            });

            geoLayer.eachLayer(function(layer) {
                geoLayer.bindPopup("Nama Daerah : <?= $value->nama; ?><br>" +
                    "Keterangan : <?= $value->keterangan; ?><br>" +
                    "Kondisi : <?= $value->kondisi; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "Lebar Atas : <?= $value->lebar_atas; ?><br>" +
                    "Lebar Bawah : <?= $value->lebar_bawah; ?><br>");
            });
            lantai.addLayer(geoLayer); // Add the geoLayer to the allGeoLayers layer group


        });
    <?php } ?>
    //aaaaaaa
    layerControl.addOverlay(lantai, "Lantai"); // Add the allGeoLayers layer group to the layer control

    //SEDIMENTASI
    var sedimentasi = L.layerGroup();
    <?php foreach ($sedimentasi as $value) { ?>
        $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $value->json); ?>", function(data) {
            //Load geoJson ke map
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        opacity: 1.0,
                        color: '<?= $value->warna; ?>',
                    }
                }
            });

            geoLayer.eachLayer(function(layer) {
                geoLayer.bindPopup("Nama Daerah : <?= $value->nama; ?><br>" +
                    "Keterangan : <?= $value->keterangan; ?><br>" +
                    "Kondisi : <?= $value->kondisi; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "Lebar Atas : <?= $value->lebar_atas; ?><br>" +
                    "Lebar Bawah : <?= $value->lebar_bawah; ?><br>");
            });
            sedimentasi.addLayer(geoLayer); // Add the geoLayer to the allGeoLayers layer group


        });
    <?php } ?>
    //aaaaaaa
    layerControl.addOverlay(sedimentasi, "Sedimentasi"); // Add the allGeoLayers layer group to the layer control

    //LINING
    var lining = L.layerGroup();
    <?php foreach ($lining as $value) { ?>
        $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $value->json); ?>", function(data) {
            //Load geoJson ke map
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        opacity: 1.0,
                        color: '<?= $value->warna; ?>',
                    }
                }
            });

            geoLayer.eachLayer(function(layer) {
                geoLayer.bindPopup("Nama Daerah : <?= $value->nama; ?><br>" +
                    "Keterangan : <?= $value->keterangan; ?><br>" +
                    "Kondisi : <?= $value->kondisi; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "Lebar Atas : <?= $value->lebar_atas; ?><br>" +
                    "Lebar Bawah : <?= $value->lebar_bawah; ?><br>");
            });
            lining.addLayer(geoLayer); // Add the geoLayer to the allGeoLayers layer group


        });
    <?php } ?>
    //aaaaaaa
    layerControl.addOverlay(lining, "Lining"); // Add the allGeoLayers layer group to the layer control

    //Pintu Penguras
    var pintuPenguras = L.layerGroup();
    <?php foreach ($pintuPenguras as $value) { ?>
        $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $value->json); ?>", function(data) {
            //Load geoJson ke map
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        opacity: 1.0,
                        color: '<?= $value->warna; ?>',
                    }
                }
            });

            geoLayer.eachLayer(function(layer) {
                geoLayer.bindPopup("Nama Daerah : <?= $value->nama; ?><br>" +
                    "Keterangan : <?= $value->keterangan; ?><br>" +
                    "Kondisi : <?= $value->kondisi; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "Lebar Atas : <?= $value->lebar_atas; ?><br>" +
                    "Lebar Bawah : <?= $value->lebar_bawah; ?><br>");
            });
            pintuPenguras.addLayer(geoLayer); // Add the geoLayer to the allGeoLayers layer group


        });
    <?php } ?>
    //aaaaaaa
    layerControl.addOverlay(pintuPenguras, "Pintu Penguras"); // Add the allGeoLayers layer group to the layer control

    //INTAKE
    var intake = L.layerGroup();
    <?php foreach ($intake as $value) { ?>
        $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $value->json); ?>", function(data) {
            //Load geoJson ke map
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        opacity: 1.0,
                        color: '<?= $value->warna; ?>',
                    }
                }
            });

            geoLayer.eachLayer(function(layer) {
                geoLayer.bindPopup("Nama Daerah : <?= $value->nama; ?><br>" +
                    "Keterangan : <?= $value->keterangan; ?><br>" +
                    "Kondisi : <?= $value->kondisi; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "Lebar Atas : <?= $value->lebar_atas; ?><br>" +
                    "Lebar Bawah : <?= $value->lebar_bawah; ?><br>");
            });
            intake.addLayer(geoLayer); // Add the geoLayer to the allGeoLayers layer group


        });
    <?php } ?>
    //aaaaaaa
    layerControl.addOverlay(intake, "Intake"); // Add the allGeoLayers layer group to the layer control

    //PRIMER
    var primer = L.layerGroup();
    <?php foreach ($primer as $value) { ?>
        $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $value->json); ?>", function(data) {
            //Load geoJson ke map
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        opacity: 1.0,
                        color: '<?= $value->warna; ?>',
                    }
                }
            });

            geoLayer.eachLayer(function(layer) {
                geoLayer.bindPopup("Nama Daerah : <?= $value->nama; ?><br>" +
                    "Keterangan : <?= $value->keterangan; ?><br>" +
                    "Kondisi : <?= $value->kondisi; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "Lebar Atas : <?= $value->lebar_atas; ?><br>" +
                    "Lebar Bawah : <?= $value->lebar_bawah; ?><br>");
            });
            primer.addLayer(geoLayer); // Add the geoLayer to the allGeoLayers layer group


        });
    <?php } ?>
    //aaaaaaa
    layerControl.addOverlay(primer, "Primer"); // Add the allGeoLayers layer group to the layer control

    //BOX BAGI
    var boxBagi = L.layerGroup();
    <?php foreach ($boxBagi as $value) { ?>
        $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $value->json); ?>", function(data) {
            //Load geoJson ke map
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        opacity: 1.0,
                        color: '<?= $value->warna; ?>',
                    }
                }
            });

            geoLayer.eachLayer(function(layer) {
                geoLayer.bindPopup("Nama Daerah : <?= $value->nama; ?><br>" +
                    "Keterangan : <?= $value->keterangan; ?><br>" +
                    "Kondisi : <?= $value->kondisi; ?><br>" +
                    "Kecamatan : <?= $value->kecamatan; ?><br>" +
                    "Lebar Atas : <?= $value->lebar_atas; ?><br>" +
                    "Lebar Bawah : <?= $value->lebar_bawah; ?><br>");
            });
            boxBagi.addLayer(geoLayer); // Add the geoLayer to the allGeoLayers layer group


        });
    <?php } ?>
    //aaaaaaa
    layerControl.addOverlay(boxBagi, "Box Bagi"); // Add the allGeoLayers layer group to the layer control


    // Control Layer for Legend
    // var overlays = {
    //     'Bangunan': bendungan
    // };

    //Add Control Layer
    layerControl.addTo(map);
</script>

<?= $this->endSection('content'); ?>