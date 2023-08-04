<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
  <h1 style="
      text-align: center;
      margin-top: 0.3cm;
      margin-bottom: 0.3cm;
      align-content: center;
    ">
    SISTEM INFORMASI PERSEBARAN IRIGASI DI KABUPATEN ACEH BARAT DAYA
  </h1>
</div>

<!-- UNTUK PETA -->

<div class="container">
  <div class="card" id="card-map-home">
    <div class="card-body">
      <div id="map"></div>
    </div>
  </div>
</div>

<!---------------->

<h1 style="margin-top: 0.3cm; margin-bottom: 1cm; text-align: center; background-color: #69b69e">BERITA</h1>
<div class="container">
  <?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
      <?php echo session()->getFlashdata('success'); ?>
    </div>
  <?php endif; ?>
  <?php if (!empty(session()->getFlashdata('error'))) : ?>
    <div class="mt-3 alert alert-error alert-dismissible fade show" role="alert">
      <?php echo session()->getFlashdata('error'); ?>
    </div>
  <?php endif; ?>

  <div class="container">
    <div class="row">
      <?php foreach ($berita1 as $a) { ?>
        <div class="col-md-4 mb-3">
          <div class="card" id="card-berita-home">
            <div class="position-absolute p-2 text-white" style="background-color: rgba(0, 0, 0, 0.7)">
              <a class="text-decoration-none text-white"><?= $a->kategori; ?></a>
            </div>
            <div style="max-height: 350px; overflow: hidden">
              <img src="<?= base_url('uploads/berita/' . $a->foto); ?>" alt="<?= $a->kategori; ?>" class="img-fluid" />
            </div>
            <div class="card-body">
              <h5 class="card-title">
                <a href="/Pages/berita/<?= $a->id_berita; ?>" class="text-decoration-none text-dark">
                  <?= $a->judul; ?>
                </a>
              </h5>
              <p>
                <small>
                  Diupload oleh
                  <span class="text-decoration-none">
                    <?= $a->penulis; ?> pada
                  </span>
                  <?= $a->created_at; ?>
                </small>
              </p>
              <span class="card-text"><?= substr($a->body, 0, 100); ?>...</span><br />
              <a id="button" style="margin-top: 10px" href="/Pages/berita/<?= $a->id_berita; ?>" class="btn btn-primary">Read more...</a>
            </div>
          </div>
        </div>
      <?php } ?>
      <div style="align-content: center">
        <?= $pager->links('berita1', 'pagination'); ?>
      </div>
    </div>
  </div>
</div>

<script>
  //Bangunan Irigasi
  <?php foreach ($bangunan as $value) { ?>
    $.getJSON("<?= base_url('geoJson/bangunanIrigasi/' . $value->json); ?>", function(data) {
      //Load geoJson ke map
      geoLayer = L.geoJson(data, {
        style: function(feature) {
          return {
            opacity: 1.0,
            color: '<?= $value->warna; ?>',
          }
        }
      }).addTo(map);
    });
  <?php } ?>

  //Daerah Irigasi untuk layer dasar
  <?php foreach ($daerah as $value) { ?>
    $.getJSON("<?= base_url('geoJson/daerahIrigasi/' . $value->json); ?>", function(data) {
      geoLayer = L.geoJson(data, {
        style: function(feature) {
          return {
            opacity: 1.0,
            color: '<?= $value->warna; ?>',
          }
        },
      }).addTo(map);
    });
  <?php } ?>

  //Jaringan Irigasi
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
    });
  <?php } ?>


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

  //Tambahkan baseLayer kedalam layerControl
  var layerControl = L.control.layers(baseLayers);
  //Tambahkan layerControl kedalam peta
  layerControl.addTo(map);
</script>

<?= $this->endSection('content'); ?>