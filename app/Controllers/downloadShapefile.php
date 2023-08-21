<?php

namespace App\Controllers;

use Shapefile\Shapefile;
use Shapefile\Geometry\Point;
use Shapefile\Geometry\Polygon;
use App\Models\DaerahIrigasiModel;

class downloadShapefile extends BaseController
{
    protected $DaerahIrigasiModel;

    public function __construct()
    {
        $this->DaerahIrigasiModel = new DaerahIrigasiModel();
    }

    public function convert()
    {
        $namaJSON = $this->DaerahIrigasiModel->getGeoJSONFilenames();
        // Path ke file GeoJSON di direktori publik
        $geojson_path = FCPATH . 'geoJson/daerahIrigasi/' . $namaJSON; // Ganti dengan path yang sesuai

        $shp_file_path = WRITEPATH . 'tempt/output.shp'; // Ganti dengan path yang sesuai

        $geojson_data = file_get_contents($geojson_path);
        $features = json_decode($geojson_data)->features;

        // Inisialisasi objek Shapefile
        $shapefile = new Shapefile();
        $shapefile->create($shp_file_path, Shapefile::SHAPE_TYPE_POLYGON); // Ganti dengan jenis geometri yang sesuai

        foreach ($features as $feature) {
            $geometry = $feature->geometry;

            // Ambil properti atau koordinat yang sesuai dari fitur GeoJSON
            $properties = $feature->properties; // Ganti dengan properti yang sesuai
            $coordinates = $geometry->coordinates; // Ganti dengan koordinat yang sesuai

            // Buat objek geometri berdasarkan jenis geometri
            if ($geometry->type === 'Point') {
                $point = new Point($coordinates[0], $coordinates[1]); // Ganti dengan koordinat yang sesuai
                $shapefile->addRecord($point, $properties);
            } elseif ($geometry->type === 'Polygon') {
                $polygon = new Polygon($coordinates); // Ganti dengan koordinat yang sesuai
                $shapefile->addRecord($polygon, $properties);
            }
        }

        $shapefile->save();

        // Set header untuk mengatur tipe konten dan ukuran file
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="output.shp"');
        header('Content-Length: ' . filesize($shp_file_path));

        // Baca dan kirimkan file
        readfile($shp_file_path);

        unlink($shp_file_path);
    }
}
