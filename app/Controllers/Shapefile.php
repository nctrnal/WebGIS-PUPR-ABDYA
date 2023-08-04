<?php

namespace App\Controllers;

// use App\Models\BangunanIrigasiModel;
use App\Models\DaerahIrigasiModel;
// use App\Models\JaringanIrigasiModel;

class Shapefile extends BaseController
{
    protected $BangunanIrigasiModel;
    protected $DaerahIrigasiModel;
    protected $JaringanIrigasiModel;

    public function __construct()
    {
        $this->DaerahIrigasiModel = new DaerahIrigasiModel(); // Ganti dengan nama model Anda
    }

    public function convertToSHP($id)
    {
        // Ambil data GeoJSON dari database berdasarkan ID
        $geoJSONData = $this->DaerahIrigasiModel->getGeoJSONbyId($id);

        if (!$geoJSONData) {
            return redirect()->back()->with('error', 'Data GeoJSON tidak ditemukan.');
        }

        //Ubah objek dari db menjadi teks JSON
        $geoJSONText = json_encode($geoJSONData);

        // Simpan data GeoJSON dalam file sementara
        $tempFilePath = WRITEPATH . 'temp/temp.geojson';
        file_put_contents($tempFilePath, $geoJSONText);

        //Define gdal data
        putenv('GDAL_DATA=C:\Program Files\GDAL\gdal-data');

        // Jalankan perintah GDAL untuk mengonversi GeoJSON ke SHP
        $shpFilePath = WRITEPATH . 'temp' . DIRECTORY_SEPARATOR . 'converted.shp';
        exec("ogr2ogr -f 'ESRI Shapefile' {$shpFilePath} {$tempFilePath}");

        // Siapkan file untuk diunduh
        $data = file_get_contents($shpFilePath);

        // Hapus file sementara
        unlink($tempFilePath);
        unlink($shpFilePath);

        // Beri nama file yang akan diunduh
        $fileName = 'converted.shp';

        // Set header untuk mengunduh file
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $fileName);
        header('Content-Length: ' . strlen($data));

        // Outputkan data ke browser
        echo $data;
        exit;
    }
}
